<?php
include "header.php";
if (!isset($_SESSION['professor_id'])) {
    header("Location: ./?error=notloggedin");
    exit();
  }
?>

<link rel="stylesheet" href="css/groups_list.css">

<h1>Select Group</h1>



<div class="courseInfo">

<form action="includes/student_to_group.inc.php" method="post">
    <!--course name-->
    <label>Group Name:</label>
    <select name="GroupSelect">
        <?php
        if (isset($_SESSION['team_info'])) {
            for ($i = 0; $i < count($_SESSION['team_info']); $i++) {
                echo '<option value="' . $_SESSION['team_info'][$i][0] . '">' . $_SESSION['team_info'][$i][0] . ' ' . $_SESSION['team_info'][$i][1] . '</option>';
            }
        } else {
            echo '<option value="" disabled selected hidden>No Groups Available</option>';
        }
        ?>
    </select><br>

    <!--student list-->
    <label>Student List:</label>
    <select name="StudentSelect">
        <?php
        if (isset($_SESSION['student_list'])) {
            for ($i = 0; $i < count($_SESSION['student_list']); $i++) {
                echo '<option value="' . $_SESSION['student_list'][$i][0] . '">' . $_SESSION['student_list'][$i][0] . ' ' . $_SESSION['student_list'][$i][1]  . ' ' . $_SESSION['student_list'][$i][2]. '</option>';
            }
        } else {
            echo '<option value="" disabled selected hidden>No Students Available</option>';
        }
        ?>
    </select><br>

    <!--submit button-->
    <button onclick="window.location='group_list_success.php';" type="submit" name="create-group"> Submit </button>

</form>
</div>
<br>
<div style="text-align: center">

<?php
require 'includes/dbh.inc.php';

$sql = "SELECT first_name, last_name, team_name
from student
join group_assign ON student.id = group_assign.student_id
join student_group ON group_assign.group_id = student_group.id
join professor_course ON student_group.prof_course_id = professor_course.id
where professor_course.id = ?";

$stmt = mysqli_stmt_init($conn);

//helps keep database safe
if (!mysqli_stmt_prepare($stmt, $sql)) {
  //close the sqli connection to save resources
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  header("Location: ../index.php?error=sqlerror");
  exit();
} else {
  mysqli_stmt_bind_param($stmt, "i", $_SESSION['professor_courseSelected']);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  //save the criterion as session variables for output on page
  unset($_SESSION['group_schedule']);
  $i = 0;
  echo "Currently assigned students:<br>";
  while ($row = $result->fetch_assoc()) {
    echo $row["first_name"] . ", ";
    echo $row["last_name"] . ", ";
    echo $row["team_name"] . "<br>";
    $i++;
  }

  //close the sqli connection to save resources
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}

?>
</div>
