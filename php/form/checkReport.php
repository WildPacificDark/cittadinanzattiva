<?php 
    //INIZIA LA SESSIONE
    session_start();
    
    //SE ESISTE UNA SESSIONE ATTIVA
    if(isset($_SESSION['user_id'])){
    
        //RICHIEDI FILE DI CONFIGURAZIONE PER LA CONNESSIONE AL DATABASE
        include '../database/config.php'; 
        //ASSEGNA A ID IL VALORE DELLA VARIABILE DI SESSIONE user_id
        $ID = $_SESSION['user_id'];
        //CONNETTITI AL DATABASE
        $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
        //SE E' STATA EFFETTUATA UNA RICHIESTA
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {	
            //CONTROLLO DELL'INPUT
			$tipo = mysqli_real_escape_string($mysqli, $_POST["tipoSegnalazione"]);
	    	$indirizzo = mysqli_real_escape_string($mysqli, $_POST["toponimo"]);
	    	$paese = mysqli_real_escape_string($mysqli, $_POST["comune"]);
	    	$desc = mysqli_real_escape_string($mysqli, $_POST["description"]);
	    	$prov = mysqli_real_escape_string($mysqli, $_POST["provincia"]);
	    	
			//CREA ID SEGNALAZIONE
			$sql = "SELECT COUNT(IDSegnalazione) AS IDCount FROM segnalazione WHERE IDUtente = ?";
			//PREPARA LA QUERY PER RECUPERARE LE SEGNALAZIONI PRECEDENTI
			if($stmt = $mysqli->prepare($sql))
			{
				//LEGA I PARAMETRI ALLA QUERY
				$stmt->bind_param('s', $ID);
				//ESEGUI LA QUERY
				$stmt->execute();
				//PRELEVA I RISULTATI
				$result = $stmt->get_result();
				//PRELAVA L'OGGETTO (ARRAY)
				$reportCount = $result->fetch_object();
				//CHIUDI STATEMENT
				$stmt->close();
			}
			//CREA L'ID DELLA SEGNALAZIONE
			$count = $reportCount->IDCount;
			if($count < 10) { 
				$count += 1;
				$idSegnalazione = $ID . "-0000" . $count;
			} else if ($count >= 10 && $count < 100) {
				$count += 1;
				$idSegnalazione = $ID . "-000" . $count;
			} else if ($count >= 100 && $count < 1000) {
				$count += 1;
				$idSegnalazione = $ID . "-00" . $count; 
			} else if ($count >= 1000 && $count < 10000) {
				$count += 1;
				$idSegnalazione = $ID . "-0" . $count;
			} else {
				$count += 1;
				$idSegnalazione = $ID . "-" . $count;
			}
			$idSegnalazione = mysqli_real_escape_string($mysqli, $idSegnalazione);
			
	        //CONTROLLA SE E' STATO CARICATO UN FILE
	        if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['size'] > 0) {
	            //IMPOSTA LA DIRECTORY DI UPLOAD
	            $target_dir = "../../img/uploads/";
	            //SALVA LA DIRECTORY DEL FILE IN QUANTO VERRA' CREATO UN FILE TEMPORANEO 
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                //PRELEVA IL TIPO DI IMMAGINE
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); 
				$fileName = $idSegnalazione . '.' . $imageFileType;
                //CONTROLLA SE E' EFFETTIVAMENTE UN'IMMAGINE
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
				} else {
                    //ERRORE 1 = IL FILE CARICATO NON E' UN'IMMAGINE
                    $errorType = 1;
                    $uploadOk = 0;
	            }
                //CONTROLLA SE L'IMMAGINE E' GIA PRESENTE SUL SERVER
                if (file_exists($target_file)) {
                    //ERRORE 2 = IL FILE CARICATO E' GIA' PRESENTE NEL SERVER
                    $errorType = 2;
                    $uploadOk = 0;
                }
                //CONTROLLA SE LA DIMENSIONE DEL FILE ECCEDE QUELLA MASSIMA CONSENTITA
                if ($_FILES["fileToUpload"]["size"] > 2048000) {
                    //ERRORE 3 = IL FILE ECCEDE LA DIMENSIONE MASSIMA
                    $errorType = 3;
                    $uploadOk = 0;
                }
                //PERMETTI IL CARICAMENTO DI SOLI CERTI TIPI DI FILE (PNG, JPG, GIF)
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
                {
                    //ERRORE 4 = IL TIPO DI FILE NON E' CONSENTITO
                    $errorType = 4;
                    $uploadOk = 0;
                }
                //CONTROLLA SE CI SONO STATI ERRORI
                if ($uploadOk == 0) {
                    //IL CARICAMENTO DEL FILE E' FALLITO, TORNA ALLA PAGINA DEI
                    //SERVIZI E MOSTRA IL TIPO DI ERRORE
                    header("Location: ../../pages/report/service.php");
                //ALTRIMENTI SE NON CI SONO STATI ERRORI, PROVA A CARICARE IL FILE
			    }
                else 
                {
                    //CONTROLLA SE NON CI SONO ERRORI NEL CARICARE IL FILE
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $fileName))
                        $uploadOk = 1;
                    //ALTRIMENTI IL CARICAMENTO DEL FILE E' FALLITO, TORNA ALLA PAGINA DEI
                    //SERVIZI E MOSTRA IL TIPO DI ERRORE
                    else{
                        //ERRORE 5 = ERRORE NEL CARICAMENTO DEL FILE
                        $errorType = 5;
                        //header("Location: ../../pages/report/service.php?errorType=$errorType");
                    }
                }
            } else { //NON E' STATO CARICATO NESSUN FILE
				$fileName = "NULL";
				$imageFileType = "NULL";
			}
			//INSERISCI LA DATA ODIERNA
			$data = date("Y-m-d");	
			//PREPARA LA QUERY
			$sql = "INSERT INTO segnalazione(IDUtente, IDSegnalazione, TipoSegnalazione, DataSegnalazione," . 
			" Provincia, Comune, NomeStrada, Descrizione, Immagine) 
	        VALUES ('" . $ID ."', '" . $idSegnalazione . "', '" .$tipo . "', '" . $data . "', '" . $prov . " ', '" . 
			$paese . "', '" . $indirizzo . "', '" . $desc . "', '" . $fileName . "')";
			//APRI FILE DI LOG
			$log = fopen("../database/connectLog.txt", 'a');
			//EFFETTUA LA QUERY E CONTROLLA SE CI SONO ERRORI
			if(mysqli_query($mysqli, $sql)) {
				//VARIABILE DICONTROLLO
				header("Location: ../../pages/service.php?reportResult=true");
			}
			//ALTRIMENTI SCRIVI L'ERRORE IN LOG
			else 
			{
				$error = date('Y-m-d') . " - " . date('H:i:s', time()) . " Errore = " . $mysqli->error . '
				';
				fwrite($log, $error);
				header("Location: ../../pages/service.php?reportResult=false");
			}
			//CHIUDI FILE DI LOG
			fclose($log);
			//CHIUDI LA CONNESSIONE AL DATABASE
			$mysqli->close();
        }
    }
?>