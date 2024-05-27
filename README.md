# banco

CREATE TABLE IF NOT EXISTS contatos (
Id_contato INT NOT NULL PRIMARY KEY,
nome varchar(255) NOT NULL,
email varchar(255) NOT NULL,
cel varchar(255) NOT NULL,
pizza varchar(255) NOT NULL,
cadastro date NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS entregas (
Id_entregas INT NOT NULL PRIMARY KEY,
nome varchar(255) NOT NULL,
email varchar(255) NOT NULL,
cel varchar(255) NOT NULL,
pizza varchar(255) NOT NULL,
cadastro date NOT NULL DEFAULT CURRENT_TIMESTAMP,
situacao varchar(30)
);

CREATE TABLE IF NOT EXISTS pedido (
id_pedido SERIAL PRIMARY KEY,
id_entregas INT NOT NULL,
id_contato INT NOT NULL,
id_pizza INT NOT NULL,
data_pedido DATE NOT NULL,
CONSTRAINT fk_id_entregas FOREIGN KEY (id_entregas) REFERENCES entregas (id_entregas),
CONSTRAINT fk_id_pizza FOREIGN KEY (id_pizza) REFERENCES pizza (id_pizza),
CONSTRAINT fk_id_contato FOREIGN KEY (id_pizza) REFERENCES contatos (id_contato)
);

CREATE TABLE IF NOT EXISTS pizza (
id_pizza SERIAL PRIMARY KEY,
nome VARCHAR(255) NOT NULL,
preco DECIMAL(10,2) NOT NULL,
ingredientes TEXT NOT NULL
);

-- INSERTS TABELA CONTATOS
INSERT INTO contatos (Id_contato, nome, email, cel, pizza, cadastro) VALUES
(1, 'João Silva', 'joao@example.com', '123456789', 'Calabresa', '2024-05-24'),
(2, 'Maria Santos', 'maria@example.com', '987654321', 'Marguerita', '2024-05-24'),
(3, 'José Oliveira', 'jose@example.com', '456123789', 'Quatro Queijos', '2024-05-24'),
(4, 'Ana Pereira', 'ana@example.com', '789456123', 'Frango com Catupiry', '2024-05-24'),
(5, 'Carlos Ferreira', 'carlos@example.com', '321654987', 'Portuguesa', '2024-05-24'),
(6, 'Amanda Costa', 'amanda@example.com', '654987321', 'Pepperoni', '2024-05-24'),
(7, 'Lucas Martins', 'lucas@example.com', '147258369', 'Vegetariana', '2024-05-24'),
(8, 'Fernanda Oliveira', 'fernanda@example.com', '369258147', 'Napolitana', '2024-05-24'),
(9, 'Gabriel Lima', 'gabriel@example.com', '258369147', 'Bacon', '2024-05-24'),
(10, 'Juliana Sousa', 'juliana@example.com', '963852741', 'Mussarela', '2024-05-24');

-- INSERTS TABELA ENTREGAS
INSERT INTO entregas (Id_entregas, nome, email, cel, pizza, cadastro, situacao) VALUES
(1, 'João Silva', 'joao@example.com', '123456789', 'Calabresa', '2024-05-24', 'Entregue'),
(2, 'Maria Santos', 'maria@example.com', '987654321', 'Marguerita', '2024-05-24', 'Pendente'),
(3, 'José Oliveira', 'jose@example.com', '456123789', 'Quatro Queijos', '2024-05-24', 'Em rota de entrega'),
(4, 'Ana Pereira', 'ana@example.com', '789456123', 'Frango com Catupiry', '2024-05-24', 'Entregue'),
(5, 'Carlos Ferreira', 'carlos@example.com', '321654987', 'Portuguesa', '2024-05-24', 'Pendente'),
(6, 'Amanda Costa', 'amanda@example.com', '654987321', 'Pepperoni', '2024-05-24', 'Em rota de entrega'),
(7, 'Lucas Martins', 'lucas@example.com', '147258369', 'Vegetariana', '2024-05-24', 'Entregue'),
(8, 'Fernanda Oliveira', 'fernanda@example.com', '369258147', 'Napolitana', '2024-05-24', 'Pendente'),
(9, 'Gabriel Lima', 'gabriel@example.com', '258369147', 'Bacon', '2024-05-24', 'Em rota de entrega'),
(10, 'Juliana Sousa', 'juliana@example.com', '963852741', 'Mussarela', '2024-05-24', 'Entregue');

-- INSERTS TABELA PEDIDO
INSERT INTO pedido (id_entregas, id_contato, id_pizza, data_pedido) VALUES
(1, 1, 1, '2024-05-24'),
(2, 2, 2, '2024-05-24'),
(3, 3, 3, '2024-05-24'),
(4, 4, 4, '2024-05-24'),
(5, 5, 5, '2024-05-24'),
(6, 6, 6, '2024-05-24'),
(7, 7, 7, '2024-05-24'),
(8, 8, 8, '2024-05-24'),
(9, 9, 9, '2024-05-24'),
(10, 10, 10, '2024-05-24');

-- INSERTS TABELA PIZZA
INSERT INTO pizza (nome, preco, ingredientes) VALUES
('Calabresa', 25.00, 'Molho de tomate, mussarela, calabresa fatiada, cebola, azeitonas'),
('Marguerita', 22.00, 'Molho de tomate, mussarela, tomate, manjericão'),
('Quatro Queijos', 28.00, 'Molho de tomate, mussarela, provolone, gorgonzola, parmesão'),
('Frango com Catupiry', 30.00, 'Molho de tomate, frango desfiado, catupiry, milho, azeitonas'),
('Portuguesa', 26.00, 'Molho de tomate, mussarela, presunto, ovos, cebola, azeitonas, ervilha'),
('Pepperoni', 27.00, 'Molho de tomate, mussarela, pepperoni, cebola, pimentão'),
('Vegetariana', 29.00, 'Molho de tomate, mussarela, brócolis, champignon, cebola, pimentão, azeitonas'),
('Napolitana', 31.00, 'Molho de tomate, mussarela, tomate, manjericão, azeitonas, parmesão'),
('Bacon', 28.00, 'Molho de tomate, mussarela, bacon fatiado, cebola, azeitonas'),
('Mussarela', 23.00, 'Molho de tomate, mussarela');

-- 1
SELECT 
    pedido.id_pedido,
    contatos.nome AS nome_cliente,
    contatos.email AS email_cliente,
    contatos.cel AS celular_cliente,
    pizza.nome AS nome_pizza,
    pizza.preco AS preco_pizza,
    pizza.ingredientes AS ingredientes_pizza,
    pedido.data_pedido
FROM 
    pedido
JOIN 
    contatos ON pedido.id_contato = contatos.Id_contato
JOIN 
    pizza ON pedido.id_pizza = pizza.id_pizza;
	
-- 2
SELECT 
    pedido.id_pedido,
    pizza.nome AS nome_pizza,
    pizza.preco AS preco_pizza,
    pizza.ingredientes AS ingredientes_pizza,
    pedido.data_pedido
FROM 
    pedido
JOIN 
    pizza ON pedido.id_pizza = pizza.id_pizza;
	
--3
CREATE TABLE IF NOT EXISTS funcionarios (
    id_funcionario SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) UNIQUE NOT NULL,
    cargo VARCHAR(100) NOT NULL
);

INSERT INTO funcionarios (nome, cpf, cargo) VALUES
('João Silva', '123.456.789-00', 'Gerente de Vendas'),
('Maria Santos', '987.654.321-00', 'Assistente Administrativo'),
('José Oliveira', '456.123.789-00', 'Analista de Marketing'),
('Ana Pereira', '789.456.123-00', 'Desenvolvedor de Software'),
('Carlos Ferreira', '321.654.987-00', 'Analista Financeiro'),
('Amanda Costa', '654.987.321-00', 'Analista de Recursos Humanos'),
('Lucas Martins', '147.258.369-00', 'Designer Gráfico'),
('Fernanda Oliveira', '369.258.147-00', 'Assistente de Vendas'),
('Gabriel Lima', '258.369.147-00', 'Analista de Suporte Técnico'),
('Juliana Sousa', '963.852.741-00', 'Coordenador de Logística');

SELECT nome, cargo FROM funcionarios;

-- 4
CREATE TABLE IF NOT EXISTS pedido_funcionarios (
id_pedido_funcionarios SERIAL PRIMARY KEY,
id_pedido INT NOT NULL,
id_funcionario INT NOT NULL,
FOREIGN KEY (id_pedido) REFERENCES pedido(id_pedido),
FOREIGN KEY (id_funcionario) REFERENCES funcionarios(id_funcionario)
);

INSERT INTO pedido_funcionarios (id_pedido, id_funcionario) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

SELECT 
    pedido.id_pedido,
    entregas.situacao AS status_pedido,
    funcionarios.nome AS funcionario_responsavel
FROM 
    pedido
JOIN 
    pedido_funcionarios ON pedido.id_pedido = pedido_funcionarios.id_pedido
JOIN 
    funcionarios ON pedido_funcionarios.id_funcionario = funcionarios.id_funcionario
JOIN 
    entregas ON pedido.id_entregas = entregas.id_entregas;
	
-- 5
SELECT 
    contatos.nome AS nome_cliente,
    contatos.email AS email_cliente,
    contatos.cel AS celular_cliente,
    pedido.id_pedido,
    pedido.data_pedido,
    pizza.nome AS nome_pizza,
    pizza.preco AS preco_pizza
FROM 
    pedido
JOIN 
    contatos ON contatos.Id_contato = pedido.id_contato
JOIN 
    pizza ON pedido.id_pizza = pizza.id_pizza;


-- 6
SELECT nome, ingredientes FROM pizza;

-- 7
SELECT 
    pedido.id_pedido,
    pedido.id_entregas,
    pedido.id_contato,
    pedido.id_pizza,
    pedido.data_pedido,
    entregas.situacao AS status_entrega
FROM 
    pedido
JOIN 
    entregas ON pedido.id_entregas = entregas.Id_entregas;
	
-- 8
CREATE TABLE supervisores (
id_supervisor SERIAL PRIMARY KEY,
nome VARCHAR (255) NOT NULL
);
ALTER TABLE funcionarios
ADD COLUMN id_supervisor INT,
ADD CONSTRAINT fk_supervisor FOREIGN KEY (id_supervisor) REFERENCES SUPERVISORES(id_supervisor);

INSERT INTO supervisores (nome) VALUES
('João Silva'),
('Maria Santos'),
('José Oliveira');

INSERT INTO supervisores (nome) VALUES
('Supervisor 1'),
('Supervisor 2'),
('Supervisor 3');

UPDATE funcionarios
SET id_supervisor = 1
WHERE nome = 'Ana Pereira';

UPDATE funcionarios
SET id_supervisor = 2
WHERE nome = 'Carlos Ferreira';

UPDATE funcionarios
SET id_supervisor = 3
WHERE nome = 'Amanda Costa';

UPDATE funcionarios
SET id_supervisor = 1
WHERE nome = 'Lucas Martins';

UPDATE funcionarios
SET id_supervisor = 2
WHERE nome = 'Fernanda Oliveira';

UPDATE funcionarios
SET id_supervisor = 3
WHERE nome = 'Gabriel Lima';

UPDATE funcionarios
SET id_supervisor = 1
WHERE nome = 'Juliana Sousa';

SELECT * FROM FUNCIONARIOS

-- 9 
ALTER TABLE PIZZA
ADD COLUMN TAMANHO VARCHAR(50);

UPDATE PIZZA
SET TAMANHO = CASE 
    WHEN NOME = 'Quatro queijos' THEN 'Grande'
    WHEN NOME = 'Portuguesa' THEN 'Grande'
    WHEN NOME = 'Bacon' THEN 'Pequena'
    WHEN NOME = 'Frango com Catupiry' THEN 'Grande'
    ELSE 'Média' 
    -- Padrão para os tamanhos não selecionados, sempre que não houver seleção será o tamanho médio
END;

SELECT 
    P.ID_PEDIDO,
    PI.NOME AS NOME_PIZZA,
    PI.TAMANHO AS TAMANHO_PIZZA,
    PI.PRECO AS PRECO_PIZZA,
    PI.INGREDIENTES AS INGREDIENTES_PIZZA
FROM 
    PEDIDO P
JOIN 
    PIZZA PI ON P.ID_PIZZA = PI.ID_PIZZA;

    -- 10 
CREATE TABLE IF NOT EXISTS PROMOCOES (
    ID_PROMOCAO SERIAL PRIMARY KEY,
    NOME_PROMOCAO VARCHAR(255) NOT NULL,
    DESCONTO DECIMAL(5,2) NOT NULL
);

INSERT INTO PROMOCOES (NOME_PROMOCAO, DESCONTO) VALUES
    ('Desconto de 10%', 0.10),
    ('Primeiro pedido', 0.15),
    ('Combo Família', 0.20);


ALTER TABLE PIZZA
ADD COLUMN ID_PROMOCAO INT,
ADD CONSTRAINT FK_ID_PROMOCAO FOREIGN KEY (ID_PROMOCAO) REFERENCES PROMOCOES(ID_PROMOCAO);


UPDATE PIZZA
SET ID_PROMOCAO = 1
WHERE NOME = 'Bacon';

UPDATE PIZZA
SET ID_PROMOCAO = 2
WHERE NOME = 'Pepperoni';

UPDATE PIZZA
SET ID_PROMOCAO = 3
WHERE NOME = 'Calabresa';

UPDATE PIZZA
SET ID_PROMOCAO = 1
WHERE NOME = 'Quatro queijos';

UPDATE PIZZA    
SET ID_PROMOCAO = 2
WHERE NOME = 'Portuguesa';

UPDATE PIZZA
SET ID_PROMOCAO = 3
WHERE NOME = 'Frango com Catupiry';



SELECT 
    P.NOME AS NOME_PIZZA,
    PR.NOME_PROMOCAO AS PROMOCAO,
    PR.DESCONTO AS DESCONTO_PROMOCAO
FROM 
    PIZZA P
LEFT JOIN 
    PROMOCOES PR ON P.ID_PROMOCAO = PR.ID_PROMOCAO;

-- SEGUNDA PARTE
-- 1
SELECT DISTINCT
    C.ID_CONTATO,
    C.NOME AS NOME_CLIENTE,
    C.EMAIL AS EMAIL_CLIENTE,
    C.CEL AS CELULAR_CLIENTE
FROM 
    CONTATOS C
JOIN 
    PEDIDO P ON C.ID_CONTATO = P.ID_CONTATO;

-- 2 
SELECT 
    P.ID_PEDIDO,
    P.ID_ENTREGAS,
    E.NOME AS NOME_CLIENTE,
    E.EMAIL AS EMAIL_CLIENTE,
    E.CEL AS CELULAR_CLIENTE,
    E.PIZZA AS PIZZA_ENTREGA,
    E.CADASTRO AS DATA_ENTREGA,
    E.SITUACAO AS STATUS_ENTREGA
FROM 
    PEDIDO P
JOIN 
    ENTREGAS E ON P.ID_ENTREGAS = E.ID_ENTREGAS
WHERE 
    P.DATA_PEDIDO BETWEEN '2024-05-01' AND '2024-05-31';

-- 3 
SELECT 
    P.ID_PEDIDO,
    PI.NOME AS NOME_PIZZA,
    PI.PRECO AS PRECO_PIZZA,
    PI.INGREDIENTES AS INGREDIENTES_PIZZA
FROM 
    PEDIDO P
JOIN 
    PIZZA PI ON P.ID_PIZZA = PI.ID_PIZZA
WHERE 
    P.ID_PEDIDO = 1;

-- 4
SELECT 
    C.NOME AS NOME_CLIENTE,
    SUM(PI.PRECO) AS TOTAL_GASTO
FROM 
    CONTATOS C
JOIN 
    PEDIDO P ON C.ID_CONTATO = P.ID_CONTATO
JOIN 
    PIZZA PI ON P.ID_PIZZA = PI.ID_PIZZA
WHERE 
    C.ID_CONTATO = 1 
GROUP BY 
    C.NOME;

-- 5
SELECT 
    PI.NOME AS NOME_PIZZA,
    COUNT(*) AS QUANTIDADE_PEDIDOS
FROM 
    PEDIDO P
JOIN 
    PIZZA PI ON P.ID_PIZZA = PI.ID_PIZZA
GROUP BY 
    PI.NOME
ORDER BY 
    QUANTIDADE_PEDIDOS DESC;

-- 6
SELECT 
    NOME AS NOME_PIZZA,
    PRECO,
    INGREDIENTES
FROM 
    PIZZA
WHERE 
    NOME = 'Bacon';

-- 7
SELECT 
    funcionarios.id_funcionario,
    funcionarios.nome AS nome_funcionario,
    funcionarios.cargo,
    supervisores.nome AS nome_supervisor
FROM 
    funcionarios
LEFT JOIN 
    supervisores ON funcionarios.id_supervisor = supervisores.id_supervisor;

-- 8
    CREATE TABLE HORARIOS_FUNCIONAMENTO (
    ID INT PRIMARY KEY,
    DIA_SEMANA VARCHAR(50) NOT NULL,
    ABERTURA TIME NOT NULL,
    FECHAMENTO TIME NOT NULL
);

INSERT INTO HORARIOS_FUNCIONAMENTO (ID, DIA_SEMANA, ABERTURA, FECHAMENTO) VALUES
(1, 'Segunda-feira', '10:00:00', '22:00:00'),
(2, 'Terça-feira', '10:00:00', '22:00:00'),
(3, 'Quarta-feira', '10:00:00', '22:00:00'),
(4, 'Quinta-feira', '10:00:00', '22:00:00'),
(5, 'Sexta-feira', '10:00:00', '23:00:00'),
(6, 'Sábado', '11:00:00', '23:00:00'),
(7, 'Domingo', '11:00:00', '21:00:00');

SELECT 
    DIA_SEMANA,
    ABERTURA,
    FECHAMENTO
FROM 
    HORARIOS_FUNCIONAMENTO;


-- 9
SELECT 
    P.ID_PEDIDO,
    C.NOME AS NOME_CLIENTE,
    C.EMAIL AS EMAIL_CLIENTE,
    C.CEL AS CELULAR_CLIENTE,
    PI.NOME AS NOME_PIZZA,
    P.DATA_PEDIDO,
    E.SITUACAO AS STATUS_ENTREGA
FROM 
    PEDIDO P
JOIN 
    CONTATOS C ON P.ID_CONTATO = C.ID_CONTATO
JOIN 
    PIZZA PI ON P.ID_PIZZA = PI.ID_PIZZA
JOIN 
    ENTREGAS E ON P.ID_ENTREGAS = E.ID_ENTREGAS
WHERE 
    E.SITUACAO = 'Em Andamento';


-- 10 
ALTER TABLE ENTREGAS
ADD COLUMN DATA_ENTREGA TIMESTAMP;

SELECT 
    AVG(EXTRACT(EPOCH FROM (E.DATA_ENTREGA - P.DATA_PEDIDO)) / 60) AS TEMPO_MEDIO_ESPERA_MINUTOS
FROM 
    PEDIDO P
JOIN 
    ENTREGAS E ON P.ID_ENTREGAS = E.ID_ENTREGAS
WHERE 
    E.DATA_ENTREGA IS NOT NULL;



















