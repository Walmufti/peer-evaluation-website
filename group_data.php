<?php
include "header.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <link rel="stylesheet" href="css/group_data.css">
  <meta charset="utf-8">
  <title>groupdata</title>
</head>

<body>


  <div class="group_list">
    <?php

    echo "You are scheduling evaluations for:<br>";

    if (isset($_SESSION['group_schedule'])) {
      foreach ($_SESSION['group_schedule'] as $groupID) {
        echo $groupID . ' ';
      }
    }
    ?>
  </div><br><br><br><br><br>

  <form action="includes/schedule_peer_eval.inc.php" method="post">
    <div class="data">
      <label>Start:</label>
      <input type="date" id="calendar" name="startdateselect">
      <label>End:</label>
      <input type="date" id="calendar" name="enddateselect">
      <br>
      <button type="submit" name="eval-schedule"> SUBMIT </button> <!-- ??? onclick when button is submission for a form ??? -->
    </div>
  </form>
</body>

</html>
