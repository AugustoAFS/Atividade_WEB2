<?php
require_once '../DB/conexao.php';
require_once '../Controler/CRUD.php';

$atleta = new Atleta();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = htmlspecialchars(trim($_POST['Nome']));
    $cpf = htmlspecialchars(trim($_POST['cpf']));
    $instituicao = htmlspecialchars(trim($_POST['instituicao']));
    $matricula = htmlspecialchars(trim($_POST['Matricula']));
    $sexo = htmlspecialchars(trim($_POST['sexo']));
    $modalidades = isset($_POST['modalidades']) ? $_POST['modalidades'] : [];
    $ouro = isset($_POST['ouro']) ? intval($_POST['ouro']) : 0;
    $prata = isset($_POST['prata']) ? intval($_POST['prata']) : 0;
    $bronze = isset($_POST['bronze']) ? intval($_POST['bronze']) : 0;
    $foto_perfil = isset($_POST['foto_perfil_atual']) ? $_POST['foto_perfil_atual'] : '';

    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto_perfil']['tmp_name'];
        $fileName = $_FILES['foto_perfil']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedfileExtensions = ['jpg', 'jpeg', 'gif', 'png'];

        if (in_array($fileExtension, $allowedfileExtensions)) {
            $newFileName = md5(uniqid()) . '-' . time() . '.' . $fileExtension;
            $dest_path = '../IMG/' . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $foto_perfil = $dest_path;
            } else {
                echo "<p class='text-danger'>Erro ao mover a imagem para o diretório de destino.</p>";
            }
        } else {
            echo "<p class='text-danger'>Extensões de arquivo permitidas: " . implode(', ', $allowedfileExtensions) . "</p>";
        }
    }
    
    if ($atleta->update($id, $nome, $cpf, $instituicao, $matricula, $sexo, $modalidades, $foto_perfil, $ouro, $prata, $bronze)) {
        $modalidadesIds = [];
        foreach ($modalidades as $modalidade_nome) {
            $modalidade_id = $atleta->getModalidadeIdByName($modalidade_nome);
            if ($modalidade_id) {
                $modalidadesIds[] = $modalidade_id;
            } else {
                echo "<p class='text-danger'>Modalidade '$modalidade_nome' não encontrada!</p>";
            }
        }
        $atleta->updateModalidades($id, $modalidadesIds);
        header("Location: view_atletas.php");
        exit();
    } else {
        echo "<p class='text-danger'>Erro ao atualizar o registro.</p>";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $athlete = $atleta->readById($id);

    if (!$athlete) {
        echo "<p class='text-danger'>Atleta não encontrado.</p>";
        exit();
    }
    $athlete['modalidades'] = $atleta->getModalidadesByAtletaId($id);
} else {
    echo "<p class='text-danger'>ID do atleta não fornecido.</p>";
    exit();
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
    <link rel="icon" href="../IMG/LOGO/2.png" type="image/png">
    <title>Editar Atleta</title>
</head>
<body>
<div class="background-blur"></div>
    <div class="container">
        <header>
            <nav class="navbar navbar-expand"> 
                <div class="container"> 
                    <a class="navbar-brand" href="../index.php"><img src="../IMG/LOGO/1.png" alt="Logo" class="img-perfil"></a> 
                    <ul class="navbar-nav">
                        <li class="nav-item"> 
                            <a href="../index.php">HOME</a> 
                        </li>
                    </ul> 
                </div>
            </nav>
        </header>

        <div class="row justify-content-center"> 
            <div class="col-md-6" id="fundo">
                <h2 class="text-center my-4">Editar Atleta</h2>
                <form action="editar_atleta.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($athlete['id']); ?>">

                    <div class="mb-3">
                        <label for="Nome" class="form-label">Nome:</label> 
                        <input type="text" class="form-control" id="Nome" name="Nome" value="<?php echo htmlspecialchars($athlete['nome']); ?>" required> 
                    </div>

                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo htmlspecialchars($athlete['Cpf']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="instituicao" class="form-label">Instituição:</label>
                        <select class="form-select" id="instituicao" name="instituicao" required>
                            <option value="IFPR" <?php echo $athlete['instituicao'] == 'IFPR' ? 'selected' : ''; ?>>IFPR</option>
                            <option value="IFSC" <?php echo $athlete['instituicao'] == 'IFSC' ? 'selected' : ''; ?>>IFSC</option> 
                            <option value="IFC" <?php echo $athlete['instituicao'] == 'IFC' ? 'selected' : ''; ?>>IFC</option> 
                            <option value="IFRS" <?php echo $athlete['instituicao'] == 'IFRS' ? 'selected' : ''; ?>>IFRS</option> 
                            <option value="IFSUL" <?php echo $athlete['instituicao'] == 'IFSUL' ? 'selected' : ''; ?>>IFSUL</option>
                            <option value="IFFAR" <?php echo $athlete['instituicao'] == 'IFFAR' ? 'selected' : ''; ?>>IFFAR</option> 
                        </select> 
                    </div>

                    <div class="mb-3"> 
                        <label for="Matricula" class="form-label">Matrícula:</label> 
                        <input type="text" class="form-control" id="Matricula" name="Matricula" value="<?php echo htmlspecialchars($athlete['matricula']); ?>" required> 
                    </div>

                    <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo:</label>
                        <select class="form-select" id="sexo" name="sexo" required>
                            <option value="Feminino" <?php echo $athlete['sexo'] == 'Feminino' ? 'selected' : ''; ?>>Feminino</option>
                            <option value="Masculino" <?php echo $athlete['sexo'] == 'Masculino' ? 'selected' : ''; ?>>Masculino</option> 
                            <option value="Outros" <?php echo $athlete['sexo'] == 'Outros' ? 'selected' : ''; ?>>Outros</option> 
                        </select> 
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Modalidades:</label>
                        <?php
                        $modalidadesDisponiveis = ['Basquete', 'Futebol de campo', 'Futsal', 'Handebol', 'Tenis de mesa', 'Volei', 'Volei de praia', 'Xadrez'];
                        foreach ($modalidadesDisponiveis as $modalidade) {
                            $checked = in_array($modalidade, $athlete['modalidades']) ? 'checked' : '';
                            echo '<div class="form-check">';
                            echo '<input class="form-check-input" type="checkbox" name="modalidades[]" value="' . htmlspecialchars($modalidade) . '" id="' . htmlspecialchars($modalidade) . '" ' . $checked . '>';
                            echo '<label class="form-check-label" for="' . htmlspecialchars($modalidade) . '">' . htmlspecialchars($modalidade) . '</label>';
                            echo '</div>';
                        }
                        ?>
                    </div>

                    <div class="mb-3"> 
                        <label for="ouro" class="form-label">Medalhas de Ouro:</label> 
                        <input type="number" class="form-control" id="ouro" name="ouro" value="<?php echo htmlspecialchars($athlete['ouro']); ?>" min="0" required> 
                    </div>

                    <div class="mb-3">
                        <label for="prata" class="form-label">Medalhas de Prata:</label>
                        <input type="number" class="form-control" id="prata" name="prata" value="<?php echo htmlspecialchars($athlete['prata']); ?>" min="0" required> 
                    </div> 

                    <div class="mb-3">
                        <label for="bronze" class="form-label">Medalhas de Bronze:</label> 
                        <input type="number" class="form-control" id="bronze" name="bronze" value="<?php echo htmlspecialchars($athlete['bronze']); ?>" min="0" required> 
                    </div>

                    <div class="mb-3"> 
                        <label for="foto_perfil" class="form-label">Foto de Perfil:</label> 
                        <input type="file" class="form-control" id="foto_perfil" name="foto_perfil">
                        <input type="hidden" name="foto_perfil_atual" value="<?php echo htmlspecialchars($athlete['foto_perfil']); ?>">
                        <?php if ($athlete['foto_perfil']) : ?>
                            <img src="<?php echo htmlspecialchars($athlete['foto_perfil']); ?>" alt="Foto de Perfil Atual" height="100"> <br>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
    <?php require_once '../Components/Footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
