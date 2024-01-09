<?php
$title = "Edit Wiki";
ob_start();
?>

<div class="container mt-5">
    <?php echo "<h1>$title</h1>" ?>
    <form action="index.php?action=wiki_update&id=<?= $wiki->getId(); ?>" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" name="title" value="<?= $wiki->getTitle(); ?>" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content:</label>
            <textarea class="form-control" name="content" required><?= $wiki->getContent(); ?></textarea>
        </div>

        <!-- Category selection -->
        <div class="mb-3">
            <label for="category" class="form-label">Category:</label>
            <select class="form-select" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->getId(); ?>" <?= ($category->getId() == $wiki->getCategoryId()) ? 'selected' : ''; ?>>
                        <?= $category->getName(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Tags selection -->
        <div class="mb-3">
            <label for="tags" class="form-label">Tags:</label>
            <select class="form-select" name="tags[]" multiple required>
                <?php foreach ($tags as $tag): ?>
                    <option value="<?= $tag->getId(); ?>" <?= (in_array($tag->getId(), $wiki->getTagIds())) ? 'selected' : ''; ?>>
                        <?= $tag->getName(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Wiki</button>
    </form>
</div>

<?php
$content = ob_get_clean();
include_once 'app/views/include/layout.php';
?>