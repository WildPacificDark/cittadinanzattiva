  <?php 
	session_start();
	
    if(isset($_GET['id'])) $page = $_GET['id'];
    if(isset($_GET['loginStatus'])) $loginStatus = $_GET['loginStatus'];
    else $loginStatus = true;
    
	//FORM DI LOGIN	
    if($page == "login") {
		require_once '../html/header/headerLogin.html';
		require_once '../html/nav/navCommon.html';
		echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; <strong>Accedi</strong></p>
			</div>';
        require '../html/body/bodyLoginTop.html';
		//IN CASO DI DATI SBAGLIATI MOSTRA MESSAGGIO DI ERRORE
        if($loginStatus == false) {
		    echo '<p class="errorField" id="wrongInfo">Nome utente o Password Errati</p>
		         ';
        }
        require_once '../html/body/bodyLoginBottom.html';
    }
	//FORM DI REGISTRAZIONE
    else if($page == "signup") {
		require_once '../html/header/headerSignUp.html';
		require_once '../html/nav/navCommon.html';
		echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; <strong>Registrati</strong></p>
			</div>';
		require_once '../html/body/bodySignUp.html';
	}
	//FORM DI CONTATTO
    else if($page == "contatti") {
		require_once '../html/header/headerFormContatti.html';
		require_once '../html/nav/navCommon.html';
		echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; Contattaci &rsaquo; <strong>Nuova Richiesta</strong></p>
			</div>';
		require_once '../html/body/bodyFormContatti.html';
		
	}
	//FORM CREA SEGNALAZIONE
    else if($page == "report") {
		require_once '../html/header/headerCreateReport.html';
		require_once '../html/nav/navCommon.html';
		echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; Servizi &rsaquo; <strong>Crea Segnalazione</strong></p>
			</div>';
		require_once '../html/body/bodyCreateReport.html';
	}
	//FORM VISUALIZZA SEGNALAZIONE
	else if($page == "viewReport") 
	{	
		require_once '../html/header/headerViewReport.html';
		require_once '../html/nav/navCommon.html';
		echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; Servizi &rsaquo; Elenco delle segnalazioni &rsaquo; 
				<strong>Visualizza Segnalazione</strong></p>
			</div>';
		if(isset($_SESSION["user_id"])) {
			$reportId = $_GET['reportId'];
			require_once '../php/script/viewReportScript.php';
			loadSelectedReport($reportId);
		} else {
			require_once '../html/body/body403.html';
		}
	}
    if($page == "contatti") require_once '../html/footer/footerFormContatti.html';
	else require_once '../html/footer/footer.html';
?>