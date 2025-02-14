CREATE DATABASE IF NOT EXISTS loja_magica;
USE loja_magica;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NULL,
    endereco TEXT NULL,
    receber_emails ENUM('S', 'N') DEFAULT 'N' NULL,
    tipo ENUM('PJ', 'PF')  NULL, 
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP() NOT NULL,
    CONSTRAINT email UNIQUE (email)
);

CREATE TABLE importacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('xlsx') NOT NULL,
    arquivo VARCHAR(255) NULL,
    data_importacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP() NOT NULL
);

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NULL,
    status ENUM('pendente', 'processando', 'enviado', 'cancelado', 'concluido') DEFAULT 'pendente' NULL,
    data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP() NOT NULL,
    valor_total DECIMAL(10, 2) NULL,
    CONSTRAINT pedidos_ibfk_1 FOREIGN KEY (cliente_id) REFERENCES clientes (id)
);

CREATE TABLE itens_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NULL,
    produto_id INT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10, 2) NOT NULL,
    CONSTRAINT itens_pedido_ibfk_1 FOREIGN KEY (pedido_id) REFERENCES pedidos (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX idx_itens_pedido_pedido ON itens_pedido (pedido_id);
CREATE INDEX idx_itens_pedido_produto ON itens_pedido (produto_id);
CREATE INDEX idx_pedidos_cliente ON pedidos (cliente_id);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    estoque INT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP() NOT NULL
);

CREATE TABLE promocoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NULL,
    desconto DECIMAL(5, 2) NULL,
    data_inicio DATE NOT NULL,
    data_fim DATE NOT NULL
);

CREATE TABLE clientes_promocoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NULL,
    promocao_id INT NULL,
    CONSTRAINT clientes_promocoes_ibfk_1 FOREIGN KEY (cliente_id) REFERENCES clientes (id),
    CONSTRAINT clientes_promocoes_ibfk_2 FOREIGN KEY (promocao_id) REFERENCES promocoes (id)
);

CREATE INDEX idx_clientes_email ON clientes (email);
CREATE INDEX cliente_id ON clientes_promocoes (cliente_id);
CREATE INDEX promocao_id ON clientes_promocoes (promocao_id);
CREATE INDEX idx_promocoes_data ON promocoes (data_inicio, data_fim);


-- Inserção dos clientes da Loja Mágica (PF)
INSERT INTO clientes (tipo, nome, email, telefone, endereco) VALUES
('PF', 'Alex Magus', 'alex@magia.com', NULL, NULL),
('PF', 'Bianca Feiticeira', 'bianca@feiticeiro.com', NULL, NULL),
('PF', 'Elena das Sombras', 'elena@sombras.com', NULL, NULL),
('PF', 'Fábio Luminoso', 'fabio@luz.com', NULL, NULL),
('PF', 'Gisela da Terra', 'gisela@terra.com', NULL, NULL),
('PF', 'Hector Vento Veloz', 'hector@vento.com', NULL, NULL),
('PF', 'Irina Flamejante', 'irina@fogo.com', NULL, NULL),
('PF', 'João', 'joao@magia.com', NULL, NULL);

-- Inserção das lojas de Pedidos_Outras_Lojas.xml (PJ)
INSERT INTO clientes (tipo, nome, email, telefone, endereco) VALUES
('PJ', 'Torre de Cristal', 'torredecristal@zirak.com', NULL, 'Planeta Zirak'),
('PJ', 'Floresta Encantada', 'florestaencantada@elyria.com', NULL, 'Reino de Elyria'),
('PJ', 'Deserto dos Ventos', 'desertodosventos@kaitos.com', NULL, 'Planeta Kaitos'),
('PJ', 'Cavernas Submersas', 'cavernassubmersas@neptar.com', NULL, 'Mundo Aquático de Neptar'),
('PJ', 'Vulcões Adormecidos', 'vulcoesadormecidos@ilhasdefogo.com', NULL, 'Ilhas de Fogo');


-- Inserção dos produtos da Loja Mágica
INSERT INTO produtos (nome, descricao, preco, estoque) VALUES
('Varinha Mágica', 'Varinha para lançar feitiços poderosos', 120.00, 10),
('Poção de Cura', 'Poção que restaura a saúde', 85.00, 20),
('Livro dos Encantamentos', 'Livro com feitiços antigos', 150.00, 5),
('Capa da Invisibilidade', 'Capa que torna o usuário invisível', 200.00, 3),
('Cristal Encantado', 'Cristal com poderes mágicos', 200.00, 8),
('Sementes Mágicas', 'Sementes que crescem instantaneamente', 60.00, 15),
('Elixir de Velocidade', 'Elixir que aumenta a velocidade', 100.00, 12),
('Orbe do Fogo', 'Orbe que controla o elemento fogo', 95.00, 7),
('Mapa Estelar', 'Mapa que mostra constelações mágicas', 50.00, 9);

-- Inserção dos produtos de outras lojas
INSERT INTO produtos (nome, descricao, preco, estoque) VALUES
('Cristais Místicos', 'Cristais com energia mística', 300.00, 50),
('Poções de Juventude', 'Poções que rejuvenecem o usuário', 250.00, 30),
('Areia Mágica', 'Areia com propriedades mágicas', 100.00, 70),
('Pérolas de Energia', 'Pérolas que armazenam energia', 400.00, 40),
('Lava Encantada', 'Lava com poderes mágicos', 500.00, 20);

