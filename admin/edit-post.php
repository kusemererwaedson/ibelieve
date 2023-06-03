<?php 
include 'partials/header.php'; 

// fetch categories from database
$category_query = "SELECT * FROM categories";
$categories = mysqli_query($connection,$category_query);

// fetch post data from database if id is set
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
}else{
    header('location:'. ROOT_URL .'admin/');
    die();
}
?>

 <section class="form__section">
    <div class="container form__section-container">
        <h2> Edit Post </h2> 
        <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
            <input name="id" type="hidden" value="<?= $post['id'] ?>" 
            placeholder="Title">
            <input name="previous_thumbnail_name" type="hidden" value="<?= $post['thumbnail'] ?>" 
            placeholder="Title">
            <input name="title" type="text" value="<?= $post['title'] ?>" placeholder="Title">
            <select name="category">
                <?php while($category = mysqli_fetch_assoc($categories)): ?>
                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            <textarea name="body" rows="10" placeholder="Body"><?= $post['body'] ?></textarea>
            <div class="form__control inline">
                <input name="is_featured" type="checkbox" id="is_featured" value="1" checked>
                <label for="is_featured" checked>Featured</label>
            </div>
            <div class="form__control">
                <label for="thumbnail">Change Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button name="submit" type="submit"  class="btn">Update Posts</button>
        </form>
    </div>
</section>

<?php include 'partials/footer.php'; ?>