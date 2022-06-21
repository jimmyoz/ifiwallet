-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: localhost    Database: ette
-- ------------------------------------------------------
-- Server version	8.0.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bee_files`
--

DROP TABLE IF EXISTS `bee_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bee_files` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hash` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `filename` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `suffix` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `key` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `add_time` int DEFAULT NULL,
  `filesize` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `ip` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blocks` (
  `hash` char(66) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `number` bigint NOT NULL,
  `time` bigint NOT NULL,
  `parenthash` char(66) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `difficulty` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gasused` bigint NOT NULL,
  `gaslimit` bigint NOT NULL,
  `nonce` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `miner` char(42) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `size` float NOT NULL,
  `stateroothash` char(66) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `unclehash` char(66) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `txroothash` char(66) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `receiptroothash` char(66) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `extradata` blob,
  `inputdata` blob,
  `tx_num` int NOT NULL,
  PRIMARY KEY (`hash`) USING BTREE,
  UNIQUE KEY `number` (`number`) USING BTREE,
  UNIQUE KEY `number_2` (`number`) USING BTREE,
  KEY `idx_blocks_number` (`number`) USING BTREE,
  KEY `idx_blocks_time` (`time`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `city_names`
--

DROP TABLE IF EXISTS `city_names`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city_names` (
  `id` int NOT NULL AUTO_INCREMENT,
  `City` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `City_Admaster` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `City_EN` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Province` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Province_EN` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Region` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Tier` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=828 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `config_vars`
--

DROP TABLE IF EXISTS `config_vars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config_vars` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `value` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `delivery_history`
--

DROP TABLE IF EXISTS `delivery_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `delivery_history` (
  `id` char(36) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `client` char(42) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `endpoint` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `datalength` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `origin` char(42) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `index` bigint NOT NULL,
  `topics` blob,
  `data` blob,
  `txhash` char(66) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `blockhash` char(66) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  KEY `idx_events_origin` (`origin`) USING BTREE,
  KEY `idx_events_transaction_hash` (`txhash`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `idCodes`
--

DROP TABLE IF EXISTS `idCodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `idCodes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `last_date` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `idCode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ifi_award_counts`
--

DROP TABLE IF EXISTS `ifi_award_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ifi_award_counts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `times` int NOT NULL DEFAULT '0',
  `last_updated` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `address` (`address`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ifi_award_log`
--

DROP TABLE IF EXISTS `ifi_award_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ifi_award_log` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `node_address` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '节点地址',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0来源于CPU，1来源于voyager提现',
  `from_account` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT '激励来源账号',
  `ifi_amount` bigint DEFAULT NULL COMMENT '奖励数量',
  `timestamp` int DEFAULT NULL COMMENT '时间戳',
  `tx_hash` varchar(88) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '交易哈希',
  `ifi_balance` double DEFAULT '0',
  `status` int DEFAULT '0',
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=307393 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `update_nodes` AFTER INSERT ON `ifi_award_log` FOR EACH ROW begin

update nodes set total_reward=total_reward+new.ifi_amount,last_updated=current_timestamp()  where owner_address=new.node_address;

end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `ifi_award_type`
--

DROP TABLE IF EXISTS `ifi_award_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ifi_award_type` (
  `type` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ifi_transfer_records`
--

DROP TABLE IF EXISTS `ifi_transfer_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ifi_transfer_records` (
  `blockNumber` int NOT NULL,
  `transactionIndex` int NOT NULL,
  `contractAddress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `logIndex` int NOT NULL,
  `from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `value` double NOT NULL,
  PRIMARY KEY (`blockNumber`,`transactionIndex`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nodes`
--

DROP TABLE IF EXISTS `nodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nodes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `owner_address` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `chequebook_address` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cpu_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cpu_score` bigint DEFAULT NULL,
  `local_ip` varchar(55) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `incentive_reward` bigint NOT NULL DEFAULT '0' COMMENT 'voyager提现奖励',
  `total_reward` double NOT NULL DEFAULT '0' COMMENT '总奖励数量',
  `reward_30days` bigint NOT NULL DEFAULT '0' COMMENT '30天内奖励数量',
  `increase_ratio` int NOT NULL DEFAULT '0' COMMENT '增长幅度',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `location` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `logicalScore` double DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nodes_startup`
--

DROP TABLE IF EXISTS `nodes_startup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nodes_startup` (
  `id` int NOT NULL AUTO_INCREMENT,
  `owner_address` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `chequebook_address` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `local_ip` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `startup_time` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `index_owner_address` (`owner_address`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=181809 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `other_accounts`
--

DROP TABLE IF EXISTS `other_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `other_accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime(3) DEFAULT NULL,
  `updated_at` datetime(3) DEFAULT NULL,
  `deleted_at` datetime(3) DEFAULT NULL,
  `code` longtext,
  `price` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_product_deleted_at` (`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `signers`
--

DROP TABLE IF EXISTS `signers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `signers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `address` varchar(78) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ip` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `min_block` bigint NOT NULL DEFAULT '0' COMMENT '最小签名区块',
  `max_block` bigint NOT NULL DEFAULT '0' COMMENT '最大签名区块',
  `days7` bigint NOT NULL DEFAULT '0' COMMENT '7天内签名区块数量',
  `days30` bigint NOT NULL DEFAULT '0' COMMENT '30天内签名区块数量',
  `total_blocks` int NOT NULL DEFAULT '0' COMMENT '签名区块的总数量',
  `latitude` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `longitude` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created_time` datetime NOT NULL,
  `country` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `weight` double NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE,
  CONSTRAINT `signers_con1` CHECK ((`weight` >= 0))
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_details`
--

DROP TABLE IF EXISTS `subscription_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscription_details` (
  `address` char(42) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `subscriptionplan` int NOT NULL,
  PRIMARY KEY (`address`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_plans`
--

DROP TABLE IF EXISTS `subscription_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscription_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `deliverycount` bigint NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE,
  UNIQUE KEY `name` (`name`) USING BTREE,
  UNIQUE KEY `deliverycount` (`deliverycount`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `summaryOfDay`
--

DROP TABLE IF EXISTS `summaryOfDay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `summaryOfDay` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `trxCount` int NOT NULL DEFAULT '0',
  `accountsCount` int NOT NULL DEFAULT '0',
  `accountsIFI` int NOT NULL DEFAULT '0',
  `nodesCount` int NOT NULL DEFAULT '0',
  `nodesOnline` int NOT NULL DEFAULT '0',
  `givenIFI` double NOT NULL DEFAULT '0',
  `nodesNew` int NOT NULL DEFAULT '0',
  `totalScore` double NOT NULL DEFAULT '0',
  `dt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `hash` char(66) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `from` char(42) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `to` char(42) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `contract` char(42) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `data` blob,
  `input_data` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `gas` bigint NOT NULL,
  `gasprice` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cost` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nonce` bigint NOT NULL,
  `state` smallint NOT NULL,
  `blockhash` char(66) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `blockNumber` bigint NOT NULL DEFAULT '0',
  `timestamp` int DEFAULT NULL,
  PRIMARY KEY (`hash`) USING BTREE,
  KEY `idx_transactions_from` (`from`) USING BTREE,
  KEY `idx_transactions_to` (`to`) USING BTREE,
  KEY `idx_transactions_contract` (`contract`) USING BTREE,
  KEY `idx_transactions_nonce` (`nonce`) USING BTREE,
  KEY `idx_transactions_block_hash` (`blockhash`) USING BTREE,
  KEY `time_index` (`timestamp`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `transactions_dam`
--

DROP TABLE IF EXISTS `transactions_dam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions_dam` (
  `hash` char(66) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `from` char(42) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `to` char(42) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ifi_amount` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `timestamp` int DEFAULT NULL,
  PRIMARY KEY (`hash`) USING BTREE,
  KEY `idx_transactions_dam_from` (`from`) USING BTREE,
  KEY `idx_transactions_dam_to` (`to`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `address` char(42) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apikey` char(66) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `enabled` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`apikey`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-21  7:44:02
