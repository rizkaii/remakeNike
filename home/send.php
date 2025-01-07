<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Autoload PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Tangkap data formulir dengan pemeriksaan keamanan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'], $_POST['email'], $_POST['message'])) {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        // Buat instance PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Konfigurasi server SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'rizallazuardi45@gmail.com';
            $mail->Password   = 'befk fbee ksza srhs';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Informasi email
            $mail->setFrom('rizallazuardi45@gmail.com', 'Website Contact Form');
            $mail->addAddress('rizallazuardi45@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = "New Contact Message";
            $mail->Body    = "<strong>Name:</strong> $name<br><strong>Email:</strong> $email<br><br><strong>Message:</strong><br>$message";

            $mail->send();
            echo "<script>
            alert('Message sent successfully!');
            window.location.href = 'index.php';
            </script>";
        } catch (Exception $e) {
            echo "<script>
            alert('Failed to send message: {$mail->ErrorInfo}');
            window.location.href = 'index.php';
            </script>";
        }
    } else {
        echo "Form data is missing.";
    }
}
?>
