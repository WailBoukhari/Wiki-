<?php

include_once 'Database.php';

class DatabaseDAO
{
    protected $conn;

    public function __construct()
    {
        $dbConnection = new Database();
        $this->conn = $dbConnection->getConnection();
    }

    public function executeQuery($query, $params = [])
    {
        // $stmt = $this->conn->prepare($query);
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll($query, $params = [])
    {
        $stmt = $this->executeQuery($query, $params);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public function fetch($query, $params = [])
    {
        $stmt = $this->executeQuery($query, $params);
        return $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
    }

    public function execute($query, $params = [])
    {
        $stmt = $this->executeQuery($query, $params);
        return $stmt ? true : false;
    }
}