<?php
    //INIZIA LA SESSIONE
    session_start();
    
    //CONTROLLA SE E' STATA EFFETTUATA UNA SEGNALAZIONE
    if(isset($_GET['reportStatus']))
    {
        //SE L'UTENTE HA FATTO UNA SEGNALAZIONE PRELEVA LO STATUS (SUCCESSO O FALLIMENTO)
        $reportStatus = $_GET['reportStatus'];
        //VARIABILE DI CONTROLLO
        $reportSubmitted = 1;
    }
    else
	{
        //NESSUN REPORT INVIATO
		$reportStatus = 0;
        $reportSubmitted = 0;
	}
    
    //RICHIEDI IL FILE PER CARICARE LE OPZIONI UTENTE
    include '../php/script/loadResources.php';
    //IMPOSTA IL TIPO DI PAGINA
    $page = 'service';
    
    //RICHIEDI L'HEADER
    require_once '../html/header/headerService.html';
	//RICHIEDI IL MENU' DI NAVIGAZIONE
	require_once '../html/nav/navService.html';
    
    //CONTROLLA SE C'E' UNA SESSIONE ATTIVA
    if(isset($_SESSION['userId']))
    {      
        //STAMPA MESSAGGIO INIZIALE
        echo '<div class="wrapper">
				<div class="general">
					<h2>Servizi</h2>
					<p>Benvenuto nella pagina dei servizi, da qui con pochi semplici passi potrai effettuare una segnalazione 
						per informare il tuo comune (e non solo...) di eventuali problemi oppure potrai fornire qualche suggerimento 
						per abbellire il tuo paese!
					</p>
					<p>Se &egrave; la tua prima segnalazione ti consigliamo di seguire 
						<a href="how_to_report.php" id="how_to_post" title="Vai alla video-guida" tabindex="5">questa guida</a>.
					</p>
				';
        
        //CONTROLLA LO STATUS DEL REPORT
        if($reportStatus == 1 && $reportSubmitted == 1) {
            //STAMPA MESSAGGIO SUCCESSO
            echo '<h3 id="correct_submission">La tua segnalazione &egrave; stata inviata correttamente</h3>';
		}
        else if($reportStatus == 0 && $reportSubmitted == 1) {
            //STAMPA MESSAGGIO ERRORE
            echo '<h3 id="incorrect_submission">Si &egrave; verificato un problema nell&#39;invio della segnalazione</h3>';
		}
		
		echo '</div>
				<div class="report_link">
					<div id="crea_report">
						<a href="general.php?id=report" id="crea_report" title="Crea una nuova segnalazione" tabindex="6">Crea Segnalazione</a>
					</div>
					<div id="view_report">
						<a href="viewReport.php" title="Visualizza le segnalazioni effettuate" tabindex="7">Visualizza Segnalazioni</a>
					</div>
				</div>
			</div>';
    }
    else
    //SE NON E' ATTIVA NESSUNA SESSIONE
    {
        //STAMPA MESSAGGIO INIZIALE DI RICHIESTA DI ACCESSO
        echo '<div class="wrapper">
			<div class="general">
                <h2>Servizi</h2>
                <p>Benvenuto nella pagina dei servizi, da qui con pochi semplici passi potrai effettuare una segnalazione per informare il tuo comune (e non solo...) 
                di eventuali problemi oppure potrai fornire qualche suggerimento per abbellire il tuo paese!
                </p>
                <div class="login_required">
                    <a href="general.php?id=login" title="Effettua l&#39;accesso" tabindex="5">Accedi</a> o 
					<a href="general.php?id=signup" title="Effettua la registrazione" tabindex="6">Registrati</a> per utilizzare questa funzione
                </div>
            </div>
		</div>';
    }
    //RICHIEDI IL FOOTER
    require_once '../html/footer/footer.html';
?>
