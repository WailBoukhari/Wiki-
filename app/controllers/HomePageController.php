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
        $wikis = $this->wikiDAO->getAllWikis();
        // Get latest wikis
        $latestWikis = $this->wikiDAO->getLatestWikis();
        // Get latest categories
        $latestCategories = $this->categoryDAO->getLatestCategories();
        // Get latest tags
        $latestTags = $this->tagDAO->getLatestTags();

        
        include "app/views/HomePage.php";
    }

    public function liveSearch()
    {
        // die('Reached liveSearch'); // Add this line
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $wikiDAO = new WikiDAO();
        if ($query != 0) {
            
            $results = $wikiDAO->searchWikisByQuery($query);
            }else{
            $results = $wikiDAO->getAllWikis();

        
            }
            ob_start();
            include 'app/views/liveSearchResults.php'; // This is the page to display live search results
            $content = ob_get_clean();

            echo $content;
        
    }

}