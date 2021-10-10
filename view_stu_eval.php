<?php
include "header.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/veiw_stu_eval.css">
  <title>view_stu_eval</title>
</head>

<body>

  <h1 name="view_stu_eval">Student Evaluations</h1>

  <div class="big">
    <?php
    require 'includes/dbh.inc.php';

    $sql = "SELECT DISTINCT schedule_peer_eval.id AS 'peer eval id', schedule_peer_eval.start_date AS 'start_date',
    schedule_peer_eval.end_date AS 'end_date', student_group.team_name AS 'team_name'  FROM schedule_peer_eval
    JOIN student_group ON schedule_peer_eval.group_id = student_group.id
    join professor_course on professor_course.id = student_group.prof_course_id
    where professor_course.professor_id = ?;";

    $stmt = mysqli_stmt_init($conn);

    //helps keep database safe
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      //close the sqli connection to save resources
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
      header("Location: ../index.php?error=sqlerror");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "i", $_SESSION['professor_id']);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      //save the criterion as session variables for output on page
      $i = 0;
      echo "Your currently scheduled peer evaluations:"."<br>";
      while ($row = $result->fetch_assoc()) {
        echo $row["peer eval id"] . ' ';
        echo $row["start_date"] . ' ';
        echo $row["end_date"] . ' ';
        echo $row["team_name"] . '<br>';
      }
      //close the sqli connection to save resources
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
      //header("Location: ../professor_portal.php?user=scheduledevalrefreshed");
      exit();
    }
    ?>
  </div>

</body>
</html>

<?php
include "footer.php";
?>
