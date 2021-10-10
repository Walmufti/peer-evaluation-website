<?php
include "header.php";
if (!isset($_SESSION['student_id'])) {
  header("Location: ./?error=notloggedin");
  exit();
}
?>


<!--Dropdown menus for course title and course ID. Populate both dropdown menus from student's available courses-->
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Student Portal</title>

  <link rel="stylesheet" href="css/studentportal.css">


</head>

<body>

  <div>

    <h1>Student Portal</h1>
    <br>
    <?php
    if (isset($_SESSION['fName']) && isset($_SESSION['lName']) && isset($_SESSION["professor_id"])) {
      echo '<h2 style="text-align: center" name="welcome">Welcome ' . $_SESSION['fName'] . " " . $_SESSION['lName'] . '</h2>';
    }
    ?>
    <br>
  </div>

  <div class="courseInfo">

    <h2 style="float: left">Course Information</h2><br><br><br><br>

    <!--course title-->
    <form action="includes/populate_peer_eval.inc.php" method="post" name="welcome">
      <label>Course Title </label>
      <select name="EvalSelect">
        <?php
        if (isset($_SESSION['availEval'])) {
          for ($i = 0; $i < count($_SESSION['availEval']); $i++) {
            echo '<option value="'. $_SESSION['availEval'][$i][0] .'">' . 'Eval ID: ' . $_SESSION['availEval'][$i][0] . ' Start Date: ' . $_SESSION['availEval'][$i][1] . ' End Date: ' . $_SESSION['availEval'][$i][2] . ' Team Name: ' . $_SESSION['availEval'][$i][3] . '</option>';
          }
        } else {
          echo '<option value="-1" disabled selected hidden>No Evaluations Available</option>';
        }
        ?>
      </select>
      <div class="buttons">
        <button type="submit" name="eval">Submit</button>
      </div>
    </form>
    </label></p>

  </div>

</body>

</html>