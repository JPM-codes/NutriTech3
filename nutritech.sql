-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/03/2026 às 01:39
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
-- Estrutura para tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_by`, `created_at`) VALUES
(1, 'Café da manhã', 'Receitas perfeitas para começar o dia com energia', 1, '2026-03-09 23:58:01'),
(2, 'Almoço', 'Refeições completas e nutritivas para o meio do dia', 1, '2026-03-09 23:58:01'),
(3, 'Jantar', 'Opções leves e saborosas para a noite', 1, '2026-03-09 23:58:01'),
(4, 'Lanche', 'Snacks rápidos e saudáveis para qualquer hora', 1, '2026-03-09 23:58:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `foods`
--

CREATE TABLE `foods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `calories` int(11) NOT NULL,
  `protein` decimal(6,2) DEFAULT 0.00,
  `carbs` decimal(6,2) DEFAULT 0.00,
  `fat` decimal(6,2) DEFAULT 0.00,
  `serving_size` varchar(50) DEFAULT NULL,
  `serving_weight` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `foods`
--

INSERT INTO `foods` (`id`, `name`, `calories`, `protein`, `carbs`, `fat`, `serving_size`, `serving_weight`, `created_at`) VALUES
(1, 'Arroz branco cozido', 130, 2.40, 28.00, 0.30, '100g', 100, '2026-03-10 01:27:31'),
(2, 'Feijão carioca cozido', 76, 4.80, 13.60, 0.50, '100g', 100, '2026-03-10 01:27:31'),
(3, 'Peito de frango grelhado', 165, 31.00, 0.00, 3.60, '100g', 100, '2026-03-10 01:27:31'),
(4, 'Carne bovina magra', 250, 26.00, 0.00, 15.00, '100g', 100, '2026-03-10 01:27:31'),
(5, 'Ovo cozido', 155, 13.00, 1.10, 11.00, '100g', 100, '2026-03-10 01:27:31'),
(6, 'Pão francês', 270, 9.00, 57.00, 3.20, '100g', 100, '2026-03-10 01:27:31'),
(7, 'Leite integral', 61, 3.20, 4.80, 3.30, '100g', 100, '2026-03-10 01:27:31'),
(8, 'Queijo muçarela', 280, 22.00, 3.00, 22.00, '100g', 100, '2026-03-10 01:27:31'),
(9, 'Banana', 89, 1.10, 23.00, 0.30, '100g', 100, '2026-03-10 01:27:31'),
(10, 'Maçã', 52, 0.30, 14.00, 0.20, '100g', 100, '2026-03-10 01:27:31'),
(11, 'Aveia', 389, 17.00, 66.00, 7.00, '100g', 100, '2026-03-10 01:27:31'),
(12, 'Batata cozida', 87, 1.90, 20.00, 0.10, '100g', 100, '2026-03-10 01:27:31'),
(13, 'Batata doce', 90, 2.00, 21.00, 0.10, '100g', 100, '2026-03-10 01:27:31'),
(14, 'Macarrão cozido', 131, 5.00, 25.00, 1.10, '100g', 100, '2026-03-10 01:27:31'),
(15, 'Atum em lata', 132, 28.00, 0.00, 1.00, '100g', 100, '2026-03-10 01:27:31'),
(16, 'Salmão grelhado', 208, 20.00, 0.00, 13.00, '100g', 100, '2026-03-10 01:27:31'),
(17, 'Iogurte natural', 59, 10.00, 3.60, 0.40, '100g', 100, '2026-03-10 01:27:31'),
(18, 'Amendoim', 567, 26.00, 16.00, 49.00, '100g', 100, '2026-03-10 01:27:31'),
(19, 'Castanha do pará', 659, 14.00, 12.00, 67.00, '100g', 100, '2026-03-10 01:27:31'),
(20, 'Brócolis', 34, 2.80, 7.00, 0.40, '100g', 100, '2026-03-10 01:27:31'),
(21, 'Cenoura', 41, 0.90, 10.00, 0.20, '100g', 100, '2026-03-10 01:27:31'),
(22, 'Tomate', 18, 0.90, 3.90, 0.20, '100g', 100, '2026-03-10 01:27:31'),
(23, 'Alface', 15, 1.40, 2.90, 0.20, '100g', 100, '2026-03-10 01:27:31'),
(24, 'Abacate', 160, 2.00, 9.00, 15.00, '100g', 100, '2026-03-10 01:27:31'),
(25, 'Chocolate meio amargo', 546, 4.90, 61.00, 31.00, '100g', 100, '2026-03-10 01:27:31'),
(26, 'Mel', 304, 0.30, 82.00, 0.00, '100g', 100, '2026-03-10 01:27:31'),
(27, 'Granola', 471, 10.00, 64.00, 20.00, '100g', 100, '2026-03-10 01:27:31'),
(28, 'Arroz integral', 111, 2.60, 23.00, 0.90, '100g', 100, '2026-03-10 01:27:31'),
(29, 'Lentilha cozida', 116, 9.00, 20.00, 0.40, '100g', 100, '2026-03-10 01:27:31'),
(30, 'Grão de bico cozido', 164, 9.00, 27.00, 2.60, '100g', 100, '2026-03-10 01:27:31'),
(31, 'Arroz branco cozido', 130, 2.40, 28.00, 0.30, '100g', 100, '2026-03-10 01:30:02'),
(32, 'Feijão carioca cozido', 76, 4.80, 13.60, 0.50, '100g', 100, '2026-03-10 01:30:02'),
(33, 'Peito de frango grelhado', 165, 31.00, 0.00, 3.60, '100g', 100, '2026-03-10 01:30:02'),
(34, 'Carne bovina magra', 250, 26.00, 0.00, 15.00, '100g', 100, '2026-03-10 01:30:02'),
(35, 'Ovo cozido', 155, 13.00, 1.10, 11.00, '100g', 100, '2026-03-10 01:30:02'),
(36, 'Pão francês', 270, 9.00, 57.00, 3.20, '100g', 100, '2026-03-10 01:30:02'),
(37, 'Leite integral', 61, 3.20, 4.80, 3.30, '100g', 100, '2026-03-10 01:30:02'),
(38, 'Queijo muçarela', 280, 22.00, 3.00, 22.00, '100g', 100, '2026-03-10 01:30:02'),
(39, 'Banana', 89, 1.10, 23.00, 0.30, '100g', 100, '2026-03-10 01:30:02'),
(40, 'Maçã', 52, 0.30, 14.00, 0.20, '100g', 100, '2026-03-10 01:30:02'),
(41, 'Aveia', 389, 17.00, 66.00, 7.00, '100g', 100, '2026-03-10 01:30:02'),
(42, 'Batata cozida', 87, 1.90, 20.00, 0.10, '100g', 100, '2026-03-10 01:30:02'),
(43, 'Batata doce', 90, 2.00, 21.00, 0.10, '100g', 100, '2026-03-10 01:30:02'),
(44, 'Macarrão cozido', 131, 5.00, 25.00, 1.10, '100g', 100, '2026-03-10 01:30:02'),
(45, 'Atum em lata', 132, 28.00, 0.00, 1.00, '100g', 100, '2026-03-10 01:30:02'),
(46, 'Salmão grelhado', 208, 20.00, 0.00, 13.00, '100g', 100, '2026-03-10 01:30:02'),
(47, 'Iogurte natural', 59, 10.00, 3.60, 0.40, '100g', 100, '2026-03-10 01:30:02'),
(48, 'Amendoim', 567, 26.00, 16.00, 49.00, '100g', 100, '2026-03-10 01:30:02'),
(49, 'Castanha do pará', 659, 14.00, 12.00, 67.00, '100g', 100, '2026-03-10 01:30:02'),
(50, 'Brócolis', 34, 2.80, 7.00, 0.40, '100g', 100, '2026-03-10 01:30:02'),
(51, 'Cenoura', 41, 0.90, 10.00, 0.20, '100g', 100, '2026-03-10 01:30:02'),
(52, 'Tomate', 18, 0.90, 3.90, 0.20, '100g', 100, '2026-03-10 01:30:02'),
(53, 'Alface', 15, 1.40, 2.90, 0.20, '100g', 100, '2026-03-10 01:30:02'),
(54, 'Abacate', 160, 2.00, 9.00, 15.00, '100g', 100, '2026-03-10 01:30:02'),
(55, 'Chocolate meio amargo', 546, 4.90, 61.00, 31.00, '100g', 100, '2026-03-10 01:30:02'),
(56, 'Mel', 304, 0.30, 82.00, 0.00, '100g', 100, '2026-03-10 01:30:02'),
(57, 'Granola', 471, 10.00, 64.00, 20.00, '100g', 100, '2026-03-10 01:30:02'),
(58, 'Arroz integral', 111, 2.60, 23.00, 0.90, '100g', 100, '2026-03-10 01:30:02'),
(59, 'Lentilha cozida', 116, 9.00, 20.00, 0.40, '100g', 100, '2026-03-10 01:30:02'),
(60, 'Grão de bico cozido', 164, 9.00, 27.00, 2.60, '100g', 100, '2026-03-10 01:30:02'),
(61, 'Arroz branco cozido', 130, 2.40, 28.00, 0.30, '100g', 100, '2026-03-10 01:30:16'),
(62, 'Feijão carioca cozido', 76, 4.80, 13.60, 0.50, '100g', 100, '2026-03-10 01:30:16'),
(63, 'Peito de frango grelhado', 165, 31.00, 0.00, 3.60, '100g', 100, '2026-03-10 01:30:16'),
(64, 'Carne bovina magra', 250, 26.00, 0.00, 15.00, '100g', 100, '2026-03-10 01:30:16'),
(65, 'Ovo cozido', 155, 13.00, 1.10, 11.00, '100g', 100, '2026-03-10 01:30:16'),
(66, 'Pão francês', 270, 9.00, 57.00, 3.20, '100g', 100, '2026-03-10 01:30:16'),
(67, 'Leite integral', 61, 3.20, 4.80, 3.30, '100g', 100, '2026-03-10 01:30:16'),
(68, 'Queijo muçarela', 280, 22.00, 3.00, 22.00, '100g', 100, '2026-03-10 01:30:16'),
(69, 'Banana', 89, 1.10, 23.00, 0.30, '100g', 100, '2026-03-10 01:30:16'),
(70, 'Maçã', 52, 0.30, 14.00, 0.20, '100g', 100, '2026-03-10 01:30:16'),
(71, 'Aveia', 389, 17.00, 66.00, 7.00, '100g', 100, '2026-03-10 01:30:16'),
(72, 'Batata cozida', 87, 1.90, 20.00, 0.10, '100g', 100, '2026-03-10 01:30:16'),
(73, 'Batata doce', 90, 2.00, 21.00, 0.10, '100g', 100, '2026-03-10 01:30:16'),
(74, 'Macarrão cozido', 131, 5.00, 25.00, 1.10, '100g', 100, '2026-03-10 01:30:16'),
(75, 'Atum em lata', 132, 28.00, 0.00, 1.00, '100g', 100, '2026-03-10 01:30:16'),
(76, 'Salmão grelhado', 208, 20.00, 0.00, 13.00, '100g', 100, '2026-03-10 01:30:16'),
(77, 'Iogurte natural', 59, 10.00, 3.60, 0.40, '100g', 100, '2026-03-10 01:30:16'),
(78, 'Amendoim', 567, 26.00, 16.00, 49.00, '100g', 100, '2026-03-10 01:30:16'),
(79, 'Castanha do pará', 659, 14.00, 12.00, 67.00, '100g', 100, '2026-03-10 01:30:16'),
(80, 'Brócolis', 34, 2.80, 7.00, 0.40, '100g', 100, '2026-03-10 01:30:16'),
(81, 'Cenoura', 41, 0.90, 10.00, 0.20, '100g', 100, '2026-03-10 01:30:16'),
(82, 'Tomate', 18, 0.90, 3.90, 0.20, '100g', 100, '2026-03-10 01:30:16'),
(83, 'Alface', 15, 1.40, 2.90, 0.20, '100g', 100, '2026-03-10 01:30:16'),
(84, 'Abacate', 160, 2.00, 9.00, 15.00, '100g', 100, '2026-03-10 01:30:16'),
(85, 'Chocolate meio amargo', 546, 4.90, 61.00, 31.00, '100g', 100, '2026-03-10 01:30:16'),
(86, 'Mel', 304, 0.30, 82.00, 0.00, '100g', 100, '2026-03-10 01:30:16'),
(87, 'Granola', 471, 10.00, 64.00, 20.00, '100g', 100, '2026-03-10 01:30:16'),
(88, 'Arroz integral', 111, 2.60, 23.00, 0.90, '100g', 100, '2026-03-10 01:30:16'),
(89, 'Lentilha cozida', 116, 9.00, 20.00, 0.40, '100g', 100, '2026-03-10 01:30:16'),
(90, 'Grão de bico cozido', 164, 9.00, 27.00, 2.60, '100g', 100, '2026-03-10 01:30:16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `meals`
--

CREATE TABLE `meals` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `food_id` int(10) UNSIGNED NOT NULL,
  `meal_type` enum('breakfast','lunch','dinner','snack') NOT NULL,
  `quantity` decimal(6,2) DEFAULT 1.00,
  `meal_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ingredientes` text NOT NULL,
  `modo_preparo` text NOT NULL,
  `tempo_reparo` int(11) DEFAULT 0,
  `unidades` int(11) DEFAULT 0,
  `porcoes` int(11) DEFAULT 0,
  `regras` text DEFAULT NULL,
  `restricao_alimentar` varchar(255) DEFAULT NULL,
  `dificuldade` varchar(50) DEFAULT 'Fácil',
  `category_id` int(11) DEFAULT NULL,
  `combinacao_id` int(11) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `calorias` int(11) DEFAULT 0,
  `proteina` decimal(5,2) DEFAULT 0.00,
  `carboidratos` decimal(5,2) DEFAULT 0.00,
  `gordura` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `daily_calorie_goal` int(11) DEFAULT 2000,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `daily_calorie_goal`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@nutritech.com', '$2y$10$4U6CHP5NsfUCSI547zaRnuotWpEzk1Qmc/OC7Bq2uMCQh0eOnYZ.y', 2000, '2026-03-10 01:29:16', NULL),
(2, 'João Pedro Mello', 'mellojoaopedro20@gmail.com', '$2y$10$4U6CHP5NsfUCSI547zaRnuotWpEzk1Qmc/OC7Bq2uMCQh0eOnYZ.y', 2000, '2026-03-09 23:19:04', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `water_logs`
--

CREATE TABLE `water_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `glasses` int(11) DEFAULT 0,
  `log_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `water_logs`
--

INSERT INTO `water_logs` (`id`, `user_id`, `glasses`, `log_date`, `created_at`) VALUES
(5, 2, 5, '2026-03-10', '2026-03-10 01:02:03'),
(6, 1, 1, '2026-03-10', '2026-03-10 01:51:50');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_meal_user` (`user_id`),
  ADD KEY `fk_meal_food` (`food_id`);

--
-- Índices de tabela `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recipe_category` (`category_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `water_logs`
--
ALTER TABLE `water_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_water_user` (`user_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de tabela `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `water_logs`
--
ALTER TABLE `water_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `fk_meal_food` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_meal_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_recipe_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Restrições para tabelas `water_logs`
--
ALTER TABLE `water_logs`
  ADD CONSTRAINT `fk_water_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
