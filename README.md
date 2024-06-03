Sistema Financeiro Dízimo Digital- README

##Sobre o Projeto

Este é um sistema financeiro desenvolvido utilizando o framework Laravel. Ele permite gerenciar finanças empresariais, com funcionalidades como controle de receitas, despesas, relatórios financeiros, entre outros.

##Ferramentas Necessárias

Para rodar este projeto, você precisará das seguintes ferramentas:

1. PHP (versão 8.0 ou superior)  
   Baixar em: https://www.php.net/downloads

2. Composer (Gerenciador de Dependências PHP)  
   Baixar em: https://getcomposer.org/download/

3. Node.js (incluindo npm, o gerenciador de pacotes do Node)  
   Baixar em: https://nodejs.org/en/download/

4. Git (Controle de Versão)  
   Baixar em: https://git-scm.com/downloads

5. WampServer (Servidor Web, PHP, e MySQL)
Baixar em: http://www.wampserver.com/en/

6. Banco de Dados (MySQL recomendado)  
   MySQL: https://dev.mysql.com/downloads/mysql/

Passos para Rodar o Projeto

1. Clone o Repositório

Abra seu terminal e clone o repositório do projeto:

```
git clone https://github.com/Andressards/Dizimo-Digital
```

2. Instale as Dependências do PHP

Navegue até o diretório do projeto e execute o Composer para instalar as dependências:

```
cd nome-do-diretorio-do-projeto
composer install
```

3. Instale as Dependências do Node.js

Instale as dependências do Node.js e compile os ativos front-end:

```
npm install
npm run dev
```

4. Configuração do Ambiente

Crie um arquivo `.env` baseado no arquivo de exemplo `.env.example`:

```
cp .env.example .env
```

Edite o arquivo `.env` e configure as variáveis de ambiente, especialmente as relacionadas ao banco de dados:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco_de_dados
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

5. Gere a Chave da Aplicação

Gere uma nova chave para a aplicação Laravel:

```
php artisan key:generate
```

6. Migre o Banco de Dados

Execute as migrações para criar as tabelas no banco de dados:

```
php artisan migrate
```

7. Inicie o Servidor de Desenvolvimento

Finalmente, inicie o servidor de desenvolvimento do Laravel:

```
php artisan serve
```

O sistema estará acessível em `http://localhost:8000`.

→ Links Úteis

- [Documentação do Laravel](https://laravel.com/docs)
- [Documentação do Composer](https://getcomposer.org/doc/)
- [Documentação do Node.js](https://nodejs.org/en/docs/)
