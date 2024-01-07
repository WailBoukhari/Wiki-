<?php
$title = $wiki->getTitle();
ob_start();
?>

<div class="container py-5">
    <h2>
        <?php echo $wiki->getTitle(); ?>
    </h2>

    <p>
        <?php echo $wiki->getContent(); ?>
    </p>
    <!-- Access other properties as needed -->
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';