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
                <li class="list-group-item" href="index.php?action=admin">Admin Menu</li>
                <a href="index.php?action=wiki_table" class="list-group-item">Manage Wiki</a>
                <a href="index.php?action=category_table" class="list-group-item">Manage Categories</a>
                <a href="index.php?action=tag_table" class="list-group-item">Manage Tags</a>
            </ul>
        </div>
        <div class="col-md-9">
            <!-- Content -->
            <h2>Admin Panel</h2>
            <p>Welcome to the admin panel. Choose an option from the menu.</p>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>