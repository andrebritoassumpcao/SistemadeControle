-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 17-Fev-2023 às 12:56
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_controle`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

DROP TABLE IF EXISTS `professores`;
CREATE TABLE IF NOT EXISTS `professores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `matricula` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `tipo` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `componente` enum('Geral','Matemática','Língua Portuguesa','Língua Inglesa','História','Geografia','Ciências','Artes','Educação Física') COLLATE utf8mb4_general_ci NOT NULL,
  `status_matricula` enum('Ativo Readaptado','Ativo Permutado','Ativo Redução de Carga Horária','Licença Médica','Licença Maternidade','Licença Prêmio','Licença sem Vencimento','Vacância','Cedido','Exonerado') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `atuacao` enum('SEMED','Sala de Aula','Dirigente de Turno','Diretor','Diretor Adjunto','Sala de Recursos','Implementador de Leitura','Outros') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nome_escola` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `turno` enum('Matutino','Vespertino','Noturno') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `turma` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `outras_contratacoes` enum('RET','Contrato') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `outra_escola` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `outra_turma` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `outra_turno` enum('Matutino','Vespertino','Noturno') COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`id`, `nome`, `matricula`, `tipo`, `componente`, `status_matricula`, `atuacao`, `nome_escola`, `turno`, `turma`, `outras_contratacoes`, `outra_escola`, `outra_turma`, `outra_turno`) VALUES
(1, 'Vitor Hugo Marcelino Gostoso', '12564877552', 'P1', 'Matemática', 'Ativo Permutado', 'Diretor', 'Escola Municipal Braba', 'Vespertino', 'A3', 'RET', NULL, NULL, NULL),
(2, 'André Monsores', '5657856745', '', '', '', '', 'Escola Municipal do Maluco Beleza', '', '3C', '', NULL, NULL, NULL),
(9, 'Carlo  Reginaldo ', '653216546414', 'P1', '', '', '', 'Escolas Santos ', 'Matutino', '2k', '', NULL, NULL, NULL),
(10, 'Anelita Gomes Assumpção', '5648934758', 'P2', 'Língua Portuguesa', 'Ativo Readaptado', 'Diretor Adjunto', 'IESA', 'Matutino', '2B', 'Contrato', NULL, NULL, NULL),
(8, 'Carla Magalhães', '56447845248465', 'P1', 'Ciências', 'Ativo Permutado', 'Sala de Recursos', 'Escola Municipal do Maluco Beleza', 'Vespertino', '3C', 'Contrato', NULL, NULL, NULL),
(7, 'Marcela Carla Bacana', '3435634523213', 'P1', 'Língua Portuguesa', 'Ativo Permutado', 'SEMED', 'Escola Municipal do Maluco Beleza', 'Vespertino', '5h', 'RET', NULL, NULL, NULL),
(12, 'Rogerio Duccini', '7515185415484561', 'P1', 'Matemática', 'Licença Prêmio', 'Sala de Aula', 'EM Figueredo Dias', 'Vespertino', '504', 'Contrato', 'EM Seu Joao ', '105', 'Noturno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_matricula`
--

DROP TABLE IF EXISTS `status_matricula`;
CREATE TABLE IF NOT EXISTS `status_matricula` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_professor` int NOT NULL,
  `status` enum('Ativo Receptado','Ativo Permutado','Ativo Redução de Carga Horária','Licença Médica','Licença Maternidade','Licença Prêmio','Licença sem Vencimento','Vacância','Cedido','Exonerado') COLLATE utf8mb4_general_ci NOT NULL,
  `nome_premed` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_professor` (`id_professor`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `status_matricula`
--

INSERT INTO `status_matricula` (`id`, `id_professor`, `status`, `nome_premed`, `data_inicio`, `data_fim`) VALUES
(1, 1, 'Ativo Permutado', 'Cristiano Ronaldo', '2023-02-13', '2023-02-23'),
(2, 2, 'Ativo Receptado', '', '2023-02-05', '2023-03-03'),
(10, 10, 'Ativo Receptado', 'Andrew Figueredo', '2012-10-25', '2025-12-13'),
(9, 9, 'Ativo Receptado', '', '2025-06-25', '2026-10-21'),
(8, 8, 'Ativo Receptado', '', '2022-05-20', '2023-12-30'),
(7, 7, 'Ativo Receptado', 'Carlos Eduardo de Souza', '2023-02-12', '2023-02-23'),
(12, 12, 'Ativo Receptado', '', '2000-10-25', '2023-02-16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'andrebrito', '$2y$10$tnbXJyCjXDzo9p4VMUvoS.a..zvY.4vgN.6sraomDZEGumwh1okv2', '2023-02-11 12:01:11'),
(2, 'teste', '$2y$10$ZFBranf22aTDozDD92K7n.TD3V3KTXDatC3W6QeWC8FVlN62HX.7W', '2023-02-11 18:39:37'),
(3, 'andremonsores', '$2y$10$tOQhiPo48SYCXMi0.Vipu.Mp28dPw60ZWVrt8.hViSDAxGS1xJmX6', '2023-02-12 11:08:36');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
