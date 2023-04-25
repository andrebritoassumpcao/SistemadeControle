-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 23-Fev-2023 às 15:19
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
  `nome` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `matricula` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipo` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `componente` enum('Geral','Matemática','Língua Portuguesa','Língua Inglesa','História','Geografia','Ciências','Artes','Educação Física') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_matricula` enum('Ativo','Ativo Readaptado','Ativo Permutado','Ativo Redução de Carga Horária','Licença Médica','Licença Maternidade','Licença Prêmio','Licença sem Vencimento','Vacância','Cedido','Exonerado') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `atuacao` enum('SEMED','Sala de Aula','Dirigente de Turno','Diretor(a)','Diretor Adjunto','Sala de Recursos','Implementador de Leitura','Outros') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nome_escola` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `turno` enum('Matutino','Vespertino','Noturno') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `turma` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `outras_contratacoes` enum('RET','Contrato') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `outra_escola` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `outra_turma` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `outra_turno` enum('Matutino','Vespertino','Noturno') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=880 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`id`, `nome`, `matricula`, `tipo`, `componente`, `status_matricula`, `atuacao`, `nome_escola`, `turno`, `turma`, `outras_contratacoes`, `outra_escola`, `outra_turma`, `outra_turno`) VALUES



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
