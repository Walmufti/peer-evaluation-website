<?php

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';




//require database handler
require 'dbh.inc.php';


//fetch information from inputs
$fName = $_POST["fName"];
$lName = $_POST["lName"];
$email = $_POST['email'];
$password = $_POST['pwd'];
$passwordRepeat = $_POST['repeatpwd'];

//check for empty fields
if (empty($fName) || empty($lName) || empty($email) || empty($password) || empty($passwordRepeat)) {
	//send user back to signup page
	//sends back information like error and fields already filled out
	header("Location: ../index.php?error=emptyfields&fName=" . $fName . "&lName=" . $lName . "&email=" . $email);
	//stops code from running if there was a mistake
	exit();
}

//checks for valid email
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	header("Location: ../index.php?error=invalidmail&uid=" . $email);
	//stops code from running if there was a mistake
	exit();
}

//check if password is repeated correctly
else if ($password !== $passwordRepeat) {
	header("Location: ../index.php?error=passwordmismatch");
	//stops code from running if there was a mistake
	exit();
} else {
	//check if professor is already in database
	$sql = "SELECT email_address FROM professor WHERE email_address=?";

	$stmt = mysqli_stmt_init($conn);

	//helps keep database safe
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		//close the sqli connection to save resources
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
		header("Location: ../index.php?error=sqlerror1");
		exit();
	} else {
		//bind email from form
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
		}
		//insert professor into the database
		else {
			$sql = "INSERT INTO professor (first_name, last_name, email_address, password, live) VALUES (?, ?, ?, ?, 1)";

			$stmt = mysqli_stmt_init($conn);

			//helps keep database safe
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				//close the sqli connection to save resources
				mysqli_stmt_close($stmt);
				mysqli_close($conn);
				header("Location: ../index.php?error=sqlerror");
				exit();
			} else {

				//hash the password
				//bcrypt always update when it gets decrypted

				$hashedPwd = password_hash($password, PASSWORD_DEFAULT);

				//bind and add users to the database
				mysqli_stmt_bind_param($stmt, "ssss", $fName, $lName, $email, $hashedPwd);
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
