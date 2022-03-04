<?php 

	$servername = "localhost";
	$dbname = "car_rental";
	$dbuser = "root";
	$dbpassword = "";

	$dsn = "mysql:host=$servername;dbname=$dbname";
	$pdo= new PDO($dsn,$dbuser,$dbpassword);

	try{

		$conn =$pdo;
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		// echo "Connection Success";

	}catch(PDOException $e)
	{
		die("Connection fail:".$e->getMessage());
	}

?>