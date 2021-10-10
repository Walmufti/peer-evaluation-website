<?php
//Assign student to group
session_start();

require 'dbh.inc.php';

$groupID = $_POST['GroupSelect'];
$studentID = $_POST['StudentSelect'];


$sql = "INSERT INTO group_assign (group_id, student_id) VALUES (?, ?)"; //Add student to group

$stmt = mysqli_stmt_init($conn);

//helps keep database safe
if (!mysqli_stmt_prepare($stmt, $sql)) {
    //close the sqli connection to save resources
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../index.php?error=sqlerror");
    exit();
} 
else {

    mysqli_stmt_bind_param($stmt, "ii", $groupID, $studentID);
    mysqli_stmt_execute($stmt);
    //close the sqli connection to save resources
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../groups.php?user=studentassigned");
    exit();
}
