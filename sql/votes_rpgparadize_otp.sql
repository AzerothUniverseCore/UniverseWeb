-- ----------------------------
-- Table structure for votes_rpgparadize_otp
-- ----------------------------
DROP TABLE IF EXISTS `votes_rpgparadize_otp`;
CREATE TABLE `votes_rpgparadize_otp`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idaccount` int(10) UNSIGNED NOT NULL,
  `idvote` int(10) UNSIGNED NOT NULL,
  `otp_token` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `requested_at` int(10) UNSIGNED NOT NULL,
  `expires_at` int(10) UNSIGNED NOT NULL,
  `status` enum('pending','verified','expired') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_status_expires`(`status`, `expires_at`) USING BTREE,
  INDEX `idx_account_vote`(`idaccount`, `idvote`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;
