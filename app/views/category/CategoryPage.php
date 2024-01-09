<?php
$title = "Category Page";
ob_start();
?>

<h2>Category List</h2>

<ul>
    <?php foreach ($categories as $category): ?>
    <li>
        <?= $category->getName(); ?>
        <a href="index.php?action=edit_category&id=<?= $category->getId(); ?>">Edit</a>
        <a href="index.php?action=delete_category&id=<?= $category->getId(); ?>">Delete</a>
    </li>
    <?php endforeach; ?>
</ul>
<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>