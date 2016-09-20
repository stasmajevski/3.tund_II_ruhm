<?php

//muutujad mis kirjeldavad Errorid
$signupEmailError = ""; 
$signupPasswordError="";
$birthdayError ="";



//on üldse olemas selline muutuja
if(isset($_POST["signupEmail"]))
{
// jah on olemas

// kas on tühi?
	if(empty($_POST["signupEmail"]))
	{
		$signupEmailError = "See väli on kohustuslik";
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
    <label for="loginEmail">E-mail: </label>
	<input name="loginEmail" type="text"><br><br>
    <label for="loginPassword">Parool: </label>
	<input name="loginPassword" type="password"><br><br>
	
	<input type="submit" value="Logi sisse" class="button">
</form>


<form method="POST">
	<h1>Loo kasutaja</h1>
	<input name="signupEmail" placeholder="E-mail" type="text"> <?php echo $signupEmailError; ?>
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
