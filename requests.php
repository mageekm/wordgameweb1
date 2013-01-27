<?php
	require_once('config.php');
	require_once('auth.php');
	require_once('get-words.php');
	require_once('register.php');
	// http://api.qduku.com/index?action=authenticate&username=nathan&password=123456
	switch($_REQUEST['action']){
		case 'authenticate':
    		$results = doAuth($_REQUEST['email'], $_REQUEST['password']);
    		break;
		case 'getWordAndDefinition':
    		$results = getWordAndDefinition();
    		break;
		case 'getNRandomWords':
    		$results = getNRandomWords($_REQUEST['n']);
    		break;
		case 'register':
			$results = register($_REQUEST['email'], $_REQUEST['password'],$_REQUEST['firstName'],$_REQUEST['lastName'],
			$_REQUEST['age'], $_REQUEST['education'], $_REQUEST['sex']);
	}	
	die("Error: " . json_encode($results));
