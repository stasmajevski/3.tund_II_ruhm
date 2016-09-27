<?php

// me peame uhendama lehed, et session tootaks
	require("functions.php");
	// kui ei ole kasutajat id'd
	if(!isset($_SESSION["userID"]))
	{
		//suunan sisselogimise lehele
		header("Location: login.php");
	}
	
	//kui on ?logout aadressireal siis login valja
	if(isset($_GET["logout"]))
	{
		session_destroy();
		header("Location: login.php");
	}

?>
<h1>Data</h1>

<p>Tere tulemast <?=$_SESSION["userEmail"];?>!</p>
<a href="?logout=1">Logi välja</a>


