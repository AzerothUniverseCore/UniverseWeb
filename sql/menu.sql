/*
 Navicat Premium Data Transfer

 Source Server         : Azeroth Universe VPS
 Source Server Type    : MariaDB
 Source Server Version : 100508
 Source Host           : 185.163.126.161:3309
 Source Schema         : auc_website

 Target Server Type    : MariaDB
 Target Server Version : 100508
 File Encoding         : 65001

 Date: 03/08/2026 04:23:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `url` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `icon` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `main` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `child` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `type` int(10) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 151 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, '〡Game', '#', 'fas fa-desktop', 2, 0, 1);
INSERT INTO `menu` VALUES (2, '〡Community', '#', 'fas fa-globe-europe', 2, 0, 1);
INSERT INTO `menu` VALUES (3, '〡Vote', 'vote', 'vp-icon', 1, 0, 1);
INSERT INTO `menu` VALUES (4, '〡Donate', 'donate', 'dp-icon', 1, 0, 1);
INSERT INTO `menu` VALUES (9, '〡Discord', 'https://discord.gg/yBnzhaJChf', 'fab fa-discord', 1, 2, 2);
INSERT INTO `menu` VALUES (10, '〡Forum', '#', 'fa fa-comments', 1, 2, 2);
INSERT INTO `menu` VALUES (11, '〡FAQ', '#', 'fa fa-question', 1, 2, 1);
INSERT INTO `menu` VALUES (12, '〡Azeroth Universe', 'download', 'fas fa-download', 1, 1, 1);
INSERT INTO `menu` VALUES (13, '〡Store', 'store', 'fas fa-store-alt', 1, 0, 1);
INSERT INTO `menu` VALUES (14, '〡Online Players', 'online', 'fas fa-globe-europe', 1, 2, 2);
INSERT INTO `menu` VALUES (15, '〡Azeroth Universe TV', 'https://www.youtube.com/@AzerothUniverseTV', 'fab fa-youtube', 1, 2, 2);
INSERT INTO `menu` VALUES (16, '〡FR', 'fr', 'fas fa-flag', 1, 0, 1);

-- ----------------------------
-- Table structure for menufr
-- ----------------------------
DROP TABLE IF EXISTS `menufr`;
CREATE TABLE `menufr`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `url` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `icon` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `main` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `child` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `type` int(10) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 151 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menufr
-- ----------------------------
INSERT INTO `menufr` VALUES (1, '〡Jeu', '#', 'fas fa-desktop', 2, 0, 1);
INSERT INTO `menufr` VALUES (2, '〡Communauté', '#', 'fas fa-globe-europe', 2, 0, 1);
INSERT INTO `menufr` VALUES (3, '〡Vote', 'vote', 'vp-icon', 1, 0, 1);
INSERT INTO `menufr` VALUES (4, '〡Don', 'donate', 'dp-icon', 1, 0, 1);
INSERT INTO `menufr` VALUES (9, '〡Discord', 'https://discord.gg/yBnzhaJChf', 'fab fa-discord', 1, 2, 2);
INSERT INTO `menufr` VALUES (10, '〡Forum', '#', 'fa fa-comments', 1, 2, 2);
INSERT INTO `menufr` VALUES (11, '〡FAQ', '#', 'fa fa-question', 1, 2, 1);
INSERT INTO `menufr` VALUES (12, '〡Azeroth Universe', 'download', 'fas fa-download', 1, 1, 1);
INSERT INTO `menufr` VALUES (13, '〡Boutique', 'store', 'fas fa-store-alt', 1, 0, 1);
INSERT INTO `menufr` VALUES (14, '〡Joueurs en ligne', 'online', 'fas fa-globe-europe', 1, 2, 2);
INSERT INTO `menufr` VALUES (15, '〡Azeroth Universe TV', 'https://www.youtube.com/@AzerothUniverseTV', 'fab fa-youtube', 1, 2, 2);
INSERT INTO `menufr` VALUES (16, '〡US', 'en', 'fas fa-flag', 1, 0, 1);

SET FOREIGN_KEY_CHECKS = 1;
