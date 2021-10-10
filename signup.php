<?php
include "header.php";
?>

<head>
    <script src="js/signup.js"></script>
    <link rel="stylesheet" href="css/signup.css">
</head>

<br><br><br>

    <!--select a button for student or professor-->
  <div class="register">
    <h1>Sign Up:</h1>
    <h3>Are you a student or professor?</h3>
    <p><input type="radio" onclick="stuShow()" name="person" value="st"><label>Student</label></p>
    <p><input type="radio" onclick="profShow()" name="person" value="pr"><label>Professor</label></p>
  </div>
<br>

<div>
    <h1>Sign Up:</h1>
</div>



<h1>STUDENT SIGNUP</h1>



<!--THIS IS THE SIGNUP FORM FOR STUDENTS-->
<!--MAYBE MAKE A RADIO BUTTON TO SWITCH BETWEEN PROFESSOR AND STUDENT SIGNUP FORM?-->
<div class="info">
  <div id="stu" style="display: none">
      <form action="includes/student_signup.inc.php" method="post">
          <label for="fName">First Name:</label><br>
          <input type="text" id="fName" name="fName" placeholder="John"><br>
          <label for="lName">Last Name:</label><br>
          <input type="text" id="lName" name="lName" placeholder="Doe"><br>
          <label for="major">Major:</label><br>
          <input type="text" id="major" name="major" placeholder="BIT"><br><br>
          <label for="email">Email:</label><br>
          <input type="text" id="email" name="email" placeholder="test@test.com"><br><br>
          <label for="pwd">Password:</label><br>
          <input id="pwd" type="password" name="pwd" placeholder="Password"><br>
          <label for="repeatpwd">Password Confirm:</label><br>
          <input id="repeatpwd" type="password" name="repeatpwd" placeholder="Repeat Password"><br>
          <button type="submit" name="student-signup"> Submit </button>
      </form>
  </div>
</div>
<!--SIGNUP FORM END-->



<h1>PROF SIGNUP</h1>



<!--THIS IS THE SIGNUP FORM FOR PROFESSORS-->
<!--MAYBE MAKE A RADIO BUTTON TO SWITCH BETWEEN PROFESSOR AND STUDENT SIGNUP FORM?-->
<div class="info">
  <div id="pro" style="display: none">
      <form action="includes/professor_signup.inc.php" method="post">
          <label for="name">First Name:</label><br>
          <input type="text" id="fname" name="fName" placeholder="John"><br>
          <label for="name">Last Name:</label><br>
          <input type="text" id="lname" name="lName" placeholder="Doe"><br>
          <label for="email">Email:</label><br>
          <input type="text" id="email" name="email" placeholder="test@test.com"><br><br>
          <label for="pwd">Password:</label><br>
          <input id="pwd" type="password" name="pwd" placeholder="Password"><br>
          <label for="repeatpwd">Password Confirm:</label><br>
          <input id="repeatpwd" type="password" name="repeatpwd" placeholder="Repeat Password"><br>
          <button type="submit" name="professor-signup"> Submit </button>
      </form>
  </div>
</div>
<!--SIGNUP FORM END-->


<?php
include "footer.php";
?>
