<?php 
require ('././config/database.php'); 

// fetch current user from database
if(isset($_SESSION['user-id'])){
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id=$id";
    $result = mysqli_query($connection,$query);
    $avatar = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ibelieve</title>
    <!-- CUSTOM STYLESHEET -->
    <link rel="icon" href="imagesR/logoed2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&dispaly=swap" rel="stylesheet">
</head>
<body>
  <nav>
    <div class="container nav__container" style="margin-bottom: 200px;">
    <img src="imagesR/logoed2.png" style="height: 70px; width: 100px;">
        <a href="<?= ROOT_URL ?>" class="nav__logo">ibelieve</a>
        <ul class="nav__items">
            <li><a href="blog.php">Blog</a></li>
            <li><a href="<?= ROOT_URL ?>">About</a></li>
            <li><a href="<?= ROOT_URL ?>">Services</a></li>
            <li><a href="<?= ROOT_URL ?>">Contact</a></li>
            <?php if(isset($_SESSION['user-id'])){?>
                <li class="nav__profile">
                <div class="avatar">
                    <img src="<?= ROOT_URL . 'images/' . $avatar['avatar'] ?>">
                </div>    
                    <ul>
                        <li><a href="<?= ROOT_URL ?>admin/index.php">Dashboard</a></li>
                        <li><a href="<?= ROOT_URL ?>logout.php">Logout</a></li>
                    </ul>             
            </li>
            <?php }else{ ?>
            <li><a href="<?= ROOT_URL ?>signin.php">Sign In</a></li>
            <?php } ?>
        </ul>
        <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
        <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
    </div>
  </nav> 
 <!--======================= END OF NAV ========================--> 



