<?php

    function welcomeUser($User, $ID)
	{  
        include 'php/database/config.php';
        include 'php/script/editDocument.php';
        
        $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
        
        //Nella prima parte della funzione vengono eseguite tutte le query necessarie per poi poter chiudere la connessione al database
        
        //Preleva il nome dell'utente loggato
        if($stmt = $mysqli->prepare("SELECT Nome FROM userinfo WHERE ID = ?"))
		{
		    $stmt->bind_param('i', $ID);
		    $stmt->execute();
		    $result = $stmt->get_result();
		    $user = $result->fetch_object();
		    $stmt->close();
		}
		
		//Controlla se l'utente ha nuovi messaggi non letti
		if($stmt = $mysqli->prepare("SELECT COUNT(MessaggioLetto) AS TotaleMessaggi FROM messaggi WHERE Destinatario = ? AND MessaggioLetto = 0"))
		{
		    $stmt->bind_param('i', $ID);
		    $stmt->execute();
		    $result = $stmt->get_result();
		    $messaggio = $result->fetch_object();
		    $stmt->close();
		    
		    $numMessaggi = $messaggio->TotaleMessaggi;
		}
		
		//Mostra se ci sono messaggi
		echo '<div class="wrapper">
			<div id="welcome_home">
		        <h2>Bentornato ' . $user->Nome . '</h2>
		        ';

		if($numMessaggi > 0){
		    if($numMessaggi == 1)
		    {
		        echo '<p>A quanto pare hai un 
		          <a href="pages/userOptions.php?id=messages">messaggio</a>
		          non letto
		        </p>
		    </div>
		</div>
		    ';
		    }
		    else
		    {
		        echo '<p>A quanto pare hai ' . $numMessaggi . '
		          <a href="pages/userOptions.php?id=messages">messaggi</a>
		          non letti
		        </p>
		    </div>
		</div>
		    ';
		    }
		}
		else echo '</div>
			</div>';
		
        $mysqli->close();
    }
?>