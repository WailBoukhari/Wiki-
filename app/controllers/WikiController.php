<?php

class WikiController
{
    private $wikiDAO;

    public function __construct()
    {
        $this->wikiDAO = new WikiDAO();
    }

    public function showAllWikis()
    {
        $wikis = $this->wikiDAO->getAllWikis();
        include_once 'app/views/wiki/AllWikisPage.php';
    }

    public function showCreateWikiForm()
    {
        include_once 'app/views/wiki/CreateWikiForm.php';
    }

    public function createWiki()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $userId = $_SESSION['user']->getId();
            $categoryId = $_POST['category']; // Assuming you have a category selection in your form

            $success = $this->wikiDAO->createWiki($title, $content, $userId, $categoryId);

            if ($success) {

                header('Location: index.php?action=allwikis');
                exit();
            } else {

                $errorMessage = 'Failed to create the wiki.';
                include_once 'app/views/wiki/CreateWikiForm.php';
            }
        }
    }

    public function showWiki($wikiId)
    {

        $wikiDAO = new WikiDAO();

        $wiki = $wikiDAO->getWikiById($wikiId);

        if (!$wiki) {

            header('Location: index.php?action=allwikis');
            exit();
        }

        include_once 'app/views/wiki/SingleWikiPage.php';
    }
    public function getAllTags()
    {
        // Display a list of wikis
        $wikis = $this->wikiDAO->getAllWikis();
        include 'app/views/wiki/crud/index.php';
    }

    public function create()
    {
        // Display the form to create a new wiki
        include 'app/views/wiki/crud/create.php';
    }

    public function store()
    {
        // Handle the submission of the create form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $userId = 1; // Replace with the actual user ID
            $categoryId = $_POST['category_id'];

            // Validate and sanitize input if needed

            // Create the wiki
            $success = $this->wikiDAO->createWiki($title, $content, $userId, $categoryId);

            if ($success) {
                // Redirect to the index page or show a success message
                header('Location: index.php?action=wikis');
                exit();
            } else {
                // Handle the case where the creation failed
                echo "Failed to create the wiki.";
            }
        }
    }

    public function edit($wikiId)
    {
        // Display the form to edit an existing wiki
        $wiki = $this->wikiDAO->getWikiById($wikiId);

        if (!$wiki) {
            // Handle the case where the wiki is not found
            echo "Wiki not found.";
            return;
        }

        include 'app/views/wiki/crud/edit.php';
    }

    public function update($wikiId)
    {
        // Handle the submission of the edit form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = $_POST['category_id'];

            // Validate and sanitize input if needed

            // Update the wiki
            $success = $this->wikiDAO->updateWiki($wikiId, $title, $content, $categoryId);

            if ($success) {
                // Redirect to the index page or show a success message
                header('Location: index.php?action=wikis');
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
            header('Location: index.php?action=wikis');
            exit();
        } else {
            // Handle the case where disabling failed
            echo "Failed to disable the wiki.";
        }
    }

}

?>