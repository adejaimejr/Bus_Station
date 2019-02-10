-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Fev-2019 às 00:47
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.3.0

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
  `codigo` bigint(10) DEFAULT NULL,
  `municipioIBGE` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `location`
--

INSERT INTO `location` (`id`, `cidade`, `uf`, `codigo`, `municipioIBGE`) VALUES
(1, 'Manaus', 'AM', 234234, '1302603'),
(2, 'Boa Vista', 'RR', 321123, '1400100');

-- --------------------------------------------------------

--
-- Estrutura da tabela `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `país` varchar(60) NOT NULL,
  `codigoBACEN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdescontos`
--

CREATE TABLE `tbdescontos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(30) NOT NULL,
  `descontoporc` decimal(10,0) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbdescontos`
--

INSERT INTO `tbdescontos` (`id`, `descricao`, `descontoporc`, `ativo`) VALUES
(1, 'Tarifa promocional', '0', 1),
(2, 'Idoso', '100', 1),
(3, 'Criança', '50', 1),
(4, 'Deficiente', '100', 1),
(5, 'Estudante', '50', 1),
(6, 'Animal Doméstico', '50', 1),
(7, 'Acordo Coletivo', '100', 1),
(8, 'Profissional em Deslocamento', '100', 1),
(9, 'Profissional da Empresa', '100', 1),
(10, 'Jovem', '100', 1),
(99, 'Outros', '0', 1),
(0, 'Tarifa Normal', '0', 1);

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
-- Estrutura da tabela `tbpassagens_bpe`
--

CREATE TABLE `tbpassagens_bpe` (
  `id` int(11) NOT NULL,
  `xmlBPeRequest` varchar(4096) NOT NULL,
  `xmlBPeResponse` varchar(4096) NOT NULL,
  `xmlBPeResponseStatus` int(11) NOT NULL,
  `xmlBPeResponseMotivo` varchar(4096) NOT NULL,
  `nsNRec` int(11) NOT NULL,
  `statusProcessamento` int(11) NOT NULL,
  `statusProcessamentoResponse` varchar(4096) NOT NULL,
  `cStatProcessamento` int(11) NOT NULL,
  `statusProcessamentoMotivo` varchar(4096) NOT NULL,
  `cStatProcessamentoMotivo` varchar(4096) NOT NULL,
  `chBPe` varchar(255) NOT NULL,
  `downloadStatus` int(11) NOT NULL,
  `downloadStatusMotivo` int(11) NOT NULL,
  `downloadRetorno` varchar(4096) NOT NULL,
  `downloadPDF` varchar(4096) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `passagem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbpassagens_bpe`
--

INSERT INTO `tbpassagens_bpe` (`id`, `xmlBPeRequest`, `xmlBPeResponse`, `xmlBPeResponseStatus`, `xmlBPeResponseMotivo`, `nsNRec`, `statusProcessamento`, `statusProcessamentoResponse`, `cStatProcessamento`, `statusProcessamentoMotivo`, `cStatProcessamentoMotivo`, `chBPe`, `downloadStatus`, `downloadStatusMotivo`, `downloadRetorno`, `downloadPDF`, `updated`, `passagem`) VALUES
(9, '{\"BPe\":{\"infBPe\":{\"versao\":\"1.00\",\"ide\":{\"cUF\":\"13\",\"tpAmb\":\"2\",\"mod\":\"63\",\"serie\":\"1\",\"nBP\":\"19\",\"cBP\":30619773,\"cDV\":0,\"modal\":\"1\",\"dhEmi\":\"2019-02-10T19:45:39-04:00\",\"tpEmis\":\"1\",\"verProc\":\"1.0.0.0\",\"tpBPe\":\"0\",\"indPres\":\"1\",\"UFIni\":\"RR\",\"cMunIni\":\"1400100\",\"UFFim\":\"AM\",\"cMunFim\":\"1302603\"},\"emit\":{\"CNPJ\":\"63679351000190\",\"IE\":\"54021588\",\"xNome\":\"DANTAS TRANSPORTES E INSTALACOES LTDA\",\"xFant\":\"A DANTAS TRANSPORTES\",\"IM\":\"4420601\",\"CNAE\":\"4929902\",\"CRT\":\"3\",\"enderEmit\":{\"xLgr\":\"RUA UTINGA\",\"nro\":\"310\",\"xCpl\":\"\",\"xBairro\":\"LIRIO DO VALE\",\"cMun\":\"1302603\",\"xMun\":\"MANAUS\",\"CEP\":\"69038286\",\"UF\":\"AM\",\"Fone\":\"92 33062903\",\"Email\":\"dantast@argo.com.br\"},\"TAR\":\"0\"},\"Comp\":{\"xNome\":\"Teste\",\"CNPJ\":\"00000000000000\",\"CPF\":\"11111111111\",\"idEstrangeiro\":\"\",\"IE\":\"\",\"enderComp\":{\"xLgr\":\"rua teste\",\"nro\":\"100\",\"xCpl\":\"teste\",\"xBairro\":\"teste\",\"cMun\":\"1400100\",\"xMun\":\"\",\"CEP\":\"11111111\",\"UF\":\"\",\"cPais\":\"1058\",\"xPais\":\"\",\"Fone\":\"11999999999\",\"Email\":\"teste@teste.com\"}},\"infPassagem\":{\"cLocOrig\":\"RR\",\"xLocOrig\":\"1400100\",\"cLocDest\":\"AM\",\"xLocDest\":\"1302603\",\"dhEmb\":\"2019-02-10T19:45:39-04:00\",\"dhValidade\":\"2020-02-10T19:45:39-04:00\",\"infPassageiro\":{\"xNome\":\"Teste\",\"CPF\":\"11111111111\",\"tpDoc\":\"1\",\"nDoc\":\"11111\",\"dNasc\":\"2000-02-10\",\"Fone\":\"11999999999\",\"Email\":\"teste@teste.com\"}},\"infViagem\":{\"cPercurso\":\"0\",\"xPercurso\":\"teste\",\"tpViagem\":\"00\",\"tpServ\":\"3\",\"tpAcomodacao\":\"1\",\"tpTrecho\":\"1\",\"Poltrona\":3,\"dhViagem\":\"2019-02-10T19:45:39-04:00\"},\"infValorBPe\":{\"vBP\":\"180.00\",\"vDesconto\":\"0.00\",\"vPgto\":\"180.00\",\"vTroco\":\"0.00\",\"Comp\":[{\"tpComp\":\"01\",\"vComp\":\"180.00\"}]},\"imp\":{\"ICMS\":{\"ICMS00\":{\"CST\":\"00\",\"vBC\":\"180.00\",\"pICMS\":\"0.00\",\"vICMS\":\"0.00\"}}},\"pag\":[{\"tPag\":\"01\",\"vPag\":\"180.00\",\"card\":{\"tpIntegra\":\"2\",\"tBand\":\"01\"}}]}}}', '{\"status\":-2,\"motivo\":\"BPe invalido de acordo com a validacao contra schema\",\"erros\":[\"O campo \'xCpl\' foi preenchido incorretamente com o valor \' \'. Este campo deve ser preenchido com letras ou numeros e conter no minimo 1 e no maximo 60 caracteres. (cvc-pattern-valid: Value \'\' is not facet-valid with respect to pattern \'[!-ÿ]{1}[ -ÿ]{0,}[!-ÿ]{1}|[!-ÿ]{1}\' for type \'#AnonType_xCplTEndeEmi\'.)\"]}', -2, 'BPe invalido de acordo com a validacao contra schema', 0, 0, '', 0, '', '', '', 0, 0, '', '', '2019-02-10 23:45:39', 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpassagens_comprador`
--

CREATE TABLE `tbpassagens_comprador` (
  `id` int(11) NOT NULL,
  `passagem` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `IdEstrangeiro` varchar(60) NOT NULL,
  `InscricaoEstadual` varchar(14) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(60) NOT NULL,
  `complemento` varchar(60) NOT NULL,
  `bairro` varchar(60) NOT NULL,
  `cidade` int(11) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `pais` int(11) NOT NULL,
  `telefone` varchar(12) NOT NULL,
  `email` varchar(60) NOT NULL,
  `estrangeiro` tinyint(1) NOT NULL DEFAULT '0',
  `tipoComprador` int(11) NOT NULL,
  `tipoContribuicaoICMS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbpassagens_comprador`
--

INSERT INTO `tbpassagens_comprador` (`id`, `passagem`, `nome`, `cnpj`, `cpf`, `IdEstrangeiro`, `InscricaoEstadual`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `cep`, `pais`, `telefone`, `email`, `estrangeiro`, `tipoComprador`, `tipoContribuicaoICMS`) VALUES
(106, 58, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(107, 58, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(108, 58, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(109, 58, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(110, 58, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(111, 58, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(112, 58, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(113, 58, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(114, 58, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(115, 58, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(116, 58, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(117, 58, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(118, 58, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(119, 59, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(120, 60, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(121, 61, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(122, 70, 'teste', '00000000000000', '11111111111', '', '', 'teste', '100', 'teste', 'teste', 1400100, '99999999', 1058, '999999999', 'teste@teste.com', 0, 0, 0),
(123, 19, 'Teste', '00000000000000', '11111111111', '', '', 'rua teste', '100', 'teste', 'teste', 1400100, '11111111', 1058, '11999999999', 'teste@teste.com', 0, 0, 0),
(124, 19, 'Teste', '00000000000000', '11111111111', '', '', 'rua teste', '100', 'teste', 'teste', 1400100, '11111111', 1058, '11999999999', 'teste@teste.com', 0, 0, 0);

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
  `disponivel` tinyint(1) DEFAULT NULL,
  `tipoServico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbpoltronas`
--

INSERT INTO `tbpoltronas` (`id`, `numero`, `onibus`, `disponivel`, `tipoServico`) VALUES
(1, 1, 1, 1, 3),
(2, 2, 1, 1, 3),
(3, 3, 1, 1, 3),
(4, 4, 1, 1, 3),
(5, 5, 1, 1, 3),
(6, 6, 1, 1, 3),
(7, 7, 1, 1, 3),
(8, 8, 1, 1, 3),
(9, 9, 1, 1, 3),
(10, 10, 1, 1, 3),
(11, 11, 1, 1, 3),
(12, 12, 1, 1, 3),
(13, 13, 1, 1, 3),
(14, 14, 1, 1, 3),
(15, 15, 1, 1, 3),
(16, 16, 1, 1, 3),
(17, 17, 1, 1, 3),
(18, 18, 1, 1, 3),
(19, 19, 1, 1, 3),
(20, 20, 1, 1, 3),
(21, 21, 1, 1, 3),
(22, 22, 1, 1, 3),
(23, 23, 1, 1, 3),
(24, 24, 1, 1, 3),
(25, 25, 1, 1, 3),
(26, 26, 1, 1, 3),
(27, 27, 1, 1, 3),
(28, 28, 1, 1, 3),
(29, 29, 1, 1, 3),
(30, 30, 1, 1, 3),
(31, 31, 1, 1, 3),
(32, 32, 1, 1, 3),
(33, 33, 1, 1, 3),
(34, 34, 1, 1, 3),
(35, 35, 1, 1, 3),
(36, 36, 1, 1, 3),
(37, 37, 1, 1, 3),
(38, 38, 1, 1, 3),
(39, 39, 1, 1, 3),
(40, 40, 1, 1, 3),
(41, 41, 1, 1, 3),
(42, 42, 1, 1, 3),
(43, 43, 1, 1, 3),
(44, 44, 1, 1, 3),
(45, 45, 1, 1, 3),
(46, 46, 1, 1, 3),
(47, 47, 1, 1, 3),
(48, 48, 1, 1, 3),
(49, 49, 1, 1, 3),
(50, 50, 1, 1, 3),
(51, 51, 1, 1, 3),
(52, 52, 1, 1, 3),
(53, 53, 1, 1, 3),
(54, 54, 1, 1, 3),
(55, 55, 1, 1, 3),
(56, 56, 1, 1, 3);

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
-- Estrutura da tabela `tbservicos`
--

CREATE TABLE `tbservicos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(30) NOT NULL,
  `tipoServicoBPe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbservicos`
--

INSERT INTO `tbservicos` (`id`, `descricao`, `tipoServicoBPe`) VALUES
(1, 'Convencional\r\ncom sanitário', 1),
(2, 'Convencional\r\nsem sanitário', 2),
(3, 'Semileito', 3),
(4, 'Leito com ar condicionado', 4),
(5, 'Leito sem ar condicionado', 5),
(6, 'Executivo', 6),
(7, 'Semiurbano', 7),
(8, 'Longitudinal', 8),
(9, 'Travessia', 9);

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
  `outrosImpostos` float DEFAULT NULL,
  `CST` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbtributacao`
--

INSERT INTO `tbtributacao` (`id`, `nome`, `icmsAliquota`, `outrosImpostos`, `CST`) VALUES
(1, 'Decreto AM-231', 17, 0, ''),
(2, 'Decreto RR 3512-2', 7, 0, ''),
(3, 'tributação normal ICMS - BPe', 12, 0, '00');

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
  `dataviagem` date NOT NULL,
  `rota` int(10) NOT NULL,
  `onibus` int(10) NOT NULL,
  `tarifa` int(10) NOT NULL,
  `motorista` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbviagem`
--

INSERT INTO `tbviagem` (`id`, `dataviagem`, `rota`, `onibus`, `tarifa`, `motorista`) VALUES
(90, '2018-10-11', 57, 14, 12, 12),
(91, '2018-10-12', 58, 15, 13, 13),
(95, '2018-11-26', 62, 19, 17, 17),
(96, '2018-11-26', 63, 20, 18, 18),
(97, '2018-11-26', 64, 21, 19, 19),
(98, '2018-01-26', 65, 22, 20, 20),
(99, '2018-01-26', 66, 23, 21, 21),
(100, '2018-11-27', 67, 24, 22, 22);

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
(12, 'João Queiroz', '732.341.126-00', '1992-01-02', 'joaoq@gmail.com', '(92) 9812-34422', '23234534534', '2018-08-31'),
(13, 'João Queiroz', '732.341.126-00', '1992-01-02', 'joaoq@gmail.com', '(92) 9812-34422', '23234534534', '2018-08-31'),
(17, 'João Queiroz', '732.341.126-00', '1992-01-02', 'joaoq@gmail.com', '(92) 9812-34422', '23234534534', '2018-08-31'),
(18, 'João Queiroz', '732.341.126-00', '1992-01-02', 'joaoq@gmail.com', '(92) 9812-34422', '23234534534', '2018-08-31'),
(19, 'João Queiroz', '732.341.126-00', '1992-01-02', 'joaoq@gmail.com', '(92) 9812-34422', '23234534534', '2018-08-31'),
(20, 'João Queiroz', '732.341.126-00', '1992-01-02', 'joaoq@gmail.com', '(92) 9812-34422', '23234534534', '2018-08-31'),
(21, 'João Queiroz', '732.341.126-00', '1992-01-02', 'joaoq@gmail.com', '(92) 9812-34422', '23234534534', '2018-08-31'),
(22, 'João Queiroz', '732.341.126-00', '1992-01-02', 'joaoq@gmail.com', '(92) 9812-34422', '23234534534', '2018-08-31');

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
(14, 'JAN-3234', 'Semi Leito', 56, 2018, '9BWHE21JX24060960', '1243.435666-7', 'Mercedes', 'x31', '2019-06-07', 0),
(15, 'JAN-3234', 'Semi Leito', 56, 2018, '9BWHE21JX24060960', '1243.435666-7', 'Mercedes', 'x31', '2019-06-07', 0),
(19, 'JAN-3234', 'Semi Leito', 56, 2018, '9BWHE21JX24060960', '1243.435666-7', 'Mercedes', 'x31', '2019-06-07', 0),
(20, 'JAN-3234', 'Semi Leito', 56, 2018, '9BWHE21JX24060960', '1243.435666-7', 'Mercedes', 'x31', '2019-06-07', 0),
(21, 'JAN-3234', 'Semi Leito', 56, 2018, '9BWHE21JX24060960', '1243.435666-7', 'Mercedes', 'x31', '2019-06-07', 0),
(22, 'JAN-3234', 'Semi Leito', 56, 2018, '9BWHE21JX24060960', '1243.435666-7', 'Mercedes', 'x31', '2019-06-07', 0),
(23, 'JAN-3234', 'Semi Leito', 56, 2018, '9BWHE21JX24060960', '1243.435666-7', 'Mercedes', 'x31', '2019-06-07', 0),
(24, 'JAN-3234', 'Semi Leito', 56, 2018, '9BWHE21JX24060960', '1243.435666-7', 'Mercedes', 'x31', '2019-06-07', 0);

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
(72, 90, 87, 1),
(73, 91, 88, 1),
(74, 91, 89, 1),
(75, 91, 90, 1),
(76, 91, 91, 1),
(77, 91, 92, 1),
(78, 91, 93, 1),
(79, 91, 94, 1),
(80, 91, 95, 1),
(81, 91, 96, 1),
(82, 91, 97, 1),
(83, 91, 98, 1),
(84, 91, 99, 1),
(85, 91, 100, 1),
(86, 91, 101, 1),
(87, 91, 102, 1),
(88, 91, 103, 1),
(89, 91, 104, 1),
(90, 91, 105, 1),
(91, 91, 106, 1),
(92, 91, 107, 1),
(93, 91, 108, 1),
(94, 91, 109, 1),
(95, 91, 110, 1),
(96, 91, 111, 1),
(97, 91, 112, 1),
(98, 91, 113, 1),
(99, 91, 114, 1),
(100, 91, 115, 1),
(101, 91, 116, 1),
(102, 91, 117, 1),
(103, 91, 118, 1),
(104, 91, 119, 1),
(105, 91, 120, 1),
(106, 91, 121, 1),
(107, 91, 122, 1),
(108, 91, 123, 1),
(109, 91, 124, 1),
(110, 91, 125, 1),
(111, 91, 126, 1),
(112, 91, 127, 1),
(113, 91, 128, 1),
(114, 91, 129, 1),
(115, 91, 130, 1),
(116, 91, 131, 1),
(117, 91, 132, 1),
(118, 91, 133, 1),
(119, 91, 134, 1),
(120, 91, 135, 1),
(121, 91, 136, 1),
(122, 91, 137, 1),
(123, 91, 138, 1),
(124, 91, 139, 1),
(125, 91, 140, 1),
(126, 91, 141, 1),
(127, 91, 142, 1),
(128, 91, 143, 1),
(318, 95, 333, 1),
(319, 95, 334, 1),
(320, 95, 335, 1),
(321, 95, 336, 1),
(322, 95, 337, 1),
(323, 95, 338, 1),
(324, 95, 339, 1),
(325, 95, 340, 1),
(326, 95, 341, 1),
(327, 95, 342, 1),
(328, 95, 343, 1),
(329, 95, 344, 1),
(330, 95, 345, 1),
(331, 95, 346, 1),
(332, 95, 347, 1),
(333, 95, 348, 1),
(334, 95, 349, 1),
(335, 95, 350, 1),
(336, 95, 351, 1),
(337, 95, 352, 1),
(338, 95, 353, 1),
(339, 95, 354, 1),
(340, 95, 355, 1),
(341, 95, 356, 1),
(342, 95, 357, 1),
(343, 95, 358, 1),
(344, 95, 359, 1),
(345, 95, 360, 1),
(346, 95, 361, 1),
(347, 95, 362, 1),
(348, 95, 363, 1),
(349, 95, 364, 1),
(350, 95, 365, 1),
(351, 95, 366, 1),
(352, 95, 367, 1),
(353, 95, 368, 1),
(354, 95, 369, 1),
(355, 95, 370, 1),
(356, 95, 371, 1),
(357, 95, 372, 1),
(358, 95, 373, 1),
(359, 95, 374, 1),
(360, 95, 375, 1),
(361, 95, 376, 1),
(362, 95, 377, 1),
(363, 95, 378, 1),
(364, 95, 379, 1),
(365, 95, 380, 1),
(366, 95, 381, 1),
(367, 95, 382, 1),
(368, 95, 383, 1),
(369, 95, 384, 1),
(370, 95, 385, 1),
(371, 95, 386, 1),
(372, 95, 387, 1),
(373, 95, 388, 1),
(381, 96, 396, 1),
(382, 96, 397, 1),
(383, 96, 398, 1),
(384, 96, 399, 1),
(385, 96, 400, 1),
(386, 96, 401, 1),
(387, 96, 402, 1),
(388, 96, 403, 1),
(389, 96, 404, 1),
(390, 96, 405, 1),
(391, 96, 406, 1),
(392, 96, 407, 1),
(393, 96, 408, 1),
(394, 96, 409, 1),
(395, 96, 410, 1),
(396, 96, 411, 1),
(397, 96, 412, 1),
(398, 96, 413, 1),
(399, 96, 414, 1),
(400, 96, 415, 1),
(401, 96, 416, 1),
(402, 96, 417, 1),
(403, 96, 418, 1),
(404, 96, 419, 1),
(405, 96, 420, 1),
(406, 96, 421, 1),
(407, 96, 422, 1),
(408, 96, 423, 1),
(409, 96, 424, 1),
(410, 96, 425, 1),
(411, 96, 426, 1),
(412, 96, 427, 1),
(413, 96, 428, 1),
(414, 96, 429, 1),
(415, 96, 430, 1),
(416, 96, 431, 1),
(417, 96, 432, 1),
(418, 96, 433, 1),
(419, 96, 434, 1),
(420, 96, 435, 1),
(421, 96, 436, 1),
(422, 96, 437, 1),
(423, 96, 438, 1),
(424, 96, 439, 1),
(425, 96, 440, 1),
(426, 96, 441, 1),
(427, 96, 442, 1),
(428, 96, 443, 1),
(429, 96, 444, 1),
(430, 96, 445, 1),
(431, 96, 446, 1),
(432, 96, 447, 1),
(433, 96, 448, 1),
(434, 96, 449, 1),
(435, 96, 450, 1),
(436, 96, 451, 1),
(444, 97, 459, 1),
(445, 97, 460, 1),
(446, 97, 461, 1),
(447, 97, 462, 1),
(448, 97, 463, 1),
(449, 97, 464, 1),
(450, 97, 465, 1),
(451, 97, 466, 1),
(452, 97, 467, 1),
(453, 97, 468, 1),
(454, 97, 469, 1),
(455, 97, 470, 1),
(456, 97, 471, 1),
(457, 97, 472, 1),
(458, 97, 473, 1),
(459, 97, 474, 1),
(460, 97, 475, 1),
(461, 97, 476, 1),
(462, 97, 477, 1),
(463, 97, 478, 1),
(464, 97, 479, 1),
(465, 97, 480, 1),
(466, 97, 481, 1),
(467, 97, 482, 1),
(468, 97, 483, 1),
(469, 97, 484, 1),
(470, 97, 485, 1),
(471, 97, 486, 1),
(472, 97, 487, 1),
(473, 97, 488, 1),
(474, 97, 489, 1),
(475, 97, 490, 1),
(476, 97, 491, 1),
(477, 97, 492, 1),
(478, 97, 493, 1),
(479, 97, 494, 1),
(480, 97, 495, 1),
(481, 97, 496, 1),
(482, 97, 497, 1),
(483, 97, 498, 1),
(484, 97, 499, 1),
(485, 97, 500, 1),
(486, 97, 501, 1),
(487, 97, 502, 1),
(488, 97, 503, 1),
(489, 97, 504, 1),
(490, 97, 505, 1),
(491, 97, 506, 1),
(492, 97, 507, 1),
(493, 97, 508, 1),
(494, 97, 509, 1),
(495, 97, 510, 1),
(496, 97, 511, 1),
(497, 97, 512, 1),
(498, 97, 513, 1),
(499, 97, 514, 1),
(507, 98, 522, 1),
(508, 98, 523, 1),
(509, 98, 524, 1),
(510, 98, 525, 1),
(511, 98, 526, 1),
(512, 98, 527, 1),
(513, 98, 528, 1),
(514, 98, 529, 1),
(515, 98, 530, 1),
(516, 98, 531, 1),
(517, 98, 532, 1),
(518, 98, 533, 1),
(519, 98, 534, 1),
(520, 98, 535, 1),
(521, 98, 536, 1),
(522, 98, 537, 1),
(523, 98, 538, 1),
(524, 98, 539, 1),
(525, 98, 540, 1),
(526, 98, 541, 1),
(527, 98, 542, 1),
(528, 98, 543, 1),
(529, 98, 544, 1),
(530, 98, 545, 1),
(531, 98, 546, 1),
(532, 98, 547, 1),
(533, 98, 548, 1),
(534, 98, 549, 1),
(535, 98, 550, 1),
(536, 98, 551, 1),
(537, 98, 552, 1),
(538, 98, 553, 1),
(539, 98, 554, 1),
(540, 98, 555, 1),
(541, 98, 556, 1),
(542, 98, 557, 1),
(543, 98, 558, 1),
(544, 98, 559, 1),
(545, 98, 560, 1),
(546, 98, 561, 1),
(547, 98, 562, 1),
(548, 98, 563, 1),
(549, 98, 564, 1),
(550, 98, 565, 1),
(551, 98, 566, 1),
(552, 98, 567, 1),
(553, 98, 568, 1),
(554, 98, 569, 1),
(555, 98, 570, 1),
(556, 98, 571, 1),
(557, 98, 572, 1),
(558, 98, 573, 1),
(559, 98, 574, 1),
(560, 98, 575, 1),
(561, 98, 576, 1),
(562, 98, 577, 1),
(570, 99, 585, 1),
(571, 99, 586, 1),
(572, 99, 587, 1),
(573, 99, 588, 1),
(574, 99, 589, 1),
(575, 99, 590, 1),
(576, 99, 591, 1),
(577, 99, 592, 1),
(578, 99, 593, 1),
(579, 99, 594, 1),
(580, 99, 595, 1),
(581, 99, 596, 1),
(582, 99, 597, 1),
(583, 99, 598, 1),
(584, 99, 599, 1),
(585, 99, 600, 1),
(586, 99, 601, 1),
(587, 99, 602, 1),
(588, 99, 603, 1),
(589, 99, 604, 1),
(590, 99, 605, 1),
(591, 99, 606, 1),
(592, 99, 607, 1),
(593, 99, 608, 1),
(594, 99, 609, 1),
(595, 99, 610, 1),
(596, 99, 611, 1),
(597, 99, 612, 1),
(598, 99, 613, 1),
(599, 99, 614, 1),
(600, 99, 615, 1),
(601, 99, 616, 1),
(602, 99, 617, 1),
(603, 99, 618, 1),
(604, 99, 619, 1),
(605, 99, 620, 1),
(606, 99, 621, 1),
(607, 99, 622, 1),
(608, 99, 623, 1),
(609, 99, 624, 1),
(610, 99, 625, 1),
(611, 99, 626, 1),
(612, 99, 627, 1),
(613, 99, 628, 1),
(614, 99, 629, 1),
(615, 99, 630, 1),
(616, 99, 631, 1),
(617, 99, 632, 1),
(618, 99, 633, 1),
(619, 99, 634, 1),
(620, 99, 635, 1),
(621, 99, 636, 1),
(622, 99, 637, 1),
(623, 99, 638, 1),
(624, 99, 639, 1),
(625, 99, 640, 1),
(633, 100, 648, 1),
(634, 100, 649, 1),
(635, 100, 650, 1),
(636, 100, 651, 1),
(637, 100, 652, 1),
(638, 100, 653, 1),
(639, 100, 654, 1),
(640, 100, 655, 1),
(641, 100, 656, 1),
(642, 100, 657, 1),
(643, 100, 658, 1),
(644, 100, 659, 1),
(645, 100, 660, 1),
(646, 100, 661, 1),
(647, 100, 662, 1),
(648, 100, 663, 1),
(649, 100, 664, 1),
(650, 100, 665, 1),
(651, 100, 666, 1),
(652, 100, 667, 1),
(653, 100, 668, 1),
(654, 100, 669, 1),
(655, 100, 670, 1),
(656, 100, 671, 1),
(657, 100, 672, 1),
(658, 100, 673, 1),
(659, 100, 674, 1),
(660, 100, 675, 1),
(661, 100, 676, 1),
(662, 100, 677, 1),
(663, 100, 678, 1),
(664, 100, 679, 1),
(665, 100, 680, 1),
(666, 100, 681, 1),
(667, 100, 682, 1),
(668, 100, 683, 1),
(669, 100, 684, 1),
(670, 100, 685, 1),
(671, 100, 686, 1),
(672, 100, 687, 1),
(673, 100, 688, 1),
(674, 100, 689, 1),
(675, 100, 690, 1),
(676, 100, 691, 1),
(677, 100, 692, 1),
(678, 100, 693, 1),
(679, 100, 694, 1),
(680, 100, 695, 1),
(681, 100, 696, 1),
(682, 100, 697, 1),
(683, 100, 698, 1),
(684, 100, 699, 1),
(685, 100, 700, 1),
(686, 100, 701, 1),
(687, 100, 702, 1),
(688, 100, 703, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbviagens_poltronas`
--

CREATE TABLE `tbviagens_poltronas` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `onibus` int(11) NOT NULL,
  `disponivel` tinyint(4) NOT NULL,
  `tipoServicoBPe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbviagens_poltronas`
--

INSERT INTO `tbviagens_poltronas` (`id`, `numero`, `onibus`, `disponivel`, `tipoServicoBPe`) VALUES
(32, 1, 14, 1, 3),
(33, 2, 14, 1, 3),
(34, 3, 14, 1, 3),
(35, 4, 14, 1, 3),
(36, 5, 14, 1, 3),
(37, 6, 14, 1, 3),
(38, 7, 14, 1, 3),
(39, 8, 14, 1, 3),
(40, 9, 14, 1, 3),
(41, 10, 14, 1, 3),
(42, 11, 14, 1, 3),
(43, 12, 14, 1, 3),
(44, 13, 14, 1, 3),
(45, 14, 14, 1, 3),
(46, 15, 14, 1, 3),
(47, 16, 14, 1, 3),
(48, 17, 14, 1, 3),
(49, 18, 14, 1, 3),
(50, 19, 14, 1, 3),
(51, 20, 14, 1, 3),
(52, 21, 14, 1, 3),
(53, 22, 14, 1, 3),
(54, 23, 14, 1, 3),
(55, 24, 14, 1, 3),
(56, 25, 14, 1, 3),
(57, 26, 14, 1, 3),
(58, 27, 14, 1, 3),
(59, 28, 14, 1, 3),
(60, 29, 14, 1, 3),
(61, 30, 14, 1, 3),
(62, 31, 14, 1, 3),
(63, 32, 14, 1, 3),
(64, 33, 14, 1, 3),
(65, 34, 14, 1, 3),
(66, 35, 14, 1, 3),
(67, 36, 14, 1, 3),
(68, 37, 14, 1, 3),
(69, 38, 14, 1, 3),
(70, 39, 14, 1, 3),
(71, 40, 14, 1, 3),
(72, 41, 14, 1, 3),
(73, 42, 14, 1, 3),
(74, 43, 14, 1, 3),
(75, 44, 14, 1, 3),
(76, 45, 14, 1, 3),
(77, 46, 14, 1, 3),
(78, 47, 14, 1, 3),
(79, 48, 14, 1, 3),
(80, 49, 14, 1, 3),
(81, 50, 14, 1, 3),
(82, 51, 14, 1, 3),
(83, 52, 14, 1, 3),
(84, 53, 14, 1, 3),
(85, 54, 14, 1, 3),
(86, 55, 14, 1, 3),
(87, 56, 14, 1, 3),
(88, 1, 15, 1, 3),
(89, 2, 15, 1, 3),
(90, 3, 15, 1, 3),
(91, 4, 15, 1, 3),
(92, 5, 15, 1, 3),
(93, 6, 15, 1, 3),
(94, 7, 15, 1, 3),
(95, 8, 15, 1, 3),
(96, 9, 15, 1, 3),
(97, 10, 15, 1, 3),
(98, 11, 15, 1, 3),
(99, 12, 15, 1, 3),
(100, 13, 15, 1, 3),
(101, 14, 15, 1, 3),
(102, 15, 15, 1, 3),
(103, 16, 15, 1, 3),
(104, 17, 15, 1, 3),
(105, 18, 15, 1, 3),
(106, 19, 15, 1, 3),
(107, 20, 15, 1, 3),
(108, 21, 15, 1, 3),
(109, 22, 15, 1, 3),
(110, 23, 15, 1, 3),
(111, 24, 15, 1, 3),
(112, 25, 15, 1, 3),
(113, 26, 15, 1, 3),
(114, 27, 15, 1, 3),
(115, 28, 15, 1, 3),
(116, 29, 15, 1, 3),
(117, 30, 15, 1, 3),
(118, 31, 15, 1, 3),
(119, 32, 15, 1, 3),
(120, 33, 15, 1, 3),
(121, 34, 15, 1, 3),
(122, 35, 15, 1, 3),
(123, 36, 15, 1, 3),
(124, 37, 15, 1, 3),
(125, 38, 15, 1, 3),
(126, 39, 15, 1, 3),
(127, 40, 15, 1, 3),
(128, 41, 15, 1, 3),
(129, 42, 15, 1, 3),
(130, 43, 15, 1, 3),
(131, 44, 15, 1, 3),
(132, 45, 15, 1, 3),
(133, 46, 15, 1, 3),
(134, 47, 15, 1, 3),
(135, 48, 15, 1, 3),
(136, 49, 15, 1, 3),
(137, 50, 15, 1, 3),
(138, 51, 15, 1, 3),
(139, 52, 15, 1, 3),
(140, 53, 15, 1, 3),
(141, 54, 15, 1, 3),
(142, 55, 15, 1, 3),
(143, 56, 15, 1, 3),
(333, 1, 19, 1, 3),
(334, 2, 19, 1, 3),
(335, 3, 19, 1, 3),
(336, 4, 19, 1, 3),
(337, 5, 19, 1, 3),
(338, 6, 19, 1, 3),
(339, 7, 19, 1, 3),
(340, 8, 19, 1, 3),
(341, 9, 19, 1, 3),
(342, 10, 19, 1, 3),
(343, 11, 19, 1, 3),
(344, 12, 19, 1, 3),
(345, 13, 19, 1, 3),
(346, 14, 19, 1, 3),
(347, 15, 19, 1, 3),
(348, 16, 19, 1, 3),
(349, 17, 19, 1, 3),
(350, 18, 19, 1, 3),
(351, 19, 19, 1, 3),
(352, 20, 19, 1, 3),
(353, 21, 19, 1, 3),
(354, 22, 19, 1, 3),
(355, 23, 19, 1, 3),
(356, 24, 19, 1, 3),
(357, 25, 19, 1, 3),
(358, 26, 19, 1, 3),
(359, 27, 19, 1, 3),
(360, 28, 19, 1, 3),
(361, 29, 19, 1, 3),
(362, 30, 19, 1, 3),
(363, 31, 19, 1, 3),
(364, 32, 19, 1, 3),
(365, 33, 19, 1, 3),
(366, 34, 19, 1, 3),
(367, 35, 19, 1, 3),
(368, 36, 19, 1, 3),
(369, 37, 19, 1, 3),
(370, 38, 19, 1, 3),
(371, 39, 19, 1, 3),
(372, 40, 19, 1, 3),
(373, 41, 19, 1, 3),
(374, 42, 19, 1, 3),
(375, 43, 19, 1, 3),
(376, 44, 19, 1, 3),
(377, 45, 19, 1, 3),
(378, 46, 19, 1, 3),
(379, 47, 19, 1, 3),
(380, 48, 19, 1, 3),
(381, 49, 19, 1, 3),
(382, 50, 19, 1, 3),
(383, 51, 19, 1, 3),
(384, 52, 19, 1, 3),
(385, 53, 19, 1, 3),
(386, 54, 19, 1, 3),
(387, 55, 19, 1, 3),
(388, 56, 19, 1, 3),
(396, 1, 20, 1, 3),
(397, 2, 20, 1, 3),
(398, 3, 20, 1, 3),
(399, 4, 20, 1, 3),
(400, 5, 20, 1, 3),
(401, 6, 20, 1, 3),
(402, 7, 20, 1, 3),
(403, 8, 20, 1, 3),
(404, 9, 20, 1, 3),
(405, 10, 20, 1, 3),
(406, 11, 20, 1, 3),
(407, 12, 20, 1, 3),
(408, 13, 20, 1, 3),
(409, 14, 20, 1, 3),
(410, 15, 20, 1, 3),
(411, 16, 20, 1, 3),
(412, 17, 20, 1, 3),
(413, 18, 20, 1, 3),
(414, 19, 20, 1, 3),
(415, 20, 20, 1, 3),
(416, 21, 20, 1, 3),
(417, 22, 20, 1, 3),
(418, 23, 20, 1, 3),
(419, 24, 20, 1, 3),
(420, 25, 20, 1, 3),
(421, 26, 20, 1, 3),
(422, 27, 20, 1, 3),
(423, 28, 20, 1, 3),
(424, 29, 20, 1, 3),
(425, 30, 20, 1, 3),
(426, 31, 20, 1, 3),
(427, 32, 20, 1, 3),
(428, 33, 20, 1, 3),
(429, 34, 20, 1, 3),
(430, 35, 20, 1, 3),
(431, 36, 20, 1, 3),
(432, 37, 20, 1, 3),
(433, 38, 20, 1, 3),
(434, 39, 20, 1, 3),
(435, 40, 20, 1, 3),
(436, 41, 20, 1, 3),
(437, 42, 20, 1, 3),
(438, 43, 20, 1, 3),
(439, 44, 20, 1, 3),
(440, 45, 20, 1, 3),
(441, 46, 20, 1, 3),
(442, 47, 20, 1, 3),
(443, 48, 20, 1, 3),
(444, 49, 20, 1, 3),
(445, 50, 20, 1, 3),
(446, 51, 20, 1, 3),
(447, 52, 20, 1, 3),
(448, 53, 20, 1, 3),
(449, 54, 20, 1, 3),
(450, 55, 20, 1, 3),
(451, 56, 20, 1, 3),
(459, 1, 21, 1, 3),
(460, 2, 21, 1, 3),
(461, 3, 21, 1, 3),
(462, 4, 21, 1, 3),
(463, 5, 21, 1, 3),
(464, 6, 21, 1, 3),
(465, 7, 21, 1, 3),
(466, 8, 21, 1, 3),
(467, 9, 21, 1, 3),
(468, 10, 21, 1, 3),
(469, 11, 21, 1, 3),
(470, 12, 21, 1, 3),
(471, 13, 21, 1, 3),
(472, 14, 21, 1, 3),
(473, 15, 21, 1, 3),
(474, 16, 21, 1, 3),
(475, 17, 21, 1, 3),
(476, 18, 21, 1, 3),
(477, 19, 21, 1, 3),
(478, 20, 21, 1, 3),
(479, 21, 21, 1, 3),
(480, 22, 21, 1, 3),
(481, 23, 21, 1, 3),
(482, 24, 21, 1, 3),
(483, 25, 21, 1, 3),
(484, 26, 21, 1, 3),
(485, 27, 21, 1, 3),
(486, 28, 21, 1, 3),
(487, 29, 21, 1, 3),
(488, 30, 21, 1, 3),
(489, 31, 21, 1, 3),
(490, 32, 21, 1, 3),
(491, 33, 21, 1, 3),
(492, 34, 21, 1, 3),
(493, 35, 21, 1, 3),
(494, 36, 21, 1, 3),
(495, 37, 21, 1, 3),
(496, 38, 21, 1, 3),
(497, 39, 21, 1, 3),
(498, 40, 21, 1, 3),
(499, 41, 21, 1, 3),
(500, 42, 21, 1, 3),
(501, 43, 21, 1, 3),
(502, 44, 21, 1, 3),
(503, 45, 21, 1, 3),
(504, 46, 21, 1, 3),
(505, 47, 21, 1, 3),
(506, 48, 21, 1, 3),
(507, 49, 21, 1, 3),
(508, 50, 21, 1, 3),
(509, 51, 21, 1, 3),
(510, 52, 21, 1, 3),
(511, 53, 21, 1, 3),
(512, 54, 21, 1, 3),
(513, 55, 21, 1, 3),
(514, 56, 21, 1, 3),
(522, 1, 22, 1, 3),
(523, 2, 22, 1, 3),
(524, 3, 22, 1, 3),
(525, 4, 22, 1, 3),
(526, 5, 22, 1, 3),
(527, 6, 22, 1, 3),
(528, 7, 22, 1, 3),
(529, 8, 22, 1, 3),
(530, 9, 22, 1, 3),
(531, 10, 22, 1, 3),
(532, 11, 22, 1, 3),
(533, 12, 22, 1, 3),
(534, 13, 22, 1, 3),
(535, 14, 22, 1, 3),
(536, 15, 22, 1, 3),
(537, 16, 22, 1, 3),
(538, 17, 22, 1, 3),
(539, 18, 22, 1, 3),
(540, 19, 22, 1, 3),
(541, 20, 22, 1, 3),
(542, 21, 22, 1, 3),
(543, 22, 22, 1, 3),
(544, 23, 22, 1, 3),
(545, 24, 22, 1, 3),
(546, 25, 22, 1, 3),
(547, 26, 22, 1, 3),
(548, 27, 22, 1, 3),
(549, 28, 22, 1, 3),
(550, 29, 22, 1, 3),
(551, 30, 22, 1, 3),
(552, 31, 22, 1, 3),
(553, 32, 22, 1, 3),
(554, 33, 22, 1, 3),
(555, 34, 22, 1, 3),
(556, 35, 22, 1, 3),
(557, 36, 22, 1, 3),
(558, 37, 22, 1, 3),
(559, 38, 22, 1, 3),
(560, 39, 22, 1, 3),
(561, 40, 22, 1, 3),
(562, 41, 22, 1, 3),
(563, 42, 22, 1, 3),
(564, 43, 22, 1, 3),
(565, 44, 22, 1, 3),
(566, 45, 22, 1, 3),
(567, 46, 22, 1, 3),
(568, 47, 22, 1, 3),
(569, 48, 22, 1, 3),
(570, 49, 22, 1, 3),
(571, 50, 22, 1, 3),
(572, 51, 22, 1, 3),
(573, 52, 22, 1, 3),
(574, 53, 22, 1, 3),
(575, 54, 22, 1, 3),
(576, 55, 22, 1, 3),
(577, 56, 22, 1, 3),
(585, 1, 23, 1, 3),
(586, 2, 23, 1, 3),
(587, 3, 23, 1, 3),
(588, 4, 23, 1, 3),
(589, 5, 23, 1, 3),
(590, 6, 23, 1, 3),
(591, 7, 23, 1, 3),
(592, 8, 23, 1, 3),
(593, 9, 23, 1, 3),
(594, 10, 23, 1, 3),
(595, 11, 23, 1, 3),
(596, 12, 23, 1, 3),
(597, 13, 23, 1, 3),
(598, 14, 23, 1, 3),
(599, 15, 23, 1, 3),
(600, 16, 23, 1, 3),
(601, 17, 23, 1, 3),
(602, 18, 23, 1, 3),
(603, 19, 23, 1, 3),
(604, 20, 23, 1, 3),
(605, 21, 23, 1, 3),
(606, 22, 23, 1, 3),
(607, 23, 23, 1, 3),
(608, 24, 23, 1, 3),
(609, 25, 23, 1, 3),
(610, 26, 23, 1, 3),
(611, 27, 23, 1, 3),
(612, 28, 23, 1, 3),
(613, 29, 23, 1, 3),
(614, 30, 23, 1, 3),
(615, 31, 23, 1, 3),
(616, 32, 23, 1, 3),
(617, 33, 23, 1, 3),
(618, 34, 23, 1, 3),
(619, 35, 23, 1, 3),
(620, 36, 23, 1, 3),
(621, 37, 23, 1, 3),
(622, 38, 23, 1, 3),
(623, 39, 23, 1, 3),
(624, 40, 23, 1, 3),
(625, 41, 23, 1, 3),
(626, 42, 23, 1, 3),
(627, 43, 23, 1, 3),
(628, 44, 23, 1, 3),
(629, 45, 23, 1, 3),
(630, 46, 23, 1, 3),
(631, 47, 23, 1, 3),
(632, 48, 23, 1, 3),
(633, 49, 23, 1, 3),
(634, 50, 23, 1, 3),
(635, 51, 23, 1, 3),
(636, 52, 23, 1, 3),
(637, 53, 23, 1, 3),
(638, 54, 23, 1, 3),
(639, 55, 23, 1, 3),
(640, 56, 23, 1, 3),
(648, 1, 24, 1, 3),
(649, 2, 24, 1, 3),
(650, 3, 24, 1, 3),
(651, 4, 24, 1, 3),
(652, 5, 24, 1, 3),
(653, 6, 24, 1, 3),
(654, 7, 24, 1, 3),
(655, 8, 24, 1, 3),
(656, 9, 24, 1, 3),
(657, 10, 24, 1, 3),
(658, 11, 24, 1, 3),
(659, 12, 24, 1, 3),
(660, 13, 24, 1, 3),
(661, 14, 24, 1, 3),
(662, 15, 24, 1, 3),
(663, 16, 24, 1, 3),
(664, 17, 24, 1, 3),
(665, 18, 24, 1, 3),
(666, 19, 24, 1, 3),
(667, 20, 24, 1, 3),
(668, 21, 24, 1, 3),
(669, 22, 24, 1, 3),
(670, 23, 24, 1, 3),
(671, 24, 24, 1, 3),
(672, 25, 24, 1, 3),
(673, 26, 24, 1, 3),
(674, 27, 24, 1, 3),
(675, 28, 24, 1, 3),
(676, 29, 24, 1, 3),
(677, 30, 24, 1, 3),
(678, 31, 24, 1, 3),
(679, 32, 24, 1, 3),
(680, 33, 24, 1, 3),
(681, 34, 24, 1, 3),
(682, 35, 24, 1, 3),
(683, 36, 24, 1, 3),
(684, 37, 24, 1, 3),
(685, 38, 24, 1, 3),
(686, 39, 24, 1, 3),
(687, 40, 24, 1, 3),
(688, 41, 24, 1, 3),
(689, 42, 24, 1, 3),
(690, 43, 24, 1, 3),
(691, 44, 24, 1, 3),
(692, 45, 24, 1, 3),
(693, 46, 24, 1, 3),
(694, 47, 24, 1, 3),
(695, 48, 24, 1, 3),
(696, 49, 24, 1, 3),
(697, 50, 24, 1, 3),
(698, 51, 24, 1, 3),
(699, 52, 24, 1, 3),
(700, 53, 24, 1, 3),
(701, 54, 24, 1, 3),
(702, 55, 24, 1, 3),
(703, 56, 24, 1, 3);

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
(57, '2', '2', 2, '1', '1', 1, 750, '08:00:00', '20:00:00'),
(58, '2', '2', 2, '1', '1', 1, 750, '09:00:00', '21:00:00'),
(62, '2', '2', 2, '1', '1', 1, 750, '08:00:00', '20:00:00'),
(63, '2', '2', 2, '1', '1', 1, 750, '08:00:00', '20:00:00'),
(64, '2', '2', 2, '1', '1', 1, 750, '08:00:00', '20:00:00'),
(65, '2', '2', 2, '1', '1', 1, 750, '08:00:00', '20:00:00'),
(66, '2', '2', 2, '1', '1', 1, 750, '08:00:00', '20:00:00'),
(67, '2', '2', 2, '1', '1', 1, 750, '08:00:00', '20:00:00');

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
(20, 'Tarifa Agosto 2018', '180.00', '140.00', '90.00', '0.00', '0.00'),
(21, 'Tarifa Agosto 2018', '180.00', '140.00', '90.00', '0.00', '0.00'),
(22, 'Tarifa Agosto 2018', '180.00', '140.00', '90.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbviagens_tributacao`
--

CREATE TABLE `tbviagens_tributacao` (
  `id` int(10) NOT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `icmsAliquota` float DEFAULT NULL,
  `outrosImpostos` float DEFAULT NULL,
  `CST` varchar(2) NOT NULL,
  `viagem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbviagens_tributacao`
--

INSERT INTO `tbviagens_tributacao` (`id`, `nome`, `icmsAliquota`, `outrosImpostos`, `CST`, `viagem`) VALUES
(1, 'Decreto AM-231', 17, 0, '', 99),
(2, 'Decreto RR 3512-2', 7, 0, '', 99),
(3, 'tributação normal ICMS - BPe', 12, 0, '00', 99),
(4, 'Decreto AM-231', 17, 0, '', 100),
(5, 'Decreto RR 3512-2', 7, 0, '', 100),
(6, 'tributação normal ICMS - BPe', 12, 0, '00', 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tptiposcomprador`
--

CREATE TABLE `tptiposcomprador` (
  `id` int(11) NOT NULL,
  `descricao` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tptiposcomprador`
--

INSERT INTO `tptiposcomprador` (`id`, `descricao`) VALUES
(0, 'Pessoa Física'),
(1, 'Pessoa Jurídica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tptiposcontribuicaoicms`
--

CREATE TABLE `tptiposcontribuicaoicms` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tptiposcontribuicaoicms`
--

INSERT INTO `tptiposcontribuicaoicms` (`id`, `descricao`) VALUES
(0, 'Nenhum'),
(1, 'Não é contribuinte do ICMS'),
(2, 'Contribuinte do ICMS'),
(3, 'É contribuinte do ICMS Isento de inscrição no cadastro de contribuintes do ICMS');

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
-- Indexes for table `tbpassagens_bpe`
--
ALTER TABLE `tbpassagens_bpe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passagem` (`passagem`);

--
-- Indexes for table `tbpassagens_comprador`
--
ALTER TABLE `tbpassagens_comprador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipoContribuicaoICMS` (`tipoContribuicaoICMS`),
  ADD KEY `passagem` (`passagem`);

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
  ADD KEY `onibus` (`onibus`),
  ADD KEY `tipoServico` (`tipoServico`);

--
-- Indexes for table `tbrotas`
--
ALTER TABLE `tbrotas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `origem` (`origem`);

--
-- Indexes for table `tbservicos`
--
ALTER TABLE `tbservicos`
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
  ADD KEY `onibus` (`onibus`),
  ADD KEY `tipoServico` (`tipoServicoBPe`);

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
-- Indexes for table `tbviagens_tributacao`
--
ALTER TABLE `tbviagens_tributacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tptiposcomprador`
--
ALTER TABLE `tptiposcomprador`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tptiposcontribuicaoicms`
--
ALTER TABLE `tptiposcontribuicaoicms`
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
-- AUTO_INCREMENT for table `tbpassagens_bpe`
--
ALTER TABLE `tbpassagens_bpe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbpassagens_comprador`
--
ALTER TABLE `tbpassagens_comprador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

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
-- AUTO_INCREMENT for table `tbservicos`
--
ALTER TABLE `tbservicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbtarifas`
--
ALTER TABLE `tbtarifas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbtributacao`
--
ALTER TABLE `tbtributacao`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbusuarios`
--
ALTER TABLE `tbusuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbviagem`
--
ALTER TABLE `tbviagem`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `tbviagens_motorista`
--
ALTER TABLE `tbviagens_motorista`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbviagens_onibus`
--
ALTER TABLE `tbviagens_onibus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbviagens_passagens`
--
ALTER TABLE `tbviagens_passagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=689;

--
-- AUTO_INCREMENT for table `tbviagens_poltronas`
--
ALTER TABLE `tbviagens_poltronas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=704;

--
-- AUTO_INCREMENT for table `tbviagens_rotas`
--
ALTER TABLE `tbviagens_rotas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbviagens_tarifas`
--
ALTER TABLE `tbviagens_tarifas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbviagens_tributacao`
--
ALTER TABLE `tbviagens_tributacao`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tbpassagens_bpe`
--
ALTER TABLE `tbpassagens_bpe`
  ADD CONSTRAINT `tbpassagens_bpe_ibfk_1` FOREIGN KEY (`passagem`) REFERENCES `tbviagens_passagens` (`id`);

--
-- Limitadores para a tabela `tbpassagens_comprador`
--
ALTER TABLE `tbpassagens_comprador`
  ADD CONSTRAINT `tbpassagens_comprador_ibfk_1` FOREIGN KEY (`tipoContribuicaoICMS`) REFERENCES `tptiposcontribuicaoicms` (`id`),
  ADD CONSTRAINT `tbpassagens_comprador_ibfk_2` FOREIGN KEY (`passagem`) REFERENCES `tbviagens_passagens` (`id`);

--
-- Limitadores para a tabela `tbpoltronas`
--
ALTER TABLE `tbpoltronas`
  ADD CONSTRAINT `tbpoltronas_ibfk_1` FOREIGN KEY (`onibus`) REFERENCES `tbonibus` (`id`),
  ADD CONSTRAINT `tbpoltronas_ibfk_2` FOREIGN KEY (`tipoServico`) REFERENCES `tbservicos` (`id`);

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
  ADD CONSTRAINT `tbviagens_poltronas_ibfk_1` FOREIGN KEY (`onibus`) REFERENCES `tbviagens_onibus` (`id`),
  ADD CONSTRAINT `tbviagens_poltronas_ibfk_2` FOREIGN KEY (`tipoServicoBPe`) REFERENCES `tbservicos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
