<?php
$title = "Tag List";
ob_start();
?>
<div class="container mt-5">

    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar -->
            <ul class="list-group">
                <li class="list-group-item" href="index.php?action=admin">Admin Menu</li>
                <?php if (isset($_SESSION['user'])) {
                    $role = $_SESSION['user']->getRole();

                    switch ($role) {
                        case 'Admin':
                            echo '<a href="index.php?action=admin_wiki_table" class="list-group-item">Manage Wiki</a>';
                            break;
                        case 'Author':
                            echo '<a href="index.php?action=author_wiki_table" class="list-group-item">Manage Wiki</a>';
                            break;
                    }
                } ?> <a href="index.php?action=category_table" class="list-group-item">Manage Categories</a>
                <a href="index.php?action=tag_table" class="list-group-item">Manage Tags</a>
            </ul>
        </div>
        <div class="col-md-9">
            <!-- Content -->

            <div class="container mt-5">
                <?php echo "<h2>$title</h2>" ?>
                <a href="index.php?action=tag_create" class="btn btn-primary">Create Tag</a>

                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tags as $tag): ?>
                            <tr>
                                <td>
                                    <?php echo $tag->getId(); ?>
                                </td>
                                <td>
                                    <?php echo $tag->getName(); ?>
                                </td>
                                <td>
                                    <?php echo $tag->getCreatedAt(); ?>
                                </td>
                                <td>
                                    <a href="index.php?action=tag_edit&id=<?php echo $tag->getId(); ?>"
                                        class="btn btn-warning">Edit</a>
                                    <a href="index.php?action=tag_delete&id=<?php echo $tag->getId(); ?>"
                                        class="btn btn-danger">Disable</a>
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