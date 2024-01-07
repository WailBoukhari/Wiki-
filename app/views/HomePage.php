<?php
$title = "HomePage";
ob_start();
?>

<!-- Welcome Section -->
<div class="jumbotron color-black py-5 text-center" style="background-image: url('public/assets/img/bg-masthead.jpg');">
    <h1 class="display-4">Welcome to WikiInfo</h1>
    <p class="lead">Your go-to platform for collaborative knowledge sharing.</p>
    <a href="index.php?action=allwikis" class="btn btn-primary btn-lg">Go to Wikis Page</a>
</div>

<div class="container py-5">
    <h2>Latest Wikis</h2>
    <div class="card-group">
        <?php foreach ($latestWikis as $wiki): ?>
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

<div class="container py-5">
    <h2>Latest Categories</h2>
    <div class="card-group">
        <?php foreach ($latestCategories as $category): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="index.php?action=category&id=<?php echo $category->getId(); ?>">
                            <?php echo $category->getName(); ?>
                        </a>
                    </h5>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="container py-5">
    <h2>Latest Tags</h2>
    <div class="card-group">
        <?php foreach ($latestTags as $tag): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="index.php?action=tag&id=<?php echo $tag->getId(); ?>">
                            <span>
                                <?php echo $tag->getName(); ?>
                            </span>
                        </a>
                    </h5>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Footer -->
<footer class="footer py-5">
    <p class="text-center">&copy; 2024 WikiInfo. All rights reserved.</p>
</footer>

<?php $content = ob_get_clean(); ?>
<?php include_once 'app/views/include/layout.php'; ?>