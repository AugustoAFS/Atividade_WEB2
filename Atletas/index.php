<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Atletas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/nav.css"> 
    <link rel="stylesheet" href="CSS/index.css">
</head>
<body>
    <header> 
        <nav class="navbar navbar-expand"> 
            <div class="container"> 
                <a class="navbar-brand" href="#">Nome do Site/Logo</a> 
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#">ATLETAS</a>
                    </li>
                    <li class="nav-item">
                        <a href="View/Cadastra_atleta.php">CADASTRO DE ATLETAS</a> 
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container"> 
            <section class="py-5">
                <div class="row">
                    <div class="col-lg-8">
                        <h2>Bem-vindo ao nosso Site de Atletas!</h2>
                        <p class="lead apresentacao">Estou orgulhoso de apresentar o trabalho de programação web 2, um site para cadastro de atleta com o foco em aprimorar nossas habilidades em Bootstrap.</p>
                    </div>
                    <div class="col-lg-4">
                        <img src="https://via.placeholder.com/300x200" class="img-fluid" alt="Imagem de apresentação"> 
                    </div>
                </div>
            </section>

            <section class="py-5" id="destaque">
                <h2 class="text-center">Nossos Destaques</h2>
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card" id="card">
                            <img src="https://via.placeholder.com/200x150" class="card-img-top" alt="Imagem do Destaque 1">
                            <div class="card-body">
                                <h5 class="card-title">Título do Destaque 1</h5>
                                <p class="card-text">Breve descrição do destaque 1.</p>
                                <a href="#" class="btn btn-primary">Saiba Mais</a>
                            </div>
                        </div>
                    </div>
                </div> 
            </section>
        </div>
    </main>

    <footer class="py-2 mt-2">
        <div class="container text-center">
            <p>© TADS 2023 IFPR Augusto - Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
