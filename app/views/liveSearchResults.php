<?php if (!empty($results)): ?>
<?php foreach ($results as $wiki): ?>
<div class="col-md-4 mb-3">
    <div class="card">
        <?php if ($wiki->getImg()): ?>
        <a href="index.php?action=wiki&id=<?php echo $wiki->getId(); ?>">
            <img src="<?php echo $wiki->getImg(); ?>" class="card-img-top" alt="Wiki Image">
        </a>

        <?php endif; ?>
        <div class="card-body">
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
            <div class="mt-3">
                <a href="index.php?action=wiki&id=<?php echo $wiki->getId(); ?>" class="btn btn-primary">Read More</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php else: ?>
<div class="alert alert-info" role="alert">
    No wikis found.
</div>
<?php endif; ?>