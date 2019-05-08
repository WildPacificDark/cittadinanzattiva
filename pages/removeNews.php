<?php 
    session_start();
    
    require_once '../html/header/headerEditNews.html';
    require_once '../html/nav/navCommon.html';
	echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; News &rsaquo; <strong>Carica nuova news</strong></p>
			</div>
			';
    if(isset($_SESSION['user_id']))
    {   
        require_once '../html/body/bodyRemoveNews.html';
        require_once '../php/script/news/selectNews.php';
    } else {
        require_once '../html/body/body403.html';
    }
    require_once '../html/footer/footer.html';
?>