<?php

	$a = $_GET["artist"];
	
	$conn = new PDO("mysql:host=localhost;dbname=dftitutorials;","dftitutorials", "dftitutorials");
	
	if(isset($_GET["artist"]))
	{
		$result = $conn->query("SELECT * FROM wadsongs WHERE artist LIKE '%$a%' ORDER BY downloads DESC LIMIT 40");
		$rows = $result->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($rows);
	}
	else
	{
		$result = $conn->query("SELECT * FROM wadsongs ORDER BY downloads DESC LIMIT 40");
		$rows = $result->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($rows);
		
	}
	
?>