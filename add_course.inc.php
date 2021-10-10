<?php

//Add database handler
require "dbh.inc.php";


$cName = $_POST['cName'];
$cNumber = $_POST['cNumber'];

$sql = "INSERT INTO course (course_name, course_number, date_imported) VALUES (?,?, NOW())"; //Insert into the course table
$stmt = mysqli_stmt_init($conn);
//prepare the statement
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../admin_portal.php?error=sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "ss", $cName, $cNumber);
    mysqli_stmt_execute($stmt);
    header("Location: ../admin_portal.php?result=coursecreated");
}
