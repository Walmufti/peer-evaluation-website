<?php

//checks for submit button submission
if (isset($_POST['login-submit'])) {
	//require the database handler
	require 'dbh.inc.php';

	//store email and password as variables
	$mailuid = $_POST['userEmail'];
	$password = $_POST['userPass'];

	//check if anything was left empty
	if (empty($mailuid) || empty($password)) {
		header("Location: ../studentlogin.php?error=emptyfields");
		exit();
	} else {
		//get user with that email address
		$sql = "SELECT * FROM professor WHERE email_address=?;";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../index.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $mailuid);
			mysqli_stmt_execute($stmt);

			//grabs the result for the stmt
			$result = mysqli_stmt_get_result($stmt);

			//checks if result was recieved
			if ($row = mysqli_fetch_assoc($result)) {
				//check password
				//set up reverse hash

				$pwdCheck = password_verify($password, $row['password']);

				if ($password == $pwdCheck) {
					//if ($password == $pwdCheck) {
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


					//start session for global variables
					session_start();

					//assign name and id into session variables
					$_SESSION['fName'] = $row['first_name'];
					$_SESSION['lName'] = $row['last_name'];
					$_SESSION['professor_id'] = $row['id'];



					$sql = "UPDATE professor SET lldt = NOW() WHERE id = ?;";
					$stmt = mysqli_stmt_init($conn);

					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../index.php?error=sqlerror");
						exit();
					} else {
						mysqli_stmt_bind_param($stmt, "i", $_SESSION['professor_id']);
						mysqli_stmt_execute($stmt);
					}

					//get course information for all courses that the professor is an instructor for
					$sql = "SELECT  professor_course.id, term_id, course_name, course_number, course_id, name, start_date, end_date FROM professor_course JOIN course AS c ON c.id=professor_course.course_id JOIN term AS t ON t.id=professor_course.term_id WHERE professor_id = ?;";
					$stmt = mysqli_stmt_init($conn);

					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../index.php?error=sqlerror");
						exit();
					} else {
						//get all courses professor is a part of based on professor id
						mysqli_stmt_bind_param($stmt, "i", $row['id']);
						mysqli_stmt_execute($stmt);

						//grabs the result for the stmt
						$result = mysqli_stmt_get_result($stmt);

						//increment for course_info session variable
						$i = 0;

						//store course information in a nested array
						while ($row = $result->fetch_assoc()) {
							$_SESSION['course_info'][$i] = array($row['id'], $row['course_id'], $row['course_name'], $row['course_number'], $row['name']);
							$i++;
						}

						header("Location: ../professor_portal.php?login=success");
					}
				} else {
					header("Location: ../professor_login.php?error=wrongpwd");
					exit();
				}
			}

			//if user is not in database at all
			else {
				header("Location: ../professor_login.php?error=nouser");
				exit();
			}
		}
	}
} else {
	header("Location: ../index.php");
	exit();
}
