
# 🏅 The Athlete Network

![Badge](https://img.shields.io/badge/IFPR-TADS-green) ![PHP](https://img.shields.io/badge/PHP-7.4-blue) ![MySQL](https://img.shields.io/badge/MySQL-5.7-blue) ![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple)

Este é um projeto desenvolvido como parte das atividades da disciplina de **Programação Web 2** no curso de **Análise e Desenvolvimento de Sistemas** do Instituto Federal do Paraná (IFPR). A aplicação permite o cadastro e gerenciamento de atletas, incluindo a associação de modalidades esportivas e a exibição dos atletas de destaque.

## 📑 Índice

- [Funcionalidades](#funcionalidades)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Estrutura do Banco de Dados](#estrutura-do-banco-de-dados)
- [Configuração do Projeto](#configuração-do-projeto)
- [Como Executar o Projeto](#como-executar-o-projeto)
- [Contribuição](#contribuição)
- [Licença](#licença)

## 🛠️ Funcionalidades

- **Cadastro de Atletas:** Insira dados como nome, CPF, instituição, matrícula, sexo, foto de perfil, e as modalidades esportivas que o atleta pratica.
- **Gerenciamento de Modalidades:** Associar modalidades esportivas aos atletas e gerenciar suas informações de maneira integrada.
- **Visualização de Atletas:** Veja uma lista de todos os atletas cadastrados com detalhes sobre suas modalidades e conquistas.
- **Edição de Atletas:** Permite a atualização das informações dos atletas a qualquer momento.
- **Destaques na Página Inicial:** Exibição de atletas de destaque na página principal, mostrando suas modalidades e o número de medalhas conquistadas.

## 🚀 Tecnologias Utilizadas

### Front-end

- **HTML5:** Estruturação semântica das páginas.
- **CSS3:** Estilização customizada das páginas.
- **Bootstrap 5.3:** Framework CSS para design responsivo e componentes pré-estilizados.
- **JavaScript:** Interatividade e funcionalidades dinâmicas nas páginas.

### Back-end

- **PHP 7.4:** Linguagem de programação usada no desenvolvimento das funcionalidades do servidor.
- **MySQL 5.7:** Sistema de gerenciamento de banco de dados utilizado para armazenar informações dos atletas e modalidades.

## 🗃️ Estrutura do Banco de Dados

O banco de dados `atletas_db` possui três tabelas principais:

1. **`modalidade`:** Armazena as modalidades esportivas disponíveis.
    - `id`: Identificador único da modalidade.
    - `nome`: Nome da modalidade.

2. **`atleta`:** Armazena os dados pessoais e conquistas dos atletas.
    - `id`: Identificador único do atleta.
    - `nome`: Nome do atleta.
    - `Cpf`: CPF do atleta.
    - `instituicao`: Instituição à qual o atleta está vinculado.
    - `matricula`: Matrícula do atleta.
    - `sexo`: Sexo do atleta.
    - `foto_perfil`: URL da foto de perfil do atleta.
    - `ouro`, `prata`, `bronze`: Quantidade de medalhas conquistadas.

3. **`atleta_modalidade`:** Tabela intermediária que relaciona atletas e modalidades.
    - `atleta_id`: Identificador do atleta.
    - `modalidade_id`: Identificador da modalidade.

### Diagrama de Relacionamento

```plaintext
atleta --< atleta_modalidade >-- modalidade
```

## ⚙️ Configuração do Projeto

### Pré-requisitos

- Servidor Web (XAMPP, WAMP, etc.)
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Navegador Web (Chrome, Firefox, etc.)

### Configuração do Ambiente

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/AugustoAFS/Atividade_de_WEB2.git
   ```

2. **Importe o banco de dados:**

   Utilize o script SQL localizado em `/database/banco_de_dados.sql` para criar as tabelas necessárias no MySQL.

3. **Configuração do banco de dados:**

   Abra o arquivo `DB/conexao.php` e ajuste as credenciais do banco de dados conforme seu ambiente:

   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', 'sua_senha');
   define('DB_NAME', 'atletas_db');
   ```

## 🏃 Como Executar o Projeto

1. **Inicie o servidor:**

   - No XAMPP ou WAMP, inicie o Apache e o MySQL.
   - Coloque os arquivos do projeto na pasta `htdocs` (ou equivalente).

2. **Acesse a aplicação:**

   Abra o navegador e navegue até `http://localhost/projeto-atletas`.

## 🤝 Contribuição

Contribuições são sempre bem-vindas! Para contribuir:

1. Faça um fork do projeto.
2. Crie uma nova branch com a sua feature ou correção de bug: `git checkout -b minha-feature`.
3. Faça commit das suas alterações: `git commit -m 'Minha nova feature'`.
4. Envie suas alterações para o GitHub: `git push origin minha-feature`.
5. Abra um pull request para análise.

## 📄 Licença

Este projeto é licenciado sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
