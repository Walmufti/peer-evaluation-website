    <?php
    include "header.php";
    ?>

    <head>
        <link rel="stylesheet" href="css/contact.css">
    </head>

    <!--THIS IS THE CONTACT FORM-->
    <form action="includes/contact.inc.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="nameUser" placeholder="John"><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="emailUser" placeholder="test@test.com"><br><br>
        <label for="subject">Subject:</label><br>
        <input type="text" id="subject" name="subjectText" placeholder="subject"><br><br>
        <label for="message">Message:</label><br>
        <input type="text" id="message" name="messageText" placeholder="message"><br><br>
        <button type="submit" name="contact-submit"> Submit </button>
    </form>
    <!--CONTACT FORM END-->


    <?php
    include "footer.php";
    ?>