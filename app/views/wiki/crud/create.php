<?php
$title = "Create a New Wiki";
ob_start();
?>

<div class="container mt-5">
    <?php echo "<h1>$title</h1>" ?>
    <form action="index.php?action=wiki_store" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" name="title" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content:</label>
            <textarea class="form-control" name="content" required></textarea>
        </div>

        <!-- Image upload -->
        <div class="mb-3">
            <label for="newImage" class="form-label">Image:</label>
            <input type="file" class="form-control" name="newImage">
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category:</label>
            <select class="form-control" name="category_id">
                <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->getId(); ?>">
                    <?php echo $category->getName(); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tags:</label>
            <select class="form-control" name="tags[]" multiple>
                <?php foreach ($tags as $tag): ?>
                <option value="<?php echo $tag->getId(); ?>">
                    <?php echo $tag->getName(); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Wiki</button>
    </form>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>