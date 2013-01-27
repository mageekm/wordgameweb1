<?php
	require_once('config.php');
	
	//Create query
	function doAuth($email, $password){
		$passback = array('success' => false);
		$qry="SELECT * FROM player WHERE email='$email' limit 1";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$thisPlayer = mysql_fetch_assoc($result) or die(mysql_error());
				$hash = $thisPlayer["password"];
				if (password_verify($password, $hash)) {
					$passback['success'] = true;
					$passback['sessionid'] = session_id();
				} //don't worry, it failed
			}
		}
		return $passback;
	}