/*
 Navicat Premium Data Transfer

 Source Server         : localhost-mysql
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : ci-ahp

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 14/10/2021 00:38:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for alternatif
-- ----------------------------
DROP TABLE IF EXISTS `alternatif`;
CREATE TABLE `alternatif`  (
  `id_alternatif` bigint(255) NOT NULL AUTO_INCREMENT,
  `kode_alternatif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_alternatif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_alternatif`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of alternatif
-- ----------------------------
INSERT INTO `alternatif` VALUES (1, 'S01', 'ADRO');
INSERT INTO `alternatif` VALUES (2, 'S02', 'ITMG');
INSERT INTO `alternatif` VALUES (4, 'S03', 'PTBA');

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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kriteria
-- ----------------------------
INSERT INTO `kriteria` VALUES (1, 'K01', 'Jarak berapa persen dari open ke high\r\n', 1);
INSERT INTO `kriteria` VALUES (2, 'K02', 'Jarak berapa persen dari open ke low', 2);
INSERT INTO `kriteria` VALUES (3, 'K03', 'Jarak berapa persen dari open ke close', 3);
INSERT INTO `kriteria` VALUES (4, 'K04', 'Volume transaksi', 5);
INSERT INTO `kriteria` VALUES (5, 'K05', 'Market Cap', 7);

SET FOREIGN_KEY_CHECKS = 1;
