# Sistema de Cadastro de Visitantes

## 📋 Descrição

Sistema web para gerenciamento e controle de visitantes em empresas e organizações. Permite o cadastro, acompanhamento e finalização de visitas, oferecendo controle completo sobre o fluxo de pessoas no ambiente corporativo.

## ✨ Funcionalidades

### 👥 Gestão de Usuários
- Cadastro de usuários do sistema
- Autenticação segura com login e senha
- Alteração de senhas
- Controle de permissões

### 🏢 Gestão de Visitantes
- **Cadastro de Visitantes**: Registro completo com dados pessoais e empresariais
- **Controle de Entrada**: Registro automático de data e hora de entrada
- **Acompanhamento**: Visualização do status da visita (Em andamento/Finalizada)
- **Finalização de Visitas**: Registro de saída com data e hora
- **Histórico Completo**: Consulta de todas as visitas realizadas

### 📊 Interface e Usabilidade
- Interface responsiva com Bootstrap 5
- Tabelas interativas com DataTables
- Modais para ações rápidas
- Máscaras automáticas para campos de entrada
- Validação de formulários

## 🛠️ Tecnologias Utilizadas

- **Backend**: PHP 7.4+
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework CSS**: Bootstrap 5.3.0
- **Banco de Dados**: MySQL
- **Bibliotecas JavaScript**:
  - jQuery 3.6.0
  - DataTables 1.13.4
  - jQuery Mask Plugin

## 📋 Pré-requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache/Nginx) ou XAMPP/WAMP
- Navegador web moderno

## 🚀 Instalação e Configuração

### 1. Clone ou baixe o projeto
```bash
git clone [url-do-repositorio]
# ou baixe e extraia o arquivo ZIP
```

### 2. Configure o servidor web
- Coloque os arquivos na pasta do servidor web (ex: `htdocs` para XAMPP)
- Certifique-se de que o PHP e MySQL estão funcionando

### 3. Configure o banco de dados
```sql
-- Crie o banco de dados
CREATE DATABASE cadastro_visitantes;

-- Importe as tabelas
-- Execute os arquivos SQL fornecidos:
-- usuarios_teste.sql
-- visitantes_tabela.sql
```

### 4. Configure a conexão com o banco
Edite o arquivo `includes/config.php` com suas credenciais:
```php
<?php
// Configurações do banco de dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'cadastro_visitantes');
define('DB_USER', 'seu_usuario');
define('DB_PASS', 'sua_senha');
?>
```

### 5. Acesse o sistema
- Abra o navegador e acesse: `http://localhost/cadastro_visitantes`
- Faça login com as credenciais padrão (se configuradas)

## 📖 Guia de Uso

### Login no Sistema
1. Acesse a página inicial
2. Insira suas credenciais de usuário
3. Clique em "Entrar"

### Cadastrar Visitante
1. No painel principal, clique em "Novo Visitante"
2. Preencha todos os campos obrigatórios:
   - Nome completo
   - Documento (CPF/RG)
   - Empresa
   - Pessoa visitada
   - Departamento
3. Clique em "Cadastrar"

### Gerenciar Visitantes
- **Visualizar**: Todos os visitantes aparecem na tabela principal
- **Editar**: Clique no botão "Editar" na linha do visitante
- **Finalizar Visita**: Clique em "Finalizar" para registrar a saída
- **Excluir**: Remove o registro do visitante (use com cuidado)

### Gerenciar Usuários
1. Acesse "Usuários" no menu
2. Cadastre novos usuários do sistema
3. Gerencie permissões e senhas

## 📁 Estrutura do Projeto