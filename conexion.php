<?php
$host = "localhost";
$port = "5432";
$dbname = "mail";
$user = "yio_admin";
$password = "5860464";
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
    die("Error al conectar a PostgreSQL.");
} else {
    echo "Conexión exitosa a PostgreSQL.";
}
?>