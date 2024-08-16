<?php
require_once 'CRUD.php';
require_once '../DB/conexao.php';


$atleta = new Atleta();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['Nome'];
    $instituicao = $_POST['instituicao'];
    $rg = $_POST['RG'];
    $matricula = $_POST['Matricula'];
    $sexo = $_POST['sexo'];
    $modalidades = isset($_POST['modalidades']) ? implode(", ", $_POST['modalidades']) : '';

    // Diretório para upload
    $_UP['pasta'] = '../IMG/';

    // Verifica se o diretório de upload existe, se não, cria
    if (!is_dir($_UP['pasta'])) {
        mkdir($_UP['pasta'], 0777, true);
    }

    // Tratamento do upload de foto de perfil
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto_perfil']['tmp_name'];
        $fileName = $_FILES['foto_perfil']['name'];
        $fileSize = $_FILES['foto_perfil']['size'];
        $fileType = $_FILES['foto_perfil']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Verifica se a extensão é permitida
        $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Define o novo nome do arquivo e o caminho de destino
            $newFileName = md5(uniqid()) . '-' . time() . '.' . $fileExtension;
            $dest_path = $_UP['pasta'] . $newFileName;

            // Move o arquivo para o diretório de destino
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $foto_perfil = $dest_path;

                // Insere os dados no banco de dados
                if ($atleta->create($nome, $instituicao, $rg, $matricula, $sexo, $modalidades, $foto_perfil)) {
                    header("Location: ../View/View_atletas.php");
                } else {
                    echo "Erro ao criar o registro.";
                }
            } else {
                echo "Erro ao mover o arquivo para o diretório de destino.";
            }
        } else {
            echo "Upload falhou. Extensões permitidas: " . implode(', ', $allowedfileExtensions);
        }
    } else {
        echo "Erro no upload do arquivo.";
    }
}