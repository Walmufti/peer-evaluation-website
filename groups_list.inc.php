<?php

session_start();

require 'dbh.inc.php';

$courseID = $_POST['CourseName'];

unset($_SESSION['professor_courseSelected']);

$_SESSION['professor_courseSelected'] = $courseID;

$sql = "SELECT id, team_name FROM student_group WHERE prof_course_id = ?;";

$stmt = mysqli_stmt_init($conn);
//prepare the statement
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../professorportal.php?error=sqlerror");
    exit();
} else {
    //bind team name and course id, and execute statement
    mysqli_stmt_bind_param($stmt, "i", $courseID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    unset($_SESSION['team_info']);
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['team_info'][$i] = array($row['id'], $row['team_name']);
        $i++;
    }

    $sql = "SELECT student.id, student.first_name, student.last_name FROM student JOIN student_course ON student.id=student_course.student_id WHERE prof_course_id = ?";

    $stmt = mysqli_stmt_init($conn);
    //prepare the statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../professorportal.php?error=sqlerror");
        exit();
    } else {
        //bind team name and course id, and execute statement
        mysqli_stmt_bind_param($stmt, "i", $courseID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        unset($_SESSION['student_list']);
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['student_list'][$i] = array($row['id'], $row['first_name'], $row['last_name']);
            $i++;
        }



        header("Location: ../groups_list.php");
    }
}
