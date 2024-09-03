CREATE DATABASE atletas_db;

USE atletas_db;

CREATE TABLE modalidade (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE atleta (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    Cpf VARCHAR(100) NOT NULL,
    instituicao VARCHAR(100) NOT NULL,
    matricula VARCHAR(100) NOT NULL,
    sexo varchar(20) NOT NULL,
    foto_perfil VARCHAR(255),
    ouro INT DEFAULT 0, 
    prata INT DEFAULT 0,
    bronze INT DEFAULT 0
);

CREATE TABLE atleta_modalidade (
    atleta_id INT,
    modalidade_id INT,
    PRIMARY KEY (atleta_id, modalidade_id),
    FOREIGN KEY (atleta_id) REFERENCES atleta(id) ON DELETE CASCADE,
    FOREIGN KEY (modalidade_id) REFERENCES modalidade(id) ON DELETE CASCADE
);