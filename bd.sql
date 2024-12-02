-- Remover o banco de dados existente, se houver
DROP DATABASE IF EXISTS sistema_cadastro;

-- Criar banco de dados
CREATE DATABASE sistema_cadastro;

-- Selecionar o banco de dados em uso
USE sistema_cadastro;

-- Criar tabela de usuários com coluna 'tipo'
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('admin', 'usuario') DEFAULT 'usuario' -- Define tipos de usuário
);

-- Criação da tabela de produtos
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2),
    fornecedor_id INT,
    concluido BOOLEAN DEFAULT 0,
    imagem VARCHAR(255) DEFAULT 'imagens/default.jpg' -- Definindo valor default para a imagem
);

-- Criação da tabela de contratos
CREATE TABLE IF NOT EXISTS contratos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    data_contrato DATE NOT NULL,
    cliente_nome VARCHAR(100) NOT NULL,
    cliente_email VARCHAR(100),
    observacoes TEXT,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
);

-- Criação da tabela de pedidos
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_comprador VARCHAR(255) NOT NULL,
    email_comprador VARCHAR(255) NOT NULL,
    telefone_comprador VARCHAR(20) NOT NULL,
    pagamento VARCHAR(50) NOT NULL,
    horario TIME,
    total DECIMAL(10, 2) NOT NULL,
    data_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criação da tabela de itens de pedidos
CREATE TABLE itens_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    valor_item DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

-- Inserir usuários de exemplo
INSERT INTO usuarios (usuario, senha, tipo) 
VALUES 
    ('admin', MD5('admin123'), 'admin'),
    ('ramon', MD5('ramon123'), 'usuario'),
    ('giba', MD5('giba123'), 'usuario'),
    ('paulão', MD5('paulão123'), 'usuario'),
    ('alves', MD5('alves123'), 'usuario'),
    ('marcos', MD5('marcos123'), 'usuario');

-- Atualização das imagens dos produtos
UPDATE produtos SET imagem = 'imagens/produto1.jpg' WHERE id = 1;
UPDATE produtos SET imagem = 'imagens/produto2.jpg' WHERE id = 2;
