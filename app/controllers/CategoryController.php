<?php

class CategoryController
{
    private $categoryDAO;

    public function __construct()
    {
        $this->categoryDAO = new CategoryDAO();
    }

    public function showLatestCategories($limit)
    {
        $latestCategories = $this->categoryDAO->getLatestCategories($limit);

        include_once 'app/views/category/LatestCategoriesPage.php';
    }

    public function showAllCategories()
    {
        $allCategories = $this->categoryDAO->getAllCategories();

        include_once 'app/views/category/AllCategoriesPage.php';
    }

    // In your CategoryController or wherever you are handling the category page
    public function showCategoryPage($categoryId)
    {
        // Assuming you have a method in CategoryDAO to get a category by ID
        $categoryDAO = new CategoryDAO(); // Adjust this based on your actual class instantiation
        $category = $categoryDAO->getCategoryById($categoryId);

        // Assuming you have a method in WikiDAO to get related wikis by category ID
        $wikiDAO = new WikiDAO(); // Adjust this based on your actual class instantiation
        $relatedWikis = $wikiDAO->getWikisByCategoryId($categoryId);

        // Pass the variables to the view
        include_once 'app/views/category/CategoryPage.php';
    }
    public function index()
    {
        $categories = $this->categoryDAO->getAllCategories();
        include_once 'app/views/category/crud/index.php';
    }

    public function create()
    {
        include_once 'app/views/category/crud/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            if ($this->categoryDAO->createCategory($name)) {
                header('Location: index.php?action=category_table');
                exit();
            }
            // Handle category creation failure
            // You might want to redirect to an error page or show a message
        }
    }

    public function edit()
    {
        $categoryId = isset($_GET['id']) ? $_GET['id'] : null;
        $category = $categoryId ? $this->categoryDAO->getCategoryById($categoryId) : null;

        if ($category) {
            include_once 'app/views/category/crud/edit.php';
        }
        // Handle category not found or ID not provided
        // You might want to redirect to an error page or show a message
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryId = $_POST['category_id'];
            $name = $_POST['name'];

            if ($this->categoryDAO->updateCategory($categoryId, $name)) {
                header('Location: index.php?action=category_table');
                exit();
            }
            // Handle category update failure
            // You might want to redirect to an error page or show a message
        }
    }
    public function delete()
    {
        $categoryId = isset($_GET['id']) ? $_GET['id'] : null;
        $category = $categoryId ? $this->categoryDAO->getCategoryById($categoryId) : null;

        if ($category) {
            include_once 'app/views/category/crud/delete.php';
        } else {
            // Handle the case where the category is not found
            echo "Category not found.";
        }
    }

    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryId = $_POST['category_id'];

            $result = $this->categoryDAO->deleteCategory($categoryId);

            if ($result['success']) {
                // Redirect to the index page or show a success message
                header('Location: index.php?action=category_table');
                exit();
            } else {
                // Redirect to the index page with an alert message
                header('Location: index.php?action=category_table&error=' . urlencode($result['message']));
                exit();
            }
        }
    }

}