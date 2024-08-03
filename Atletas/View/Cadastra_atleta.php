<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/nav.css">
    <link rel="stylesheet" href="../CSS/Cadastra.css">
    <title>Atletas</title>
</head>
<body>
<div class="container">
<header> 
    <nav class="navbar navbar-expand"> 
        <div class="container"> 
            <a class="navbar-brand" href="#">Nome do Site/Logo</a> 
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
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="View_atletas.php">VISUALIZAR ATLETA</a>
                </li>
            </ul>
            <fieldset>
                <form class="forms" action="../Controler/processar_cadastro.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="Nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="Nome" name="Nome">
                    </div>
                    <label for="instituicao">Instituição:</label>
                    <select class="form-select" id="instituicao" name="instituicao">
                        <option selected></option>
                        <option value="IFPR">IFPR</option>
                        <option value="IFSC">IFSC</option>
                        <option value="IFC">IFC</option>
                        <option value="IFRS">IFRS</option>
                        <option value="IFSUL">IFSUL</option>
                        <option value="IFFAR">IFFAR</option>
                    </select>
                    <div class="mb-3">
                        <label for="RG" class="form-label">RG:</label>
                        <input type="text" class="form-control" id="RG" name="RG">
                    </div>
                    <div class="mb-3">
                        <label for="Matricula" class="form-label">Matrícula:</label>
                        <input type="text" class="form-control" id="Matricula" name="Matricula">
                    </div>
                    <label for="sexo">Sexo:</label>
                    <select class="form-select" id="sexo" name="sexo">
                        <option selected></option>
                        <option value="Feminino">Feminino</option>
                        <option value="Masculino">Masculino</option>
                    </select>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="modalidades[]" value="Basquete" id="Basquete">
                        <label class="form-check-label" for="Basquete">Basquete</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="modalidades[]" value="Futebol de campo" id="Futebol_campo">
                        <label class="form-check-label" for="Futebol_campo">Futebol de campo</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="modalidades[]" value="Futsal" id="Futsal">
                        <label class="form-check-label" for="Futsal">Futsal</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="modalidades[]" value="Handebol" id="Handebol">
                        <label class="form-check-label" for="Handebol">Handebol</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="modalidades[]" value="Tenis de mesa" id="Tenis_mesa">
                        <label class="form-check-label" for="Tenis_mesa">Tênis de mesa</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="modalidades[]" value="Volei" id="Volei">
                        <label class="form-check-label" for="Volei">Volei</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="modalidades[]" value="Volei de praia" id="Volei_praia">
                        <label class="form-check-label" for="Volei_praia">Volei de praia</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="modalidades[]" value="Xadrez" id="Xadrez">
                        <label class="form-check-label" for="Xadrez">Xadrez</label>
                    </div>
                    <br>
                    <div class="mb-1">
                        <label for="formFileMultiple" class="form-label">Imagem para foto de perfil</label>
                        <input class="form-control" type="file" id="formFileMultiple" name="foto_perfil" multiple>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-primary">Submit</button>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>