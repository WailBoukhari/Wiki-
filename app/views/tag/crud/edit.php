<?php
$title = "Edit Tag";
ob_start();
?>
<div class="container mt-5">
    <?php echo "<h1>$title</h1>" ?>

    <form action="index.php?action=tag_update" method="POST">
        <input type="hidden" name="tag_id" value="<?php echo $tag->getId(); ?>">

        <div class="mb-3">
            <label for="name" class="form-label">Tag Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $tag->getName(); ?>"
                required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>