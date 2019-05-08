<?php   
    //FUNZIONE CHE CARICA IL REPORT SELEZIONATO
	function loadSelectedReport($id)
	{
		//RICHIEDI FILE DI CONFIGURAZIONE PER LA COMUNICAZIONE CON IL DATABASE
        include '../php/database/config.php';
        
        //CONNETTITI AL DATABASE
        $mysqli = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        
        //QUERY
        $sql = "SELECT User, IDSegnalazione, TipoSegnalazione, DataSegnalazione, Provincia, Comune, NomeStrada, Descrizione, Immagine
                FROM utente JOIN segnalazione ON ID = IDUtente
				WHERE IDSegnalazione = ?";
		
		//PREPARA ED ESEGUI LA QUERY 
		if($stmt = $mysqli->prepare($sql)) {
		  //LEGA I PARAMETRI ALLA QUERY
	      $stmt->bind_param('s', $id);
		  //ESEGUI LA QUERY
		  $stmt->execute();
		  //PRELEVA I RISULTATI
		  $result = $stmt->get_result();
		  //PRELAVA L'OGGETTO (ARRAY)
		  $report = $result->fetch_object();
		  //CHIUDI STATEMENT
		  $stmt->close();
		}
		$desc = $report->Descrizione;
		$desc = htmlentities($desc);
		
		//STAMPA INFORMAZIONI SULLA SEGNALAZIONE
		echo '
			<div class="wrapper">
				<div class="genereal">
					<h2>Segnalazione Numero ' . $id . '</h2>
					<div class="viewReport">
						<p>L&#39;dentificativo della segnalazione &egrave;: <strong>' . $report->IDSegnalazione . '</strong></p>
						<p>La tipologia di questa segnalazione &egrave;: <strong>' . $report->TipoSegnalazione . '</strong></p>
						<p>&Egrave; stata eseguita dall&#39;utente <strong>' . $report->User . '</strong> in data <strong>'
						. $report->DataSegnalazione . '.</strong></p>
						<p>Questa segnalazione &egrave; è stata effettuata per la strada <strong>' . $report->NomeStrada .
						'</strong>,
						<br /> nel comune di <strong>' . $report->Comune . '</strong>, situato nella provincia di <strong>' 
						. $report->Provincia . '.</strong></p>
						<p>La descrizione della segnalazione &egrave; la seguente: </p>
						<p id="reportDesc">' . $desc . '</p>
						';
		if($report->Immagine == "NULL") {
			echo '<p>Per questa segnalazione non &egrave; disponibile nessuna immagine.</p>
				';
		} else {
			echo '<p>Per questa segnalazione &egrave; stata resa disponibile la seguente foto:</p>
				  <img src="../img/uploads/' . $report->Immagine . '" id="uploadedFile" alt="Fotografia del problema" />
				  ';
		}
		echo '	</div>
					<a href="viewReport.php" id="backButton" title="Torna all&#39;elenco delle segnalazioni" tabindex="5">Indietro</a>
					<button type="button" id="printButton" title="Stampa segnalazione" onclick="window.print()" onkeydown="printKey(event)" tabindex="6">Stampa</button>
				</div>
			</div>';
	}
?>