<?php

class WikiController
{
    private $wikiDAO;
    private $categoryDAO;
    private $tagDAO;

    public function __construct()
    {
        $this->wikiDAO = new WikiDAO();
        $this->categoryDAO = new CategoryDAO();
        $this->tagDAO = new TagDAO();
    }
    public function showWikiPage($wikiId)
    {
        $wikiDAO = new WikiDAO();
        $tags = $this->wikiDAO->getTagsByWikiId($wikiId);
        $wiki = $wikiDAO->getWikiById($wikiId);

        include_once 'app/views/wiki/SingleWikiPage.php';
    }
    public function adminIndex()
    {
        $wikiDAO = new WikiDAO();
        $wikis = $wikiDAO->getAllWikisForCrud();

        include 'app/views/wiki/crud/admin_index.php';
    }
    public function authorIndex()
    {
        $wikiDAO = new WikiDAO();
        $wikis = $wikiDAO->getAllWikisForCrud();

        include 'app/views/wiki/crud/author_index.php';
    }
    public function create()
    {
        // Get all categories for the create form
        $tags = $this->tagDAO->getAllTags();
        $categories = $this->categoryDAO->getAllCategories();

        // Display the form to create a new wiki
        include 'app/views/wiki/crud/create.php';
    }

    public function store()
    {
        // Handle the submission of the create form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = $_POST['category_id'];
            $tagIds = isset($_POST['tags']) ? $_POST['tags'] : [];

            // Validate and sanitize input if needed

            $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

            if ($userId) {
                // Create the wiki with the associated user, category, and tags
                $success = $this->wikiDAO->createWiki($title, $content, $userId, $categoryId, $tagIds);

                if ($success) {
                    // Redirect to the index page or show a success message
                    header('Location: index.php?action=author_wiki_table');
                    exit();
                } else {
                    // Handle the case where the creation failed
                    echo "Failed to create the wiki.";
                }
            } else {
                // Handle the case where user is not authenticated
                echo "User not authenticated.";
            }
        }
    }

    public function edit($wikiId)
    {
        // Get the wiki by ID
        $wiki = $this->wikiDAO->getWikiById($wikiId);

        if (!$wiki) {
            // Handle the case where the wiki is not found
            echo "Wiki not found.";
            return;
        }

        // Get all categories and tags
        $categories = $this->categoryDAO->getAllCategories();
        $tags = $this->tagDAO->getAllTags();

        // Include the view for editing an existing wiki
        include 'app/views/wiki/crud/edit.php';
    }

    public function update($wikiId)
    {
        // Handle the submission of the edit form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = $_POST['category_id'];
            $tagIds = isset($_POST['tags']) ? $_POST['tags'] : [];

            // Validate and sanitize input if needed

            // Update the wiki
            $success = $this->wikiDAO->updateWiki($wikiId, $title, $content, $categoryId, $tagIds);

            if ($success) {
                // Redirect to the index page or show a success message
                header('Location: index.php?action=author_wiki_table');
                exit();
            } else {
                // Handle the case where the update failed
                echo "Failed to update the wiki.";
            }
        }
    }

    public function disable($wikiId)
    {
        // Disable the wiki (soft delete or update status, depending on your design)
        $success = $this->wikiDAO->disableWiki($wikiId);

        if ($success) {
            // Redirect to the index page or show a success message
            header('Location: index.php?action=admin_wiki_table');
            exit();
        } else {
            // Handle the case where disabling failed
            echo "Failed to disable the wiki.";
        }

    }
    public function enable($wikiId)
    {
        // Disable the wiki (soft delete or update status, depending on your design)
        $success = $this->wikiDAO->enableWiki($wikiId);

        if ($success) {
            // Redirect to the index page or show a success message
            header('Location: index.php?action=admin_wiki_table');
            exit();
        } else {
            // Handle the case where disabling failed
            echo "Failed to disable the wiki.";
        }

    }
    public function delete($wikiId)
    {
        $wiki = $this->wikiDAO->getWikiById($wikiId);

        if ($wiki) {
            include_once 'app/views/wiki/crud/author_wiki_table.php';
        } else {
            // Handle the case where the wiki is not found
            echo "Wiki not found.";
        }
    }

    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $wikiId = $_POST['wiki_id'];

            $success = $this->wikiDAO->deleteWiki($wikiId);

            if ($success) {
                // Redirect to the index page or show a success message
                header('Location: index.php?action=wiki_table');
                exit();
            } else {
                // Handle the case where disabling failed
                echo "Failed to disable the wiki.";
            }
        }
    }

}

?>