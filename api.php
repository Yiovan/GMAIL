<?php

require_once "conexion.php";
     
$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

$query = "INSERT INTO datos (name, email, subject, mensaje) VALUES ($1, $2, $3, $4)";
$result = pg_query_params($conn, $query, array($name, $email, $subject, $message));

if (!$result) {
    die("Error al guardar en la base de datos.");
}




require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;       

$mail = new PHPMailer(exceptions: true);

//$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Disable debug output

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = 'smtp.gmail.com';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587; 

$mail->Username = "giovannicabrerarivas@gmail.com";
$mail->Password = "bqxh suom gtei hwkd";

$mail->setFrom($email , $name);
$mail->addAddress('giovannicabrerarivas@gmail.com', 'Formulario de contacto');
$mail->addReplyTo($email, $name);
$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();

header("Location: sent.html");


