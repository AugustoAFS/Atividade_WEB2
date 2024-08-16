<?php
require_once '../DB/conexao.php';

class Atleta {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Create
    public function create($nome, $instituicao, $rg, $matricula, $sexo, $modalidades, $foto_perfil) {
        try {
            $sql = "INSERT INTO atletas (nome, instituicao, rg, matricula, sexo, modalidades, foto_perfil) 
                    VALUES (:nome, :instituicao, :rg, :matricula, :sexo, :modalidades, :foto_perfil)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':instituicao', $instituicao);
            $stmt->bindParam(':rg', $rg);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':modalidades', $modalidades);
            $stmt->bindParam(':foto_perfil', $foto_perfil);
            return $stmt->execute();
        } catch(PDOException $e) {
            echo "Create error: " . $e->getMessage();
        }
    }

    // Read
    public function read() {
        try {
            $sql = "SELECT * FROM atletas";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Read error: " . $e->getMessage();
        }
    }

    public function readById($id) {
        try {
            $sql = "SELECT * FROM atletas WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Read by ID error: " . $e->getMessage();
        }
    }

    // Update
    public function update($id, $nome, $instituicao, $rg, $matricula, $sexo, $modalidades, $foto_perfil) {
        try {
            $sql = "UPDATE atletas SET nome = :nome, instituicao = :instituicao, rg = :rg, 
                    matricula = :matricula, sexo = :sexo, modalidades = :modalidades, 
                    foto_perfil = :foto_perfil WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':instituicao', $instituicao);
            $stmt->bindParam(':rg', $rg);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':modalidades', $modalidades);
            $stmt->bindParam(':foto_perfil', $foto_perfil);
            return $stmt->execute();
        } catch(PDOException $e) {
            echo "Update error: " . $e->getMessage();
        }
    }

    // Delete
    public function delete($id) {
        try {
            $sql = "DELETE FROM atletas WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch(PDOException $e) {
            echo "Delete error: " . $e->getMessage();
        }
    }
}