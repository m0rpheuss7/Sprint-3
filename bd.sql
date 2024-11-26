DROP DATABASE IF EXISTS sistema_cadastro;

-- Criar banco de dados
CREATE DATABASE sistema_cadastro;

-- Informar à IDE que este é o banco que estará em uso.
USE sistema_cadastro;

-- Criar a tabela de usuários com a coluna 'tipo'
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('admin', 'usuario') DEFAULT 'usuario'  -- Coluna tipo adicionada
);

-- Criar a tabela de fornecedores
CREATE TABLE fornecedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefone VARCHAR(20)
);

-- Criar a tabela de produtos, relacionada via FK com a tabela de fornecedores
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fornecedor_id INT,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2),
    FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id)
);

-- Adicionar a coluna 'concluido' na tabela produtos
ALTER TABLE produtos ADD COLUMN concluido TINYINT(1) DEFAULT 0;

-- Cadastrar um usuário com tipo 'admin' e outros com tipo 'usuario'
INSERT INTO usuarios (usuario, senha, tipo) VALUES ('admin', MD5('admin123'), 'admin');
INSERT INTO usuarios (usuario, senha, tipo) VALUES ('ramon', MD5('ramon123'), 'usuario');
INSERT INTO usuarios (usuario, senha, tipo) VALUES ('giba', MD5('giba123'), 'usuario');
INSERT INTO usuarios (usuario, senha, tipo) VALUES ('paulão', MD5('paulão123'), 'usuario');
INSERT INTO usuarios (usuario, senha, tipo) VALUES ('alves', MD5('alves123'), 'usuario');
INSERT INTO usuarios (usuario, senha, tipo) VALUES ('marcos', MD5('marcos123'), 'usuario');


>>>>>>> 4c7ba863ed6ca900e9229f2863d79fbe5a7d248a
