-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Tempo de geração: 12-Dez-2019 às 01:50
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Banco de dados: `banco_hamburgueria`
--
CREATE DATABASE IF NOT EXISTS `banco_hamburgueria` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `banco_hamburgueria`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cli` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `telefone` varchar(25) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cli`, `nome`, `endereco`, `cidade`, `telefone`, `email`, `senha`) VALUES
(1, 'Fabi', 'Rua de Teste', 'Marília', '1498989898', 'faby@mail.com', '123123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens`
--

CREATE TABLE `itens` (
  `id_item` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `quantidade` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `itens`
--

INSERT INTO `itens` (`id_item`, `id_pedido`, `id_prod`, `quantidade`) VALUES
(20, 21, 1, 2),
(21, 22, 1, 2),
(22, 22, 4, 2),
(23, 22, 3, 2),
(24, 23, 1, 1),
(25, 23, 4, 1),
(26, 24, 3, 1),
(27, 24, 4, 1),
(28, 25, 1, 1),
(29, 26, 3, 1),
(30, 26, 3, 1),
(31, 26, 4, 1),
(32, 26, 2, 1),
(33, 27, 2, 1),
(34, 28, 3, 1),
(35, 28, 4, 1),
(36, 28, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  `id_cli` int(11) NOT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'EM PREPARO',
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `observacao`, `id_cli`, `total`, `status`, `data`) VALUES
(21, NULL, 1, '75.80', 'EM PREPARO', '2019-12-11 22:57:22'),
(22, NULL, 1, '199.40', 'EM PREPARO', '2019-12-11 22:57:22'),
(23, NULL, 1, '71.80', 'EM PREPARO', '2019-12-09 22:57:22'),
(24, NULL, 1, '61.80', 'EM PREPARO', '2019-12-11 22:57:41'),
(25, NULL, 1, '37.90', 'EM PREPARO', '2019-12-12 00:01:02'),
(26, NULL, 1, '122.60', 'EM PREPARO', '2019-12-12 00:07:00'),
(27, NULL, 1, '32.90', 'EM PREPARO', '2019-12-12 01:18:03'),
(28, NULL, 1, '94.70', 'EM PREPARO', '2019-12-12 01:25:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_prod` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(8,2) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `descricao` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_prod`, `nome`, `preco`, `imagem`, `descricao`) VALUES
(1, 'BBQ Bacon Burger', '37.90', 'bbqbaconburger.png', 'Delicioso hamburguer artesanal de 180gr, <br>\r\n        no pão brioche, queijo emmenthal, bacon e <br>\r\n        crispy de provolone.'),
(2, 'Cheese Salad Burger', '32.90', 'xsalad.png', 'Hamburguer de 180gr, pão brioche, alface, <br>\r\n          tomate, queijo prato e molho barbecue.'),
(3, 'Cheese Burger', '27.90', 'xburger.png', 'Hamburguer angus de 180gr, pão da casa, <br>\r\n            e queijo cheddar derretido.'),
(4, 'Veggie Burger', '33.90', 'veggie.png', 'Hamburguer vegetariano feito de brotos, <br>\r\n               alface, tomate e queijo mussarela.');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cli`);

--
-- Índices para tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_prod` (`id_prod`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cli` (`id_cli`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_prod`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `itens`
--
ALTER TABLE `itens`
  ADD CONSTRAINT `itens_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  ADD CONSTRAINT `itens_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `produto` (`id_prod`);

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cli`) REFERENCES `cliente` (`id_cli`);
