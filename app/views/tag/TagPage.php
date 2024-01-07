<?php
$title = "Tag Page - " . $tag->getName();
ob_start();
?>

<div class="container py-5">
    <h2>Wikis Related to
        <?php echo $tag->getName(); ?>
    </h2>

    <?php if (!empty($wikis)): ?>
        <ul class="list-group">
            <?php foreach ($wikis as $wiki): ?>
                <li class="list-group-item">
                    <h3 class="mb-2">
                        <a href="index.php?action=wiki&id=<?php echo $wiki->getId(); ?>">
                            <?php echo $wiki->getTitle(); ?>
                        </a>
                    </h3>
                    <p>
                        <?php echo $wiki->getContent(); ?>
                    </p>
                    <!-- Display other wiki information as needed -->
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="alert alert-warning">No wikis found for this tag.</p>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>