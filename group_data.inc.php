<?php

session_start();

require 'dbh.inc.php';

$courseID = $_POST['SelectCourse'];

$sql = "SELECT * FROM student_group WHERE prof_course_id = ?;";

$stmt = mysqli_stmt_init($conn);

//helps keep database safe
if (!mysqli_stmt_prepare($stmt, $sql)) {
  //close the sqli connection to save resources
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  header("Location: ../index.php?error=sqlerror");
  exit();
} else {
  mysqli_stmt_bind_param($stmt, "i", $courseID);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  unset($_SESSION['group_schedule']);
  $i = 0;
  echo "You will be scheduling evaluations for the following groups:"."<br>";
  while ($row = $result->fetch_assoc()) {
    $_SESSION['group_schedule'][$i] = $row["id"];
    echo $row["id"] . ", "; 
    $i++;
  }
  header("Location: ../group_data.php?result=groupsuccess");

  //close the sqli connection to save resources
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
