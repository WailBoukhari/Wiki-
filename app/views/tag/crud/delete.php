<?php
$title = "Delete Tag";
ob_start();
?>

<div class="container mt-5">

    <?php echo "<h1>$title</h1>" ?>

    <p>Are you sure you want to disable the tag?</p>

    <form action="index.php?action=tag_destroy" method="POST">
        <input type="hidden" name="tag_id" value="<?php echo $tag->getId(); ?>">
        <button type="submit" class="btn btn-danger">Disable</button>
    </form>
</div>
<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>