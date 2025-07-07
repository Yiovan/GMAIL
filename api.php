<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once "conexion.php";

$name = utf8_encode($_POST["name"]);
$email = utf8_encode($_POST["email"]);
$subject = utf8_encode($_POST["subject"]);
$message = utf8_encode($_POST["message"]);

$query = "INSERT INTO datos (name, email, subject, mensaje) VALUES ($1, $2, $3, $4)";
$result = pg_query_params($conn, $query, array($name, $email, $subject, $message));

if (!$result) {
    die("Error al guardar en la base de datos.");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = $_ENV['MAIL_USERNAME'];
$mail->Password = $_ENV['MAIL_PASSWORD'];

$mail->setFrom($email, $name);
$mail->addAddress($_ENV['MAIL_USERNAME'], 'Formulario de contacto');
$mail->addReplyTo($email, $name);
$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();

header("Location: sent.html");
