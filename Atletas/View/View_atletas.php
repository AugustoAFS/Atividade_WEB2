<?php
require_once '../DB/conexao.php';
require_once '../Controler/CRUD.php';

$atleta = new Atleta();
$atletas = $atleta->read();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/nav.css">
    <link rel="stylesheet" href="../CSS/View.css">
    <title>Visualizar Atletas</title>
</head>

<body>
    <div class="container">
        <header>
            <nav class="navbar navbar-expand">
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
            <div class="col-md-10" id="fundo">
                <h2 class="text-center my-4">Lista de Atletas</h2>
                <table class="table table-striped" id="Table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Instituição</th>
                            <th>RG</th>
                            <th>Matrícula</th>
                            <th>Sexo</th>
                            <th>Modalidades</th>
                            <th>Foto</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($atletas as $atleta) : ?>
                            <tr>
                                <td><?php echo $atleta['id']; ?></td>
                                <td><?php echo $atleta['nome']; ?></td>
                                <td><?php echo $atleta['instituicao']; ?></td>
                                <td><?php echo $atleta['rg']; ?></td>
                                <td><?php echo $atleta['matricula']; ?></td>
                                <td><?php echo $atleta['sexo']; ?></td>
                                <td><?php echo $atleta['modalidades']; ?></td>
                                <td>
                                    <img src="<?php echo $atleta['foto_perfil']; ?>" alt="Foto de perfil" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>
                                    <a href="editar_atleta.php?id=<?php echo $atleta['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="../Controler/processar_delete.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $atleta['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar?');">Deletar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <footer class="footer text-center py-3">
            <div class="container">
                <p class="mb-0">© 2023 IFPR - Todos os direitos reservados.</p>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
