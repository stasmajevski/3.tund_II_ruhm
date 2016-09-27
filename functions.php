<?php
  // functions.php
  /*
	function sum($x,$y)
	{
		
		return $x+$y;
		
	}
	echo sum(44342424,324242);
	echo "<br>";
	echo sum(1,1);
	echo "<br>";
	
	
	function hello($name,$surname)
	{
		return "Tere tulemast ".$name." ".$surname;
	}
	
	echo hello("Stas","Majevski");
	*/
	
	
	/******************************************/
	//                 SIGN UP              
	/******************************************/
	
	//var_dump($GLOBALS); // php muutuaja , sees on koik muutujad
	
	//!!!!!!!!!!
	// see file peab olema koigil lehtedel kus tahan kasutada SESSION muutujat
	session_start();
	
	
	function signUp($email,$password,$birthday,$gender)
	{
		// UHENDUS
		$database = "if16_stanislav";
		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $database);
		
		// sqli rida
		$stmt = $mysqli->prepare("INSERT INTO login (email,password,birthday,gender) VALUES (?,?,?,?)");
		
		
		echo $mysqli->error; // !!! Kui läheb midagi valesti, siis see käsk printib viga
		
		// stringina üks täht iga muutuja kohta (?), mis tüüp
		// string - s
		// integer - i
		// float (double) - d
		$stmt->bind_param("ssss",$email,$password,$birthday,$gender); // sest on email ja password VARCHAR - STRING , ehk siis email - s, password - sa
		
		//täida käsku
		if($stmt->execute())
		{
			echo "salvsestamine õnnestus";
		}
		else
		{
			echo "ERROR ".$stmt->error;
		}
		
		//panen ühenduse kinni
		$stmt->close();
		$mysqli->close();
	}
	
	function login ($email,$password)
	{
		$error = "";
		
		$database = "if16_stanislav";
		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $database);
		
		// sqli rida
		$stmt = $mysqli->prepare("SELECT id,email,password FROM login WHERE email = ?");
		
		
		echo $mysqli->error; // !!! Kui läheb midagi valesti, siis see käsk printib viga
		
		// asenad kusimargi
		$stmt ->bind_param("s",$email);
		
		//maaran vaartused muutujatesse
		$stmt ->bind_result($id,$emailFromDb,$passwordFromDb);
		// tehakse paring
		$stmt ->execute();
		
		// kas tulid andmed andmebaasist voi mitte
		// on toene kui on vahemalt uks vaste
		if($stmt->fetch())
		{
			// oli sellise meiliga kasutaja
			
			//password millega kasutaja tahab sise logida
			$hash = hash("sha512",$password); // sha512 algoritm
			
			if($hash == $passwordFromDb && $email == $emailFromDb)
			{
				echo "Kasutaja logis sisse ".$id;
				
				//maaran sessiooni muutujad, millele saan ligi teestelt lehtedelt
				$_SESSION["userID"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				header("Location: data.php");
				
			}
			else
			{
				$error = "vale email või parool";
			}
		}
		else
		{
			// ei leidnud kasutajat selle meiliga
			$error = "vale email voi parool";
		}
		
		return $error;
	}
	
	
?>