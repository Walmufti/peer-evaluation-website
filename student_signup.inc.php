<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';


//checks for submit button submission
if (isset($_POST['student-signup'])) {

	//require database handler
	require 'dbh.inc.php';

	//fetch information from inputs
	$fName = $_POST["fName"];
	$lName = $_POST["lName"];
	$major = $_POST["major"];
	$email = $_POST['email'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['repeatpwd'];

	//check for empty fields
	if (empty($fName) || empty($lName) || empty($major) || empty($email) || empty($password) || empty($passwordRepeat)) {
		//send user back to signup page
		//sends back information like error and fields already filled out
		header("Location: ../index.php?error=emptyfields&fName=" . $fName . "&lName=" . $lName . "&major=" . $major . "&email=" . $email);

		//stops code from running if there was a mistake
		exit();
	}

	//checks for valid email
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../index.php?error=invalidmail&uid=" . $email);
		//stops code from running if there was a mistake
		exit();
	} 
	else if ($password !== $passwordRepeat) {
		header("Location: ../index.php?error=passwordmismatch");
		//stops code from running if there was a mistake
		exit();
	} 
	else {
		//if user tried to sign up for email inside database
		$sql = "SELECT email_address FROM student WHERE email_address=?";

		$stmt = mysqli_stmt_init($conn);

		//helps keep database safe
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			//close the sqli connection to save resources
			mysqli_stmt_close($stmt);
			mysqli_close($conn);
			header("Location: ../index.php?error=sqlerror1");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $email);
			mysqli_stmt_execute($stmt);

			//stores results in stmt variable
			mysqli_stmt_store_result($stmt);

			//checks how many rows of results from database
			$resultCheck = mysqli_stmt_num_rows($stmt);

			//if email is already taken
			if ($resultCheck > 0) {
				//close the sqli connection to save resources
				mysqli_stmt_close($stmt);
				mysqli_close($conn);
				header("Location: ../index.php?error=emailtaken");
				exit();
			} else {
				//insert the student into the database
				$sql = "INSERT INTO student (first_name, last_name, major, email_address, student_password, live, date_imported) VALUES (?, ?, ?, ?, ?, 1, NOW())";

				$stmt = mysqli_stmt_init($conn);

				//helps keep database safe
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					//close the sqli connection to save resources
					mysqli_stmt_close($stmt);
					mysqli_close($conn);
					header("Location: ../index.php?error=sqlerror2");
					exit();
				} else {

					//hash the password
					$hashedPwd = password_hash($password, PASSWORD_DEFAULT);


					mysqli_stmt_bind_param($stmt, "sssss", $fName, $lName, $major, $email, $hashedPwd);
					mysqli_stmt_execute($stmt);
					//close the sqli connection to save resources
					mysqli_stmt_close($stmt);
					mysqli_close($conn);
					header("Location: ../index.php?user=accountcreated");
					exit();
				}
			}
		}
	}
}

//send user back if they try to access without clicking signup button
else {
	header("Location: ../index.php?=invalidaccess");
	exit();
}
