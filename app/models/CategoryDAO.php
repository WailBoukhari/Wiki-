<?php

include_once 'DatabaseDAO.php';
include_once 'Category.php';

class CategoryDAO extends DatabaseDAO
{
    public function getAllCategories()
    {
        $query = "SELECT * FROM categories";
        return $this->fetchAll($query);
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
        $params = [':categoryId' => $categoryId, ':name' => $name];

        return $this->execute($query, $params);
    }

    public function disableCategory($categoryId)
    {
        $query = "UPDATE categories SET is_disabled = 1 WHERE category_id = :categoryId";
        $params = [':categoryId' => $categoryId];

        return $this->execute($query, $params);
    }
}