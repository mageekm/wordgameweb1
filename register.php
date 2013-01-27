<?php
	require_once('config.php');
	
    function register($email, $password, $firstName, $lastName, $age, $education, $sex){
		if($email != '') {
			$qry = "SELECT * FROM player WHERE email='$email'";
			$qry = clean($qry);
			$result = mysql_query($qry);
			if($result) {
				if(mysql_num_rows($result) > 0) {
					$errmsg_arr[] = 'E-mail already in use';
					$errflag = true;
				}
				@mysql_free_result($result);
			}
			else {
				$hash = password_hash($password, PASSWORD_BCRYPT);
				$insertQry = "INSERT INTO player (firstName, lastName, age, sex, education, email, password) 
								VALUES ('$firstName', '$lastName', '$age', '$sex', '$education', '$email', '$hash')";
				$insertQry = clean($insertQry);
				
				if (!mysql_query($insertQry,$link))
  				{
  					die('Error: ' . mysql_error());
  				}	
			}
		}	
    }
	

    
    