-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Ago-2018 às 19:07
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.7

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
-- Estrutura da tabela `tbrotas`
--

CREATE TABLE `tbrotas` (
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
-- Extraindo dados da tabela `tbrotas`
--

INSERT INTO `tbrotas` (`id`, `origem`, `uforigem`, `codorigem`, `destino`, `ufdestino`, `coddestino`, `distancia`, `horariopartida`, `horariochegada`) VALUES
(1, '1', '1', 1, '2', '2', 2, 750, '08:23:00', '20:00:00'),
(2, '2', '2', 2, '1', '1', 1, 750, '08:00:00', '20:00:00'),
(3, '1', '1', 1, '2', '2', 2, 750, '20:00:00', '08:00:00'),
(4, '2', '2', 2, '1', '1', 1, 750, '20:00:00', '08:00:00');

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
  `data_saida` date DEFAULT NULL,
  `data_chegada` date DEFAULT NULL,
  `hora_chegada` time DEFAULT NULL,
  `hora_saida` time DEFAULT NULL,
  `destino_rotas` tinyint(4) DEFAULT NULL,
  `origem_rotas` tinyint(4) DEFAULT NULL,
  `normal_tarifa` decimal(9,2) DEFAULT NULL,
  `promocional_tarifa` decimal(9,2) DEFAULT NULL,
  `meiapassagem_tarifa` decimal(9,2) DEFAULT NULL,
  `pedagio_tarifa` decimal(9,2) DEFAULT NULL,
  `seguro_tarifa` decimal(9,2) DEFAULT NULL,
  `poltronas_01` tinyint(4) DEFAULT NULL,
  `poltronas_02` tinyint(4) DEFAULT NULL,
  `poltronas_03` tinyint(4) DEFAULT NULL,
  `poltronas_04` tinyint(4) DEFAULT NULL,
  `poltronas_05` tinyint(4) DEFAULT NULL,
  `poltronas_06` tinyint(4) DEFAULT NULL,
  `poltronas_07` tinyint(4) DEFAULT NULL,
  `poltronas_08` tinyint(4) DEFAULT NULL,
  `poltronas_09` tinyint(4) DEFAULT NULL,
  `poltronas_10` tinyint(4) DEFAULT NULL,
  `poltronas_11` tinyint(4) DEFAULT NULL,
  `poltronas_12` tinyint(4) DEFAULT NULL,
  `poltronas_13` tinyint(4) DEFAULT NULL,
  `poltronas_14` tinyint(4) DEFAULT NULL,
  `poltronas_15` tinyint(4) DEFAULT NULL,
  `poltronas_16` tinyint(4) DEFAULT NULL,
  `poltronas_17` tinyint(4) DEFAULT NULL,
  `poltronas_18` tinyint(4) DEFAULT NULL,
  `poltronas_19` tinyint(4) DEFAULT NULL,
  `poltronas_20` tinyint(4) DEFAULT NULL,
  `poltronas_21` tinyint(4) DEFAULT NULL,
  `poltronas_22` tinyint(4) DEFAULT NULL,
  `poltronas_23` tinyint(4) DEFAULT NULL,
  `poltronas_24` tinyint(4) DEFAULT NULL,
  `poltronas_25` tinyint(4) DEFAULT NULL,
  `poltronas_26` tinyint(4) DEFAULT NULL,
  `poltronas_27` tinyint(4) DEFAULT NULL,
  `poltronas_28` tinyint(4) DEFAULT NULL,
  `poltronas_29` tinyint(4) DEFAULT NULL,
  `poltronas_30` tinyint(4) DEFAULT NULL,
  `poltronas_31` tinyint(4) DEFAULT NULL,
  `poltronas_32` tinyint(4) DEFAULT NULL,
  `poltronas_33` tinyint(4) DEFAULT NULL,
  `poltronas_34` tinyint(4) DEFAULT NULL,
  `poltronas_35` tinyint(4) DEFAULT NULL,
  `poltronas_36` tinyint(4) DEFAULT NULL,
  `poltronas_37` tinyint(4) DEFAULT NULL,
  `poltronas_38` tinyint(4) DEFAULT NULL,
  `poltronas_39` tinyint(4) DEFAULT NULL,
  `poltronas_40` tinyint(4) DEFAULT NULL,
  `poltronas_41` tinyint(4) DEFAULT NULL,
  `poltronas_42` tinyint(4) DEFAULT NULL,
  `poltronas_43` tinyint(4) DEFAULT NULL,
  `poltronas_44` tinyint(4) DEFAULT NULL,
  `poltronas_45` tinyint(4) DEFAULT NULL,
  `poltronas_46` tinyint(4) DEFAULT NULL,
  `poltronas_47` tinyint(4) DEFAULT NULL,
  `poltronas_48` tinyint(4) DEFAULT NULL,
  `poltronas_49` tinyint(4) DEFAULT NULL,
  `poltronas_50` tinyint(4) DEFAULT NULL,
  `poltronas_51` tinyint(4) DEFAULT NULL,
  `poltronas_52` tinyint(4) DEFAULT NULL,
  `poltronas_53` tinyint(4) DEFAULT NULL,
  `poltronas_54` tinyint(4) DEFAULT NULL,
  `poltronas_55` tinyint(4) DEFAULT NULL,
  `poltronas_56` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `tbrotas`
--
ALTER TABLE `tbrotas`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
