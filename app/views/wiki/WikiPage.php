<?php
$title = "HomePage";
ob_start();
?>
<header>
    <?php echo "<h1>$title</h1>" ?>

</header>

<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <!-- Add more navigation links as needed -->
    </ul>
</nav>

<section id="wiki-content">
    <article>
        <!-- Display the wiki content dynamically from the backend -->
        <p>This is the content of the wiki page. It can include text, images, and other elements.</p>
    </article>

    <aside>
        <div>
            <h3>Categories</h3>
            <!-- Display the associated categories dynamically from the backend -->
            <!-- Example: <a href="/category/1">Category 1</a> -->
            <!-- Example: <a href="/category/2">Category 2</a> -->
        </div>
        <div>
            <h3>Tags</h3>
            <!-- Display the associated tags dynamically from the backend -->
            <!-- Example: <span>#Tag1</span> -->
            <!-- Example: <span>#Tag2</span> -->
        </div>
        <div>
            <h3>Author</h3>
            <!-- Display author information dynamically from the backend -->
            <!-- Example: <p>Author: John Doe</p> -->
            <!-- Example: <p>Email: john.doe@example.com</p> -->
        </div>
    </aside>
</section>
<?php $content = ob_get_clean(); ?>
<?php include_once 'app/views/include/layout.php'; ?>