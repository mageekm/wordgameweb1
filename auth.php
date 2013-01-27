<?php
	//Start session
	session_start();
	require('config.php');
	
	//Create query
	function doAuth($email, $password){
		$qry="SELECT * FROM player WHERE email='$email'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'E-mail already in use';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		$result=mysql_query($qry);
		if (password_verify($password, $hash)) {
		    /* Valid */
		} else {
		    /* Invalid */
		}
		//Check whether the query was successful or not
		if($result) {
			if(mysql_num_rows($result) == 1) {
				//Login Successful
				session_regenerate_id();
				$member = mysql_fetch_assoc($result);
				$_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
				$_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
				$_SESSION['SESS_LAST_NAME'] = $member['lastname'];
				session_write_close();
				header("location: member-index.php");
				exit();
			}else {
				//Login failed
				header("location: login-failed.php");
				exit();
			}
		}else {
			die("Query failed");
		}
	}
?>