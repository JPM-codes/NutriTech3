-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/03/2026 às 01:18
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `nutritech`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alimentos`
--

CREATE TABLE `alimentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `calorias` int(11) DEFAULT NULL,
  `proteinas` decimal(6,2) DEFAULT NULL,
  `carboidratos` decimal(6,2) DEFAULT NULL,
  `gorduras` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `controle_agua`
--

CREATE TABLE `controle_agua` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `quantidade_ml` int(11) DEFAULT NULL,
  `data_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `controle_agua`
--

INSERT INTO `controle_agua` (`id`, `usuario_id`, `quantidade_ml`, `data_registro`) VALUES
(1, 1, 7, '2026-03-11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `progresso_usuario`
--

CREATE TABLE `progresso_usuario` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `gordura_corporal` decimal(5,2) DEFAULT NULL,
  `data_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `receitas`
--

CREATE TABLE `receitas` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `tempo_preparo` int(11) DEFAULT NULL,
  `porcoes` int(11) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `receita_ingredientes`
--

CREATE TABLE `receita_ingredientes` (
  `id` int(11) NOT NULL,
  `receita_id` int(11) NOT NULL,
  `alimento_id` int(11) NOT NULL,
  `quantidade` decimal(8,2) DEFAULT NULL,
  `unidade_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `refeicoes_usuario`
--

CREATE TABLE `refeicoes_usuario` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `receita_id` int(11) NOT NULL,
  `tipo_refeicao` enum('cafe','almoco','jantar','lanche') DEFAULT NULL,
  `data_refeicao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `unidades`
--

CREATE TABLE `unidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `unidades`
--

INSERT INTO `unidades` (`id`, `nome`) VALUES
(1, 'gramas'),
(2, 'ml'),
(3, 'unidade'),
(4, 'colher'),
(5, 'xícara');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `idade` int(11) DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `altura` decimal(5,2) DEFAULT NULL,
  `objetivo` enum('emagrecer','manter','ganhar_massa') DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `idade`, `peso`, `altura`, `objetivo`, `criado_em`) VALUES
(1, 'Admin', 'admin@nutritech.com', '$2y$10$91Ty4a5GmqA4ekswO67L6u5zzajrny0Nyb8mqpO2dryQyZJ3eNOVa', 19, 75.00, 1.70, NULL, '2026-03-11 04:53:57');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alimentos`
--
ALTER TABLE `alimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `controle_agua`
--
ALTER TABLE `controle_agua`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `progresso_usuario`
--
ALTER TABLE `progresso_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `receitas`
--
ALTER TABLE `receitas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `receita_ingredientes`
--
ALTER TABLE `receita_ingredientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receita_id` (`receita_id`),
  ADD KEY `alimento_id` (`alimento_id`),
  ADD KEY `unidade_id` (`unidade_id`);

--
-- Índices de tabela `refeicoes_usuario`
--
ALTER TABLE `refeicoes_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `receita_id` (`receita_id`);

--
-- Índices de tabela `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alimentos`
--
ALTER TABLE `alimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `controle_agua`
--
ALTER TABLE `controle_agua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `progresso_usuario`
--
ALTER TABLE `progresso_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `receitas`
--
ALTER TABLE `receitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `receita_ingredientes`
--
ALTER TABLE `receita_ingredientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `refeicoes_usuario`
--
ALTER TABLE `refeicoes_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `controle_agua`
--
ALTER TABLE `controle_agua`
  ADD CONSTRAINT `controle_agua_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `progresso_usuario`
--
ALTER TABLE `progresso_usuario`
  ADD CONSTRAINT `progresso_usuario_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `receita_ingredientes`
--
ALTER TABLE `receita_ingredientes`
  ADD CONSTRAINT `receita_ingredientes_ibfk_1` FOREIGN KEY (`receita_id`) REFERENCES `receitas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `receita_ingredientes_ibfk_2` FOREIGN KEY (`alimento_id`) REFERENCES `alimentos` (`id`),
  ADD CONSTRAINT `receita_ingredientes_ibfk_3` FOREIGN KEY (`unidade_id`) REFERENCES `unidades` (`id`);

--
-- Restrições para tabelas `refeicoes_usuario`
--
ALTER TABLE `refeicoes_usuario`
  ADD CONSTRAINT `refeicoes_usuario_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `refeicoes_usuario_ibfk_2` FOREIGN KEY (`receita_id`) REFERENCES `receitas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
