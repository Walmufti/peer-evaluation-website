<?php
//session_start();
//checks for submit button submission
if (isset($_POST['login-submit'])) {
	//require the database handler
	require 'dbh.inc.php';

	//option to use email or username
	$mailuid = $_POST['userEmail'];
	$password = $_POST['userPass'];

	//check if anything was left empty
	if (empty($mailuid) || empty($password)) {
		header("Location: ../student_login.php?error=emptyfields");
		exit();
	} else {
		//get user information from inputted email address
		$sql = "SELECT * FROM student WHERE email_address=?;";
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
			//stores in array
			if ($row = mysqli_fetch_assoc($result)) {
				//implement reverse hash
				//check password
				$pwdCheck = password_verify($password, $row['student_password']);
				if ($password == $pwdCheck) {
					//if ($password == $pwdCheck) {
					$pwdCheck = true;
				} else {
					$pwdCheck = false;
				}

				if ($pwdCheck == true) {

					//destroy old session if already started
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
					$_SESSION['student_id'] = $row['id'];


					$sql = "UPDATE student SET lldt = NOW() WHERE id = ?;";
					$stmt = mysqli_stmt_init($conn);

					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../index.php?error=sqlerror");
						exit();
					} else {
						mysqli_stmt_bind_param($stmt, "i", $_SESSION['student_id']);
						mysqli_stmt_execute($stmt);
					}



					$sql = "SELECT schedule_peer_eval.id, student_group.team_name, group_assign.student_id
					FROM schedule_peer_eval
					JOIN student_group ON student_group.id = schedule_peer_eval.group_id
					JOIN group_assign ON student_group.id = group_assign.group_id
					WHERE group_assign.student_id = ?;";

					$stmt = mysqli_stmt_init($conn);

					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../index.php?error=sqlerror");
						exit();
					} else {
						mysqli_stmt_bind_param($stmt, "i", $_SESSION['student_id']);
						mysqli_stmt_execute($stmt);

						//grabs the result for the stmt
						$result = mysqli_stmt_get_result($stmt);

						$scheduledEval = array();
						//checks if result was recieved
						//stores in array
						while ($row = mysqli_fetch_assoc($result)) {

							array_push($scheduledEval, $row['id']);
						}
						$i = 0;
						foreach ($scheduledEval as $eval) {
							


							$sql = "SELECT peerEval_id, start_date, end_date, team_name, group_id
								FROM student_criterion_score
								JOIN schedule_peer_eval ON student_criterion_score.peerEval_id = schedule_peer_eval.id
								JOIN student_group ON schedule_peer_eval.group_id = student_group.id
								WHERE schedule_peer_eval.id = ? AND student_id = ?
								GROUP BY student_id, peerEval_id;";

							$stmt = mysqli_stmt_init($conn);

							if (!mysqli_stmt_prepare($stmt, $sql)) {
								header("Location: ../index.php?error=sqlerror");
								exit();
							} else {
								mysqli_stmt_bind_param($stmt, "ii", $eval, $_SESSION['student_id']);
								mysqli_stmt_execute($stmt);

								//grabs the result for the stmt
								$result = mysqli_stmt_get_result($stmt);

								//checks if result was recieved
								//stores in array
								$availEval = array();

								

								if (mysqli_num_rows($result) == 0) {

									$sql = "SELECT schedule_peer_eval.id, start_date, end_date, team_name, group_id
									FROM schedule_peer_eval
									JOIN student_group ON student_group.id = schedule_peer_eval.group_id
									WHERE schedule_peer_eval.id = ?;";

									$stmt = mysqli_stmt_init($conn);

									if (!mysqli_stmt_prepare($stmt, $sql)) {
										header("Location: ../index.php?error=sqlerror");
										exit();
									} else {
										mysqli_stmt_bind_param($stmt, "i", $eval);
										mysqli_stmt_execute($stmt);

										//grabs the result for the stmt
										$result = mysqli_stmt_get_result($stmt);

										$scheduledEval = array();
										//checks if result was recieved
										//stores in array
										while ($row = mysqli_fetch_assoc($result)) {
											//echo 'EVAL'.$eval.'<br>';
											//echo 'EVAL'.$row['team_name'].'<br>';
											$_SESSION['availEval'][$i] = array($row['id'], $row['start_date'], $row['end_date'], $row['team_name'], $row['group_id']);
										}
										$i++;

									}

								}
							}
						}



						//take user back with success message
						header("Location: ../student_portal.php?login=success");
					}
				} else {
					header("Location: ../student_login.php?error=wrongpwd");
					exit();
				}
			}


			//if data not recieved
			else {
				header("Location: ../student_login.php?error=nouser");
				exit();
			}
		}
	}
} else {
	header("Location: ../index.php");
	exit();
}
