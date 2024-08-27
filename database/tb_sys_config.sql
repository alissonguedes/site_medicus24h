-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 26/08/2024 às 18:47
-- Versão do servidor: 10.6.18-MariaDB-0ubuntu0.22.04.1
-- Versão do PHP: 8.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `alissong_embaixada`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_sys_config`
--

CREATE TABLE `tb_sys_config` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Número sequencial da tabela.',
  `config` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL COMMENT 'Endereço do website',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela de configurações do site';

--
-- Despejando dados para a tabela `tb_sys_config`
--

INSERT INTO `tb_sys_config` (`id`, `config`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_logo', 'assets/embaixada/img/9417ea7f9294edcb9bb3df71a02d68adee76b6cc.png', '2021-03-09 22:55:51', '2023-10-18 05:46:55'),
(2, 'original_logo_name', 'svg.png', '2021-03-09 22:55:51', '2023-10-18 05:46:55'),
(3, 'site_title', 'Embaixada', '2021-03-09 22:55:51', '2021-03-13 09:40:49'),
(4, 'site_url', NULL, '2021-03-09 22:55:51', '2021-03-09 22:55:51'),
(5, 'language', 'pt-br', '2021-03-09 22:55:51', '2023-10-18 05:42:05'),
(6, 'contact_email', NULL, '2021-03-09 22:55:51', '2021-03-09 22:55:51'),
(7, 'contact_phone', NULL, '2021-03-09 22:55:51', '2021-03-09 22:55:51'),
(8, 'contact_cel', NULL, '2021-03-09 22:55:51', '2021-03-09 22:55:51'),
(9, 'facebook', NULL, '2021-03-09 22:55:51', '2021-03-09 22:55:51'),
(10, 'instagram', NULL, '2021-03-09 22:55:51', '2021-03-09 22:55:51'),
(11, 'linkedin', NULL, '2021-03-09 22:55:51', '2021-03-09 22:55:51'),
(12, 'address', 'Sirály u. 3', '2021-03-09 22:55:51', '2023-11-13 15:54:23'),
(13, 'address_nro', NULL, '2021-03-09 22:55:51', '2023-11-13 15:53:32'),
(14, 'cep', NULL, '2021-03-09 22:55:51', '2021-03-09 22:55:51'),
(15, 'complemento', NULL, '2021-03-09 22:55:51', '2021-03-09 22:55:51'),
(16, 'bairro', 'H-1124', '2021-03-09 22:55:51', '2023-11-13 15:54:23'),
(17, 'cidade', 'Budapest', '2021-03-09 22:55:51', '2023-11-13 15:53:23'),
(18, 'uf', NULL, '2021-03-09 22:55:51', '2021-03-09 22:55:51'),
(19, 'gmaps', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2696.0972320075166!2d19.01528867696249!3d47.488019171179126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dc2a34777075%3A0xb5a6d80247658ff6!2sBudapest%2C%20Sir%C3%A1ly%20u.%2C%201124%20Hungria!5e0!3m2!1spt-BR!2sbr!4v1699915962593!5m2!1spt-BR!2sbr\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '2021-03-09 22:55:51', '2023-11-14 01:52:58'),
(20, 'site_description', NULL, '2021-03-09 23:00:20', '2021-03-12 03:25:23'),
(21, 'site_tags', NULL, '2021-03-09 23:08:48', '2023-10-18 05:32:09'),
(22, 'pais', 'Hungria', '2021-07-28 23:40:46', '2023-11-13 15:53:23');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_sys_config`
--
ALTER TABLE `tb_sys_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`config`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_sys_config`
--
ALTER TABLE `tb_sys_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Número sequencial da tabela.', AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
