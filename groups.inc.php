<?php

if (isset($_POST['create-group'])) {
    //Add database handler
    require "dbh.inc.php";
    //Check if tableName is empty

    $teamName = $_POST['teamName'];
    if ($teamName == "") {
        header("Location: ../professor_portal.php?error=invalidteamname");
    }
    //check if a course is selected
    else if (!isset($_POST['CourseSelect'])) {
        header("Location: ../professor_portal.php?error=invalidcourse");
    } else {
        //store POST variables as local variables
        $courseID = $_POST['CourseSelect'];
        //insert into student group table
        $sql = "INSERT INTO student_group (team_name, prof_course_id) VALUES (?,?)";
        $stmt = mysqli_stmt_init($conn);
        //prepare the statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../professor_portal.php?error=sqlerror");
            exit();
        } else {
            //bind team name and course id, and execute statement
            mysqli_stmt_bind_param($stmt, "si", $teamName, $courseID);
            mysqli_stmt_execute($stmt);
            header("Location: ../groups.php?result=groupcreated");

        }
    }
}
