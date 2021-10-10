<?php
include "header.php";
if (!isset($_SESSION['student_id'])) {
  header("Location: ./?error=notloggedin");
  exit();
}
?>

<head>
  <link rel="stylesheet" href="css/peerevaluation.css">
</head>
<div class="eval">


  <form action="includes/peer_evaluation_submit.inc.php" method="post" name="peerEval">


    <?php
    foreach ($_SESSION['student_list'] as &$student) {
      echo '<hr> <label>Student Name: ' . $student[1] . ' ' . $student[2] . '</label>
    <br><br>
    <div class="row">
      <div class="criterion">
        <p class="title">Evaluation</p>
      </div>
      <div class="column">
        <h3>0</h3>
      </div>
      <div class="column">
        <h3>1</h3>
      </div>
      <div class="column">
        <h3>2</h3>
      </div>
      <div class="column">
        <h3>3</h3>
      </div>
      <div class="lastColumn">
        <h3>4</h3>
      </div>
    </div>';

      if (isset($_SESSION['criterion'])) {
        for ($i = 0; $i < count($_SESSION['criterion']); $i++) {
          echo '<div class="row">';
          echo '<div class="criterion">';
          echo '<p>' . $_SESSION['criterion'][$i] . '</p>';
          echo '</div>';
          echo '<div class="column">';
          echo '<input type="radio" id="' . $_SESSION['criterion'][$i] . '0" name="' . $_SESSION['criterion'][$i] . $student[0] . '" value="0" required> <label for="' . $_SESSION['criterion'][$i] . '0">0</label>';
          echo '</div>';
          echo '<div class="column">';
          echo '<input type="radio" id="' . $_SESSION['criterion'][$i] . '1" name="' . $_SESSION['criterion'][$i] . $student[0] . '" value="1" required> <label for="' . $_SESSION['criterion'][$i] . '1">1</label>';
          echo '</div>';
          echo '<div class="column">';
          echo '<input type="radio" id="' . $_SESSION['criterion'][$i] . '2" name="' . $_SESSION['criterion'][$i] . $student[0] . '" value="2" required> <label for="' . $_SESSION['criterion'][$i] . '2">2</label>';
          echo '</div>';
          echo '<div class="column">';
          echo '<input type="radio" id="' . $_SESSION['criterion'][$i] . '3" name="' . $_SESSION['criterion'][$i] . $student[0] . '" value="3" required> <label for="' . $_SESSION['criterion'][$i] . '3">3</label>';
          echo '</div>';
          echo '<div class="column">';
          echo '<input type="radio" id="' . $_SESSION['criterion'][$i] . '4" name="' . $_SESSION['criterion'][$i] . $student[0] . '" value="4" required> <label for="' . $_SESSION['criterion'][$i] . '4">4</label>';
          echo '</div>';
          echo '</div>';
        }
      } else {
        echo '<p>No Criterion</p>';
      }

      echo '
    <div class="AdditionalComments">

      <h1>Additional Comments</h1>
      <textarea style="width: 100%" name="AddComm'.  $student[0] . '" rows="8" maxlength="250"></textarea>
    </div>

    <!--includes/peer_evaluation_submit.inc.php-->';
    }
    ?>
    <div class="buttons">
      <button type="submit">Submit</button>
    </div>
  </form>
</div>
