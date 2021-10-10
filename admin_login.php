<?php
include "header.php";
if (isset($_SESSION['admin_id'])) {
    header("Location: ./admin_portal.php");
    exit();
  }
?>

<head>
    <link rel="stylesheet" href="css/admin_login.css">
</head>

<!--administrator login page-->
<h1>Administrator<br>Login</h1>
<div class="adminlog">
  <form action="includes/admin_login.inc.php" method="post" name="adminLogin">
        <p><label>User Name <br>
                <input type="text" name="userEmail" required>
            </label></p>
        <p><label>Password <br>
                <input type="password" type="text" name="userPass" required>
            </label></p>
        <div class="buttons">
            <button type="submit" name="login-submit">Log In</button>
        </div>
  </form>
</div>
