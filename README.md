# Gerenciador de rifa API

<div align="center">
    <img alt="Logo" width="350px" src="https://i.imgur.com/HzsQOZm.jpeg" />

![Status](http://img.shields.io/static/v1?label=STATUS&message=FINALIZADO&color=RED&style=for-the-badge)

![Top language](https://img.shields.io/github/languages/top/felipesilva15/rifa-api.svg)
![Language count](https://img.shields.io/github/languages/count/felipesilva15/rifa-api.svg)
![Repository size](https://img.shields.io/github/repo-size/felipesilva15/rifa-api.svg)
[![Last commit](https://img.shields.io/github/last-commit/felipesilva15/rifa-api.svg)](https://github.com/felipesilva15/rifa-api/commits/main)
[![Issues](https://img.shields.io/github/issues/felipesilva15/rifa-api.svg)](https://github.com/felipesilva15/rifa-api/issues)
[![Licence](https://img.shields.io/github/license/felipesilva15/rifa-api.svg)](https://github.com/felipesilva15/rifa-api/blob/main/LICENSE)

</div>

API RESTful desenvolvida em Laravel com MySQL com intuito de fornecer o backend para o gerenciador de rifas ou site de exibição da rifa. Possui autenticação via JWT, CRUD, CI/CD com publicação no DockerHub e deploy em uma VPS.

## 📑 Sumário

- [Descrição geral](#-descrição-geral)
- [Executando localmente](#-executando-localmente)
- [Executando com Docker](#-executando-com-docker)
- [Documentação no Swagger](#-documentação-no-swagger)
- [Endpoints](#-endpoints)
- [Tecnologias utilizadas](#%EF%B8%8F-tecnologias-utilizadas)
- [Autores](#%EF%B8%8F-autores)
- [Licença](#-licença)

## 📘 Descrição Geral

- **Versão:** 1.0.0  
- **Autor:** [Felipe Silva](mailto:felipe.allware@gmail.com)  
- **Licença:** [Licença API](https://github.com/felipesilva15/rifa-api/blob/main/LICENSE)
- **Deploy:** [Swagger](https://rifa-api.felipesilva15.com.br/api/documentation)

### Principais funcionalidades

- CRUD completo.
- Documentação gerada com Swagger (OpenAPI 3).
- CI/CD com GitHub Actions e publicação no DockerHub.
- Deploy em VPS.
- Autenticação com JWT.

## 🚀 Executando localmente

Essas instruções permitirão que você obtenha uma cópia do projeto em operação na sua máquina local para fins de desenvolvimento e teste.

### 📋 Pré-requisitos

- PHP v8.1.0
- Composer

### 🔧 Instalação

1. Clone o projeto utilizando o comando abaixo

    ``` bash
    git clone https://github.com/felipesilva15/rifa-api.git
    ```

2. Acesse a pasta dos fonts deste projeto

    ```bash
    cd rifa-api
    ```

3. Instale as dependências do projeto

    ```bash
    composer install
    ```

4. Copie o arquivo de exemplo de variáveis de ambiente  

    ```bash
    cp .env.example .env
    ```

5. Atualize as credenciais de acesso ao seu banco de dados e secret para o JWT preenchendo os campos abaixo

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=
    DB_USERNAME=root
    DB_PASSWORD=
    
    JWT_SECRET=
    ```

6. Gere as tabelas da aplicação e a semente para o serviço de autenticação

    ```bash
    php artisan migrate --seed
    ```

7. Inicie a aplicação

    ```bash
    php artisan serve
    ```

8. Acesse a aplicação em <http://localhost:8000>.

## 🐳 Executando com Docker

```bash
# Build da imagem
docker build -t felipesilva15/rifa-api:latest \
    --build-arg DB_HOST='localhost' \
    --build-arg DB_PORT='3306' \
    --build-arg DB_DATABASE='rifa' \
    --build-arg DB_USERNAME='root' \
    --build-arg DB_PASSWORD='root' \
    .

# Rodar container
docker run -d -p 8000:80 felipesilva15/rifa-api
```

## 📄 Documentação no Swagger

Acesse a documentação através do endpoint `/api/documentation` (Veja a versão do [deploy](https://rifa-api.felipesilva15.com.br/api/documentation)).

## 📁 Endpoints

### 🔐 Authentication

| Método | Endpoint                        | Descrição                              |
|--------|---------------------------------|----------------------------------------|
| POST   | `/api/login`                    | Obtém o token JWT para autenticação    |
| POST   | `/api/logout`                   | Realiza o logout e invalida o token    |
| POST   | `/api/refresh-token`            | Atualiza um token JWT                  |
| GET    | `/api/me`                       | Retorna o usuário autenticado do token |

### 🛠 Utils

| Método | Endpoint                             | Descrição                         |
|--------|--------------------------------------|-----------------------------------|
| GET    | `/api/utils/generate-hash?content=`  | Gera o hash de um conteúdo        |
| POST   | `/api/utils/generate-hash`           | Gera o hash de um conteúdo        |

### 🍀 Raffles

| Método | Endpoint                     | Descrição                                 |
|--------|------------------------------|-------------------------------------------|
| GET    | `/api/raffle`                | Lista todas as rifas                      |
| GET    | `/api/raffle/{id}`           | Detalha uma rifa por ID                   |
| POST   | `/api/raffle`                | Cadastra uma novo rifa                    |
| PUT    | `/api/raffle/{id}`           | Atualiza uma rifa                         |
| DELETE | `/api/raffle/{id}`           | Remove uma rifa                           |
| GET    | `/api/raffle/{id}/card`      | Lista a cartela de números de uma rifa    |
| GET    | `/api/raffle/{id}/tickets`   | Lista os bilhetes adquiridos de uma rifa  |

### 👤 Participants

| Método | Endpoint                          | Descrição                                        |
|--------|-----------------------------------|--------------------------------------------------|
| GET    | `/api/participant`                | Lista todos os participantes                     |
| GET    | `/api/participant/{id}`           | Detalha um participante por ID                   |
| POST   | `/api/participant`                | Cadastra um novo participante                    |
| PUT    | `/api/participant/{id}`           | Atualiza um participante                         |
| DELETE | `/api/participant/{id}`           | Remove um participante                           |
| GET    | `/api/participant/{id}/tickets`   | Lista os bilhetes adquiridos por um participante |

### 🎫 Tickets

| Método | Endpoint             | Descrição                                   |
|--------|----------------------|---------------------------------------------|
| GET    | `/api/ticket`        | Lista todos os bilhetes                     |
| GET    | `/api/ticket/{id}`   | Detalha um bilhete por ID                   |
| POST   | `/api/ticket`        | Cadastra um novo bilhete                    |
| PUT    | `/api/ticket/{id}`   | Atualiza um bilhete                         |
| DELETE | `/api/ticket/{id}`   | Remove um bilhete                           |
| POST    | `/api/ticket/batch`  | Cadastra um ou mais bilhetes de uma vez só |

### 📊 Dashboards

| Método | Endpoint                 | Descrição                 |
|--------|--------------------------|---------------------------|
| GET    | `/api/dashboard/home`    | Dashboard geral           |

## 🛠️ Tecnologias utilizadas

- **Laravel 10.10**
- **PHP 8.1**
- **MySQL**
- **JWT**
- **Swagger UI**
- **Docker**
- **GitHub Actions (CI/CD)**

## ✒️ Autores

- **Felipe Silva** - *Desenvolvedor e mentor* - [felipesilva15](https://github.com/felipesilva15)

## 📄 Licença

Este projeto está sob a licença (MIT) - veja o arquivo [LICENSE](https://github.com/felipesilva15/rifa-api/blob/main/LICENSE) para detalhes.

---

Documentado por [Felipe Silva](https://github.com/felipesilva15) 😊
