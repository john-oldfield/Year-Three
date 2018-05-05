/* SCRIPT TO LOOK UP ACCOMODATION IN TASK 1*/
<?php 
    $a = $_POST["id"];
	
	$conn = new PDO("mysql:host=localhost;dbname=oldfieldj;","oldfieldj", "eroshoxe");
	
	$result = $conn->query("SELECT * FROM ht_users WHERE username ='EdwardWilson'");
	$row = $result->fetch();
?>