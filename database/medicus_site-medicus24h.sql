-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 26/04/2024 às 01:47
-- Versão do servidor: 10.6.16-MariaDB-0ubuntu0.22.04.1
-- Versão do PHP: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `medicus_medicus24h`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_banner`
--

CREATE TABLE `tb_banner` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Numero sequencial',
  `titulo` varchar(255) DEFAULT NULL COMMENT 'Título principal do banner.',
  `slug` varchar(255) DEFAULT NULL COMMENT 'Título sem caracteres especiais para identificar o banner.',
  `descricao` text DEFAULT NULL COMMENT 'Texto descritivo do banner',
  `autor` varchar(50) NOT NULL COMMENT 'Autor de criação do banner',
  `ordem` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ordem para listagem do banner',
  `publish_up` date NOT NULL COMMENT 'Data para exibição do banner',
  `publish_down` date NOT NULL COMMENT 'Data para parar exibição do banner',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data de criação do banner',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Data de criação do banner',
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'Situação de exibição do banner. 0 - Não exibir; 1 - Exibir.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_banner_descricao`
--

CREATE TABLE `tb_banner_descricao` (
  `id_banner` int(10) UNSIGNED NOT NULL,
  `id_idioma` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_banner_imagem`
--

CREATE TABLE `tb_banner_imagem` (
  `id_banner` int(10) UNSIGNED NOT NULL,
  `id_midia` int(10) UNSIGNED NOT NULL,
  `clicks` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Quantidade de clicks/visualizações do banner',
  `url` varchar(255) DEFAULT NULL COMMENT 'Link para artigo',
  `ordem` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ordem para listagem do banner',
  `publish_up` date DEFAULT NULL COMMENT 'Data para exibição do banner',
  `publish_down` date DEFAULT NULL COMMENT 'Data para parar exibição do banner',
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_banner_imagem_descricao`
--

CREATE TABLE `tb_banner_imagem_descricao` (
  `id_banner` int(10) UNSIGNED NOT NULL,
  `id_midia` int(10) UNSIGNED NOT NULL,
  `id_idioma` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_categoria`
--

CREATE TABLE `tb_categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_parent` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `imagem` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `text_color` varchar(255) DEFAULT NULL,
  `ordem` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_categoria`
--

INSERT INTO `tb_categoria` (`id`, `id_parent`, `imagem`, `color`, `text_color`, `ordem`, `created_at`, `updated_at`, `status`) VALUES
(1, 0, NULL, '#81c784', '#000000', 0, '2022-11-18 03:02:55', NULL, '1'),
(2, 0, NULL, '#42a5f5', '#000000', 0, '2022-11-18 03:02:59', NULL, '1'),
(3, 0, NULL, '#fff176', '#000000', 0, '2022-11-18 03:03:04', NULL, '1'),
(4, 0, NULL, '#ef9a9a', '#000000', 0, '2022-11-18 03:03:05', NULL, '1'),
(5, 2, NULL, '#42a5f5', NULL, 0, '2022-11-18 03:03:06', NULL, '1'),
(6, 2, NULL, '#42a5f5', NULL, 0, '2022-11-18 03:03:07', NULL, '1'),
(7, 2, NULL, '#42a5f5', NULL, 0, '2022-11-18 03:03:07', NULL, '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_categoria_descricao`
--

CREATE TABLE `tb_categoria_descricao` (
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `id_idioma` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_categoria_descricao`
--

INSERT INTO `tb_categoria_descricao` (`id_categoria`, `id_idioma`, `titulo`, `descricao`, `meta_description`, `meta_title`, `meta_keywords`) VALUES
(1, 1, 'Consulta', '', '', '', ''),
(2, 1, 'Exame', '', '', '', ''),
(3, 1, 'Procedimento', '', '', '', ''),
(4, 1, 'Cirurgia', '', '', '', ''),
(5, 1, 'Laboratório', '', '', '', ''),
(6, 1, 'Imagem', '', '', '', ''),
(7, 1, 'Outros', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_comentario`
--

CREATE TABLE `tb_comentario` (
  `id` int(10) UNSIGNED NOT NULL,
  `autor` varchar(100) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `profissao` varchar(100) DEFAULT NULL,
  `estrelas` int(11) NOT NULL DEFAULT 5,
  `texto` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data de criação do comentário',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Data a última modificação do comentário',
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_distribuidor`
--

CREATE TABLE `tb_distribuidor` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `uf` varchar(3) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_distribuidor_email`
--

CREATE TABLE `tb_distribuidor_email` (
  `id_distribuidor` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_distribuidor_telefone`
--

CREATE TABLE `tb_distribuidor_telefone` (
  `id_distribuidor` int(10) UNSIGNED NOT NULL,
  `telefone` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_email`
--

CREATE TABLE `tb_email` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_reply` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(16) NOT NULL,
  `assunto` varchar(100) NOT NULL,
  `mensagem` text NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_empresa`
--

CREATE TABLE `tb_empresa` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Chave primária da tabela.',
  `titulo` varchar(50) DEFAULT NULL,
  `nome_fantasia` varchar(200) DEFAULT NULL COMMENT 'Nome Fantasia da empresa.',
  `razao_social` varchar(200) NOT NULL COMMENT 'Razão Social da empresa',
  `cnpj` varchar(18) NOT NULL COMMENT 'CNPJ da empresa.',
  `inscricao_estadual` varchar(14) DEFAULT NULL COMMENT 'Inscrição Estadual da empresa',
  `inscricao_municipal` varchar(20) DEFAULT NULL COMMENT 'Inscrição Municipal da empresa.',
  `cep` varchar(9) NOT NULL COMMENT 'CEP do endereço da empresa',
  `logradouro` varchar(200) NOT NULL COMMENT 'Endereço da empresa',
  `numero` varchar(11) DEFAULT NULL COMMENT 'Número do endereço da empresa',
  `bairro` varchar(200) NOT NULL COMMENT 'Bairro do endereço da empresa',
  `complemento` varchar(200) DEFAULT NULL COMMENT 'Complemento do endereço da empresa',
  `cidade` varchar(200) NOT NULL COMMENT 'Cidade',
  `uf` varchar(3) NOT NULL COMMENT 'Estado',
  `pais` varchar(20) DEFAULT NULL,
  `quem_somos` text DEFAULT NULL COMMENT 'Descrição da empresa',
  `quem_somos_imagem` varchar(255) DEFAULT NULL,
  `distribuidor_imagem` varchar(255) DEFAULT NULL,
  `contato_imagem` varchar(255) DEFAULT NULL,
  `telefone` varchar(16) DEFAULT NULL COMMENT 'Número do telefone da empresa',
  `celular` varchar(16) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL COMMENT 'E-mail da empresa',
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `gmaps` varchar(255) DEFAULT NULL,
  `aliquota_imposto` decimal(10,3) UNSIGNED NOT NULL DEFAULT 0.000 COMMENT 'Alíquota de imposto da empresa',
  `tributacao` enum('SIMPLES NACIONAL','SN - EXCESSO DE SUB-LIMITE DA RECEITA','REGIME NORMAL') NOT NULL DEFAULT 'SIMPLES NACIONAL' COMMENT 'Tipo de tributação',
  `certificado` blob DEFAULT NULL COMMENT 'Localização do arquivo de certificado digital para emissão de notas fiscais',
  `senha_certificado` varchar(255) DEFAULT NULL COMMENT 'Senha do certificado digital',
  `ambiente` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'Tipo do ambiente de emissão de notas fiscais. 0 - Homologação; 1 - Produção',
  `sequence_nfe` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Número da última nota fiscal eletrônica emitida.',
  `sequence_nfce` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Número da última nota fiscal de consumidor emitida.',
  `serie_nfe` int(2) UNSIGNED ZEROFILL NOT NULL DEFAULT 00 COMMENT 'Série da nota fiscal eletrônica.',
  `serie_nfce` int(2) UNSIGNED ZEROFILL NOT NULL DEFAULT 00 COMMENT 'Série da nota fiscal de consumidor.',
  `tokencsc` varchar(6) DEFAULT NULL COMMENT 'Token CSC',
  `csc` varchar(36) DEFAULT NULL COMMENT 'CSC',
  `matriz` enum('S','N') NOT NULL DEFAULT 'N' COMMENT 'Identifica como loja Matriz ou Filial',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela de cadastro de lojas/empresas';

--
-- Despejando dados para a tabela `tb_empresa`
--

INSERT INTO `tb_empresa` (`id`, `titulo`, `nome_fantasia`, `razao_social`, `cnpj`, `inscricao_estadual`, `inscricao_municipal`, `cep`, `logradouro`, `numero`, `bairro`, `complemento`, `cidade`, `uf`, `pais`, `quem_somos`, `quem_somos_imagem`, `distribuidor_imagem`, `contato_imagem`, `telefone`, `celular`, `email`, `facebook`, `instagram`, `youtube`, `linkedin`, `github`, `gmaps`, `aliquota_imposto`, `tributacao`, `certificado`, `senha_certificado`, `ambiente`, `sequence_nfe`, `sequence_nfce`, `serie_nfe`, `serie_nfce`, `tokencsc`, `csc`, `matriz`, `created_at`, `updated_at`, `status`) VALUES
(16, 'ODONTOLOGIA URGENCIA E EMERGENCIA 24H', NULL, 'ALL SMILES INSTITUTO ODONTOLÓGICO LTDA', '31.806.287/0001-75', NULL, NULL, '58040-750', 'RUA DOUTOR OSORIO ABATH', '46', 'TORRE', NULL, 'JOAO PESSOA', 'PB', 'BRASIL', NULL, NULL, NULL, NULL, NULL, '(83) 986 878 331', 'institutoallsmiles@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '0.000', 'SIMPLES NACIONAL', NULL, NULL, '0', 0, 0, 00, 00, NULL, NULL, '', '2023-03-29 23:46:25', '2023-08-28 22:30:03', '1'),
(17, 'ISOMED EXAMES DE IMAGEM', NULL, 'INSTITUTO DE SAUDE OCUPACIONAL E MEDICINA', '28.185.950/0001-57', NULL, NULL, '58013-360', 'AVENIDA CAMILO DE HOLANDA', '478', 'CENTRO', 'SALA102', 'JOAO PESSOA', 'PB', 'BRASIL', NULL, NULL, NULL, NULL, '(83) 3506-1672', '(83) 998 695 732', 'contato@isomedjp.com', NULL, NULL, NULL, NULL, NULL, NULL, '0.000', 'SIMPLES NACIONAL', NULL, NULL, '0', 0, 0, 00, 00, NULL, NULL, 'N', '2023-03-29 23:51:27', '2023-05-17 18:06:02', '1'),
(18, 'INSTITUTO CLINAM MULTIPROFISSIONAIS.', NULL, 'INSTITUTO CLINAM LTDA', '46.600.770/0001-76', NULL, NULL, '58013-342', 'R. Borja Peregrino', '218', 'Centro', NULL, 'JOAO PESSOA', 'PB', 'BRASIL', NULL, NULL, NULL, NULL, '(83) 2106-8202', NULL, NULL, NULL, '@CLINAMSAUDE', NULL, NULL, NULL, NULL, '0.000', 'SIMPLES NACIONAL', NULL, NULL, '0', 0, 0, 00, 00, NULL, NULL, 'N', '2023-03-30 00:22:35', '2023-05-17 18:05:17', '1'),
(19, 'DELFIN- EXAMES DE IMAGEM', NULL, 'ECOCLINICA LTDA', '57.754.285/0001-73', NULL, NULL, '58013-240', 'AVENIDA CORALIO SOARES DA OLIVEIRA', '305', 'CENTRO', NULL, 'JOAO PESSOA', 'PB', 'BRASIL', NULL, NULL, NULL, NULL, '(83) 3049-4444', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.000', 'SIMPLES NACIONAL', NULL, NULL, '0', 0, 0, 00, 00, NULL, NULL, 'N', '2023-03-30 01:31:08', '2023-05-17 18:05:03', '1'),
(20, 'Clinica Médicus24H', NULL, 'Médicus24h servicos e atividades de apoio a saúde ltda', '47.753.618/0001-96', NULL, NULL, '58000-000', 'João Pessoa', '0', 'Centro', 'João Pessoa', 'João Pessoa', 'PB', 'Brasil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.000', 'SIMPLES NACIONAL', NULL, NULL, '0', 0, 0, 00, 00, NULL, NULL, '', '2023-03-30 22:24:43', '2023-05-17 19:25:57', '1'),
(21, 'PSICONEURO - SERVICOS DE PSICOLOGIA', NULL, 'CM SERVICOS DE PSICOLOGIA LTDA', '26.429.306/0001-51', NULL, NULL, '58013-430', 'AVENIDA COREMAS', '478', 'CENTRO', NULL, 'JOAO PESSOA', 'PB', 'BRASIL', NULL, NULL, NULL, NULL, '(83) 3506-0973', NULL, 'psiconeuro.ltda@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '0.000', 'SIMPLES NACIONAL', NULL, NULL, '0', 0, 0, 00, 00, NULL, NULL, '', '2023-03-30 23:23:35', '2023-05-17 18:04:21', '1'),
(22, 'POLICLINICA MED SAUDE', NULL, 'DR MENDONCA SERVICOS MEDICOS LTDA', '37.010.056/0001-37', NULL, NULL, '58040-440', 'AVENIDA DOM PEDRO II', '1270', 'TORRE', NULL, 'JOAO PESSOA', 'PB', 'BRASIL', NULL, NULL, NULL, NULL, '(83) 3508-4663', '(83) 965 676 46', 'adm.medsaudejp@gmail.com', NULL, '@medsaudejp', NULL, NULL, NULL, NULL, '0.000', 'SIMPLES NACIONAL', NULL, NULL, '0', 0, 0, 00, 00, NULL, NULL, 'N', '2023-03-30 23:29:37', '2023-05-17 18:04:48', '1'),
(23, 'Policlinica Emma', NULL, 'Policlinica Emma Saude Medica LTDA', '43.882.086/0001-36', NULL, NULL, '58056-010', 'Rua Elias Pereira de Araujo', '66', 'Mangabeira', NULL, 'JOAO PESSOA', 'PB', 'BRASIL', NULL, NULL, NULL, NULL, '(83) 3023-3333', NULL, 'emma.policlinica@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '0.000', 'SIMPLES NACIONAL', NULL, NULL, '0', 0, 0, 00, 00, NULL, NULL, 'N', '2023-03-30 23:33:49', '2023-05-17 18:06:15', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_galeria`
--

CREATE TABLE `tb_galeria` (
  `id` int(10) UNSIGNED NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `publish_up` date NOT NULL COMMENT 'Data para exibição do banner',
  `publish_down` date NOT NULL COMMENT 'Data para parar exibição do banner',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_galeria_descricao`
--

CREATE TABLE `tb_galeria_descricao` (
  `id_galeria` int(10) UNSIGNED NOT NULL,
  `id_idioma` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_galeria_imagem`
--

CREATE TABLE `tb_galeria_imagem` (
  `id_galeria` int(10) UNSIGNED NOT NULL,
  `id_midia` int(10) UNSIGNED NOT NULL,
  `clicks` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `url` varchar(255) DEFAULT NULL,
  `ordem` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ordem para listagem do banner',
  `publish_up` date NOT NULL COMMENT 'Data para exibição do banner',
  `publish_down` date NOT NULL COMMENT 'Data para parar exibição do banner',
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'Situação de exibição do banner. 0 - Não exibir; 1 - Exibir.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_lead`
--

CREATE TABLE `tb_lead` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_produto` int(10) UNSIGNED NOT NULL,
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_link`
--

CREATE TABLE `tb_link` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `slug` varchar(500) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `target` varchar(6) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela de adição de links rápidos do site';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_link_descricao`
--

CREATE TABLE `tb_link_descricao` (
  `id_link` int(10) UNSIGNED NOT NULL,
  `id_idioma` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_midia`
--

CREATE TABLE `tb_midia` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `filesize` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Tamanho da imagem do banner',
  `mime_type` varchar(45) DEFAULT NULL,
  `path` varchar(255) NOT NULL COMMENT 'Data de criação do banner',
  `descricao` varchar(500) DEFAULT NULL,
  `clicks` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Quantidade de clicks/visualizações do banner',
  `url` varchar(255) DEFAULT NULL COMMENT 'Link para artigo',
  `ordem` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Ordem para listagem do banner',
  `autor` varchar(45) NOT NULL DEFAULT 'none',
  `publish_up` date DEFAULT NULL COMMENT 'Data para exibição do banner',
  `publish_down` date DEFAULT NULL COMMENT 'Data para parar exibição do banner',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `tags` text DEFAULT NULL COMMENT 'Tags de pesquisa do banner',
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_midia_descricao`
--

CREATE TABLE `tb_midia_descricao` (
  `id_midia` int(10) UNSIGNED NOT NULL,
  `id_idioma` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_post`
--

CREATE TABLE `tb_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_controller` int(10) UNSIGNED NOT NULL,
  `id_parent` int(10) UNSIGNED DEFAULT 0,
  `permissao` smallint(5) UNSIGNED NOT NULL DEFAULT 1111,
  `tipo` varchar(20) NOT NULL DEFAULT 'post' COMMENT 'Informa o tipo de página: Página simples ou galeria de fotos',
  `autor` varchar(45) DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_post_descricao`
--

CREATE TABLE `tb_post_descricao` (
  `id_post` int(10) UNSIGNED NOT NULL,
  `id_idioma` int(10) UNSIGNED NOT NULL,
  `titulo` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subtitulo` varchar(45) DEFAULT NULL,
  `texto` varchar(45) DEFAULT NULL,
  `meta_description` varchar(45) DEFAULT NULL,
  `meta_keywords` varchar(45) DEFAULT NULL,
  `meta_title` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_post_link`
--

CREATE TABLE `tb_post_link` (
  `id_post` int(10) UNSIGNED NOT NULL,
  `id_link` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para vincluar um link a uma página';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_post_midia`
--

CREATE TABLE `tb_post_midia` (
  `id_pagina` int(10) UNSIGNED NOT NULL,
  `id_midia` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_banner`
--
ALTER TABLE `tb_banner`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_banner_descricao`
--
ALTER TABLE `tb_banner_descricao`
  ADD PRIMARY KEY (`id_banner`,`id_idioma`),
  ADD KEY `fk_tb_banner_descricao_tb_banner1_idx` (`id_banner`),
  ADD KEY `fk_tb_banner_descricao_tb_sys_idioma1_idx` (`id_idioma`);

--
-- Índices de tabela `tb_banner_imagem`
--
ALTER TABLE `tb_banner_imagem`
  ADD PRIMARY KEY (`id_banner`,`id_midia`),
  ADD UNIQUE KEY `id_banner_UNIQUE` (`id_banner`),
  ADD UNIQUE KEY `id_midia_UNIQUE` (`id_midia`),
  ADD KEY `fk_tb_banner_imagem_tb_banner1_idx` (`id_banner`),
  ADD KEY `fk_tb_banner_imagem_tb_midia1_idx` (`id_midia`);

--
-- Índices de tabela `tb_banner_imagem_descricao`
--
ALTER TABLE `tb_banner_imagem_descricao`
  ADD PRIMARY KEY (`id_banner`,`id_midia`,`id_idioma`),
  ADD KEY `fk_tb_banner_imagem_descricao_tb_sys_idioma1_idx` (`id_idioma`),
  ADD KEY `fk_tb_banner_imagem_descricao_tb_banner_imagem1_idx` (`id_banner`,`id_midia`);

--
-- Índices de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_categoria_descricao`
--
ALTER TABLE `tb_categoria_descricao`
  ADD PRIMARY KEY (`id_categoria`,`id_idioma`),
  ADD UNIQUE KEY `titulo_UNIQUE` (`titulo`),
  ADD KEY `fk_tb_categoria_descricao_tb_categoria1_idx` (`id_categoria`),
  ADD KEY `fk_tb_categoria_descricao_tb_sys_idioma1_idx` (`id_idioma`);

--
-- Índices de tabela `tb_comentario`
--
ALTER TABLE `tb_comentario`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_distribuidor`
--
ALTER TABLE `tb_distribuidor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_distribuidor_email`
--
ALTER TABLE `tb_distribuidor_email`
  ADD PRIMARY KEY (`id_distribuidor`,`email`),
  ADD KEY `fk_tb_distribuidor_email_id_distribuidor` (`id_distribuidor`);

--
-- Índices de tabela `tb_distribuidor_telefone`
--
ALTER TABLE `tb_distribuidor_telefone`
  ADD PRIMARY KEY (`id_distribuidor`,`telefone`),
  ADD KEY `fk_tb_distribuidor_telefone_id_distribuidor` (`id_distribuidor`);

--
-- Índices de tabela `tb_email`
--
ALTER TABLE `tb_email`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_empresa`
--
ALTER TABLE `tb_empresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnpj` (`cnpj`);

--
-- Índices de tabela `tb_galeria`
--
ALTER TABLE `tb_galeria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_galeria_descricao`
--
ALTER TABLE `tb_galeria_descricao`
  ADD PRIMARY KEY (`id_galeria`,`id_idioma`),
  ADD KEY `fk_tb_galeria_descricao_tb_galeria1_idx` (`id_galeria`),
  ADD KEY `fk_tb_galeria_descricao_tb_sys_idioma1_idx` (`id_idioma`);

--
-- Índices de tabela `tb_galeria_imagem`
--
ALTER TABLE `tb_galeria_imagem`
  ADD PRIMARY KEY (`id_galeria`,`id_midia`),
  ADD KEY `fk_tb_album_foto_id_album` (`id_galeria`),
  ADD KEY `fk_tb_galeria_imagem_tb_midia1_idx` (`id_midia`);

--
-- Índices de tabela `tb_lead`
--
ALTER TABLE `tb_lead`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_lead_id_cliente` (`id_cliente`),
  ADD KEY `tb_lead_id_produto` (`id_produto`);

--
-- Índices de tabela `tb_link`
--
ALTER TABLE `tb_link`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_link_descricao`
--
ALTER TABLE `tb_link_descricao`
  ADD PRIMARY KEY (`id_link`,`id_idioma`),
  ADD KEY `fk_tb_link_descricao_tb_link1_idx` (`id_link`),
  ADD KEY `fk_tb_link_descricao_tb_sys_idioma1_idx` (`id_idioma`);

--
-- Índices de tabela `tb_midia`
--
ALTER TABLE `tb_midia`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_midia_descricao`
--
ALTER TABLE `tb_midia_descricao`
  ADD PRIMARY KEY (`id_midia`,`id_idioma`),
  ADD KEY `fk_tb_midia_descricao_tb_midia1_idx` (`id_midia`),
  ADD KEY `fk_tb_midia_descricao_tb_sys_idioma1_idx` (`id_idioma`);

--
-- Índices de tabela `tb_post`
--
ALTER TABLE `tb_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_post_tb_acl_modulo_id_controller` (`id_controller`);

--
-- Índices de tabela `tb_post_descricao`
--
ALTER TABLE `tb_post_descricao`
  ADD PRIMARY KEY (`id_post`,`id_idioma`),
  ADD KEY `fk_tb_pagina_descricao_tb_pagina1_idx` (`id_post`),
  ADD KEY `fk_tb_pagina_descricao_tb_sys_idioma1_idx` (`id_idioma`);

--
-- Índices de tabela `tb_post_link`
--
ALTER TABLE `tb_post_link`
  ADD PRIMARY KEY (`id_post`,`id_link`),
  ADD KEY `fk_tb_link_pagina_id_link` (`id_link`),
  ADD KEY `fk_tb_link_pagina_id_pagina` (`id_post`);

--
-- Índices de tabela `tb_post_midia`
--
ALTER TABLE `tb_post_midia`
  ADD PRIMARY KEY (`id_pagina`,`id_midia`),
  ADD UNIQUE KEY `id_pagina_UNIQUE` (`id_pagina`,`id_midia`),
  ADD UNIQUE KEY `id_midia_UNIQUE` (`id_midia`,`id_pagina`),
  ADD KEY `fk_tb_pagina_midia_tb_pagina1_idx` (`id_pagina`),
  ADD KEY `fk_tb_pagina_midia_tb_midia1_idx` (`id_midia`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_banner`
--
ALTER TABLE `tb_banner`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Numero sequencial';

--
-- AUTO_INCREMENT de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_comentario`
--
ALTER TABLE `tb_comentario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_distribuidor`
--
ALTER TABLE `tb_distribuidor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_email`
--
ALTER TABLE `tb_email`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_empresa`
--
ALTER TABLE `tb_empresa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Chave primária da tabela.', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `tb_galeria`
--
ALTER TABLE `tb_galeria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_lead`
--
ALTER TABLE `tb_lead`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_link`
--
ALTER TABLE `tb_link`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_midia`
--
ALTER TABLE `tb_midia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_post`
--
ALTER TABLE `tb_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_banner_descricao`
--
ALTER TABLE `tb_banner_descricao`
  ADD CONSTRAINT `fk_tb_banner_descricao_tb_banner1` FOREIGN KEY (`id_banner`) REFERENCES `tb_banner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_banner_descricao_tb_sys_idioma1` FOREIGN KEY (`id_idioma`) REFERENCES `medicus_sistema`.`tb_sys_idioma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_banner_imagem`
--
ALTER TABLE `tb_banner_imagem`
  ADD CONSTRAINT `fk_tb_banner_imagem_tb_banner1` FOREIGN KEY (`id_banner`) REFERENCES `tb_banner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_banner_imagem_tb_midia1` FOREIGN KEY (`id_midia`) REFERENCES `tb_midia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_banner_imagem_descricao`
--
ALTER TABLE `tb_banner_imagem_descricao`
  ADD CONSTRAINT `fk_tb_banner_imagem_descricao_tb_banner_imagem1` FOREIGN KEY (`id_banner`,`id_midia`) REFERENCES `tb_banner_imagem` (`id_banner`, `id_midia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_banner_imagem_descricao_tb_sys_idioma1` FOREIGN KEY (`id_idioma`) REFERENCES `medicus_sistema`.`tb_sys_idioma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_categoria_descricao`
--
ALTER TABLE `tb_categoria_descricao`
  ADD CONSTRAINT `fk_tb_categoria_descricao_tb_categoria1` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_categoria_descricao_tb_sys_idioma1` FOREIGN KEY (`id_idioma`) REFERENCES `medicus_sistema`.`tb_sys_idioma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_distribuidor_email`
--
ALTER TABLE `tb_distribuidor_email`
  ADD CONSTRAINT `fk_tb_distribuidor_email_id_distribuidor` FOREIGN KEY (`id_distribuidor`) REFERENCES `tb_distribuidor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_distribuidor_telefone`
--
ALTER TABLE `tb_distribuidor_telefone`
  ADD CONSTRAINT `fk_tb_distribuidor_telefone_id_distribuidor` FOREIGN KEY (`id_distribuidor`) REFERENCES `tb_distribuidor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_galeria_descricao`
--
ALTER TABLE `tb_galeria_descricao`
  ADD CONSTRAINT `fk_tb_galeria_descricao_tb_galeria1` FOREIGN KEY (`id_galeria`) REFERENCES `tb_galeria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_galeria_descricao_tb_sys_idioma1` FOREIGN KEY (`id_idioma`) REFERENCES `medicus_sistema`.`tb_sys_idioma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_galeria_imagem`
--
ALTER TABLE `tb_galeria_imagem`
  ADD CONSTRAINT `fk_tb_album_foto_id_album` FOREIGN KEY (`id_galeria`) REFERENCES `tb_galeria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_galeria_imagem_tb_midia1` FOREIGN KEY (`id_midia`) REFERENCES `tb_midia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_lead`
--
ALTER TABLE `tb_lead`
  ADD CONSTRAINT `tb_lead_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_lead_id_produto` FOREIGN KEY (`id_produto`) REFERENCES `tb_produto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_link_descricao`
--
ALTER TABLE `tb_link_descricao`
  ADD CONSTRAINT `fk_tb_link_descricao_tb_link1` FOREIGN KEY (`id_link`) REFERENCES `tb_link` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_link_descricao_tb_sys_idioma1` FOREIGN KEY (`id_idioma`) REFERENCES `medicus_sistema`.`tb_sys_idioma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_midia_descricao`
--
ALTER TABLE `tb_midia_descricao`
  ADD CONSTRAINT `fk_tb_midia_descricao_tb_midia1` FOREIGN KEY (`id_midia`) REFERENCES `tb_midia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_midia_descricao_tb_sys_idioma1` FOREIGN KEY (`id_idioma`) REFERENCES `medicus_sistema`.`tb_sys_idioma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_post`
--
ALTER TABLE `tb_post`
  ADD CONSTRAINT `fk_tb_post_tb_acl_modulo_classe1` FOREIGN KEY (`id_controller`) REFERENCES `medicus_sistema`.`tb_acl_modulo_controller` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_post_descricao`
--
ALTER TABLE `tb_post_descricao`
  ADD CONSTRAINT `fk_tb_pagina_descricao_tb_post` FOREIGN KEY (`id_post`) REFERENCES `tb_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_pagina_descricao_tb_sys_idioma1` FOREIGN KEY (`id_idioma`) REFERENCES `medicus_sistema`.`tb_sys_idioma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_post_link`
--
ALTER TABLE `tb_post_link`
  ADD CONSTRAINT `fk_tb_link_pagina_id_link` FOREIGN KEY (`id_link`) REFERENCES `tb_link` (`id`),
  ADD CONSTRAINT `fk_tb_link_pagina_id_post` FOREIGN KEY (`id_post`) REFERENCES `tb_post` (`id`);

--
-- Restrições para tabelas `tb_post_midia`
--
ALTER TABLE `tb_post_midia`
  ADD CONSTRAINT `fk_tb_pagina_midia_tb_midia1` FOREIGN KEY (`id_midia`) REFERENCES `tb_midia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_pagina_midia_tb_pagina1` FOREIGN KEY (`id_pagina`) REFERENCES `tb_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
