  <?php 
  session_start();
  /*IDENTIFICA IL TIPO DI PAGINA DA CARICARE*/
  if(isset($_GET['id'])) {
    $page = $_GET['id'];
  }
  switch ($page) {
    /*FORM CREA SEGNALAZIONE*/
    case "report":
      require_once '../html/header/headerCreateReport.html';
      require_once '../html/nav/navCommon.html';
      echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; Servizi &rsaquo; <strong>Crea Segnalazione</strong></p>
          </div>';
      //SE E' ATTIVA UNA SESSIONE
      if(isset($_SESSION["userId"])) {
        require_once '../html/body/bodyCreateReport.html';
      } else { //ERRORE DI PERMESSI
        require_once '../html/body/body403.html';
      }
      break; 
    /*VISUALIZZA SEGNALAZIONE*/
    case "viewReport":
      require_once '../html/header/headerViewReport.html';
      require_once '../html/nav/navCommon.html';
      echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; Servizi &rsaquo; Elenco delle segnalazioni &rsaquo; 
              <strong>Visualizza Segnalazione</strong></p>
          </div>';
      //SE E' ATTIVA UNA SESSIONE
      if(isset($_SESSION["userId"])) {
        $reportId = $_GET['reportId'];
        require_once '../php/script/viewReportScript.php';
        loadSelectedReport($reportId); //CARICA LA SEGNALAZIONE RICHIESTA
      } else { //ERRORE DI PERMESSI
        require_once '../html/body/body403.html';
      }
      break;
    /*FORM DI LOGIN*/	
    case "login":
      //SE I DATI INSERITI SONO CORRETTI
      if(isset($_GET['loginStatus'])) {
        $loginStatus = $_GET['loginStatus']; //EFFETUA IL LOGIN
      } else { 
        $loginStatus = true; // ALTRIMENTI RICARICA LA FORM
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
      break;
    /*FORM DI REGISTRAZIONE*/
    case "signup":
      require_once '../html/header/headerSignUp.html';
      require_once '../html/nav/navCommon.html';
      echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; <strong>Registrati</strong></p>
          </div>';
      require_once '../html/body/bodySignUp.html';
    /*FORM DI CONTATTO*/
    case "contatti":
      require_once '../html/header/headerFormContatti.html';
      require_once '../html/nav/navCommon.html';
      echo '<p id="breadcrumb" class="breadcrumb">Home &rsaquo; Contattaci &rsaquo; <strong>Nuova Richiesta</strong></p>
         </div>';
      require_once '../html/body/bodyFormContatti.html';
      break;
  }
  //RICHIEDI IL FOOTER
  if($page == "contatti") {
    require_once '../html/footer/footerFormContatti.html';
  } else {
    require_once '../html/footer/footer.html';
  }
?>
