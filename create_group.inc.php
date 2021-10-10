<?php

if (isset($_POST['create-group'])) {
    //Add database handler
    require "dbh.inc.php";
    //Check if tableName is empty
    if ($_POST['teamName'] == "") {
        header("Location: ../create_groups.php?error=invalidteamname");
    }
    //check if a course is selected
    if (!isset($_POST['CourseSelect'])) {
        header("Location: ../create_groups.php?error=invalidcourse");
    } 
    else {
        //store POST variables as local variables
        $teamName = $_POST['teamName'];
        $courseID = $_POST['CourseSelect'];
        //insert into student group table
        $sql = "INSERT INTO student_group (team_name, prof_course_id) VALUES (?,?)";
        $stmt = mysqli_stmt_init($conn);
        //prepare the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../professorportal.php?error=sqlerror");
            exit();
        } else {
            //bind team name and course id, and execute statement
            mysqli_stmt_bind_param($stmt, "si", $teamName, $courseID);
            mysqli_stmt_execute($stmt);
            header("Location: ../professorportal.php?result=groupcreated");
        }
    }
}
