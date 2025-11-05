<?php
// $pdo = new PDO('mysql:host=localhost;port=3306;dbname=apah');
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$pdo = new PDO('mysql:localhost;port=8889;dbname=misc', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);