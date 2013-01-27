<?php
	require('config.php');
	require('auth.php');
	require('get-words.php');
	require('register.php');
	// http://api.qduku.com/index?action=authenticate&username=nathan&password=123456
	switch($_REQUEST['action']){
		case 'authenticate':
    		$results = doAuth($_REQUEST['username'], $_REQUEST['password']);
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
	die(json_encode($results));
