<?php
	//Start session
	session_start();
	require_once('config.php');
	
	//Create query
	function doAuth($email, $password){
		$qry="SELECT * FROM player WHERE email='$email'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$thisPlayer = mysql_fetch_assoc($result) or die(mysql_error());
				$hash = $thisPlayer["password"];
				if (password_verify($password, $hash)) {
					
				} else {
				    
				}
			}
		}
	}