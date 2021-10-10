<?php

//have session started to end it
session_start();

//takes all session variables and deletes all values
session_unset();

//destroys the session
session_destroy();

header("Location: ../index.php");