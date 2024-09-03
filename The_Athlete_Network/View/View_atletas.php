<?php
require_once '../DB/conexao.php';
require_once '../Controler/CRUD.php';

$atleta = new Atleta();
$atletas = $atleta->read();

if (!is_array($atletas)) {
    $atletas = [];
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <link rel="stylesheet" href="../CSS/nav.css"> 
    <link rel="stylesheet" href="../CSS/View.css"> 
    <link rel="icon" href="../IMG/LOGO/2.png" type="image/png">
    <title>Visualizar Atletas</title>
</head>
<body> 
    <div class="background-blur"></div>
    <div class="wrapper">
        <div class="container">
            <header>
                <nav class="navbar navbar-expand"> 
                    <a class="navbar-brand" href="../index.php">
                        <img src="../IMG/LOGO/1.png" alt="Logo" class="img-perfil">
                    </a> 
                    <div class="container"> 
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="../index.php">HOME</a> 
                            </li> 
                        </ul>
                    </div> 
                </nav>
            </header> 

            <div class="row justify-content-center"> 
                <div class="col-md-12" id="fundo">
                    <h2 class="text-center my-4">Lista de Atletas</h2>

                    <?php
                    if (isset($_GET['msg'])) {
                        $msg = $_GET['msg'];

                        if ($msg == 'deleted') {
                            echo '<div class="alert alert-success" role="alert">Atleta excluído com sucesso!</div>';
                        } elseif ($msg == 'error') {
                            echo '<div class="alert alert-danger" role="alert">Ocorreu um erro ao tentar excluir o atleta.</div>';
                        }
                    }
                    ?>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th> 
                                    <th>CPF</th> 
                                    <th>Instituição</th> 
                                    <th>Matrícula</th>
                                    <th>Sexo</th>
                                    <th>Modalidades</th> 
                                    <th>Ações</th>
                                </tr> 
                            </thead> 
                            <tbody>
                                <?php if (!empty($atletas)) : ?>
                                    <?php foreach ($atletas as $atleta) : ?> 
                                    <tr>
                                        <td><?php echo htmlspecialchars($atleta['nome'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($atleta['Cpf'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($atleta['instituicao'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($atleta['matricula'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($atleta['sexo'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($atleta['modalidades'] ?? 'N/A'); ?></td>
                                        <td> 
                                            <a href="editar_atleta.php?id=<?php echo htmlspecialchars($atleta['id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                                            <form action="../Controler/processa_delete.php" method="POST" style="display: inline-block;"> 
                                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($atleta['id']); ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este atleta?');">Excluir</button>
                                            </form> 
                                        </td> 
                                    </tr> 
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Nenhum atleta encontrado.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <?php require_once '../Components/Footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-8At5GPR46Ig/1B5AAJ7lA8oNdkvPjmnhEm2SBh2E1cN9+O8F18wM4W5E5sqgXz4gj" crossorigin="anonymous"></script>
