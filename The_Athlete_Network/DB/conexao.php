<?php
class Database {
    private $host = "localhost";
    private $db_name = "atletas_db";
    private $username = "root";
    private $password = ""; 
    public $conn;

    public function connect() {
        if ($this->conn === null) { 
            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) { 
                echo 'Erro na conexão: ' . $e->getMessage(); 
            }
        }
        return $this->conn;
    }
}