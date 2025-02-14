SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS loja_magica;
USE loja_magica;

create table clientes
(
    id             int auto_increment
        primary key,
    receber_emails enum ('N', 'S') default 'N'                 null,
    tipo           enum ('PF', 'PJ')                           null,
    nome           varchar(255)                                not null,
    email          varchar(255)                                not null,
    telefone       varchar(20)                                 null,
    endereco       text                                        null,
    criado_em      timestamp       default current_timestamp() not null,
    constraint email
        unique (email)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

create index idx_clientes_email
    on clientes (email);

create table importacoes
(
    id              int auto_increment
        primary key,
    tipo            enum ('xlsx')                         not null,
    arquivo         varchar(255)                          null,
    data_importacao timestamp default current_timestamp() not null
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

create table pedidos
(
    id          int auto_increment
        primary key,
    cliente_id  int                                                                                               null,
    status      enum ('pendente', 'processando', 'enviado', 'cancelado', 'concluido') default 'pendente'          null,
    data_pedido timestamp                                                             default current_timestamp() not null,
    valor_total decimal(10, 2)                                                                                    null,
    constraint pedidos_ibfk_1
        foreign key (cliente_id) references clientes (id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

create table itens_pedido
(
    id             int auto_increment
        primary key,
    pedido_id      int            null,
    produto_id     int            null,
    quantidade     int            not null,
    preco_unitario decimal(10, 2) not null,
    constraint itens_pedido_ibfk_1
        foreign key (pedido_id) references pedidos (id)
            on update cascade on delete cascade
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

create index idx_itens_pedido_pedido
    on itens_pedido (pedido_id);

create index idx_itens_pedido_produto
    on itens_pedido (produto_id);

create index idx_pedidos_cliente
    on pedidos (cliente_id);

create table produtos
(
    id        int auto_increment
        primary key,
    nome      varchar(255)                          not null,
    descricao text                                  null,
    preco     decimal(10, 2)                        not null,
    estoque   int                                   not null,
    criado_em timestamp default current_timestamp() not null
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

create table promocoes
(
    id          int auto_increment
        primary key,
    nome        varchar(255)  not null,
    descricao   text          null,
    desconto    decimal(5, 2) null,
    data_inicio date          not null,
    data_fim    date          not null
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

create table clientes_promocoes
(
    id          int auto_increment
        primary key,
    cliente_id  int null,
    promocao_id int null,
    constraint clientes_promocoes_ibfk_1
        foreign key (cliente_id) references clientes (id),
    constraint clientes_promocoes_ibfk_2
        foreign key (promocao_id) references promocoes (id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

create index cliente_id
    on clientes_promocoes (cliente_id);

create index promocao_id
    on clientes_promocoes (promocao_id);

create index idx_promocoes_data
    on promocoes (data_inicio, data_fim);

--  Cadastrar Produtos
INSERT INTO produtos (nome, descricao, preco, estoque)
VALUES (
        'Varinha Mágica',
        'Varinha para lançar feitiços poderosos',
        120.00,
        10
    ),
    (
        'Poção de Cura',
        'Poção que restaura a saúde',
        85.00,
        20
    ),
    (
        'Livro dos Encantamentos',
        'Livro com feitiços antigos',
        150.00,
        5
    ),
    (
        'Capa da Invisibilidade',
        'Capa que torna o usuário invisível',
        200.00,
        3
    ),
    (
        'Cristal Encantado',
        'Cristal com poderes mágicos',
        200.00,
        8
    ),
    (
        'Sementes Mágicas',
        'Sementes que crescem instantaneamente',
        60.00,
        15
    ),
    (
        'Elixir de Velocidade',
        'Elixir que aumenta a velocidade',
        100.00,
        12
    ),
    (
        'Orbe do Fogo',
        'Orbe que controla o elemento fogo',
        95.00,
        7
    ),
    (
        'Mapa Estelar',
        'Mapa que mostra constelações mágicas',
        50.00,
        9
    ),
    (
        'Cristais Místicos',
        'Cristais com energia mística',
        300.00,
        50
    ),
    (
        'Poções de Juventude',
        'Poções que rejuvenecem o usuário',
        250.00,
        30
    ),
    (
        'Areia Mágica',
        'Areia com propriedades mágicas',
        100.00,
        70
    ),
    (
        'Pérolas de Energia',
        'Pérolas que armazenam energia',
        400.00,
        40
    ),
    (
        'Lava Encantada',
        'Lava com poderes mágicos',
        500.00,
        20
    );
-- Inserção dos clientes da Loja Mágica (PF)
INSERT INTO clientes (tipo, nome, email, telefone, endereco)
VALUES ('PF', 'Alex Magus', 'alex@magia.com', NULL, NULL),
    (
        'PF',
        'Bianca Feiticeira',
        'bianca@feiticeiro.com',
        NULL,
        NULL
    ),
    (
        'PF',
        'Elena das Sombras',
        'elena@sombras.com',
        NULL,
        NULL
    ),
    (
        'PF',
        'Fábio Luminoso',
        'fabio@luz.com',
        NULL,
        NULL
    ),
    (
        'PF',
        'Gisela da Terra',
        'gisela@terra.com',
        NULL,
        NULL
    ),
    (
        'PF',
        'Hector Vento Veloz',
        'hector@vento.com',
        NULL,
        NULL
    ),
    (
        'PF',
        'Irina Flamejante',
        'irina@fogo.com',
        NULL,
        NULL
    ),
    (
        'PF',
        'João',
        'joao@magia.com',
        NULL,
        NULL
    ),
    (
        'PJ',
        'Torre de Cristal',
        'torredecristal@zirak.com',
        NULL,
        'Planeta Zirak'
    ),
    (
        'PJ',
        'Floresta Encantada',
        'florestaencantada@elyria.com',
        NULL,
        'Reino de Elyria'
    ),
    (
        'PJ',
        'Deserto dos Ventos',
        'desertodosventos@kaitos.com',
        NULL,
        'Planeta Kaitos'
    ),
    (
        'PJ',
        'Cavernas Submersas',
        'cavernassubmersas@neptar.com',
        NULL,
        'Mundo Aquático de Neptar'
    ),
    (
        'PJ',
        'Vulcões Adormecidos',
        'vulcoesadormecidos@ilhasdefogo.com',
        NULL,
        'Ilhas de Fogo'
    );
