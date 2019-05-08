<?php
    //INIZIA LA SESSIONE
    session_start();

    //RICHIEDI SCRIPT LOADRESOURCES
    include 'php/script/loadResources.php';
    //IMPOSTA IL VALORE DELLA PAGINA
    $page = "home";
	
	//RICHIEDI L'HEADER DELLA PAGINA
	require_once 'html/header/headerHome.html';
	//RICHIEDI IL MENU' DI NAVIGAZIONE
    require_once 'html/nav/navHome.html';

	//CONTROLLA SE LA SESSIONE E' ATTIVA
	if(isset($_SESSION['user_id']))
	{
	    //SE LA SESSIONE E' ATTIVA PRELEVA L'ID E IL NOME UTENTE
	    $ID = $_SESSION['user_id'];
	    $user = $_SESSION['username'];

        //MESSAGGIO DI BENVENUTO
        welcomeUser($user, $ID);
	}
	//ALTRIMENTI
	else
	{
		//RCHIEDI IL CORPO DELLA PAGINA
		require_once 'html/body/bodyHome.html';
	}
	//RICHIEDI IL FOOTER DELLA PAGINA
    require_once 'html/footer/footerHome.html';
?>
