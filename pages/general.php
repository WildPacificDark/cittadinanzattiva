  <?php 
  session_start();
  //IDENTIFICA IL TIPO DI PAGINA DA CARICARE
  if(isset($_GET['id'])) {
    $page = $_GET['id'];
  }
  //SE E' ATTIVA UNA SESSIONE
  if(isset($_SESSION["userId"])) {
    //FORM DI LOGIN	
    if($page == "login") {
      if(isset($_GET['loginStatus'])) {
        $loginStatus = $_GET['loginStatus'];
      } else { 
        $loginStatus = true;
      }
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
    } else if($page == "signup") {  //FORM DI REGISTRAZIONE
        require_once '../html/header/headerSignUp.html';
        require_once '../html/nav/navCommon.html';
        echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; <strong>Registrati</strong></p>
            </div>';
        require_once '../html/body/bodySignUp.html';
    } else if($page == "contatti") { //FORM DI CONTATTO
        require_once '../html/header/headerFormContatti.html';
        require_once '../html/nav/navCommon.html';
        echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; Contattaci &rsaquo; <strong>Nuova Richiesta</strong></p>
            </div>';
        require_once '../html/body/bodyFormContatti.html';
    } else if($page == "report") { //FORM CREA SEGNALAZIONE
        require_once '../html/header/headerCreateReport.html';
        require_once '../html/nav/navCommon.html';
        echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; Servizi &rsaquo; <strong>Crea Segnalazione</strong></p>
			</div>';
      require_once '../html/body/bodyCreateReport.html';
    } else if($page == "viewReport") { //FORM VISUALIZZA SEGNALAZIONE
        require_once '../html/header/headerViewReport.html';
        require_once '../html/nav/navCommon.html';
        echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; Servizi &rsaquo; Elenco delle segnalazioni &rsaquo; 
                <strong>Visualizza Segnalazione</strong></p>
            </div>';
        $reportId = $_GET['reportId'];
        require_once '../php/script/viewReportScript.php';
        loadSelectedReport($reportId);
    }
    if($page == "contatti") {
      require_once '../html/footer/footerFormContatti.html';
	} else {
      require_once '../html/footer/footer.html';
    }
  } else {
      require_once '../html/body/body403.html';
  }
?>
