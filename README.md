# Loja Mágica Tecnologia

## Descrição

Este projeto é uma aplicação web para a Loja Mágica Tecnologia. Ele inclui uma API REST para integração com lojas parceiras, permitindo o recebimento de XMLs com informações de produtos.

## Estrutura do Projeto

A estrutura do projeto é a seguinte:

```
loja_magica_tecnologia/
├── composer.json
├── docker-compose.yaml
├── index.php
├── integration/
│   └── IntegrationController.php
├── routes.php
├── src/
│   ├── Utils/
│   │   ├── Flash.php
│   │   ├── Funcoes.php
│   │   └── View.php
│   └── ...
└── vendor/
    └── ...
```

- **composer.json**: Arquivo de configuração do Composer para gerenciar dependências.
- **docker-compose.yaml**: Arquivo de configuração do Docker Compose para configurar os serviços do Docker.
- **index.php**: Arquivo de entrada principal da aplicação.
- **integration/**: Pasta contendo o controlador de integração para a API REST.
- **routes.php**: Arquivo de rotas da aplicação.
- **src/**: Pasta contendo o código-fonte da aplicação, incluindo utilitários.

## Pré-requisitos

- Docker
- Docker Compose
- Composer

## Instalação

1. Clone o repositório:

    ```sh
    git clone https://github.com/seu-usuario/loja_magica_tecnologia.git
    cd loja_magica_tecnologia
    ```

2. Instale as dependências do Composer:

    ```sh
    composer install
    ```

3. Gere o autoload do Composer:

    ```sh
    composer dump-autoload
    ```

4. Inicie os serviços do Docker:

    ```sh
    docker-compose up -d
    ```

## Testando a API

Para testar a API, você pode usar ferramentas como Postman ou cURL.

### Usando Postman

1. Abra o Postman.
2. Crie uma nova requisição.
3. Selecione o método `POST`.
4. Insira a URL do endpoint: `http://localhost:8080/api/lojamagica/pedidos`.
5. Vá para a aba `Body` e selecione `raw`.
6. No menu suspenso ao lado de `raw`, selecione `XML`.
7. Insira o XML que deseja enviar. Por exemplo:
    ```xml
    <store>
        <name>Loja Parceira</name>
        <products>
            <product>
                <id>1</id>
                <name>Produto 1</name>
                <price>100.00</price>
            </product>
            <product>
                <id>2</id>
                <name>Produto 2</name>
                <price>200.00</price>
            </product>
        </products>
    </store>
    ```
8. Clique em `Send`.

### Usando cURL

Abra o terminal e execute o seguinte comando cURL:

```sh
curl -X POST http://localhost:8080/api/lojamagica/pedidos -d @path/to/your/xmlfile.xml --header "Content-Type: application/xml"
```

Substitua `path/to/your/xmlfile.xml` pelo caminho do arquivo XML que deseja enviar.

## Logs e Debugging

Se você não receber a resposta esperada, verifique os logs do servidor web e do PHP para identificar possíveis erros. Certifique-se de que todas as dependências estão instaladas e que o autoload do Composer foi atualizado corretamente com `composer dump-autoload`.

## Contribuição

Se você quiser contribuir para este projeto, por favor, abra uma issue ou envie um pull request.

