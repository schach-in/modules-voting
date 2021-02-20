/**
 * Zugzwang Project
 * SQL for installation of ted module
 *
 * http://www.zugzwang.org/modules/ted
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2021 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


CREATE TABLE `questions` (
  `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `votes` (
  `vote_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `voter_cookie` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vote_date` datetime NOT NULL,
  PRIMARY KEY (`vote_id`),
  KEY `question_id` (`question_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'questions', 'question_id', (SELECT DATABASE()), 'votes', 'vote_id', 'question_id', 'no-delete');
