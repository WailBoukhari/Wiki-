<?php
$title = "HomePage";
ob_start();
?>
<!-- Welcome Section -->
<div class="jumbotron color-black py-5 text-center" style="background-image: url('public/assets/img/bg-masthead.jpg');">
    <h1 class="display-4">Welcome to WikiInfo</h1>
    <p class="lead">Your go-to platform for collaborative knowledge sharing.</p>
    <a href="index.php?action=search">Go Wikis Page</a>
</div>


<div class="container py-5">
    <h2>Lastest Wikis</h2>

</div>


<div class="container py-5">
    <h2>Lastest Categories</h2>

</div>

<div class="container py-5">
    <h2>Lastest Tags</h2>

</div>

<!-- Footer -->
<footer class="footer py-5">
    <p>&copy; 2024 WikiInfo. All rights reserved.</p>
</footer>

<?php $content = ob_get_clean(); ?>
<?php include_once 'app/views/include/layout.php'; ?>