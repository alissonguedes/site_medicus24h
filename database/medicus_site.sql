-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 07/09/2024 às 16:20
-- Versão do servidor: 10.6.18-MariaDB-0ubuntu0.22.04.1
-- Versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `medicus_site`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_banner`
--

CREATE TABLE `tb_banner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `titulo_slug` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `imgname` varchar(255) NOT NULL,
  `imgsize` int(11) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `ordem` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT 0,
  `url` varchar(255) DEFAULT NULL,
  `publicar_ini` datetime NOT NULL,
  `publicar_fim` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alisson Guedes Pereira', 'alissonguedes87@gmail.com', NULL, '$2y$12$ssRgNj9LYz3YCpAJpn/mDOYZ7sB03secS1JogT1KscR6oJpIdmIL2', 'NVG54yAhbBHEQNBAV4wDnfu2RZvUJkdtsfipx7NFwd2CYeIUQFrnX94mfAB0', '2024-04-29 17:41:19', '2024-04-29 17:41:19');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_banner`
--
ALTER TABLE `tb_banner`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `medicus_site_tb_usuario_email_unique` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_banner`
--
ALTER TABLE `tb_banner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
