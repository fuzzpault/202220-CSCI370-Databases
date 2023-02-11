<?php

$dsn = 'mysql:host=localhost;dbname=ticketmaster';
$username = 'root';
$password = '';
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>