<?php
$title = "Category Page";
ob_start();
?>

<div class="container py-5">
    <h2>Category Information</h2>
    <?php if ($category): ?>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Category Name:</h5>
            <p class="card-text"><?php echo $category->getName(); ?></p>
        </div>
    </div>
    <?php else: ?>
    <div class="alert alert-danger" role="alert">
        Category not found.
    </div>
    <?php endif; ?>
</div>

<div class="container p-5">
    <h2>Related Wikis</h2>
    <div class="card-deck">
        <?php foreach ($relatedWikis as $wiki): ?>
        <div class="card mb-4">
            <?php if ($wiki->getImg()): ?>
            <a href="index.php?action=wiki&id=<?php echo $wiki->getId(); ?>">
                <img src="<?php echo $wiki->getImg(); ?>" class="card-img-top" alt="Wiki Image">
            </a>
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title">
                    <a href="index.php?action=wiki&id=<?php echo $wiki->getId(); ?>">
                        <?php echo $wiki->getTitle(); ?>
                    </a>
                </h5>
                <p class="card-text">
                    <?php
                        $content = $wiki->getContent();
                        echo substr($content, 0, 50);
                        ?>
                </p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>