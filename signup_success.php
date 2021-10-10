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
</head>

<link rel="stylesheet" href="css/stu_peer_eval_success.css">

<body>
  <div class="checkmark">
    <img src="img/checkmark.svg" alt="check">
  </div>

  <h3>Thank you! <br> Your account has been craeated <br> successfully.</h3>

  <h1>You can now Login to your account.</h1>

</body>

</html>


<?php
include "footer.php";
?>
