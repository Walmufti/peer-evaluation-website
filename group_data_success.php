<?php
include "header.php";
if (!isset($_SESSION['professor_id'])) {
  header("Location: ./?error=notloggedin");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>peerevaluation</title>
</head>

<link rel="stylesheet" href="css/stu_peer_eval_success.css">

<body>
  <div class="checkmark">
    <img src="img/checkmark.svg" alt="check">
  </div>

  <h3>Thank you! <br> The evaluation has been assigned <br> successfully.</h3>


</body>

</html>
