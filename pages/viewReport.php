<?php
    //INIZIA LA SESSIONE
    session_start();
    //RICHIEDI L'HEADER DELLA PAGINA
    require_once '../html/header/headerViewReport.html';
	//RICHIEDI IL MENU' DI NAVIGAZIONE
	require_once '../html/nav/navCommon.html';
	echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; Servizi &rsaquo; <strong>Elenco delle segnalazioni</strong></p>
			</div>
			';
	//SE ESISTE UNA SESSEIONE ATTIVA
	if(isset($_SESSION["userId"])) {
	  //RICHIEDI BARRA DI RICERCA
	  require_once '../html/body/bodyViewReport.html';
	  //RICHIEDI FILE DI CONFIGURAZIONE PER LA COMUNICAZIONE CON IL DATABASE
        include '../php/database/config.php';
        //CONNETTITI AL DATABASE
        $mysqli = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        //QUERY
        $sql = "SELECT User, IDSegnalazione, TipoSegnalazione, DataSegnalazione
                FROM utente JOIN segnalazione ON ID = IDUtente ORDER BY DataSegnalazione DESC";
        //EFFETTUA LA QUERY
        $result = mysqli_query($mysqli, $sql);
        
        //STAMPA I RISULTATI (SE CE NE SONO)
		$rowCount = mysqli_num_rows($result);
		//TIENI CONTO DEL TABINDEX
		$tabCount = 10;
		//Se CI SONO RIGHE
        if($rowCount > 0)
        {
            //PRELEVA IL RISULTATO E STAMPA LE RIGHE DELLA TABELLA
            while($row = mysqli_fetch_array($result))
            {
                echo '	<tr onclick="openReportClick(\'' . $row["IDSegnalazione"] . '\')" onkeypress="openReportPress(\'' . $row["IDSegnalazione"] . '\', event)" tabindex="' . $tabCount . '">
									<td>' . $row["User"] . '</td>
									<td>' . $row["IDSegnalazione"] . '</td>
									<td>' . $row["TipoSegnalazione"] . '</td>
									<td>' . $row["DataSegnalazione"] . '</td>
								</tr>
							';
				$tabCount += 1;
            }
            //STAMPA FINE TABELLA
            echo '</tbody>
						</table>
						<script src="../js/searchTable.js" type="text/javascript"></script>
					</div>
				</div>
			</div>';
		}
	} else { //L'UTENTE NON E' REGISTRATO NEL DATABASE
		require_once '../html/body/body403.html';
	}
    //RICHIEDI IL FOOTER
    require_once '../html/footer/footer.html';
?>
