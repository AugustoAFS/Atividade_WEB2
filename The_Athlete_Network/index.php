<?php
require_once 'DB/conexao.php'; 
require_once 'Controler/CRUD.php'; 

$atleta = new Atleta(); 
$atletas = $atleta->readTopAthletes();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Atletas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="CSS/nav.css">
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="icon" href="IMG/LOGO/2.png" type="image/png">
</head>
<body>
    <div class="background-blur"></div>

    <div class="content-container">
        <header>
            <!-- NavBar visível apenas em telas grandes -->
            <nav class="navbar navbar-expand-lg d-none d-lg-block">
                <div class="container">
                    <a class="navbar-brand" href="index.php">
                        <img src="IMG/LOGO/1.png" alt="Logo" class="img-perfil">
                    </a>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ms-auto"> <!-- Utilizando ms-auto para alinhar os itens à direita -->
                            <li class="nav-item">
                                <a  href="View/view_atletas.php">ATLETAS</a>
                            </li>
                            <li class="nav-item">
                                <a  href="View/Cadastra_atleta.php">CADASTRO DE ATLETAS</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Barra lateral visível apenas em telas pequenas -->
        <nav id="sidebar" class="d-block d-lg-none">
            <div class="sidebar-header">
                <a class="navbar-brand" href="index.php">
                    <img src="IMG/LOGO/1.png" alt="Logo" class="img-perfil">
                </a>
                <button class="close-btn" aria-label="Fechar Menu">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="View/view_atletas.php">Atletas</a>
                </li>
                <li>
                    <a href="View/Cadastra_atleta.php">Cadastro de Atletas</a>
                </li>
            </ul>
        </nav>

        <div id="content">
            <button type="button" id="sidebarCollapse" class="btn btn-info d-block d-lg-none">
                <i class="fas fa-bars"></i>
            </button>

            <div class="container-fluid p-4">
                <section class="py-5">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2>Bem-vindo ao nosso Site de Atletas!</h2>
                            <p class="lead apresentacao">
                                Estou orgulhoso de apresentar o trabalho de programação web 2,
                                um site para cadastro de atleta com o foco em aprimorar nossas
                                habilidades em Bootstrap.
                            </p>
                        </div>
                    </div>
                </section>

                <section class="py-5" id="destaque">
                    <h2 class="text-center">Nossos Destaques</h2>
                    <div class="row">
                        <?php if (isset($atletas) && count($atletas) > 0) : ?>
                            <?php foreach ($atletas as $atleta) : ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card" id="card">
                                        <?php
                                            $imagemPath = 'IMG/' . htmlspecialchars($atleta['foto_perfil']);
                                            if (!file_exists($imagemPath) || empty($atleta['foto_perfil'])) {
                                                $imagemPath = 'IMG/default-image.jpg';
                                            }
                                        ?>
                                        <img src="<?php echo $imagemPath; ?>" class="card-img-top" id="img_atl" alt="<?php echo htmlspecialchars($atleta['nome']); ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo htmlspecialchars($atleta['nome']); ?></h5>
                                            <p class="card-text"><?php echo htmlspecialchars($atleta['modalidades']) ?: 'Sem modalidades'; ?></p>
                                            <a href="View/editar_atleta.php?id=<?php echo htmlspecialchars($atleta['id']); ?>" class="btn btn-primary">Saiba Mais</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="col-12 text-center">
                                <p>Nenhum atleta cadastrado no momento.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/index.js"></script>
    <?php require_once 'Components/Footer.php'; ?>
</body>
</html>
