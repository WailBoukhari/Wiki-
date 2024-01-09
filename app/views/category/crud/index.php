<?php
$title = "Category List";
ob_start();
?>
<div class="container mt-5">

    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar -->
            <ul class="list-group">
                <li class="list-group-item"><a href="index.php?action=admin" class="text-dark">Admin Menu</a></li>
                <a href="index.php?action=wiki_table" class="list-group-item">Manage Wiki</a>
                <a href="index.php?action=category_table" class="list-group-item">Manage Categories</a>
                <a href="index.php?action=tag_table" class="list-group-item">Manage Tags</a>
            </ul>
        </div>
        <div class="col-md-9">
            <!-- Content -->
            <div class="container mt-5">
                <?php echo "<h2>$title</h2>" ?>
                <!-- Content -->
                <a href="index.php?action=category_create" class="btn btn-success my-1">Add New Category</a>
                <ul class="list-group">
                    <?php foreach ($categories as $category): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <?= $category->getName(); ?>
                            </span>
                            <div class="btn-group">
                                <a href="index.php?action=category_edit&id=<?= $category->getId(); ?>"
                                    class="btn btn-primary btn-sm">Edit</a>
                                <a href="index.php?action=category_delete&id=<?= $category->getId(); ?>"
                                    class="btn btn-danger btn-sm">Delete</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>