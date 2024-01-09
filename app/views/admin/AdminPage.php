<?php
// admin.php

$title = "Admin Panel";
ob_start();
?>

<div class="container mt-5">

    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar -->
            <ul class="list-group">
                <li class="list-group-item"><a href="index.php?action=admin" class="text-dark">Admin Menu</a></li>
                <a href="index.php?action=admin_wiki_table" class="list-group-item">Manage Wiki</a>
                <a href="index.php?action=category_table" class="list-group-item">Manage Categories</a>
                <a href="index.php?action=tag_table" class="list-group-item">Manage Tags</a>
            </ul>
        </div>
        <div class="col-md-9">
            <!-- Content -->
            <div class="container mt-5">
                <h2>
                    <?= $title ?>
                </h2>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="card-title">Categories</h3>
                                <p class="card-text">Total Categories:
                                    <?= $categoryCount->count ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="card-title">Tags</h3>
                                <p class="card-text">Total Tags:
                                    <?= $tagCount->count ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Wikis</h3>
                                <p class="card-text">Total Wikis:
                                    <?= $wikiCount->count ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>