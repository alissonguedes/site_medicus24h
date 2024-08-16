-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 16/08/2024 às 18:32
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
-- Banco de dados: `medicus_medicus24h`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acomodacao`
--

CREATE TABLE `tb_acomodacao` (
  `id` int(11) UNSIGNED NOT NULL,
  `descricao` varchar(20) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_agenda`
--

CREATE TABLE `tb_agenda` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_medico` int(10) UNSIGNED NOT NULL,
  `dia` tinyint(3) UNSIGNED NOT NULL,
  `mes` tinyint(2) UNSIGNED ZEROFILL DEFAULT 00,
  `ano` tinyint(4) UNSIGNED ZEROFILL DEFAULT 0000,
  `hora_inicial` time NOT NULL DEFAULT '00:00:00',
  `hora_final` time NOT NULL DEFAULT '00:00:00',
  `observacao` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela de cadastro de dias de atendimentos da agenda médica';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_atendimento`
--

CREATE TABLE `tb_atendimento` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_tipo` int(11) UNSIGNED NOT NULL COMMENT 'Pode ser uma primeira consulta ou um retorno, etc.',
  `id_medico` int(11) UNSIGNED NOT NULL,
  `id_clinica` int(11) UNSIGNED NOT NULL,
  `id_paciente` int(11) UNSIGNED NOT NULL,
  `id_convenio` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(11) UNSIGNED NOT NULL COMMENT 'Consulta, exame, procedimento, cirurgia etc.',
  `id_parent` int(11) UNSIGNED DEFAULT 0,
  `titulo` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `data` date NOT NULL DEFAULT '0000-00-00',
  `hora_agendada` time NOT NULL,
  `hora_inicial` time DEFAULT '00:00:00',
  `hora_final` time DEFAULT '00:00:00',
  `tempo_atendimento` time NOT NULL DEFAULT '00:00:00',
  `recorrencia` enum('on','off') NOT NULL DEFAULT 'off',
  `recorrencia_periodo` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `recorrencia_limite` date DEFAULT NULL,
  `cor` varchar(25) DEFAULT NULL,
  `criador` int(11) UNSIGNED NOT NULL,
  `lembrete` enum('on','off') NOT NULL DEFAULT 'off',
  `tempo_lembrete` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `periodo_lembrete` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `encaixe` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('0','1','A','I','F','R','C') NOT NULL DEFAULT '1' COMMENT '''1'': ''Agendado'';\r\n''A'': ''Aguardando/Em Espera'';\r\n''I'': ''Iniciado'';\r\n''F'': ''Finalizado'';\r\n''R'': ''Remarcado'';\r\n''C'': ''Cancelado'';\r\n''0'': ''Não compareceu''.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela de cadastro de agendamentos de eventos médicos';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_atendimento_exame`
--

CREATE TABLE `tb_atendimento_exame` (
  `id_atendimento` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_atendimento_notas`
--

CREATE TABLE `tb_atendimento_notas` (
  `id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `id_severidade` int(10) UNSIGNED NOT NULL,
  `id_atendimento` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para cadastro de notas em atendimentos realizados.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_atendimento_prioridade`
--

CREATE TABLE `tb_atendimento_prioridade` (
  `id` int(11) UNSIGNED NOT NULL,
  `prioridade` varchar(60) NOT NULL,
  `prioridade_desc` varchar(500) DEFAULT NULL,
  `cor` varchar(255) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_atendimento_registro`
--

CREATE TABLE `tb_atendimento_registro` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_parent` int(11) UNSIGNED DEFAULT NULL,
  `id_atendimento` int(11) UNSIGNED NOT NULL,
  `id_funcionario` int(11) UNSIGNED DEFAULT NULL,
  `id_usuario` int(11) UNSIGNED DEFAULT NULL,
  `id_departamento` int(11) UNSIGNED NOT NULL,
  `id_prioridade` int(11) UNSIGNED NOT NULL,
  `tipo` char(1) NOT NULL DEFAULT 'L' COMMENT 'Tipo do registro gravado: L - Log',
  `title` varchar(1000) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Esta tabela armazena todas as atualizações feitas em um atendimento. Registra quem atendeu o paciente, aonde foi feito o atendimento, descreve se foi transferido para outro setor e outras informações.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_atendimento_tipo`
--

CREATE TABLE `tb_atendimento_tipo` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `descricao` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela de cadastro para tipos de atendimentos';

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
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
-- Estrutura para tabela `tb_cliente_email`
--

CREATE TABLE `tb_cliente_email` (
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cliente_telefone`
--

CREATE TABLE `tb_cliente_telefone` (
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `telefone` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estrutura para tabela `tb_convenio`
--

CREATE TABLE `tb_convenio` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_parent` int(11) UNSIGNED DEFAULT NULL,
  `descricao` varchar(100) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `flag` varchar(500) NOT NULL,
  `status` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para cadastro de convênios de pacientes.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_convenio_planos`
--

CREATE TABLE `tb_convenio_planos` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_convenio` int(11) UNSIGNED NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `flag` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela para adicionar pacotes de programas';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_convenio_planos_servicos`
--

CREATE TABLE `tb_convenio_planos_servicos` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_plano` int(11) UNSIGNED NOT NULL,
  `id_servico` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela para adicionar serviços';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_departamento`
--

CREATE TABLE `tb_departamento` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para vincular médico a várias clínica';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_departamento_empresa`
--

CREATE TABLE `tb_departamento_empresa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_departamento` int(10) UNSIGNED NOT NULL,
  `id_empresa` int(10) UNSIGNED NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
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
  `cep` varchar(9) DEFAULT NULL COMMENT 'CEP do endereço da empresa',
  `logradouro` varchar(200) DEFAULT NULL COMMENT 'Endereço da empresa',
  `numero` varchar(11) DEFAULT NULL COMMENT 'Número do endereço da empresa',
  `bairro` varchar(200) DEFAULT NULL COMMENT 'Bairro do endereço da empresa',
  `complemento` varchar(200) DEFAULT NULL COMMENT 'Complemento do endereço da empresa',
  `cidade` varchar(200) DEFAULT NULL COMMENT 'Cidade',
  `uf` varchar(3) DEFAULT NULL COMMENT 'Estado',
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
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela de cadastro de lojas/empresas';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_especialidade`
--

CREATE TABLE `tb_especialidade` (
  `id` int(10) UNSIGNED NOT NULL,
  `especialidade` varchar(255) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para cadastro de especialidades médicas';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_estado_civil`
--

CREATE TABLE `tb_estado_civil` (
  `id` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_etnia`
--

CREATE TABLE `tb_etnia` (
  `id` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_file`
--

CREATE TABLE `tb_file` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_object` bigint(20) NOT NULL,
  `categoria` varchar(50) NOT NULL DEFAULT 'post' COMMENT 'Determina qual é a categoria de arquivo',
  `key` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `imgname` varchar(255) NOT NULL,
  `imgtype` varchar(255) NOT NULL,
  `imgsize` int(11) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_file_chunk`
--

CREATE TABLE `tb_file_chunk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_file` bigint(20) NOT NULL,
  `id_chunk` int(11) NOT NULL,
  `filedata` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_funcao`
--

CREATE TABLE `tb_funcao` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` int(10) UNSIGNED NOT NULL,
  `funcao` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para cadastro de funções';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_funcionario`
--

CREATE TABLE `tb_funcionario` (
  `id` int(11) UNSIGNED NOT NULL,
  `perfil` int(11) DEFAULT NULL,
  `id_departamento` int(11) UNSIGNED DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(14) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para cadastro de funcionários';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_funcionario_empresa`
--

CREATE TABLE `tb_funcionario_empresa` (
  `id_funcionario` int(11) UNSIGNED NOT NULL,
  `id_empresa` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estrutura para tabela `tb_medico`
--

CREATE TABLE `tb_medico` (
  `id_funcionario` int(11) UNSIGNED NOT NULL,
  `id_especialidade` int(10) UNSIGNED NOT NULL,
  `crm` varchar(14) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para cadastro de atendimentos realizados.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_medico_agenda`
--

CREATE TABLE `tb_medico_agenda` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_medico_clinica` int(10) UNSIGNED NOT NULL,
  `dia` tinyint(3) UNSIGNED NOT NULL COMMENT '0 - domingo,\r\n1 - segunda,\r\n2 - terça,\r\n3 - quarta,\r\n4 - quinta,\r\n5 - sexta,\r\n6 - sábado',
  `semana` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `mes` tinyint(2) UNSIGNED ZEROFILL NOT NULL DEFAULT 00,
  `ano` tinyint(4) UNSIGNED ZEROFILL NOT NULL DEFAULT 0000,
  `titulo` varchar(200) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `atende` enum('S','N') NOT NULL DEFAULT 'S' COMMENT 'O médico pode determinar o campo como inativo durante este horário. Se ele atende ou não. Caso ele não atenda, ele pode definir como horário de almoço, por exemplo. Este campo é apenas um controle interno para o recepcionista visualizar.',
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela de cadastro de dias de atendimentos da agenda médica';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_medico_agenda_horario`
--

CREATE TABLE `tb_medico_agenda_horario` (
  `id_agenda` int(11) UNSIGNED NOT NULL,
  `horarios` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela de cadastro de horários de atendimentos da agenda médica';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_medico_clinica`
--

CREATE TABLE `tb_medico_clinica` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_medico` int(11) UNSIGNED NOT NULL,
  `id_empresa` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para vincular médico a várias clínica';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_medico_especialidade`
--

CREATE TABLE `tb_medico_especialidade` (
  `id_funcionario` int(11) UNSIGNED NOT NULL COMMENT 'chave primária referente à tabela `tb_medico`.`id_funcionario`',
  `id_especialidade` int(11) UNSIGNED NOT NULL COMMENT 'chave primária referente à tabela `tb_especialidade`.`id`',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela de atribuições de especialidades a médicos';

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
-- Estrutura para tabela `tb_paciente`
--

CREATE TABLE `tb_paciente` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `codigo` varchar(11) NOT NULL,
  `associado` enum('yes','no') NOT NULL DEFAULT 'no',
  `id_convenio` int(11) UNSIGNED DEFAULT NULL,
  `id_tipo_convenio` int(11) UNSIGNED DEFAULT NULL,
  `matricula` char(18) NOT NULL,
  `id_acomodacao` int(11) UNSIGNED DEFAULT NULL,
  `validade` char(7) DEFAULT NULL,
  `id_estado_civil` int(10) UNSIGNED NOT NULL,
  `id_etnia` int(10) UNSIGNED NOT NULL DEFAULT 6,
  `sexo` enum('M','F') DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `rg` varchar(11) DEFAULT NULL,
  `cns` varchar(20) DEFAULT NULL,
  `mae` varchar(255) DEFAULT NULL,
  `pai` varchar(255) DEFAULT NULL,
  `profissao` varchar(100) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `notas_gerais` text DEFAULT NULL,
  `notas_alergias` text DEFAULT NULL,
  `notas_clinicas` text DEFAULT NULL,
  `logradouro` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `uf` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(16) DEFAULT NULL,
  `celular` varchar(16) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `receber_sms` enum('on','off') NOT NULL DEFAULT 'off',
  `receber_email` enum('on','off') NOT NULL DEFAULT 'off',
  `receber_notificacoes` enum('on','off') NOT NULL DEFAULT 'off',
  `obito` enum('0','1') NOT NULL DEFAULT '0',
  `datahora_obito` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_paciente_convenio`
--

CREATE TABLE `tb_paciente_convenio` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_paciente` int(11) UNSIGNED NOT NULL,
  `id_convenio` int(11) UNSIGNED NOT NULL,
  `id_tipo` int(11) UNSIGNED NOT NULL,
  `id_acomodacao` int(11) UNSIGNED NOT NULL,
  `matricula` char(18) NOT NULL,
  `validade_ano` int(4) UNSIGNED ZEROFILL NOT NULL,
  `validade_mes` int(2) UNSIGNED ZEROFILL NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_paciente_homecare`
--

CREATE TABLE `tb_paciente_homecare` (
  `id_paciente` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_paciente_nota`
--

CREATE TABLE `tb_paciente_nota` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_paciente` int(10) UNSIGNED NOT NULL,
  `id_severidade` int(10) UNSIGNED NOT NULL,
  `descricao` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_paciente_programa`
--

CREATE TABLE `tb_paciente_programa` (
  `id_paciente` int(11) UNSIGNED NOT NULL,
  `id_programa` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data de inserção do paciente no programa',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Data de saída do paciente do programa',
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0 - Zero quando o paciente for excluído do programa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela para vincular paciente a um programa';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_paciente_tarefas`
--

CREATE TABLE `tb_paciente_tarefas` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_paciente` int(11) UNSIGNED NOT NULL COMMENT 'Chave estrangeira referente à tabela `tb_paciente_homecare`, coluna ID.',
  `titulo` varchar(1000) NOT NULL,
  `descricao` text NOT NULL,
  `agendamento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_responsavel` int(11) UNSIGNED NOT NULL,
  `datahora_notificacao` timestamp NULL DEFAULT NULL,
  `recorrencia` enum('on','off') NOT NULL DEFAULT 'off',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `finalizada` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_paciente_tarefas_anotacoes`
--

CREATE TABLE `tb_paciente_tarefas_anotacoes` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_responsavel` int(11) UNSIGNED NOT NULL COMMENT 'Chave estrangeira da tabela referente à tabela de profissional responsável pelo atendimento.',
  `id_tarefa` int(11) UNSIGNED NOT NULL COMMENT 'Chave estrangeira da tabela referente à tabela tb_paciente_homecare_tarefa, coluna ID.',
  `descricao` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_procedimento`
--

CREATE TABLE `tb_procedimento` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_categoria` int(11) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `tempo` varchar(11) NOT NULL DEFAULT '0',
  `formato` enum('m','h') NOT NULL DEFAULT 'm',
  `valor` decimal(11,3) UNSIGNED NOT NULL DEFAULT 0.000,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela para cadastro de exames';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_procedimento_categoria`
--

CREATE TABLE `tb_procedimento_categoria` (
  `id` int(11) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `classificacao` varchar(100) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela para cadastro de categorias de exames';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produto`
--

CREATE TABLE `tb_produto` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_distribuidor` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `modo_uso` text NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `valor` decimal(10,3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produto_categoria`
--

CREATE TABLE `tb_produto_categoria` (
  `id_produto` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produto_descricao`
--

CREATE TABLE `tb_produto_descricao` (
  `id_produto` int(10) UNSIGNED NOT NULL,
  `id_idioma` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produto_imagem`
--

CREATE TABLE `tb_produto_imagem` (
  `id_produto` int(10) UNSIGNED NOT NULL,
  `id_midia` int(10) UNSIGNED NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_profissional`
--

CREATE TABLE `tb_profissional` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_departamento` int(11) UNSIGNED DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(14) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tabela para cadastro de funcionários';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_programas`
--

CREATE TABLE `tb_programas` (
  `id` int(11) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` varchar(1000) DEFAULT NULL,
  `publico` enum('A','F','M') NOT NULL DEFAULT 'A' COMMENT 'Público alvo para quem é destinado o programa. M: Homens; F: Mulheres; A: Ambos (a todos)',
  `idade_min` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Faixa etária para limitar a idade dos beneficiados. 000: Sem restrição',
  `idade_max` int(11) UNSIGNED NOT NULL DEFAULT 999 COMMENT 'Faixa etária para limitar a idade dos beneficiados. 999: Sem restrição',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela para adicionar programas médicos';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_programas_responsavel`
--

CREATE TABLE `tb_programas_responsavel` (
  `id_programa` int(11) UNSIGNED NOT NULL,
  `id_profissional` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_programas_tarefas`
--

CREATE TABLE `tb_programas_tarefas` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_programa` int(11) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `tipo` varchar(255) NOT NULL,
  `prazo` int(11) NOT NULL,
  `selecionar_responsavel` enum('todos','manualmente') NOT NULL DEFAULT 'manualmente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_prontuario`
--

CREATE TABLE `tb_prontuario` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_paciente` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_prontuario_registro`
--

CREATE TABLE `tb_prontuario_registro` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_parent` int(11) UNSIGNED DEFAULT NULL,
  `id_prontuario` int(11) UNSIGNED NOT NULL,
  `id_atendimento` int(11) UNSIGNED NOT NULL,
  `id_usuario` int(11) UNSIGNED NOT NULL COMMENT 'Usuário responsável pelo atendimento naquele momento',
  `usuario` varchar(100) NOT NULL COMMENT 'O nome do usuário referente ao `id_usuario`',
  `titulo` varchar(500) NOT NULL,
  `descricao` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_servicos`
--

CREATE TABLE `tb_servicos` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_parent` int(11) UNSIGNED DEFAULT NULL,
  `descricao` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela para adicionar serviços';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_severidade_nota`
--

CREATE TABLE `tb_severidade_nota` (
  `id` int(10) UNSIGNED NOT NULL,
  `descricao` text NOT NULL,
  `color` varchar(7) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
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
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Índices de tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices de tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices de tabela `tb_acomodacao`
--
ALTER TABLE `tb_acomodacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_agenda`
--
ALTER TABLE `tb_agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_agenda_id_medico` (`id_medico`),
  ADD KEY `horario_atendimento_UNIQUE` (`dia`,`mes`,`ano`,`hora_inicial`,`hora_final`) USING BTREE;

--
-- Índices de tabela `tb_atendimento`
--
ALTER TABLE `tb_atendimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_agendamento_id_categoria` (`id_categoria`),
  ADD KEY `fk_tb_agendamento_id_medico` (`id_medico`),
  ADD KEY `fk_tb_agendamento_id_paciente` (`id_paciente`),
  ADD KEY `fk_tb_agendamento_id_tipo` (`id_tipo`),
  ADD KEY `fk_tb_agendamento_id_usuario` (`criador`),
  ADD KEY `id_clinica` (`id_clinica`),
  ADD KEY `fk_tb_atendimento_id_convenio` (`id_convenio`);

--
-- Índices de tabela `tb_atendimento_exame`
--
ALTER TABLE `tb_atendimento_exame`
  ADD KEY `fk_tb_atendimento_exame_id_atendimento_id_paciente` (`id_atendimento`,`id_paciente`);

--
-- Índices de tabela `tb_atendimento_notas`
--
ALTER TABLE `tb_atendimento_notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_atendimento_id_severidade` (`id_severidade`),
  ADD KEY `fk_tb_atendimento_id_atendimento` (`id_atendimento`),
  ADD KEY `fk_tb_atendimento_id_usuario` (`id_usuario`);

--
-- Índices de tabela `tb_atendimento_prioridade`
--
ALTER TABLE `tb_atendimento_prioridade`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_atendimento_registro`
--
ALTER TABLE `tb_atendimento_registro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_atendimento_registro_id_parent` (`id_parent`),
  ADD KEY `fk_tb_atendimento_registro_id_atendimento` (`id_atendimento`),
  ADD KEY `fk_tb_atendimento_registro_id_funcionario` (`id_funcionario`),
  ADD KEY `fk_tb_atendimento_registro_id_usuario` (`id_usuario`),
  ADD KEY `fk_tb_atendimento_registro_id_prioridade` (`id_prioridade`);

--
-- Índices de tabela `tb_atendimento_tipo`
--
ALTER TABLE `tb_atendimento_tipo`
  ADD PRIMARY KEY (`id`);

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
-- Índices de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_cliente_email`
--
ALTER TABLE `tb_cliente_email`
  ADD PRIMARY KEY (`id_cliente`,`email`),
  ADD KEY `tb_cliente_email_id_cliente` (`id_cliente`);

--
-- Índices de tabela `tb_cliente_telefone`
--
ALTER TABLE `tb_cliente_telefone`
  ADD PRIMARY KEY (`id_cliente`,`telefone`),
  ADD KEY `tb_cliente_telefone_id_cliente` (`id_cliente`);

--
-- Índices de tabela `tb_comentario`
--
ALTER TABLE `tb_comentario`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_convenio`
--
ALTER TABLE `tb_convenio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_convenio_id_parent` (`id_parent`);

--
-- Índices de tabela `tb_convenio_planos`
--
ALTER TABLE `tb_convenio_planos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_convenio_planos_id_convenio` (`id_convenio`);

--
-- Índices de tabela `tb_convenio_planos_servicos`
--
ALTER TABLE `tb_convenio_planos_servicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_convenio_planos_servicos_id_plano` (`id_plano`);

--
-- Índices de tabela `tb_departamento`
--
ALTER TABLE `tb_departamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_departamento_empresa`
--
ALTER TABLE `tb_departamento_empresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_empresa_departamento` (`id_departamento`,`id_empresa`),
  ADD KEY `fk_tb_departamento_id_empresa` (`id_empresa`);

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
-- Índices de tabela `tb_especialidade`
--
ALTER TABLE `tb_especialidade`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_estado_civil`
--
ALTER TABLE `tb_estado_civil`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_etnia`
--
ALTER TABLE `tb_etnia`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_file`
--
ALTER TABLE `tb_file`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_file_chunk`
--
ALTER TABLE `tb_file_chunk`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_funcao`
--
ALTER TABLE `tb_funcao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `tb_funcionario_empresa`
--
ALTER TABLE `tb_funcionario_empresa`
  ADD UNIQUE KEY `id_funcionario_empresa_UNIQUE` (`id_funcionario`,`id_empresa`);

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
-- Índices de tabela `tb_medico`
--
ALTER TABLE `tb_medico`
  ADD PRIMARY KEY (`id_funcionario`,`crm`),
  ADD UNIQUE KEY `crm` (`crm`),
  ADD UNIQUE KEY `fk_tb_medico_id_funcionario_UNIQUE` (`id_funcionario`),
  ADD KEY `fk_tb_medico_id_especialidade` (`id_especialidade`);

--
-- Índices de tabela `tb_medico_agenda`
--
ALTER TABLE `tb_medico_agenda`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `horario_atendimento_UNIQUE` (`id_medico_clinica`,`semana`,`mes`,`ano`,`dia`) USING BTREE;

--
-- Índices de tabela `tb_medico_agenda_horario`
--
ALTER TABLE `tb_medico_agenda_horario`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Índices de tabela `tb_medico_clinica`
--
ALTER TABLE `tb_medico_clinica`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_medico_clinica` (`id_medico`,`id_empresa`) USING BTREE,
  ADD KEY `fk_tb_medico_clinica_tb_empresa1_idx` (`id_empresa`);

--
-- Índices de tabela `tb_medico_especialidade`
--
ALTER TABLE `tb_medico_especialidade`
  ADD PRIMARY KEY (`id_funcionario`,`id_especialidade`),
  ADD KEY `fk_tb_medico_especialidade_id_especialidade` (`id_especialidade`);

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
-- Índices de tabela `tb_paciente`
--
ALTER TABLE `tb_paciente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_tb_paciente_id_estado_civil` (`id_estado_civil`),
  ADD KEY `fk_tb_paciente_id_etnia` (`id_etnia`),
  ADD KEY `fk_tb_paciente_id_acomodacao` (`id_acomodacao`),
  ADD KEY `fk_tb_paciente_id_tipo_convenio` (`id_tipo_convenio`),
  ADD KEY `fk_tb_paciente_id_convenio` (`id_convenio`);

--
-- Índices de tabela `tb_paciente_convenio`
--
ALTER TABLE `tb_paciente_convenio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_paciente_convenio_id_acomodacao` (`id_acomodacao`),
  ADD KEY `fk_tb_paciente_convenio_id_convenio` (`id_convenio`),
  ADD KEY `fk_tb_paciente_convenio_id_paciente` (`id_paciente`);

--
-- Índices de tabela `tb_paciente_homecare`
--
ALTER TABLE `tb_paciente_homecare`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Índices de tabela `tb_paciente_nota`
--
ALTER TABLE `tb_paciente_nota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_paciente_nota` (`id_paciente`),
  ADD KEY `fk_tb_paciente_nota_id_severidade` (`id_severidade`);

--
-- Índices de tabela `tb_paciente_programa`
--
ALTER TABLE `tb_paciente_programa`
  ADD PRIMARY KEY (`id_paciente`,`id_programa`),
  ADD KEY `fk_tb_paciente_programa_id_programa` (`id_programa`);

--
-- Índices de tabela `tb_paciente_tarefas`
--
ALTER TABLE `tb_paciente_tarefas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Índices de tabela `tb_paciente_tarefas_anotacoes`
--
ALTER TABLE `tb_paciente_tarefas_anotacoes`
  ADD PRIMARY KEY (`id`);

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
-- Índices de tabela `tb_procedimento`
--
ALTER TABLE `tb_procedimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_exame_id_categoria` (`id_categoria`);

--
-- Índices de tabela `tb_procedimento_categoria`
--
ALTER TABLE `tb_procedimento_categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `titulo` (`titulo`);

--
-- Índices de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_produto_distribuidor_id_distribuidor` (`id_distribuidor`);

--
-- Índices de tabela `tb_produto_categoria`
--
ALTER TABLE `tb_produto_categoria`
  ADD PRIMARY KEY (`id_produto`,`id_categoria`),
  ADD UNIQUE KEY `id_categoria_UNIQUE` (`id_categoria`),
  ADD UNIQUE KEY `id_produto_UNIQUE` (`id_produto`),
  ADD KEY `fk_tb_produto_categoria_tb_produto1_idx` (`id_produto`,`id_categoria`);

--
-- Índices de tabela `tb_produto_descricao`
--
ALTER TABLE `tb_produto_descricao`
  ADD PRIMARY KEY (`id_idioma`,`id_produto`),
  ADD KEY `fk_tb_produto_descricao_tb_produto1_idx` (`id_produto`),
  ADD KEY `fk_tb_produto_descricao_tb_sys_idioma1_idx` (`id_idioma`);

--
-- Índices de tabela `tb_produto_imagem`
--
ALTER TABLE `tb_produto_imagem`
  ADD PRIMARY KEY (`id_produto`,`id_midia`),
  ADD UNIQUE KEY `id_produto_UNIQUE` (`id_produto`),
  ADD UNIQUE KEY `id_midia_UNIQUE` (`id_midia`),
  ADD KEY `fk_tb_produto_imagem_tb_produto1_idx` (`id_produto`,`id_midia`);

--
-- Índices de tabela `tb_profissional`
--
ALTER TABLE `tb_profissional`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `tb_programas`
--
ALTER TABLE `tb_programas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_programas_responsavel`
--
ALTER TABLE `tb_programas_responsavel`
  ADD UNIQUE KEY `id_programa_id_responsavel` (`id_programa`,`id_profissional`);

--
-- Índices de tabela `tb_programas_tarefas`
--
ALTER TABLE `tb_programas_tarefas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_programas_tarefas` (`id_programa`);

--
-- Índices de tabela `tb_prontuario`
--
ALTER TABLE `tb_prontuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD UNIQUE KEY `id_paciente` (`id_paciente`);

--
-- Índices de tabela `tb_prontuario_registro`
--
ALTER TABLE `tb_prontuario_registro`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_servicos`
--
ALTER TABLE `tb_servicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descricao` (`descricao`),
  ADD KEY `fk_tb_servicos_id_parent` (`id_parent`);

--
-- Índices de tabela `tb_severidade_nota`
--
ALTER TABLE `tb_severidade_nota`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_acomodacao`
--
ALTER TABLE `tb_acomodacao`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_agenda`
--
ALTER TABLE `tb_agenda`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_atendimento`
--
ALTER TABLE `tb_atendimento`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_atendimento_notas`
--
ALTER TABLE `tb_atendimento_notas`
  MODIFY `id` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_atendimento_prioridade`
--
ALTER TABLE `tb_atendimento_prioridade`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_atendimento_registro`
--
ALTER TABLE `tb_atendimento_registro`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_atendimento_tipo`
--
ALTER TABLE `tb_atendimento_tipo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_banner`
--
ALTER TABLE `tb_banner`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Numero sequencial';

--
-- AUTO_INCREMENT de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_comentario`
--
ALTER TABLE `tb_comentario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_convenio`
--
ALTER TABLE `tb_convenio`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_convenio_planos`
--
ALTER TABLE `tb_convenio_planos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_convenio_planos_servicos`
--
ALTER TABLE `tb_convenio_planos_servicos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_departamento`
--
ALTER TABLE `tb_departamento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_departamento_empresa`
--
ALTER TABLE `tb_departamento_empresa`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Chave primária da tabela.';

--
-- AUTO_INCREMENT de tabela `tb_especialidade`
--
ALTER TABLE `tb_especialidade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_estado_civil`
--
ALTER TABLE `tb_estado_civil`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_etnia`
--
ALTER TABLE `tb_etnia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_file`
--
ALTER TABLE `tb_file`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_file_chunk`
--
ALTER TABLE `tb_file_chunk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_funcao`
--
ALTER TABLE `tb_funcao`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de tabela `tb_medico_agenda`
--
ALTER TABLE `tb_medico_agenda`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_medico_clinica`
--
ALTER TABLE `tb_medico_clinica`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_midia`
--
ALTER TABLE `tb_midia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_paciente`
--
ALTER TABLE `tb_paciente`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_paciente_convenio`
--
ALTER TABLE `tb_paciente_convenio`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_paciente_nota`
--
ALTER TABLE `tb_paciente_nota`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_paciente_tarefas`
--
ALTER TABLE `tb_paciente_tarefas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_paciente_tarefas_anotacoes`
--
ALTER TABLE `tb_paciente_tarefas_anotacoes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_post`
--
ALTER TABLE `tb_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_procedimento`
--
ALTER TABLE `tb_procedimento`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_procedimento_categoria`
--
ALTER TABLE `tb_procedimento_categoria`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_profissional`
--
ALTER TABLE `tb_profissional`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_programas`
--
ALTER TABLE `tb_programas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_programas_tarefas`
--
ALTER TABLE `tb_programas_tarefas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_prontuario`
--
ALTER TABLE `tb_prontuario`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_prontuario_registro`
--
ALTER TABLE `tb_prontuario_registro`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_servicos`
--
ALTER TABLE `tb_servicos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_severidade_nota`
--
ALTER TABLE `tb_severidade_nota`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_agenda`
--
ALTER TABLE `tb_agenda`
  ADD CONSTRAINT `fk_tb_agenda_id_medico` FOREIGN KEY (`id_medico`) REFERENCES `tb_medico` (`id_funcionario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_atendimento`
--
ALTER TABLE `tb_atendimento`
  ADD CONSTRAINT `fk_tb_agendamento_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categoria` (`id`),
  ADD CONSTRAINT `fk_tb_agendamento_id_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `tb_paciente` (`id`),
  ADD CONSTRAINT `fk_tb_agendamento_id_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tb_atendimento_tipo` (`id`),
  ADD CONSTRAINT `fk_tb_atendimento_id_clinica` FOREIGN KEY (`id_clinica`) REFERENCES `tb_medico_clinica` (`id_empresa`),
  ADD CONSTRAINT `fk_tb_atendimento_id_convenio` FOREIGN KEY (`id_convenio`) REFERENCES `tb_convenio` (`id`),
  ADD CONSTRAINT `fk_tb_atendimento_id_medico` FOREIGN KEY (`id_medico`) REFERENCES `tb_medico_clinica` (`id_medico`);

--
-- Restrições para tabelas `tb_atendimento_notas`
--
ALTER TABLE `tb_atendimento_notas`
  ADD CONSTRAINT `fk_tb_atendimento_id_atendimento` FOREIGN KEY (`id_atendimento`) REFERENCES `tb_atendimento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_atendimento_id_severidade` FOREIGN KEY (`id_severidade`) REFERENCES `tb_severidade_nota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_atendimento_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `medicus_sistema`.`tb_acl_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_atendimento_registro`
--
ALTER TABLE `tb_atendimento_registro`
  ADD CONSTRAINT `fk_tb_atendimento_registro_id_atendimento` FOREIGN KEY (`id_atendimento`) REFERENCES `tb_atendimento` (`id`),
  ADD CONSTRAINT `fk_tb_atendimento_registro_id_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `tb_funcionario` (`id`),
  ADD CONSTRAINT `fk_tb_atendimento_registro_id_parent` FOREIGN KEY (`id_parent`) REFERENCES `tb_atendimento_registro` (`id`),
  ADD CONSTRAINT `fk_tb_atendimento_registro_id_prioridade` FOREIGN KEY (`id_prioridade`) REFERENCES `tb_atendimento_prioridade` (`id`),
  ADD CONSTRAINT `fk_tb_atendimento_registro_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `medicus_sistema`.`tb_acl_usuario` (`id`);

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
-- Restrições para tabelas `tb_cliente_email`
--
ALTER TABLE `tb_cliente_email`
  ADD CONSTRAINT `tb_cliente_email_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_cliente_telefone`
--
ALTER TABLE `tb_cliente_telefone`
  ADD CONSTRAINT `tb_cliente_telefone_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_convenio`
--
ALTER TABLE `tb_convenio`
  ADD CONSTRAINT `fk_tb_convenio_id_parent` FOREIGN KEY (`id_parent`) REFERENCES `tb_convenio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_convenio_planos`
--
ALTER TABLE `tb_convenio_planos`
  ADD CONSTRAINT `fk_tb_convenio_planos_id_convenio` FOREIGN KEY (`id_convenio`) REFERENCES `tb_convenio` (`id`);

--
-- Restrições para tabelas `tb_convenio_planos_servicos`
--
ALTER TABLE `tb_convenio_planos_servicos`
  ADD CONSTRAINT `fk_tb_convenio_planos_servicos_id_plano` FOREIGN KEY (`id_plano`) REFERENCES `tb_convenio_planos` (`id`);

--
-- Restrições para tabelas `tb_departamento_empresa`
--
ALTER TABLE `tb_departamento_empresa`
  ADD CONSTRAINT `fk_tb_departamento_id_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `tb_departamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_departamento_id_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `tb_empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Restrições para tabelas `tb_medico`
--
ALTER TABLE `tb_medico`
  ADD CONSTRAINT `fk_tb_medico_id_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `tb_funcionario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_medico_agenda`
--
ALTER TABLE `tb_medico_agenda`
  ADD CONSTRAINT `fk_tb_medico_agenda_id_medico_clinica` FOREIGN KEY (`id_medico_clinica`) REFERENCES `tb_medico_clinica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_medico_agenda_horario`
--
ALTER TABLE `tb_medico_agenda_horario`
  ADD CONSTRAINT `fk_tb_medico_agenda_horario_id_agenda` FOREIGN KEY (`id_agenda`) REFERENCES `tb_medico_agenda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_medico_clinica`
--
ALTER TABLE `tb_medico_clinica`
  ADD CONSTRAINT `fk_tb_medico_clinica_id_empresa1` FOREIGN KEY (`id_empresa`) REFERENCES `tb_empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_medico_clinica_id_medico` FOREIGN KEY (`id_medico`) REFERENCES `tb_medico` (`id_funcionario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_medico_especialidade`
--
ALTER TABLE `tb_medico_especialidade`
  ADD CONSTRAINT `fk_tb_medico_especialidade_id_especialidade` FOREIGN KEY (`id_especialidade`) REFERENCES `tb_especialidade` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_medico_especialidade_id_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `tb_medico` (`id_funcionario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_midia_descricao`
--
ALTER TABLE `tb_midia_descricao`
  ADD CONSTRAINT `fk_tb_midia_descricao_tb_midia1` FOREIGN KEY (`id_midia`) REFERENCES `tb_midia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_midia_descricao_tb_sys_idioma1` FOREIGN KEY (`id_idioma`) REFERENCES `medicus_sistema`.`tb_sys_idioma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_paciente`
--
ALTER TABLE `tb_paciente`
  ADD CONSTRAINT `fk_tb_paciente_id_acomodacao` FOREIGN KEY (`id_acomodacao`) REFERENCES `tb_acomodacao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_paciente_id_convenio` FOREIGN KEY (`id_convenio`) REFERENCES `tb_convenio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_paciente_id_estado_civil` FOREIGN KEY (`id_estado_civil`) REFERENCES `tb_estado_civil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_paciente_id_etnia` FOREIGN KEY (`id_etnia`) REFERENCES `tb_etnia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_paciente_id_tipo_convenio` FOREIGN KEY (`id_tipo_convenio`) REFERENCES `tb_convenio_planos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_paciente_convenio`
--
ALTER TABLE `tb_paciente_convenio`
  ADD CONSTRAINT `fk_tb_paciente_convenio_id_acomodacao` FOREIGN KEY (`id_acomodacao`) REFERENCES `tb_acomodacao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_paciente_convenio_id_convenio` FOREIGN KEY (`id_convenio`) REFERENCES `tb_convenio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_paciente_convenio_id_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `tb_paciente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_paciente_homecare`
--
ALTER TABLE `tb_paciente_homecare`
  ADD CONSTRAINT `fk_tb_paciente_homecare_id_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `tb_paciente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_paciente_nota`
--
ALTER TABLE `tb_paciente_nota`
  ADD CONSTRAINT `fk_tb_paciente_nota` FOREIGN KEY (`id_paciente`) REFERENCES `tb_paciente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_paciente_nota_id_severidade` FOREIGN KEY (`id_severidade`) REFERENCES `tb_severidade_nota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_paciente_programa`
--
ALTER TABLE `tb_paciente_programa`
  ADD CONSTRAINT `fk_tb_paciente_programa_id_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `tb_paciente_homecare` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_paciente_programa_id_programa` FOREIGN KEY (`id_programa`) REFERENCES `tb_programas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Restrições para tabelas `tb_procedimento`
--
ALTER TABLE `tb_procedimento`
  ADD CONSTRAINT `fk_tb_exame_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD CONSTRAINT `fk_tb_produto_distribuidor_id_distribuidor` FOREIGN KEY (`id_distribuidor`) REFERENCES `tb_distribuidor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_produto_categoria`
--
ALTER TABLE `tb_produto_categoria`
  ADD CONSTRAINT `fk_tb_produto_categoria_tb_categoria1` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_produto_categoria_tb_produto1` FOREIGN KEY (`id_produto`) REFERENCES `tb_produto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_produto_descricao`
--
ALTER TABLE `tb_produto_descricao`
  ADD CONSTRAINT `fk_tb_produto_descricao_tb_produto1` FOREIGN KEY (`id_produto`) REFERENCES `tb_produto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_produto_descricao_tb_sys_idioma1` FOREIGN KEY (`id_idioma`) REFERENCES `medicus_sistema`.`tb_sys_idioma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_produto_imagem`
--
ALTER TABLE `tb_produto_imagem`
  ADD CONSTRAINT `fk_tb_produto_imagem_tb_midia1` FOREIGN KEY (`id_midia`) REFERENCES `tb_midia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_produto_imagem_tb_produto1` FOREIGN KEY (`id_produto`) REFERENCES `tb_produto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_programas_tarefas`
--
ALTER TABLE `tb_programas_tarefas`
  ADD CONSTRAINT `fk_tb_programas_tarefas` FOREIGN KEY (`id_programa`) REFERENCES `tb_programas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_prontuario`
--
ALTER TABLE `tb_prontuario`
  ADD CONSTRAINT `fk_tb_prontuario_id_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `tb_paciente` (`id`);

--
-- Restrições para tabelas `tb_servicos`
--
ALTER TABLE `tb_servicos`
  ADD CONSTRAINT `fk_tb_servicos_id_parent` FOREIGN KEY (`id_parent`) REFERENCES `tb_servicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
