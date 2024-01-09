<?php
$title = "Create Category";
ob_start();
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>
                <?php echo $title; ?>
            </h1>

            <form action="index.php?action=category_store" method="post">
                <div class="form-group">
                    <label for="name">Category Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>