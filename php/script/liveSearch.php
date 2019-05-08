<?php
    /*QUESTO SCRIPT ESEGUE DUE DIVERSE FUNZIONI: CONTROLLA SE NELLA FORM 
    DI REGISTRAZIONE IL NOME UTENTE INSERITO E' GIA' PRESENTE NEL DATABASE 
    E CONTROLLA SE LA PROVINCIA E IL COMUNE INSERITI NELLA FORM DI SEGNALAZIONE 
    SIANO CORRETTI*/
    
    //RICHIEDI IL FILE DI CONFIGURAZIONE PER LA CONNESSIONE AL DATABASE 
    include '../database/config.php';
    
    //PRELEVA I PARAMETRI DI RICERCA
    
    //QUERY = PARAMETRO EFFETTIVO DELLA RICERCA
    $query = $_GET["query"];
    //QUERID = PARAMETRO ACCESSORIO CHE SERVE PER DETERMINARE LA QUERY SQL DA EFFETTUARE
    $queryId = $_GET["queryId"];

    //CONNETTITIAL DATABASE
    $mysqli = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    
    //CONTROLLA SE LA STRINGA "QUERY" SIA DEFINITA
    if(strlen($query) > 0)
    {
        //SELEZIONA IL CASO
        switch($queryId)
        {
            //CASO USER, CONTROLLA IL NOME UTENTE
            case 'user':
                //PREPARA LA QUERY
                $sql = "SELECT User FROM utente WHERE User LIKE '" . $query . "%'";
                break;
            //CASO SHOWREPORT, PREPARA LA QUERY PER I DATI DELLA SEGNALAZIONE
            case 'showReport':
                $sql = "SELECT User, IDSegnalazione, TipoSegnalazione, DataSegnalazione, Provincia, Comune, NomeStrada, Descrizione
                        FROM utente JOIN segnalazione ON ID = IDUtente WHERE IDSegnalazione = '" . $query . "'";
                break;
			case 'showMessage':
				$sql = "SELECT Oggetto, Messaggio FROM messaggi WHERE IDMessaggio = " . $query;
				$update = "UPDATE messaggi SET MessaggioLetto=1 WHERE IDMessaggio = " . $query;
				mysqli_query($mysqli, $update);
				break;
        }
        
        //EFFETTUA LA QUERY
        $result = mysqli_query($mysqli, $sql);
        
        //SE LA QUERY HA PRODOTTO UN RISULTATO
        if(mysqli_num_rows($result) > 0)
        {
            //CONTROLLA I CASI
            if($queryId == 'user')
            {                
                //PRELEVA IL RISULTATO
                while($row = mysqli_fetch_array($result))
                {
                    //CONTROLLA SE IL NOME UTENTE E' DISPONIBILE
                    if($row['User'] == $query)
                    {
                        //NOME UTENTE NON DISPONIBILE RITORNA 0
                        $avaible = '0';
                        echo $avaible;
                    }
                    else 
                    {
                        //NOME UTENTE DISPONIBILE, RITORNA 1
                        $avaible = '1';
                        echo $avaible;
                    }
                }
            }
			else if($queryId == 'showMessage')
			{
				while($row = mysqli_fetch_array($result))
				{
					echo '<strong>
						<legend>Messaggio</legend>
						</strong>
						<label>Oggetto</label>
						<input type="text" value="' . $row['Oggetto'] . '" disabled />
						<label>Messaggio</label>
						<textarea disabled>' . $row['Messaggio'] . '</textarea>
						<button type="button" onclick="hiddenMessage()" class="cancelbtn">Chiudi</button>
					';
				}
			}
        }
        //ALTRIMENTI SE IL RISULTATO E' VUOTO CONTROLLA IL TIPO DI RICHIESTA
        else if($queryId == 'user')
        {
            //IL NOME UTENTE E' DISPONIBILE
            $avaible = 1;
            echo $avaible;
        }
    }
    
    //CHIUDI LA CONNESSIONE
    $mysqli->close();
?>