<?php 
    session_start();
    
    require_once '../../../html/header/headerUserOption.html';
    
    if(isset($_SESSION['user_id']))
    {
        $ID = $_SESSION['user_id'];
        $user = $_SESSION['username'];
		
		$page = $_GET['id'];
        
        include '../../database/config.php';
        
        $mysqli = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $sql = "SELECT UserInfo.Nome, UserInfo.Cognome, UserInfo.DataNascita, UserInfo.CodiceFiscale, 
        Residenza.Indirizzo, Residenza.Civico, Residenza.Paese, Residenza.Provincia, Contatti.TelefonoCasa, Contatti.Cellulare, 
        Contatti.Email FROM UserInfo JOIN Residenza ON UserInfo.ID = Residenza.ID JOIN Contatti ON Contatti.ID = Residenza.ID WHERE UserInfo.ID = $ID";
        
        $result = mysqli_query($mysqli, $sql);
        $rowCount = mysqli_num_rows($result);
        
        if($rowCount > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $nome = $row['Nome'];
                $cognome = $row['Cognome'];
                $data = $row['DataNascita'];
                $cf = $row['CodiceFiscale'];
                $indirizzo = $row['Indirizzo'];
                $civico = $row['Civico'];
                $paese = $row['Paese'];
                $provincia = $row['Provincia'];
                $tel = $row['TelefonoCasa'];
                $cell = $row['Cellulare'];
                $email = $row['Email'];
            }
        }
        else echo "Errore interno al server, non &egrave; possibile recuperare i dati utente";
        
        require_once '../../../html/nav/navCommon.html';
        echo '</ul>
            </div>';
            
        echo '<div class="wrapper">
	            <h2>Benvenuto nella tua area personale</h2>
	            <h3>Da qui puoi modificare i tuoi dati, leggere i messaggi, e reimpostare le tue informazioni di contatto</h3>
				
                <button class="tablink" onclick="openPage(\'messages\', this)" ';
				if($page == 'messages') 
					echo 'id="defaultOpen"';
				echo 'tabindex=5>Messaggi</button>';
				echo '<button class="tablink" onclick="openPage(\'personal_info\', this)" ';
				if($page == 'personal_info')
					echo 'id="defaultOpen"';
				echo ' tabindex=6>Informazioni Personali</button>';
        
        echo "<div id=\"personal_info\" class=\"tabcontent\">
                    <h4>Le tue Informazioni personali</h4>
                    <p>Nome: " . $nome . "</p>
                    <p>Cognome: " . $cognome . "</p>
                    <p>Data di Nascita: " . $data . "</p>
                    <p>Codice Fiscale: " .$cf . "</p>
                    <p>Indirizzo: " . $indirizzo . " " . $civico . "</p>
                    <p>Comune di residenza: " . $paese . "</p>
                    <p>Provincia: " . $provincia . "</p>
                    <p>Telefono: " .  $tel . "</p>
                    <p>Cellulare: " . $cell . "</p>
                    <p>Email: " . $email . "</p>";
        
		$sql = "SELECT User, Oggetto, IDMessaggio, Messaggio, MessaggioLetto FROM utente JOIN messaggi ON ID = Mittente WHERE Destinatario = $ID";
		
		$result = mysqli_query($mysqli, $sql);
        $rowCount = mysqli_num_rows($result);
		
		echo '</div>
			</div>
                <div id="messages" class="tabcontent">
					<h4>Messaggi</h4>
					';
		
		if($rowCount > 0)
		{
			$tabCounter = 7;
			echo '<p>Clicca sulla riga per leggere il messaggio</p>
				   <table>
					  <thead>
						  <tr>
							  <th id="mittente">Mittente</th>
							  <th id="oggetto">Oggetto</th>
							  <th id="read">Messaggio Letto</th>
						  </tr>
					  </thead>
				      <tbody>
					      ';
			while($row = mysqli_fetch_array($result))
			{
				if($row['MessaggioLetto'] == 0) 
					$letto = 'No';
				else 
					$letto = 'Si';
				
				echo '<tr tabindex=' . $tabCounter . ' onclick="showMessage(' . $row['IDMessaggio'] . ')" onkeypress="showMessageKey(event, ' . $row['IDMessaggio'] . ')">
						  <td headers="mittente">' . $row['User'] . '</td>
						  <td headers="oggetto">' . $row['Oggetto'] . '</td>
						  <td headers="read">' . $letto . '</td>
					  </tr>
					  ';
				$tabCounter += 1;
			}
			echo '</tbody>
			   </table>
			   ';
		    if($_SESSION['user_id'] == 1)
		    {
		       echo '<button type="button" id="send_message_button" onclick="sendMessage()">Crea Messaggio</button>';
		    }
		    echo '</div>
			<div id="hidden_message" class="modulo">
				<form class="animato">
                    <div id="set_width" class="container-report-hidden">	
						<div class="close-container">
							<span id="hidden_close" onclick="hiddenMessage()" class="close" title="Chiudi il modulo">&times;</span>
						</div>
						<fieldset id="get_message">
						</fieldset>
					</div>
				</form>
			</div>
			';
			if($_SESSION['user_id'] == 1)
			{
				echo '<div id="hidden_send_message" class="modulo">
					<form id="form_send_message" class="animato" action="../../form/sendMessage.php" method="post">
						<div class="container-report-hidden">	
							<div class="close-container">
								<span id="hiddenCloseSendMessage" onclick="hiddenSendMessage()" class="close" title="Chiudi il modulo">&times;</span>
							</div>
							<fieldset id="send_message">
								<legend>Crea nuovo messaggio</legend>
								<label for="destinatario">Destinatario</label>
								<input type="text" id="destinatario" name="destinatario" maxlength="30" required />
								<label for="oggetto_messaggio">Oggetto</label>
								<input type="text" id="oggetto_messaggio" name="oggetto_messaggio" required />
								<label for="message_text">Messaggio</label>
								<textarea id="message_text" name="message_text"></textarea>
								<input type="submit" value="Invia messaggio" />
							</fieldset>
						</div>
					</form>
				</div>
				';
			}
		}
        
		echo '<script src="../../../js/showMessage.js"></script>
		      <script src="../../../js/showOption.js"></script>';
    }
    else
    {
        require_once '../../../html/nav/navCommon.html';
        echo '</ul>
            </div>
            <div class="login-required">
            <h2>Non hai l&#39;autorizzazione necessaria per accedere a questa pagina</h2>
        </div>';
    }
    
    require_once '../../../html/footer/footer.html';
    
?>