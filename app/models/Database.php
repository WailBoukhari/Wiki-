<?php
class Database
{
    private $host;
    private $dbname;
    private $username;
    private $password;


    public function __construct(
        $host = "localhost",
        $dbname = "wiki",
        $username = "root",
        $password = "",

    ) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;

    }

    public function getConnection()
    {
        try {
            $conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }
}