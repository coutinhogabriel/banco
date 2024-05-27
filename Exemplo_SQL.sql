-- Geração de Modelo físico

-- Sql ANSI 2003 - brModelo.

CREATE DATABASE EXEMPLO;

CREATE TABLE Cliente (
id_cliente serial NOT NULL PRIMARY KEY,
nome_cliente varchar(50),
celular_cliente varchar(15),
cpf_cliente varchar(14) NOT NULL 
);

CREATE TABLE Produto (
qntd_produto int,
id_produto serial PRIMARY KEY,
valor_produto decimal(7,2) NOT NULL
);

CREATE TABLE Compra (
id_pedido serial PRIMARY KEY,
data_compra_produto date,
id_produto INT,
id_cliente INT,
FOREIGN KEY(id_produto) REFERENCES Produto (id_produto),
FOREIGN KEY(id_cliente) REFERENCES Cliente (id_cliente)
);

SELECT *FROM CLIENTE, PRODUTO

