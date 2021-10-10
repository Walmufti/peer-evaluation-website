<?php

//Add database handler
require "dbh.inc.php";


$name =  $_POST['termname'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

if(empty($start_date) || empty($end_date)){
    header("Location: ../admin_portal.php?error=selectdate");
    exit();
}


$sql = "INSERT INTO term (name, start_date, end_date) VALUES (?,?,?)"; //Insert into the terms table
$stmt = mysqli_stmt_init($conn);
//prepare the statement
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../admin_portal.php?error=sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "sss", $name, $start_date, $end_date);
    mysqli_stmt_execute($stmt);
    header("Location: ../admin_portal.php?result=termcreated");
}
