<?php
    //SCRIPT DI LOGOUT
    
    //INIZIA LA SESSIONE
    session_start();
    
    //SE ESISTE EFFETIVAMENTE UNA SESSIONE ATTIVA PER L'UTENTE
    if(isset($_SESSION['user_id']))
    {
        //DISTRUGGI LA SESSIONE
        session_destroy();
        //REINDIRIZZA L'UTENTE ALLA PAGINA INIZIALE
        header("Location: ../../index.php");
    }
?>