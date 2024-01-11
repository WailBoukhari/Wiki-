<?php

class Wiki
{
    private $wiki_id;
    private $title;
    private $content;
    private $userId;
    private $categoryId;
    private $image;
    private $createdAt;
    private $isArchived;
    
    private $tags = [];

    public function __construct($wiki_id, $title, $content, $userId, $categoryId, $image, $createdAt, $isArchived)
    {
        $this->wiki_id = $wiki_id;
        $this->title = $title;
        $this->content = $content;
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        $this->image = $image;
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
    public function getImg()
    {
        return 'public/assets/img/' . $this->image;
    }
 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function isArchived()
    {
        return $this->isArchived;
    }

    public function getCategoryName()
    {
        $categoryDAO = new CategoryDAO();
        $category = $categoryDAO->getCategoryById($this->categoryId);

        return $category ? $category->getName() : null;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function getTags()
    {
        return $this->tags;
    }




    public function setImg($image)
    {
        $this->image = $image;
    }
}
?>