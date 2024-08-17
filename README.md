# 🏅 Sistema de Cadastro de Atletas

Bem-vindo ao sistema de cadastro de atletas, um projeto desenvolvido em PHP utilizando PDO e implementando operações CRUD (Create, Read, Update, Delete) com classes e métodos.

## 🚀 Funcionalidades- 📋 Cadastro de novos atletas
- 🔍 Visualização de atletas cadastrados
- ✏️ Atualização dos dados dos atletas
- ❌ Remoção de atletas

## 🛠️ Tecnologias Utilizadas-**PHP**: Linguagem de programação utilizada para o desenvolvimento do backend.
-**PDO (PHP Data Objects)**: Abstração de acesso ao banco de dados.
-**MySQL**: Banco de dados relacional utilizado para armazenar os dados dos atletas.
-**HTML/CSS**: Para a estrutura e estilo da interface.

## 📦 Estrutura do Projeto```markdown
├── index.php           # Página principal
├── cadastrar.php       # Formulário de cadastro de atletas
├── editar.php          # Formulário de edição de dados dos atletas
├── deletar.php         # Script para deletar atletas
├── classes/            # Diretório contendo as classes do projeto
│   └── Atleta.php      # Classe que representa um atleta
│   └── Database.php    # Classe responsável pela conexão com o banco de dados
└── assets/             # Arquivos de estilo e imagens
    └── css/
    └── img/
