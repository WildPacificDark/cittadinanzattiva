<?php
    session_start();
    
    include '../../script/loadResources.php';
    $page = "siteMap";
    
    require_once '../../../html/header/headerSiteMap.html';
    
    if(isset($_SESSION['user_id']))
    {
        $ID = $_SESSION['user_id'];
        $user = $_SESSION['username'];
    
        require_once '../../../html/nav/navCommon.html';
        loadUserOption($user, $ID, $page);
    }
    else 
    {
        require_once '../../../html/nav/navCommon.html';
        echo '</ul>
            </div>';
    }
    
    require_once '../../../html/body/bodySiteMap.html';
    require_once '../../../html/footer/footer.html';
?>