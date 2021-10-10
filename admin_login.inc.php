<?php

//checks for submit button submission
if (isset($_POST['login-submit'])) {

	//require the database handler
	require 'dbh.inc.php';

	//login variables
	$mailuid = $_POST['userEmail'];
	$password = $_POST['userPass'];

	//check if anything was left empty
	if (empty($mailuid) || empty($password)) {
		header("Location: ../admin_login.php?error=emptyfields");
		exit();
	} else {
		//get user information
		$sql = "SELECT * FROM administrator WHERE email_address=?;";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../index.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $mailuid);
			mysqli_stmt_execute($stmt);

			//grabs the result for the stmt
			$result = mysqli_stmt_get_result($stmt);

			//get result data
			if ($row = mysqli_fetch_assoc($result)) {
				//ADD REVERSE HASH IN FUTURE
				$pwdCheck = password_verify($password, $row['admin_password']);
				//if ($password == $row['admin_password']) {
				if ($password == $pwdCheck) {
					$pwdCheck = true;
				} else {
					$pwdCheck = false;
				}

				if ($pwdCheck == true) {


					//destroy old session if signed in previously
					//have session started to end it
					session_start();
					//takes all session variables and deletes all values
					session_unset();
					//destroys the session
					session_destroy();

					//start a session for global variable
					session_start();

					//saves information not sensitive in website
					$_SESSION['fName'] = $row['first_name'];
					$_SESSION['lName'] = $row['last_name'];
					$_SESSION['admin_id'] = $row['id'];

					//take user back with success message
					header("Location: ../admin_portal.php?login=success");
				} else {
					header("Location: ../admin_login.php?error=wrongpwd");
					exit();
				}
			}


			//if data not recieved
			else {
				header("Location: ../admin_login.php?error=nouser");
				exit();
			}
		}
	}
} else {
	header("Location: ../index.php");
	exit();
}
