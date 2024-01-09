<?php

class AuthController
{
    private $authDAO;

    public function __construct()
    {
        $this->authDAO = new AuthDAO();
    }

    public function showLoginForm()
    {
        include_once 'app/views/auth/login.php';
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = $this->authDAO->login($email, $password);

            if ($result['success']) {
                // Get user information, including the role and user_id
                $user = $this->authDAO->getUserByEmail($email);

                $_SESSION['user_id'] = $user->getId();  // Assuming getId() is the method to retrieve the user_id
                $_SESSION['user'] = $user;
                if (isset($_SESSION['user'])) {
                    $role = $_SESSION['user']->getRole();

                    switch ($role) {
                        case 'Admin':
                            header('Location: index.php?action=admin');
                            break;
                        case 'Author':
                            header('Location: index.php?action=author');

                            break;
                        default:
                            header('Location: index.php?action=home');
                            break;

                    }
                }

            } else {
                // Login failed, display error message
                $errorMessage = $result['message'];
                include_once 'app/views/auth/login.php';

            }
        }
    }
    public function showregisterForm()
    {
        include_once 'app/views/auth/register.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = $this->authDAO->registerUser($username, $email, $password);

            if ($result['success']) {
                // Registration successful, redirect to login page
                header('Location: index.php?action=login');
                exit();
            } else {
                // Registration failed, display error message
                $errorMessage = $result['message'];
                include_once 'app/views/auth/register.php';
            }
        }
    }

    public function logout()
    {
        // Unset all session variables
        $_SESSION = array();
        // Destroy the session
        session_destroy();
        // Redirect to the login page
        header("Location: index.php?action=login");
        exit();
    }
}

?>