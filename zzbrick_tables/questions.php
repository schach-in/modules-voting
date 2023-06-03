<?php 

/**
 * voting module
 * table definition: questions
 *
 * https://www.zugzwang.org/modules/voting
 * Part of »Zugzwang Project«
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2019 Gustaf Mossakowski
 */


$zz['title'] = 'Fragen';
$zz['table'] = 'questions';

$zz['fields'][1]['title'] = 'ID';
$zz['fields'][1]['field_name'] = 'question_id';
$zz['fields'][1]['type'] = 'id';

$zz['fields'][2]['field_name'] = 'question';
$zz['fields'][2]['type'] = 'text';

$zz['fields'][3]['field_name'] = 'active';
$zz['fields'][3]['type'] = 'select';
$zz['fields'][3]['enum'] = ['yes', 'no'];
$zz['fields'][3]['default'] = 'no';

$zz['fields'][4]['field_name'] = 'answers';
$zz['fields'][4]['type'] = 'subtable';
$zz['fields'][4]['table'] = 'votes';
$zz['fields'][4]['hide_in_form'] = true;
$zz['fields'][4]['fields'][1]['field_name'] = 'vote_id';
$zz['fields'][4]['fields'][1]['type'] = 'id';
$zz['fields'][4]['fields'][2]['field_name'] = 'question_id';
$zz['fields'][4]['fields'][2]['type'] = 'foreign_key';
$zz['fields'][4]['sql'] = 'SELECT * FROM votes
	LEFT JOIN questions USING (question_id)';
$zz['fields'][4]['subselect']['sql'] = 'SELECT question_id, CONCAT(answer, ": ", COUNT(*))
	FROM votes
	LEFT JOIN questions USING (question_id)
	GROUP BY question_id, answer
	ORDER BY answer';
$zz['fields'][4]['subselect']['concat_rows'] = ' – ';

$zz['sql'] = 'SELECT /*_PREFIX_*/questions.*
	FROM /*_PREFIX_*/questions';
$zz['sqlorder'] = ' ORDER BY question_id';
