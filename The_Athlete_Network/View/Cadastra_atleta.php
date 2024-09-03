<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/nav.css">
    <link rel="stylesheet" href="../CSS/Cadastra.css">
    <link rel="icon" href="../IMG/LOGO/2.png" type="image/png">
    <title>Atletas</title>
</head>
<body>
<div class="background-blur"></div> <!-- Adiciona a div para o fundo com blur -->
<div class="container">
    <header> 
        <nav class="navbar navbar-expand"> 
            <div class="container"> 
                <a class="navbar-brand" href="../index.php">
                    <img src="../IMG/LOGO/1.png" alt="Logo" class="img-perfil">
                </a> 
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="../index.php">HOME</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="row justify-content-center"> 
        <div class="col-md-8" id="fundo"> 
            <ul class="nav justify-content-center mb-4">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="View_atletas.php">VISUALIZAR ATLETA</a>
                </li>
            </ul>
            <fieldset>
                <form action="../Controler/processar_cadastro.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>

                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" required>
                    </div>

                    <div class="mb-3">
                        <label for="instituicao" class="form-label">Instituição:</label>
                        <select class="form-select" id="instituicao" name="instituicao" required>
                            <option value="" selected disabled>Selecione a Instituição</option>
                            <option value="IFPR">IFPR</option>
                            <option value="IFSC">IFSC</option>
                            <option value="IFC">IFC</option>
                            <option value="IFRS">IFRS</option>
                            <option value="IFSUL">IFSUL</option>
                            <option value="IFFAR">IFFAR</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="matricula" class="form-label">Matrícula:</label>
                        <input type="text" class="form-control" id="matricula" name="matricula" required>
                    </div>

                    <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo:</label>
                        <select class="form-select" id="sexo" name="sexo" required>
                            <option value="" selected disabled>Selecione o Sexo</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </div>

                    <label class="form-label">Modalidades:</label> 
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
                        <input class="form-check-input" type="checkbox" name="modalidades[]" value="Tênis de mesa" id="Tenis_mesa">
                        <label class="form-check-label" for="Tenis_mesa">Tênis de mesa</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="modalidades[]" value="Volei" id="Volei">
                        <label class="form-check-label" for="Volei">Vôlei</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="modalidades[]" value="Volei de praia" id="Volei_praia">
                        <label class="form-check-label" for="Volei_praia">Vôlei de praia</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="modalidades[]" value="Xadrez" id="Xadrez">
                        <label class="form-check-label" for="Xadrez">Xadrez</label>
                    </div>

                    <div class="mb-3">
                        <label for="foto_perfil" class="form-label">Imagem para foto de perfil:</label>
                        <input class="form-control" type="file" id="foto_perfil" name="foto_perfil">
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </fieldset>
        </div> 
    </div>  
    <?php require_once '../Components/Footer.php'; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz1PrI3+M1l+ZQdhbKk7FjUMNYvfpF8l7gxrA8PpcI2TZTv3MOIR2bENmM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-pZmpdh4D7o6gy5O31ImqjwtxcfcbmQ27aZmV/lwQwW4X7loRf8pUuh0z/SORNh9X" crossorigin="anonymous"></script>
</body>
</html>
