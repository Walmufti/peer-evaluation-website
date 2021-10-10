<?php
include "header.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="css/register.css">
  <head>
    <meta charset="utf-8">
    <title>register</title>
  </head>
  <body>

    <h1>Register a New Account!</h1>

  <div class="register">
    <h3>Are you a Student, Instructor, or a Administrator?</h3>
      <p><input type="radio" name="typeselect" value="Student">
        <label>Student</label></p>
      <p><input type="radio" name="typeselect" value="Instructor">
        <label>Instructor</label></p>
      <p><input type="radio" name="typeselect" value="Administrator">
        <label>Administrator</label></p>

        <label>Eneter email:</label>
          <input type="text" name="email" value="@smu.edu.sg"><br>
        <label>Confirm email:</label>
          <input type="text" name="email" value="@smu.edu.sg"><br>
        <label>Enter password:</label>
          <input type="text" name="password"><br>
        <label>Confirm password:</label>
          <input type="text" name="password"><br>
      <button type="submit"> SUBMIT </button>
  </div>

  </body>
</html>
