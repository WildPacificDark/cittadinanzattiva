<?php 
    session_start();
    
    require_once '../html/header/headerWelcome.html';
    require_once '../html/nav/navCommon.html';
    echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; Registrati &rsaquo; <strong>Benvenuto</strong></p>
			</div>';
	if(isset($_SESSION["user_id"])) {
		require_once '../html/body/bodyWelcome.html';
	} else {
		require_once '../html/body/body403.html';
	}
    require_once '../html/footer/footer.html';
?>