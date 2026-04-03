-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/04/2026 às 00:24
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

--
-- Despejando dados para a tabela `alimentos`
--

INSERT INTO `alimentos` (`id`, `nome`, `calorias`, `proteinas`, `carboidratos`, `gorduras`) VALUES
(1, 'Ovo', 155, 13.00, 1.10, 11.00),
(2, 'Peito de frango', 165, 31.00, 0.00, 3.60),
(3, 'Arroz branco', 130, 2.70, 28.00, 0.30),
(4, 'Arroz integral', 112, 2.60, 23.00, 0.90),
(5, 'Aveia', 389, 17.00, 66.00, 7.00),
(6, 'Banana', 89, 1.10, 23.00, 0.30),
(7, 'Maçã', 52, 0.30, 14.00, 0.20),
(8, 'Leite integral', 61, 3.20, 5.00, 3.30),
(9, 'Leite desnatado', 34, 3.40, 5.00, 0.10),
(10, 'Queijo muçarela', 280, 22.00, 3.00, 22.00),
(11, 'Queijo branco', 264, 18.00, 3.00, 21.00),
(12, 'Iogurte natural', 59, 3.50, 5.00, 3.30),
(13, 'Pão integral', 247, 13.00, 41.00, 4.20),
(14, 'Pão branco', 265, 9.00, 49.00, 3.20),
(15, 'Batata inglesa', 77, 2.00, 17.00, 0.10),
(16, 'Batata doce', 86, 1.60, 20.00, 0.10),
(17, 'Macarrão', 131, 5.00, 25.00, 1.10),
(18, 'Macarrão integral', 124, 5.00, 26.00, 1.30),
(19, 'Feijão carioca', 76, 4.80, 14.00, 0.50),
(20, 'Feijão preto', 77, 4.50, 14.00, 0.50),
(21, 'Carne bovina', 250, 26.00, 0.00, 15.00),
(22, 'Carne moída', 250, 26.00, 0.00, 15.00),
(23, 'Atum', 132, 28.00, 0.00, 1.00),
(24, 'Sardinha', 208, 25.00, 0.00, 11.00),
(25, 'Alface', 15, 1.40, 2.90, 0.20),
(26, 'Tomate', 18, 0.90, 3.90, 0.20),
(27, 'Cenoura', 41, 0.90, 10.00, 0.20),
(28, 'Brócolis', 34, 2.80, 7.00, 0.40),
(29, 'Abobrinha', 17, 1.20, 3.10, 0.30),
(30, 'Pepino', 16, 0.70, 3.60, 0.10),
(31, 'Milho', 96, 3.40, 21.00, 1.50),
(32, 'Ervilha', 81, 5.00, 14.00, 0.40),
(33, 'Grão de bico', 164, 9.00, 27.00, 2.60),
(34, 'Lentilha', 116, 9.00, 20.00, 0.40),
(35, 'Castanha de caju', 553, 18.00, 30.00, 44.00),
(36, 'Amendoim', 567, 26.00, 16.00, 49.00),
(37, 'Pasta de amendoim', 588, 25.00, 20.00, 50.00),
(38, 'Mel', 304, 0.30, 82.00, 0.00),
(39, 'Açúcar', 387, 0.00, 100.00, 0.00),
(40, 'Chocolate meio amargo', 546, 4.90, 61.00, 31.00),
(41, 'Ovo', 155, 13.00, 1.10, 11.00),
(42, 'Peito de frango', 165, 31.00, 0.00, 3.60),
(43, 'Arroz branco', 130, 2.70, 28.00, 0.30),
(44, 'Arroz integral', 112, 2.60, 23.00, 0.90),
(45, 'Aveia', 389, 17.00, 66.00, 7.00),
(46, 'Banana', 89, 1.10, 23.00, 0.30),
(47, 'Maçã', 52, 0.30, 14.00, 0.20),
(48, 'Leite integral', 61, 3.20, 5.00, 3.30),
(49, 'Leite desnatado', 34, 3.40, 5.00, 0.10),
(50, 'Queijo muçarela', 280, 22.00, 3.00, 22.00),
(51, 'Queijo branco', 264, 18.00, 3.00, 21.00),
(52, 'Iogurte natural', 59, 3.50, 5.00, 3.30),
(53, 'Pão integral', 247, 13.00, 41.00, 4.20),
(54, 'Pão branco', 265, 9.00, 49.00, 3.20),
(55, 'Batata inglesa', 77, 2.00, 17.00, 0.10),
(56, 'Batata doce', 86, 1.60, 20.00, 0.10),
(57, 'Macarrão', 131, 5.00, 25.00, 1.10),
(58, 'Macarrão integral', 124, 5.00, 26.00, 1.30),
(59, 'Feijão carioca', 76, 4.80, 14.00, 0.50),
(60, 'Feijão preto', 77, 4.50, 14.00, 0.50),
(61, 'Carne bovina', 250, 26.00, 0.00, 15.00),
(62, 'Carne moída', 250, 26.00, 0.00, 15.00),
(63, 'Atum', 132, 28.00, 0.00, 1.00),
(64, 'Sardinha', 208, 25.00, 0.00, 11.00),
(65, 'Alface', 15, 1.40, 2.90, 0.20),
(66, 'Tomate', 18, 0.90, 3.90, 0.20),
(67, 'Cenoura', 41, 0.90, 10.00, 0.20),
(68, 'Brócolis', 34, 2.80, 7.00, 0.40),
(69, 'Abobrinha', 17, 1.20, 3.10, 0.30),
(70, 'Pepino', 16, 0.70, 3.60, 0.10),
(71, 'Milho', 96, 3.40, 21.00, 1.50),
(72, 'Ervilha', 81, 5.00, 14.00, 0.40),
(73, 'Grão de bico', 164, 9.00, 27.00, 2.60),
(74, 'Lentilha', 116, 9.00, 20.00, 0.40),
(75, 'Castanha de caju', 553, 18.00, 30.00, 44.00),
(76, 'Amendoim', 567, 26.00, 16.00, 49.00),
(77, 'Pasta de amendoim', 588, 25.00, 20.00, 50.00),
(78, 'Mel', 304, 0.30, 82.00, 0.00),
(79, 'Açúcar', 387, 0.00, 100.00, 0.00),
(80, 'Chocolate meio amargo', 546, 4.90, 61.00, 31.00);

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
(6, 3, 0, '2026-03-26'),
(7, 3, 7, '2026-03-30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `metas_usuario`
--

CREATE TABLE `metas_usuario` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `meta_peso` decimal(5,2) DEFAULT NULL,
  `meta_calorias` int(11) DEFAULT NULL,
  `nivel_atividade` int(11) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `metas_usuario`
--

INSERT INTO `metas_usuario` (`id`, `usuario_id`, `meta_peso`, `meta_calorias`, `nivel_atividade`, `ativo`, `criado_em`, `atualizado_em`) VALUES
(1, 3, 74.00, 1476, 2, 1, '2026-03-26 22:58:44', '2026-03-31 22:16:37');

-- --------------------------------------------------------

--
-- Estrutura para tabela `receitas`
--

CREATE TABLE `receitas` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `categoria` enum('cafe','almoco','jantar','lanche') DEFAULT NULL,
  `tempo_preparo` int(11) DEFAULT NULL,
  `porcoes` int(11) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `dificuldade` enum('facil','medio','dificil') DEFAULT 'facil'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `receitas`
--

INSERT INTO `receitas` (`id`, `nome`, `descricao`, `categoria`, `tempo_preparo`, `porcoes`, `imagem`, `criado_em`, `dificuldade`) VALUES
(41, 'Omelete Fit', 'Omelete com ovos e queijo', 'cafe', 10, 1, 'omelete_fit.png', '2026-03-12 00:44:50', 'facil'),
(42, 'Panqueca de Banana', 'Panqueca de banana com aveia', 'cafe', 15, 2, 'panqueca_banana.png', '2026-03-12 00:44:50', 'facil'),
(43, 'Vitamina de Banana', 'Banana batida com leite e aveia', 'cafe', 5, 1, 'vitamina_banana.png', '2026-03-12 00:44:50', 'facil'),
(44, 'Tapioca com Frango', 'Tapioca recheada com frango', 'cafe', 10, 1, 'tapioca_frango.png', '2026-03-12 00:44:50', 'medio'),
(45, 'Iogurte com Aveia', 'Iogurte natural com aveia', 'cafe', 3, 1, 'iogurte_aveia.png', '2026-03-12 00:44:50', 'facil'),
(46, 'Arroz com Frango', 'Arroz com peito de frango grelhado', 'almoco', 30, 2, 'arroz_frango.png', '2026-03-12 00:44:50', 'medio'),
(47, 'Frango com Batata Doce', 'Frango grelhado com batata doce', 'almoco', 35, 2, 'frango_batata_doce.png', '2026-03-12 00:44:50', 'medio'),
(48, 'Macarrão com Frango', 'Macarrão com frango desfiado', 'almoco', 25, 2, 'macarrao_frango.png', '2026-03-12 00:44:50', 'medio'),
(49, 'Salada de Atum', 'Salada com atum', 'almoco', 10, 1, 'salada_atum.png', '2026-03-12 00:44:50', 'facil'),
(50, 'Arroz Feijão Carne', 'Prato tradicional brasileiro', 'almoco', 40, 3, 'arroz_feijao_carne.png', '2026-03-12 00:44:50', 'medio'),
(51, 'Frango Grelhado', 'Frango grelhado com salada', 'jantar', 20, 1, 'frango_grelhado.png', '2026-03-12 00:44:50', 'facil'),
(52, 'Omelete de Legumes', 'Omelete com legumes', 'jantar', 10, 1, 'omelete_legumes.png', '2026-03-12 00:44:50', 'facil'),
(53, 'Sopa de Legumes', 'Sopa leve de legumes', 'jantar', 30, 2, 'sopa_legumes.png', '2026-03-12 00:44:50', 'medio'),
(54, 'Wrap de Frango', 'Wrap integral com frango', 'jantar', 15, 1, 'wrap_frango.png', '2026-03-12 00:44:50', 'medio'),
(55, 'Arroz Integral com Legumes', 'Arroz integral com legumes', 'jantar', 25, 2, 'arroz_integral_legumes.png', '2026-03-12 00:44:50', 'medio'),
(56, 'Barra de Proteína', 'Barra caseira de aveia', 'lanche', 20, 4, 'barra_proteina.png', '2026-03-12 00:44:50', 'medio'),
(57, 'Sanduíche Natural', 'Pão integral com frango', 'lanche', 10, 1, 'sanduiche_natural.png', '2026-03-12 00:44:50', 'facil'),
(58, 'Banana com Pasta', 'Banana com pasta de amendoim', 'lanche', 3, 1, 'banana_pasta_amendoim.png', '2026-03-12 00:44:50', 'facil'),
(59, 'Mix de Castanhas', 'Castanhas variadas', 'lanche', 1, 1, 'mix_castanhas.png', '2026-03-12 00:44:50', 'facil'),
(60, 'Iogurte Proteico', 'Iogurte com whey', 'lanche', 2, 1, 'iogurte_proteico.png', '2026-03-12 00:44:50', 'facil');

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

--
-- Despejando dados para a tabela `receita_ingredientes`
--

INSERT INTO `receita_ingredientes` (`id`, `receita_id`, `alimento_id`, `quantidade`, `unidade_id`) VALUES
(91, 41, 1, 2.00, 3),
(92, 41, 10, 30.00, 1),
(93, 42, 5, 1.00, 3),
(94, 42, 4, 40.00, 1),
(95, 42, 1, 1.00, 3),
(96, 43, 5, 1.00, 3),
(97, 43, 8, 200.00, 2),
(98, 43, 4, 20.00, 1),
(99, 44, 2, 120.00, 1),
(100, 45, 12, 150.00, 1),
(101, 45, 4, 30.00, 1),
(102, 46, 3, 150.00, 1),
(103, 46, 2, 150.00, 1),
(104, 47, 2, 150.00, 1),
(105, 47, 16, 200.00, 1),
(106, 48, 17, 120.00, 1),
(107, 48, 2, 120.00, 1),
(108, 49, 23, 120.00, 1),
(109, 49, 25, 40.00, 1),
(110, 49, 26, 40.00, 1),
(111, 50, 3, 120.00, 1),
(112, 50, 19, 100.00, 1),
(113, 50, 21, 120.00, 1),
(114, 51, 2, 200.00, 1),
(115, 52, 1, 2.00, 3),
(116, 52, 26, 50.00, 1),
(117, 52, 27, 50.00, 1),
(118, 53, 27, 80.00, 1),
(119, 53, 28, 80.00, 1),
(120, 53, 29, 80.00, 1),
(121, 54, 2, 120.00, 1),
(122, 54, 13, 1.00, 3),
(123, 55, 4, 120.00, 1),
(124, 55, 28, 60.00, 1),
(125, 55, 27, 60.00, 1),
(126, 56, 4, 60.00, 1),
(127, 56, 37, 30.00, 1),
(128, 57, 13, 2.00, 3),
(129, 57, 2, 100.00, 1),
(130, 57, 25, 20.00, 1),
(131, 58, 5, 1.00, 3),
(132, 58, 37, 20.00, 1),
(133, 59, 35, 30.00, 1),
(134, 60, 12, 150.00, 1),
(135, 60, 37, 20.00, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `refeicoes_usuario`
--

CREATE TABLE `refeicoes_usuario` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `receita_id` int(11) DEFAULT NULL,
  `tipo_refeicao` enum('cafe','almoco','jantar','lanche') DEFAULT NULL,
  `data_refeicao` date DEFAULT NULL,
  `alimento_id` int(11) DEFAULT NULL
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
(3, 'Admin', 'admin@nutritech.com', '$2y$10$Bj1ovhVfrGe7MSCERBe2hutLzdgG9aVxNQr8pgDWMZymEohUakqxa', 22, 95.00, 1.70, NULL, '2026-03-26 22:58:44');

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
-- Índices de tabela `metas_usuario`
--
ALTER TABLE `metas_usuario`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de tabela `controle_agua`
--
ALTER TABLE `controle_agua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `metas_usuario`
--
ALTER TABLE `metas_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `receitas`
--
ALTER TABLE `receitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `receita_ingredientes`
--
ALTER TABLE `receita_ingredientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de tabela `refeicoes_usuario`
--
ALTER TABLE `refeicoes_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `controle_agua`
--
ALTER TABLE `controle_agua`
  ADD CONSTRAINT `controle_agua_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `metas_usuario`
--
ALTER TABLE `metas_usuario`
  ADD CONSTRAINT `metas_usuario_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

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
