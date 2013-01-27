<?php

require_once('config.php');
//$db is defined in config
function register($person) {//$email, $password, $firstName = null, $lastName = null, $age = null, $education = null, $sex = null){
	$qry = "SELECT count(*) FROM player WHERE email='{$person['email']}'";
	$result = $db->query($qry)->fetch(PDO::FETCH_NUM);
	$return = array();
	if(isset($result[0]) && $result[0] >0) {
		$errmsg_arr[] = 'E-mail already in use';
		$errflag = true;
		$return['success'] = false;
		$return['error'] = array('number' => 2, 'message'=> 'That email is already in use. Please try again.');
	} else {
		$hash = password_hash($password, PASSWORD_DEFAULT, array("cost" => 10));
		if(false !== $hash) { //hash success
			$insertQry = "INSERT INTO player (firstName, lastName, age, sex, education, email, password)
									VALUES ('{$person['firstName']}', '{$person['lastName']}', '{$person['age']}', '{$person['sex']}', '{$person['education']}', '{$person['email']}', '{$person['hash']}')";
			$insertcount = $db->exec($insertQry);
			if($insertcount < 1) {
				$return['success'] = false;
				$return['error'] = array('number' => 3, 'message'=> 'An error was encountered while creating your account. Please try again later.');
			} else {
				$return['success'] = true;
				$return['sessionid'] = session_id();
			}
		} else { //fail to hash
			$return['success'] = false;
			$return['error'] = array('number' => 3, 'message'=> 'An error was encountered while creating your account. Please try again later.');
		}
	}
	return $return;
}

