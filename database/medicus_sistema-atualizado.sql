-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 18/08/2024 às 22:27
-- Versão do servidor: 10.6.16-MariaDB-0ubuntu0.22.04.1
-- Versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `medicus_sistema`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_grupo`
--

CREATE TABLE `tb_acl_grupo` (
  `id` int(11) UNSIGNED NOT NULL,
  `grupo` varchar(25) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `permissao` smallint(4) UNSIGNED ZEROFILL NOT NULL DEFAULT 1111,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para cadastro de grupos de usuários.';

--
-- Despejando dados para a tabela `tb_acl_grupo`
--

INSERT INTO `tb_acl_grupo` (`id`, `grupo`, `descricao`, `permissao`, `created_at`, `updated_at`, `is_deleted`, `deleted_at`, `status`) VALUES
(1, 'Super Administrador', 'Grupo de usuários sem restrição de privilégios.', 1111, '2022-06-24 02:42:45', NULL, 0, NULL, '1'),
(2, 'Administrador', 'Grupo de usuários com restrição de privilégios.', 0111, '2022-06-24 02:42:45', '2024-08-18 22:03:23', 0, '2024-08-18 22:03:23', '1'),
(3, 'Médico', 'Grupo de usuários com restrição de privilégios.', 0111, '2022-06-24 02:42:45', '2024-08-18 22:17:21', 0, NULL, '1'),
(4, 'Recepcionista', 'Grupo de usuários com restrição de privilégios.', 0111, '2022-06-24 02:42:45', NULL, 0, NULL, '1'),
(5, 'Guest', 'Grupo de usuários para acesso a empresas externas', 0001, '2022-06-24 02:42:45', NULL, 0, NULL, '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_menu`
--

CREATE TABLE `tb_acl_menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `editavel` enum('0','1') NOT NULL DEFAULT '1',
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para cadastro de grupos de menus';

--
-- Despejando dados para a tabela `tb_acl_menu`
--

INSERT INTO `tb_acl_menu` (`id`, `descricao`, `created_at`, `updated_at`, `editavel`, `status`) VALUES
(1, '1', '2022-08-21 08:09:34', '2022-08-21 08:57:31', '1', '1'),
(2, '0', '2022-08-21 08:56:50', '2022-11-12 02:16:17', '1', '1'),
(3, '2', '2022-08-21 08:56:50', '2022-08-21 08:57:29', '1', '1'),
(4, 'Menu médico', '2022-11-09 01:38:24', NULL, '1', '1'),
(5, '4', '2022-08-21 08:56:50', '2022-11-12 02:16:17', '1', '1'),
(15, '0', '2023-04-27 17:43:40', NULL, '1', '1'),
(24, '0', '2023-06-30 04:37:59', NULL, '1', '1'),
(26, '0', '2023-06-30 05:11:59', NULL, '1', '1'),
(27, '0', '2023-09-02 17:36:45', NULL, '1', '1'),
(28, '0', '2023-09-02 17:37:43', NULL, '1', '1'),
(29, '0', '2023-09-02 17:38:52', NULL, '1', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_menu_descricao`
--

CREATE TABLE `tb_acl_menu_descricao` (
  `id_menu` int(11) UNSIGNED NOT NULL,
  `id_idioma` int(11) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_acl_menu_descricao`
--

INSERT INTO `tb_acl_menu_descricao` (`id_menu`, `id_idioma`, `titulo`, `descricao`, `meta_description`, `meta_title`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 1, 'Administrador - Painel Admin', 'main-menu', NULL, NULL, NULL, '2023-04-25 18:46:34', '2023-04-25 19:08:05'),
(2, 1, 'Super Administrador', 'clinica', NULL, NULL, NULL, '2023-04-25 18:46:34', '2023-04-25 19:06:50'),
(3, 1, 'Administrador Clínica', 'administrador-clinica', NULL, NULL, NULL, '2023-04-25 18:46:34', '2023-04-25 19:07:11'),
(4, 1, 'Menu de médicos', 'menu-de-medicos', NULL, NULL, NULL, '2023-04-25 18:46:34', '2023-04-25 19:07:19'),
(5, 1, 'Clínica Admin5', 'clinica', NULL, NULL, NULL, '2023-04-25 18:46:34', '2023-04-25 19:06:23'),
(15, 1, 'Estoque', 'estoque', NULL, NULL, NULL, '2023-04-27 17:43:40', NULL),
(24, 1, 'Administração do Site', 'administracao-do-site', NULL, NULL, NULL, '2023-06-30 04:37:59', NULL),
(26, 1, 'Sistema de Tickets', 'sistema-de-tickets', NULL, NULL, NULL, '2023-06-30 05:11:59', NULL),
(27, 1, 'teste', 'teste', NULL, NULL, NULL, '2023-09-02 17:36:45', NULL),
(28, 1, 'teste2', 'teste2', NULL, NULL, NULL, '2023-09-02 17:37:43', NULL),
(29, 1, 'teste3', 'teste3', NULL, NULL, NULL, '2023-09-02 17:38:52', NULL),
(1, 2, 'Main menu', 'main-menu', NULL, NULL, NULL, '2023-04-25 18:46:34', NULL),
(3, 2, '5', '5', NULL, NULL, NULL, '2023-04-25 18:46:34', NULL),
(5, 2, 'Clinic', 'clinic', NULL, NULL, NULL, '2023-04-25 18:46:34', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_menu_grupo`
--

CREATE TABLE `tb_acl_menu_grupo` (
  `id_grupo` int(11) UNSIGNED NOT NULL,
  `id_menu` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para atribuir menus a grupos de usuários';

--
-- Despejando dados para a tabela `tb_acl_menu_grupo`
--

INSERT INTO `tb_acl_menu_grupo` (`id_grupo`, `id_menu`) VALUES
(1, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_menu_item`
--

CREATE TABLE `tb_acl_menu_item` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_controller` int(11) UNSIGNED DEFAULT NULL COMMENT 'Referencia a tabela (tb_acl_modulo_controller ou tb_acl_modulo_post) para a qual aponta o menu',
  `id_parent` int(11) UNSIGNED DEFAULT NULL COMMENT 'Campo para hierarquia do menu',
  `id_route` int(11) NOT NULL DEFAULT 0,
  `descricao` varchar(50) DEFAULT NULL,
  `item_type` varchar(50) DEFAULT NULL COMMENT 'É o nome da tabela referenciada. Seria a tb_acl_modulo_controller (controller) ou tb_acl_modulo_post (post)',
  `link` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  `ordem` int(11) NOT NULL DEFAULT 0,
  `permissao` smallint(4) UNSIGNED ZEROFILL NOT NULL DEFAULT 1111,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `divider` tinyint(1) NOT NULL DEFAULT 0,
  `editavel` enum('0','1') NOT NULL DEFAULT '1',
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para cadastro de itens do menus';

--
-- Despejando dados para a tabela `tb_acl_menu_item`
--

INSERT INTO `tb_acl_menu_item` (`id`, `id_controller`, `id_parent`, `id_route`, `descricao`, `item_type`, `link`, `icon`, `target`, `ordem`, `permissao`, `created_at`, `updated_at`, `divider`, `editavel`, `status`) VALUES
(1, 3, NULL, 0, 'Admin Dashboard', NULL, NULL, 'dashboard', NULL, 1, 0001, '2022-08-21 08:14:27', NULL, 0, '1', '1'),
(2, 4, NULL, 0, 'Admin Menus', NULL, NULL, 'list', NULL, 3, 0001, '2022-08-21 08:14:55', NULL, 0, '1', '1'),
(3, 4, 2, 0, 'Admin Menus', NULL, NULL, 'radio_button_unchecked', NULL, 0, 0001, '2022-08-21 08:14:27', NULL, 0, '1', '0'),
(4, 12, NULL, 0, 'Clinica Home', 'ClinicCloud', NULL, 'cloud', '_blank', 1, 0001, '2022-08-21 08:14:27', NULL, 0, '1', '1'),
(5, 12, NULL, 0, 'Clinica Dashboard', NULL, NULL, 'dashboard', NULL, 2, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(6, 27, NULL, 0, 'Clinica >> Agendamentos', NULL, NULL, 'calendar_month', NULL, 6, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(7, 27, 6, 0, 'Clinica >> Agendamentos >> Consultas', NULL, NULL, 'radio_button_unchecked', NULL, 0, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '0'),
(8, 27, 6, 0, 'Clinica >> Agendamentos >> Exames', NULL, NULL, 'radio_button_unchecked', NULL, 0, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '0'),
(9, 27, 6, 0, 'Clinica >> Agendamentos >> Procedimentos', NULL, NULL, 'radio_button_unchecked', NULL, 5, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(10, 27, 6, 0, 'Clinica >> Agendamentos >>', NULL, NULL, 'radio_button_unchecked', NULL, 0, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '0'),
(11, 27, 6, 0, 'Clinica >> Agendamentos >>', NULL, NULL, 'radio_button_unchecked', NULL, 0, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '0'),
(12, 31, NULL, 0, 'Clinica >> HomeCare', NULL, NULL, 'real_estate_agent', NULL, 4, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(13, 12, 12, 0, 'Página inicial do módulo ClinicCloud', NULL, NULL, 'biotech', NULL, 0, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '0'),
(14, 12, 12, 0, 'Página inicial do módulo ClinicCloud', NULL, NULL, 'monitor_heart', NULL, 0, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '0'),
(15, 12, 12, 0, 'Página inicial do módulo ClinicCloud', NULL, NULL, 'radio_button_unchecked', NULL, 0, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '0'),
(16, 12, NULL, 0, 'Recursos Médicos', NULL, NULL, 'medical_services', NULL, 5, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(17, 28, 16, 0, 'Atendimentos', NULL, NULL, 'support_agent', NULL, 0, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(18, 19, NULL, 0, 'Página de pacientes', NULL, NULL, 'group', NULL, 2, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(19, 21, 22, 0, 'Página de médicos', NULL, NULL, 'medical_information', NULL, 5, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(20, 22, 22, 0, 'Página de especialidades', NULL, NULL, 'favorite_border', NULL, 3, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(21, 12, NULL, 0, 'Gerenciamento', 'Sistema', NULL, 'construction', NULL, 20, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '0'),
(22, 12, NULL, 0, 'Cadastros', 'Gerenciar', NULL, 'construction', NULL, 20, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(23, 23, 22, 0, 'Empresas', NULL, NULL, 'home_health', NULL, 1, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(24, 25, 22, 0, 'Departamentos', NULL, NULL, 'account_tree', NULL, 2, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(25, 12, NULL, 0, 'Tabelas', NULL, NULL, 'view_column', NULL, 20, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(26, 26, 22, 0, 'Funcionários', NULL, NULL, 'supervisor_account', NULL, 5, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(27, 29, NULL, 0, 'Menu de usuários', 'Sistema', NULL, NULL, NULL, 100, 1111, '2023-01-15 23:40:06', NULL, 0, '1', '1'),
(28, 29, 27, 0, 'Grupo de usuários', NULL, NULL, NULL, NULL, 100, 1111, '2023-01-15 23:40:06', NULL, 0, '1', '1'),
(29, 30, 27, 0, 'Usuários', NULL, NULL, NULL, NULL, 100, 1111, '2023-01-15 23:40:06', NULL, 0, '1', '1'),
(30, 39, NULL, 0, 'Rota para o controller Módulos', NULL, NULL, 'view_module', NULL, 2, 1111, '2023-03-11 10:25:18', NULL, 0, '1', '1'),
(31, 37, 22, 460, 'Exames', NULL, NULL, 'stethoscope_check', NULL, 2, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(32, 37, 31, 0, 'Exames', NULL, NULL, NULL, NULL, 2, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '0'),
(33, 40, 31, 0, 'Tipos de exames', NULL, NULL, '·', NULL, 1, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '0'),
(34, 43, 2, 0, 'Admin Itens de Menus ', NULL, NULL, 'radio_button_unchecked', NULL, 0, 0001, '2022-08-21 08:14:27', NULL, 0, '1', '0'),
(35, 45, 16, 0, 'Agenda Médica', NULL, NULL, 'edit_calendar', NULL, 0, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(36, 49, NULL, 0, 'Site Admin Dashboard', 'Menu Principal', NULL, 'dashboard', NULL, 1, 0001, '2022-08-21 08:14:27', NULL, 0, '1', '1'),
(37, 47, NULL, 0, 'Tickets dashboard', NULL, NULL, NULL, NULL, 0, 1111, '2023-06-30 05:14:30', NULL, 0, '1', '1'),
(38, 47, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 1111, '2023-06-30 05:22:46', NULL, 0, '1', '1'),
(39, 54, NULL, 0, 'Tickets', 'Tickets', NULL, 'stacked_inbox', NULL, 10, 1111, '2023-06-30 05:22:46', NULL, 0, '1', '1'),
(40, 31, 12, 436, 'Clinica >> HomeCare >> Gestão de Cuidados', NULL, NULL, 'real_estate_agent', NULL, 1, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(41, 31, 12, 451, 'Clinica >> HomeCare >> Tarefas', NULL, NULL, 'task_alt', NULL, 2, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(42, 31, 12, 452, 'Clinica >> HomeCare >> Pacientes', NULL, NULL, 'group', NULL, 3, 0001, '2022-11-08 23:07:03', NULL, 0, '1', '1'),
(43, 74, 22, 140, 'Perfil de acesso', NULL, NULL, 'user_attributes', NULL, 4, 1111, '2022-11-08 23:07:03', NULL, 0, '1', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_menu_item_descricao`
--

CREATE TABLE `tb_acl_menu_item_descricao` (
  `id_item` int(11) UNSIGNED NOT NULL,
  `id_idioma` int(11) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_acl_menu_item_descricao`
--

INSERT INTO `tb_acl_menu_item_descricao` (`id_item`, `id_idioma`, `titulo`, `descricao`, `meta_description`, `meta_title`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dashboard', 'Dashboard', 'Dashboard', 'Dashboard', 'Dashboard', '2023-04-25 18:41:22', NULL),
(2, 1, 'Menus', 'Menus', 'Menus', 'Menus', 'Menus', '2023-04-25 18:41:22', NULL),
(3, 1, 'Grupos de menus', 'Grupos de menus', 'Grupos de menus', 'Grupos de menus', 'Grupos de menus', '2023-04-25 18:41:22', NULL),
(4, 1, 'Painel ClinicCloud', 'Painel ClinicCloud', 'Painel ClinicCloud', 'Painel ClinicCloud', 'Painel ClinicCloud', '2023-04-25 18:41:22', NULL),
(5, 1, 'Dashboard', 'Dashboard', 'Dashboard', 'Dashboard', 'Dashboard', '2023-04-25 18:41:22', NULL),
(6, 1, 'Agendamentos', 'Agendamentos', 'Agendamentos', 'Agendamentos', 'Agendamentos', '2023-04-25 18:41:22', NULL),
(7, 1, 'Consultas', 'Consultas', 'Consultas', 'Consultas', 'Outro menu', '2023-04-25 18:41:22', NULL),
(8, 1, 'Exames', 'Exames', 'Exames', 'Exames', 'Exames', '2023-04-25 18:41:22', NULL),
(9, 1, 'Procedimentos', 'Procedimentos', 'Procedimentos', 'Procedimentos', 'Exames', '2023-04-25 18:41:22', NULL),
(10, 1, 'Cirurgias', 'Cirurgias', 'Cirurgias', 'Cirurgias', 'Exames', '2023-04-25 18:41:22', NULL),
(11, 1, 'Lembretes', 'Lembretes', 'Lembretes', 'Lembretes', 'Lembretes', '2023-04-25 18:41:22', NULL),
(12, 1, 'HomeCare', 'HomeCare', 'HomeCare', 'HomeCare', 'HomeCare', '2023-04-25 18:41:22', NULL),
(13, 1, 'Laboratoriais', 'Laboratoriais', 'Laboratoriais', 'Laboratoriais', 'Laboratoriais', '2023-04-25 18:41:22', NULL),
(14, 1, 'Imagens', 'Imagens', 'Imagens', 'Imagens', 'Imagens', '2023-04-25 18:41:22', NULL),
(15, 1, 'Outros', 'Outros', 'Outros', 'Outros', 'Outros', '2023-04-25 18:41:22', NULL),
(16, 1, 'Recursos médicos', 'Recursos médicos', 'Recursos médicos', 'Recursos médicos', 'Recursos médicos', '2023-04-25 18:41:22', NULL),
(17, 1, 'Atendimentos', 'Atendimentos', 'Atendimentos', 'Atendimentos', 'Atendimentos', '2023-04-25 18:41:22', NULL),
(18, 1, 'Pacientes', 'Pacientes', 'Pacientes', 'Pacientes', 'Pacientes', '2023-04-25 18:41:22', NULL),
(19, 1, 'Médicos', 'Médicos', 'Médicos', 'Médicos', 'Médicos', '2023-04-25 18:41:22', NULL),
(20, 1, 'Especialidades', 'Especialidades', 'Especialidades', 'Especialidades', 'Especialidades', '2023-04-25 18:41:22', NULL),
(21, 1, 'Gerenciar', 'Gerenciar', 'Gerenciar', 'Gerenciar', 'Gerenciar', '2023-04-25 18:41:22', NULL),
(22, 1, 'Cadastros', 'Cadastros', 'Cadastros', 'Cadastros', 'Cadastros', '2023-04-25 18:41:22', NULL),
(23, 1, 'Clínicas', 'Clínicas', 'Clínicas', 'Clínicas', 'Clínicas', '2023-04-25 18:41:22', NULL),
(24, 1, 'Centros de custo', 'Centros de custo', 'Centros de custo', 'Centros de custo', 'Centros de custo', '2023-04-25 18:41:22', NULL),
(25, 1, 'Tabelas', 'Tabelas', 'Tabelas', 'Tabelas', 'Tabelas', '2023-04-25 18:41:22', NULL),
(26, 1, 'Funcionários', 'Funcionários', 'Funcionários', 'Funcionários', 'Funcionários', '2023-04-25 18:41:22', NULL),
(27, 1, 'Usuários', 'Usuários', 'Usuários', 'Usuários', 'Usuários', '2023-04-25 18:41:22', NULL),
(28, 1, 'Grupos', 'Grupo de usuários', 'Grupo de usuários', 'Grupo de usuários', 'Grupo de usuários', '2023-04-25 18:41:22', NULL),
(29, 1, 'Usuários', 'Usuários', 'Usuários', 'Usuários', 'Usuários', '2023-04-25 18:41:22', NULL),
(30, 1, 'Módulos', 'Módulos do sistema', 'Módulos do sistema', 'Módulos do sistema', 'Módulos do sistema', '2023-04-25 18:41:22', NULL),
(31, 1, 'Procedimentos', 'Procedimentos', 'Procedimentos', 'Procedimentos', 'Procedimentos', '2023-04-25 18:41:22', NULL),
(32, 1, 'Exames', 'Exames', 'Exames', 'Exames', 'Exames', '2023-04-25 18:41:22', NULL),
(33, 1, 'Tipos', 'Tipos de Exames', 'Tipos de Exames', 'Tipos de Exames', 'Exames', '2023-04-25 18:41:22', NULL),
(34, 1, 'Itens Menus', 'Itens de Menus', 'Itens de Menus', 'Itens de Menus', 'Itens de Menus', '2023-04-25 18:41:22', NULL),
(35, 1, 'Agenda Médica', 'Agenda Médica', 'Agenda Médica', 'Agenda Médica', 'Agenda Médica', '2023-04-25 18:41:22', NULL),
(36, 1, 'Dashboard', 'Dashboard', 'Dashboard', 'Dashboard', 'Dashboard', '2023-06-30 05:08:52', NULL),
(37, 1, 'Dashboard', 'Dashboard', 'Dashboard', 'Dashboard', 'Dashboard', '2023-06-30 05:17:55', NULL),
(38, 1, 'Tickets', 'Tickets', 'Tickets', 'Tickets', 'Tickets', '2023-06-30 05:24:02', NULL),
(39, 1, 'Tickets', 'Tickets', 'Tickets', 'Tickets', 'Tickets', '2023-07-01 01:15:43', NULL),
(40, 1, 'Gestão de Cuidados', 'Gestão de Cuidados', 'Gestão de Cuidados', 'Gestão de Cuidados', 'HomeCare', '2023-04-25 18:41:22', NULL),
(41, 1, 'Tarefas', 'Tarefas', 'Tarefas', 'Tarefas', 'Tarefas', '2023-04-25 18:41:22', NULL),
(42, 1, 'Pacientes', 'Pacientes', 'Pacientes', 'Pacientes', 'Tarefas', '2023-04-25 18:41:22', NULL),
(43, 1, 'Perfil de acesso', 'Perfil de acesso', 'Perfil de acesso', 'Perfil de acesso', 'Perfil de acesso', '2023-04-25 18:41:22', NULL),
(1, 2, 'Dashboard', 'Dashboard', 'Dashboard', 'Dashboard', 'Dashboard', '2023-04-25 18:41:22', NULL),
(2, 2, 'Menus', 'Menus', 'Menus', 'Menus', 'Menus', '2023-04-25 18:41:22', NULL),
(5, 2, 'Dashboard', 'Dashboard', 'Dashboard', 'Dashboard', 'Dashboard', '2023-04-25 18:41:22', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_menu_item_menu`
--

CREATE TABLE `tb_acl_menu_item_menu` (
  `id_menu` int(11) UNSIGNED NOT NULL,
  `id_item` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_acl_menu_item_menu`
--

INSERT INTO `tb_acl_menu_item_menu` (`id_menu`, `id_item`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, '2023-03-11 10:20:03', NULL, '1'),
(1, 2, '2023-03-11 10:20:03', NULL, '1'),
(1, 3, '2023-03-11 10:20:26', NULL, '1'),
(2, 5, '2023-02-13 21:56:10', NULL, '1'),
(3, 5, '2023-02-13 22:00:37', NULL, '1'),
(4, 5, '2023-03-04 21:14:08', NULL, '1'),
(2, 6, '2023-02-13 22:07:59', NULL, '1'),
(3, 6, '2023-03-04 20:26:47', NULL, '1'),
(4, 6, '2023-03-04 21:14:08', NULL, '1'),
(2, 7, '2023-02-13 21:56:10', NULL, '1'),
(3, 7, '2023-03-04 20:26:47', NULL, '1'),
(4, 7, '2023-03-04 21:14:08', NULL, '1'),
(2, 8, '2023-02-13 22:08:29', NULL, '1'),
(3, 8, '2023-03-04 20:26:47', NULL, '1'),
(4, 8, '2023-03-04 21:14:08', NULL, '1'),
(2, 12, '2023-02-14 04:51:09', NULL, '1'),
(3, 12, '2023-03-04 20:26:47', NULL, '1'),
(4, 12, '2023-03-04 21:14:08', NULL, '0'),
(2, 16, '2023-02-13 23:19:03', NULL, '1'),
(3, 16, '2023-03-04 20:26:47', NULL, '1'),
(4, 16, '2023-03-04 21:14:08', NULL, '1'),
(2, 17, '2023-02-13 23:21:39', NULL, '1'),
(3, 17, '2023-03-04 20:26:47', NULL, '1'),
(4, 17, '2023-03-04 21:14:08', NULL, '1'),
(2, 18, '2023-02-13 21:56:10', NULL, '1'),
(3, 18, '2023-03-04 20:26:47', NULL, '1'),
(4, 18, '2023-03-04 21:14:08', NULL, '0'),
(2, 19, '2023-02-14 04:52:45', NULL, '1'),
(3, 19, '2023-03-04 20:26:47', NULL, '1'),
(4, 19, '2023-03-04 21:14:08', NULL, '1'),
(1, 20, '2023-03-30 18:29:20', NULL, '1'),
(2, 20, '2023-03-30 18:29:41', NULL, '1'),
(3, 20, '2023-03-04 20:26:47', NULL, '1'),
(2, 21, '2023-02-14 04:51:09', NULL, '1'),
(3, 21, '2023-03-04 20:26:47', NULL, '1'),
(4, 21, '2023-03-04 21:14:08', NULL, '0'),
(2, 22, '2023-02-14 04:51:46', NULL, '1'),
(3, 22, '2023-03-04 20:26:47', NULL, '1'),
(2, 23, '2023-02-14 04:51:46', NULL, '1'),
(3, 23, '2023-03-04 20:26:47', NULL, '1'),
(1, 24, '2023-03-30 18:29:20', NULL, '1'),
(2, 24, '2023-03-30 18:29:41', NULL, '1'),
(3, 24, '2023-03-04 20:26:47', NULL, '1'),
(1, 25, '2023-03-30 18:21:41', NULL, '1'),
(2, 25, '2023-03-30 18:21:41', NULL, '1'),
(3, 25, '2023-03-04 20:26:47', NULL, '1'),
(2, 26, '2023-02-14 04:52:17', NULL, '1'),
(3, 26, '2023-03-04 20:26:47', NULL, '1'),
(2, 27, '2023-02-14 04:53:45', NULL, '1'),
(2, 28, '2023-02-14 04:53:05', NULL, '1'),
(1, 29, '2023-03-11 10:29:40', NULL, '1'),
(2, 29, '2023-02-14 04:53:23', NULL, '1'),
(1, 30, '2023-03-11 10:25:48', NULL, '1'),
(2, 31, '2023-02-14 04:51:46', NULL, '1'),
(2, 32, '2023-02-14 04:51:46', NULL, '1'),
(2, 33, '2023-02-14 04:51:46', NULL, '1'),
(1, 34, '2023-03-11 10:20:03', NULL, '1'),
(1, 35, '2023-03-11 10:20:03', NULL, '1'),
(2, 35, '2023-02-13 23:21:39', NULL, '1'),
(3, 35, '2023-03-11 10:20:03', NULL, '0'),
(4, 35, '2023-03-04 21:14:08', NULL, '1'),
(24, 36, '2023-02-13 21:56:10', NULL, '1'),
(26, 37, '2023-06-30 05:16:19', NULL, '1'),
(1, 38, '2023-06-30 05:20:08', NULL, '1'),
(2, 39, '2023-07-01 01:16:02', NULL, '1'),
(3, 39, '2023-07-03 04:28:49', NULL, '1'),
(2, 40, '2023-02-14 04:51:09', NULL, '1'),
(2, 41, '2023-02-14 04:51:09', NULL, '1'),
(2, 42, '2023-02-14 04:51:09', NULL, '1'),
(2, 43, '2023-03-11 10:20:03', NULL, '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_menu_secao`
--

CREATE TABLE `tb_acl_menu_secao` (
  `id` int(11) UNSIGNED NOT NULL,
  `secao` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para cadastro de seções de menus. Seções correspondem ao local onde o menu se localizará: sidebar, header, footer, etc...';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_modulo`
--

CREATE TABLE `tb_acl_modulo` (
  `id` int(11) UNSIGNED NOT NULL,
  `modulo` varchar(50) NOT NULL,
  `path` varchar(50) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `permissao` smallint(4) UNSIGNED ZEROFILL NOT NULL DEFAULT 1111,
  `descricao` varchar(200) DEFAULT NULL,
  `homepage` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `restrict` enum('yes','no') NOT NULL DEFAULT 'no',
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para cadastro de módulos. Módulos correspondem aos diretórios da aplicação: main, admin, etc...';

--
-- Despejando dados para a tabela `tb_acl_modulo`
--

INSERT INTO `tb_acl_modulo` (`id`, `modulo`, `path`, `namespace`, `permissao`, `descricao`, `homepage`, `created_at`, `updated_at`, `restrict`, `status`) VALUES
(1, 'Site', '/', 'App\\Http\\Controllers\\Main\\', 1111, 'Diretório público do site', NULL, '2022-06-24 03:16:39', '2023-06-27 01:28:06', 'no', '1'),
(2, 'Sistema de administração global', '/admin', 'App\\Http\\Controllers\\Admin\\', 1111, 'Diretório de administração do sistema', NULL, '2022-06-24 03:16:39', '2023-06-27 01:21:24', 'yes', '1'),
(4, 'Sistema de Autenticação de usuários', '/auth', 'App\\Http\\Controllers\\', 1111, 'AuthController', NULL, '2022-06-24 03:16:39', NULL, 'no', '1'),
(5, 'Sistema de Clínicas', '/clinica', 'App\\Http\\Controllers\\Clinica\\', 1111, 'Módulo para Clínicias', NULL, '2022-11-08 22:56:55', '2023-07-05 05:02:04', 'yes', '1'),
(6, 'Controle de Estoque', '/estoque', 'App\\Http\\Controllers\\Estoque\\', 1111, 'Módulo para Controle de Estoque', NULL, '2022-11-08 22:56:55', NULL, 'yes', '1'),
(7, 'Sistema de e-mails', '/mail', 'App\\Http\\Controllers\\Mail\\', 1111, 'Módulo para E-mails', NULL, '2023-03-11 05:58:06', NULL, 'yes', '1'),
(9, 'OS Tickets', '/tickets', 'App\\Http\\Controllers\\OSTicket\\', 1111, NULL, NULL, '2023-06-01 10:36:46', '2023-06-02 17:25:37', 'yes', '1'),
(11, 'Sistema de Administração de Site', '/site', 'App\\Http\\Controllers\\Site\\', 1111, NULL, NULL, '2023-06-08 17:38:28', '2023-06-08 18:06:10', 'yes', '1'),
(12, 'Core', '/core', 'App\\Http\\Controllers\\Core\\', 1111, NULL, NULL, '2023-07-08 14:29:09', '2023-07-09 03:53:14', 'yes', '1'),
(13, 'Portal do Parceiro', '/parceiro', 'App\\Http\\Controllers\\Parceiros\\', 1111, NULL, NULL, '2023-09-02 17:41:02', NULL, 'yes', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_modulo_controller`
--

CREATE TABLE `tb_acl_modulo_controller` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_modulo` int(11) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `controller` varchar(100) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `use_as` varchar(100) DEFAULT NULL,
  `permissao` smallint(4) UNSIGNED ZEROFILL NOT NULL DEFAULT 1111,
  `restrict` enum('yes','no','inherit') NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_acl_modulo_controller`
--

INSERT INTO `tb_acl_modulo_controller` (`id`, `id_modulo`, `nome`, `descricao`, `controller`, `filename`, `use_as`, `permissao`, `restrict`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 'Main Home Controller', 'Main Home', 'HomeController', 'App\\Http\\Controllers\\Main\\HomController.php', 'Main_Home_Controller', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 18:19:00', '1'),
(2, 1, 'Main Galeria Controller', 'Main Galeria', 'GaleriaController', '', 'PageController', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 18:18:46', '1'),
(3, 2, 'Admin Home Controller', 'Admin Home', 'HomeController', '', 'Dashboard', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 17:52:28', '1'),
(4, 2, 'Admin Menus Controller', 'Admin Menus', 'MenusController', '', 'MenusController', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 17:54:20', '1'),
(5, 4, 'Auth Controller', 'Auth Controller', 'AuthController', '', 'Auth', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 19:01:21', '0'),
(7, 1, 'Main Api Controller', 'API Main', 'ApiController', '', 'API', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 18:18:28', '1'),
(8, 2, 'Admin Api Controller', 'API Admin', 'ApiController', 'App\\Http\\Controllers\\Admin\\ApController.php', 'API_Admin', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 19:10:03', '1'),
(9, 2, 'Admin Config Controller', 'Admin Config', 'ConfigController', '', 'Config', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 17:52:18', '1'),
(10, 1, 'Main About Controller', 'Main Sobre Nós', 'AboutController', '', 'AboutController', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 18:18:22', '1'),
(11, 2, 'Admin User Controller', 'Admin usuários', 'UserController', '', 'UserController', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 17:54:47', '1'),
(12, 5, 'Clinica Home Controller', 'ClinicCloud - Home', 'HomeController', '', 'Cl_Dashboard', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:14:33', '1'),
(16, 5, 'Clínica Api Controller', 'API Clinica', 'ApiController', '', 'API_Clinica', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 18:14:26', '1'),
(18, 5, 'Clínica Config Controller', 'Clinica Config', 'ConfigController', '', 'C_Config', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:14:55', '1'),
(19, 5, 'Clínica Pacientes Controller', 'Pacientes', 'PacientesController', '', 'C_Pacientes', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 21:36:09', '1'),
(20, 5, 'Clínica Prontuários Controller', 'Prontuários de pacientes', 'ProntuariosController', '', 'C_Prontuarios', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:15:32', '1'),
(21, 5, 'Clínica Médicos Controller', 'Médicos', 'MedicosController', '', 'C_Medicos', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:16:20', '1'),
(22, 5, 'Clínica Especialidades Controller', 'Especialidades', 'EspecialidadesController', '', 'C_Especialidades', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:17:47', '1'),
(23, 5, 'Clínica Empresas Controller', 'Empresas', 'EmpresasController', '', 'C_Empresas', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:17:38', '1'),
(24, 1, 'Main Services Controller', 'Main Serviços', 'ServicesController', '', 'ServicesController', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 18:18:55', '1'),
(25, 5, 'Clínica Departamentos Controller', 'Departamentos', 'DepartamentosController', '', 'C_Departamentos', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:17:26', '1'),
(26, 5, 'Clínica Funcionários Controller', 'Funcionários', 'FuncionariosController', '', 'C_Funcionarios', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:16:50', '1'),
(27, 5, 'Clínica Agendamentos Controller', 'Agendamentos', 'AgendamentosController', '', 'C_Agendamentos', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:14:41', '1'),
(28, 5, 'Clínica Atendimentos Controller', 'Atendimentos', 'AtendimentosController', '', 'C_Atendimentos', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:15:05', '1'),
(29, 5, 'Clínica Grupos Controller', 'Grupos', 'GruposController', '', 'C_Grupos', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:16:43', '1'),
(30, 5, 'Clínica Usuários Controller', 'Usuários', 'UsuariosController', '', 'C_Usuarios', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:15:42', '1'),
(31, 5, 'Clínica HomeCare Controller', 'HomeCare', 'HomeCareController', '', 'C_HomeCare', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:16:34', '1'),
(32, 5, 'Clínica Planos de SaúdeController', 'Planosdesaude', 'PlanosdesaudeController', '', 'C_Planosdesaude', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:15:53', '1'),
(33, 5, 'Clínica Convênios Controller', 'Convenios', 'ConveniosController', '', 'C_Convenios', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:17:10', '1'),
(34, 7, 'Inbox', 'E-mails - Home', 'HomeController', '', 'Cl_Mailbox', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-29 21:40:53', '1'),
(35, 2, 'Admin módulo', 'Admin Controllers', 'ModuloController', '', 'Controllers', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 17:52:23', '1'),
(36, 2, 'Admin Routes Controller', 'Admin Rotas', 'RoutesController', '', 'Routes', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 17:54:39', '1'),
(37, 5, 'Clínica Exames Controller', 'Exames', 'ExamesController', '', 'C_Exames', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:17:55', '1'),
(38, 1, 'Main Usuário Controller', 'UsuarioController', 'UsuarioController', 'App\\Http\\Controllers\\Main\\UsuarioController.php', 'Main_Usuario_Controller', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 18:18:38', '1'),
(39, 2, 'Admin Módulos Controller', 'Admin Módulos', 'ModulosController', '', 'Modulos', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 17:54:28', '1'),
(40, 5, 'Clínica Exames Controller', 'Tipos de Exames', 'ExamesTiposController', '', 'C_ExamesTipo', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:16:59', '1'),
(43, 2, 'Admin Menu Itens', 'Admin Menus Itens', 'MenuitensController', '', 'A_MenusController', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 17:52:10', '1'),
(44, 5, 'Clínica Recursos Médicos', 'Recursos Médicos', 'RecursosMedicosController', '', 'Recursos_Medicos', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:15:20', '1'),
(45, 5, 'Clínica Agenda Médica', 'Agenda Médica', 'AgendaController', '', 'Agenda', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 22:00:52', '1'),
(47, 9, 'Dashboard', '', 'HomeController', 'App\\Http\\Controllers\\OSTickets\\HomeController.php', 'OSTickets_Home_Controller', 1111, 'inherit', '2023-06-01 10:37:48', '2023-06-20 02:11:57', '1'),
(48, 9, 'Teste', '', 'TesteController', 'App\\Http\\Controllers\\OSTicket\\TestController.php', 'Teste', 1111, 'inherit', '2023-06-03 03:51:33', '2023-06-20 02:11:53', '1'),
(49, 11, 'Site Admin Home Controller', '', 'HomeController', 'App\\Http\\Controllers\\Site\\HomeController.php', 'SiteHome', 1111, 'yes', '2023-06-08 17:38:47', '2023-06-08 18:02:01', '1'),
(50, 5, 'Campos', '', 'CamposController', 'App\\Http\\Controllers\\Clinica\\CampoController.php', NULL, 1111, 'inherit', '2023-06-08 21:59:52', '2023-07-05 04:51:48', '1'),
(51, 5, 'Home Tickets', '', 'Tickets\\HomeController', 'App\\Http\\Controllers\\Clinica\\Tickets\\HomeController.php', 'Clinica_Home_Tickets', 1111, 'inherit', '2023-06-08 22:05:26', '2023-07-05 04:55:14', '1'),
(52, 5, 'fasdf', '', 'AsdfController', 'App\\Http\\Controllers\\Clinica\\AsdfController.php', 'asdf', 1111, 'inherit', '2023-06-08 22:08:55', NULL, '1'),
(53, 9, 'Tickets Api', '', 'ApiController', 'App\\Http\\Controllers\\OSTicket\\ApController.php', 'Ticket_Api_Controller', 1111, 'inherit', '2023-06-20 01:35:40', NULL, '1'),
(54, 5, 'Tickets', '', 'Tickets\\TicketsController', 'App\\Http\\Controllers\\Clinica\\Tickets\\TicketsController.php', 'Clinica_OSTickets_Tickets_Controller', 1111, 'inherit', '2023-06-01 10:37:48', '2023-07-05 04:54:28', '1'),
(55, 12, 'Home', '', 'HomeController', 'App\\Http\\Controllers\\Core\\HomController.php', 'Core_Home_Controller', 1111, 'yes', '2023-07-08 14:29:36', NULL, '1'),
(56, 2, 'Admin Login Controller', 'Admin Login', 'LoginController', '', 'Login', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 17:52:28', '1'),
(57, 12, 'Tickets', '', 'TicketsController', 'App\\Http\\Controllers\\Core\\TicketController.php', 'Core_Tickets_Controller', 1111, 'inherit', '2023-07-09 03:46:14', NULL, '1'),
(59, 12, 'Core Api', '', 'ApiController', 'App\\Http\\Controllers\\Core\\TicketController.php', 'Core_Api_Controller', 1111, 'inherit', '2023-06-20 01:35:40', NULL, '1'),
(60, 13, 'HomeController', '', 'HomeController', 'App\\Http\\Controllers\\Parceiros\\HomeController.php', 'P_Home', 1111, 'yes', '2023-09-02 17:47:14', NULL, '1'),
(62, 2, 'Auth Controller', 'Auth Controller', 'AuthController', '', 'Adm_Auth', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 19:01:21', '1'),
(63, 9, 'Auth Controller', 'Auth Controller', 'AuthController', '', 'OSTicket_Auth', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 19:01:21', '1'),
(64, 12, 'Auth Controller', 'Auth Controller', 'AuthController', '', 'Core_Auth', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 19:01:21', '1'),
(65, 7, 'Auth Controller', 'Auth Controller', 'AuthController', '', 'Mail_Auth', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 19:01:21', '1'),
(66, 13, 'Auth Controller', 'Auth Controller', 'AuthController', '', 'Parceiro_Auth', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 19:01:21', '1'),
(67, 6, 'Auth Controller', 'Auth Controller', 'AuthController', '', 'Estoque_Auth', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 19:01:21', '1'),
(68, 5, 'Auth Controller', 'Auth Controller', 'AuthController', '', 'Clinica_Auth', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 19:01:21', '1'),
(70, 5, 'Clínica Painel Controller', 'Painel de atendimento', 'PainelController', '', 'C_Painel', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:15:05', '1'),
(71, 7, 'MailBox Controller', 'Mail Box', 'MailboxController', 'App\\Http\\Controllers\\Mailbox\\HomController.php', 'Mailbox_Controller', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 18:19:00', '1'),
(72, 7, 'MailBoxSettings Controller', 'Mail Box', 'MailboxSettingsController', 'App\\Http\\Controllers\\Mailbox\\SettingsController.php', 'MailboxSettings_Controller', 1111, 'no', '2023-06-01 10:00:05', '2023-06-08 18:19:00', '1'),
(74, 5, 'Clínica Perfil de Funcionários Controller', 'Perfil de Acesso', 'PerfisController', '', 'C_PerfilController', 1111, 'yes', '2023-06-01 10:00:05', '2023-06-08 18:16:50', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_modulo_controller_descricao`
--

CREATE TABLE `tb_acl_modulo_controller_descricao` (
  `id_controller` int(11) UNSIGNED NOT NULL,
  `id_idioma` int(11) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_modulo_grupo`
--

CREATE TABLE `tb_acl_modulo_grupo` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_grupo` int(11) UNSIGNED NOT NULL,
  `id_modulo` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para atribuições de menus a grupos de usuários.';

--
-- Despejando dados para a tabela `tb_acl_modulo_grupo`
--

INSERT INTO `tb_acl_modulo_grupo` (`id`, `id_grupo`, `id_modulo`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 5),
(9, 1, 6),
(4, 1, 7),
(11, 1, 9),
(10, 1, 11),
(5, 2, 5),
(13, 2, 7),
(6, 3, 5),
(7, 4, 5),
(12, 5, 13);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_modulo_grupo_menu`
--

CREATE TABLE `tb_acl_modulo_grupo_menu` (
  `id_modulo_grupo` int(11) UNSIGNED NOT NULL,
  `id_menu` int(11) UNSIGNED NOT NULL,
  `status` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `tb_acl_modulo_grupo_menu`
--

INSERT INTO `tb_acl_modulo_grupo_menu` (`id_modulo_grupo`, `id_menu`, `status`) VALUES
(2, 1, '1'),
(3, 2, '1'),
(5, 3, '1'),
(6, 4, '1'),
(10, 24, '1'),
(11, 26, '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_modulo_routes`
--

CREATE TABLE `tb_acl_modulo_routes` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `id_controller` int(11) UNSIGNED NOT NULL,
  `id_parent` int(11) UNSIGNED DEFAULT NULL,
  `type` enum('any','get','post','put','head','options','delete','patch','match','resource','map','group') NOT NULL DEFAULT 'get',
  `route` varchar(255) NOT NULL,
  `action` varchar(100) NOT NULL,
  `filter` longtext DEFAULT NULL,
  `permissao` smallint(4) UNSIGNED ZEROFILL NOT NULL DEFAULT 1111,
  `restrict` enum('yes','no','inherit') NOT NULL DEFAULT 'inherit',
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para cadastro de rotas de menus.';

--
-- Despejando dados para a tabela `tb_acl_modulo_routes`
--

INSERT INTO `tb_acl_modulo_routes` (`id`, `name`, `id_controller`, `id_parent`, `type`, `route`, `action`, `filter`, `permissao`, `restrict`, `status`) VALUES
(1, 'main.home', 1, NULL, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(2, 'main.home', 1, NULL, 'get', '/home', 'index', NULL, 1111, 'inherit', '1'),
(3, 'main.home', 1, NULL, 'get', '/inicio', 'index', NULL, 1111, 'inherit', '0'),
(4, 'main.page.embaixada', 2, NULL, 'get', '/embaixada', 'index', NULL, 1111, 'inherit', '1'),
(5, 'main.page.embaixada', 2, 4, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(6, 'main.page.embaixada.show_page', 2, 4, 'get', '/{page?}', 'show', NULL, 1111, 'inherit', '1'),
(8, 'account.auth.index', 5, NULL, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(9, 'admin.index', 3, NULL, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(10, 'admin.login', 62, NULL, 'any', '/login', 'login', NULL, 1111, 'no', '1'),
(11, 'admin.menus', 4, NULL, 'any', '/menus', 'index', NULL, 1111, 'inherit', '1'),
(12, 'admin.menus', 4, 11, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(13, 'admin.menus.add', 4, 11, 'get', '/add', 'form', NULL, 1111, 'inherit', '1'),
(15, 'admin.menus.patch', 4, 11, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(17, 'account.auth.index', 5, 8, 'get', '/login', 'index', NULL, 1111, 'inherit', '1'),
(18, 'account.auth.login', 5, 8, 'get', '/login/{panel?}', 'login', NULL, 1111, 'inherit', '1'),
(19, 'admin.dashboard', 3, NULL, 'any', '/dashboard', 'index', NULL, 1111, 'inherit', '1'),
(20, 'admin.database', 3, NULL, 'any', '/database', 'index', NULL, 1111, 'inherit', '1'),
(21, 'main.api.token', 7, NULL, 'get', '/api/token', 'token', NULL, 1111, 'inherit', '0'),
(22, 'admin.api.token', 8, NULL, 'get', '/api/token', 'token', NULL, 1111, 'yes', '1'),
(23, 'admin.menus.delete', 4, 11, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(24, 'main.api.translate', 7, NULL, 'get', '/api/translate/{lang}', 'translate', NULL, 0001, 'inherit', '1'),
(25, 'admin.api.translate', 8, NULL, 'get', '/api/translate/{lang}', 'translate', NULL, 0001, 'yes', '1'),
(26, 'admin.menus.edit', 4, 11, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(27, 'admin.menus.put', 4, 11, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(28, 'admin.menus.post', 4, 11, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(30, 'admin.config.patch', 9, NULL, 'patch', '/config', 'patch', NULL, 1111, 'inherit', '1'),
(31, 'main.galeria', 2, NULL, 'any', '/galeria', 'index', NULL, 1111, 'inherit', '1'),
(32, 'main.contact', 1, NULL, 'any', '/contact', 'contato', NULL, 1111, 'inherit', '1'),
(33, 'main.about', 10, NULL, 'get', '/about-us', 'index', NULL, 1111, 'inherit', '1'),
(34, 'main.services.index', 24, NULL, 'any', '/services', 'index', NULL, 1111, 'inherit', '1'),
(35, 'main.health', 10, NULL, 'any', '/health', 'health', NULL, 1111, 'inherit', '1'),
(36, 'admin.users', 11, NULL, 'any', '/users', 'index', NULL, 1111, 'inherit', '1'),
(37, 'clinica.index', 12, NULL, 'any', '/', 'index', NULL, 1111, 'yes', '1'),
(38, 'clinica.api.token', 16, NULL, 'get', '/api/token', 'token', NULL, 1111, 'yes', '1'),
(39, 'clinica.config.patch', 18, NULL, 'patch', '/config', 'patch', NULL, 1111, 'inherit', '1'),
(40, 'clinica.pacientes.index', 19, NULL, 'any', '/pacientes', 'index', NULL, 1111, 'inherit', '1'),
(41, 'clinica.pacientes.index', 19, 40, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(42, 'clinica.pacientes.post', 19, 40, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(43, 'clinica.pacientes.edit', 19, 40, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(44, 'clinica.pacientes.add', 19, 40, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(45, 'clinica.pacientes.patch', 19, 40, 'patch', '/id/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(46, 'clinica.pacientes.delete', 19, 40, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(47, 'clinica.pacientes.post', 19, 40, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(48, 'clinica.pacientes.{id_paciente}.prontuarios', 20, 40, 'any', '/{id_paciente}/prontuario', 'index', NULL, 1111, 'inherit', '1'),
(49, 'clinica.pacientes.{id_paciente}.prontuarios', 20, 48, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(50, 'clinica.pacientes.{id_paciente}.prontuarios.post', 20, 48, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(51, 'clinica.pacientes.{id_paciente}.prontuarios.{id_prontuario}', 20, 48, 'get', '/{id_prontuario}', 'form', NULL, 1111, 'inherit', '1'),
(52, 'clinica.pacientes.{id_paciente}.prontuarios.add', 20, 48, 'any', '/pacientes/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(53, 'clinica.pacientes.{id_paciente}.prontuarios.patch', 20, 48, 'patch', '/', 'patch', NULL, 1111, 'inherit', '1'),
(54, 'clinica.pacientes.{id_paciente}.prontuarios.delete', 20, 48, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(55, 'clinica.pacientes.{id_paciente}.prontuarios.put', 20, 48, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(56, 'clinica.funcionarios.index', 26, NULL, 'any', '/funcionarios', 'index', NULL, 1111, 'inherit', '1'),
(57, 'clinica.funcionarios.index', 26, 56, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(58, 'clinica.funcionarios.add', 26, 56, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(59, 'clinica.funcionarios.post', 26, 56, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(60, 'clinica.funcionarios.edit', 26, 56, 'get', '/{id}', 'form', NULL, 1111, 'inherit', '1'),
(61, 'clinica.funcionarios.patch', 26, 56, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(62, 'clinica.funcionarios.delete', 26, 56, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(63, 'clinica.funcionarios.put', 26, 56, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(64, 'clinica.especialidades.index', 22, NULL, 'any', '/especialidades', 'index', NULL, 1111, 'inherit', '1'),
(65, 'clinica.especialidades.index', 22, 64, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(66, 'clinica.especialidades.add', 22, 64, 'get', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(67, 'clinica.especialidades.post', 22, 64, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(68, 'clinica.especialidades.edit', 22, 64, 'get', '/{id}', 'form', NULL, 1111, 'inherit', '1'),
(69, 'clinica.especialidades.patch', 22, 64, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(70, 'clinica.especialidades.delete', 22, 64, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(71, 'clinica.especialidades.put', 22, 64, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(72, 'clinica.unidades.index', 23, NULL, 'any', '/unidades', 'index', NULL, 1111, 'inherit', '1'),
(73, 'clinica.unidades.index', 23, 72, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(74, 'clinica.unidades.post', 23, 72, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(75, 'clinica.unidades.edit', 23, 72, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(76, 'clinica.unidades.add', 23, 72, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(77, 'clinica.unidades.patch', 23, 72, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(78, 'clinica.unidades.delete', 23, 72, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(79, 'clinica.unidades.put', 23, 72, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(80, 'main.api.cep', 7, NULL, 'get', '/api/cep/{cep}', 'getCep', NULL, 1111, 'inherit', '1'),
(81, 'main.services.index', 24, 34, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(82, 'main.services.medicos', 24, 34, 'any', '/medicals', 'medicos', NULL, 1111, 'inherit', '1'),
(83, 'main.services.comercial', 24, 34, 'any', '/commercial', 'comercial', NULL, 1111, 'inherit', '1'),
(84, 'main.services.remocao', 24, 34, 'any', '/removal', 'remocao', NULL, 1111, 'inherit', '1'),
(85, 'main.services.area_protegida', 24, 34, 'any', '/protected-area', 'area_protegida', NULL, 1111, 'inherit', '1'),
(86, 'main.contact', 1, NULL, 'post', '/contact', 'send_mail', NULL, 1111, 'inherit', '1'),
(87, 'clinica.departamentos.index', 25, NULL, 'any', '/departamentos', 'index', NULL, 1111, 'inherit', '1'),
(88, 'clinica.departamentos.index', 25, 87, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(89, 'clinica.departamentos.add', 25, 87, 'get', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(90, 'clinica.departamentos.post', 25, 87, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(91, 'clinica.departamentos.edit', 25, 87, 'get', '/{id}', 'form', NULL, 1111, 'inherit', '1'),
(92, 'clinica.departamentos.patch', 25, 87, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(93, 'clinica.departamentos.delete', 25, 87, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(94, 'clinica.departamentos.put', 25, 87, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(95, 'clinica.unidades.departamentos', 23, 72, 'get', '/departamentos', 'getDepartamentos', NULL, 1111, 'inherit', '1'),
(96, 'clinica.agendamentos.index', 27, NULL, 'any', '/agendamentos', 'index', NULL, 1111, 'inherit', '1'),
(97, 'clinica.agendamentos.index', 27, 96, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(98, 'clinica.agendamentos.add', 27, 96, 'get', '/new', 'form', NULL, 1111, 'inherit', '1'),
(99, 'clinica.agendamentos.post', 27, 96, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(100, 'clinica.agendamentos.edit', 27, 96, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(101, 'clinica.agendamentos.patch', 27, 96, 'patch', '/id/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(102, 'clinica.agendamentos.delete', 27, 96, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(103, 'clinica.agendamentos.put', 27, 96, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(104, 'clinica.agendamentos.consultas', 27, 96, 'get', '/consultas', 'get_eventos', NULL, 1111, 'inherit', '1'),
(105, 'clinica.agendamentos.{agendamento}.paciente.{paciente}', 27, 96, 'get', '{agendamento}/paciente/{paciente}', 'form', NULL, 1111, 'inherit', '1'),
(106, 'clinica.unidades.autocomplete', 23, 72, 'get', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(107, 'clinica.pacientes.autocomplete', 19, 40, 'get', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(108, 'clinica.medicos.index', 21, NULL, 'any', '/medicos', 'index', NULL, 1111, 'inherit', '1'),
(109, 'clinica.medicos.index', 21, 108, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(110, 'clinica.medicos.add', 21, 108, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(111, 'clinica.medicos.post', 21, 108, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(112, 'clinica.medicos.edit', 21, 108, 'get', '/{id}', 'form', NULL, 1111, 'inherit', '1'),
(113, 'clinica.medicos.patch', 21, 108, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(114, 'clinica.medicos.delete', 21, 108, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(115, 'clinica.medicos.put', 21, 108, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(116, 'clinica.especialidades.autocomplete', 22, 64, 'get', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(117, 'clinica.medicos.autocomplete', 21, 108, 'get', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(118, 'main.api.include_js', 7, NULL, 'get', '/api/js', 'include_js_app', NULL, 1111, 'inherit', '1'),
(120, 'clinica.api.include_js', 16, NULL, 'get', '/api/js', 'include_js_app', NULL, 1111, 'yes', '1'),
(121, 'clinica.pacientes.{id_paciente}.prontuarios', 20, 48, 'any', '/', 'paciente', NULL, 1111, 'inherit', '0'),
(122, 'clinica.atendimentos.autocomplete', 28, 151, 'get', '/atendimentos/{tipos}/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(123, 'clinica.atendimentos.autocomplete', 28, 151, 'get', '/atendimentos/{tipo}/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(124, 'clinica.agendamentos.gotodate', 27, 96, 'get', '/r/{view?}/{year?}/{month?}/{day?}\n', 'index', NULL, 1111, 'inherit', '1'),
(125, 'clinica.pacientes.get', 19, 40, 'get', '/{id}/dados', 'get', NULL, 1111, 'inherit', '1'),
(126, 'clinica.usuarios.index', 30, NULL, 'any', '/usuarios', 'index', NULL, 1111, 'inherit', '1'),
(127, 'clinica.usuarios.index', 30, 126, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(128, 'clinica.usuarios.add', 30, 126, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(129, 'clinica.usuarios.get', 30, 126, 'get', '/id/{id}/dados', 'show', NULL, 1111, 'inherit', '1'),
(130, 'clinica.usuarios.edit', 30, 126, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(131, 'clinica.usuarios.patch', 30, 126, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(132, 'clinica.usuarios.post', 30, 126, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(133, 'clinica.usuarios.put', 30, 126, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(134, 'clinica.usuarios.delete', 30, 126, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(135, 'clinica.usuarios.autocomplete', 30, 126, 'get', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(136, 'clinica.grupos.usuarios.put', 74, 140, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(137, 'clinica.grupos.usuarios.post', 74, 140, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(138, 'clinica.grupos.usuarios.patch', 74, 140, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(139, 'clinica.grupos.usuarios.index', 74, 140, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(140, 'clinica.grupos.usuarios.index', 74, NULL, 'any', '/grupos', 'index', NULL, 1111, 'inherit', '1'),
(141, 'clinica.grupos.usuarios.get', 74, 140, 'get', '/{id}/dados', 'get', NULL, 1111, 'inherit', '1'),
(142, 'clinica.grupos.usuarios.edit', 74, 140, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(143, 'clinica.grupos.usuarios.delete', 74, 140, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(144, 'clinica.grupos.usuarios.autocomplete', 74, 140, 'get', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(145, 'clinica.grupos.usuarios.add', 74, 140, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(146, 'clinica.atendimentos.add', 28, 151, 'get', '/new', 'form', NULL, 1111, 'inherit', '1'),
(147, 'clinica.atendimentos.consultas', 28, 151, 'get', '/consultas', 'get_eventos', NULL, 1111, 'inherit', '1'),
(148, 'clinica.atendimentos.delete', 28, 151, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(149, 'clinica.atendimentos.edit', 28, 151, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(150, 'clinica.atendimentos.get_eventos', 28, 151, 'get', '/eventos', 'get_eventos', NULL, 1111, 'inherit', '1'),
(151, 'clinica.atendimentos.index', 28, NULL, 'any', '/atendimentos', 'index', NULL, 1111, 'inherit', '1'),
(152, 'clinica.atendimentos.index', 28, 151, 'get', '/{tipo?}', 'index', NULL, 1111, 'inherit', '1'),
(153, 'clinica.atendimentos.patch', 28, 151, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(154, 'clinica.atendimentos.post', 28, 151, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(155, 'clinica.atendimentos.put', 28, 151, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(156, 'clinica.api.clock', 16, NULL, 'get', '/api/clock', 'getDateTime', NULL, 1111, 'yes', '1'),
(158, 'main.api.clock', 7, NULL, 'get', '/api/clock', 'getDateTime', NULL, 1111, 'no', '0'),
(159, 'clinica.atendimentos.detalhes', 28, 151, 'get', '/details/{id}', 'datelhes_atendimento', NULL, 1111, 'inherit', '1'),
(160, 'clinica.homecare.index', 31, NULL, 'any', '/homecare', 'index', NULL, 1111, 'inherit', '0'),
(161, 'clinica.homecare.index', 31, 160, 'any', '/', 'index', NULL, 1111, 'inherit', '0'),
(162, 'clinica.homecare.add', 31, 160, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(163, 'clinica.homecare.post', 31, 160, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(164, 'clinica.homecare.edit', 31, 160, 'get', '/{id}', 'form', NULL, 1111, 'inherit', '1'),
(165, 'clinica.homecare.patch', 31, 160, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(166, 'clinica.homecare.delete', 31, 160, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(167, 'clinica.homecare.put', 31, 160, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(168, 'clinica.planosdesaude.index', 32, NULL, 'any', '/planosdesaude', 'index', NULL, 1111, 'inherit', '1'),
(169, 'clinica.planosdesaude.index', 32, 168, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(170, 'clinica.planosdesaude.add', 32, 168, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(171, 'clinica.planosdesaude.post', 32, 168, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(172, 'clinica.planosdesaude.edit', 32, 168, 'get', '/{id}', 'form', NULL, 1111, 'inherit', '1'),
(173, 'clinica.planosdesaude.patch', 32, 168, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(174, 'clinica.planosdesaude.delete', 32, 168, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(175, 'clinica.planosdesaude.put', 32, 160, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(176, 'clinica.pacientes.editplano', 19, 40, 'get', '/plano/id/{id?}', 'form_plano', NULL, 1111, 'inherit', '1'),
(177, 'clinica.pacientes.addplano', 19, 40, 'get', '/plano/{id?}', 'form_plano', NULL, 1111, 'inherit', '1'),
(178, 'clinica.pacientes.addplano', 19, 40, 'post', '/plano', 'add_plano', NULL, 1111, 'inherit', '1'),
(179, 'clinica.pacientes.addplano', 19, 40, 'put', '/plano', 'add_plano', NULL, 1111, 'inherit', '1'),
(180, 'clinica.convenios.index', 33, NULL, 'any', '/convenios', 'index', NULL, 1111, 'inherit', '1'),
(181, 'clinica.convenios.index', 33, 180, 'get', '/', 'index', NULL, 1111, 'inherit', '1'),
(182, 'clinica.convenios.autocomplete', 33, 180, 'get', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(185, 'main.cadastro.paciente', 1, NULL, 'get', '/cadastro/paciente', 'get_consulta_cadastro_paciente', NULL, 1111, 'inherit', '1'),
(186, 'main.cadastro.paciente', 1, NULL, 'post', '/cadastro/paciente', 'post_consulta_cadastro_paciente', NULL, 1111, 'inherit', '1'),
(187, 'mail.mails.index', 34, NULL, 'any', '/inbox', 'index', NULL, 1111, 'inherit', '0'),
(188, 'mail.mails.index', 34, 187, 'any', '/', 'index', NULL, 1111, 'inherit', '0'),
(189, 'mail.mails.post', 34, 187, 'post', '/', 'create', NULL, 1111, 'inherit', '0'),
(190, 'mail.mails.edit', 34, 187, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '0'),
(191, 'mail.mails.add', 34, 187, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '0'),
(192, 'mail.mails.patch', 34, 187, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '0'),
(193, 'mail.mails.delete', 34, 187, 'delete', '/', 'delete', NULL, 1111, 'inherit', '0'),
(194, 'mail.mails.put', 34, 187, 'put', '/', 'edit', NULL, 1111, 'inherit', '0'),
(195, 'mail.mails', 34, NULL, 'any', '/', 'index', NULL, 1111, 'inherit', '0'),
(205, 'clinica.exames.index', 37, NULL, 'any', '/exames', 'index', NULL, 1111, 'inherit', '1'),
(206, 'clinica.exames.index', 37, 205, 'get', '/', 'index', NULL, 1111, 'inherit', '1'),
(207, 'clinica.exames.post', 37, 205, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(208, 'clinica.exames.edit', 37, 205, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(209, 'clinica.exames.add', 37, 205, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(210, 'clinica.exames.patch', 37, 205, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(211, 'clinica.exames.delete', 37, 205, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(212, 'clinica.exames.put', 37, 205, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(214, 'clinica.usuarios.{id}.redefinir', 30, 126, 'post', '/{id}/sendpassword', 'send_password', NULL, 1111, 'inherit', '1'),
(215, 'main.password.reset', 38, NULL, 'get', '/password/reset/{token?}', 'password_reset', NULL, 1111, 'inherit', '1'),
(216, 'admin.modulos.index', 39, NULL, 'any', '/modulos', 'index', NULL, 1111, 'inherit', '1'),
(217, 'admin.modulos.index', 39, 216, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(218, 'admin.modulos.post', 39, 216, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(219, 'admin.modulos.edit', 39, 216, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(220, 'admin.modulos.add', 39, 216, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(221, 'admin.modulos.patch', 39, 216, 'patch', '/id/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(222, 'admin.modulos.delete', 39, 216, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(223, 'admin.modulos.post', 39, 216, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(224, 'admin.modulos.get', 39, 216, 'get', '/{id}/dados', 'get', NULL, 1111, 'inherit', '1'),
(225, 'clinica.categorias.exames.index', 40, NULL, 'any', '/categorias/exames', 'index', NULL, 1111, 'inherit', '1'),
(226, 'clinica.categorias.exames.index', 40, 225, 'get', '/', 'index', NULL, 1111, 'inherit', '1'),
(227, 'clinica.categorias.exames.post', 40, 225, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(228, 'clinica.categorias.exames.edit', 40, 225, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(229, 'clinica.categorias.exames.add', 40, 225, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(230, 'clinica.categorias.exames.patch', 40, 225, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(231, 'clinica.categorias.exames.delete', 40, 225, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(232, 'clinica.categorias.exames.post', 40, 225, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(233, 'admin.menus.itens.get', 43, 241, 'get', '/{id}/dados', 'get', NULL, 1111, 'inherit', '1'),
(234, 'admin.menus.itens.post', 43, 241, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(235, 'admin.menus.itens.delete', 43, 241, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(236, 'admin.menus.itens.patch', 43, 241, 'patch', '/id/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(237, 'admin.menus.itens.add', 4, 11, 'any', '/cadastro', 'criar_menus', NULL, 1111, 'inherit', '1'),
(238, 'admin.menus.itens.edit', 43, 241, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(239, 'admin.menus.itens.post', 43, 241, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(240, 'admin.menus.itens.index', 43, 241, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(241, 'admin.menus.itens.index', 43, NULL, 'any', '/menus/itens', 'index', NULL, 1111, 'inherit', '1'),
(242, 'clinica.recursosmedicos.agenda.index', 45, NULL, 'any', '/agenda', 'index', NULL, 1111, 'inherit', '1'),
(243, 'clinica.recursosmedicos.agenda.index', 45, 242, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(244, 'clinica.recursosmedicos.agenda.add', 45, 242, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(245, 'clinica.recursosmedicos.agenda.get', 45, 242, 'get', '/{id}/dados', 'get', NULL, 1111, 'inherit', '1'),
(246, 'clinica.recursosmedicos.agenda.edit', 45, 242, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(247, 'clinica.recursosmedicos.agenda.patch', 45, 242, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(248, 'clinica.recursosmedicos.agenda.post', 45, 242, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(249, 'clinica.recursosmedicos.agenda.put', 45, 242, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(250, 'clinica.recursosmedicos.agenda.delete', 45, 242, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(251, 'clinica.recursosmedicos.agenda.autocomplete', 45, 242, 'get', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(253, 'clinica.departamentos.autocomplete', 25, NULL, 'any', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(254, 'clinica.recursosmedicos.agenda.calendario', 45, NULL, 'any', '/calendario', 'calendario', NULL, 1111, 'inherit', '1'),
(255, 'clinica.funcionario.autocomplete_clinica', 26, 56, 'get', '/json/clinicas', 'autocomplete_clinica', NULL, 1111, 'inherit', '1'),
(256, 'admin.modulos.estrutura', 39, 216, 'post', '/{id}/estrutura', 'criar_estrutura', NULL, 1111, 'inherit', '1'),
(258, 'admin.api.include_js', 8, NULL, 'get', '/api/js', 'include_js_app', NULL, 1111, 'yes', '1'),
(259, 'admin.controllers.index', 3, NULL, 'any', '/controllers', 'index', NULL, 1111, 'inherit', '1'),
(260, 'admin.controllers.index', 3, 259, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(261, 'admin.controllers.post', 3, 259, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(262, 'admin.controllers.modulos.add', 3, 259, 'any', '/modulo/{id_modulo}', 'form', NULL, 1111, 'inherit', '1'),
(263, 'admin.controllers.edit', 3, 259, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(264, 'admin.controllers.post', 3, 259, 'put', '/', 'update', NULL, 1111, 'inherit', '1'),
(265, 'admin.modulos.controller.index', 39, 216, 'any', 'id/{id_modulo?}/controller', 'list_controller', NULL, 1111, 'inherit', '1'),
(266, 'admin.modulos.controller.index', 39, 265, 'any', '/', 'list_controller', NULL, 1111, 'inherit', '1'),
(267, 'admin.modulos.controller.add', 39, 265, 'any', '/add', 'form_controller', NULL, 1111, 'inherit', '1'),
(268, 'admin.modulos.controller.post', 39, 265, 'post', '/', 'create_controller', NULL, 1111, 'inherit', '1'),
(269, 'admin.modulos.controller.edit', 39, 265, 'get', '/{id_controller}', 'form_controller', NULL, 1111, 'inherit', '1'),
(270, 'admin.modulos.controller.post', 39, 265, 'put', '/', 'update_controller', NULL, 1111, 'inherit', '1'),
(271, 'clinica.tickets.index', 54, NULL, 'any', '/tickets', 'departments', NULL, 1111, 'inherit', '1'),
(272, 'tickets.home.index', 47, NULL, 'any', '/tickets', 'index', NULL, 1111, 'inherit', '1'),
(273, 'tickets.home.index', 47, NULL, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(274, 'tickets.home.add', 47, NULL, 'any', '/new', 'form', NULL, 1111, 'inherit', '1'),
(275, 'tickets.home.show', 47, 272, 'get', '/{id}', 'show', NULL, 1111, 'inherit', '1'),
(276, 'tickets.home.autocomplete', 47, 272, 'get', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(277, 'tickets.home.post', 47, 272, 'post', '/', 'store', NULL, 1111, 'inherit', '1'),
(278, 'tickets.home.post', 47, 272, 'put', '/', 'reply', NULL, 1111, 'inherit', '1'),
(279, 'tickets.home.edit', 47, 272, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(280, 'tickets.home.patch', 47, 272, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(281, 'tickets.home.delete', 47, 272, 'delete', '/', 'destroy', NULL, 1111, 'inherit', '1'),
(282, 'tickets.notificacoes.index', 48, NULL, 'any', '/teste', 'index', NULL, 1111, 'inherit', '1'),
(283, 'tickets.notificacoes.index', 48, 283, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(284, 'tickets.notificacoes.add', 48, 283, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(285, 'tickets.notificacoes.show', 48, 283, 'get', '/{id}', 'show', NULL, 1111, 'inherit', '1'),
(286, 'tickets.notificacoes.autocomplete', 48, 283, 'get', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(287, 'tickets.notificacoes.post', 48, 283, 'post', '/', 'store', NULL, 1111, 'inherit', '1'),
(288, 'tickets.notificacoes.post', 48, 283, 'put', '/', 'update', NULL, 1111, 'inherit', '1'),
(289, 'tickets.notificacoes.edit', 48, 283, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(290, 'tickets.notificacoes.patch', 48, 283, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(291, 'tickets.notificacoes.delete', 48, 283, 'delete', '/', 'destroy', NULL, 1111, 'inherit', '1'),
(292, 'site.index', 49, NULL, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(293, 'admin.modulos.menus.index', 39, 216, 'any', 'id/{id_modulo?}/menu', 'list_menu', NULL, 1111, 'inherit', '1'),
(294, 'admin.modulos.menus.index', 39, 293, 'any', '/', 'list_menu', NULL, 1111, 'inherit', '1'),
(295, 'admin.modulos.menus.add', 39, 293, 'any', '/cadastro', 'form_menu', NULL, 1111, 'inherit', '1'),
(296, 'admin.modulos.menus.show', 39, 293, 'get', '/{id}', 'show_menu', NULL, 1111, 'inherit', '1'),
(297, 'admin.modulos.menus.autocomplete', 39, 293, 'get', '/json/autocomplete', 'autocomplete_menu', NULL, 1111, 'inherit', '1'),
(298, 'admin.modulos.menus.post', 39, 293, 'post', '/', 'store_menu', NULL, 1111, 'inherit', '1'),
(299, 'admin.modulos.menus.post', 39, 293, 'put', '/', 'update_menu', NULL, 1111, 'inherit', '1'),
(300, 'admin.modulos.menus.edit', 39, 293, 'get', '/id/{id_menu}', 'form_menu', NULL, 1111, 'inherit', '1'),
(301, 'admin.modulos.menus.patch', 39, 293, 'patch', '/{id}', 'patch_menu', NULL, 1111, 'inherit', '1'),
(302, 'admin.modulos.menus.delete', 39, 293, 'delete', '/', 'destroy', NULL, 1111, 'inherit', '1'),
(303, 'site.index', 49, NULL, 'any', '/novo', 'index', NULL, 1111, 'inherit', '0'),
(304, 'site.index', 49, 292, 'any', '/dashboard', 'index', NULL, 1111, 'inherit', '1'),
(305, 'site.add', 49, 292, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(306, 'site.show', 49, 292, 'get', '/{id}', 'show', NULL, 1111, 'inherit', '1'),
(307, 'site.autocomplete', 49, 292, 'get', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(308, 'site.post', 49, 292, 'post', '/', 'store', NULL, 1111, 'inherit', '1'),
(309, 'site.post', 49, 292, 'put', '/', 'update', NULL, 1111, 'inherit', '1'),
(310, 'site.edit', 49, 292, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(311, 'site.patch', 49, 292, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(312, 'site.delete', 49, 292, 'delete', '/', 'destroy', NULL, 1111, 'inherit', '1'),
(313, 'admin.site.index', 49, NULL, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(314, 'admin.site.home.index', 49, NULL, 'any', '/home', 'index', NULL, 1111, 'inherit', '1'),
(315, 'admin.site.home.index', 49, 314, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(316, 'admin.site.home.add', 49, 314, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(317, 'admin.site.home.show', 49, 314, 'get', '/{id}', 'show', NULL, 1111, 'inherit', '1'),
(318, 'admin.site.home.autocomplete', 49, 314, 'get', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(319, 'admin.site.home.post', 49, 314, 'post', '/', 'store', NULL, 1111, 'inherit', '1'),
(320, 'admin.site.home.post', 49, 314, 'put', '/', 'update', NULL, 1111, 'inherit', '1'),
(321, 'admin.site.home.edit', 49, 314, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(322, 'admin.site.home.patch', 49, 314, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(323, 'admin.site.home.delete', 49, 314, 'delete', '/', 'destroy', NULL, 1111, 'inherit', '1'),
(324, 'tickets.api.index', 53, NULL, 'any', '/api', 'index', NULL, 1111, 'yes', '1'),
(325, 'tickets.config.patch', 53, NULL, 'patch', '/config', 'patch', NULL, 1111, 'inherit', '1'),
(326, 'clinica.api.mail.check', 16, NULL, 'get', '/api/mail/check', 'check_mail', NULL, 1111, 'yes', '1'),
(327, 'clinica.tickets.index', 54, 271, 'any', '/', 'departments', NULL, 1111, 'inherit', '1'),
(328, 'clinica.tickets.departments', 54, 271, 'get', '/dept/{dept_id}/{status?}', 'index', NULL, 1111, 'inherit', '1'),
(340, 'account.auth.post', 5, 8, 'post', '/', 'login_validate', NULL, 1111, 'inherit', '1'),
(341, 'account.auth.logout', 5, 8, 'any', '/logout', 'logout', NULL, 1111, 'inherit', '1'),
(342, 'core.index', 55, NULL, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(343, 'core.home.index', 55, NULL, 'any', '/home', 'index', NULL, 1111, 'inherit', '1'),
(344, 'core.home.index', 55, 343, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(345, 'core.home.add', 55, 343, 'any', '/new', 'form', NULL, 1111, 'inherit', '1'),
(346, 'core.home.show', 55, 343, 'get', '/{id}', 'show', NULL, 1111, 'inherit', '1'),
(347, 'core.home.autocomplete', 55, 343, 'get', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(348, 'core.home.post', 55, 343, 'post', '/', 'store', NULL, 1111, 'inherit', '1'),
(349, 'core.home.post', 55, 343, 'put', '/', 'update', NULL, 1111, 'inherit', '1'),
(350, 'core.home.edit', 55, 343, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(351, 'core.home.patch', 55, 343, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(352, 'core.home.delete', 55, 343, 'delete', '/', 'destroy', NULL, 1111, 'inherit', '1'),
(353, 'core.tickets.index', 57, NULL, 'any', '/tickets', 'index', NULL, 1111, 'inherit', '1'),
(354, 'core.tickets.index', 57, 353, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(355, 'core.tickets.status', 57, 353, 'get', '/status/{status?}', 'index', NULL, 1111, 'inherit', '1'),
(356, 'core.tickets.add', 57, 353, 'any', '/new', 'form', NULL, 1111, 'inherit', '1'),
(357, 'core.tickets.autocomplete', 57, 343, 'get', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(358, 'core.tickets.post', 57, 353, 'post', '/', 'store', NULL, 1111, 'inherit', '1'),
(359, 'core.tickets.post', 57, 353, 'put', '/', 'update', NULL, 1111, 'inherit', '1'),
(360, 'core.tickets.edit', 57, 353, 'get', '/id/{id}', 'show', NULL, 1111, 'inherit', '1'),
(361, 'core.tickets.patch', 57, 353, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(362, 'core.tickets.delete', 57, 353, 'delete', '/', 'destroy', NULL, 1111, 'inherit', '1'),
(363, 'core.api.include_js', 59, NULL, 'get', '/api/js', 'include_js_app', NULL, 1111, 'yes', '1'),
(365, 'core.tickets.departments.autocomplete', 57, NULL, 'any', '/tickets/departments/json/autocomplete', 'getDepartments', NULL, 1111, 'inherit', '1'),
(366, 'core.tickets.create', 57, 353, 'get', '/new/ticket/{id}', 'form', NULL, 1111, 'inherit', '1'),
(367, 'core.tickets.create', 57, 353, 'post', '/new/ticket/{id}', 'create', NULL, 1111, 'inherit', '1'),
(368, 'clinica.tickets.details', 54, 271, 'get', '/{ticket_id}', 'show', NULL, 1111, 'inherit', '1'),
(369, 'clinica.tickets.get_priority_image', 54, 271, 'any', '/priority/color/{color}', 'get_priority_image', NULL, 1111, 'inherit', '1'),
(370, 'clinica.tickets.post', 54, 271, 'put', '/{number}', 'reply', NULL, 1111, 'inherit', '1'),
(371, 'clinica.agendamentos.get_eventos', 27, 96, 'get', '/eventos', 'get_eventos', NULL, 1111, 'inherit', '1'),
(372, 'parceiro.index', 60, NULL, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(373, 'parceiro.index', 60, NULL, 'any', '/get', 'index', NULL, 1111, 'inherit', '1'),
(374, '..add', 60, 373, 'any', '/new', 'form', NULL, 1111, 'inherit', '1'),
(375, '..show', 60, 373, 'get', '/{id}', 'show', NULL, 1111, 'inherit', '1'),
(376, '..autocomplete', 60, 373, 'get', '/json/autocomplete', 'autocomplete', NULL, 1111, 'inherit', '1'),
(377, '..post', 60, 373, 'post', '/', 'store', NULL, 1111, 'inherit', '1'),
(378, '..post', 60, 373, 'put', '/', 'update', NULL, 1111, 'inherit', '1'),
(379, '..edit', 60, 373, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(380, '..patch', 60, 373, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(381, '..delete', 60, 373, 'delete', '/', 'destroy', NULL, 1111, 'inherit', '1'),
(382, 'clinica.account.auth.index', 68, NULL, 'any', '/account', 'index', NULL, 1111, 'no', '1'),
(383, 'clinica.account.auth.index', 68, 382, 'get', '/', 'index', NULL, 1111, 'no', '1'),
(384, 'clinica.account.auth.login', 68, 382, 'get', '/login', 'login', NULL, 1111, 'no', '1'),
(385, 'clinica.account.auth.post', 68, 382, 'post', '/login', 'login_validate', NULL, 1111, 'no', '1'),
(386, 'clinica.account.auth.logout', 68, 382, 'any', '/logout', 'logout', NULL, 1111, 'yes', '1'),
(387, 'clinica.account.reset.password', 68, 382, 'any', '/reset/password', 'reset_password', NULL, 1111, 'no', '1'),
(388, 'core.account.auth.index', 64, NULL, 'any', '/account', 'index', NULL, 1111, 'no', '1'),
(389, 'core.account.auth.index', 64, 388, 'get', '/', 'index', NULL, 1111, 'no', '1'),
(390, 'core.account.auth.login', 64, 388, 'get', '/login', 'login', NULL, 1111, 'no', '1'),
(391, 'core.account.auth.post', 64, 388, 'post', '/login', 'login_validate', NULL, 1111, 'no', '1'),
(392, 'core.account.auth.logout', 64, 388, 'any', '/logout', 'logout', NULL, 1111, 'yes', '1'),
(393, 'parceiro.account.auth.index', 66, NULL, 'any', '/account', 'index', NULL, 1111, 'no', '1'),
(394, 'parceiro.account.auth.index', 66, 393, 'get', '/', 'index', NULL, 1111, 'no', '1'),
(395, 'parceiro.account.auth.login', 66, 393, 'get', '/login', 'login', NULL, 1111, 'no', '1'),
(396, 'parceiro.account.auth.post', 66, 393, 'post', '/login', 'login_validate', NULL, 1111, 'no', '1'),
(397, 'parceiro.account.auth.logout', 66, 393, 'any', '/logout', 'logout', NULL, 1111, 'yes', '1'),
(398, 'clinica.usuarios.show', 30, 126, 'get', '/id/{id}/profile', 'show', NULL, 1111, 'inherit', '1'),
(399, 'parceiros.cadastro.paciente', 60, NULL, 'get', '/cadastro/paciente', 'index', NULL, 1111, 'inherit', '1'),
(400, 'parceiros.cadastro.paciente', 60, NULL, 'post', '/cadastro/paciente', 'post_consulta_cadastro_paciente', NULL, 1111, 'inherit', '1'),
(401, 'parceiros.cadastro.paciente.details', 60, NULL, 'get', '/cadastro/paciente/id/{id}', 'show_paciente', NULL, 1111, 'inherit', '1'),
(402, 'parceiros.modelos', 60, NULL, 'any', '/modelos', 'modelos', NULL, 1111, 'inherit', '1'),
(403, 'parceiros.modelos.add', 60, NULL, 'get', '/modelos/add', 'getModelo', NULL, 1111, 'inherit', '1'),
(404, 'parceiros.modelos.get', 60, NULL, 'get', '/modelos/guias/{id}', 'getModelo', NULL, 1111, 'inherit', '1'),
(405, 'parceiros.modelos.post', 60, NULL, 'post', '/modelos/guias', 'addModelo', NULL, 1111, 'inherit', '1'),
(406, 'parceiros.modelos.gerar_documento', 60, NULL, 'get', '/modelos/guia/autorizacao/{id?}/{paciente?}', 'geraDocumento', NULL, 1111, 'inherit', '1'),
(407, 'parceiros.modelos.print', 60, NULL, 'get', '/guia/print/{id_paciente}', 'modalGuia', NULL, 1111, 'inherit', '1'),
(408, 'clinica.convenios.autocomplete.tipo_plano', 33, 180, 'get', '/json/tipo_plano', 'autocomplete_tipo_plano', NULL, 1111, 'inherit', '1'),
(409, 'clinica.api.translate', 16, NULL, 'get', '/api/translate/{lang}', 'translate', NULL, 0001, 'yes', '1'),
(410, 'clinica.atendimentos.post', 28, NULL, 'post', '/atendimentos', 'create', NULL, 1111, 'inherit', '1'),
(411, 'clinica.atendimentos.atender_paciente', 28, NULL, 'post', '/atendimentos/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(412, 'clinica.painel.call', 70, NULL, 'get', '/painel', 'index', NULL, 1111, 'inherit', '1'),
(413, 'clinica.painel.call', 70, 412, 'get', '/', 'index', NULL, 1111, 'inherit', '1'),
(414, 'clinica.painel.call', 70, 412, 'get', '/{id}', 'index', NULL, 1111, 'inherit', '1'),
(415, 'clinica.agendamentos.show', 27, 96, 'get', '/details/{id}', 'details', NULL, 1111, 'inherit', '1'),
(416, 'mailbox.index', 71, NULL, 'any', '/', 'index', NULL, 1111, 'no', '1'),
(417, 'mailbox.index', 71, NULL, 'get', '/u/{user?}/{folder?}', 'index', NULL, 1111, 'no', '1'),
(418, 'mailbox.add', 71, 416, 'any', '/cadastro', 'form', NULL, 1111, 'no', '1'),
(419, 'mailbox.edit', 71, 416, 'get', '/id/{id}', 'form', NULL, 1111, 'no', '1'),
(420, 'mailbox.post', 71, 416, 'put', '/', 'edit', NULL, 1111, 'no', '1'),
(421, 'mailbox.post', 71, 416, 'post', '/', 'create', NULL, 1111, 'no', '1'),
(422, 'mailbox.patch', 71, 416, 'patch', '/id/{id}', 'patch', NULL, 1111, 'no', '1'),
(423, 'mailbox.delete', 71, 416, 'delete', '/', 'delete', NULL, 1111, 'no', '1'),
(424, 'mailbox.settings', 72, NULL, 'any', '/settings', 'settings', NULL, 1111, 'no', '1'),
(425, 'mailbox.settings', 72, 424, 'any', '/', 'settings', NULL, 1111, 'no', '1'),
(426, 'mailbox.savesettings', 72, 424, 'post', '/', 'savesettings', NULL, 1111, 'no', '1'),
(435, 'mailbox.index', 71, 416, 'get', '/', 'index', NULL, 1111, 'no', '1'),
(436, 'clinica.homecare.gestao-de-cuidados', 31, NULL, 'any', '/homecare/gestao-de-cuidados', 'index', NULL, 1111, 'inherit', '1'),
(437, 'clinica.homecare.gestao-de-cuidados', 31, 436, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(438, 'clinica.homecare.gestao-de-cuidados', 31, 436, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(439, 'clinica.homecare.gestao-de-cuidados.edit', 31, 436, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(440, 'clinica.homecare.gestao-de-cuidados.add', 31, 436, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(441, 'clinica.homecare.gestao-de-cuidados.patch', 31, 436, 'patch', '/id/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(442, 'clinica.homecare.gestao-de-cuidados.delete', 31, 436, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(443, 'clinica.homecare.gestao-de-cuidados.post', 31, 436, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(444, 'clinica.homecare.tarefas.post', 31, 451, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(445, 'clinica.homecare.tarefas.delete', 31, 451, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(446, 'clinica.homecare.tarefas.patch', 31, 451, 'patch', '/id/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(447, 'clinica.homecare.tarefas.add', 31, 451, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(448, 'clinica.homecare.tarefas.edit', 31, 451, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(449, 'clinica.homecare.tarefas', 31, 451, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(450, 'clinica.homecare.tarefas', 31, 451, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(451, 'clinica.homecare.tarefas', 31, NULL, 'any', '/homecare/tarefas', 'index', NULL, 1111, 'inherit', '1'),
(452, 'clinica.homecare.pacientes', 31, NULL, 'any', '/homecare/pacientes', 'index', NULL, 1111, 'inherit', '1'),
(453, 'clinica.homecare.pacientes', 31, 452, 'any', '/', 'index', NULL, 1111, 'inherit', '1'),
(454, 'clinica.homecare.pacientes', 31, 452, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(455, 'clinica.homecare.pacientes.edit', 31, 452, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(456, 'clinica.homecare.pacientes.add', 31, 452, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(457, 'clinica.homecare.pacientes.patch', 31, 452, 'patch', '/id/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(458, 'clinica.homecare.pacientes.delete', 31, 452, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(459, 'clinica.homecare.pacientes.post', 31, 452, 'put', '/', 'edit', NULL, 1111, 'inherit', '1'),
(460, 'clinica.procedimentos.index', 37, NULL, 'any', '/procedimentos', 'index', NULL, 1111, 'inherit', '1'),
(461, 'clinica.procedimentos.index', 37, 460, 'get', '/', 'index', NULL, 1111, 'inherit', '1'),
(462, 'clinica.procedimentos.post', 37, 460, 'post', '/', 'create', NULL, 1111, 'inherit', '1'),
(463, 'clinica.procedimentos.edit', 37, 460, 'get', '/id/{id}', 'form', NULL, 1111, 'inherit', '1'),
(464, 'clinica.procedimentos.add', 37, 460, 'any', '/cadastro', 'form', NULL, 1111, 'inherit', '1'),
(465, 'clinica.procedimentos.patch', 37, 460, 'patch', '/{id}', 'patch', NULL, 1111, 'inherit', '1'),
(466, 'clinica.procedimentos.delete', 37, 460, 'delete', '/', 'delete', NULL, 1111, 'inherit', '1'),
(467, 'clinica.procedimentos.put', 37, 460, 'put', '/', 'edit', NULL, 1111, 'inherit', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_pacote`
--

CREATE TABLE `tb_acl_pacote` (
  `id` int(11) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_acl_pacote`
--

INSERT INTO `tb_acl_pacote` (`id`, `titulo`, `descricao`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Básico', 'Pacote sem módulo financeiro', '2023-01-13 23:03:53', NULL, '1'),
(2, 'Avançado', 'Pacote com módulo financeiro', '2023-01-13 23:03:53', NULL, '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_pacote_modulo`
--

CREATE TABLE `tb_acl_pacote_modulo` (
  `id_pacote` int(11) UNSIGNED NOT NULL,
  `id_modulo` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_acl_pacote_modulo`
--

INSERT INTO `tb_acl_pacote_modulo` (`id_pacote`, `id_modulo`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, '2023-01-13 23:04:29', NULL, '1'),
(1, 2, '2023-01-13 23:04:29', NULL, '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_usuario`
--

CREATE TABLE `tb_acl_usuario` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_grupo` int(11) UNSIGNED NOT NULL,
  `id_funcionario` int(11) UNSIGNED DEFAULT NULL,
  `id_gestor` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `permissao` smallint(4) UNSIGNED ZEROFILL NOT NULL DEFAULT 1111,
  `ultimo_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para cadastro de usuários';

--
-- Despejando dados para a tabela `tb_acl_usuario`
--

INSERT INTO `tb_acl_usuario` (`id`, `id_grupo`, `id_funcionario`, `id_gestor`, `nome`, `email`, `login`, `senha`, `salt`, `token`, `permissao`, `ultimo_login`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, NULL, 0, 'Alisson Guedes', 'alissonguedes87@gmail.com', 'alisson', '3d536bf0be85f3dec621dce1b12db8c1977bf276bd7f3778e7eb7cb459dc48b8a5c30a7a57e6d', NULL, 'eyJ0aW1lc3RhbXAiOjE2OTExNjE1NzIsImV4cGlyZXMiOjE2OTExNjg3NzIsIm1vZHVsbyI6NX0=', 1111, '2024-08-15 15:50:34', '2022-06-24 05:43:09', '2023-08-08 02:08:47', '1'),
(2, 2, NULL, 0, 'Déborah Chianca', 'deborahchianca@medicus24h.com.br', 'deborahchianca@medicus24h.com.br', '3ffbf99945de7a986ed29db1701b54a3a9973de76912a954ae45f9014059cfae97ea90ddc437d', NULL, 'eyJ0aW1lc3RhbXAiOjE2ODQ5NTQ5NzAsImV4cGlyZXMiOjE2ODQ5NjIxNzAsIm1vZHVsbyI6NX0=', 1111, '2023-10-05 10:23:33', '2023-01-28 19:12:58', '2023-05-24 19:25:19', '1'),
(3, 2, NULL, 0, 'Tatiana', 'gestao@medicus24h.com.br', 'tatiana', '1d4aa2e76b81177494333f8c4d05b75f492faae23c3b7658231aa61b42f5bd00988ea64dcf960', NULL, NULL, 1111, '2023-10-04 13:07:40', '2023-01-28 19:52:08', NULL, '1'),
(6, 2, NULL, 0, 'Edinilton', 'edinilton.souza@medicus24h.com.br', 'edinilton', '4b0073f96547546b699c59f16c77c603a46c28e5e0ad787fda2b8015f0e3dd232306cf076e262', NULL, NULL, 1111, '2023-07-03 01:32:16', '2023-03-04 23:19:06', '2023-03-07 01:00:22', '1'),
(7, 2, NULL, 0, 'Gleizer', 'gleizermedicus24h@gmail.com', 'gleizermedicus24h@gmail.com', '0cce35184a2bbfd4d97536f7df2b5c89456429485e6934b3dd279cbbfe889bc51122a4036f5e3', NULL, NULL, 1111, '2023-04-12 09:57:58', '2023-03-28 19:35:02', '2023-03-28 23:55:16', '1'),
(9, 3, NULL, 0, 'Marcos Fred Batista Moreira', 'marcos_fred@hotmail.com', 'marcos_fred@hotmail.com', '3b0ed5d101dbb6af5733fc41de555fbce8dd25307c21441018f1d250b8042a4e3f50a958c95c9', NULL, NULL, 1111, '2023-10-05 19:55:14', '2023-06-20 01:16:56', '2023-06-20 01:17:35', '1'),
(10, 5, NULL, 0, 'Hospital Memorial São Francisco', 'recepcao@hospitalmemorial.net', 'recepcao@hospitalmemorial.net', 'b2d2b5347d03c31df25d5ec38f0cbe314688b60627c9f19d8c66b161bf434aa0b74504a69e907', NULL, NULL, 1111, '2023-09-19 09:48:18', '2023-08-22 18:14:21', NULL, '1'),
(11, 2, NULL, 0, 'asfafasdfa', 'asdfasdfaf@email.com', 'phpmyadminfa', '3d536bf0be85f3dec621dce1b12db8c1977bf276bd7f3778e7eb7cb459dc48b8a5c30a7a57e6d', NULL, NULL, 1111, '2024-03-25 06:57:44', '2023-08-22 18:14:32', NULL, '1'),
(12, 2, NULL, 0, 'Médicus24h Tester', 'tester@cliniccloud.com.br', 'tester', '8bd032be1cd3b7ce8c461a8c4c298c56f3343e44659825bbd0491c99d9f03c69e010f1c9c03fb', NULL, NULL, 1111, '2023-09-27 14:29:49', '2023-09-20 03:29:42', NULL, '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_usuario_config`
--

CREATE TABLE `tb_acl_usuario_config` (
  `id_usuario` int(11) UNSIGNED NOT NULL COMMENT 'Número sequencial da tabela.',
  `id_modulo` int(11) UNSIGNED NOT NULL,
  `id_config` int(11) UNSIGNED NOT NULL,
  `value` longtext DEFAULT NULL COMMENT 'Endereço do website',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela de configurações do site';

--
-- Despejando dados para a tabela `tb_acl_usuario_config`
--

INSERT INTO `tb_acl_usuario_config` (`id_usuario`, `id_modulo`, `id_config`, `value`, `created_at`, `updated_at`) VALUES
(1, 5, 6, 'expanded', '2023-02-13 19:48:21', '2023-08-22 09:23:43'),
(3, 5, 6, 'expanded', '2023-07-03 04:26:11', '2023-07-03 04:28:08');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_usuario_imagem`
--

CREATE TABLE `tb_acl_usuario_imagem` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_usuario` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filesize` int(10) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `privada` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acl_usuario_session`
--

CREATE TABLE `tb_acl_usuario_session` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_usuario` int(11) UNSIGNED NOT NULL,
  `id_modulo` int(11) UNSIGNED NOT NULL,
  `token` varchar(60) DEFAULT NULL,
  `ip` varchar(39) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `started_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expired_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_acl_usuario_session`
--

INSERT INTO `tb_acl_usuario_session` (`id`, `id_usuario`, `id_modulo`, `token`, `ip`, `user_agent`, `started_at`, `expired_at`) VALUES
(1, 1, 13, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', '2023-09-06 19:55:21', '2023-09-06 19:58:13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_doc_template`
--

CREATE TABLE `tb_doc_template` (
  `id` int(11) UNSIGNED NOT NULL,
  `tpl_id` int(11) UNSIGNED NOT NULL,
  `code_name` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `subject` varchar(255) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `tb_doc_template`
--

INSERT INTO `tb_doc_template` (`id`, `tpl_id`, `code_name`, `name`, `description`, `subject`, `body`, `notes`, `created`, `updated`) VALUES
(1, 1, 'guia.de.autorizacao.de.pronto.at', 'Guia de autorização de pronto atendimento', 'Declaração de esclarecimento sobre os serviços médicos que são cobertos pela Médicus24h.', 'Guia de autorização de pronto atendimento', '<p>Paciente:<strong> %{paciente.nome}</strong></p><p>CPF: <strong>%{paciente.cpf}</strong></p><p><br></p><p>Declaro estar ciente de que o plano da <strong>Médicus24h </strong>cobre, especificamente, dentre os serviços oferecidos pelo <strong>MEMORIAL SÃO FRANCISCO</strong>, os seguintes serviços médicos:</p><p><br></p><ul><li>Consulta médica;</li><li>Serviços de enfermagem e equipamentos;</li><li>Todos os materiais com custo unitário igual ou inferior a R$ 100,00;</li><li>Todos os medicamentos com custo igual ou inferior a R$ 100,00;</li><li>Gasoterapia;</li><li>Nebulização;</li><li>Eletrocardiograma;</li><li>Curativos simples (exceto curativos especiais e queimaduras);</li><li>Rouparia e todos os descartáveis de assepsia e antiassepsia;</li><li>Sala de observação de até 6 horas, quando solicitado pelo médico do atendimento;</li></ul><p><br></p><p><br></p><p>Declaro estar ciente que a Médicus24h não se encontra regulamentada pela Lei Federal 9.656, de 03/06/98, não sendo plano de saúde, nem seguro de saúde. Estou ciente também que não estão incluídos nenhum tipo de procedimento hospitalar, como internações de qualquer tipo, cirurgias, medicamentos, tratamentos e/ou garantias de pagamentos, ressarcimentos ou qualquer outro tipo de procedimento hospitalar não especificado acima.</p><p><br></p><p><br></p><p><br></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 0, 0);\">Assinatura do cliente:</span></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">___________________________________________________</p><p class=\"ql-align-center\"><em>%{paciente.nome}</em></p><p> </p><p> </p><p> </p><p>\r\n</p>', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_doc_template_group`
--

CREATE TABLE `tb_doc_template_group` (
  `tpl_id` int(11) UNSIGNED NOT NULL,
  `isactive` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(32) NOT NULL DEFAULT '',
  `lang` varchar(16) NOT NULL DEFAULT 'en_US',
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `tb_doc_template_group`
--

INSERT INTO `tb_doc_template_group` (`tpl_id`, `isactive`, `name`, `lang`, `notes`, `created`, `updated`) VALUES
(1, 1, 'Guia', 'en_US', 'Modelo padrão de documentos', '2023-05-26 00:49:13', '2023-09-07 02:53:52');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_sys_config`
--

CREATE TABLE `tb_sys_config` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'Número sequencial da tabela.',
  `id_modulo` int(11) UNSIGNED NOT NULL,
  `config` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL COMMENT 'Endereço do website',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela de configurações do site';

--
-- Despejando dados para a tabela `tb_sys_config`
--

INSERT INTO `tb_sys_config` (`id`, `id_modulo`, `config`, `value`, `created_at`, `updated_at`) VALUES
(1, 2, 'main-menu', '1', '2022-08-19 09:16:07', NULL),
(2, 2, 'language', 'pt-br', '2022-08-19 09:16:07', NULL),
(3, 2, 'main-menu-type', 'expanded', '2022-08-19 09:16:07', '2022-08-24 21:19:16'),
(4, 5, 'main-menu', '2', '2022-08-19 09:16:07', NULL),
(5, 5, 'language', 'pt-br', '2022-08-19 09:16:07', NULL),
(6, 5, 'main-menu-type', 'expanded', '2022-08-19 09:16:07', '2022-08-24 21:19:16'),
(7, 1, 'main-menu', '1', '2022-08-19 09:16:07', NULL),
(8, 1, 'language', 'pt-br', '2022-08-19 09:16:07', NULL),
(9, 1, 'main-menu-type', 'expanded', '2022-08-19 09:16:07', '2022-08-24 21:19:16'),
(12, 1, 'description', 'A Médicus24h é uma empresa que nasceu com um olhar humanizado ao seu associado. A longa experiência de seus profissionais no serviço de home care possibilitou a criação do melhor programa de assistência médica da Paraíba, ampliando os cuidados médicos a domicílio para toda a população, possibilitando o atendimento de urgências médicas 24 horas por dia e a prevenção contra doenças através do seu programa médico.', '2024-03-26 01:48:48', NULL),
(13, 1, 'keywords', 'médico, homecare, saúde, assistência domiciliar, remoção, atendimento 24h, serviços em saúde, área protegida', '2024-03-26 01:48:48', NULL),
(14, 1, 'author', 'Alisson Guedes Pereira - https://www.alissonguedes.com.br', '2024-03-26 01:49:53', NULL),
(15, 1, 'robots', 'index, follow', '2024-03-26 01:49:53', NULL),
(16, 1, 'theme-color', '#ffffff', '2024-03-26 01:51:36', NULL),
(17, 1, 'og:image', 'img/site/logo/logo-vertical.png', '2024-03-26 01:51:36', NULL),
(18, 1, 'og:type', 'Blog', '2024-03-26 01:51:36', NULL),
(19, 1, 'title', 'Médicus24h - Soluções em Saúde', '2024-03-26 01:51:36', NULL),
(20, 1, 'og:locale', 'pt_BR.utf-8', '2024-03-26 01:51:36', NULL),
(21, 2, 'description', 'A Médicus24h é uma empresa que nasceu com um olhar humanizado ao seu associado. A longa experiência de seus profissionais no serviço de home care possibilitou a criação do melhor programa de assistência médica da Paraíba, ampliando os cuidados médicos a domicílio para toda a população, possibilitando o atendimento de urgências médicas 24 horas por dia e a prevenção contra doenças através do seu programa médico.', '2024-03-26 04:48:48', NULL),
(22, 2, 'keywords', 'médico, homecare, saúde, assistência domiciliar, remoção, atendimento 24h, serviços em saúde, área protegida', '2024-03-26 04:48:48', NULL),
(23, 2, 'author', 'Alisson Guedes Pereira - https://www.alissonguedes.com.br', '2024-03-26 04:49:53', NULL),
(24, 2, 'robots', 'index, follow', '2024-03-26 04:49:53', NULL),
(25, 2, 'theme-color', '#ffffff', '2024-03-26 04:51:36', NULL),
(26, 2, 'og:image', 'img/site/logo/logo-vertical.png', '2024-03-26 04:51:36', NULL),
(27, 2, 'og:type', 'Blog', '2024-03-26 04:51:36', NULL),
(28, 2, 'title', 'Médicus24h - Soluções em Saúde', '2024-03-26 04:51:36', NULL),
(29, 2, 'og:locale', 'pt_BR.utf-8', '2024-03-26 04:51:36', NULL),
(30, 4, 'description', 'A Médicus24h é uma empresa que nasceu com um olhar humanizado ao seu associado. A longa experiência de seus profissionais no serviço de home care possibilitou a criação do melhor programa de assistência médica da Paraíba, ampliando os cuidados médicos a domicílio para toda a população, possibilitando o atendimento de urgências médicas 24 horas por dia e a prevenção contra doenças através do seu programa médico.', '2024-03-26 04:48:48', NULL),
(31, 4, 'keywords', 'médico, homecare, saúde, assistência domiciliar, remoção, atendimento 24h, serviços em saúde, área protegida', '2024-03-26 04:48:48', NULL),
(32, 4, 'author', 'Alisson Guedes Pereira - https://www.alissonguedes.com.br', '2024-03-26 04:49:53', NULL),
(33, 4, 'robots', 'index, follow', '2024-03-26 04:49:53', NULL),
(34, 4, 'theme-color', '#ffffff', '2024-03-26 04:51:36', NULL),
(35, 4, 'og:image', 'img/site/logo/logo-vertical.png', '2024-03-26 04:51:36', NULL),
(36, 4, 'og:type', 'Blog', '2024-03-26 04:51:36', NULL),
(37, 4, 'title', 'Médicus24h - Soluções em Saúde', '2024-03-26 04:51:36', NULL),
(38, 4, 'og:locale', 'pt_BR.utf-8', '2024-03-26 04:51:36', NULL),
(39, 5, 'description', 'A Médicus24h é uma empresa que nasceu com um olhar humanizado ao seu associado. A longa experiência de seus profissionais no serviço de home care possibilitou a criação do melhor programa de assistência médica da Paraíba, ampliando os cuidados médicos a domicílio para toda a população, possibilitando o atendimento de urgências médicas 24 horas por dia e a prevenção contra doenças através do seu programa médico.', '2024-03-26 04:48:48', NULL),
(40, 5, 'keywords', 'médico, homecare, saúde, assistência domiciliar, remoção, atendimento 24h, serviços em saúde, área protegida', '2024-03-26 04:48:48', NULL),
(41, 5, 'author', 'Alisson Guedes Pereira - https://www.alissonguedes.com.br', '2024-03-26 04:49:53', NULL),
(42, 5, 'robots', 'index, follow', '2024-03-26 04:49:53', NULL),
(43, 5, 'theme-color', '#ffffff', '2024-03-26 04:51:36', NULL),
(44, 5, 'og:image', 'img/site/logo/logo-vertical.png', '2024-03-26 04:51:36', NULL),
(45, 5, 'og:type', 'Blog', '2024-03-26 04:51:36', NULL),
(46, 5, 'title', 'Médicus24h - Soluções em Saúde', '2024-03-26 04:51:36', NULL),
(47, 5, 'og:locale', 'pt_BR.utf-8', '2024-03-26 04:51:36', NULL),
(48, 7, 'description', 'A Médicus24h é uma empresa que nasceu com um olhar humanizado ao seu associado. A longa experiência de seus profissionais no serviço de home care possibilitou a criação do melhor programa de assistência médica da Paraíba, ampliando os cuidados médicos a domicílio para toda a população, possibilitando o atendimento de urgências médicas 24 horas por dia e a prevenção contra doenças através do seu programa médico.', '2024-03-26 04:48:48', NULL),
(49, 7, 'keywords', 'médico, homecare, saúde, assistência domiciliar, remoção, atendimento 24h, serviços em saúde, área protegida', '2024-03-26 04:48:48', NULL),
(50, 7, 'author', 'Alisson Guedes Pereira - https://www.alissonguedes.com.br', '2024-03-26 04:49:53', NULL),
(51, 7, 'robots', 'index, follow', '2024-03-26 04:49:53', NULL),
(52, 7, 'theme-color', '#ffffff', '2024-03-26 04:51:36', NULL),
(53, 7, 'og:image', 'img/site/logo/logo-vertical.png', '2024-03-26 04:51:36', NULL),
(54, 7, 'og:type', 'Blog', '2024-03-26 04:51:36', NULL),
(55, 7, 'title', 'Médicus24h - Soluções em Saúde', '2024-03-26 04:51:36', NULL),
(56, 7, 'og:locale', 'pt_BR.utf-8', '2024-03-26 04:51:36', NULL),
(57, 9, 'description', 'A Médicus24h é uma empresa que nasceu com um olhar humanizado ao seu associado. A longa experiência de seus profissionais no serviço de home care possibilitou a criação do melhor programa de assistência médica da Paraíba, ampliando os cuidados médicos a domicílio para toda a população, possibilitando o atendimento de urgências médicas 24 horas por dia e a prevenção contra doenças através do seu programa médico.', '2024-03-26 04:48:48', NULL),
(58, 9, 'keywords', 'médico, homecare, saúde, assistência domiciliar, remoção, atendimento 24h, serviços em saúde, área protegida', '2024-03-26 04:48:48', NULL),
(59, 9, 'author', 'Alisson Guedes Pereira - https://www.alissonguedes.com.br', '2024-03-26 04:49:53', NULL),
(60, 9, 'robots', 'index, follow', '2024-03-26 04:49:53', NULL),
(61, 9, 'theme-color', '#ffffff', '2024-03-26 04:51:36', NULL),
(62, 9, 'og:image', 'img/site/logo/logo-vertical.png', '2024-03-26 04:51:36', NULL),
(63, 9, 'og:type', 'Blog', '2024-03-26 04:51:36', NULL),
(64, 9, 'title', 'Médicus24h - Soluções em Saúde', '2024-03-26 04:51:36', NULL),
(65, 9, 'og:locale', 'pt_BR.utf-8', '2024-03-26 04:51:36', NULL),
(66, 11, 'description', 'A Médicus24h é uma empresa que nasceu com um olhar humanizado ao seu associado. A longa experiência de seus profissionais no serviço de home care possibilitou a criação do melhor programa de assistência médica da Paraíba, ampliando os cuidados médicos a domicílio para toda a população, possibilitando o atendimento de urgências médicas 24 horas por dia e a prevenção contra doenças através do seu programa médico.', '2024-03-26 04:48:48', NULL),
(67, 11, 'keywords', 'médico, homecare, saúde, assistência domiciliar, remoção, atendimento 24h, serviços em saúde, área protegida', '2024-03-26 04:48:48', NULL),
(68, 11, 'author', 'Alisson Guedes Pereira - https://www.alissonguedes.com.br', '2024-03-26 04:49:53', NULL),
(69, 11, 'robots', 'index, follow', '2024-03-26 04:49:53', NULL),
(70, 11, 'theme-color', '#ffffff', '2024-03-26 04:51:36', NULL),
(71, 11, 'og:image', 'img/site/logo/logo-vertical.png', '2024-03-26 04:51:36', NULL),
(72, 11, 'og:type', 'Blog', '2024-03-26 04:51:36', NULL),
(73, 11, 'title', 'Médicus24h - Soluções em Saúde', '2024-03-26 04:51:36', NULL),
(74, 11, 'og:locale', 'pt_BR.utf-8', '2024-03-26 04:51:36', NULL),
(75, 12, 'description', 'A Médicus24h é uma empresa que nasceu com um olhar humanizado ao seu associado. A longa experiência de seus profissionais no serviço de home care possibilitou a criação do melhor programa de assistência médica da Paraíba, ampliando os cuidados médicos a domicílio para toda a população, possibilitando o atendimento de urgências médicas 24 horas por dia e a prevenção contra doenças através do seu programa médico.', '2024-03-26 04:48:48', NULL),
(76, 12, 'keywords', 'médico, homecare, saúde, assistência domiciliar, remoção, atendimento 24h, serviços em saúde, área protegida', '2024-03-26 04:48:48', NULL),
(77, 12, 'author', 'Alisson Guedes Pereira - https://www.alissonguedes.com.br', '2024-03-26 04:49:53', NULL),
(78, 12, 'robots', 'index, follow', '2024-03-26 04:49:53', NULL),
(79, 12, 'theme-color', '#ffffff', '2024-03-26 04:51:36', NULL),
(80, 12, 'og:image', 'img/site/logo/logo-vertical.png', '2024-03-26 04:51:36', NULL),
(81, 12, 'og:type', 'Blog', '2024-03-26 04:51:36', NULL),
(82, 12, 'title', 'Médicus24h - Soluções em Saúde', '2024-03-26 04:51:36', NULL),
(83, 12, 'og:locale', 'pt_BR.utf-8', '2024-03-26 04:51:36', NULL),
(84, 13, 'description', 'A Médicus24h é uma empresa que nasceu com um olhar humanizado ao seu associado. A longa experiência de seus profissionais no serviço de home care possibilitou a criação do melhor programa de assistência médica da Paraíba, ampliando os cuidados médicos a domicílio para toda a população, possibilitando o atendimento de urgências médicas 24 horas por dia e a prevenção contra doenças através do seu programa médico.', '2024-03-26 04:48:48', NULL),
(85, 13, 'keywords', 'médico, homecare, saúde, assistência domiciliar, remoção, atendimento 24h, serviços em saúde, área protegida', '2024-03-26 04:48:48', NULL),
(86, 13, 'author', 'Alisson Guedes Pereira - https://www.alissonguedes.com.br', '2024-03-26 04:49:53', NULL),
(87, 13, 'robots', 'index, follow', '2024-03-26 04:49:53', NULL),
(88, 13, 'theme-color', '#ffffff', '2024-03-26 04:51:36', NULL),
(89, 13, 'og:image', 'img/site/logo/logo-vertical.png', '2024-03-26 04:51:36', NULL),
(90, 13, 'og:type', 'Blog', '2024-03-26 04:51:36', NULL),
(91, 13, 'title', 'Médicus24h - Soluções em Saúde', '2024-03-26 04:51:36', NULL),
(92, 13, 'og:locale', 'pt_BR.utf-8', '2024-03-26 04:51:36', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_sys_dicionario`
--

CREATE TABLE `tb_sys_dicionario` (
  `id` int(11) UNSIGNED NOT NULL,
  `palavra` text NOT NULL,
  `definicao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_sys_idioma`
--

CREATE TABLE `tb_sys_idioma` (
  `id` int(11) UNSIGNED NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `sigla` varchar(7) NOT NULL,
  `label` varchar(50) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_sys_idioma`
--

INSERT INTO `tb_sys_idioma` (`id`, `descricao`, `sigla`, `label`, `imagem`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Português', 'pt-br', 'portugues', NULL, '2022-07-01 14:26:39', NULL, '1'),
(2, 'Inglês', 'en', 'ingles', NULL, '2022-07-01 14:26:39', NULL, '0');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_sys_idioma_dicionario`
--

CREATE TABLE `tb_sys_idioma_dicionario` (
  `id_idioma` int(11) UNSIGNED NOT NULL,
  `id_palavra` int(11) UNSIGNED NOT NULL,
  `traducao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_sys_mail_settings`
--

CREATE TABLE `tb_sys_mail_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` int(11) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL DEFAULT 'Joe',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL DEFAULT 'localhost',
  `port` int(11) NOT NULL DEFAULT 993,
  `protocol` varchar(6) NOT NULL DEFAULT 'imap',
  `encryption` varchar(255) DEFAULT NULL,
  `authentication` varchar(255) DEFAULT NULL,
  `validate_cert` varchar(5) NOT NULL DEFAULT '1',
  `use_proxy` tinyint(1) NOT NULL DEFAULT 0,
  `proxy_socket` varchar(255) DEFAULT NULL,
  `proxy_request_fulluri` tinyint(1) NOT NULL DEFAULT 0,
  `proxy_username` varchar(255) DEFAULT NULL,
  `proxy_password` varchar(255) DEFAULT NULL,
  `timeout` int(11) NOT NULL DEFAULT 30,
  `extensions` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tb_sys_mail_settings`
--

INSERT INTO `tb_sys_mail_settings` (`id`, `id_usuario`, `name`, `username`, `password`, `host`, `port`, `protocol`, `encryption`, `authentication`, `validate_cert`, `use_proxy`, `proxy_socket`, `proxy_request_fulluri`, `proxy_username`, `proxy_password`, `timeout`, `extensions`, `created_at`, `updated_at`) VALUES
(1, 1, 'Alisson Guedes Pereira', 'noreply@medicus24h.com.br', 'w4ylcx;,F&Vr', 'mail.medicus24h.com.br', 993, 'imap', 'ssl', 'senha normal', 'true', 0, NULL, 0, NULL, NULL, 60, NULL, NULL, NULL),
(2, 11, 'Clientes Médicus24h', 'clientes@medicus24h.com.br', '8]NtvRg+~!tu', 'mail.medicus24h.com.br', 993, 'imap', 'ssl', 'senha normal', 'true', 0, NULL, 0, NULL, NULL, 60, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_usuario_grupo`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `vw_usuario_grupo` (
`id` int(11) unsigned
,`id_grupo` int(11) unsigned
,`nome` varchar(255)
,`grupo` varchar(25)
,`login` varchar(255)
,`email` varchar(255)
,`senha` varchar(255)
,`permissao` smallint(4) unsigned zerofill
,`ustatus` enum('0','1')
,`gstatus` enum('0','1')
);

-- --------------------------------------------------------

--
-- Estrutura para view `vw_usuario_grupo`
--
DROP TABLE IF EXISTS `vw_usuario_grupo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`phpmyadmin`@`localhost` SQL SECURITY DEFINER VIEW `vw_usuario_grupo`  AS SELECT `U`.`id` AS `id`, `G`.`id` AS `id_grupo`, `U`.`nome` AS `nome`, `G`.`grupo` AS `grupo`, `U`.`login` AS `login`, `U`.`email` AS `email`, `U`.`senha` AS `senha`, `U`.`permissao` AS `permissao`, `U`.`status` AS `ustatus`, `G`.`status` AS `gstatus` FROM (`tb_acl_usuario` `U` join `tb_acl_grupo` `G` on(`G`.`id` = `U`.`id_grupo`)) WHERE `G`.`status` = '1' AND `U`.`status` = '1' ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_acl_grupo`
--
ALTER TABLE `tb_acl_grupo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grupo` (`grupo`);

--
-- Índices de tabela `tb_acl_menu`
--
ALTER TABLE `tb_acl_menu`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_acl_menu_descricao`
--
ALTER TABLE `tb_acl_menu_descricao`
  ADD PRIMARY KEY (`id_idioma`,`id_menu`),
  ADD KEY `fk_tb_produto_descricao_tb_produto1_idx` (`id_menu`),
  ADD KEY `fk_tb_produto_descricao_tb_sys_idioma1_idx` (`id_idioma`);

--
-- Índices de tabela `tb_acl_menu_grupo`
--
ALTER TABLE `tb_acl_menu_grupo`
  ADD PRIMARY KEY (`id_grupo`,`id_menu`),
  ADD KEY `fk_tb_acl_menu_grupo_tb_acl_menu_id_menu` (`id_menu`);

--
-- Índices de tabela `tb_acl_menu_item`
--
ALTER TABLE `tb_acl_menu_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_menu_item_id_item_post` (`id_controller`),
  ADD KEY `fk_tb_acl_menu_item_id_parent` (`id_parent`);

--
-- Índices de tabela `tb_acl_menu_item_descricao`
--
ALTER TABLE `tb_acl_menu_item_descricao`
  ADD PRIMARY KEY (`id_idioma`,`id_item`),
  ADD KEY `fk_tb_menu_item_descricao_id_item` (`id_item`),
  ADD KEY `fk_tb_menu_item_descricao_id_idioma` (`id_idioma`);

--
-- Índices de tabela `tb_acl_menu_item_menu`
--
ALTER TABLE `tb_acl_menu_item_menu`
  ADD PRIMARY KEY (`id_item`,`id_menu`),
  ADD KEY `fk_tb_acl_menu_item_menu_id_menu` (`id_menu`);

--
-- Índices de tabela `tb_acl_menu_secao`
--
ALTER TABLE `tb_acl_menu_secao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_acl_modulo`
--
ALTER TABLE `tb_acl_modulo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modulo` (`modulo`),
  ADD UNIQUE KEY `diretorio` (`path`),
  ADD KEY `fk_tb_acl_modulo_homepage` (`homepage`);

--
-- Índices de tabela `tb_acl_modulo_controller`
--
ALTER TABLE `tb_acl_modulo_controller`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id_modulo_controller` (`controller`,`id_modulo`),
  ADD UNIQUE KEY `use_as` (`use_as`),
  ADD KEY `fk_tb_acl_modulo_classe_tb_acl_modulo1_idx` (`id_modulo`);

--
-- Índices de tabela `tb_acl_modulo_controller_descricao`
--
ALTER TABLE `tb_acl_modulo_controller_descricao`
  ADD PRIMARY KEY (`id_idioma`,`id_controller`),
  ADD KEY `fk_tb_acl_modulo_controller_descricao_id_controller_id_item` (`id_controller`,`id_idioma`);

--
-- Índices de tabela `tb_acl_modulo_grupo`
--
ALTER TABLE `tb_acl_modulo_grupo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_acl_modulo_grupo_id_grupo_id_modulo_UNIQUE` (`id_grupo`,`id_modulo`) USING BTREE,
  ADD KEY `fk_tb_acl_modulo_grupo_id_grupo` (`id_grupo`),
  ADD KEY `fk_tb_acl_modulo_grupo_tb_acl_modulo1_idx` (`id_modulo`);

--
-- Índices de tabela `tb_acl_modulo_grupo_menu`
--
ALTER TABLE `tb_acl_modulo_grupo_menu`
  ADD PRIMARY KEY (`id_menu`,`id_modulo_grupo`) USING BTREE,
  ADD KEY `tb_acl_modulo_menu_id_menu_id_modulo_UNIQUE` (`id_menu`,`id_modulo_grupo`),
  ADD KEY `fk_tb_acl_modulo_menu_id_modulo_idx` (`id_modulo_grupo`);

--
-- Índices de tabela `tb_acl_modulo_routes`
--
ALTER TABLE `tb_acl_modulo_routes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `route_controller_action_name_UNIQUE` (`type`,`route`,`action`,`name`) USING BTREE,
  ADD KEY `fk_tb_acl_rotas_tb_acl_modulo_classe1_idx` (`id_controller`),
  ADD KEY `fk_tb_acl_modulo_routes_id_parent` (`id_parent`);

--
-- Índices de tabela `tb_acl_pacote`
--
ALTER TABLE `tb_acl_pacote`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `titulo` (`titulo`);

--
-- Índices de tabela `tb_acl_pacote_modulo`
--
ALTER TABLE `tb_acl_pacote_modulo`
  ADD PRIMARY KEY (`id_pacote`,`id_modulo`),
  ADD KEY `fk_tb_pacote_modulo_id_modulo` (`id_modulo`),
  ADD KEY `fk_tb_acl_pacote_modulo_id_pacote` (`id_pacote`) USING BTREE;

--
-- Índices de tabela `tb_acl_usuario`
--
ALTER TABLE `tb_acl_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `fk_tb_acl_usuario_id_grupo` (`id_grupo`),
  ADD KEY `fk_tb_acl_usuario_id_funcionario` (`id_funcionario`);

--
-- Índices de tabela `tb_acl_usuario_config`
--
ALTER TABLE `tb_acl_usuario_config`
  ADD PRIMARY KEY (`id_usuario`,`id_config`),
  ADD KEY `fk_tb_acl_usuario_config_id_config` (`id_config`),
  ADD KEY `fk_tb_acl_usuario_config_id_modulo` (`id_modulo`);

--
-- Índices de tabela `tb_acl_usuario_imagem`
--
ALTER TABLE `tb_acl_usuario_imagem`
  ADD PRIMARY KEY (`id`,`id_usuario`),
  ADD KEY `tb_acl_usuario_imagem_id_usuario` (`id_usuario`);

--
-- Índices de tabela `tb_acl_usuario_session`
--
ALTER TABLE `tb_acl_usuario_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_acl_usuario_session_id_usuario` (`id_usuario`),
  ADD KEY `fk_tb_acl_usuario_session_id_modulo` (`id_modulo`);

--
-- Índices de tabela `tb_doc_template`
--
ALTER TABLE `tb_doc_template`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `template_lookup` (`tpl_id`,`code_name`);

--
-- Índices de tabela `tb_doc_template_group`
--
ALTER TABLE `tb_doc_template_group`
  ADD PRIMARY KEY (`tpl_id`);

--
-- Índices de tabela `tb_sys_config`
--
ALTER TABLE `tb_sys_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`config`),
  ADD KEY `fk_tb_sys_config_id_modulo` (`id_modulo`);

--
-- Índices de tabela `tb_sys_dicionario`
--
ALTER TABLE `tb_sys_dicionario`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_sys_idioma`
--
ALTER TABLE `tb_sys_idioma`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sigla` (`sigla`);

--
-- Índices de tabela `tb_sys_idioma_dicionario`
--
ALTER TABLE `tb_sys_idioma_dicionario`
  ADD PRIMARY KEY (`id_idioma`,`id_palavra`),
  ADD KEY `fk_tb_sys_idioma_id_palavra` (`id_palavra`),
  ADD KEY `fk_tb_sys_idioma_id_idioma` (`id_idioma`);

--
-- Índices de tabela `tb_sys_mail_settings`
--
ALTER TABLE `tb_sys_mail_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_sys_mail_settings_id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_acl_grupo`
--
ALTER TABLE `tb_acl_grupo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_acl_menu`
--
ALTER TABLE `tb_acl_menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `tb_acl_menu_item`
--
ALTER TABLE `tb_acl_menu_item`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `tb_acl_menu_secao`
--
ALTER TABLE `tb_acl_menu_secao`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_acl_modulo`
--
ALTER TABLE `tb_acl_modulo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tb_acl_modulo_controller`
--
ALTER TABLE `tb_acl_modulo_controller`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de tabela `tb_acl_modulo_grupo`
--
ALTER TABLE `tb_acl_modulo_grupo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tb_acl_modulo_routes`
--
ALTER TABLE `tb_acl_modulo_routes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=468;

--
-- AUTO_INCREMENT de tabela `tb_acl_usuario`
--
ALTER TABLE `tb_acl_usuario`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_acl_usuario_config`
--
ALTER TABLE `tb_acl_usuario_config`
  MODIFY `id_usuario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Número sequencial da tabela.', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_acl_usuario_imagem`
--
ALTER TABLE `tb_acl_usuario_imagem`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_acl_usuario_session`
--
ALTER TABLE `tb_acl_usuario_session`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_doc_template`
--
ALTER TABLE `tb_doc_template`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_doc_template_group`
--
ALTER TABLE `tb_doc_template_group`
  MODIFY `tpl_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_sys_config`
--
ALTER TABLE `tb_sys_config`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Número sequencial da tabela.', AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de tabela `tb_sys_dicionario`
--
ALTER TABLE `tb_sys_dicionario`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_sys_idioma`
--
ALTER TABLE `tb_sys_idioma`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_sys_mail_settings`
--
ALTER TABLE `tb_sys_mail_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_acl_menu_descricao`
--
ALTER TABLE `tb_acl_menu_descricao`
  ADD CONSTRAINT `tb_acl_menu_descricao_id_idioma` FOREIGN KEY (`id_idioma`) REFERENCES `tb_sys_idioma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_acl_menu_descricao_id_menu` FOREIGN KEY (`id_menu`) REFERENCES `tb_acl_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_acl_menu_grupo`
--
ALTER TABLE `tb_acl_menu_grupo`
  ADD CONSTRAINT `fk_tb_acl_menu_grupo_tb_acl_grupo_id_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `tb_acl_grupo` (`id`),
  ADD CONSTRAINT `fk_tb_acl_menu_grupo_tb_acl_menu_id_menu` FOREIGN KEY (`id_menu`) REFERENCES `tb_acl_menu` (`id`);

--
-- Restrições para tabelas `tb_acl_menu_item`
--
ALTER TABLE `tb_acl_menu_item`
  ADD CONSTRAINT `fk_tb_acl_menu_item_id_parent` FOREIGN KEY (`id_parent`) REFERENCES `tb_acl_menu_item` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_tb_menu_item_id_controller` FOREIGN KEY (`id_controller`) REFERENCES `tb_acl_modulo_controller` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_acl_menu_item_descricao`
--
ALTER TABLE `tb_acl_menu_item_descricao`
  ADD CONSTRAINT `tb_acl_menu_item_descricao_id_idioma` FOREIGN KEY (`id_idioma`) REFERENCES `tb_sys_idioma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_acl_menu_item_descricao_id_item` FOREIGN KEY (`id_item`) REFERENCES `tb_acl_menu_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_acl_menu_item_menu`
--
ALTER TABLE `tb_acl_menu_item_menu`
  ADD CONSTRAINT `fk_tb_acl_menu_item_menu_id_item` FOREIGN KEY (`id_item`) REFERENCES `tb_acl_menu_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_acl_menu_item_menu_id_menu` FOREIGN KEY (`id_menu`) REFERENCES `tb_acl_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_acl_modulo`
--
ALTER TABLE `tb_acl_modulo`
  ADD CONSTRAINT `fk_tb_acl_modulo_homepage` FOREIGN KEY (`homepage`) REFERENCES `tb_acl_modulo_routes` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Restrições para tabelas `tb_acl_modulo_controller`
--
ALTER TABLE `tb_acl_modulo_controller`
  ADD CONSTRAINT `fk_tb_acl_modulo_classe_tb_acl_modulo1` FOREIGN KEY (`id_modulo`) REFERENCES `tb_acl_modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_acl_modulo_controller_descricao`
--
ALTER TABLE `tb_acl_modulo_controller_descricao`
  ADD CONSTRAINT `fk_tb_acl_modulo_controller_descricao_id_controller` FOREIGN KEY (`id_controller`) REFERENCES `tb_acl_modulo_controller` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_acl_modulo_controller_descricao_id_idioma` FOREIGN KEY (`id_idioma`) REFERENCES `tb_sys_idioma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_acl_modulo_grupo`
--
ALTER TABLE `tb_acl_modulo_grupo`
  ADD CONSTRAINT `fk_tb_acl_menu_grupo_id_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `tb_acl_grupo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_acl_modulo_grupo_tb_acl_modulo1` FOREIGN KEY (`id_modulo`) REFERENCES `tb_acl_modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_acl_modulo_grupo_menu`
--
ALTER TABLE `tb_acl_modulo_grupo_menu`
  ADD CONSTRAINT `fk_tb_acl_modulo_menu_id_menu` FOREIGN KEY (`id_menu`) REFERENCES `tb_acl_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_acl_modulo_menu_id_modulo` FOREIGN KEY (`id_modulo_grupo`) REFERENCES `tb_acl_modulo_grupo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_acl_modulo_routes`
--
ALTER TABLE `tb_acl_modulo_routes`
  ADD CONSTRAINT `fk_tb_acl_modulo_routes_id_parent` FOREIGN KEY (`id_parent`) REFERENCES `tb_acl_modulo_routes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_acl_rotas_tb_acl_modulo_classe1` FOREIGN KEY (`id_controller`) REFERENCES `tb_acl_modulo_controller` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_acl_pacote_modulo`
--
ALTER TABLE `tb_acl_pacote_modulo`
  ADD CONSTRAINT `fk_tb_pacote_modulo_id_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `tb_acl_modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_pacote_modulo_id_pacote` FOREIGN KEY (`id_pacote`) REFERENCES `tb_acl_pacote` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_acl_usuario`
--
ALTER TABLE `tb_acl_usuario`
  ADD CONSTRAINT `fk_tb_acl_usuario_id_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `tb_acl_grupo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_acl_usuario_config`
--
ALTER TABLE `tb_acl_usuario_config`
  ADD CONSTRAINT `fk_tb_acl_usuario_config_id_config` FOREIGN KEY (`id_config`) REFERENCES `tb_sys_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_acl_usuario_config_id_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `tb_acl_modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_acl_usuario_config_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tb_acl_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_acl_usuario_imagem`
--
ALTER TABLE `tb_acl_usuario_imagem`
  ADD CONSTRAINT `tb_acl_usuario_imagem_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tb_acl_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_acl_usuario_session`
--
ALTER TABLE `tb_acl_usuario_session`
  ADD CONSTRAINT `fk_tb_acl_usuario_session_id_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `tb_acl_modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_acl_usuario_session_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tb_acl_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_doc_template`
--
ALTER TABLE `tb_doc_template`
  ADD CONSTRAINT `fk_tb_doc_template_tpl_id` FOREIGN KEY (`tpl_id`) REFERENCES `tb_doc_template_group` (`tpl_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_sys_config`
--
ALTER TABLE `tb_sys_config`
  ADD CONSTRAINT `fk_tb_sys_config_id_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `tb_acl_modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_sys_idioma_dicionario`
--
ALTER TABLE `tb_sys_idioma_dicionario`
  ADD CONSTRAINT `fk_tb_sys_idioma_id_idioma` FOREIGN KEY (`id_idioma`) REFERENCES `tb_sys_idioma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_sys_idioma_id_palavra` FOREIGN KEY (`id_palavra`) REFERENCES `tb_sys_dicionario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_sys_mail_settings`
--
ALTER TABLE `tb_sys_mail_settings`
  ADD CONSTRAINT `fk_tb_sys_mail_settings_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tb_acl_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
