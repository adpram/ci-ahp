/*
 Navicat Premium Data Transfer

 Source Server         : localhost-mysql
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : 127.0.0.1:3306
 Source Schema         : ci-ahp

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 23/12/2021 16:43:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for kriteria
-- ----------------------------
DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria`  (
  `id_kriteria` bigint(255) NOT NULL AUTO_INCREMENT,
  `kode_kriteria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_kriteria` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nilai_kriteria` int(255) NOT NULL,
  PRIMARY KEY (`id_kriteria`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kriteria
-- ----------------------------
INSERT INTO `kriteria` VALUES (1, 'K01', 'Jarak berapa persen dari open ke high', 1);
INSERT INTO `kriteria` VALUES (2, 'K02', 'Jarak berapa persen dari open ke low', 2);
INSERT INTO `kriteria` VALUES (3, 'K03', 'Jarak berapa persen dari open ke close', 3);
INSERT INTO `kriteria` VALUES (4, 'K04', 'Volume transaksi', 5);
INSERT INTO `kriteria` VALUES (5, 'K05', 'Market Cap', 7);

-- ----------------------------
-- Table structure for pengguna
-- ----------------------------
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
INSERT INTO `pengguna` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for saham
-- ----------------------------
DROP TABLE IF EXISTS `saham`;
CREATE TABLE `saham`  (
  `id_saham` bigint(255) NOT NULL AUTO_INCREMENT,
  `kode_saham` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `saham` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `open` int(255) NULL DEFAULT NULL,
  `high` int(255) NULL DEFAULT NULL,
  `low` int(255) NULL DEFAULT NULL,
  `close` int(255) NULL DEFAULT NULL,
  `volume` bigint(255) NULL DEFAULT NULL,
  `market_cap` bigint(255) NULL DEFAULT NULL,
  `open_ke_high` double(10, 3) NULL DEFAULT NULL,
  `open_ke_low` double(10, 3) NULL DEFAULT NULL,
  `open_ke_close` double(10, 3) NULL DEFAULT NULL,
  PRIMARY KEY (`id_saham`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of saham
-- ----------------------------
INSERT INTO `saham` VALUES (1, 'SO1', 'ADRO', '2021-09-01', 1280, 1805, 1275, 1760, 2900000000, 59650000000000, 29.086, -0.392, 27.273);
INSERT INTO `saham` VALUES (2, 'SO2', 'ITMG', '2021-09-01', 16000, 17750, 15075, 16000, 91000000, 28980000000000, 9.859, -6.136, 0.000);
INSERT INTO `saham` VALUES (3, 'SO3', 'PTBA', '2021-09-01', 2150, 2790, 2150, 2760, 931000000, 32720000000000, 22.939, 0.000, 22.101);

-- ----------------------------
-- Table structure for subkriteria
-- ----------------------------
DROP TABLE IF EXISTS `subkriteria`;
CREATE TABLE `subkriteria`  (
  `id_sub_kriteria` bigint(255) NOT NULL AUTO_INCREMENT,
  `kriteria_id` int(11) NOT NULL,
  `kode_sub_kriteria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `simbol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sub_kriteria_satu` bigint(255) NULL DEFAULT NULL,
  `sub_kriteria_dua` bigint(255) NULL DEFAULT NULL,
  `persen` tinyint(255) NULL DEFAULT 0,
  `nilai_sub_kriteria` int(255) NOT NULL,
  PRIMARY KEY (`id_sub_kriteria`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subkriteria
-- ----------------------------
INSERT INTO `subkriteria` VALUES (18, 1, 'A01', '<', 10, 0, 1, 1);
INSERT INTO `subkriteria` VALUES (19, 1, 'A02', '', 10, 25, 1, 3);
INSERT INTO `subkriteria` VALUES (21, 1, 'A03', '>', 25, 0, 1, 5);
INSERT INTO `subkriteria` VALUES (22, 2, 'B01', '>', -5, 0, 1, 5);
INSERT INTO `subkriteria` VALUES (23, 2, 'B02', '', -10, -5, 1, 3);
INSERT INTO `subkriteria` VALUES (24, 2, 'B03', '<', -10, 0, 1, 1);
INSERT INTO `subkriteria` VALUES (25, 3, 'C01', '<', 10, 0, 1, 3);
INSERT INTO `subkriteria` VALUES (26, 3, 'C02', '', 10, 25, 1, 5);
INSERT INTO `subkriteria` VALUES (27, 3, 'C03', '>', 25, 0, 1, 7);
INSERT INTO `subkriteria` VALUES (28, 4, 'D01', '<', 500000000, 0, NULL, 1);
INSERT INTO `subkriteria` VALUES (29, 4, 'D02', '', 500000000, 1000000000, NULL, 3);
INSERT INTO `subkriteria` VALUES (30, 4, 'D03', '>', 1000000000, 0, NULL, 5);
INSERT INTO `subkriteria` VALUES (31, 5, 'E01', '<', 20000000000000, 0, NULL, 3);
INSERT INTO `subkriteria` VALUES (32, 5, 'E02', '', 20000000000000, 50000000000000, NULL, 5);
INSERT INTO `subkriteria` VALUES (33, 5, 'E03', '>', 50000000000000, 0, NULL, 7);

SET FOREIGN_KEY_CHECKS = 1;
