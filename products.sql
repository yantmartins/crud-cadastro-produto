CREATE DATABASE products;
USE products;

CREATE TABLE category(
	id_categoria INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
	descricao VARCHAR(200) NOT NULL,
    cor VARCHAR(20) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (id_categoria)
);


select * from category;
