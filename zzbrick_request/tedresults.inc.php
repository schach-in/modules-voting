<?php 

// Zugzwang Project
// deutsche-schachjugend.de
// Copyright (c) 2019 Gustaf Mossakowski <gustaf@koenige.org>
// TED results


function mod_ted_tedresults() {
	global $zz_setting;
	global $zz_page;
	$zz_page['dont_show_h1'] = true;
	$zz_setting['cache'] = false;
	
	$sql = 'SELECT question_id, question FROM questions
		WHERE active = "yes" LIMIT 1';
	$data = wrap_db_fetch($sql);

	$sql = 'SELECT COUNT(*) AS votes, answer FROM votes WHERE question_id = %d
		AND !ISNULL(answer) AND answer != ""
		GROUP BY answer ';
	$sql = sprintf($sql, $data['question_id']);
	$data['results_db'] = wrap_db_fetch($sql, 'answer');

	$answers = ['A', 'B', 'C', 'D'];
	foreach ($answers as $answer) {
		if (!array_key_exists($answer, $data['results_db']))
			$data['results'][$answer] = ['votes' => 0, 'answer' => $answer];
		else
			$data['results'][$answer] = $data['results_db'][$answer];
	}
/*
	$data['results']['A']['votes'] = 500;
	$data['results']['B']['votes'] = 300;
	$data['results']['C']['votes'] = 300;
	$data['results']['D']['votes'] = 200;
*/
	$data['sum'] =
		$data['results']['A']['votes'] + $data['results']['B']['votes'] +
		$data['results']['C']['votes'] + $data['results']['D']['votes'];
	foreach ($answers as $answer) {
		$data['results'][$answer]['votes'] = $data['results'][$answer]['votes'] / $data['sum'] * 300;
	}	

	$page['text'] = wrap_template('tedresults', $data);
	return $page;
}