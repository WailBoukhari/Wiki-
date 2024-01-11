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
        $wiki = $wikiDAO->getWikiByIdWithTags($wikiId);

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
        $wikis = $wikiDAO->getAllWikisForCrudByUserId($userID);

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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = $_POST['category_id'];
            $tagIds = isset($_POST['tags']) ? $_POST['tags'] : [];
    
            // Validate and sanitize input if needed
    
            $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
            $imagePath = $this->handleImageUpload();
    
            $success = $this->wikiDAO->createWiki($title, $content, $userId, $categoryId, $tagIds, $imagePath);
    
            if ($success) {
                header('Location: index.php?action=author_wiki_table');
                exit();
            } else {
                echo "Failed to create the wiki.";
            }
        }
    }
    public function edit($wikiId)
    {
        $wiki = $this->wikiDAO->getWikiById($wikiId);

        if (!$wiki) {
            echo "Wiki not found.";
            return;
        }

        $categories = $this->categoryDAO->getAllCategories();
        $tags = $this->tagDAO->getAllTags();

        include 'app/views/wiki/crud/edit.php';
    }

    public function update($wikiId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = $_POST['category_id'];
            $tagIds = isset($_POST['tags']) ? $_POST['tags'] : [];
    
            $imagePath = $this->handleImageUpload();
    
            $success = $this->wikiDAO->updateWiki($wikiId, $title, $content, $categoryId, $tagIds, $imagePath);
    
            if ($success) {
                header('Location: index.php?action=author_wiki_table');
                exit();
            } else {
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
        $wiki = $this->wykiDAO->getWikiById($wikiId);

        if ($wiki) {
            include_once 'app/views/wiki/crud/delete.php';
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
                header('Location: index.php?action=author_wiki_table');
                exit();
            } else {
                // Handle the case where disabling failed
                echo "Failed to disable the wiki.";
            }
        }
    }
    private function handleImageUpload()
    {
        $imagePath = null;
    
        if (isset($_FILES['newImage']) && $_FILES['newImage']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'public/assets/img/';
            $uploadFile = $uploadDir . basename($_FILES['newImage']['name']);
    
            if (move_uploaded_file($_FILES['newImage']['tmp_name'], $uploadFile)) {
                $imagePath = $_FILES['newImage']['name'];
            }
        }
    
        return $imagePath;
    }
}

?>