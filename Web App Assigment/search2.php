<?php
	header("Content-type: application/json");
	$a = $_GET["artist"];

	$conn = new PDO("mysql:host=localhost;dbname=dftitutorials;","dftitutorials", "dftitutorials");

	$result = $conn->query("SELECT * FROM wadsongs WHERE artist LIKE '%$a%'");
						   
	$rows = $result->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode($rows);
?>