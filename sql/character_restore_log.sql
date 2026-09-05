-- A executer sur la base CIBLE des personnages (le groupe de connexion
-- 'characters' dans application/config/database.php, donc `auc_chars`
-- aujourd'hui / le nom que tu donneras a la nouvelle base).
--
-- Cette table journalise chaque restauration : elle sert de garde-fou pour
-- qu'un meme ancien personnage (identifie par son ancien guid) ne puisse
-- jamais etre restaure deux fois, meme si le joueur revient verifier son
-- ancien compte une seconde fois plus tard.

CREATE TABLE IF NOT EXISTS `character_restore_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `old_account_id` int(10) unsigned NOT NULL COMMENT 'id du compte sur l ancienne auc_auth (auth_old)',
  `old_character_guid` int(10) unsigned NOT NULL COMMENT 'guid du personnage sur l ancienne auc_chars (chars_old)',
  `old_character_name` varchar(12) NOT NULL,
  `new_account_id` int(10) unsigned NOT NULL COMMENT 'id du compte ACTUEL (auc_auth) qui a recupere le personnage',
  `new_character_guid` int(10) unsigned NOT NULL COMMENT 'guid attribue au personnage restaure sur la base live',
  `restored_at` datetime NOT NULL,
  `restored_ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_old_character_guid` (`old_character_guid`),
  KEY `idx_new_account_id` (`new_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Journal des restaurations de personnages (voir application/modules/restauration)';
