<?php

require("../../config.php");
require("functions.php");

// KUI ON juba sisse loginud siis suunan data.php lehele
if(isset($_SESSION["userID"]))
	{
		//suunan sisselogimise lehele
		header("Location: data.php");
	}

//$random =" ";
//var_dump(empty($random));

//echo hash("sha512","Romil");


//muutujad mis kirjeldavad Errorid
$loginEmailError="";
$signupEmailError = ""; 
$signupPasswordError="";
$birthdayError ="";
$loginPasswordError ="";

$signupGender="";

// muutujad
$signupEmail = "";
$loginEmail = "";


if(isset($_POST["loginEmail"]))
{
// jah on olemas
	
// kas on tühi?
	if(empty($_POST["loginEmail"]))
	{
		$loginEmailError = "See väli on kohustuslik";
	}
	else
	{
		$loginEmail = $_POST["loginEmail"];
	}
}

if(isset($_POST["loginPassword"] ))
{
	if(empty($_POST["loginPassword"]))
	{
		$loginPasswordError = "See väli on kohustuslik";
	}
}




//on üldse olemas selline muutuja
if(isset($_POST["signupEmail"]))
{
// jah on olemas
	
// kas on tühi?
	if(empty($_POST["signupEmail"]))
	{
		$signupEmailError = "See väli on kohustuslik";
	}
	else
	{
		$signupEmail = $_POST["signupEmail"];
	}
}

//on üldse olemas selline muutuja


if(isset($_POST["singupPassword"] ))
{
// jah on olemas
	
// kas on tühi?
	if(empty($_POST["singupPassword"]))
	{
		$signupPasswordError = "Parool väli on kohustuslik";
	}
	else 
	{
		// siia juuan siis kui parool on olemas - isset
		// ja parool ei olnud tühi - empty
		
		// kas parooli pikkus on väiksem kui 8
		if(strlen($_POST["singupPassword"]) < 8)
		{
			$signupPasswordError = "Parool peab olema vähemalt 8 tähepikk";
		}
	}
}

//on üldse olemas selline muutuja

if(isset($_POST["biD"]) OR isset($_POST["biM"]) OR isset($_POST["biY"]))
{
// jah on olemas
	
// kas on tühi?
	if(empty($_POST["biD"]) OR empty($_POST["biM"]) OR empty($_POST["biY"]))
	{
		$birthdayError = "Sünniaeg väli on kohustuslik";
	}
	else
	{
		$birthday = $_POST["biY"].'-'.$_POST["biM"].'-'.$_POST["biD"];
		
	}
}
if( isset( $_POST["signupGender"] ) ){
		
		if(!empty( $_POST["signupGender"] ) ){
		
			$signupGender = $_POST["signupGender"];
			
		}
		
	} 

	// peab olema email ja parool
	// uhtegi errorit()
	if($signupEmailError == "" && $signupPasswordError == "" && $birthdayError == ""
							   && isset($_POST["signupEmail"]) && isset($_POST["singupPassword"]))
	{
		// salvestame andbemaasi
		echo "Salvestan...<br>";
		
		echo "email: ".$signupEmail."<br>";
		echo "password: ".$_POST["singupPassword"]."<br>";
		
		
		$password = hash("sha512",$_POST["singupPassword"]);
		
		echo "password hashed: ".$password."<br>";
		echo "birthday: ".$birthday."<br>";
		echo "gender: ".$signupGender."<br>";
		
		//echo $serverUsername;
		
		// KASUTAN FUNTKTSIOONI
		
		signUP($signupEmail,$password,$birthday,$signupGender);
		
	}
	
	$error ="";
	if(isset($_POST["loginEmail"]) && isset($_POST["loginPassword"]) && !empty($_POST["loginEmail"]) && !empty($_POST["loginPassword"]))
	{
		$error = login($_POST["loginEmail"],$_POST["loginPassword"]);
	}
	
	
	
?>

<!DOCTYPE html>
<html>
<title>Logi sisse või loo kasutaja</title>
<!-- lisasisin natuke CSS -->
<link rel="stylesheet" type="text/css" href="style.css">
<!-- lisasin 'Nunito' fonti -->
 <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
<body>


<form method="POST">
	<h1>Logi sisse</h1>
	<p style="color:red"><?=$error;?></p>
    <label for="loginEmail">E-mail: </label><?php echo $loginEmailError; ?>
	<input name="loginEmail" type="text" value="<?php echo $loginEmail;?>"><br><br>
    <label for="loginPassword">Parool: </label><?php echo $loginPasswordError; ?> 
	<input name="loginPassword" type="password"><br><br>
	
	<input type="submit" value="Logi sisse" class="button">
</form>


<form method="POST">
	<h1>Loo kasutaja</h1>
	<input name="signupEmail" placeholder="E-mail" type="text" value="<?php echo $signupEmail;?>"> <?php echo $signupEmailError; ?>
	<br><br>
	<input name="singupPassword" placeholder="Parool" type="password"> <?php echo $signupPasswordError; ?>
	<br><br>
	<label for="birthday">Sünniaeg: DD/MM/YYYY</label>
    <br>
   	<select name="biD">
    		<option></option>
		<?php for($i = 1;$i<=31;$i++){
	echo "<option value=".$i.">$i</option><br>";
		}
		?>
	</select>
	<select name="biM">
		<option></option>
		<?php for($i = 1;$i<=12;$i++){
	echo "<option value=".$i.">$i</option><br>";
		}
		?>
	</select>
	<select name="biY">
		<option></option>
		<?php for($i = 2003;$i>=1900;$i--){
	echo "<option value=".$i.">$i</option><br>";
		}
		?>
	</select>
           
    </select>
    <br>
    <?php echo $birthdayError; ?>
    <br><br>	
<?php
	if($signupGender == "male")
	{
?>
	<input type="radio" name="signupGender" value="male" checked>Male
	<?php } else { ?>
	<input type="radio" name="signupGender" value="male">Male
	<?php } ?>
	<?php
	if($signupGender == "female")
	{
?>
	<input type="radio" name="signupGender" value="female" checked>Female
	<?php } else { ?>
	<input type="radio" name="signupGender" value="female">Female
	<?php } ?>
	<?php
	if($signupGender == "other")
	{
?>
	<input type="radio" name="signupGender" value="other" checked>Other
	<?php } else { ?>
	<input type="radio" name="signupGender" value="other">Other
	<?php } ?>

	
	<input type="submit" value="Loo kasutaja" class="button">
	
	
	
</form>

<!--

	Kui sul on juba naiteks 10 inimesed, kellele sa tegid veebileht, siis oleks tore, kui sul on koht, kus on nende andmed


	mvp idee - tahaks endale teha vaike veebirakendus, kus oleks kliendi andmeid.
	klient - kes tellis veebileht
	andmed - domeeni nimi, ftp login ja password, kliendi kontaktid ja jne.

-->


</body>
</html>
