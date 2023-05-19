# Hands On!

Você sabia que o Circuito Mundial de Surfe é transmitido e
gerenciado online e gratuitamente desde os anos 90? E sabia que isso é
graças a uma tecnologia BR?

A seguir você vai encontrar as especificações da aplicação.

### Funcionalidades

-   Inserir surfistas
-   Obter todos os surfistas cadastrados
-   Criar novas baterias
-   Cadastrar novas ondas em uma bateria
-   Cadastrar novas notas em uma onda
-   Obter o vencedor de uma bateria

## Tecnologias Usadas

-   php
-   laravel
-   mysql

## Pré-requisitos

Antes de iniciar a instalação do projeto, verifique se você possui os seguintes requisitos instalados em sua máquina:

-PHP (versão 7.4 ou superior)
-Composer
-MySQL

Certifique-se de ter todas as dependências necessárias instaladas antes de prosseguir com os seguintes passos.

# Passo 1: Clonar o repositório

```bash
  https://github.com/rodrigoSilva23/desafio-Laravel-API-Circuito-de-Surf.git
```

# Passo 2: Instalar as dependências

```bash
    cd desafio-Laravel-API-Circuito-de-Surf
    composer install

```

Isso instalará todas as dependências listadas no arquivo composer.json e criará um diretório vendor com os pacotes necessários.

# Passo 3: Configurar o ambiente

```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=Circuito-de-Surf
    DB_USERNAME=<nome-de-usuario>
    DB_PASSWORD=<senha-do-usuario>

```

# Passo 4: Gerar chave de aplicação

Execute o seguinte comando para gerar uma chave de aplicação Laravel:

```bash
    php artisan key:generate

```
isso gerará uma chave única para sua aplicação Laravel no arquivo .env.

# Passo Final: Executar as migrações do banco de dados
Para criar as tabelas necessárias no banco de dados, execute o seguinte comando:

```bash
php artisan migrate

```
Isso executará todas as migrações.

## Author

-   [@rodrigosilvaDev23](https://github.com/rodrigoSilva23)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
