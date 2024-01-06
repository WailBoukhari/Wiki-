<?php

include_once 'DatabaseDAO.php';
include_once 'Auth.php';

class AuthDAO extends DatabaseDAO
{
    public function login($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $params = [':email' => $email];
        $result = $this->fetch($query, $params);

        if ($result) {
            $passwordHash = $result['password_hash'];
            if (password_verify($password, $passwordHash)) {
                // Password is correct, return user information including role
                return [
                    'success' => true,
                    'user' => new Auth(
                        $result['user_id'],
                        $result['username'],
                        $result['email'],
                        $passwordHash,
                        $result['role']
                    )
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Invalid email or password'
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Invalid email or password'
            ];
        }
    }


    public function registerUser($username, $email, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (username, email, password_hash, role) VALUES (:username, :email, :passwordHash, 'Author')";
        $params = [
            ':username' => $username,
            ':email' => $email,
            ':passwordHash' => $passwordHash
        ];

        $success = $this->execute($query, $params);

        if ($success) {
            return [
                'success' => true,
                'message' => 'Registration successful'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Registration failed'
            ];
        }
    }
    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $params = [':email' => $email];
        $result = $this->fetch($query, $params);

        if ($result) {
            return new Auth(
                $result['user_id'],
                $result['username'],
                $result['email'],
                $result['password_hash'],
                $result['role']
            );
        }
        return null;
    }
}
?>