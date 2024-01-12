<?php
$title = $wiki->getTitle();
ob_start();
?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <!-- Image Section -->
            <div class="text-center">
                <img src="<?php echo $wiki->getImg(); ?>" alt="Description of the image" class="img-fluid rounded">
            </div>

            <!-- Title Section -->
            <h2 class="mt-4 mb-4 text-center">
                <?php echo $wiki->getTitle(); ?>
            </h2>

            <!-- Content Section -->
            <p class="text-justify">
                <?php echo $wiki->getContent(); ?>
            </p>

            <!-- Tags Section -->
            <div class="mt-4">
                <?php $tags = $wiki->getTags(); ?>
                <?php if (!empty($tags)) : ?>
                    <h4>Tags:</h4>
                    <ul class="list-inline">
                        <?php foreach ($tags as $tag) : ?>
                            <li class="list-inline-item">
                                <span class="badge badge-primary">
                                    <?php echo $tag->getName(); ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>