<?php
  //FUNZIONE CHE TESTA L'INPUT
  //IMPEDISCE L'INTRODUZIONE DI CODICE MALIGNO
  function test_input ($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  //RITORNA L'INPUT "RIPULITO"
  return $data;
  }
  //FUNZIONE CHE CARICA IL DOCUMENTO XML RICHIESTO DA ALTRE FUNZIONI
  function loadDocument ($request) {
    //CONDIZIONI INIZIALI
    $dom = new DOMDocument();
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    //CONTROLLA IL TIPO DI RICHIESTA E CARICA IL XML FILE ADEGUATO
    if($request == "sitemap") $dom->load("../sitemap.xml");
    else if($request == "removeNews" || $request == "submitNews") $dom->load("../../../xml/news.xml");
    else $dom->load("../xml/news.xml");
    //RITORNA IL FILE ALLA FUNZIONE CHIAMANTE
    return $dom;
  }
  //FUNZIONE CHE SALVA LE MODIFICHE AL FILE XML EFFETTUATO DA ALTRE FUNZIONI
  //(ESCLUSIVAMENTE QUELLE DI NEWS)
  function saveDocument ($dom) {
    //SALVA IL FILE XML E TORNA ALLA PAGINA NEWS
    $dom->save('../../../xml/news.xml');
    header("Location: ../../../pages/news.php");
  }
?>
