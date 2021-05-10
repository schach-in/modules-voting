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

$zz['sql'] = 'SELECT /*_PREFIX_*/questions.*
	FROM /*_PREFIX_*/questions';
$zz['sqlorder'] = ' ORDER BY question_id';
