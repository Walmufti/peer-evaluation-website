<?php
include "header.php";
?>

<!--Login buttons for instructor, student, or administrator-->

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js"></script>
</head>

  <body>

<!--Login Buttons-->
<div class="tag">
    <img src="img/smucamp.jpg" style="width:100%">
    <div class="Login">
        <h1>Log In</h1> <br>
        <div class="buttons">
          <button onclick="window.location='professor_login.php';">INSTRUCTOR</button> <br>
          <button onclick="window.location='student_login.php';">STUDENT</button> <br>
          <button onclick="window.location='admin_login.php';">ADMINISTRATOR</button>
        </div>
        <div class="buttons">
          <h2>Or register now!</h2>
          <button onclick="window.location='signup.php';">SIGN UP</button>
        </div>
    </div>

    <div class="pictext">
      <h3>SMU is one of seven universites in Asia with the prestigious AACSB accreditation for its business and accountancy programs </h3>
    </div>
    <div class="slogan">
      <h1>To be a world-renowned global city university,<br> tackling the world's complexities,<br> impacting humanity positively</h1>
    </div>

</div>

<br><br><br>

  <div class="slideshow-container">
    <!-- Full-width images with number and caption text -->
    <div class="mySlides fade">
      <img src="img/1smu.png" style="width:100%">
      <div class="text">SMU undergrad and entrepreneur is sole Singaporean participant</div>
    </div>

    <div class="mySlides fade">
      <img src="img/2smu.png" style="width:100%">
      <div class="text">Professor's high standards in research and education benefir students</div>
    </div>

    <div class="mySlides fade">
      <img src="img/3smu.png" style="width:100%">
      <div class="text">In celebration of International Women's Day, we highlight research by SMU women faculty that had high citations and higher than expected impacts in their subject field. Their research influenced the work of many other researchers</div>
    </div>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
<br>
  <!-- The dots/circles -->
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>

<br><br><br>

<!--Award page-->
<div class="award">
  <img src="img/smuaward.jpg" style="width:100%">
    <div class="boxblue">
        <div class="blue">
          <h1>1st</h1>
          <h4>IN ECONOMETRICS IN ASIA</h4>
          <p>and among top 10 globally in the Tilburg University <br> Top 100 Economics Schools Research Ranking based on publications <br> in leading journals 2015 - 2019</p>
        </div>
    </div>
    <div class="boxred">
        <div class="red">
          <h1>1st</h1>
          <h4>IN ACCOUNTING RESEARCH IN ASIA & <br> WORLDWIDE IN CITATION RANKING</h4>
          <p>In the Bringham Young University <br> Accounting Research Rankings 2020</p>
        </div>
    </div>
    <div class="boxgreen">
      <div class="green">
        <h1>1st</h1>
        <h4>IN ASIA FOR MASTERS IN WEALTH <br> MANAGEMENT</h4>
        <p>and top 3 in the world in the Financial <br> Times Masters in Finance Rankings 2020</p>
      </div>
    </div>
    <div class="boxpurple">
      <div class="purple">
        <h1>1st</h1>
        <h4>AAHRPP</h4>
        <p>Singapore University to <br> achive AAHRPP <br> accreditation</p>
      </div>
    </div>
    <div class="boxblack">
      <div class="black">
        <h1>1st</h1>
        <h4>LEE KONG SCHOOL OF <br> BUSINESS</h4>
        <p>Triple Accredited Business School in Singapore <br> (AACSB,AMBA, EQUIS)</p>
      </div>
    </div>
</div>



<script type="text/javascript">
  var slideIndex = 1;
  showSlides(slideIndex);

  // Next/previous controls
  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  // Thumbnail image controls
  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
  }

  //Automatic Slideshow
    var slideIndex = 0;
  showSlides();

  function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}
    slides[slideIndex-1].style.display = "block";
    setTimeout(showSlides, 4000); // Change image every second
  }
</script>
</body>
</html>

<?php

include "footer.php";

?>
