<?php 
    session_start();
	//RICHIEDI L'HEADER
    require_once '../html/header/headerNews.html';
	//RICHIEDI IL MENU' DI NAVIGAZIONE
	require_once '../html/nav/navNews.html';
	//RICHIEDI IL CORPO
	require_once '../html/body/bodyNews.html';
	//CARICA LE NEWS
	require_once '../php/script/news/loadNews.php';
	//RICHIEDI IL FOOTER
    require_once '../html/footer/footer.html';
?>