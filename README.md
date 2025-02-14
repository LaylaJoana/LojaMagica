# Loja Mágica Tecnologia

## Descrição

Este projeto é uma aplicação web para a Loja Mágica Tecnologia. Ele inclui uma API REST para integração com lojas parceiras, permitindo o recebimento de XMLs com informações dos pedidos. 

## Regras de Negócio

Este sistema foi desenvolvido para gerenciar pedidos de clientes, tanto pessoas físicas (PF) quanto pessoas jurídicas (PJ). A importação de pedidos é feita via arquivos XLS para clientes PF e via integração XML para clientes PJ. 

- **Cadastro de Clientes**: Os pedidos enviados assumem que os clientes já estão cadastrados no sistema. Pedidos com informações incompletas não serão integrados.
- **Produtos**: Os produtos nos pedidos devem estar cadastrados na loja. Ao cadastrar um pedido, o estoque dos produtos é atualizado.
- **Disparo de E-mails**: 
  - Ao cadastrar um novo pedido, um e-mail é enviado ao cliente informando o status.
  - Ao alterar um pedido, um e-mail é enviado ao cliente com a atualização.
  - Ao cadastrar uma nova promoção, um e-mail é enviado para  os clientes.
  - Apenas clientes que tiverem o campo `receber_emails` marcado receberão os e-mails. Verifique na caixa de entrada o assunto "Loja Mágica".

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
    docker-compose up -d --builder
    ```

## Inicialização do Banco de Dados

O projeto já vem com um arquivo SQL na pasta `docker/sql` que inicializa o sistema com inserts de clientes e produtos. Quando você inicia os serviços do Docker, o banco de dados é automaticamente configurado com esses dados iniciais.

## Testando a API

Para testar a API, você pode usar ferramentas como Postman ou cURL.

### Usando Postman

1. Abra o Postman.
2. Crie uma nova requisição.
3. Selecione o método `POST`.
4. Insira a URL do endpoint: `http://localhost:8080/api/integracao/pedidos`.
5. Vá para a aba `Body` e selecione `raw`.
6. No menu suspenso ao lado de `raw`, selecione `XML`.
7. Insira o XML que deseja enviar. Por exemplo:
    ```xml
    <pedidos>
           <pedido>
            <id_loja>001</id_loja>
            <nome_loja>Torre de Cristal</nome_loja>
            <localizacao>Planeta Zirak</localizacao>
            <produto>Cristais Místicos</produto>
            <quantidade>50</quantidade>
            </pedido>
    </pedidos>
    ```
8. Clique em `Send`.

### Usando cURL

Abra o terminal e execute o seguinte comando cURL:

```sh
curl -X POST http://localhost:8080/api/integracao/pedidos -d @path/to/your/xmlfile.xml --header "Content-Type: application/xml"
```

Substitua `path/to/your/xmlfile.xml` pelo caminho do arquivo XML que deseja enviar.

## Logs e Debugging

Se você não receber a resposta esperada, verifique os logs do servidor web e do PHP para identificar possíveis erros. Certifique-se de que todas as dependências estão instaladas e que o autoload do Composer foi atualizado corretamente com `composer dump-autoload`.

## Trabalhos Futuros

- **Histórico de Logs**: Implementar um sistema de histórico para verificar os logs de importação e integração.
- **Fila de E-mails**: Implementar uma fila de e-mails para gerenciar o envio de e-mails de forma assíncrona.
- **Cobertura de Testes Unitários**: inicializar a cobertura de testes unitários para garantir a qualidade e a estabilidade do sistema.

## Contribuição

Se você quiser contribuir para este projeto, por favor, abra uma issue ou envie um pull request.

## Dúvidas e Suporte

Em caso de dúvidas, entre em contato com Layla Joana:

E-mail: laylas.joana@gmail.com

Telefone: (79) 99971-9488
