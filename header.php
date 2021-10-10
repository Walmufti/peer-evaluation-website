<?php
include "analytics.php";
?>

<!DOCTYPE html>
<html>

  <head>
      <link rel="stylesheet" href="css/header.css">
      <script src="js/jQuery.js"></script>
  	  <script src="//rum-static.pingdom.net/pa-607c462e365abb0011000231.js" async></script>
  </head>

      <header>
          <img class="logo" src="img/smuHeader.svg" alt="smu">

          <?php
          session_start();
          if(isset($_SESSION["student_id"]) || isset($_SESSION["professor_id"]) || isset($_SESSION["admin_id"])){
          echo'<a class="headerRight headerBtn" href="includes/logout.inc.php">Logout</a>';
          }
          ?>
          <a class="headerRight headerBtn" href="/SMU-Website">Home</a>
      </header>

</html>

<!--ERROR Messages-->
<?php
if ($_SERVER['QUERY_STRING'] == "error=inputerror" /*ERROR MESSAGE: information input error*/) {
    echo '<div class="alert warning" name="errorinput">
      <span class="closebtn">&times;</span>
      <strong>ERROR:</strong> Fill in all inputs.
    </div>';
}
else if ($_SERVER['QUERY_STRING'] == "result=groupcreated" /*ERROR MESSAGE*/) {
  echo '<div class="alert success" name="createdgroup">
  <span class="closebtn">&times;</span>
  <strong>Success:</strong> Group has been created.
</div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=wrongpwd" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert warning" name="wrongpassword">
    <span class="closebtn">&times;</span>
    <strong>ERROR:</strong> Password is incorect.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=nouser" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert warning" name="nousername">
    <span class="closebtn">&times;</span>
    <strong>ERROR:</strong> Username is incorect.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=emptyfields" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert warning" name="fieldsempty">
    <span class="closebtn">&times;</span>
    <strong>ERROR:</strong> Fill out all text boxes.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=sqlerror" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert warning" name="sqle">
    <span class="closebtn">&times;</span>
    <strong>ERROR:</strong> Sorry, there was a problem with the database.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=invalidcourse" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert warning" name="courseinvalid">
    <span class="closebtn">&times;</span>
    <strong>ERROR:</strong> Course does not exist.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=invalidteamname" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert warning" name="teamname">
    <span class="closebtn">&times;</span>
    <strong>ERROR:</strong> Team does not exist.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "result=contactsuccess" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert success" name="successcontact">
    <span class="closebtn">&times;</span>
    <strong>Success:</strong> Your message was sent successfully.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "result=courseadded" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert success" name="addedcourse">
    <span class="closebtn">&times;</span>
    <strong>Success:</strong> Course was added successfully.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=invaliddata" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert warning" name="datainvalid">
    <span class="closebtn">&times;</span>
    <strong>ERROR:</strong> Data is invalid.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=fileservererror" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert warning" name="serverfileerror">
    <span class="closebtn">&times;</span>
    <strong>ERROR:</strong> There was an error with the file server.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=notcsv" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert warning" name="csverror">
    <span class="closebtn">&times;</span>
    <strong>ERROR:</strong> The file is a CSV file.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=servererror" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert warning" name="errorserver">
    <span class="closebtn">&times;</span>
    <strong>ERROR:</strong> There was an error with the server.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "result=coursecreated" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert success" name="createdcourse">
    <span class="closebtn">&times;</span>
    <strong>Success:</strong> Course was created.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "result=groupcreated" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert success" name="createdgroup">
    <span class="closebtn">&times;</span>
    <strong>Success:</strong> Group was created.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "result=evalsubmitted" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert success" name="sumbmittedeval">
    <span class="closebtn">&times;</span>
    <strong>Success:</strong> Evaluation was submitted successfully.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "user=accountcreated" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert success" name="createdaccount">
    <span class="closebtn">&times;</span>
    <strong>Success:</strong> Your account was created successfully.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "user=peerevalassigned" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert success" name="assignedpeereval">
    <span class="closebtn">&times;</span>
    <strong>Success:</strong> You have been assigned a peer evaluation.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "user=studentassigned" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert success" name="successcontact">
    <span class="closebtn">&times;</span>
    <strong>Success:</strong> Student has been assigned to a group.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "result=studentadded" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert success" name="addedstudent">
    <span class="closebtn">&times;</span>
    <strong>Success:</strong> Student was added successfully.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=invalidname" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert warning" name="nameinvalid">
    <span class="closebtn">&times;</span>
    <strong>ERROR:</strong> Name is invalid.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=invaliddate" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert warning" name="dateinvalid">
    <span class="closebtn">&times;</span>
    <strong>ERROR:</strong> Can not select a passed date.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "result=scheduled" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert success" name="scheduled">
    <span class="closebtn">&times;</span>
    <strong>Success:</strong> Scheduled successfully.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=selectdate" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert warning" name="nodate">
    <span class="closebtn">&times;</span>
    <strong>ERROR:</strong> Select a date.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=emailtaken" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert warning" name="takenemail">
    <span class="closebtn">&times;</span>
    <strong>ERROR:</strong> Email is already used. Enter a new email.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "result=courseadded" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert success" name="addedcourse">
    <span class="closebtn">&times;</span>
    <strong>Success:</strong> The course has been added successfully.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "result=termcreated" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert success" name="addedterm">
    <span class="closebtn">&times;</span>
    <strong>Success:</strong> The term has been added successfully.
  </div>';
}
else if ($_SERVER['QUERY_STRING'] == "error=passwordmissmatch" /*ERROR MESSAGE: information input error*/) {
  echo '<div class="alert warning" name="passmiss">
    <span class="closebtn">&times;</span>
    <strong>ERROR:</strong> Enter in the same password.
  </div>';
}

/*
error=wrongpwd
error=nouser
error=emptyfields
error=sqlerror
error=invalidcourse
error=invalidteamname
result=contactsuccess
result=courseadded
error=invaliddata
error=fileservererror
error=notcsv
error=servererror
result=coursescreated
result=groupcreated
result=evalsumbitted
user=accountcreated
user=peerevalassigned
user=studentassigned
result=studentadded
error=invalidname
*/
?>


<script>
    var close = document.getElementsByClassName("closebtn");
    var i;

    for (i = 0; i < close.length; i++) {
        close[i].onclick = function() {
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function() {
                div.style.display = "none";
            }, 600);
        }
    }
</script>
