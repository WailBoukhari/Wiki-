<?php

class Wiki
{
    private $wiki_id;
    private $title;
    private $content;
    private $userId;
    private $categoryId;
    private $createdAt;
    private $isArchived;

    public function __construct($wiki_id, $title, $content, $userId, $categoryId, $createdAt, $isArchived)
    {
        $this->wiki_id = $wiki_id;
        $this->title = $title;
        $this->content = $content;
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        $this->createdAt = $createdAt;
        $this->isArchived = $isArchived;
    }

    public function getId()
    {
        return $this->wiki_id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function isArchived()
    {
        return $this->isArchived;
    }
    public function getLatestWikis($limit = 5)
    {
        $wikiDAO = new WikiDAO();
        $latestWikis = $wikiDAO->getLatestWikis($limit);

        // Add the following debug statements
        var_dump($latestWikis);
        exit();

        // Rest of your code
    }
}
?>