//FUNZIONE PER CERCARE UNA NEWS
function searchNews() {
  "use strict";
  var input = document.getElementById("searchNews").value; //PRELEVA IL VALORE DELL'INPUT
  var radios = document.getElementsByName("queryValue"); //PRELEVA IL CHECKBOX
  var filter = input.toUpperCase(); //CONVERTI LA STRINGA IN UPPERCASE/FILTRO PER LA RICERCA
  var id = document.getElementsByClassName("newsId"); //PRENDI LA CLASSE ID
  var title = document.getElementsByClassName("newsTitle"); //PRENDI LA CLASSE TITOLO
  var date = document.getElementsByClassName("newsDate"); //PRENDI LA CLASSE DATA
  var checkedRadio = 0; //VARIABILE CHE DETIENE IL VALORE DEL "RADIOBOX"
  var stop = false; //VARIABILE DI USCITA DAL CICLO
  var textValue; //VALORE DA CERCARE
  var newsHeader; //VARIABILE PER IL PARENTNODE
  var i = 0; //VARIABILE PER IL CICLO FOR
  //VARIABILI PER IL CONTROLLO DEL RISULTATO
  var newsWrapper = document.getElementsByClassName("newsWrapper");
  var count = 0;
  //VARIABILE PER MANDARE IN OUTPUT NESSUN RISULTATO
  var noResults = document.getElementById("noResults");
  //CERCA IL VALORE DELL'INPUT RADIO
  for (i = 0; i < radios.length && !stop; i += 1) {
    if (radios[i].checked) {
      //PRELEVA IL VALORE DEL BOX SCELTO
      checkedRadio = radios[i].value;
      //FERMA LA RICERCA
      stop = true;
    }
  }
  //IN BASE AL CAMPO SELEZIONATO CERCA LA NEWS
  switch (checkedRadio) {
    //CASO ID
    case "0":
      for (i = 0; i < id.length; i += 1) {
        //CERCA CORRISPONDENZA
        textValue = id[i].innerText || id[i].textContent;
        if (textValue.toUpperCase().indexOf(filter) > -1) {
          //SE ESISTE MOSTRA SOLO LA CORRISPONDENZA
          newsHeader = id[i].parentNode;
          newsHeader.parentNode.className = "newsWrapper"
        } else {
          //E NASCONDI LE ALTRE
          newsHeader = id[i].parentNode;
          newsHeader.parentNode.className = "newsWrapper hidden"
        }
      }
      //CONTROLLO SE NON CI SONO MATCH
      count = 0;
      for (i = 0; i < newsWrapper.length; i+= 1) {
        //SE TUTTE LE NEWS HANNO IL CAMPO HIDDEN
        if (newsWrapper[i].className === "newsWrapper hidden") {
          count += 1; //INCREMENTA COUNT
        } else {
          count -= 1; //VICEVERSA DECREMENTA
        }
      }
      //NESSUN MATH -> NESSUN RISULTATO
      if (count === newsWrapper.length) {
        noResults.innerHTML = "Nessun risultato";
      } else { //CANCELLA MESSAGGIO
        noResults.innerHTML = "";
      }
      break;
    //CASO TITOLO
    case "1":
      for (i = 0; i < title.length; i += 1) {
        textValue = title[i].innerText || title[i].textContent;
        //CERCA CORRISPONDENZA
        if (textValue.toUpperCase().indexOf(filter) > -1) {
          //SE ESISTE MOSTRA SOLO LA CORRISPONDENZA
          newsHeader = title[i].parentNode;
          newsHeader.parentNode.className = "newsWrapper"
        } else {
          //E NASCONDI LE ALTRE
          newsHeader = title[i].parentNode;
          newsHeader.parentNode.className = "newsWrapper hidden"
        }
      }
      //CONTROLLO SE NON CI SONO MATCH
      count = 0;
      for (i = 0; i < newsWrapper.length; i+= 1) {
        //SE TUTTE LE NEWS HANNO IL CAMPO HIDDEN
        if (newsWrapper[i].className === "newsWrapper hidden") {
          count += 1; //INCREMENTA COUNT
        } else {
          count -= 1; //VICEVERSA DECREMENTA
        }
      }
      //NESSUN MATH -> NESSUN RISULTATO
      if(count === newsWrapper.length) {
        noResults.innerHTML = "Nessun risultato";
      } else { //CANCELLA MESSAGGIO
        noResults.innerHTML = "";
      }
      break;
    //CASO DATA
    case "2":
      for (i = 0; i < date.length; i += 1) {
        textValue = date[i].innerText || date[i].textContent;
        //CERCA CORRISPONDENZA
        if (textValue.toUpperCase().indexOf(filter) > -1) {
          //SE ESISTE MOSTRA SOLO LA CORRISPONDENZA
          newsHeader = date[i].parentNode;
          newsHeader.parentNode.className = "newsWrapper"
        } else { //E NASCONDI LE ALTRE
          newsHeader = date[i].parentNode;
          newsHeader.parentNode.className = "newsWrapper hidden"
        }
      }
      //CONTROLLO SE NON CI SONO MATCH
      count = 0;
      for (i = 0; i < newsWrapper.length; i+= 1) {
        //SE TUTTE LE NEWS HANNO IL CAMPO HIDDEN
        if (newsWrapper[i].className === "newsWrapper hidden") {
          count += 1; //INCREMENTA COUNT
        } else {
          count -= 1; //VICEVERSA DECREMENTA
        }
      }
      //NESSUN MATH -> NESSUN RISULTATO
      if(count === newsWrapper.length) {
        noResults.innerHTML = "Nessun risultato";
      } else { //CANCELLA MESSAGGIO
        noResults.innerHTML = "";
      }
      break;
    //CASO DI DEFAULT
    default:
      noResults.innerHTML = "Nessun risultato";
      break;
  }
}
