<?php
$title = "Edit Category";
ob_start();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>
                <?php echo $title; ?>
            </h1>

            <form action="index.php?action=category_update" method="post">
                <input type="hidden" name="category_id" value="<?= $category->getId(); ?>">

                <div class="form-group">
                    <label for="name">Category Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $category->getName(); ?>"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>