<?php 
  //INCLUDI IL FILE CON I DATI PER LA CONNESSIONE AL DB
  include '../database/config.php';
  //SE LA RICHIESTA E' STATA INVIATA
  if (!empty($_POST)) {
    //CONNETTITI AL DB
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    //PRELEVA DALLA POST IL VALORE ED ESEGUI L'ESCAPE
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $cognome = $mysqli->real_escape_string($_POST['cognome']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $textarea = $mysqli->real_escape_string($_POST['textarea']);
    $letta = 'No';
    //PREPARA LA QUERY
    $sql = "INSERT INTO richieste(Nome, Cognome, Email, Richiesta, RichiestaLetta) VALUES ('$nome', '$cognome', '$email', '$textarea', '$letta')";
    //VERIFICA SE LA QUERY E' STATA ESEGUITA CORRETTAMENTE
    if (mysqli_query($mysqli, $sql)) {
      header("Location: ../../pages/contatti.php?feed=true");
    } else {
      header("Location: ../../pages/contatti.php?feed=false");
    }
  }
?>
