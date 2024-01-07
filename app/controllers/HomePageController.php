<?php
class HomePageController
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

    public function index()
    {
        // Get latest wikis
        $latestWikis = $this->wikiDAO->getLatestWikis();
        // Get latest categories
        $latestCategories = $this->categoryDAO->getLatestCategories();
        // Get latest tags
        $latestTags = $this->tagDAO->getLatestTags();
        include "app/views/homePage.php";
    }

}