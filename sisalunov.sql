-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Ago-2023 às 05:57
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sisalunov`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `idaluno` smallint(6) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `idade` smallint(6) DEFAULT NULL,
  `datanascimento` date DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `estatus` char(4) DEFAULT NULL,
  `matricula` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`idaluno`, `nome`, `idade`, `datanascimento`, `endereco`, `estatus`, `matricula`) VALUES
(5, 'João', 18, '2005-03-15', 'Rua das Flores, 123', 'AP', '5432167890'),
(6, 'Maria', 19, '2004-06-07', 'Avenida Principal, 456', 'RP', '9876543210'),
(7, 'Pedro', 17, '2006-09-30', 'Praça da Liberdade, 789', 'RP', '4567890123'),
(8, 'Ana', 16, '2007-11-20', 'Rua dos Sonhos, 987', 'AP', '7890123456'),
(9, 'Lucas', 18, '2005-02-18', 'Avenida Central, 654', 'AP', '2345678901'),
(10, 'Mariana', 17, '2006-10-05', 'Rua dos Amigos, 321', 'RP', '8901234567'),
(11, 'Carlos', 19, '2004-07-12', 'Praça do Sol, 234', 'AP', '3456789012'),
(13, 'Gustavo', 18, '2005-01-25', 'Rua da Alegria, 543', 'AP', '4567890123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `iddisciplina` smallint(6) NOT NULL,
  `disciplina` varchar(80) DEFAULT NULL,
  `ch` char(3) DEFAULT NULL,
  `semestre` varchar(5) DEFAULT NULL,
  `idprofessor` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`iddisciplina`, `disciplina`, `ch`, `semestre`, `idprofessor`) VALUES
(2, 'PSW', '130', '3', 4),
(3, 'ASW', '130', '6', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `idprofessor` smallint(6) NOT NULL,
  `nomeprof` varchar(100) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `siape` varchar(10) DEFAULT NULL,
  `idade` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`idprofessor`, `nomeprof`, `cpf`, `siape`, `idade`) VALUES
(4, 'Fernanda', '12345678906', '9876-01-01', 35),
(5, 'Ricardo', '98765432109', '5432-02-02', 42),
(6, 'Gabriela', '24681357902', '1111-03-03', 28);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`idaluno`);

--
-- Índices para tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`iddisciplina`);

--
-- Índices para tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`idprofessor`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `idaluno` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `iddisciplina` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `idprofessor` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
