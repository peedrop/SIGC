-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sigc
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.30-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `start` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` VALUES (16,'abacate','2018-12-03');
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbcliente`
--

DROP TABLE IF EXISTS `tbcliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbcliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `dataNascimento` date NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `bairro` varchar(20) NOT NULL,
  `rua` varchar(20) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcliente`
--

LOCK TABLES `tbcliente` WRITE;
/*!40000 ALTER TABLE `tbcliente` DISABLE KEYS */;
INSERT INTO `tbcliente` VALUES (1,'Pedro Paulo Silva Filogonio','131.756.576-21','15.151.515','(54)16584-7848','2001-09-13','MG','Timóteo','Ana Rita','Portugal','35.182-260','384','Casa A'),(2,'Rafaela Oliveira de Souza','153.540656-90','15.151.515','(31)9920076-7848','2001-02-11','MG','Timóteo','Funcionários','Almir de Souza Ameno','35.180-412','151','Casa C'),(3,'Rosane Aparecida Batista Silva','025.437.186-80','15.151.515','(54)16584-7848','1975-08-06','MG','Timóteo','Novo Horizonte','76','35.180-306','231','Apartamento 201'),(4,'Gabriela Oliveira de Souza','497.751.960-43','15.151.515','(21)16584-7848','1996-02-10','MG','Coronel Fabriciano','Amaro Lanari','Portugal','35.206-260','34','Casa A');
/*!40000 ALTER TABLE `tbcliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbdespesa`
--

DROP TABLE IF EXISTS `tbdespesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbdespesa` (
  `idDespesa` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(2000) DEFAULT NULL,
  `dataVencimento` date NOT NULL,
  `valor` decimal(9,2) NOT NULL,
  `situacao` int(11) NOT NULL,
  PRIMARY KEY (`idDespesa`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbdespesa`
--

LOCK TABLES `tbdespesa` WRITE;
/*!40000 ALTER TABLE `tbdespesa` DISABLE KEYS */;
INSERT INTO `tbdespesa` VALUES (1,'Água','Urgente','2018-12-01',30.00,1),(2,'Aluguel','Urgente','2018-12-02',400.00,1),(4,'Faxinheira','abacate','2018-12-02',70.00,1),(7,'Luz','Urgente','2018-11-14',100.00,1);
/*!40000 ALTER TABLE `tbdespesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbmarca`
--

DROP TABLE IF EXISTS `tbmarca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbmarca` (
  `idMarca` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`idMarca`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbmarca`
--

LOCK TABLES `tbmarca` WRITE;
/*!40000 ALTER TABLE `tbmarca` DISABLE KEYS */;
INSERT INTO `tbmarca` VALUES (1,'Adidas'),(2,'Nike'),(3,'Puma'),(4,'Lacoste'),(5,'Adidas'),(6,'Nike'),(7,'Puma'),(8,'Lacoste');
/*!40000 ALTER TABLE `tbmarca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbparcela`
--

DROP TABLE IF EXISTS `tbparcela`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbparcela` (
  `idParcela` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(9,2) NOT NULL,
  `dataVencimento` date NOT NULL,
  `dataPagamento` date NOT NULL,
  `situacao` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  PRIMARY KEY (`idParcela`),
  KEY `idPedido` (`idPedido`),
  CONSTRAINT `tbparcela_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `tbpedido` (`idPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbparcela`
--

LOCK TABLES `tbparcela` WRITE;
/*!40000 ALTER TABLE `tbparcela` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbparcela` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbpedido`
--

DROP TABLE IF EXISTS `tbpedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbpedido` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `dataPedido` date NOT NULL,
  `horaPedido` time NOT NULL,
  `formaPagamento` int(11) NOT NULL,
  `parcelas` int(11) NOT NULL,
  `valor` decimal(9,2) NOT NULL,
  PRIMARY KEY (`idPedido`),
  KEY `idCliente` (`idCliente`),
  CONSTRAINT `tbpedido_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `tbcliente` (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpedido`
--

LOCK TABLES `tbpedido` WRITE;
/*!40000 ALTER TABLE `tbpedido` DISABLE KEYS */;
INSERT INTO `tbpedido` VALUES (13,1,'2018-11-06','00:36:00',1,1,70.00),(14,3,'2018-11-08','00:38:00',1,1,140.00),(15,4,'2018-11-10','00:36:00',2,1,36.00),(16,3,'2018-11-06','00:36:00',1,1,30.00),(19,3,'2018-12-01','21:34:00',3,1,24.00),(20,1,'2018-12-01','21:36:00',1,1,30.00),(21,4,'2018-12-01','21:36:00',2,1,60.00),(22,4,'2018-12-02','21:36:00',3,1,60.00),(23,1,'2018-12-02','02:04:00',2,1,250.00),(24,3,'2018-12-02','00:51:00',1,1,300.00),(25,3,'2018-12-02','03:11:00',3,1,150.00);
/*!40000 ALTER TABLE `tbpedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbpedidoproduto`
--

DROP TABLE IF EXISTS `tbpedidoproduto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbpedidoproduto` (
  `idPedidoProduto` int(11) NOT NULL AUTO_INCREMENT,
  `idPedido` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(9,2) NOT NULL,
  PRIMARY KEY (`idPedidoProduto`),
  KEY `idPedido` (`idPedido`),
  KEY `idProduto` (`idProduto`),
  CONSTRAINT `tbpedidoproduto_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `tbpedido` (`idPedido`),
  CONSTRAINT `tbpedidoproduto_ibfk_2` FOREIGN KEY (`idProduto`) REFERENCES `tbproduto` (`idProduto`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpedidoproduto`
--

LOCK TABLES `tbpedidoproduto` WRITE;
/*!40000 ALTER TABLE `tbpedidoproduto` DISABLE KEYS */;
INSERT INTO `tbpedidoproduto` VALUES (17,13,16,2,40.00),(18,14,17,4,120.00),(19,13,17,1,30.00),(20,14,16,1,20.00),(21,15,18,3,36.00),(22,19,18,2,24.00),(23,20,15,1,30.00),(24,21,17,2,60.00),(25,22,15,2,60.00),(26,23,15,5,250.00),(27,24,15,6,300.00),(28,25,15,3,150.00);
/*!40000 ALTER TABLE `tbpedidoproduto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbproduto`
--

DROP TABLE IF EXISTS `tbproduto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbproduto` (
  `idProduto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `idMarca` int(11) NOT NULL,
  `estoqueMin` int(11) NOT NULL,
  `descricao` varchar(300) DEFAULT NULL,
  `valor` decimal(9,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`idProduto`),
  KEY `idTipo` (`idTipo`),
  KEY `idMarca` (`idMarca`),
  CONSTRAINT `tbproduto_ibfk_1` FOREIGN KEY (`idTipo`) REFERENCES `tbtipo` (`idTipo`),
  CONSTRAINT `tbproduto_ibfk_2` FOREIGN KEY (`idMarca`) REFERENCES `tbmarca` (`idMarca`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbproduto`
--

LOCK TABLES `tbproduto` WRITE;
/*!40000 ALTER TABLE `tbproduto` DISABLE KEYS */;
INSERT INTO `tbproduto` VALUES (15,'Regata',1,1,5,'p',50.00,0),(16,'Longa',1,3,4,'p',20.00,2),(17,'Rodado',4,8,0,'p',30.00,1),(18,'Pezinho',3,7,10,'p',12.00,1);
/*!40000 ALTER TABLE `tbproduto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbremessa`
--

DROP TABLE IF EXISTS `tbremessa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbremessa` (
  `idRemessa` int(11) NOT NULL AUTO_INCREMENT,
  `idProduto` int(11) NOT NULL,
  `precoCusto` decimal(9,2) NOT NULL,
  `precoVarejo` decimal(9,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `dataRemessa` date NOT NULL,
  PRIMARY KEY (`idRemessa`),
  KEY `idProduto` (`idProduto`),
  CONSTRAINT `tbremessa_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `tbproduto` (`idProduto`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbremessa`
--

LOCK TABLES `tbremessa` WRITE;
/*!40000 ALTER TABLE `tbremessa` DISABLE KEYS */;
INSERT INTO `tbremessa` VALUES (22,18,2.00,5.00,4,'2018-11-08'),(23,15,15.00,30.00,8,'2018-11-10'),(24,17,20.00,50.00,2,'2018-12-02'),(25,18,6.00,12.00,2,'2018-11-10'),(26,17,15.00,30.00,6,'2018-11-10'),(27,15,20.00,50.00,10,'2018-12-02');
/*!40000 ALTER TABLE `tbremessa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbtipo`
--

DROP TABLE IF EXISTS `tbtipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbtipo` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipo`
--

LOCK TABLES `tbtipo` WRITE;
/*!40000 ALTER TABLE `tbtipo` DISABLE KEYS */;
INSERT INTO `tbtipo` VALUES (1,'Blusa'),(2,'Calça'),(3,'Meia'),(4,'Vestido'),(5,'Blusa'),(6,'Calça'),(7,'Meia'),(8,'Vestido');
/*!40000 ALTER TABLE `tbtipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbusuario`
--

DROP TABLE IF EXISTS `tbusuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbusuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbusuario`
--

LOCK TABLES `tbusuario` WRITE;
/*!40000 ALTER TABLE `tbusuario` DISABLE KEYS */;
INSERT INTO `tbusuario` VALUES (1,'admin','admin','admin@gmail.com'),(2,'rafa','rafa','rafa@gmail.com'),(3,'pedro','pedro','pedro@gmail.com'),(4,'ines','ines','ines@gmail.com');
/*!40000 ALTER TABLE `tbusuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'sigc'
--

--
-- Dumping routines for database 'sigc'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-03 19:27:45
