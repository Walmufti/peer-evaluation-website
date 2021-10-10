<?php
//make sure session is started wthin all pages
session_start();
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="This is what will show up in search results">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMU Peer Evaluation</title>
    <link rel="stylesheet" href="css/header2.css">
    <script src="//rum-static.pingdom.net/pa-607c462e365abb0011000231.js" async></script>
</head>

<body>

    <div class="navbar">

        <div class="dropdown">
            <div onclick="toggleMenu(); animateMenuIcon(this);" class="dropbtn">
                <div class="menu-bar1"></div>
                <div class="menu-bar2"></div>
                <div class="menu-bar3"></div>
            </div>


            <div id="menu-dropdown" class="dropdown-content">
                <a href="/SMU-Website">Home</a>

                <?php
                if (isset($_SESSION['userUid'])) {
                    echo "<a href='userProjects'>My Projects</a>";
                    if (isset($_SESSION['userStatus'])) {
                        if ($_SESSION['userStatus'] == "Admin" || $_SESSION['userStatus'] == "Developer") {
                            echo "<a href='assignedProjects'>Assigned Projects</a>";
                            if ($_SESSION['userStatus'] == "Admin") {
                                echo "<a href='adminLevelProjects'>Admin Projects Page</a>";
                            } else {
                            }
                        } else {
                        }
                    } else {
                        //not set
                    }
                }
                ?>

                <!--line through the menu-->
                <div class="menu-divider">
                </div>

                <div class="signup-in">

                    <?php
                    //this changes content based on if logged in or not
                    if (isset($_SESSION['userUid'])) {
                        echo '<p id="navbarWelcomeText">Welcome <b>' . $_SESSION['userUid'] . '</b><br>' . $_SESSION['userStatus'] . '</p>
								<form action="includes/logout.inc.php" method="post">
		 							<button type="submit" name="logout-submit" id="logoutButton">Logout</button>
		 							</form>';
                    } else {
                        echo '<form action="includes/login.inc.php" method="post">
		 							<input type="text" name="mailuid" placeholder="Username/Email"><br />
		 							<input type="password" name="pwd" placeholder="Password"><br />
		 							<button type="submit" name="login-submit" id="loginButton">Login</button><br />
		 							<a href="signup" id="registerLink">Register</a>
		 							<a href="resetPassword" id="forgotPasswordLink">Forgot Password?</a>
		 							</form>';
                    }

                    ?>

                </div>
            </div>

        </div>

        <script>
            /* When the user clicks on the button,
			   toggle between hiding and showing the dropdown content */
            function toggleMenu() {
                document.getElementById("menu-dropdown").classList.toggle("show");
            }

            function animateMenuIcon(x) {
                x.classList.toggle("menuIconChange");
            }

            // Close the dropdown menu if the user clicks outside of it
            /*window.onclick = function(event) {
              if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                  var openDropdown = dropdowns[i];
                  if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                  }
                }
              }
            }*/
        </script>


        <div class="header-logo">
            <!-- Add a logo here -->
            <img src="img/smuHeader.svg" id="navbar-logo" alt="logo">

        </div>

    </div>
</body>
</html>
