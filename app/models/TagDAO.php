<?php

include_once 'DatabaseDAO.php';
include_once 'Tag.php';

class TagDAO extends DatabaseDAO
{
    public function getAllTags()
    {
        $query = "SELECT * FROM tags";
        $results = $this->fetchAll($query);

        $tags = [];
        foreach ($results as $result) {
            $tags[] = new Tag(
                $result['tag_id'],
                $result['name'],
                $result['created_at']
            );
        }

        return $tags;
    }


    public function getLatestTags($limit = 5)
    {
        $query = "SELECT * FROM tags ORDER BY created_at DESC LIMIT " . (int) $limit;

        $tagsData = $this->fetchAll($query);

        $tags = [];
        foreach ($tagsData as $tagData) {
            $tags[] = new Category(
                $tagData['tag_id'],
                $tagData['name'],
                $tagData['created_at']
            );
        }

        return $tags;
    }
    public function getTagById($tagId)
    {
        $query = "SELECT * FROM tags WHERE tag_id = :tagId";
        $params = [':tagId' => $tagId];
        $result = $this->fetch($query, $params);

        if ($result) {
            return new Tag(
                $result['tag_id'],
                $result['name'],
                $result['created_at']
            );
        }
        return null;
    }
    public function getWikisByTagId($tagId)
    {
        $query = "SELECT w.* FROM wikis w
                  INNER JOIN wiki_tags wt ON w.wiki_id = wt.wiki_id
                  WHERE wt.tag_id = :tagId";
        $params = [':tagId' => $tagId];

        $wikisData = $this->fetchAll($query, $params);

        $wikis = [];
        foreach ($wikisData as $wikiData) {
            $wikis[] = new Wiki(
                $wikiData['wiki_id'],
                $wikiData['title'],
                $wikiData['content'],
                $wikiData['user_id'],
                $wikiData['category_id'],
                $wikiData['created_at'],
                $wikiData['is_archived']
            );
        }

        return $wikis;
    }


    public function createTag($name)
    {
        $query = "INSERT INTO tags (name) VALUES (:name)";
        $params = [':name' => $name];

        return $this->execute($query, $params);
    }

    public function updateTag($tagId, $name)
    {
        $query = "UPDATE tags SET name = :name WHERE tag_id = :tagId";
        $params = [
            ':name' => $name,
            ':tagId' => $tagId
        ];

        return $this->execute($query, $params);
    }

    public function disableTag($tagId)
    {
        $query = "UPDATE tags SET is_disabled = 1 WHERE tag_id = :tagId";
        $params = [':tagId' => $tagId];

        return $this->execute($query, $params);
    }
}