<?php
$title = "All Wikis";
ob_start();

// Create an instance of WikiDAO
$wikiDAO = new WikiDAO();

// Get all wikis
$allWikis = $wikiDAO->getAllWikis();

?>

<div class="container py-5">
    <h2 class="mb-4">All Wikis</h2>

    <?php if (!empty($allWikis)): ?>
        <ul class="list-group">
            <?php foreach ($allWikis as $wiki): ?>
                <li class="list-group-item mb-3">
                    <h3 class="mb-2">
                        <a href="index.php?action=wiki&id=<?php echo $wiki->getId(); ?>">
                            <?php echo $wiki->getTitle(); ?>
                        </a>
                    </h3>
                    <p class="mb-0">
                        <?php echo $wiki->getContent(); ?>
                    </p>
                    <!-- Access other properties as needed -->
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div class="alert alert-info" role="alert">
            No wikis found.
        </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>