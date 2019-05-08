<?php 
	session_start();
	
	$ID = $_SESSION['user_id'];
	
	include('../database/config.php');
	
	$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
	
	if(!empty($_POST))
	{
		$destinatario = $mysqli->real_escape_string($_POST['destinatario']);
		$oggetto = $mysqli->real_escape_string($_POST['oggetto_messaggio']);
		$messaggio = $mysqli->real_escape_string($_POST['message_text']);
		
		$sql = "INSERT INTO messaggi(Mittente, Destinatario, Oggetto, Messaggio, MessaggioLetto) 
		VALUES ($ID, (SELECT ID FROM utente WHERE User LIKE '$destinatario%'), '$oggetto', '$messaggio', 0)";
		
		if(mysqli_query($mysqli, $sql))
			Header("Location: ../pages/user/userOptions.php?id=messages");
		else
			Header("Location: ../../error/500.php");
	}
?>