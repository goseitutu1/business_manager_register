/*
 Navicat Premium Data Transfer

 Source Server         : S4
 Source Server Type    : MySQL
 Source Server Version : 50723
 Source Host           : 144.76.58.179:3306
 Source Schema         : light_erp

 Target Server Type    : MySQL
 Target Server Version : 50723
 File Encoding         : 65001

 Date: 13/10/2020 18:31:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for survey_notifications
-- ----------------------------
DROP TABLE IF EXISTS `survey_notifications`;
CREATE TABLE `survey_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` text COLLATE utf8mb4_unicode_ci,
  `is_sms_sent` tinyint(1) NOT NULL DEFAULT '0',
  `is_email_sent` tinyint(1) NOT NULL DEFAULT '0',
  `sent_at` datetime DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of survey_notifications
-- ----------------------------
BEGIN;
INSERT INTO `survey_notifications` VALUES (1, '2020-09-02 14:15:32', '2020-09-02 14:15:32', NULL, 'pending', 0, 0, NULL, 1175);
INSERT INTO `survey_notifications` VALUES (2, '2020-09-04 13:28:24', '2020-09-04 13:28:24', NULL, 'pending', 0, 0, NULL, 1176);
INSERT INTO `survey_notifications` VALUES (3, '2020-09-04 22:39:38', '2020-09-04 22:39:38', NULL, 'pending', 0, 0, NULL, 1177);
INSERT INTO `survey_notifications` VALUES (4, '2020-09-07 09:37:18', '2020-09-07 09:37:18', NULL, 'pending', 0, 0, NULL, 1179);
INSERT INTO `survey_notifications` VALUES (5, '2020-09-07 11:26:23', '2020-09-07 11:26:23', NULL, 'pending', 0, 0, NULL, 1180);
INSERT INTO `survey_notifications` VALUES (6, '2020-09-08 08:28:27', '2020-09-08 08:28:27', NULL, 'pending', 0, 0, NULL, 1182);
INSERT INTO `survey_notifications` VALUES (7, '2020-09-08 09:11:28', '2020-09-08 09:11:28', NULL, 'pending', 0, 0, NULL, 1184);
INSERT INTO `survey_notifications` VALUES (8, '2020-09-08 09:11:33', '2020-09-08 09:11:33', NULL, 'pending', 0, 0, NULL, 1185);
INSERT INTO `survey_notifications` VALUES (9, '2020-09-08 09:29:20', '2020-09-08 09:29:20', NULL, 'pending', 0, 0, NULL, 1186);
INSERT INTO `survey_notifications` VALUES (10, '2020-09-08 09:55:43', '2020-09-08 09:55:43', NULL, 'pending', 0, 0, NULL, 1187);
INSERT INTO `survey_notifications` VALUES (11, '2020-09-08 17:52:41', '2020-09-08 17:52:41', NULL, 'pending', 0, 0, NULL, 1203);
INSERT INTO `survey_notifications` VALUES (12, '2020-09-08 19:54:33', '2020-09-08 19:54:33', NULL, 'pending', 0, 0, NULL, 1204);
INSERT INTO `survey_notifications` VALUES (13, '2020-09-08 20:03:18', '2020-09-08 20:03:18', NULL, 'pending', 0, 0, NULL, 1205);
INSERT INTO `survey_notifications` VALUES (14, '2020-09-08 20:33:59', '2020-09-08 20:33:59', NULL, 'pending', 0, 0, NULL, 1206);
INSERT INTO `survey_notifications` VALUES (15, '2020-09-09 18:26:09', '2020-09-09 18:26:09', NULL, 'pending', 0, 0, NULL, 1213);
INSERT INTO `survey_notifications` VALUES (16, '2020-09-09 20:54:17', '2020-09-09 20:54:17', NULL, 'pending', 0, 0, NULL, 1215);
INSERT INTO `survey_notifications` VALUES (17, '2020-09-10 01:26:18', '2020-09-10 01:26:18', NULL, 'pending', 0, 0, NULL, 1217);
INSERT INTO `survey_notifications` VALUES (18, '2020-09-10 12:17:49', '2020-09-10 12:17:49', NULL, 'pending', 0, 0, NULL, 1219);
INSERT INTO `survey_notifications` VALUES (19, '2020-09-10 12:41:41', '2020-09-10 12:41:41', NULL, 'pending', 0, 0, NULL, 1220);
INSERT INTO `survey_notifications` VALUES (20, '2020-09-10 21:19:49', '2020-09-10 21:19:49', NULL, 'pending', 0, 0, NULL, 1224);
INSERT INTO `survey_notifications` VALUES (21, '2020-09-10 23:38:24', '2020-09-10 23:38:24', NULL, 'pending', 0, 0, NULL, 1225);
INSERT INTO `survey_notifications` VALUES (22, '2020-09-11 08:36:24', '2020-09-11 08:36:24', NULL, 'pending', 0, 0, NULL, 1230);
INSERT INTO `survey_notifications` VALUES (23, '2020-09-12 16:01:01', '2020-09-12 16:01:01', NULL, 'pending', 0, 0, NULL, 1240);
INSERT INTO `survey_notifications` VALUES (24, '2020-09-13 20:33:23', '2020-09-13 20:33:23', NULL, 'pending', 0, 0, NULL, 1247);
INSERT INTO `survey_notifications` VALUES (25, '2020-09-13 22:20:59', '2020-09-13 22:20:59', NULL, 'pending', 0, 0, NULL, 1248);
INSERT INTO `survey_notifications` VALUES (26, '2020-09-13 23:21:52', '2020-09-13 23:21:52', NULL, 'pending', 0, 0, NULL, 1249);
INSERT INTO `survey_notifications` VALUES (27, '2020-09-15 10:01:52', '2020-09-15 10:01:52', NULL, 'pending', 0, 0, NULL, 1254);
INSERT INTO `survey_notifications` VALUES (28, '2020-09-15 18:41:43', '2020-09-15 18:41:43', NULL, 'pending', 0, 0, NULL, 1256);
INSERT INTO `survey_notifications` VALUES (29, '2020-09-15 20:16:23', '2020-09-15 20:16:23', NULL, 'pending', 0, 0, NULL, 1259);
INSERT INTO `survey_notifications` VALUES (30, '2020-09-17 18:32:51', '2020-09-17 18:32:51', NULL, 'pending', 0, 0, NULL, 1263);
INSERT INTO `survey_notifications` VALUES (31, '2020-09-18 09:34:59', '2020-09-18 09:34:59', NULL, 'pending', 0, 0, NULL, 1266);
INSERT INTO `survey_notifications` VALUES (32, '2020-09-18 14:52:19', '2020-09-18 14:52:19', NULL, 'pending', 0, 0, NULL, 1268);
INSERT INTO `survey_notifications` VALUES (33, '2020-09-19 20:28:23', '2020-09-19 20:28:23', NULL, 'pending', 0, 0, NULL, 1269);
INSERT INTO `survey_notifications` VALUES (34, '2020-09-21 09:47:55', '2020-09-21 09:47:55', NULL, 'pending', 0, 0, NULL, 1271);
INSERT INTO `survey_notifications` VALUES (35, '2020-09-22 07:21:44', '2020-09-22 07:21:44', NULL, 'pending', 0, 0, NULL, 1272);
INSERT INTO `survey_notifications` VALUES (36, '2020-09-22 17:03:28', '2020-09-22 17:03:28', NULL, 'pending', 0, 0, NULL, 1277);
INSERT INTO `survey_notifications` VALUES (37, '2020-09-23 09:38:23', '2020-09-23 09:38:23', NULL, 'pending', 0, 0, NULL, 1279);
INSERT INTO `survey_notifications` VALUES (38, '2020-09-23 11:42:21', '2020-09-23 11:42:21', NULL, 'pending', 0, 0, NULL, 1280);
INSERT INTO `survey_notifications` VALUES (39, '2020-09-23 13:28:24', '2020-09-23 13:28:24', NULL, 'pending', 0, 0, NULL, 1281);
INSERT INTO `survey_notifications` VALUES (40, '2020-09-23 22:50:49', '2020-09-23 22:50:49', NULL, 'pending', 0, 0, NULL, 1282);
INSERT INTO `survey_notifications` VALUES (41, '2020-09-24 06:39:56', '2020-09-24 06:39:56', NULL, 'pending', 0, 0, NULL, 1283);
INSERT INTO `survey_notifications` VALUES (42, '2020-09-25 06:55:18', '2020-09-25 06:55:18', NULL, 'pending', 0, 0, NULL, 1285);
INSERT INTO `survey_notifications` VALUES (43, '2020-09-25 08:50:28', '2020-09-25 08:50:28', NULL, 'pending', 0, 0, NULL, 1286);
INSERT INTO `survey_notifications` VALUES (44, '2020-09-25 09:47:23', '2020-09-25 09:47:23', NULL, 'pending', 0, 0, NULL, 1287);
INSERT INTO `survey_notifications` VALUES (45, '2020-09-25 11:11:17', '2020-09-25 11:11:17', NULL, 'pending', 0, 0, NULL, 1288);
INSERT INTO `survey_notifications` VALUES (46, '2020-09-25 12:27:26', '2020-09-25 12:27:26', NULL, 'pending', 0, 0, NULL, 1289);
INSERT INTO `survey_notifications` VALUES (47, '2020-09-25 13:28:33', '2020-09-25 13:28:33', NULL, 'pending', 0, 0, NULL, 1290);
INSERT INTO `survey_notifications` VALUES (48, '2020-09-25 13:37:36', '2020-09-25 13:37:36', NULL, 'pending', 0, 0, NULL, 1291);
INSERT INTO `survey_notifications` VALUES (49, '2020-09-25 21:02:49', '2020-09-25 21:02:49', NULL, 'pending', 0, 0, NULL, 1292);
INSERT INTO `survey_notifications` VALUES (50, '2020-09-26 07:38:46', '2020-09-26 07:38:46', NULL, 'pending', 0, 0, NULL, 1295);
INSERT INTO `survey_notifications` VALUES (51, '2020-09-26 16:30:31', '2020-09-26 16:30:31', NULL, 'pending', 0, 0, NULL, 1296);
INSERT INTO `survey_notifications` VALUES (52, '2020-09-28 00:15:36', '2020-09-28 00:15:36', NULL, 'pending', 0, 0, NULL, 1298);
INSERT INTO `survey_notifications` VALUES (53, '2020-09-28 14:06:19', '2020-09-28 14:06:19', NULL, 'pending', 0, 0, NULL, 1301);
INSERT INTO `survey_notifications` VALUES (54, '2020-09-28 15:04:33', '2020-09-28 15:04:33', NULL, 'pending', 0, 0, NULL, 1302);
INSERT INTO `survey_notifications` VALUES (55, '2020-09-28 17:37:20', '2020-09-28 17:37:20', NULL, 'pending', 0, 0, NULL, 1303);
INSERT INTO `survey_notifications` VALUES (56, '2020-09-28 20:39:21', '2020-09-28 20:39:21', NULL, 'pending', 0, 0, NULL, 1305);
INSERT INTO `survey_notifications` VALUES (57, '2020-09-28 21:53:19', '2020-09-28 21:53:19', NULL, 'pending', 0, 0, NULL, 1306);
INSERT INTO `survey_notifications` VALUES (58, '2020-09-28 23:06:24', '2020-09-28 23:06:24', NULL, 'pending', 0, 0, NULL, 1307);
INSERT INTO `survey_notifications` VALUES (59, '2020-09-28 23:15:02', '2020-09-28 23:15:02', NULL, 'pending', 0, 0, NULL, 1308);
INSERT INTO `survey_notifications` VALUES (60, '2020-09-29 06:23:12', '2020-09-29 06:23:12', NULL, 'pending', 0, 0, NULL, 1309);
INSERT INTO `survey_notifications` VALUES (61, '2020-09-29 07:04:31', '2020-09-29 07:04:31', NULL, 'pending', 0, 0, NULL, 1310);
INSERT INTO `survey_notifications` VALUES (62, '2020-09-30 15:21:50', '2020-09-30 15:21:50', NULL, 'pending', 0, 0, NULL, 1311);
INSERT INTO `survey_notifications` VALUES (63, '2020-09-30 16:26:32', '2020-09-30 16:26:32', NULL, 'pending', 0, 0, NULL, 1312);
INSERT INTO `survey_notifications` VALUES (64, '2020-10-01 03:10:59', '2020-10-01 03:10:59', NULL, 'pending', 0, 0, NULL, 1314);
INSERT INTO `survey_notifications` VALUES (65, '2020-10-01 03:10:59', '2020-10-01 03:10:59', NULL, 'pending', 0, 0, NULL, 1313);
INSERT INTO `survey_notifications` VALUES (66, '2020-10-01 06:17:12', '2020-10-01 06:17:12', NULL, 'pending', 0, 0, NULL, 1315);
INSERT INTO `survey_notifications` VALUES (67, '2020-10-01 21:27:17', '2020-10-01 21:27:17', NULL, 'pending', 0, 0, NULL, 1318);
INSERT INTO `survey_notifications` VALUES (68, '2020-10-02 01:51:38', '2020-10-02 01:51:38', NULL, 'pending', 0, 0, NULL, 1319);
INSERT INTO `survey_notifications` VALUES (69, '2020-10-06 11:41:31', '2020-10-06 11:41:31', NULL, 'pending', 0, 0, NULL, 1322);
INSERT INTO `survey_notifications` VALUES (70, '2020-10-08 10:27:38', '2020-10-08 10:27:38', NULL, 'pending', 0, 0, NULL, 1329);
INSERT INTO `survey_notifications` VALUES (71, '2020-10-08 10:40:24', '2020-10-08 10:40:24', NULL, 'pending', 0, 0, NULL, 1331);
INSERT INTO `survey_notifications` VALUES (72, '2020-10-08 10:40:24', '2020-10-08 10:40:24', NULL, 'pending', 0, 0, NULL, 1330);
INSERT INTO `survey_notifications` VALUES (73, '2020-10-08 10:40:24', '2020-10-08 10:40:24', NULL, 'pending', 0, 0, NULL, 1332);
INSERT INTO `survey_notifications` VALUES (74, '2020-10-08 10:43:18', '2020-10-08 10:43:18', NULL, 'pending', 0, 0, NULL, 1333);
INSERT INTO `survey_notifications` VALUES (75, '2020-10-08 11:43:25', '2020-10-08 11:43:25', NULL, 'pending', 0, 0, NULL, 1336);
INSERT INTO `survey_notifications` VALUES (76, '2020-10-09 16:22:20', '2020-10-09 16:22:20', NULL, 'pending', 0, 0, NULL, 1338);
INSERT INTO `survey_notifications` VALUES (77, '2020-10-09 22:44:30', '2020-10-09 22:44:30', NULL, 'pending', 0, 0, NULL, 1339);
INSERT INTO `survey_notifications` VALUES (78, '2020-10-11 04:15:43', '2020-10-11 04:15:43', NULL, 'pending', 0, 0, NULL, 1340);
INSERT INTO `survey_notifications` VALUES (79, '2020-10-11 13:11:26', '2020-10-11 13:11:26', NULL, 'pending', 0, 0, NULL, 1343);
INSERT INTO `survey_notifications` VALUES (80, '2020-10-11 17:13:18', '2020-10-11 17:13:18', NULL, 'pending', 0, 0, NULL, 1344);
INSERT INTO `survey_notifications` VALUES (81, '2020-10-11 21:24:59', '2020-10-11 21:24:59', NULL, 'pending', 0, 0, NULL, 1345);
INSERT INTO `survey_notifications` VALUES (82, '2020-10-11 23:30:05', '2020-10-11 23:30:05', NULL, 'pending', 0, 0, NULL, 1347);
INSERT INTO `survey_notifications` VALUES (83, '2020-10-13 18:04:20', '2020-10-13 18:04:20', NULL, 'pending', 0, 0, NULL, 1351);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
