<?php
    session_start();
    
    $page = 'howto';
    
    require_once '../html/header/headerService.html';
	require_once '../html/nav/navCommon.html';
	echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; Servizi &rsaquo; <strong>Come creare una segnalazione</strong></p>
			</div>
		';
    require_once '../html/body/bodyHowTo.html';
    require_once '../html/footer/footer.html';
?>