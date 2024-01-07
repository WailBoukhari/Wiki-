<?php
$title = "Category Page";
ob_start();
?>

<div class="container py-5">
    <h2>Category Information</h2>
    <?php if ($category): ?>
    <p>Category Name:
        <?php echo $category->getName(); ?>
    </p>
    <!-- Add more information about the category as needed -->
    <?php else: ?>
    <p>Category not found.</p>
    <?php endif; ?>
</div>

<div class="container py-5">
    <h2>Related Wikis</h2>
    <div class="card-group">
        <?php foreach ($relatedWikis as $wiki): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="index.php?action=wiki&id=<?php echo $wiki->getId(); ?>">
                        <?php echo $wiki->getTitle(); ?>
                    </a>
                </h5>
                <p class="card-text">
                    <?php echo $wiki->getContent(); ?>
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