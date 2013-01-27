<?php
header('Access-Control-Allow-Origin: *');
require_once('password.php');
define('DB_HOST', 'qkwordwillstart2.db.10275500.hostedresource.com');
define('DB_USER', 'qkwordwillstart2');
define('DB_PASSWORD', 'osu@2013Goals');
define('DB_DATABASE', 'qkwordwillstart2');

if(!empty($_REQUEST['sessionid'])) {
	session_id($_REQUEST['sessionid']);
}
session_start();
$dsn = 'mysql:host=' . DB_HOST. ';dbname=' . DB_DATABASE .';charset=utf8';
try {
$db = new PDO($dsn, DB_USER, DB_PASSWORD);
} catch (Exception $e) {
	die($e);
}
print_r($dsn);
$words = $db->query('select * from word limit 10')->fetch(PDO::FETCH_ASSOC);
print_r($db);
function clean($str) {
	$str = @trim($str);
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	return mysql_real_escape_string($str);
}
