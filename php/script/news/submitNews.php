<?php 
    include '../editDocument.php';
    
    $request = "submitNews";
    
    $xml = loadDocument($request);
    $root = $xml->documentElement;
   
    $newsElement = $xml->createElement("news"); //CREA NODO NEWS
    $newsAttribute = $xml->createAttribute("id"); //CREA ATTRIBUTO
    
    if($root->getElementsByTagName('news')->item(0) == NULL) //SE IL DOCUMENTO E' VUOTO AGGIUNGI IL TAG NEWS
    {
        $newsAttribute->value = 1; //SETTA L'ATTRIBUTO A 1 
        $newsElement->appendChild($newsAttribute); //APPENDI L'ATTRIBUTO AL TAG
        $old_news = $xml->getElementsByTagName('check')->item(0); //APPENDI IL TAG SOPRA IL TAG DI CONTROLLO CHEKC
        $old_news->parentNode->insertBefore($newsElement, $old_news);
    } else {
		//ALTRIMENTI APPENDI IL TAG SOPRA L'ULTIMA NEWS
        $newsAttribute->value = $root->getElementsByTagName("news")[0]->getAttribute("id") + 1;
        $newsElement->appendChild($newsAttribute);
        $old_news = $xml->getElementsByTagName('news')->item(0);
        $old_news->parentNode->insertBefore($newsElement, $old_news);
    }
    //Prendi il titolo dall'input e controlla il testo prima dell'inserimento
    $get_title = test_input($_POST["news_title"]);
    $title = $xml->createElement("titolo", $get_title);
    $title = $newsElement->appendChild($title);
    
    //Modifica il fuso orario
    
    date_default_timezone_set('Europe/Rome');
    
    //Inserisce nel nodo 'data' e nel nodo 'ora' la data e l'ora di pubblicazione della news
    
    $get_date = date('Y-m-d');
    $date = $xml->createElement("data", $get_date);
    $date = $newsElement->appendChild($date);
    
    $get_time = date('H:i', time());   
    $hour = $xml->createElement("ora", $get_time);
    $hour = $newsElement->appendChild($hour);
    
    //Prendi il corpo della news dall'input e controlla il testo prima di inserirlo
    
    $get_body = test_input($_POST["news_body"]);
    $body = $xml->createElement("corpo", $get_body);
    $body = $newsElement->appendChild($body);
        
    saveDocument($xml);
?>