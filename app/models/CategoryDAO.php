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

        $this->conn->beginTransaction();

        // Check if the category is associated with any wikis
        $queryCheckWikis = "SELECT COUNT(*) FROM wikis WHERE category_id = :categoryId";
        $paramsCheckWikis = [':categoryId' => $categoryId];
        $count = $this->fetchColumn($queryCheckWikis, $paramsCheckWikis);

        // Delete record from categories table
        $queryCategory = "DELETE FROM categories WHERE category_id = :categoryId";
        $paramsCategory = [':categoryId' => $categoryId];
        $this->execute($queryCategory, $paramsCategory);

        $this->conn->commit();

        return true;
    }
    public function getCategoryCount()
    {
        $query = "SELECT COUNT(*) as count FROM categories";
        $result = $this->fetch($query);

        return $result ? (object) ['count' => $result['count']] : (object) ['count' => 0];
    }

}