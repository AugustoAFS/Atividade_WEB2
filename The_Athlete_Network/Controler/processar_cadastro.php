<?php
require_once __DIR__ . '/../DB/conexao.php';
require_once __DIR__ . '/../Controler/CRUD.php';

$atleta = new Atleta();

function uploadFoto($file) {
    $target_dir = "../IMG/";
    $errors = array();
    $target_file = $target_dir . uniqid() . '_' . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        echo "O arquivo não é uma imagem.";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        echo "Desculpe, o arquivo já existe.";
        $uploadOk = 0;
    }

    if ($file["size"] > 500000) {
        echo "Desculpe, o arquivo é muito grande.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "Desculpe, apenas arquivos JPG, JPEG, PNG & GIF são permitidos.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $errors[] = "O upload da imagem falhou.";
        return array('success' => false, 'errors' => $errors); 
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return array('success' => true, 'file_path' => $target_file); 
        } else {
            $errors[] = "Erro ao mover o arquivo.";
            return array('success' => false, 'errors' => $errors); 
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'nome');
    $cpf = filter_input(INPUT_POST, 'cpf');
    $instituicao = filter_input(INPUT_POST, 'instituicao');
    $matricula = filter_input(INPUT_POST, 'matricula');
    $sexo = filter_input(INPUT_POST, 'sexo');
    $modalidades = $_POST['modalidades'] ?? [];
    $modalidades = is_array($modalidades) ? $modalidades : [$modalidades];
    $ouro = filter_input(INPUT_POST, 'ouro') ?: 0;
    $prata = filter_input(INPUT_POST, 'prata') ?: 0;
    $bronze = filter_input(INPUT_POST, 'bronze') ?: 0;
    $foto_perfil = ''; 

    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadFoto($_FILES['foto_perfil']);

        if ($uploadResult['success']) {
            $foto_perfil = $uploadResult['file_path']; 
        } else {
            echo "Erros de upload:<br>";
            foreach ($uploadResult['errors'] as $erro) {
                echo $erro . "<br>";
            }
        }
    }

    try {
        $atleta_id = $atleta->create(
            $nome, 
            $cpf, 
            $instituicao, 
            $matricula, 
            $sexo, 
            $modalidades,
            $foto_perfil, 
            $ouro, 
            $prata, 
            $bronze
        );

        if ($atleta_id) {
            header('Location: ../View/view_atletas.php'); 
        } else {
            echo "Erro ao cadastrar o atleta. Detalhes: ";
        }
    } catch (Exception $e) {
        echo 'Erro: ' . $e->getMessage();
    }
} else {
    echo "Método não suportado.";
}
