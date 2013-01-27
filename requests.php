<?php

require_once('config.php');
require_once('auth.php');
require_once('get-words.php');
require_once('register.php');
// http://api.qduku.com/index?action=authenticate&username=nathan&password=123456
$results = array('success' => false, 'error' => array('number' => 1, 'message' => 'Missing parameter'));
switch($_REQUEST['action']) {
	case 'authenticate':
		if(!empty($_REQUEST['email']) && !empty($_REQUEST['password'])) {
			$results = doAuth($_REQUEST['email'], $_REQUEST['password']);
		}
		break;
	case 'getWordAndDefinition':
		$results = getWordAndDefinition();
		break;
	case 'getNRandomWords':
		$results = getNRandomWords($_REQUEST['n']);
		break;
	case 'register':
		if(!empty($_REQUEST['email']) && !empty($_REQUEST['password'])) {
			$person = array('email' => $_REQUEST['email'], 'password' => $_REQUEST['password']);
			$person['firstName'] = !empty($_REQUEST['firstName']) ? $_REQUEST['firstName'] : null;
			$person['lastName'] = !empty($_REQUEST['lastName']) ? $_REQUEST['lastName'] : null;
			$person['age'] = !empty($_REQUEST['age']) ? $_REQUEST['age'] : null;
			$person['education'] = !empty($_REQUEST['education']) ? $_REQUEST['education'] : null;
			$person['sex'] = !empty($_REQUEST['sex']) ? $_REQUEST['sex'] : null;
			$results = register($person);
		}
}
die("Result: " . json_encode($results));
