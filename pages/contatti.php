<?php 
    session_start();
    
    include '../php/script/loadResources.php';
    $page = 'contatti';
    
    require_once '../html/header/headerContatti.html';
	require_once '../html/nav/navContatti.html';
    require_once '../html/body/bodyContatti.html';
    require_once '../html/footer/footer.html';
?>