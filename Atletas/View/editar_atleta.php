<?php
require_once '../DB/conexao.php';
require_once '../Controler/CRUD.php';

$atleta = new Atleta();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['Nome'];
    $instituicao = $_POST['instituicao'];
    $rg = $_POST['RG'];
    $matricula = $_POST['Matricula'];
    $sexo = $_POST['sexo'];
    $modalidades = isset($_POST['modalidades']) ? implode(", ", $_POST['modalidades']) : '';
    $foto_perfil = $_POST['foto_perfil_atual']; 
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto_perfil']['tmp_name'];
        $fileName = $_FILES['foto_perfil']['name'];
        $fileSize = $_FILES['foto_perfil']['size'];
        $fileType = $_FILES['foto_perfil']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            $newFileName = md5(uniqid()) . '-' . time() . '.' . $fileExtension;
            $dest_path = '../IMG/' . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $foto_perfil = $dest_path;
            }
        }
    }

    if ($atleta->update($id, $nome, $instituicao, $rg, $matricula, $sexo, $modalidades, $foto_perfil)) {
        header("Location: view_atletas.php");
        exit();
    } else {
        echo "Erro ao atualizar o registro.";
    }
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $athlete = $atleta->readById($id);
        if (!$athlete) {
            echo "Atleta não encontrado.";
            exit();
        }
    } else {
        echo "ID do atleta não fornecido.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/nav.css">
    <link rel="stylesheet" href="../CSS/Cadastra.css">
    <title>Editar Atleta</title>
</head>

<body>
    <div class="container">
        <header>
            <nav class="navbar navbar-expand">
                <div class="container">
                    <a class="navbar-brand" href="#">Nome do Site/Logo</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="../index.php" class="nav-link">HOME</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="row justify-content-center">
            <div class="col-md-6" id="fundo">
                <h2 class="text-center my-4">Editar Atleta</h2>
                <fieldset>
                    <form action="editar_atleta.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $athlete['id']; ?>">
                        <div class="mb-3">
                            <label for="Nome" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="Nome" name="Nome" value="<?php echo $athlete['nome']; ?>" required>
                        </div>
                        <label for="instituicao">Instituição:</label>
                        <select class="form-select" id="instituicao" name="instituicao" required>
                            <option value="IFPR" <?php echo $athlete['instituicao'] == 'IFPR' ? 'selected' : ''; ?>>IFPR</option>
                            <option value="IFSC" <?php echo $athlete['instituicao'] == 'IFSC' ? 'selected' : ''; ?>>IFSC</option>
                            <option value="IFC" <?php echo $athlete['instituicao'] == 'IFC' ? 'selected' : ''; ?>>IFC</option>
                            <option value="IFRS" <?php echo $athlete['instituicao'] == 'IFRS' ? 'selected' : ''; ?>>IFRS</option>
                            <option value="IFSUL" <?php echo $athlete['instituicao'] == 'IFSUL' ? 'selected' : ''; ?>>IFSUL</option>
                            <option value="IFFAR" <?php echo $athlete['instituicao'] == 'IFFAR' ? 'selected' : ''; ?>>IFFAR</option>
                        </select>
                        <div class="mb-3">
                            <label for="RG" class="form-label">RG:</label>
                            <input type="text" class="form-control" id="RG" name="RG" value="<?php echo $athlete['rg']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="Matricula" class="form-label">Matrícula:</label>
                            <input type="text" class="form-control" id="Matricula" name="Matricula" value="<?php echo $athlete['matricula']; ?>" required>
                        </div>
                        <label for="sexo">Sexo:</label>
                        <select class="form-select" id="sexo" name="sexo" required>
                            <option value="Feminino" <?php echo $athlete['sexo'] == 'Feminino' ? 'selected' : ''; ?>>Feminino</option>
                            <option value="Masculino" <?php echo $athlete['sexo'] == 'Masculino' ? 'selected' : ''; ?>>Masculino</option>
                        </select>

                        <label>Modalidades:</label>
                        <?php
                        $modalidades = explode(", ", $athlete['modalidades']);
                        ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="modalidades[]" value="Basquete" id="Basquete" <?php echo in_array("Basquete", $modalidades) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="Basquete">Basquete</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="modalidades[]" value="Futebol de campo" id="Futebol_campo" <?php echo in_array("Futebol de campo", $modalidades) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="Futebol_campo">Futebol de campo</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="modalidades[]" value="Futsal" id="Futsal" <?php echo in_array("Futsal", $modalidades) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="Futsal">Futsal</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="modalidades[]" value="Handebol" id="Handebol" <?php echo in_array("Handebol", $modalidades) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="Handebol">Handebol</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="modalidades[]" value="Tenis de mesa" id="Tenis_mesa" <?php echo in_array("Tenis de mesa", $modalidades) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="Tenis_mesa">Tênis de mesa</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="modalidades[]" value="Volei" id="Volei" <?php echo in_array("Volei", $modalidades) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="Volei">Vôlei</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="modalidades[]" value="Volei de praia" id="Volei_praia" <?php echo in_array("Volei de praia", $modalidades) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="Volei_praia">Vôlei de praia</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="modalidades[]" value="Xadrez" id="Xadrez" <?php echo in_array("Xadrez", $modalidades) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="Xadrez">Xadrez</label>
                        </div>

                        <div class="mb-3">
                            <label for="foto_perfil" class="form-label">Foto de Perfil:</label>
                            <input type="file" class="form-control" id="foto_perfil" name="foto_perfil">
                            <input type="hidden" name="foto_perfil_atual" value="<?php echo $athlete['foto_perfil']; ?>">
                            <img src="<?php echo $athlete['foto_perfil']; ?>" alt="Foto de perfil" style="width: 100px; height: 100px;">
                        </div>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </form>
                </fieldset>
            </div>
        </div>
        <footer class="text-center py-3">
            <div class="container">
                <p class="mb-0">© 2023 IFPR - Todos os direitos reservados.</p>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>