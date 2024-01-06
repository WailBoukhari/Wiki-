<?php

include_once __DIR__ . '/app/models/Database.php';
include_once __DIR__ . '/app/models/DatabaseDAO.php';
include_once __DIR__ . '/app/models/Auth.php';
include_once __DIR__ . '/app/models/AuthDAO.php';
include_once __DIR__ . '/app/controllers/AuthController.php';
include_once __DIR__ . '/app/controllers/HomePageController.php';
session_start();
// Routing.
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'home':
            $controller = new HomePageController;
            $controller->index();
            break;
        case 'search':
            $controller = new SearchController;
            $controller->index();
            break;
        case 'login':
            $controller = new AuthController;
            $controller->showLoginForm();
            break;
        case 'register':
            $controller = new AuthController;
            $controller->showregisterForm();
            break;
        case 'login_execute':
            $controller = new AuthController;
            $controller->login();
            break;
        case 'register_store':
            $controller = new AuthController;
            $controller->register();
            break;
        case 'logout':
            $controller = new AuthController;
            $controller->logout();
            break;
        default:
            $controller = new HomePageController;
            $controller->index();
            break;
    }
} else {
    $controller = new HomePageController;
    $controller->index();
}