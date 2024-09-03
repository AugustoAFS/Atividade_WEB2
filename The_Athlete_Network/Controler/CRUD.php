<?php
require_once __DIR__ . '/../DB/conexao.php';

class Atleta {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function create($nome, $cpf, $instituicao, $matricula, $sexo, $modalidades, $foto_perfil, $ouro = 0, $prata = 0, $bronze = 0) {
        $stmt = $this->conn->prepare("INSERT INTO atleta (nome, cpf, instituicao, matricula, sexo, foto_perfil, ouro, prata, bronze) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
        if ($stmt->execute([$nome, $cpf, $instituicao, $matricula, $sexo, $foto_perfil, $ouro, $prata, $bronze])) {
            $atleta_id = $this->conn->lastInsertId();
            foreach ($modalidades as $modalidade_nome) {
                $modalidade_id = $this->getModalidadeIdByName($modalidade_nome);
                if ($modalidade_id) {
                    $this->addModalidade($atleta_id, $modalidade_id);
                } else {
                    throw new Exception("Modalidade '$modalidade_nome' não encontrada!");
                }
            }
            return $atleta_id;
        }
        return false;
    }
    
    public function read() {
        $sql = "SELECT a.*, GROUP_CONCAT(m.nome SEPARATOR ', ') AS modalidades 
                FROM atleta a 
                LEFT JOIN atleta_modalidade am ON a.id = am.atleta_id
                LEFT JOIN modalidade m ON am.modalidade_id = m.id 
                GROUP BY a.id"; 
    
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM atleta WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } 

    public function update($id, $nome, $cpf, $instituicao, $matricula, $sexo, $modalidades, $foto_perfil, $ouro = 0, $prata = 0, $bronze = 0) {
        $stmt = $this->conn->prepare("UPDATE atleta SET nome = ?, cpf = ?, instituicao = ?, matricula = ?, sexo = ?, foto_perfil = ?, ouro = ?, prata = ?, bronze = ? WHERE id = ?");
        if ($stmt->execute([$nome, $cpf, $instituicao, $matricula, $sexo, $foto_perfil, $ouro, $prata, $bronze, $id])) {
            $this->conn->prepare("DELETE FROM atleta_modalidade WHERE atleta_id = ?")->execute([$id]);
            foreach ($modalidades as $modalidade_nome) {
                $modalidade_id = $this->getModalidadeIdByName($modalidade_nome);
                if ($modalidade_id) {
                    $this->addModalidade($id, $modalidade_id);
                } else {
                    throw new Exception("Modalidade '$modalidade_nome' não encontrada!");
                }
            }
            return true;
        } else {
            return false;
        }
    }
    
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM atleta WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function addModalidade($atleta_id, $modalidade_id) {
        $stmt = $this->conn->prepare("SELECT 1 FROM atleta_modalidade WHERE atleta_id = ? AND modalidade_id = ?");
        $stmt->execute([$atleta_id, $modalidade_id]);

        if ($stmt->fetchColumn()) {
            return true;
        }

        $stmt = $this->conn->prepare("INSERT INTO atleta_modalidade (atleta_id, modalidade_id) VALUES (?, ?)");
        return $stmt->execute([$atleta_id, $modalidade_id]);
    }

    public function updateModalidades($atleta_id, $novas_modalidades) {
        $stmt = $this->conn->prepare("DELETE FROM atleta_modalidade WHERE atleta_id = ?");
        $stmt->execute([$atleta_id]);
    
        foreach ($novas_modalidades as $modalidade_id) {
            $this->addModalidade($atleta_id, $modalidade_id);
        }
    }
    
    public function readTopAthletes() {
        $pesoOuro = 3;
        $pesoPrata = 2;
        $pesoBronze = 1;
        
        $sql = "
            SELECT 
                a.id, 
                a.nome, 
                a.foto_perfil, 
                GROUP_CONCAT(m.nome SEPARATOR ', ') AS modalidades,
                (a.ouro * :pesoOuro + a.prata * :pesoPrata + a.bronze * :pesoBronze) AS pontuacao
            FROM atleta a
            LEFT JOIN atleta_modalidade am ON a.id = am.atleta_id
            LEFT JOIN modalidade m ON am.modalidade_id = m.id
            GROUP BY a.id
            ORDER BY pontuacao DESC
            LIMIT 10
        ";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':pesoOuro', $pesoOuro, PDO::PARAM_INT);
        $stmt->bindParam(':pesoPrata', $pesoPrata, PDO::PARAM_INT);
        $stmt->bindParam(':pesoBronze', $pesoBronze, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    function getModalidadeIdByName($modalidade_nome) {
        $stmt = $this->conn->prepare("SELECT id FROM modalidade WHERE nome = ?");
        $stmt->execute([$modalidade_nome]);
        $modalidade_id = $stmt->fetchColumn();

        if (!$modalidade_id) {
            $stmt = $this->conn->prepare("INSERT INTO modalidade (nome) VALUES (?)");
            $stmt->execute([$modalidade_nome]);
            $modalidade_id = $this->conn->lastInsertId();
        }
    
        return $modalidade_id;
    }

    public function getModalidadesByAtletaId($atleta_id) {
        $sql = "SELECT m.nome
                FROM modalidade m
                JOIN atleta_modalidade am ON m.id = am.modalidade_id 
                WHERE am.atleta_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$atleta_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}