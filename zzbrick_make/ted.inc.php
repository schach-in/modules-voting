<?php 

/**
 * voting module
 * actual voting
 *
 * https://www.zugzwang.org/modules/voting
 * Part of »Zugzwang Project«
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2019 Gustaf Mossakowski
 */


function mod_ted_ted() {
	global $zz_setting;
	$zz_setting['cache'] = false;
	session_start();
	$_SESSION['question'] = 'test';
	
	$sql = 'SELECT question_id, question FROM questions
		WHERE active = "yes" LIMIT 1';
	$data = wrap_db_fetch($sql);
	if (!$data) $data['no_active_question'] = true;

	$sql = 'SELECT * FROM votes WHERE question_id = %d AND voter_cookie ="%s"';
	$sql = sprintf($sql, $data['question_id'], $_COOKIE['PHPSESSID']);
	$answer = wrap_db_fetch($sql);
	if ($answer) {
		$data['already_voted'] = true;
	}
	
	if (!$answer AND !empty($_POST)) {
		if ($_POST['question_id'] !== $data['question_id']) {
			$data['voted_for_different_question'] = true;
		} else {
			$sql = 'INSERT INTO votes (question_id, voter_cookie, answer, vote_date) VALUES (%d, "%s", "%s", "%s")';
			$sql = sprintf($sql, $_POST['question_id'], $_COOKIE['PHPSESSID'], trim($_POST['answer']), date('Y-m-d H:i:s'));
			wrap_db_query($sql);
			$data['voted'] = true;
		}
	}

	$page['text'] = wrap_template('ted', $data);
	return $page;
}
