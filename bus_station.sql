-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Set-2018 às 00:48
-- Versão do servidor: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus_station`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `location`
--

CREATE TABLE `location` (
  `id` int(10) NOT NULL,
  `cidade` varchar(20) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `codigo` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `location`
--

INSERT INTO `location` (`id`, `cidade`, `uf`, `codigo`) VALUES
(1, 'Manaus', 'AM', 234234),
(2, 'Boa Vista', 'RR', 321123);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfilial`
--

CREATE TABLE `tbfilial` (
  `id` int(10) NOT NULL,
  `razao` varchar(40) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `ie` varchar(10) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `logradouro` varchar(40) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(20) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `cidade` tinyint(4) DEFAULT NULL,
  `uf` tinyint(4) DEFAULT NULL,
  `tributacao` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbfilial`
--

INSERT INTO `tbfilial` (`id`, `razao`, `cnpj`, `ie`, `telefone`, `logradouro`, `numero`, `bairro`, `cep`, `cidade`, `uf`, `tributacao`) VALUES
(1, 'Dantas Transporte Instalações LTDA', '29.269.744/0001-98', '34632342-4', '(92) 3306-2900', 'Rua Utinga', '310', 'Lirio do Vale', '69038-285', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmotorista`
--

CREATE TABLE `tbmotorista` (
  `id` int(10) NOT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `cnh` varchar(11) DEFAULT NULL,
  `validadecnh` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbmotorista`
--

INSERT INTO `tbmotorista` (`id`, `nome`, `cpf`, `nascimento`, `email`, `telefone`, `cnh`, `validadecnh`) VALUES
(1, 'João Queiroz', '732.341.126-00', '1992-01-02', 'joaoq@gmail.com', '(92) 9812-34422', '23234534534', '2018-08-31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbonibus`
--

CREATE TABLE `tbonibus` (
  `id` int(10) NOT NULL,
  `placa` varchar(8) DEFAULT NULL,
  `classe` varchar(20) DEFAULT NULL,
  `poltronas` tinyint(4) DEFAULT NULL,
  `anofabricacao` int(4) DEFAULT NULL,
  `chassi` varchar(17) DEFAULT NULL,
  `renavam` varchar(13) DEFAULT NULL,
  `marca` varchar(20) DEFAULT NULL,
  `modelo` varchar(20) DEFAULT NULL,
  `vencimentoipva` date DEFAULT NULL,
  `quilometragem` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbonibus`
--

INSERT INTO `tbonibus` (`id`, `placa`, `classe`, `poltronas`, `anofabricacao`, `chassi`, `renavam`, `marca`, `modelo`, `vencimentoipva`, `quilometragem`) VALUES
(1, 'JAN-3234', 'Semi Leito', 56, 2018, '9BWHE21JX24060960', '1243.435666-7', 'Mercedes', 'x31', '2019-06-07', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpagamento`
--

CREATE TABLE `tbpagamento` (
  `id` int(10) NOT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `prazo` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbpagamento`
--

INSERT INTO `tbpagamento` (`id`, `nome`, `prazo`) VALUES
(1, 'Dinheiro', 0),
(2, 'Cartão Debito', 0),
(3, 'Cartão Credito - Avista', 30),
(4, 'Cartão Credito - 2x', 60),
(5, 'Cartão Credito - 3x', 90),
(6, 'Cartão Credito - 4x', 120);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpassageiro`
--

CREATE TABLE `tbpassageiro` (
  `id` int(10) NOT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `emergencia` varchar(15) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `rg` varchar(10) DEFAULT NULL,
  `orgaoemissor` varchar(10) DEFAULT NULL,
  `logradouro` varchar(40) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(20) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `cidade` varchar(20) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbperfil`
--

CREATE TABLE `tbperfil` (
  `id` int(10) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `tbDashboard` tinyint(4) DEFAULT NULL,
  `tbFilial` tinyint(4) DEFAULT NULL,
  `tbTributacao` tinyint(4) DEFAULT NULL,
  `tbUsuario` tinyint(4) DEFAULT NULL,
  `tbViagem` tinyint(4) NOT NULL,
  `tbPassageiro` tinyint(4) DEFAULT NULL,
  `tbOnibus` tinyint(4) DEFAULT NULL,
  `tbRotas` tinyint(4) DEFAULT NULL,
  `tbMotorista` tinyint(4) DEFAULT NULL,
  `tbTarifas` tinyint(4) DEFAULT NULL,
  `tbPagamento` tinyint(4) DEFAULT NULL,
  `tbPassagem` tinyint(4) DEFAULT NULL,
  `tbRelatorios` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbperfil`
--

INSERT INTO `tbperfil` (`id`, `nome`, `tbDashboard`, `tbFilial`, `tbTributacao`, `tbUsuario`, `tbViagem`, `tbPassageiro`, `tbOnibus`, `tbRotas`, `tbMotorista`, `tbTarifas`, `tbPagamento`, `tbPassagem`, `tbRelatorios`) VALUES
(1, 'Suporte', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpoltronas`
--

CREATE TABLE `tbpoltronas` (
  `id` int(10) NOT NULL,
  `numero` int(11) NOT NULL,
  `onibus` int(10) NOT NULL,
  `disponivel` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbpoltronas`
--

INSERT INTO `tbpoltronas` (`id`, `numero`, `onibus`, `disponivel`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 1, 1),
(5, 5, 1, 1),
(6, 6, 1, 1),
(7, 7, 1, 1),
(8, 8, 1, 1),
(9, 9, 1, 1),
(10, 10, 1, 1),
(11, 11, 1, 1),
(12, 12, 1, 1),
(13, 13, 1, 1),
(14, 14, 1, 1),
(15, 15, 1, 1),
(16, 16, 1, 1),
(17, 17, 1, 1),
(18, 18, 1, 1),
(19, 19, 1, 1),
(20, 20, 1, 1),
(21, 21, 1, 1),
(22, 22, 1, 1),
(23, 23, 1, 1),
(24, 24, 1, 1),
(25, 25, 1, 1),
(26, 26, 1, 1),
(27, 27, 1, 1),
(28, 28, 1, 1),
(29, 29, 1, 1),
(30, 30, 1, 1),
(31, 31, 1, 1),
(32, 32, 1, 1),
(33, 33, 1, 1),
(34, 34, 1, 1),
(35, 35, 1, 1),
(36, 36, 1, 1),
(37, 37, 1, 1),
(38, 38, 1, 1),
(39, 39, 1, 1),
(40, 40, 1, 1),
(41, 41, 1, 1),
(42, 42, 1, 1),
(43, 43, 1, 1),
(44, 44, 1, 1),
(45, 45, 1, 1),
(46, 46, 1, 1),
(47, 47, 1, 1),
(48, 48, 1, 1),
(49, 49, 1, 1),
(50, 50, 1, 1),
(51, 51, 1, 1),
(52, 52, 1, 1),
(53, 53, 1, 1),
(54, 54, 1, 1),
(55, 55, 1, 1),
(56, 56, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbrotas`
--

CREATE TABLE `tbrotas` (
  `id` int(10) NOT NULL,
  `origem` int(10) DEFAULT NULL,
  `uforigem` varchar(2) DEFAULT NULL,
  `codorigem` bigint(7) DEFAULT NULL,
  `destino` varchar(20) DEFAULT NULL,
  `ufdestino` varchar(2) DEFAULT NULL,
  `coddestino` bigint(7) DEFAULT NULL,
  `distancia` int(4) DEFAULT NULL,
  `horariopartida` time DEFAULT NULL,
  `horariochegada` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbrotas`
--

INSERT INTO `tbrotas` (`id`, `origem`, `uforigem`, `codorigem`, `destino`, `ufdestino`, `coddestino`, `distancia`, `horariopartida`, `horariochegada`) VALUES
(1, 1, '1', 1, '2', '2', 2, 750, '08:23:00', '20:00:00'),
(2, 2, '2', 2, '1', '1', 1, 750, '08:00:00', '20:00:00'),
(3, 1, '1', 1, '2', '2', 2, 750, '20:00:00', '08:00:00'),
(4, 2, '2', 2, '1', '1', 1, 750, '20:00:00', '08:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtarifas`
--

CREATE TABLE `tbtarifas` (
  `id` int(10) NOT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `normal` decimal(9,2) DEFAULT NULL,
  `promocional` decimal(9,2) DEFAULT NULL,
  `meiapassagem` decimal(9,2) DEFAULT NULL,
  `pedagio` decimal(9,2) DEFAULT NULL,
  `seguro` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbtarifas`
--

INSERT INTO `tbtarifas` (`id`, `nome`, `normal`, `promocional`, `meiapassagem`, `pedagio`, `seguro`) VALUES
(1, 'Tarifa Agosto 2018', '180.00', '140.00', '90.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtributacao`
--

CREATE TABLE `tbtributacao` (
  `id` int(10) NOT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `icmsAliquota` float DEFAULT NULL,
  `outrosImpostos` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbtributacao`
--

INSERT INTO `tbtributacao` (`id`, `nome`, `icmsAliquota`, `outrosImpostos`) VALUES
(1, 'Decreto AM-231', 17, 0),
(2, 'Decreto RR 3512-2', 7, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuarios`
--

CREATE TABLE `tbusuarios` (
  `id` int(10) NOT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `perfil` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbusuarios`
--

INSERT INTO `tbusuarios` (`id`, `nome`, `cpf`, `nascimento`, `email`, `telefone`, `login`, `senha`, `perfil`) VALUES
(1, 'Adejaime Junior', '978.002.792-00', '1988-09-15', 'adejaime88@icloud.com', '(92) 9812-55539', 'admin', '123456', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbviagem`
--

CREATE TABLE `tbviagem` (
  `id` int(10) NOT NULL,
  `rota` int(10) NOT NULL,
  `onibus` int(10) NOT NULL,
  `tarifa` int(10) NOT NULL,
  `motorista` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbviagem`
--

INSERT INTO `tbviagem` (`id`, `rota`, `onibus`, `tarifa`, `motorista`) VALUES
(90, 57, 14, 12, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbviagens_motorista`
--

CREATE TABLE `tbviagens_motorista` (
  `id` int(10) NOT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `cnh` varchar(11) DEFAULT NULL,
  `validadecnh` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbviagens_motorista`
--

INSERT INTO `tbviagens_motorista` (`id`, `nome`, `cpf`, `nascimento`, `email`, `telefone`, `cnh`, `validadecnh`) VALUES
(12, 'João Queiroz', '732.341.126-00', '1992-01-02', 'joaoq@gmail.com', '(92) 9812-34422', '23234534534', '2018-08-31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbviagens_onibus`
--

CREATE TABLE `tbviagens_onibus` (
  `id` int(10) NOT NULL,
  `placa` varchar(8) DEFAULT NULL,
  `classe` varchar(20) DEFAULT NULL,
  `poltronas` tinyint(4) DEFAULT NULL,
  `anofabricacao` int(4) DEFAULT NULL,
  `chassi` varchar(17) DEFAULT NULL,
  `renavam` varchar(13) DEFAULT NULL,
  `marca` varchar(20) DEFAULT NULL,
  `modelo` varchar(20) DEFAULT NULL,
  `vencimentoipva` date DEFAULT NULL,
  `quilometragem` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbviagens_onibus`
--

INSERT INTO `tbviagens_onibus` (`id`, `placa`, `classe`, `poltronas`, `anofabricacao`, `chassi`, `renavam`, `marca`, `modelo`, `vencimentoipva`, `quilometragem`) VALUES
(14, 'JAN-3234', 'Semi Leito', 56, 2018, '9BWHE21JX24060960', '1243.435666-7', 'Mercedes', 'x31', '2019-06-07', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbviagens_passagens`
--

CREATE TABLE `tbviagens_passagens` (
  `id` int(11) NOT NULL,
  `viagem` int(11) NOT NULL,
  `poltrona` int(11) NOT NULL,
  `disponivel` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbviagens_passagens`
--

INSERT INTO `tbviagens_passagens` (`id`, `viagem`, `poltrona`, `disponivel`) VALUES
(17, 90, 32, 1),
(18, 90, 33, 1),
(19, 90, 34, 1),
(20, 90, 35, 1),
(21, 90, 36, 1),
(22, 90, 37, 1),
(23, 90, 38, 1),
(24, 90, 39, 1),
(25, 90, 40, 1),
(26, 90, 41, 1),
(27, 90, 42, 1),
(28, 90, 43, 1),
(29, 90, 44, 1),
(30, 90, 45, 1),
(31, 90, 46, 1),
(32, 90, 47, 1),
(33, 90, 48, 1),
(34, 90, 49, 1),
(35, 90, 50, 1),
(36, 90, 51, 1),
(37, 90, 52, 1),
(38, 90, 53, 1),
(39, 90, 54, 1),
(40, 90, 55, 1),
(41, 90, 56, 1),
(42, 90, 57, 1),
(43, 90, 58, 1),
(44, 90, 59, 1),
(45, 90, 60, 1),
(46, 90, 61, 1),
(47, 90, 62, 1),
(48, 90, 63, 1),
(49, 90, 64, 1),
(50, 90, 65, 1),
(51, 90, 66, 1),
(52, 90, 67, 1),
(53, 90, 68, 1),
(54, 90, 69, 1),
(55, 90, 70, 1),
(56, 90, 71, 1),
(57, 90, 72, 1),
(58, 90, 73, 1),
(59, 90, 74, 1),
(60, 90, 75, 1),
(61, 90, 76, 1),
(62, 90, 77, 1),
(63, 90, 78, 1),
(64, 90, 79, 1),
(65, 90, 80, 1),
(66, 90, 81, 1),
(67, 90, 82, 1),
(68, 90, 83, 1),
(69, 90, 84, 1),
(70, 90, 85, 1),
(71, 90, 86, 1),
(72, 90, 87, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbviagens_poltronas`
--

CREATE TABLE `tbviagens_poltronas` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `onibus` int(11) NOT NULL,
  `disponivel` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbviagens_poltronas`
--

INSERT INTO `tbviagens_poltronas` (`id`, `numero`, `onibus`, `disponivel`) VALUES
(32, 1, 14, 1),
(33, 2, 14, 1),
(34, 3, 14, 1),
(35, 4, 14, 1),
(36, 5, 14, 1),
(37, 6, 14, 1),
(38, 7, 14, 1),
(39, 8, 14, 1),
(40, 9, 14, 1),
(41, 10, 14, 1),
(42, 11, 14, 1),
(43, 12, 14, 1),
(44, 13, 14, 1),
(45, 14, 14, 1),
(46, 15, 14, 1),
(47, 16, 14, 1),
(48, 17, 14, 1),
(49, 18, 14, 1),
(50, 19, 14, 1),
(51, 20, 14, 1),
(52, 21, 14, 1),
(53, 22, 14, 1),
(54, 23, 14, 1),
(55, 24, 14, 1),
(56, 25, 14, 1),
(57, 26, 14, 1),
(58, 27, 14, 1),
(59, 28, 14, 1),
(60, 29, 14, 1),
(61, 30, 14, 1),
(62, 31, 14, 1),
(63, 32, 14, 1),
(64, 33, 14, 1),
(65, 34, 14, 1),
(66, 35, 14, 1),
(67, 36, 14, 1),
(68, 37, 14, 1),
(69, 38, 14, 1),
(70, 39, 14, 1),
(71, 40, 14, 1),
(72, 41, 14, 1),
(73, 42, 14, 1),
(74, 43, 14, 1),
(75, 44, 14, 1),
(76, 45, 14, 1),
(77, 46, 14, 1),
(78, 47, 14, 1),
(79, 48, 14, 1),
(80, 49, 14, 1),
(81, 50, 14, 1),
(82, 51, 14, 1),
(83, 52, 14, 1),
(84, 53, 14, 1),
(85, 54, 14, 1),
(86, 55, 14, 1),
(87, 56, 14, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbviagens_rotas`
--

CREATE TABLE `tbviagens_rotas` (
  `id` int(10) NOT NULL,
  `origem` varchar(20) DEFAULT NULL,
  `uforigem` varchar(2) DEFAULT NULL,
  `codorigem` bigint(7) DEFAULT NULL,
  `destino` varchar(20) DEFAULT NULL,
  `ufdestino` varchar(2) DEFAULT NULL,
  `coddestino` bigint(7) DEFAULT NULL,
  `distancia` int(4) DEFAULT NULL,
  `horariopartida` time DEFAULT NULL,
  `horariochegada` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbviagens_rotas`
--

INSERT INTO `tbviagens_rotas` (`id`, `origem`, `uforigem`, `codorigem`, `destino`, `ufdestino`, `coddestino`, `distancia`, `horariopartida`, `horariochegada`) VALUES
(57, '2', '2', 2, '1', '1', 1, 750, '08:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbviagens_tarifas`
--

CREATE TABLE `tbviagens_tarifas` (
  `id` int(10) NOT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `normal` decimal(9,2) DEFAULT NULL,
  `promocional` decimal(9,2) DEFAULT NULL,
  `meiapassagem` decimal(9,2) DEFAULT NULL,
  `pedagio` decimal(9,2) DEFAULT NULL,
  `seguro` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbviagens_tarifas`
--

INSERT INTO `tbviagens_tarifas` (`id`, `nome`, `normal`, `promocional`, `meiapassagem`, `pedagio`, `seguro`) VALUES
(12, 'Tarifa Agosto 2018', '180.00', '140.00', '90.00', '0.00', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbfilial`
--
ALTER TABLE `tbfilial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbmotorista`
--
ALTER TABLE `tbmotorista`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbonibus`
--
ALTER TABLE `tbonibus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbpagamento`
--
ALTER TABLE `tbpagamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbpassageiro`
--
ALTER TABLE `tbpassageiro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbperfil`
--
ALTER TABLE `tbperfil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbpoltronas`
--
ALTER TABLE `tbpoltronas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `onibus` (`onibus`);

--
-- Indexes for table `tbrotas`
--
ALTER TABLE `tbrotas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `origem` (`origem`);

--
-- Indexes for table `tbtarifas`
--
ALTER TABLE `tbtarifas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbtributacao`
--
ALTER TABLE `tbtributacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbusuarios`
--
ALTER TABLE `tbusuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbviagem`
--
ALTER TABLE `tbviagem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbviagens_motorista`
--
ALTER TABLE `tbviagens_motorista`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbviagens_onibus`
--
ALTER TABLE `tbviagens_onibus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbviagens_passagens`
--
ALTER TABLE `tbviagens_passagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poltrona` (`poltrona`),
  ADD KEY `viagem` (`viagem`);

--
-- Indexes for table `tbviagens_poltronas`
--
ALTER TABLE `tbviagens_poltronas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `onibus` (`onibus`);

--
-- Indexes for table `tbviagens_rotas`
--
ALTER TABLE `tbviagens_rotas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbviagens_tarifas`
--
ALTER TABLE `tbviagens_tarifas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbfilial`
--
ALTER TABLE `tbfilial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbmotorista`
--
ALTER TABLE `tbmotorista`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbonibus`
--
ALTER TABLE `tbonibus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbpagamento`
--
ALTER TABLE `tbpagamento`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbpassageiro`
--
ALTER TABLE `tbpassageiro`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbperfil`
--
ALTER TABLE `tbperfil`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbpoltronas`
--
ALTER TABLE `tbpoltronas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tbrotas`
--
ALTER TABLE `tbrotas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbtarifas`
--
ALTER TABLE `tbtarifas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbtributacao`
--
ALTER TABLE `tbtributacao`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbusuarios`
--
ALTER TABLE `tbusuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbviagem`
--
ALTER TABLE `tbviagem`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tbviagens_motorista`
--
ALTER TABLE `tbviagens_motorista`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbviagens_onibus`
--
ALTER TABLE `tbviagens_onibus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbviagens_passagens`
--
ALTER TABLE `tbviagens_passagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tbviagens_poltronas`
--
ALTER TABLE `tbviagens_poltronas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `tbviagens_rotas`
--
ALTER TABLE `tbviagens_rotas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbviagens_tarifas`
--
ALTER TABLE `tbviagens_tarifas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tbpoltronas`
--
ALTER TABLE `tbpoltronas`
  ADD CONSTRAINT `tbpoltronas_ibfk_1` FOREIGN KEY (`onibus`) REFERENCES `tbonibus` (`id`);

--
-- Limitadores para a tabela `tbrotas`
--
ALTER TABLE `tbrotas`
  ADD CONSTRAINT `tbrotas_ibfk_1` FOREIGN KEY (`origem`) REFERENCES `location` (`id`);

--
-- Limitadores para a tabela `tbviagens_passagens`
--
ALTER TABLE `tbviagens_passagens`
  ADD CONSTRAINT `tbviagens_passagens_ibfk_1` FOREIGN KEY (`poltrona`) REFERENCES `tbviagens_poltronas` (`id`),
  ADD CONSTRAINT `tbviagens_passagens_ibfk_2` FOREIGN KEY (`viagem`) REFERENCES `tbviagem` (`id`);

--
-- Limitadores para a tabela `tbviagens_poltronas`
--
ALTER TABLE `tbviagens_poltronas`
  ADD CONSTRAINT `tbviagens_poltronas_ibfk_1` FOREIGN KEY (`onibus`) REFERENCES `tbviagens_onibus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
