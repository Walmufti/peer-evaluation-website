<?php

//Include PHPMailer classes
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\Exception;

session_start();

function sendEmail($nameUsers, $emailUsers, $subjectText, $messageText)
{
    //Require PHPMailer libraries
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'smupeerevaluation@gmail.com';
        $mail->Password   = 'smuthmovesonly';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('no-reply@smupeerevaluation.com', 'SMU Peer Evaluation');
        $mail->addAddress('gregfairbanks21@gmail.com');

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'New message from ' . $nameUsers . " - Subject: " . $subjectText;
        $mail->Body    = '<p>Hello,<br><br>' . $messageText . '</p><p>Sincerely,<br>' . $nameUsers . '<br>' . $emailUsers . '</p>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

//checks for submit button submission
if (isset($_POST['contact-submit'])) {

    //require database handler
    require 'dbh.inc.php';
    $nameUsers = $_POST['nameUser'];
    $emailUsers = $_POST['emailUser'];
    $subjectText = $_POST['subjectText'];
    $messageText = $_POST['messageText'];

    //send email to administrators
    sendEmail($nameUsers, $emailUsers, $subjectText, $messageText);

    //insert contact into database
    $sql = "INSERT INTO contact (dayTime, nameUser, emailUser, subjectText, messageText) VALUES (NOW(), ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    //helps keep database safe
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ssss", $nameUsers, $emailUsers, $subjectText, $messageText);
        mysqli_stmt_execute($stmt);

        //close the sqli connection to save resources
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        header("Location: ../index.php?result=contactsuccess");
        exit();
    }
}
