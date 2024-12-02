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

-- Criar tabela de produtos, relacionada com fornecedores
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fornecedor_id INT,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    concluido TINYINT(1) DEFAULT 0, -- Indica se o produto está concluído
    imagem VARCHAR(255) DEFAULT NULL, -- Coluna para armazenar o caminho da imagem do produto
    FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id) ON DELETE SET NULL
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

UPDATE produtos SET imagem = 'imagens/produto1.jpg' WHERE id = 1;
UPDATE produtos SET imagem = 'imagens/produto2.jpg' WHERE id = 2;
