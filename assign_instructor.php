<?php
include "header.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/course_file_upload.css">
</head>

<body>

  <div class="row">
    <!--add a course-->
    <div class="column">
      <h1>Add Course</h1>
      <div class="choosefile">
        <!--drop down list-->
        <form action="includes/add_course.inc.php" method="post" enctype="multipart/form-data">
          <br>
          <label>Enter Course Name:<input type="text" name="cName"></label><br>
          <label>Enter Course Number:<input type="text" name="cNumber"></label><br>
          <input type="submit" value="Add Course" name="student-import"><br>

        </form>
      </div>
    </div>

    <!--ass a term-->
    <div class="column">
      <h1>Add Term</h1>
      <div class="choosefile">
        <!--drop down list-->
        <form action="includes/add_term.inc.php" method="post" enctype="multipart/form-data">

          <br>
          <!--enter term-->
          <label>Enter Term:<input type="text" name="termname"></label><br>
          <label>Start:</label>
          <input type="date" id="calendar" name="start_date">
          <label>End:</label>
          <input type="date" id="calendar" name="end_date">
          <input type="submit" value="Add Term" name="course-import">
        </form>
      </div>
    </div>
  </div>

</body>
</html>
