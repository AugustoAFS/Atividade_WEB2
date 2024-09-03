<?php
require_once 'CRUD.php'; 
require_once '../DB/conexao.php'; 

$atleta = new Atleta();

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $id = htmlspecialchars(trim($_POST['id'])); 
    if ($atleta->delete($id)) { 
        header("Location: ../View/view_atletas.php?msg=deleted"); 
    } else { 
        header("Location: ../View/view_atletas.php?msg=error");
    }
    exit(); 
} 