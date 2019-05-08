<?php 
    session_start();
    $page = 'submitNews';

    require_once '../html/header/headerEditNews.html';
	require_once '../html/nav/navCommon.html';
	echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; News &rsaquo; <strong>Carica nuova news</strong></p>
			</div>
			';
    
    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == 1)
    {          
        require_once '../html/body/bodySubmitNews.html';
    } else {
		require_once '../html/body/body403.html';
    }
    require_once '../html/footer/footer.html';
?>