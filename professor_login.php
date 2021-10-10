<?php
include "header.php";
if (isset($_SESSION['professor_id'])) {
    header("Location: ./professor_portal.php");
    exit();
  }
?>

<head>
    <link rel="stylesheet" href="css/professor_login.css">
</head>



<body>

    <form action="includes/professor_login.inc.php" method="post" name="professorLogin">

        <h1>Instructor<br>Login</h1>

        <div class="login">


            <div class="labels">
                <p><label>User Name <br>
                        <input type="text" name="userEmail" required>
                    </label></p>

                <p><label>Password <br>
                        <input type="password" type="text" name="userPass" required>
                    </label></p>
                <div class="buttons">
                    <button type="submit" name="login-submit">Log In</button>
                </div>
            </div>
        </div>
    </form>

</body>
