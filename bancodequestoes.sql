-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 17, 2025 at 04:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bancodequestoes`
--

-- --------------------------------------------------------

--
-- Table structure for table `assuntos`
--

CREATE TABLE `assuntos` (
  `id_assuntos` int(11) NOT NULL,
  `nome_assunto` varchar(255) NOT NULL,
  `id_disciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assuntos`
--

INSERT INTO `assuntos` (`id_assuntos`, `nome_assunto`, `id_disciplina`) VALUES
(1, 'Verbo', 2),
(2, 'Multiplicação', 1),
(3, 'Orgânica', 3);

-- --------------------------------------------------------

--
-- Table structure for table `disciplinas`
--

CREATE TABLE `disciplinas` (
  `id_disciplina` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disciplinas`
--

INSERT INTO `disciplinas` (`id_disciplina`, `nome`) VALUES
(1, 'Matemática'),
(2, 'Português'),
(3, 'Química');

-- --------------------------------------------------------

--
-- Table structure for table `professores`
--

CREATE TABLE `professores` (
  `id_professor` int(11) NOT NULL,
  `nome_professor` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `id_disciplina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professores`
--

INSERT INTO `professores` (`id_professor`, `nome_professor`, `senha`, `id_disciplina`) VALUES
(1, 'Carlos Andrade Lemos', 'senha123', 3),
(2, 'Luciana Reis', 'senha456', 2),
(3, 'Paulo Silva', 'senha789', 3),
(4, 'Denis da Silva Costa', 'denis123', 1),
(5, 'Gabriel Rodrigues Lemos', 'ssss', 1),
(6, 'Fernando Hélio', '1234', 1),
(7, 'Armênio da silva', '4321', 2),
(8, 'Pedro Aquino', 'pedro', 1),
(9, 'Walter White', 'meth', 3);

-- --------------------------------------------------------

--
-- Table structure for table `questoes`
--

CREATE TABLE `questoes` (
  `id_questao` int(11) NOT NULL,
  `pergunta` text NOT NULL,
  `id_assuntos` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questoes`
--

INSERT INTO `questoes` (`id_questao`, `pergunta`, `id_assuntos`, `id_disciplina`) VALUES
(3, 'Conjugue o verbo andar', 1, 2),
(5, 'Pedro tem 10 cedulas de 50 reais. Quanto dinheiro Pedro tem no total?', 2, 1),
(10, 'Pedro tem 10 cedulas de 50 reais. Quanto dinheiro Pedro tem no total?', 2, 1),
(11, 'A fórmula geral dos hidrocarbonetos de cadeia aberta que contém uma dupla ligação é CnH2n\r\ne são conhecidos por alquenos ou alcenos. Escreva a fórmula estrutural e dê o nome do segundo composto da série', 3, 3),
(13, 'Quanto é 2 vezes 9', 2, 1),
(14, 'Na frase \"Pois bem, cheguei.\" identifique o verbo.', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assuntos`
--
ALTER TABLE `assuntos`
  ADD PRIMARY KEY (`id_assuntos`),
  ADD KEY `id_disciplina` (`id_disciplina`);

--
-- Indexes for table `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`id_disciplina`);

--
-- Indexes for table `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`id_professor`),
  ADD KEY `id_disciplina` (`id_disciplina`);

--
-- Indexes for table `questoes`
--
ALTER TABLE `questoes`
  ADD PRIMARY KEY (`id_questao`),
  ADD KEY `id_assuntos` (`id_assuntos`),
  ADD KEY `id_disciplina` (`id_disciplina`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assuntos`
--
ALTER TABLE `assuntos`
  MODIFY `id_assuntos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `id_disciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `professores`
--
ALTER TABLE `professores`
  MODIFY `id_professor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `questoes`
--
ALTER TABLE `questoes`
  MODIFY `id_questao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assuntos`
--
ALTER TABLE `assuntos`
  ADD CONSTRAINT `assuntos_ibfk_1` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplinas` (`id_disciplina`);

--
-- Constraints for table `professores`
--
ALTER TABLE `professores`
  ADD CONSTRAINT `professores_ibfk_1` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplinas` (`id_disciplina`);

--
-- Constraints for table `questoes`
--
ALTER TABLE `questoes`
  ADD CONSTRAINT `questoes_ibfk_1` FOREIGN KEY (`id_assuntos`) REFERENCES `assuntos` (`id_assuntos`),
  ADD CONSTRAINT `questoes_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplinas` (`id_disciplina`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
