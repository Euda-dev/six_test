# Guia de Instalação do Projeto Laravel

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Requisitos

- [Composer](https://getcomposer.org/)
- PHP 8.1 ou superior

## Início

1. **Clone o Repositório:**

    ```bash
    git clone https://github.com/your-username/your-project.git
    ```

2. **Navegue até o Diretório do Projeto:**

    ```bash
    cd your-project
    ```

3. **Crie uma Cópia do Arquivo de Ambiente:**

    ```bash
    cp .env.example .env
    ```

4. **Edite o Arquivo `.env`:**

    Abra o arquivo `.env` em um editor de texto e atualize os detalhes do banco de dados.

    ```dotenv
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=laravel
    DB_USERNAME=postgres
    DB_PASSWORD=
    ```

5. **Instale as Dependências com o Composer:**

    ```bash
    composer install
    ```

6. **Gere a Chave de Aplicação:**

    Se a `APP_KEY` não estiver presente no arquivo `.env`, gere uma.

    ```bash
    php artisan key:generate
    ```

7. **Execute as Migrações do Banco de Dados:**

    ```bash
    php artisan migrate
    ```

8. **Preencha o Banco de Dados com Dados de Teste:**

    ```bash
    php artisan db:seed --class=UserTestSeeder
    ```

## Executando o Projeto

1. **Inicie o Servidor de Desenvolvimento do Laravel:**

    ```bash
    php artisan serve
    ```

2. **Acesse o Projeto no seu Navegador:**

    - **Painel de Administração:** [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login)
    - **Site:** [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Credenciais de Login

- **E-mail:** test@gmail.com
- **Senha:** 123123

## Informações Adicionais

- **Banco de Dados:** PostgreSQL
- **URL do Admin:** [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login)
- **URL do Site:** [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Personalização

Sinta-se à vontade para personalizar o arquivo `.env` e outras configurações de acordo com suas preferências.


## Licença

O projeto Laravel é um software de código aberto licenciado sob a [licença MIT](https://opensource.org/licenses/MIT).
