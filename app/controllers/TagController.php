<?php

include_once 'app/models/TagDAO.php';

class TagController
{
    private $tagDAO;

    public function __construct()
    {
        $this->tagDAO = new TagDAO();
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
            }

        }
    }

    public function edit()
    {
        $tagId = isset($_GET['id']) ? $_GET['id'] : null;
        $tag = $tagId ? $this->tagDAO->getTagById($tagId) : null;

        if ($tag) {
            include_once 'app/views/tag/crud/edit.php';
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
            }
        }
    }

    public function disable()
    {
        $tagId = isset($_GET['id']) ? $_GET['id'] : null;

        if ($tagId && $this->tagDAO->disableTag($tagId)) {
            header('Location: index.php?action=tag_table');
            exit();
        }
    }
}