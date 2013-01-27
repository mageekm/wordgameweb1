<?php

class IndexController extends ApplicationController {

	function index() {
		redirect('http://qduku.com'); //don't access the api directly
	}

	function authenticate() {
		$passback = array('success' => false, 'error' => array('number' => 1, 'message' => 'Missing parameter'));
		if(!empty($_REQUEST['email']) && !empty($_REQUEST['password'])) {
			$passback = array('success' => false);
			$player = Player::retrieveByEmail($_REQUEST['email']);
			if($player) {
				$hash = $player->getPassword();
				if(password_verify($password, $hash)) {
					$passback['success'] = true;
					$passback['sessionid'] = session_id();
				} //don't worry, it failed
			}
		}
		die(json_encode($passback));
	}

	function getRandomWords() {
		$passback = array('success' => false, 'error' => array('number' => 1, 'message' => 'Missing parameter'));
		if(!empty($_REQUEST['n'])) {
			$words = Word::doSelect(Query::create()->order('RAND()')->setLimit($_REQUEST['n']));
			$passback = array('success' => true, 'words' => $words);
		}
		die(json_encode_all($passback));
	}

	function register() {
		$passback = array('success' => false, 'error' => array('number' => 1, 'message' => 'Missing parameter'));
		if(!empty($_REQUEST['email']) && !empty($_REQUEST['password'])) {
			$email = $_REQUEST['email'];
			$password = $_REQUEST['password'];
			$count = Player::doCount(Query::create()->add(Player::EMAIL, $email));
			if($count > 0) {
				$passback['success'] = false;
				$passback['error'] = array('number' => 2, 'message' => 'That email is already in use. Please try again.');
			} else {
				$hash = password_hash($password, PASSWORD_DEFAULT, array("cost" => 10));
				if(false !== $hash) { //hash success
					$player = new Player();
					$player->fromArray($_REQUEST);
					if($player->save()) {
						$return['success'] = true;
						$return['sessionid'] = session_id();
					} else {
						$return['success'] = false;
						$return['error'] = array('number' => 3, 'message' => 'An error was encountered while creating your account. Please try again later.');
					} 
				} else { //fail to hash
					$return['success'] = false;
					$return['error'] = array('number' => 3, 'message' => 'An error was encountered while creating your account. Please try again later.');
				}
			}
		}
		die(json_encode($passback));
	}

}