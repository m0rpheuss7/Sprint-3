DROP DATABASE IF EXISTS sistema_cadastro;

-- criar banco de dados
CREATE DATABASE sistema_cadastro;

-- informar à IDE que este é o banco que estará em uso.
USE sistema_cadastro;

-- criar a tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- criar a tabela de formecedores
CREATE TABLE fornecedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefone VARCHAR(20)
);

-- criar a tabela de produtos relacionada via FK com a tabela de fornecedores
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fornecedor_id INT,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2),
    FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id)
);

-- cadastrar um usuário
INSERT INTO usuarios (usuario, senha) VALUES ('admin', MD5('admin123'));
INSERT INTO usuarios (usuario, senha) VALUES ('ramon', MD5('ramon123'));
INSERT INTO usuarios (usuario, senha) VALUES ('giba', MD5('giba123'));
INSERT INTO usuarios (usuario, senha) VALUES ('paulão', MD5('paulão123'));
INSERT INTO usuarios (usuario, senha) VALUES ('alves', MD5('alves123'));
INSERT INTO usuarios (usuario, senha) VALUES ('marcos', MD5('marcos123'));

-- check concluido
<<<<<<< HEAD
ALTER TABLE produtos ADD COLUMN concluido TINYINT(1) DEFAULT 0;
=======
ALTER TABLE produtos ADD COLUMN concluido TINYINT(1) DEFAULT 0;


>>>>>>> 4c7ba863ed6ca900e9229f2863d79fbe5a7d248a
