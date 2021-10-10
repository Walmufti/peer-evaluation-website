<!--Take in student username and password. Forgot username and forgot password buttons-->
<?php
include "header.php";
if (isset($_SESSION['student_id'])) {
  header("Location: ./student_portal.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>studentlogin</title>

  <link rel="stylesheet" href="css/studentlogin.css">

  <style src="js/index.js">
  </style>

</head>

<body>


  <div class="StudentLogin">
    <h1>Student Login</h1>
    <form action="includes/student_login.inc.php" method="post" name="studentLogin">

      <div class="inputs">
    <p><label>User Name <br>
          <input type="text" name="userEmail" required>
        </label></p>

      <p><label>Password <br>
          <input type="password" type="text" name="userPass" required>
        </label></p>
        </div>
      <div class="buttons">
        <button type="submit"  name="login-submit">Log In</button>
      </div>
    </form>
  </div>




</body>

</html>






<!--h1 {
  text-align: center;
}

body {
  background-color: tan
}

button {
  background: #06206e;
  padding: 10px 50px;
  cursor: pointer;
  color: #daf17f;
  margin: 10px;
  border-radius: 5px;
  font-size: 120%
}

.buttons {
  text-align: center;
}

.Login {
  width: 100%;
}
<body>

  <div class="Login">
    <h1>Log In</h1> <br>
    <div class="buttons">
              <button>INSTRUCTOR</button> <br>
              <button onclick="window.location='studentlogin.php';">STUDENT</button> <br>
              <button>ADMINISTRATOR</button>
            </div>
  </div>

</body>


















-->
