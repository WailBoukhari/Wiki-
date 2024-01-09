<?php

include_once 'DatabaseDAO.php';
include_once 'Category.php';

class CategoryDAO extends DatabaseDAO
{
    public function getAllCategories()
    {
        $query = "SELECT * FROM categories";
        $results = $this->fetchAll($query);

        $tags = [];
        foreach ($results as $result) {
            $tags[] = new Tag(
                $result['category_id'],
                $result['name'],
                $result['created_at']
            );
        }

        return $tags;
    }
    public function getAllCategoriesForCrud()
    {
        $query = "SELECT * FROM categories";
        $results = $this->fetchAll($query);

        $tags = [];
        foreach ($results as $result) {
            $tags[] = new Tag(
                $result['category_id'],
                $result['name'],
                $result['created_at']
            );
        }

        return $tags;
    }
    public function getLatestCategories($limit = 5)
    {
        $query = "SELECT * FROM categories ORDER BY created_at DESC LIMIT " . (int) $limit;

        $categoriesData = $this->fetchAll($query);

        $categories = [];
        foreach ($categoriesData as $categoryData) {
            $categories[] = new Category(
                $categoryData['category_id'],
                $categoryData['name'],
                $categoryData['created_at']
            );
        }

        return $categories;
    }
    public function getCategoryById($categoryId)
    {
        $query = "SELECT * FROM categories WHERE category_id = :categoryId";
        $params = [':categoryId' => $categoryId];
        $result = $this->fetch($query, $params);

        if ($result) {
            return new Category(
                $result['category_id'],
                $result['name'],
                $result['created_at']
            );
        }
        return null;
    }
    public function createCategory($name)
    {
        $query = "INSERT INTO categories (name) VALUES (:name)";
        $params = [':name' => $name];

        return $this->execute($query, $params);
    }

    public function updateCategory($categoryId, $name)
    {
        $query = "UPDATE categories SET name = :name WHERE category_id = :categoryId";
        $params = [
            ':name' => $name,
            ':categoryId' => $categoryId
        ];

        return $this->execute($query, $params);
    }

    public function deleteCategory($categoryId)
    {

        try {
            // Your existing code to delete the category
            $query = "DELETE FROM categories WHERE category_id = :categoryId";
            $params = [':categoryId' => $categoryId];
            $this->execute($query, $params);

            return ['success' => true, 'message' => 'Category deleted successfully'];
        } catch (PDOException $e) {

            if ($e->errorInfo[1] == 1451) {
                return ['success' => false, 'message' => 'Cannot delete the category as it is associated with wikis.'];
            }
        }
    }
    public function getCategoryCount()
    {
        $query = "SELECT COUNT(*) as count FROM categories";
        $result = $this->fetch($query);

        return $result ? (object) ['count' => $result['count']] : (object) ['count' => 0];
    }

}