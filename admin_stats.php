<?php
include "header.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: ./?error=notloggedin");
    exit();
}
?>

<link rel="stylesheet" href="css/admin_stats.css">

<h1 name="stats"> Statistics</h1>

<!--php for admin statistics-->
<div class="php">

  <?php

  require 'includes/dbh.inc.php';

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


                  $sql = "select * from course;";

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
                          echo $row["course_name"] . ' ';
                          echo $row["course_number"] . ' ';
                          echo $row["date_imported"] . '<br>';
                      }
                      echo '<br><br>';
                      //close the sqli connection to save resources
                      mysqli_stmt_close($stmt);
                      mysqli_close($conn);
                  }
              }
          }
      }
  }
?>
</div>
