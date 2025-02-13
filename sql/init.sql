CREATE DATABASE IF NOT EXISTS loja_magica;
USE loja_magica;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NULL,
    endereco TEXT NULL,
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

-- Inserir dados nas tabelas
INSERT INTO clientes (nome, email, telefone, endereco) VALUES
('João Silva', 'joao.silva@example.com', '123456789', 'Rua A, 123'),
('Maria Oliveira', 'maria.oliveira@example.com', '987654321', 'Rua B, 456');

INSERT INTO produtos (nome, descricao, preco, estoque) VALUES
('Produto 1', 'Descrição do Produto 1', 100.00, 50),
('Produto 2', 'Descrição do Produto 2', 200.00, 30);

INSERT INTO pedidos (cliente_id, status, valor_total) VALUES
(1, 'pendente', 300.00),
(2, 'processando', 200.00);

INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, preco_unitario) VALUES
(1, 1, 2, 100.00),
(1, 2, 1, 200.00),
(2, 2, 1, 200.00);

INSERT INTO promocoes (nome, descricao, desconto, data_inicio, data_fim) VALUES
('Promoção de Verão', 'Desconto especial de verão', 10.00, '2023-12-01', '2023-12-31'),
('Promoção de Inverno', 'Desconto especial de inverno', 15.00, '2024-01-01', '2024-01-31');

INSERT INTO clientes_promocoes (cliente_id, promocao_id) VALUES
(1, 1),
(2, 2);