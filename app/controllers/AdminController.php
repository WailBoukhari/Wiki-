<?php

class AdminController
{
    private $categoryDAO;
    private $tagDAO;
    private $wikiDAO;

    public function __construct()
    {
        $this->categoryDAO = new CategoryDAO();
        $this->tagDAO = new TagDAO();
        $this->wikiDAO = new WikiDAO();
    }

    public function index()
    {
        $categoryCount = $this->categoryDAO->getCategoryCount();
        $tagCount = $this->tagDAO->getTagCount();
        $wikiCount = $this->wikiDAO->getWikiCount();


        include_once 'app/views/admin/AdminPage.php';
    }
}

?>