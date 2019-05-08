<?php
    //SCRIPT DI REGISTRAZIONE
    
    //RICHIEDI IL FILE DI CONFIGURAZIONE PER LA CONNESSIONE AL DATABASE    
    include '../database/config.php';
    //RICHIEDI LO SCRIPT editDocument.php
    include '../script/editDocument.php';
    
    //CONTROLLO SULL'INPUT
    
    //SE LA RICHIESTA E' DI TIPO POST
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{	
	    //CONTROLLA USERNAME E PASSWORD
		$username = test_input($_POST["username"]);
		$get_password = test_input($_POST["password"]);
		
		//CONTROLLA LE INFORMAZIONI PERSONALI (NOME, COGNOME, DATA DI NASCITA E CF)
		$name = test_input($_POST["nome"]);
		$surname = test_input($_POST["cognome"]);
		$data = $_POST["bdata"];
		$cf = test_input($_POST['codiceFiscale']);
		
		//CONTROLLA LA RESIDENZA
		$indirizzo = test_input($_POST["indirizzo"]);
		$civico = $_POST["civico"];
		$paese = test_input($_POST["comune"]);
		$provincia = test_input($_POST["provincia"]);
		
		//CONTROLLA SE IL TELEFONO E' STATO IMMESSO, IN QUANTO CAMPO NON NECESSARIO
		if(isset($_POST["telefono"])) {
		    $num_tel = $_POST["telefono"]; 
		} else { //ALTRIMENTI IMPOSTA IL VALORE A NULL
		    $num_tel = NULL;
		}
		$num_cell = $_POST["cellulare"];
		$email = test_input($_POST["email"]);
	}
	
	//CONNETTITI AL DATABASE
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    //LOG PER ERRORI DB
    $log = fopen("../database/connectLog.txt", 'a');
    
    //CONTROLLA SE CI SONO ERRORI NELLA CONNESSIONE
    if ($mysqli->connect_error)
    {
        //SCRIVI IL RISULTATO DELL'ERRORE IN LOG 
        $error = "Connection failed: " . $mysqli->connect_error;
        fwrite($log, $error);
    }
    
    //EFFETTUA L'HASH DELLA PASSWORD
	$password = password_hash($get_password, PASSWORD_DEFAULT);
	
	//PREPARA LE QUERY PER L'INSERIMENTO DEI DATI
	
	//QUERY PER IMMETTERE I DATI NELLA TABELLA UTENTE
	$tabellaUtente = "INSERT INTO utente(User, Password, Status) VALUES ('$username', '$password', 'Verde')"; 
    
    //QUERY PER IMMETTERE I DATI NELLA TABELLA USERINFO
    $tabellaUserInfo = "INSERT INTO userinfo(ID, Nome, Cognome, DataNascita, CodiceFiscale) 
    VALUES ((SELECT ID FROM utente WHERE User = '$username'), '$name', '$surname', '$data', '$cf')";
    
    //QUERY PER IMMETTERE I DATI NELLA TABELLA RESIDENZA
    $tabellaResidenza = "INSERT INTO residenza(ID, Indirizzo, Civico, Paese, Provincia) 
    VALUES ((SELECT ID FROM utente WHERE User = '$username'), '$indirizzo', '$civico', '$paese', '$provincia')";
    
    //QUERY PER IMMETTERE I DATI NELLA TABELLA CONTATTI
    $tabellaContatti = "INSERT INTO contatti(ID, TelefonoCasa, Cellulare, Email)
    VALUES ((SELECT ID FROM utente WHERE User = '$username'), '$num_tel', '$num_cell', '$email')";
	
	//MESSAGGIO DI BENVENUTO
	$welcome = "INSERT INTO messaggi(Mittente, Destinatario, Oggetto, Messaggio, MessaggioLetto) 
		VALUES (1, (SELECT ID FROM utente WHERE User = '$username'), 'Benvenuto', 'Benvenuto nella comunità di CittadinanzAttiva', 0)";
    
    //VARIABILE DI CONTROLLO
    $dataSubmitted = false;
    
    //EFFETTUA LE QUERY
    //SE AVVENGONO ERRORI, QUESTI VERRANNO SCRITTI NEL FILE DI LOG
    
    //UTENTE
    if(mysqli_query($mysqli, $tabellaUtente))
    {
        //USERINFO
        if(mysqli_query($mysqli, $tabellaUserInfo))
        {
            //RESIDENZA
            if(mysqli_query($mysqli, $tabellaResidenza))
            {
                //CONTATTI
                if(mysqli_query($mysqli, $tabellaContatti))
                    //SE TUTTO E' ANDATO A BUON FINE
                    $dataSubmitted = true;
                else 
                {
                    $error = date('Y-m-d') . " - " . date('H:i:s', time()) . " Errore = " . $mysqli->error;
                    fwrite($log, $error);
                }
            }
            else 
            {
                $error = date('Y-m-d') . " - " . date('H:i:s', time()) . " Errore = " . $mysqli->error;
                fwrite($log, $error);
            }
        }
        else 
        {
            $error = date('Y-m-d') . " - " . date('H:i:s', time()) . " Errore = " . $mysqli->error;
            fwrite($log, $error);
        }
    }
    else 
    {
        $error = date('Y-m-d') . " - " . date('H:i:s', time()) . " Errore = " . $mysqli->error;
        fwrite($log, $error);
    }
	
	mysqli_query($mysqli, $welcome);
	
    //CHIUDI IL FILE DI LOG
    fclose($log);
    
    //CHIUDI CONNESSIONE AL DATABASE
    mysqli_close($mysqli);
    
    //REINDIRIZZA L'UTENTE ALLA PAGINA DI BENVENUTO
    header("Location: ../pages/welcome.php");
?>