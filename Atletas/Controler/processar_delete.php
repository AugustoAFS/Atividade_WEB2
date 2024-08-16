<?php
require_once '../DB/conexao.php';
require_once '../Controler/CRUD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $atleta = new Atleta();
    if ($atleta->delete($id)) {
        header("Location: ../View/view_atletas.php?msg=deleted");
        exit();
    } else {
        header("Location: ../View/view_atletas.php?msg=error");
        exit();
    }
}