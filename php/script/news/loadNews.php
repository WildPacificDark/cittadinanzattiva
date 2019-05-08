<?php
    //SCRIPT CHE MAND IN STAMPA LE NEWS

    //RICHIEDI LE FUNZIONI PER LA MODIFICA DEL FILE XML
	include '../php/script/editDocument.php';
	//CARICA IL FILE
	$request = 'loadNews';
	$xml = loadDocument($request);
	$root = $xml->documentElement;
	
	//CONTROLLA SE IL DOCUMENTO E' VUOTO
	if($root->getElementsByTagName('news')->item(0) != NULL)
	{
        //PRELEVA L'ID DELLA NEWS IN CIMA
		$newsId = $n_ele = $xml->getElementsByTagName('news')[0]->getAttribute('id');
		
		//IL CICLO STAMPA TUTTE LE NEWS PRESENTI NEL DOCUMENTO
		for($i = 0; $i < $n_ele; $i += 1)
		{
		    //PRELEVA I DATI
			$get_title = $xml->getElementsByTagName('titolo')[$i]->nodeValue;
			//CONTROLLO PER CARATTERI SPECIALI
			$title = htmlspecialchars($get_title);
			$date = $xml->getElementsByTagName('data')[$i]->nodeValue;
			$hour = $xml->getElementsByTagName('ora')[$i]->nodeValue;
			$get_body = $xml->getElementsByTagName('corpo')[$i]->nodeValue;
			//CONTROLLO PER CARATTERI SPECIALI
			$body = htmlspecialchars($get_body);
	        
	        //STAMPA LE NEWS
			echo '	<div class="newsWrapper">
							<div class="newsHeader">
								<span class="newsId">News ' . $newsId . ':</span>
								<span class="newsTitle">' . $title . '</span>
								<span class="newsDate">' . $date . '</span>
								<span class="newsHour">' . $hour . '</span>
							</div>
							<div class="newsBody">
								<p>' . $get_body . '</p>
							</div>
						</div>
					';
			$newsId -= 1;
		}
	    echo '	<script src="../js/searchNews.js" type="text/javascript"></script>
					</div>
				</div>
			</div>';
	}
	//SE IL DOCUMENTO E' VUOTO MANDA IN OUTPUT MESSAGGIO D'INFORMAZIONE
	else 
	{
		echo '<p>Non ci sono notizie da mostrare</p>
		    </div>
		</div>';
		echo "\r\n";
	}
?>