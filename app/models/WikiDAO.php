<?php
include_once 'DatabaseDAO.php';
include_once 'Wiki.php';

class WikiDAO extends DatabaseDAO
{
    public function getAllWikis()
    {
        $query = "SELECT * FROM wikis";
        $results = $this->fetchAll($query);

        $wikis = [];
        foreach ($results as $result) {
            $wikis[] = $this->createWikiFromData($result);
        }

        return $wikis;
    }

    public function createWiki($title, $content, $userId, $categoryId)
    {
        $query = "INSERT INTO wikis (title, content, user_id, category_id) VALUES (:title, :content, :userId, :categoryId)";
        $params = [
            ':title' => $title,
            ':content' => $content,
            ':userId' => $userId,
            ':categoryId' => $categoryId,
        ];

        return $this->execute($query, $params);
    }

    public function getWikiById($wikiId)
    {
        $query = "SELECT * FROM wikis WHERE wiki_id = :wikiId";
        $params = [':wikiId' => $wikiId];
        $result = $this->fetch($query, $params);

        return $result ? $this->createWikiFromData($result) : null;
    }

    public function getLatestWikis($limit = 5)
    {
        $query = "SELECT * FROM wikis ORDER BY created_at DESC LIMIT 5" . (int) $limit;
        $wikisData = $this->fetchAll($query);

        $wikis = [];
        foreach ($wikisData as $wikiData) {
            $wikis[] = $this->createWikiFromData($wikiData);
        }

        return $wikis;
    }

    public function getWikisByCategoryId($categoryId)
    {
        $query = "SELECT * FROM wikis WHERE category_id = :categoryId";
        $params = [':categoryId' => $categoryId];
        $results = $this->fetchAll($query, $params);

        $wikis = [];
        foreach ($results as $result) {
            $wikis[] = new Wiki(
                $result['wiki_id'],
                $result['title'],
                $result['content'],
                $result['user_id'],
                $result['category_id'],
                $result['created_at'],
                $result['is_archived']
            );
        }

        return $wikis;
    }
    private function createWikiFromData($data)
    {
        return new Wiki(
            $data['wiki_id'],
            $data['title'],
            $data['content'],
            $data['user_id'],
            $data['category_id'],
            $data['created_at'],
            $data['is_archived']
        );
    }
    public function updateWiki($wikiId, $title, $content, $categoryId)
    {
        $query = "UPDATE wikis SET title = :title, content = :content, category_id = :categoryId WHERE wiki_id = :wikiId";
        $params = [
            ':wikiId' => $wikiId,
            ':title' => $title,
            ':content' => $content,
            ':categoryId' => $categoryId,
        ];

        return $this->execute($query, $params);
    }

    public function disableWiki($wikiId)
    {
        // Implement soft delete or update status based on your design
        $query = "UPDATE wikis SET is_archived = 1 WHERE wiki_id = :wikiId";
        $params = [':wikiId' => $wikiId];

        return $this->execute($query, $params);
    }
}