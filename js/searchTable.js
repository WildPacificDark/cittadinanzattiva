//FUNZIONE PER CERCARE UN ELEMENTO IN UNA TABELLA
function searchTable() {
  "use strict";
  var input = document.getElementById("searchTable").value; //PRELEVA IL VALORE DELL'INPUT
  var radios = document.getElementsByName("queryValue"); //PRELEVA IL CHECKBOX
  var filter = input.toUpperCase(); //CONVERTI LA STRINGA IN UPPERCASE/FILTRO PER LA RICERCA
  var table = document.getElementById("reportTable"); //PRENDI LA TABELLA
  var tr = table.getElementsByTagName("tr"); //PRENDI LE RIGHE DELLA TABELLA
  var td; //VARIABILE PER LE CELLE
  var i; //VARIABILE PER IL CICLO FOR
  var textValue; //VALORE DELL'INPUT
  var checkedRadio = 0; //VARIABILE CHE DETIENE IL VALORE DEL "RADIOBOX"
  var stop = false; //VARIABILE DI USCITA DAL CICLO
  //CERCA IL VALORE DELL'INPUT RADIO
  for (i = 0; i < radios.length && !stop; i += 1) {
    if (radios[i].checked) {
      //PRELEVA IL VALORE DEL BOX SCELTO
      checkedRadio = radios[i].value;
      //FERMA LA RICERCA
      stop = true;
	}
  }
  //CERCA TRA LE RIGHE DELLA TABELLA E NASCONDI QUELLE CHE NON CORRISPONDONO
  for (i = 0; i < tr.length; i += 1) {
    //PRELEVA LE CELLE IN BASE AL TIPO DI DATO RICERCATO
    td = tr[i].getElementsByTagName("td")[checkedRadio];
	//SE LA CELLA E' DEFINITA
    if (td) {
      //PRELEVA IL VALORE DELL'INPUT
      textValue = td.textContent || td.innerText;
	  //SE ESISTE UN'OCCORRENZA NELLA TABELLA
      if (textValue.toUpperCase().indexOf(filter) > -1) {
        //MOSTRA LE RIGHE INTERESSATE
        tr[i].className = "useless";
      } else {
      //NASCONDI LE RIGHE DI NON INTERESSE
        tr[i].className = "hidden";
      }
    }       
  }
}