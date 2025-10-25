-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 25, 2025 at 05:08 PM
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
-- Database: `simplepage`
--

-- --------------------------------------------------------

--
-- Table structure for table `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` int(11) NOT NULL,
  `site_titulo` varchar(100) NOT NULL,
  `site_descricao` text DEFAULT NULL,
  `email_contato` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `site_titulo`, `site_descricao`, `email_contato`, `created_at`, `updated_at`) VALUES
(1, 'Simple Page', 'Site institucional moderno e elegante', 'contato@simplepage.com', '2025-05-06 13:30:51', '2025-05-06 13:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `contatos`
--

CREATE TABLE `contatos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mensagem` text NOT NULL,
  `status` enum('novo','lido','respondido','arquivado') DEFAULT 'novo',
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_atualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contatos`
--

INSERT INTO `contatos` (`id`, `nome`, `email`, `mensagem`, `status`, `data_criacao`, `data_atualizacao`) VALUES
(1, 'João Silva', 'joao@email.com', 'Gostaria de um orçamento para um site institucional.', 'lido', '2025-05-06 14:25:50', '2025-10-25 18:46:57'),
(2, 'John Doe', 'johndoe@email.com', 'Testando mensagem', 'lido', '2025-10-25 17:42:22', '2025-10-25 19:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `subtitulo` varchar(200) DEFAULT NULL,
  `conteudo` text NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `status` enum('ativo','inativo') DEFAULT 'ativo',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`id`, `titulo`, `subtitulo`, `conteudo`, `imagem`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bem-vindo à Simple Page', 'Uma página moderna e elegante', '<p>Conte&uacute;do inicial da p&aacute;gina home.</p>', 'foto.jpg', 'ativo', '2025-05-06 13:30:51', '2025-10-24 00:56:07'),
(2, 'Bem-vindo à Simple Page', 'Um site institucional moderno e elegante', 'Somos uma empresa comprometida com a excelência e inovação. Nosso objetivo é entregar soluções de qualidade que atendam às necessidades dos nossos clientes.', 'foto.jpg', 'ativo', '2025-05-06 14:19:41', '2025-10-24 01:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `log_atividades`
--

CREATE TABLE `log_atividades` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `acao` varchar(100) NOT NULL,
  `detalhes` text DEFAULT NULL,
  `data_hora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mensagem` text NOT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `lida` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `icone` varchar(50) DEFAULT NULL,
  `ordem` int(11) DEFAULT 0,
  `status` enum('ativo','inativo') DEFAULT 'ativo',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `servicos`
--

INSERT INTO `servicos` (`id`, `titulo`, `descricao`, `icone`, `ordem`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Desenvolvimento Web', 'Criação de sites e sistemas web modernos e responsivos', 'fa-laptop-code', 1, 'ativo', '2025-05-06 14:25:41', '2025-10-25 18:23:17'),
(2, 'Design Gráfico', 'Criação de identidade visual e materiais gráficos', 'fa-palette', 2, 'ativo', '2025-05-06 14:25:41', '2025-05-06 14:25:41'),
(3, 'Marketing Digital', 'Estratégias de marketing e presença digital para aumentar sua visibilidade online.', 'fa-bullhorn', 3, 'ativo', '2025-10-25 18:37:47', '2025-10-25 18:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `sobre`
--

CREATE TABLE `sobre` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `subtitulo` varchar(200) DEFAULT NULL,
  `conteudo` text NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `status` enum('ativo','inativo') DEFAULT 'ativo',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sobre`
--

INSERT INTO `sobre` (`id`, `titulo`, `subtitulo`, `conteudo`, `imagem`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sobre Nós', 'Conheça nossa história', '<p>Conte&uacute;do inicial da p&aacute;gina sobre.</p>', 'foto.jpg', 'ativo', '2025-05-06 13:30:51', '2025-10-24 01:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel` enum('admin','editor') DEFAULT 'editor',
  `status` enum('ativo','inativo') DEFAULT 'ativo',
  `ultimo_acesso` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `nivel`, `status`, `ultimo_acesso`, `created_at`, `updated_at`, `imagem`) VALUES
(1, 'Administrador', 'admin@simplepage.com', '$2y$10$Y2XHUOGvu.dom.z1mkZR/.ETuC.aKqsxdW4hP58Y97kZINogPYpLm', 'admin', 'ativo', '2025-05-06 13:30:57', '2025-05-06 13:30:51', '2025-10-25 19:40:10', 'foto.jpg'),
(2, 'Usuario teste', 'teste@email.com', '$2y$10$2WxLSmtpsdDVa/dB2lIvPu2NyAHn2BsXzIBcgFI811FNcY.2l9goG', 'editor', 'ativo', NULL, '2025-10-25 19:06:55', '2025-10-25 19:09:19', 'foto.jpg'),
(3, 'John Doe', 'john@email.com', '$2y$10$WP.Nx/avC2j3fWCwuNP8XOCNeUBYlusshlNqVpglAc6NtqOfIzagC', 'editor', 'ativo', NULL, '2025-10-25 19:16:50', '2025-10-25 19:17:23', 'foto.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_atividades`
--
ALTER TABLE `log_atividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sobre`
--
ALTER TABLE `sobre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `configuracoes`
--
ALTER TABLE `configuracoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_atividades`
--
ALTER TABLE `log_atividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sobre`
--
ALTER TABLE `sobre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log_atividades`
--
ALTER TABLE `log_atividades`
  ADD CONSTRAINT `fk_log_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
