<?php
    phpinfo();
	require('config.php');
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	
	function getNRandomWords($n){
		$nWords = @mysql_query("SELECT word FROM word ORDER BY RAND() LIMIT '$n'");
	}
	
	function getWordAndDefinition(){
		$word = @mysql_query("SELECT word FROM word ORDER BY RAND() LIMIT 1");
		$wordEntry = mysql_fetch_assoc($word) or die(mysql_error());
		return $wordEntry;
	}
	