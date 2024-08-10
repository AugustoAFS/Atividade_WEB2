CREATE DATABASE atletas_web2;

USE atletas_web2;

CREATE TABLE atletas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    instituicao VARCHAR(255) NOT NULL,
    rg VARCHAR(255) NOT NULL,
    matricula VARCHAR(255) NOT NULL,
    sexo VARCHAR(50) NOT NULL,
    modalidades VARCHAR(255),
    foto_perfil VARCHAR(255)
);