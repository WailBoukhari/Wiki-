<?php
$title = "Delete Category";
ob_start();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>
                <?php echo $title; ?>
            </h1>

            <p>Are you sure you want to delete the category "
                <?= $category->getName(); ?>"?
            </p>

            <form action="index.php?action=category_destroy" method="post">
                <input type="hidden" name="category_id" value="<?= $category->getId(); ?>">

                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                <a href="index.php?action=categories" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>