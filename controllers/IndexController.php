<?php

class IndexController extends ApplicationController {

	const ERROR_MISSING_PARAMETER = 1;
	const ERROR_INVALID_LOGIN = 2;
	const ERROR_EMAIL_IN_USE = 3;
	const ERROR_ACCOUNT_CREATE_ERROR = 4;
	const ERROR_EMAIL_INVALID = 5;

	static $Error_messages = array(
		self::ERROR_MISSING_PARAMETER => 'Missing parameter',
		self::ERROR_INVALID_LOGIN => 'Invalid login. Please try again',
		self::ERROR_EMAIL_IN_USE => 'That email is already in use. Please try again.',
		self::ERROR_ACCOUNT_CREATE_ERROR => 'An error was encountered while creating your account. Please try again later.',
		self::ERROR_EMAIL_INVALID => 'Email is invalid',
	);

	function _getErrorMessage($error) {
		return array('number' => $error, 'message' => self::$Error_messages[$error]);
	}

	function index() {
		redirect('http://qduku.com'); //don't access the api directly
	}

	function cleanWords() {
		if(false) {
			set_time_limit(0);
			foreach(Word::doSelect() as $word) {
				//$word = new Word();
				$word->setWord(ucfirst(trim($word->getWord())));
				$word->setDefinition(ucfirst(trim($word->getDefinition())));
				$word->save();
			}
		}
		redirect('http://qduku.com');
	}

	function authenticate() {
		$passback = array('success' => false, 'error' => $this->_getErrorMessage(self::ERROR_MISSING_PARAMETER));
		if(!empty($_REQUEST['email']) && !empty($_REQUEST['password'])) {
			$password = $_REQUEST['password'];
			$email = $_REQUEST['email'];
			$player = Player::retrieveByEmail($email);
			if($player && password_verify($password, $player->getPassword())) {
				$passback = array('success' => true, 'sessionid' => session_id());
			} else {
				$passback = array('success' => false, 'error' => $this->_getErrorMessage(self::ERROR_INVALID_LOGIN));
			}
		}
		die(json_encode($passback));
	}

	function getRandomWords() {
		$passback = array('success' => false, 'error' => $this->_getErrorMessage(self::ERROR_MISSING_PARAMETER));
		if(!empty($_REQUEST['n'])) {
			$words = Word::doSelect(Query::create()->order('RAND()')->setLimit($_REQUEST['n']));
			$passback = array('success' => true, 'words' => $words);
		}
		die(json_encode_all($passback));
	}

	function getPuzzleWord() {
		$q = new Query();
		if(!empty($_REQUEST['type'])) {
			$q->add(Word::TYPE, $_REQUEST['type']);
		}
		if(!empty($_REQUEST['level'])) {
			$q->add(Word::DIFFICULTY, $_REQUEST['level']);
		}
		$q->setLimit(4);
		$q->orderBy('RAND()');
		$words = Word::doSelect($q);

		die(json_encode_all($words));
	}

	function register() {
		$passback = array('success' => false, 'error' => $this->_getErrorMessage(self::ERROR_MISSING_PARAMETER));
		if(!empty($_REQUEST['email']) && !empty($_REQUEST['password'])) {
			$email = $_REQUEST['email'];
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$password = $_REQUEST['password'];
				$count = Player::doCount(Query::create()->add(Player::EMAIL, $email));
				if($count > 0) {
					$passback = array('success' => false, 'error' => $this->_getErrorMessage(self::ERROR_EMAIL_IN_USE));
				} else {
					$hash = password_hash($password, PASSWORD_DEFAULT, array("cost" => 10));
					if(false !== $hash) { //hash success
						$player = new Player();
						$player->fromArray($_REQUEST);
						$player->setPassword($hash);
						$player->setPaidTier(0);
						if($player->save()) {
							$passback = array('success' => true, 'sessionid' => session_id());
						} else {
							$passback = array('success' => false,
								'error' => $this->_getErrorMessage(self::ERROR_ACCOUNT_CREATE_ERROR));
						}
					} else { //fail to hash
						$passback = array('success' => false,
							'error' => $this->_getErrorMessage(self::ERROR_ACCOUNT_CREATE_ERROR));
					}
				}
			} else {
				$passback = array('success' => false,
							'error' => $this->_getErrorMessage(self::ERROR_EMAIL_INVALID));
			}
		}
		die(json_encode($passback));
	}

}