/*PRELEVA GLI ELEMENTI*/
//TAB 1
var nome = document.getElementById("nome");
var cognome = document.getElementById("cognome");
var cf = document.getElementById("cf");
var data = document.getElementById("date");
//TAB 2
var indirizzo = document.getElementById("indirizzo");
var civico = document.getElementById("civico");
var paese = document.getElementById("paese");
var provincia = document.getElementById("provincia");
//TAB 3
var telefono = document.getElementById("telefono");
var cellulare = document.getElementById("cellulare");
var email = document.getElementById("email");
//TAB 4 
var regUsername = document.getElementById("regUsername");
var regPassword = document.getElementById("regPassword");
var cofPassword = document.getElementById("cofPassword");
/*VARIABILI PER IL DISPLAY DEGLI ERRORI*/
var errorName = document.getElementById("errorName");
var errorSurname = document.getElementById("errorSurname");
var errorCf = document.getElementById("errorCf");
var errorData = document.getElementById("errorData");
var errorAddress = document.getElementById("errorAddress");
var errorCivico = document.getElementById("errorCivico");
var errorPaese = document.getElementById("errorPaese");
var errorProv = document.getElementById("errorProv");
var errorTel = document.getElementById("errorTel");
var errorCell = document.getElementById("errorCell");
var errorEmail = document.getElementById("errorEmail");
var errorUser = document.getElementById("errorUser");
var errorPwd = document.getElementById("errorPwd");
var errorCofPwd = document.getElementById("errorCofPwd");
//FUNZIONE PER PULIRE L'INPUT
function clearInput(tab) {
  "use strict";
  //TAB 0
  if(tab === 0) {
    //RESETTA L'INPUT
    nome.value = "";
    cognome.value = "";
    data.value = "";
    cf.value = "";
    //RESETTA IL MESSAGGIO DI ERRORE
    errorName.innerHTML = "";
    errorSurname.innerHTML = "";
    errorData.innerHTML = "";
    errorCf.innerHTML = "";
    //RESETTA LA CLASSE CSS DELL'INPUT
    nome.className = "useless";
    cognome.className = "useless";
    data.className = "useless";
    cf.className = "useless";
  }
  if(tab === 1) {
    //RESETTA L'INPUT
    indirizzo.value = "";
    civico.value = "";
    paese.value = "";
    provincia.value = "";
    //RESETTA IL MESSAGGIO DI ERRORE
    errorAddress.innerHTML = "";
    errorCivico.innerHTML = "";
    errorPaese.innerHTML = "";
    errorProv.innerHTML = "";
    //RESETTA LA CLASSE CSS DELL'INPUT
    indirizzo.className = "useless";
    civico.className = "useless";
    paese.className = "useless";
    provincia.className = "useless";
  }
  if(tab === 2) {
    //RESETTA L'INPUT
    telefono.value = "";
    cellulare.value = "";
    email.value = "";
    //RESETTA IL MESSAGGIO DI ERRORE
    errorTel.innerHTML = "";
    errorCell.innerHTML = "";
    errorEmail.innerHTML = "";
    //RESETTA LA CLASSE CSS DELL'INPUT
    telefono.className = "useless";
    cellulare.className = "useless";
    email.className = "useless";
  }
  if(tab === 3) {
    //RESETTA L'INPUT
    regUsername.value = "";
    regPassword.value = "";
    cofPassword.value = "";
    //RESETTA IL MESSAGGIO DI ERRORE
    errorUser.innerHTML = "";
    errorPwd.innerHTML = "";
    errorCofPwd.innerHTML = "";
    //RESETTA LA CLASSE CSS DELL'INPUT
	regUsername.className = "useless";
    regPassword.className = "useless";
    cofPassword.className = "useless";
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
  //SE E' LA QUARTA TAB, NASCONDILA E MOSTRA LA TERZA
  if (currentTab === 3) {
    document.getElementById("tab_3").className = "container hidden";
    document.getElementById("tab_2").className = "container";
  }
}
//FUNZIONE PER SCORRERE IN AVANTI LE TAB DELLA FORM
function nextTab(currentTab) {
  "use strict";
  //PRIMA DI PROSEGUIRE CONTROLLA SE I CAMPI SONO STATI RIEMPITI CORRETTAMENTE
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
    //SE E' LA TERZA TAB, NASCONDILA E MOSTRA LA QUARTA
    if (currentTab === 2) {
      document.getElementById("tab_2").className = "container hidden";
      document.getElementById("tab_3").className = "container";
    }
    //SE TUTTI I DATI SONO CORRETTI INVIA LA FORM
    if (currentTab === 3 && valid === true) {
      document.getElementById("regForm").submit();
    }
  }
}
//FUNZIONE DI CONTROLLO DELL'INPUT
function checkInput(tab) {
  "use strict";
  /*VARIABILI DI CONTROLLO*/
  var check_1 = false;
  var check_2 = false;
  var check_3 = false;
  var check_4 = false;
  /*POS = VARIABILE CHE TIENE IL RISULTATO DEL MATCH DELL'INPUT CON LA REGEX*/
  var pos = 0;
  /*SALVA SPAZIO*/
  var voidField = "Non puoi lasciare vuoto questo campo";
  var onlyLetter = " deve contenere solo lettere";
  if (tab === 0) {
    //NOME
    //SE VUOTO -> ERRORE
    if (nome.value === "") {
      //STAMPA MESSAGGIO D'ERRORE
      errorName.innerHTML = voidField;
      //IL CAMPO DIVENTA ROSSO (INVALIDO)
      nome.className = "invalid";
      //CONTROLLO -> FALSO
      check_1 = false;
    } else {
    //L'INPUT MATCHA LA REGEX?
      pos = nome.value.search(/[^a-zA-Z|\s|']/g);
      //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
      if (pos >= 0) {
        //STAMPA MESSAGGIO D'ERRORE
        errorName.innerHTML = "Il nome" + onlyLetter;
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        nome.className = "invalid";
        //CONTROLLO -> FALSO
        check_1 = false;
      } else { //ALTRIMENTI OK
        //CANCELLA MESSAGGIO D'ERRORE
        errorName.innerHTML = "";
        //IL CAMPO DIVENTA VALIDO (VERDE)
        nome.className = "valid";
        //CONTROLLO -> VERO
        check_1 = true;
      }
    }
    //COGNOME
    //SE VUOTO -> ERRORE
    if (cognome.value === "") {
      //STAMPA MESSAGGIO D'ERRORE
      errorSurname.innerHTML = voidField;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      cognome.className = "invalid";
      check_2 = false;
    } else {
      //L'INPUT MATCHA LA REGEX?
      pos = cognome.value.search(/[^a-zA-Z|\s|']/g);
      //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
      if (pos >= 0) {
      //STAMPA MESSAGGIO D'ERRORE
      errorSurname.innerHTML = "Il cognome" + onlyLetter;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      cognome.className = "invalid";
      //CONTROLLO -> FALSO
      check_2 = false;
      } else {
        //CANCELLA MESSAGGIO D'ERRORE
        errorSurname.innerHTML = "";
        //IL CAMPO DIVENTA VALIDO (VERDE)
        cognome.className = "valid";
        //CONTROLLO -> FALSO
        check_2 = true;
      }
    }
    //CODICE FISCALE
    //SE VUOTO -> ERRORE
    if (cf.value === "") {
      //STAMPA MESSAGGIO D'ERRORE
      errorCf.innerHTML = voidField;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      cf.className = "invalid";
      //CONTROLLO -> FALSO
      check_3 = false;
    } else {
      //L'INPUT MATCHA LA REGEX?
      pos = cf.value.search(/^[A-Z]{6}\d{2}[A-Z]{1}\d{2}[A-Z]{1}\d{3}[A-Z]$/);
      //SE SEARCH != 0, L'INPUT IMMESSO NON E'CORRETTO
      if (pos !== 0) {
        //STAMPA MESSAGGIO D'ERRORE
        errorCf.innerHTML = "Codice Fiscale Errato";
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        cf.className = "invalid";
        //CONTROLLO -> FALSO
        check_3 = false;
      } else {
        //CANCELLA MESSAGGIO D'ERRORE
        errorCf.innerHTML = "";
        //IL CAMPO DIVENTA VALIDO (VERDE)
        cf.className = "valid";
        //CONTROLLO -> VERO
        check_3 = true;
      }
    }
    //DATA
    //SE VUOTA -> ERRORE
    if (data.value === "") {
      //STAMPA MESSAGGIO D'ERRORE
      errorData.innerHTML = voidField;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      data.className = "invalid";
      //CONTROLLO -> FALSO
      check_4 = false;
    } else {
      var regs = data.value.match(/^(\d{4})\-(\d{1,2})\-(\d{1,2})$/);
      //SE L'ANNO INSERITO SUPERA LE 4 CIFRE
      if(regs === null) {
        //STAMPA MESSAGGIO D'ERRORE
        errorData.innerHTML = "Inserisci un anno compreso tra il 1900 ed il 2001";
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        data.className = "invalid";
        //CONTROLLO -> FALSO
        check_4 = false;
      } else if (regs[1] < 1900 || regs[1] > 2001) { //CONTROLLA SE L'ANNO E' COMPRESO TRA IL 1900 E IL 2001
        //STAMPA MESSAGGIO D'ERRORE
        errorData.innerHTML = "Inserisci un anno compreso tra il 1900 ed il 2001";
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        data.className = "invalid";
        //CONTROLLO -> FALSO
        check_4 = false;
      } else {
        //CANCELLA MESSAGGIO D'ERRORE
        errorData.innerHTML = "";
        //IL CAMPO DIVENTA VALIDO (VERDE)
        data.className = "valid";
        //CONTROLLO -> VERO
        check_4 = true;
      }
    }
    //SE TUTTI I CAMPI SONO VALIDI RITORNA VERO
    if (check_1 && check_2 && check_3 && check_4) {
      return true;
    } else {
       return false;
    }
  }
  if (tab === 1) {
    //INDIRIZZO
    //SE VUOTO -> ERRORE
    if (indirizzo.value === "") {
      //STAMPA MESSAGGIO D'ERRORE
      errorAddress.innerHTML = voidField;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      indirizzo.className = "invalid";
      //CONTROLLO -> FALSO
      check_1 = false;
    } else {
      //L'INPUT MATCHA LA REGEX?
      pos = indirizzo.value.search(/[^a-zA-Z|\s|\/.|,|']/g);
      //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
      if (pos >= 0) {
        //STAMPA MESSAGGIO D'ERRORE
        errorAddress.innerHTML = "L'indirizzo" + onlyLetter;
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        indirizzo.className = "invalid";
        //CONTROLLO -> FALSO
        check_1 = false;
      } else {
        //CANCELLA MESSAGGIO D'ERRORE
        errorAddress.innerHTML = "";
        //IL CAMPO DIVENTA VALIDO (VERDE)
        indirizzo.className = "valid";
        //CONTROLLO -> VERO
        check_1 = true;
      }
    }
    //CIVICO
    //SE VUOTO -> ERRORE
    if (civico.value === "") {
      //STAMPA MESSAGGIO D'ERRORE
      errorCivico.innerHTML = voidField;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      civico.className = "invalid";
      //CONTROLLO -> FALSO
      check_2 = false;
    } else {
      //L'INPUT MATCHA LA REGEX?
      pos = civico.value.search(/[0-9][\\]*[\/]*[a-zA-Z]*/g);
      //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
      if (pos !== 0) {
        //STAMPA MESSAGGIO D'ERRORE
        errorCivico.innerHTML = "Il civico deve contenere solo numeri";
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        civico.className = "invalid";
        //CONTROLLO -> FALSO
        check_2 = false;
      } else {
        //CANCELLA MESSAGGIO D'ERRORE
        errorCivico.innerHTML = "";
        //IL CAMPO DIVENTA VALIDO (VERDE)
        civico.className = "valid";
        //CONTROLLO -> VERO
        check_2 = true;
      }
    }
    //COMUNE
    //SE VUOTO -> ERRORE
    if (paese.value === "") {
      errorPaese.innerHTML = voidField;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      paese.className = "invalid";
      //CONTROLLO -> FALSO
      check_3 = false;
    } else {
      //L'INPUT MATCHA LA REGEX?
      pos = paese.value.search(/[^a-zA-Z\s\/.,']/g);
      //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
      if (pos >= 0) {
        //STAMPA MESSAGGIO D'ERRORE
        errorPaese.innerHTML = "Il campo" + onlyLetter;
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        paese.className = "invalid";
        //CONTROLLO -> FALSO
        check_3 = false;
      } else {
        //CANCELLA MESSAGGIO D'ERRORE
        errorPaese.innerHTML = "";
        //IL CAMPO DIVENTA VALIDO (VERDE)
        paese.className = "valid";
        //CONTROLLO -> VERO
        check_3 = true;
      }
    }
    //PROVINCIA
    //SE VUOTO -> ERRORE
    if (provincia.value === "") {
      //STAMPA MESSAGGIO D'ERRORE
      errorProv.innerHTML = voidField;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      provincia.className = "invalid";
      //CONTROLLO -> FALSO
      check_4 = false;
    } else {
      //L'INPUT MATCHA LA REGEX?
      pos = provincia.value.search(/[^a-zA-Z\s\/.,']/g);
      //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
      if (pos >= 0) {
        //STAMPA MESSAGGIO D'ERRORE
        errorProv.innerHTML = "Il campo" + onlyLetter;
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        provincia.className = "invalid";
        //CONTROLLO -> FALSO
        check_4 = false;
      } else {
        //CANCELLA MESSAGGIO D'ERRORE
        errorProv.innerHTML = "";
        //IL CAMPO DIVENTA VALIDO (VERDE)
        provincia.className = "valid";
        //CONTROLLO -> VERO
        check_4 = true;
      }
    }
    //SE TUTTI I CAMPI SONO VALIDI RITORNA VERO
    if (check_1 && check_2 && check_3 && check_4) {
      return true;
      
    } else { //ALTRIMENTI C'E' UN ERRORE NELL'INPUT
      return false;
    }
  }
  if (tab === 2) {
    //TELEFONO
    //IL CAMPO PUO' ESSERE VUOTO
    //SE IMMESSO CONTROLLA CHE SIA VALIDO
    if (telefono.value !== "") {
      //L'INPUT MATCHA LA REGEX?
      pos = telefono.value.search(/[^0-9]/);
      //SE POS >= 0 L'INPUT IMMESSO E' ERRATO
      if (pos >= 0) {
        //STAMPA MESSAGGIO DI ERRORE
        errorTel.innerHTML = "Inserisci un numero di telefono valido";
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        telefono.className = "valid";
        //CONTROLLO -> FALSO
        check_1 = false;
      } else {
        //CANCELLA MESSAGGIO D'ERRORE
        errorTel.innerHTML = "";
        //IL CAMPO DIVENTA VALIDO (VERDE)
        telefono.className = "valid";
        //CONTROLLO -> VERO
        check_1 = true;
      }
    } else { //SE NON VIENE IMMESSO NESSUN NUMERO METTI CONTROLLO A VERO
      check_1 = true;
    }
    //CELLULARE
    //SE VUOTO -> ERRORE
    if (cellulare.value === "") {
      //STAMPA MESSAGGIO D'ERRORE
      errorCell.innerHTML = voidField;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      cellulare.className = "invalid";
      //CONTROLLO -> FALSO
      check_2 = false;
    } else {
      //L'INPUT MATCHA LA REGEX?
      pos = cellulare.value.search(/[^0-9]/);
      //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
      if (pos >= 0) {
        //STAMPA MESSAGGIO D'ERRORE
        errorCell.innerHTML = "Inserisci un numero di cellulare valido";
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        cellulare.className = "invalid";
        //CONTROLLO -> FALSO
        check_2 = false;
      } else {
        //CANCELLA MESSAGGIO D'ERRORE
        errorCell.innerHTML = "";
        //IL CAMPO DIVENTA VALIDO (VERDE)
        cellulare.className = "valid";
        //CONTROLLO -> VERO
        check_2 = true;
      }
    }
    //EMAIL
    //SE VUOTO -> ERRORE
    if (email.value === "") {
      //STAMPA MESSAGGIO D'ERRORE
      errorEmail.innerHTML = voidField;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      email.className = "invalid";
      check_3 = false;
    } else {
      //L'INPUT MATCHA LA REGEX?
      pos = email.value.search(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\,.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
      //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
      if (pos !== 0) {
        //STAMPA MESSAGGIO D'ERRORE
        errorEmail.innerHTML = "Inserisci una email valida";
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        email.className = "invalid";
        //CONTROLLO -> FALSO
        check_3 = false;
      } else {
        //CANCELLA MESSAGGIO D'ERRORE
        errorEmail.innerHTML = "";
        //IL CAMPO DIVENTA VALIDO (VERDE)
        email.className = "valid";
        //CONTROLLO -> VERO
        check_3 = true;
      }
    }
    //SE TUTTI I CAMPI SONO VALIDI RITORNA VERO
    if (check_1 && check_2 && check_3) {
      return true;
    } else { //ALTRIMENTI C'E' UN ERRORE NELL'INPUT
      return false;
    }
  }
  if (tab === 3) {
    //USERNAME
    //SE VUOTO -> ERRORE
    if (regUsername.value === "") {
      //STAMPA MESSAGGIO D'ERRORE
      errorUser.innerHTML = voidField;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      regUsername.className = "invalid";
      //CONTROLLO -> FALSO
      check_1 = false;
    } else { //CONTROLLA SE IL NOME UTENTE ESISTE
      var xmlhttp = new XMLHttpRequest();
      //ID DEL TIPO RICERCA PER "liveSearch.php"
      var queryId = "&queryId=user";
      xmlhttp.onreadystatechange = function () {
        //SE LA RICHIESTA E' STATA ELABORATA
        if (this.readyState === 4 && this.status === 200) {
          //SE IL NOME UTENTE E' GIA' PRESENTE RITORNA FALSO
          if (this.responseText === "0") {
            //STAMPA MESSAGGIO D'ERRORE
            errorUser.innerHTML = "Questo nome utente non &egrave; disponibile";
            //IL CAMPO DIVENTA INVALIDO (ROSSO)
            regUsername.className = "invalid";
            //CONTROLLO -> FALSO
            check_1 = false;
          } else {
            //CANCELLA MESSAGGIO D'ERRORE
            errorUser.innerHTML = "";
            //IL CAMPO DIVENTA VALIDO (VERDE)
            regUsername.className = "valid";
            //CONTROLLO -> VERO
            check_1 = true;
          }
        }
      };
      //PREPARA LA RICHIESTA
      xmlhttp.open("GET", "../php/script/liveSearch.php?query=" + regUsername.value + queryId, true);
      //INVIA
      xmlhttp.send();
    }
    //PASSWORD
    //SE VUOTO -> ERRORE
    if (regPassword.value === "") {
      //STAMPA MESSAGGIO D'ERRORE
      errorPwd.innerHTML = voidField;
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      regPassword.className = "invalid";
      //CONTROLLO -> FALSO
      check_2 = false;
    } else {
      //MESSAGGIO PASSWORD INVALIDA
      var invalidPwd = "La password deve avere una lunghezza minima di 8, \
      contenere almeno una lettera maiuscola, una minuscola, \
      un numero e un carattere speciale";
      //L'INPUT MATCHA LA REGEX?
      pos = regPassword.value.search(/(^(?=.*[a-z])|(?=.*[A-Z]))(?=.*\d)(?=.*[^\da-zA-Z]).{8,32}$/gm);
      //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
      if (pos !== 0) {
        //STAMPA MESSAGGIO D'ERRORE
        errorPwd.innerHTML = invalidPwd;
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        regPassword.className = "invalid";
        //CONTROLLO -> FALSO
        check_2 = false;
      } else {
        //CANCELLA MESSAGGIO D'ERRORE
        errorPwd.innerHTML = "";
        //IL CAMPO DIVENTA VALIDO (VERDE)
        regPassword.className = "valid";
        //CONTROLLO -> VERO
        check_2 = true;
      }
    }
    //CONFERMA PASSWORD
    //SE VUOTO -> ERRORE
    if (cofPassword.value === "") {
      //STAMPA MESSAGGIO D'ERRORE
      errorCofPwd.innerHTML = "Non puoi lasciare vuoto questo campo";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      cofPassword.className = "invalid";
      //CONTROLLO -> FALSO
      check_3 = false;
    } else {
      if (cofPassword.value !== regPassword.value) {
        //STAMPA MESSAGGIO D'ERRORE
        errorCofPwd.innerHTML = "Le password non combaciano";
        //IL CAMPO DIVENTA INVALIDO (ROSSO)
        cofPassword.className = "invalid";
        //CONTROLLO -> FALSO
        check_3 = false;
      } else {
        //CANCELLA MESSAGGIO D'ERRORE
        errorCofPwd.innerHTML = "";
        //IL CAMPO DIVENTA VALIDO (VERDE)
        cofPassword.className = "valid";
        //CONTROLLO -> VERO
        check_3 = true;
      }
    }
    //SE TUTTI I CAMPI SONO VALIDI RITORNA VERO
    if (check_1 && check_2 && check_3) {
      return true;
    } else {  //ALTRIMENTI C'E' UN ERRORE NELL'INPUT
       return false;
    }
  }
}
