Maryanna — Por Duas, Para Todas

O Maryanna é uma lojinha virtual de kits de cuidado capilar, feita pra treinar o básico de um e-commerce: vitrine de produtos, cadastro, login, sacola de compras e finalização de pedido com escolha de pagamento (PIX, Boleto ou Cartão).

O cliente entra no site, escolhe o kit ideal pro tipo de cabelo dele (cacheado, crespo, liso ou ondulado), adiciona à sacola, faz login (ou cria uma conta, se ainda não tiver) e finaliza a compra. Tudo isso é salvo num banco de dados MySQL — cadastro, login e histórico de pedidos.

PHP, HTML, CSS e MySQL.





CREATE TABLE IF NOT EXISTS clientes (
  Id INT AUTO_INCREMENT PRIMARY KEY,
  NomeCompleto VARCHAR(150),
  CPF VARCHAR(11),
  Endereco VARCHAR(150),
  Bairro VARCHAR(80),
  Cidade VARCHAR(80),
  Estado VARCHAR(2),
  CEP VARCHAR(9)
);
 
CREATE TABLE IF NOT EXISTS acessos (
  Id INT AUTO_INCREMENT PRIMARY KEY,
  Usuario VARCHAR(50),
  SenhaHash VARCHAR(32),
  CPF VARCHAR(11)
);
 
CREATE TABLE IF NOT EXISTS pedidos (
  Id INT AUTO_INCREMENT PRIMARY KEY,
  Codigo VARCHAR(30),
  Usuario VARCHAR(50),
  NomeCliente VARCHAR(150),
  Itens TEXT,
  DataHora VARCHAR(30),
  ValorTotal VARCHAR(20),
  FormaPagamento VARCHAR(30)
);
