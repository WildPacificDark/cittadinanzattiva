function checkInput(tab) {
  //VARIABILI PER IL CONTROLLO GENERALE
  var check_1 = false;
  var check_2 = false;
  var check_3 = false;
  //PRELEVA IL VALORE DELL'INPUT
  var select = document.getElementById("tipoSegnalazione");
  var provincia = document.getElementById("provincia");
  var paese = document.getElementById("paese");
  var nomeStrada = document.getElementById("nomeStrada");
  var text = document.getElementById("text");
  //VARIABILI DI ERRORE
  var errorSelect = document.getElementById("errorSelect");
  var errorProv = document.getElementById("errorProv");
  var errorPaese = document.getElementById("errorPaese");
  var errorAddress = document.getElementById("errorAddress");
  var errorText = document.getElementById("errorText");
  //VARIABILE DI CONTROLLO PER IL MATCH
  var pos = 0;
  //TAB 1
  if (tab === 0) {
    //PRELIEVA IL VALORE DELLA SELECT
    //SE E' VUOTO -> ERRORE
    if (select.value === "") {
      //STAMPA MESSAGGIO D'ERRORE
      errorSelect.innerHTML = 
      "Seleziona la tipologia di segnalazione";
      //IL CAMPO DIVENTA ROSSO (INVALIDO)
      select.className = "invalid";
      //CONTROLLO -> FALSO
      return false;
    } else { //ALTRIMENTI
      //CANCELLA MESSAGGIO DI ERRORE
      errorSelect.innerHTML = "";
      //IL CAMPO DIVENTA VERDE (VALIDO)
      select.className = "valid";
      //CONTROLLO -> VERO
      return true;
    }
  }
  //TAB 2
  if (tab === 1) {
    //SE LA PROVINCIA E' VUOTA
    if (provincia.value === "") {
      //STAMPA MESSAGGIO D'ERRORE
      errorProv.innerHTML = 
	  "Non puoi lasciare vuoto questo campo";
      //IL CAMPO DIVENTA ROSSO (INVALIDO)
      provincia.className = "invalid";
      //CONTROLLO -> FALSO
      check_1 = false;
    } else {
      //L'INPUT MATCHA LA REGEX?
      pos = provincia.value.search(/[^a-zA-Z\s\/.,']/g);
      //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
      if (pos >= 0) {
        //STAMPA MESSAGGIO D'ERRORE
        errorProv.innerHTML = "Il campo deve contenere solo lettere";
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        provincia.className = "invalid";
        //CONTROLLO -> FALSO
        check_1 = false;
	  } else {
        //CANCELLA MESSAGGIO DI ERRORE
        errorProv.innerHTML = "";
        //IL CAMPO DIVENTA ROSSO (INVALIDO)
        provincia.className = "valid";
        //CONTROLLO -> VERO
        check_1 = true;
	  }
    }
    //CONTROLLA IL CAMPO PAESE
    if (paese.value === "") {
      //STAMPA MESSAGGIO DI ERRORE
      errorPaese.innerHTML = 
	  "Non puoi lasciare vuoto questo campo";
      //IL CAMPO DIVENTA ROSSO (INVALIDO)
      paese.className = "invalid";
      //CONTROLLO -> FALSO
      check_2 = false;
	} else {
      //L'INPUT MATCHA LA REGEX?
      pos = paese.value.search(/[^a-zA-Z\s\/.,']/g);
      //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
      if (pos >= 0) {
        //STAMPA MESSAGGIO D'ERRORE
        errorPaese.innerHTML = "Il camp deve contenere solo lettere";
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        paese.className = "invalid";
        //CONTROLLO -> FALSO
        check_2 = false;
      } else {
        //CANCELLA MESSAGGIO D'ERRORE
        errorPaese.innerHTML = "";
        //IL CAMPO DIVENTA VALIDO (VERDE)
        paese.className = "valid";
        //CONTROLLO -> VERO
        check_2 = true;
      }
    }
    //CONTROLLA LA STRADA
    if (nomeStrada.value === "") {
      //STAMPA MESSAGGIO DI ERRORE
      errorAddress.innerHTML = 
	  "Non puoi lasciare vuoto questo campo";
      //IL CAMPO DIVENTA ROSSO (INVALIDO)
      nomeStrada.className = " invalid";
      //CONTROLLO -> FALSO
      check_3 = false;
    } else {
      //L'INPUT MATCHA LA REGEX?
      pos = nomeStrada.value.search(/[^a-zA-Z|\s|\/.|,|']/g);
      //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
      if (pos >= 0) {
        //STAMPA MESSAGGIO D'ERRORE
        errorAddress.innerHTML = "Il nome della strada deve contenere solo lettere";
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        nomeStrada.className = "invalid";
        //CONTROLLO -> FALSO
        check_3= false;
      } else {
        //CANCELLA MESSAGGIO D'ERRORE
        errorAddress.innerHTML = "";
        //IL CAMPO DIVENTA VALIDO (VERDE)
        nomeStrada.className = "valid";
        //CONTROLLO -> VERO
        check_3 = true;
      }
	}
    //CONTROLLA SE TUTTI I CAMPI SONO CORRETTI
    if (check_1 && check_2 && check_3) {
      return true;
    } else {
      return false;
    }
  }
  //TAB 3
  if (tab === 2) {
    //PRELEVA IL TESTO
    //SE Il CAMPO E' VUOTO -> ERRORE
    if (text.value === "") {
      //STAMPA MESSAGGIO DI ERRORE
      errorText.innerHTML = 
	  "Non puoi lasciare vuoto questo campo";
      //IL CAMPO DIVENTA ROSSO (INVALIDO)
      text.className = " invalid";
      //CONTROLLO -> FALSO
      return false;
    } else {
      //CANCELLA MESSAGGIO DI ERRORE
      errorText.innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VALIDO)
      text.className = " valid";
      //CONTROLLO -> VERO
      return true;
    }
  }
}
//FUNZIONE PER SCORRERE IN AVANTI LE TAB DELLA FORM
function nextTab(currentTab) {
  "use strict";
  //PRIMA DI PROSEGUIRE CONTROLLA SE I CAMPI
  //SONO STATI RIEMPITI CORRETTAMENTE
  var valid = checkInput(currentTab);
  if (valid !== false) {
    //SE LE' LA PRIMA TAB, NASCONDILA E MOSTRA LA SECONDA
    if (currentTab === 0) {
      document.getElementById("tab_0").className = "container hidden";
      document.getElementById("tab_1").className = "container";
    }
    //SE E' LA SECONDA TAB, NASCONDILA E MOSTRA LA TERZA
    if (currentTab === 1) {
      document.getElementById("tab_1").className = "container hidden";
      document.getElementById("tab_2").className = "container";
    }
    //SE TUTTI I DATI SONO CORRETTI INVIA LA FORM
    if (currentTab === 2 && valid === true) {
      document.getElementById("reportForm").submit();
    }
  }
}
//FUNZIONE PER SCORRERE ALL'INDIETRO LE TAB DELLA FORM
function prevTab(currentTab) {
  "use strict";
  //SE ? LA SECONDA TAB NASCONDILA E MOSTRA LA PRIMA
  if (currentTab === 1) {
    document.getElementById("tab_1").className = "container hidden";
    document.getElementById("tab_0").className = "container";
  }
  //SE E' LA TERZA TAB, NASCONDILA E MOSTRA LA SECONDA
  if (currentTab === 2) {
    document.getElementById("tab_2").className = "container hidden";
    document.getElementById("tab_1").className = "container";
  }
}