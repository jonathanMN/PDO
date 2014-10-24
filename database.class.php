<?php

class Database
{

    private $db_host = '127.0.0.1'; // Database Host
    private $db_user = 'root';      // Username
    private $db_pass = '';          // User Password
    private $db_name = 'pdo';       // Name of the Database

    public $conn;

    public function __construct()
    {
        try
        {
            $this->conn = new PDO("mysql:host=".$this->db_host.";dbname=".$this->db_name, $this->db_user, $this->db_pass);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

}