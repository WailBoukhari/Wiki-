<!-- liveSearchResults.php -->
<?php if (!empty($results)): ?>
<ul class="list-group">
    <?php foreach ($results as $wiki): ?>
    <li class="list-group-item mb-3">
        <h3 class="mb-2">
            <a href="index.php?action=wiki&id=<?php echo $wiki->getId(); ?>">
                <?php echo $wiki->getTitle(); ?>
            </a>
        </h3>
        <p class="mb-0">
            <?php
                    $content = $wiki->getContent();
                    echo substr($content, 0, 50);
                    if (strlen($content) > 100) {
                        echo '...';
                    }
                    ?>
        </p>
    </li>
    <?php endforeach; ?>
</ul>
<?php else: ?>
<p>No results found.</p>
<?php endif; ?>