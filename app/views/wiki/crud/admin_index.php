<?php
$title = "Wiki List";
ob_start();
?>
<div class="container mt-5">

    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar -->
            <ul class="list-group">
                <li class="list-group-item" href="index.php?action=admin">Admin Menu</li>
                <a href="index.php?action=admin_wiki_table" class="list-group-item">Manage Wiki</a>
                <a href="index.php?action=category_table" class="list-group-item">Manage Categories</a>
                <a href="index.php?action=tag_table" class="list-group-item">Manage Tags</a>
            </ul>
        </div>
        <div class="col-md-9">
            <!-- Content -->

            <div class="container">
                <?php echo "<h2>$title</h2>" ?>
                <div class="row mb-3">
                    <div class="col-md-12 text-right">
                        <a href="index.php?action=wiki_create" class="btn btn-primary">Create Wiki</a>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>User</th>
                            <th>Category</th>
                            <th>Created At</th>
                            <th>Is Archived</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($wikis as $wiki): ?>
                            <tr>
                                <td>
                                    <?= $wiki->getId(); ?>
                                </td>
                                <td>
                                    <?= $wiki->getTitle(); ?>
                                </td>
                                <td>
                                    <?php
                                    $content = $wiki->getContent();
                                    echo substr($content, 0, 50);
                                    if (strlen($content) > 100) {
                                        echo '...';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?= $wiki->getUserId(); ?>
                                </td>
                                <td>
                                    <?= $wiki->getCategoryName(); ?>
                                </td>

                                <td>
                                    <?= $wiki->getCreatedAt(); ?>
                                </td>
                                <td>
                                    <?= $wiki->isArchived(); ?>
                                </td>
                                <td>
                                    <?php if ($wiki->isArchived()): ?>
                                        <a href="index.php?action=wiki_enable&id=<?= $wiki->getId(); ?>"
                                            class="btn btn-success btn-sm">Enable</a>
                                    <?php else: ?>
                                        <a href="index.php?action=wiki_disable&id=<?= $wiki->getId(); ?>"
                                            class="btn btn-danger btn-sm">Disable</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>