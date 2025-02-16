<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $destination = $_POST['destination'];
    $departureDate = $_POST['departureDate'];
    $returnDate = $_POST['returnDate'];
    $travelers = $_POST['travelers'];

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tinygoon0@gmail.com'; // Your Gmail address
        $mail->Password   = '@Cacti_Tracy'; // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('tinygoon0@gmail.com', 'Booking Confirmation');
        $mail->addAddress($email, $name);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Your Booking Confirmation';
        $mail->Body    = "
            <h2>Booking Details</h2>
            <p>Dear $name,</p>
            <p>Thank you for booking your trip with us. Here are your booking details:</p>
            <p><strong>Destination:</strong> $destination</p>
            <p><strong>Departure Date:</strong> $departureDate</p>
            <p><strong>Return Date:</strong> $returnDate</p>
            <p><strong>Number of Travelers:</strong> $travelers</p>
            <p>We wish you a pleasant journey!</p>
        ";

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
