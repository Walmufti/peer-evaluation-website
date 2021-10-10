<?php
include "header.php";
?>

<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/student_peer_eval.css">
  <title>student_peer_eval</title>
</head>

<body>

  <h1>Schedule Peer Evaluation</h1>

  <form action="includes/group_data.inc.php" method="post">

    <div class="cgroup">
      <label>Select Course:</label>
      <select name="SelectCourse">
        <?php
        if (isset($_SESSION['course_info'])) {
          for ($i = 0; $i < count($_SESSION['course_info']); $i++) {
            echo '<option value="' . $_SESSION['course_info'][$i][0] . '">' . $_SESSION['course_info'][$i][2] . '</option>';
          }
        } else {
          echo '<option value="" disabled selected hidden>No Courses Available</option>';
        }
        ?>
      </select><br>

<!--
  <br>
      <label>Select Class:</label>
      <select name="SelectClass"></select>
  <br>
      <label>Select Group:</label>
      <select name="SelectGroup"></select>
  <br>

        <label>Select Date:</label>
        <input type="date" id="calendar" name="startdateselect">
-->

      <br>
      <button name="course-submit" type="submit"> SUBMIT </button>
    </div>
  </form>

</body>

</html>
