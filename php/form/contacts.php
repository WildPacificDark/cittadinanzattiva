<?php 
	include '../database/config.php';
	
	if(!empty($_POST))
	{
		$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
		
		$nome = $mysqli->real_escape_string($_POST['nome']);
		$cognome = $mysqli->real_escape_string($_POST['cognome']);
		$email = $mysqli->real_escape_string($_POST['email']);
		$textarea = $mysqli->real_escape_string($_POST['textarea']);
		$letta = 'No';
		
		$sql = "INSERT INTO richieste(Nome, Cognome, Email, Richiesta, RichiestaLetta) VALUES ('$nome', '$cognome', '$email', '$textarea', '$letta')";
		
		mysqli_query($mysqli, $sql);
		
		Header("Location: ../../pages/contatti.php");
	}