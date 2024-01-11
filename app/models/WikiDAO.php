<?php
include_once 'DatabaseDAO.php';
include_once 'Wiki.php';

class WikiDAO extends DatabaseDAO
{
    public function getAllWikis()
    {
        $query = "SELECT * FROM wikis WHERE is_archived = 0";
        $results = $this->fetchAll($query);

        $wikis = [];
        foreach ($results as $result) {
            $wikis[] = new Wiki(
                $result['wiki_id'],
                $result['title'],
                $result['content'],
                $result['user_id'],
                $result['category_id'],
                $result['image'],
                $result['created_at'],
                $result['is_archived']
            );
        }

        return $wikis;
    }
    public function getWikiById($wikiId)
    {
        $query = "SELECT * FROM wikis WHERE wiki_id = :wikiId";
        $params = [':wikiId' => $wikiId];
        $result = $this->fetch($query, $params);

        return $result ? new Wiki(
            $result['wiki_id'],
            $result['title'],
            $result['content'],
            $result['user_id'],
            $result['category_id'],
            $result['image'],
            $result['created_at'],
            $result['is_archived']
        ) : null;
    }
    public function getWikiByIdWithTags($wikiId)
    {
        $query = "SELECT * FROM wikis WHERE wiki_id = :wikiId AND is_archived = 0";
        $params = [':wikiId' => $wikiId];
        $result = $this->fetch($query, $params);

        if ($result) {
            $wiki = new Wiki(
                $result['wiki_id'],
                $result['title'],
                $result['content'],
                $result['user_id'],
                $result['category_id'],
                $result['image'],
                $result['created_at'],
                $result['is_archived']
            );

            // Get tags associated with the wiki
            $tags = $this->getTagsByWikiId($result['wiki_id']);
            $wiki->setTags($tags);

            return $wiki;
        }

        return null;
    }
    public function getWikiImage($wikiId)
    {
        $query = "SELECT image FROM wikis WHERE wiki_id = :wikiId";
        $params = [':wikiId' => $wikiId];

        $result = $this->fetch($query, $params);

        return $result ? $result['image'] : null;
    }
    public function getAllWikisForCrud()
    {
        $query = "SELECT w.*, u.username FROM wikis w
                  JOIN users u ON w.user_id = u.user_id";
        $results = $this->fetchAll($query);

        $wikis = [];
        foreach ($results as $result) {
            $wiki = new Wiki(
                $result['wiki_id'],
                $result['title'],
                $result['content'],
                $result['username'],
                $result['category_id'],
                $result['image'],
                $result['created_at'],
                $result['is_archived']
            );

            $tags = $this->getTagsByWikiId($result['wiki_id']);
            $wiki->setTags($tags);

            $wikis[] = $wiki;
        }

        return $wikis;
    }
    public function getAllWikisForCrudByUserId($userID)
    {   var_dump($userID);
        $query = "SELECT w.*, u.username FROM wikis w
        JOIN users u ON w.user_id = u.user_id WHERE w.user_id = :user_id";
        $params = [':user_id' => $userID];
        $results = $this->fetchAll($query,$params);
        $wikis = [];
        foreach ($results as $result) {
            $wiki = new Wiki(
                $result['wiki_id'],
                $result['title'],
                $result['content'],
                $result['username'],
                $result['category_id'],
                $result['image'],
                $result['created_at'],
                $result['is_archived']
            );

            $tags = $this->getTagsByWikiId($result['wiki_id']);
            $wiki->setTags($tags);

            $wikis[] = $wiki;
        }

        return $wikis;
    }
    public function getTagsByWikiId($wikiId)
    {
        $query = "SELECT t.* FROM tags t
                  JOIN wiki_tags wt ON t.tag_id = wt.tag_id
                  WHERE wt.wiki_id = :wikiId";
        $params = [':wikiId' => $wikiId];
        $results = $this->fetchAll($query, $params);

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
                $result['image'],
                $result['created_at'],
                $result['is_archived']
            );
        }

        return $wikis;
    }

    public function getLatestWikis($limit = 5)
    {
        $query = "SELECT * FROM wikis WHERE is_archived = 0 ORDER BY created_at DESC LIMIT " . (int) $limit;
        $wikisData = $this->fetchAll($query);

        $wikis = [];
        foreach ($wikisData as $wikiData) {
            $wikis[] = new Wiki(
                $wikiData['wiki_id'],
                $wikiData['title'],
                $wikiData['content'],
                $wikiData['user_id'],
                $wikiData['category_id'],
                $wikiData['image'],
                $wikiData['created_at'],
                $wikiData['is_archived']
            );
        }

        return $wikis;
    }
    public function createWiki($title, $content, $userId, $categoryId, $tagIds, $imagePath)
    {
        // Insert the wiki without tags first
        $query = "INSERT INTO wikis (title, content, user_id, category_id, image) VALUES (:title, :content, :userId, :categoryId, :image)";
        $params = [
            ':title' => $title,
            ':content' => $content,
            ':userId' => $userId,
            ':categoryId' => $categoryId,
            ':image' => $imagePath,
        ];

        $success = $this->execute($query, $params);

        if ($success) {
            // Get the last inserted wiki_id
            $wikiId = $this->conn->lastInsertId();

            // Insert tags for the wiki into wiki_tags table
            $this->insertWikiTags($wikiId, $tagIds);
        }

        return $success;
    }

    public function updateWiki($wikiId, $title, $content, $categoryId, $tagIds, $imagePath)
    {
        // Update the wiki information, including image
        $query = "UPDATE wikis SET title = :title, content = :content, category_id = :categoryId, image = :imagePath, created_at = CURRENT_TIMESTAMP WHERE wiki_id = :wikiId";
        $params = [
            ':wikiId' => $wikiId,
            ':title' => $title,
            ':content' => $content,
            ':categoryId' => $categoryId,
            ':imagePath' => $imagePath, // Add image path to the update query
        ];
    
        $success = $this->execute($query, $params);
    
        if ($success) {
            // Delete existing tags for the wiki
            $this->deleteWikiTags($wikiId);
    
            // Insert new tags for the wiki into wiki_tags table
            $this->insertWikiTags($wikiId, $tagIds);
        }
    
        return $success;
    }


    private function insertWikiTags($wikiId, $tagIds)
    {
        foreach ($tagIds as $tagId) {
            $query = "INSERT INTO wiki_tags (wiki_id, tag_id) VALUES (:wikiId, :tagId)";
            $params = [
                ':wikiId' => $wikiId,
                ':tagId' => $tagId,
            ];

            $this->execute($query, $params);
        }
    }
    private function deleteWikiTags($wikiId)
    {
        // Delete existing tags for the wiki
        $query = "DELETE FROM wiki_tags WHERE wiki_id = :wikiId";
        $params = [':wikiId' => $wikiId];

        $this->execute($query, $params);
    }

    public function disableWiki($wikiId)
    {
        // Implement soft delete or update status based on your design
        $query = "UPDATE wikis SET is_archived = 1 WHERE wiki_id = :wikiId";
        $params = [':wikiId' => $wikiId];

        return $this->execute($query, $params);
    }
    public function enableWiki($wikiId)
    {
        // Implement soft delete or update status based on your design
        $query = "UPDATE wikis SET is_archived = 0 WHERE wiki_id = :wikiId";
        $params = [':wikiId' => $wikiId];

        return $this->execute($query, $params);
    }

    public function deleteWiki($wikiId)
    {
        $this->conn->beginTransaction();

        // Delete records from wiki_tags table
        $queryWikiTags = "DELETE FROM wiki_tags WHERE wiki_id = :wikiId";
        $paramsWikiTags = [':wikiId' => $wikiId];
        $this->execute($queryWikiTags, $paramsWikiTags);

        // Delete record from wikis table
        $queryWiki = "DELETE FROM wikis WHERE wiki_id = :wikiId";
        $paramsWiki = [':wikiId' => $wikiId];
        $this->execute($queryWiki, $paramsWiki);

        $this->conn->commit();

        return true;

    }
    public function getWikiCount()
    {
        $query = "SELECT COUNT(*) as count FROM wikis";
        $result = $this->fetch($query);

        return $result ? (object) ['count' => $result['count']] : (object) ['count' => 0];
    }
    public function liveSearchWiki($query)
    {
        $query = "SELECT * FROM wikis WHERE title LIKE :query LIMIT 5";
        $params = [':query' => '%' . $query . '%'];
        $results = $this->fetchAll($query, $params);

        return $results;
    }
    public function searchWikisByQuery($query)
    {
        $query1 = "%$query%";

        $query = "SELECT DISTINCT w.* FROM wikis w
                   JOIN categories c ON w.category_id = c.category_id
                   JOIN wiki_tags wt ON w.wiki_id = wt.wiki_id
                JOIN tags t ON wt.tag_id = t.tag_id
                  WHERE w.title LIKE :query OR
                         c.name LIKE :query OR
                         t.name LIKE :query
                  AND w.is_archived = 0";

        $params = [':query' => $query1];
        $results = $this->fetchAll($query, $params);

        $wikis = [];
        foreach ($results as $result) {
            $wikis[] = new Wiki(
                $result['wiki_id'],
                $result['title'],
                $result['content'],
                $result['user_id'],
                $result['category_id'],
                $result['image'],
                $result['created_at'],
                $result['is_archived']
            );
        }

        return $wikis;
    }

    // public function searchWikisByQuery($query)
    // {
    //     // Log or echo out the query for debugging
    //     echo ("Performing live search with query: $query");

    //     // Assuming your search logic here...
    //     $results = $this->searchWikisByQuery($query);

    //     // Log or echo out the results for debugging
    //     echo ("Search results: " . print_r($results, true));

    //     return $results;
    // }
}