<?php 
    $servername = 'localhost';
    $user = 'root';
    $pass = 'Chicken1!';
    $dbname = 'rentacar';

    $cnx = new mysqli($servername, $user, $pass, $dbname);

    if ($cnx->connect_error){
		die("Database connection failed: " . $cnx->connect_error);
	}
?>