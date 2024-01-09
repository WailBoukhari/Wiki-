<?php
$title = "HomePage";
ob_start();
?>

<div class="jumbotron color-black py-5 text-center mdb-color darken-2 position-relative"
    style="background-image: url('public/assets/img/bg-masthead.jpg'); background-size: cover;">

    <!-- Opacity Overlay -->
    <div class="position-absolute w-100 h-100 bg-dark top-0" style="opacity: 0.7;"></div>

    <div class="container position-relative">
        <h1 class="display-4 text-white">Welcome to WikiInfo</h1>
        <p class="lead text-white">Your go-to platform for collaborative knowledge sharing.</p>
        <div class="d-flex justify-content-center">
            <div class="input-group mb-3" style="max-width: 300px;">
                <input type="search" class="form-control" id="datatable-search-input"
                    placeholder="Search for wikis, categories, tags...">
                <button class="btn btn-primary" type="button">Search</button>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <!-- Latest Categories and Tags on the Left -->
        <div class="col-lg-3">
            <div class="container py-5">
                <h2>Latest Wikis</h2>
                <div class="card-deck">
                    <?php foreach ($latestWikis as $wiki): ?>
                    <div class="card">
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
                                    if (strlen($content) > 100) {
                                        echo '...';
                                    }
                                    ?>
                            </p>

                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="container py-5">
                <h2>Latest Categories</h2>
                <div class="card-deck">
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
                <div class="card-deck">
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
        </div>

        <!-- All Wikis in the Center -->
        <div class="col-lg-9">
            <div class="col-lg-9">
                <div class="container py-5">
                    <h2 class="mb-4">All Wikis</h2>

                    <?php if (!empty($wikis)): ?>
                    <ul class="list-group">
                        <?php foreach ($wikis as $wiki): ?>
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
                    <div class="alert alert-info" role="alert">
                        No wikis found.
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer py-5">
    <p class="text-center text-black">&copy; 2024 WikiInfo. All rights reserved.</p>
</footer>

<?php $content = ob_get_clean(); ?>
<?php include_once 'app/views/include/layout.php'; ?>