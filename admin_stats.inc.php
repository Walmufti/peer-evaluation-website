<?php

//To view the currently scheduled peer evaluations

session_start();

require 'dbh.inc.php';

$sql = "SELECT Count(id) as 'total students' from student;";

$stmt = mysqli_stmt_init($conn);

//helps keep database safe
if (!mysqli_stmt_prepare($stmt, $sql)) {
    //close the sqli connection to save resources
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../index.php?error=sqlerror");
    exit();
} else {
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    //save the criterion as session variables for output on page
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        echo 'Total Students: ' . $row["total students"];
    }
    echo '<br><br>';


    $sql = "SELECT id, first_name, last_name, email_address from student;";

    $stmt = mysqli_stmt_init($conn);

    //helps keep database safe
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        //close the sqli connection to save resources
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        //save the criterion as session variables for output on page
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            echo $row["id"] . ' ';
            echo $row["first_name"] . ' ';
            echo $row["last_name"] . ' ';
            echo $row["email_address"] . '<br>';
        }
        echo '<br><br>';

        $sql = "select count(id) as 'total professors' from professor;";

        $stmt = mysqli_stmt_init($conn);

        //helps keep database safe
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            //close the sqli connection to save resources
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            //save the criterion as session variables for output on page
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                echo 'Total Professors: ' . $row["total professors"];
            }
            echo '<br><br>';

            $sql = "select id, first_name, last_name, email_address from professor;";

            $stmt = mysqli_stmt_init($conn);
    
            //helps keep database safe
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                //close the sqli connection to save resources
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: ../index.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_execute($stmt);
    
                $result = mysqli_stmt_get_result($stmt);
                //save the criterion as session variables for output on page
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    echo $row["id"] . ' ';
                    echo $row["first_name"] . ' ';
                    echo $row["last_name"] . ' ';
                    echo $row["email_address"] . '<br>';
                }
                echo '<br><br>';
                //close the sqli connection to save resources
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                //header("Location: ../professor_portal.php?user=scheduledevalrefreshed");
                exit();
            }
        }
    }
}
