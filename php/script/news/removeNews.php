<?php
	session_start();
    //SCRIPT PER L'ELIMINAZIONR DELLE NEWS
    
    //RICHIEDI LE FUNZZIONI PER MOFIFICARE IL FILE XML 
    include '../editDocument.php';
    
	echo $_POST["deleteNews"];
	
    //PRELEVA DALL'INPUT L'ID DELLA NEWS DA ELIMINARE
    if(isset($_POST["deleteNews"])) $id = $_POST["deleteNews"];
    
    //CARICA IL FILE XML
    $request = "removeNews";
    $xml = loadDocument($request);
    $root = $xml->documentElement;
    
    //ASSEGNA L'ID DELLA PRIMA NEWS A OLDID
    $oldId = $xml->getElementsByTagName('news')[0]->getAttribute('id');
    
    //RIMUOVI LA NEWS
    $news = $root->getElementsByTagName('news')->item($id);
    $oldNews = $root->removeChild($news);
    
    //SE NEL DOCUMENTO SONO PRESENTI ANCORA NEWS, MODIFICANE L'ID
    if($root->getElementsByTagName('news')->item(0) != NULL)
    {
        //PRELEVA L'ID DELLA NEWS IN CIMA
        $newId = $xml->getElementsByTagName('news')[0]->getAttribute('id');
    
        //SE L'ID DELLA VARIABILE NEWID CORRISPONDE ALL'ID DELLA VARIABILE OLDID  
        if($newId == $oldId)
        {
            //RIPRISTINO L'ORDINE DEGLI ID
            
            /*
            OVVERO SE HO UN DOCUMENTO CON 4 ID NELL'ORDINE 4->3->2->1 E GLI ID DELLE DUE VARIABILI CORRISPONDONO,
            ALLORA SIGNIFICA CHE E' STATA ELIMANATA UNA NEWS TRA 3 E 1, PER ESEMPIO LA NEWS 2, QUINDI LE NEWS ORA HANNO
            UN ORDINE 4->3->1, QUINDI DEVO MODIFICARE L'ORDINE DELLE NEWS IN MODO DA FARLE TORNARE NEL FORMATO 3->2->1
            */
            
            for($i = 0; $i < $oldId - 1; $i += 1)
            {
                $newId -= 1;
                $xml->getElementsByTagName('news')[$i]->setAttribute('id', $newId);
            }
            //SALVA IL DOCUMENTO XML
            saveDocument($xml);
        }
        //ALTRIMENTI SE HO ELIMINATO LA NEWS IN CIMA AL DOCUMENTO L'ORDINE DEGLI ID RIMANE INALTERATO
        //E SALVO IL DOCUMENTO
        else {
			saveDocument($xml);
			//header("Location: ../../../pages/removeNews.php");
		}
    }
    //SE NON SONO STATE ELIMINATE NEWS SALVO IL DOCUMENTO ORIGINALE
    else {
		saveDocument($xml);
		//header("Location: ../../../pages/removeNews.php");
	}
?>