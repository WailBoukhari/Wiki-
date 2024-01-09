<?php

include_once 'app/models/TagDAO.php';

class TagController
{
    private $tagDAO;

    public function __construct()
    {
        $this->tagDAO = new TagDAO();
    }

    public function showTagPage($tagId)
    {
        $tag = $this->tagDAO->getTagById($tagId);

        if ($tag) {
            $wikis = $this->tagDAO->getWikisByTagId($tagId);
            include_once 'app/views/tag/TagPage.php';
        }
    }

    public function index()
    {
        $tags = $this->tagDAO->getAllTags();
        include_once 'app/views/tag/crud/index.php';
    }

    public function create()
    {
        include_once 'app/views/tag/crud/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            if ($this->tagDAO->createTag($name)) {
                header('Location: index.php?action=tag_table');
                exit();
            } else {
                // Handle the case where tag creation failed
                echo "Failed to create the tag.";
            }
        }
    }

    public function edit()
    {
        $tagId = isset($_GET['id']) ? $_GET['id'] : null;
        $tag = $tagId ? $this->tagDAO->getTagById($tagId) : null;

        if ($tag) {
            include_once 'app/views/tag/crud/edit.php';
        } else {
            // Handle the case where tag is not found
            echo "Tag not found.";
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tagId = $_POST['tag_id'];
            $name = $_POST['name'];

            if ($this->tagDAO->updateTag($tagId, $name)) {
                header('Location: index.php?action=tag_table');
                exit();
            } else {
                // Handle the case where tag update failed
                echo "Failed to update the tag.";
            }
        }
    }


    public function delete($tagId)
    {
        $tag = $this->tagDAO->getTagById($tagId);

        if ($tag) {
            include_once 'app/views/tag/crud/delete.php';
        } else {
            // Handle the case where the tag is not found
            echo "Tag not found.";
        }
    }

    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tagId = $_POST['tag_id'];

            $success = $this->tagDAO->deleteTag($tagId);

            if ($success) {
                // Redirect to the index page or show a success message
                header('Location: index.php?action=tag_table');
                exit();
            } else {
                // Handle the case where disabling failed
                echo "Failed to disable the tag.";
            }
        }
    }

    // ...

}
?>