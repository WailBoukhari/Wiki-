<?php
$title = "Admin Page";
ob_start();

?>

<div class="container py-5">
    <h2>Admin Page</h2>

    <a href="index.php?action=createWiki" class="btn btn-primary mb-3">Create New Wiki</a>

    <?php if (!empty($wikis)): ?>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($wikis as $wiki): ?>
            <tr>
                <td>
                    <?php echo $wiki->getTitle(); ?>
                </td>
                <td>
                    <?php echo $wiki->getContent(); ?>
                </td>
                <td>
                    <?php echo $wiki->getCategory()->getName(); ?>
                </td>
                <td>
                    <a href="index.php?action=editWiki&id=<?php echo $wiki->getId(); ?>"
                        class="btn btn-info btn-sm">Edit</a>
                    <a href="index.php?action=disableWiki&id=<?php echo $wiki->getId(); ?>"
                        class="btn btn-danger btn-sm">Disable</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No wikis found.</p>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>