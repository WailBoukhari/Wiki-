<?php
$title = "Delete Wiki";
ob_start();

?>

<div class="container mt-5">
    <?php echo "<h2>$title</h2>" ?>
    <p>Are you sure you want to delete the wiki?</p>

    <form action="index.php?action=wiki_destroy" method="POST">
        <input type="hidden" name="wiki_id" value="<?php echo $wiki->getId(); ?>">
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>