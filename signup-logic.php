<?php
require 'config/database.php';

//get signup form data if signup button was clicked
 if(isset($_POST['submit'])){
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $avatar = $_FILES['avatar'];
    // var_dump($avatar);

    // validate input values
    if(!$firstname){
        $_SESSION['signup'] = "Please enter your First Name";
    }elseif(!$lastname){
        $_SESSION['signup'] = "Please enter your Last Name";
    }elseif(!$username){
        $_SESSION['signup'] = "Please enter your User Name";
    }elseif(!$email){
        $_SESSION['signup'] = "Please enter a valid email";
    }elseif(strlen($password) < 8){
        $_SESSION['signup'] = "Password should be 8+ characters";
    }elseif(!$avatar['name']){
        $_SESSION['signup'] = "Please add avatar";
    }else{
        //check if passwords don't match
        if($password !== $confirmpassword){
            $_SESSION['signup'] = "Passwords do not match";
        }else{
            // hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // check if email or username already exists in the database
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connection,$user_check_query);
            if(mysqli_num_rows($user_check_result) > 0){
                $_SESSION['signup'] = "Username or Email already exists";
            }else{
                //WORK ON AVATAR
                //rename avatar
                $time = time(); // make each image name unique using current timestamp
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

                // make sure file is an image
                $allowed_files = ['png','jpg','jpeg'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if(in_array($extention, $allowed_files)){
                    // make sure is not large (1mb+)
                    if($avatar['size'] < 5000000){
                        //upload avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    }else{
                        $_SESSION['signup'] = 'File size too big. Should be less than 1mb';
                        
                    }
                }else{
                    $_SESSION['signup'] = "File should be png. jpg, or jpeg";
                }
            }
              
        }
    }

    // redirect back to signup page if there was any problem
    if(isset($_SESSION['signup'])){
        // pass form data back to signup page
        $_SESSION['signup-data'] = $_POST; 
        header('location: '. ROOT_URL . 'signup.php');
        die();
    }else{
        // insert new user into table
        $insert_user_query = "INSERT INTO users(firstname,lastname,username,email,password,avatar) values('$firstname','$lastname','$username','$email','$hashed_password','$avatar_name')";
        $insert_user_result= mysqli_query($connection,$insert_user_query);
        if(!mysqli_errno($connection)){
            // redirect to login page success message
            $_SESSION['signup-success'] = "Registratio successful, Please log in";
            header('location: '.  ROOT_URL . 'signin.php');
            die();

        }
        else{
            die(mysqli_error($connection));
        }
    }
 }else{
    //if button wasn't clicked, bounce back to signup page
    header('location: '. ROOT_URL . 'signup.php');
    die();
 }
?>