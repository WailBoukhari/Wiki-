<?php

class Auth
{
    private $id;
    private $username;
    private $email;
    private $passwordHash;
    private $role;

    public function __construct($id, $username, $email, $passwordHash, $role)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->role = $role;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    public function getRole()
    {
        return $this->role;
    }

}