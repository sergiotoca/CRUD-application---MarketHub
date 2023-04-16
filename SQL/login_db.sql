-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Abr-2023 às 17:09
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `login_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `price`, `user_id`, `image_url`) VALUES
(20, 'PC rack', 'A rack for laptop', 15.45, 25, 'http://localhost/CRUD/uploads/pcrack.jpg'),
(21, 'PC', 'Desktop Personal Computer', 1500.5, 9, 'http://localhost/CRUD/uploads/Desktop.jpg'),
(22, 'Table', 'Table for 4 people', 1225.5, 9, 'http://localhost/CRUD/uploads/Table.jpg'),
(23, 'Phone', 'Smartphone', 1000, 18, 'http://localhost/CRUD/uploads/phone.jpg'),
(24, 'Monitor', 'Monitor 22\"', 1225.05, 18, 'http://localhost/CRUD/uploads/monitor.jpg'),
(25, 'Cable', '4 meter cable', 5.5, 23, 'http://localhost/CRUD/uploads/cable.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password_hash`) VALUES
(9, 'Sergio', 'sergiop@toledo.com.br', '$2y$10$.lLi77RSfDaYU.UdXaY8COQTPDF3JIWA5x0USNtJZWPEZEsCdZo1q'),
(18, 'Mayra', 'mayramesquita@live.com', '$2y$10$B.HTe8MqXBFHvZ39ij4P7O1VGFz8j3WrYAGG9MBrpfIj2cTod2al.'),
(23, 'Bob', 'bob@gmail.com', '$2y$10$HOR.DEpHw6TBXijoLcy6v.ZBijxNahy34IPMW0SNlvD2Xr99ZAsDe'),
(25, 'Steve', 'steve@gmail.com', '$2y$10$UUBWcANC93TFwqcaMOjWJe9CeWGNoEC8AYv9Ob7h5kcKOlcBO.Uny'),
(30, 'Sergio', 'serginhotoledo@hotmail.com', '$2y$10$TN4I2yHOFgud/AaCD1VlKucweJ3pjQEAh6Z1G9SnRNQGiD1PzdeWC');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_ibfk_1` (`user_id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
