-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Nov-2022 às 03:09
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `racao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id` int(11) NOT NULL,
  `descricao` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ingredientes`
--

INSERT INTO `ingredientes` (`id`, `descricao`) VALUES
(39, 'Paçoca'),
(40, 'Pastel'),
(41, 'Mandioca'),
(42, 'Batata'),
(43, 'Carne'),
(44, 'Pipoca'),
(45, 'Paçoca'),
(46, 'Tang'),
(47, 'bola'),
(48, 'Ferro'),
(53, 'Bolacha'),
(56, 'Gato');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas`
--

CREATE TABLE `receitas` (
  `id` int(11) NOT NULL,
  `descricao` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `receitas`
--

INSERT INTO `receitas` (`id`, `descricao`) VALUES
(14, 'Melancia'),
(15, 'Farofa'),
(16, 'Tutu'),
(17, 'Leite'),
(21, 'Papa'),
(23, 'Pé'),
(26, 'Lindo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas_ingredientes`
--

CREATE TABLE `receitas_ingredientes` (
  `id` int(11) NOT NULL,
  `id_receita` int(11) DEFAULT NULL,
  `id_ingrediente` int(11) DEFAULT NULL,
  `quant` float DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `receitas_ingredientes`
--

INSERT INTO `receitas_ingredientes` (`id`, `id_receita`, `id_ingrediente`, `quant`, `ordem`) VALUES
(42, 16, 45, 5, 3),
(43, 16, 46, 15, 1),
(44, 16, 47, 1, 2),
(46, 17, 46, 5, 6),
(49, 17, 48, 2, 2),
(50, 17, 48, 2, 3),
(53, 17, 46, 2, 4),
(54, 14, 40, 1, 1),
(56, 14, 42, 1, 2),
(57, 14, 39, 2, 9),
(59, 14, 48, 1, 4),
(60, 14, 43, 2, 5),
(62, 17, 46, 1, 5),
(65, 17, 41, 2, 1),
(66, 26, 56, 2, 1),
(67, 14, 44, 2, 6),
(68, 14, 44, 4, 7),
(69, 23, 43, 66, 1),
(70, 14, 39, 5, 8),
(71, 14, 40, 1, 10),
(72, 14, 39, 2, 3),
(73, 14, 39, 5, 11),
(74, 16, 40, 5, 3),
(76, 16, 40, 5, 4),
(78, 16, 39, 5, 5),
(79, 26, 40, 2, 2),
(85, 21, 53, 56, 1),
(86, 23, 40, 5, 2),
(87, 23, 39, 9, 3),
(89, 15, 43, 6, 1),
(90, 15, 47, 2, 2),
(91, 15, 48, 6, 3),
(92, 21, 41, 1, 2),
(93, 21, 53, 3, 3),
(94, 26, 42, 1, 3),
(95, 26, 56, 1, 4);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `receitas`
--
ALTER TABLE `receitas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `receitas_ingredientes`
--
ALTER TABLE `receitas_ingredientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ingrediente` (`id_ingrediente`),
  ADD KEY `id_receita` (`id_receita`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de tabela `receitas`
--
ALTER TABLE `receitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `receitas_ingredientes`
--
ALTER TABLE `receitas_ingredientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `receitas_ingredientes`
--
ALTER TABLE `receitas_ingredientes`
  ADD CONSTRAINT `receitas_ingredientes_ibfk_1` FOREIGN KEY (`id_ingrediente`) REFERENCES `ingredientes` (`id`),
  ADD CONSTRAINT `receitas_ingredientes_ibfk_2` FOREIGN KEY (`id_receita`) REFERENCES `receitas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
