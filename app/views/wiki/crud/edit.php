<?php
$title = "Edit Wiki";
ob_start();
?>

<div class="container mt-5">
    <?php echo "<h1>$title</h1>" ?>
    <form action="index.php?action=wiki_update&id=<?= $wiki->getId(); ?>" method="POST" enctype="multipart/form-data">
        <!-- Existing Image -->
        <div class="mb-3">
            <label for="existingImage" class="form-label">Existing Image:</label>
            <img src="<?= $wiki->getImg(); ?>" alt="Existing Image">
        </div>



        <div class="mb-3">
            <label for="content" class="form-label">Content:</label>
            <textarea class="form-control" name="content" required><?= $wiki->getContent(); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category:</label>
            <select class="form-control" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                <option value="<?= $category->getId(); ?>"
                    <?= ($category->getId() == $wiki->getCategoryId()) ? 'selected' : ''; ?>>
                    <?= $category->getName(); ?>
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
        <!-- Upload New Image -->
        <div class="mb-3">
            <label for="newImage" class="form-label">New Image:</label>
            <input type="file" class="form-control" name="newImage">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" name="title" value="<?= $wiki->getTitle(); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Wiki</button>
    </form>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>