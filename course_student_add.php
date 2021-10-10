<?php
include "header.php";
if (!isset($_SESSION['professor_id'])) {
  header("Location: ./?error=notloggedin");
  exit();
}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/course_file_upload.css">
<body>

  <div class="row">
    <!--select student-->
    <div class="column">
      <h1>Import Students</h1>
      <div class="choosefile">
        <!--drop down list-->
        <form action="includes/course_student_add.inc.php" method="post" enctype="multipart/form-data">

          <select name="CourseSelect">
            <?php
            session_start();
            if (isset($_SESSION['course_info'])) {
              for ($i = 0; $i < count($_SESSION['course_info']); $i++) {
                echo '<option value="' . $_SESSION['course_info'][$i][0] . '">' . $_SESSION['course_info'][$i][2] . '</option>';
              }
            } else {
              echo '<option value="" disabled selected hidden>No Courses Available</option>';
            }
            ?>
          </select>

          <br>
          <label>Select Student File:</label>
          <input type="file" name="fileToUpload" id="fileToUpload"><br>
          <label>Enter Student First Name:<input type="text" name="studentfname"></label><br>
          <label>Enter Student Last Name:<input type="text" name="studentlname"></label><br>
          <input type="submit" value="Import Student" name="student-import"><br>
        </form>
      </div>
    </div>

    <!--select image-->
    <div class="column">
      <h1>Import Courses</h1>
      <div class="choosefile">
        <!--drop down list-->
        <form action="includes/course_student_add.inc.php" method="post" enctype="multipart/form-data">
          Select CSV to Upload:
          <input type="file" name="fileToUpload" id="fileToUpload"><br>
          <label>Enter Course Number:<input type="text" name="coursename"></label><br>
          <label>Enter Course Term:<input type="text" name="termnum"></label><br>
          <input type="submit" value="Import Course" name="course-import">
        </form>
      </div>
    </div>
  </div>



<!--JavaScript-->
  <script>
    var close = document.getElementsByClassName("closebtn");
    var i;

    for (i = 0; i < close.length; i++) {
      close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
      }
    }
  </script>

</body>
</html>
