<!DOCTYPE html>
<html>
    
    <head>
        <title>EMINEM</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header><div id="logo"><img src="logo.png"></div></header>
        <div id="wrapper">
            <div id="content">
<?php

	$a = $_GET["id"];
	
	$connection = curl_init();
	curl_setopt($connection, CURLOPT_URL, "http://edward2.solent.ac.uk/~oldfieldj/wad/downloadwebservice.php");
	$dataToPost = array
		("id" => "$a");
	curl_setopt($connection,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($connection,CURLOPT_POSTFIELDS,$dataToPost);
	$response = curl_exec($connection);
	curl_close($connection);
	
	if($response == "SONG_PURCHASED")
	{
		echo "<img src='thumbsup.jpg' alt='eminem'>";
		echo "<p>Purchase Complete.</p>";
	}
	if($response == "INSUFFICIENT_FUNDS")
	{
		echo "<p>You have insufficient funds.</p>";
	}
	echo "<a href='http://edward/~oldfieldj'>Home</a>";

	
?>
			</div>
		</div>
	</body>
</html>