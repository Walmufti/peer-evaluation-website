<?php
session_start();

require 'dbh.inc.php';

unset($_SESSION['student_list']);

$selectedEval = $_POST['EvalSelect'];

$_SESSION['selectedEval'] = $selectedEval;

if(!isset($_POST['EvalSelect'])){
	header("Location: ../student_portal.php?error=invalidselection");
	exit();
}

//get all students from database
$sql = "SELECT id, first_name, last_name FROM student";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
	header("Location: ../index.php?error=sqlerror");
	exit();
} else {
	mysqli_stmt_execute($stmt);

	//grabs the result for the stmt
	$result = mysqli_stmt_get_result($stmt);

	//add all students to session variables for dropdown
	$i = 0;
	while ($row = $result->fetch_assoc()) {
		$_SESSION['peer_eval_student_id'][$i] = $row["id"];
		$_SESSION['student_names'][$i] = $row["first_name"] . " " . $row["last_name"];
		$i++;
	}

	//get all criterion and their ids
	$sql = "SELECT id, name FROM criterion";
	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../index.php?error=sqlerror");
		exit();
	} else {
		mysqli_stmt_execute($stmt);

		//grabs the result for the stmt
		$result = mysqli_stmt_get_result($stmt);
		//save the criterion as session variables for output on page
		$i = 0;
		while ($row = $result->fetch_assoc()) {
			$_SESSION['criterion_id'][$i] = $row["id"];
			$_SESSION['criterion'][$i] = $row["name"];
			$i++;
		}

		$sql = "SELECT student_id, first_name, last_name 
		from student
		JOIN group_assign ON group_assign.student_id = student.id
		JOIN schedule_peer_eval ON group_assign.group_id = schedule_peer_eval.group_id
		WHERE schedule_peer_eval.id = ?";

		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../index.php?error=sqlerror");
			exit();
		} else {
			$i = 1;
			mysqli_stmt_bind_param($stmt, "i", $selectedEval);
			mysqli_stmt_execute($stmt);

			//grabs the result for the stmt
			$result = mysqli_stmt_get_result($stmt);
			//save the criterion as session variables for output on page
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$_SESSION['student_list'][$i] = array($row['student_id'] , $row['first_name'] , $row['last_name']);
				$i++;
			}
			header("Location: ../peer_evaluation.php?result=success");
		}
	}
}
