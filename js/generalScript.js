//FUNZIONE CHE CONTROLLA IL TIPO DI BROWSER
"use strict";
var isEdge = false;
window.onload = function () {
  "use strict";
  if (navigator.appVersion.indexOf("Edge") > -1) {
    isEdge = true;
    document.getElementById("navbar").className = "navEdge";
  }
}  	
//FUNZIONE CHIAMANTE PER LO SCROLLCHECK
window.onscroll = function() {
  "use strict";
  scrollFunction();
}
//FUNZIONE CHE MODIFCA L'ALTEZZA DELLA NAVBAR IN BASE ALLO SCROLL
function scrollFunction() {
  "use strict";
  //PRELEVA GLI ELEMENTI
  var navBar = document.getElementById('navbar');
  var navCover = document.getElementById('nav_cover');
  var logo = document.getElementById('logo_div');
  var breadcrumb = document.getElementById('breadcrumb');
  //PRELEVA IL VALORE DELLO SCROLL
  var elementScroll = document.documentElement.scrollTop || document.body.scrollTop;
  //RIDUCI IL MENU' DI NAVIGAZIONE SE LO SCROLL E' MAGGIORE DI 45PX
  //CONTROLLA SE IL BROWSER E' MS EDGE
  if (!isEdge) {
    if (elementScroll > 45) {
      navBar.className = "nav resized_nav";
      navCover.className = "nav_cover resized_cover";
      logo.className = "logo logo_resized";
      breadcrumb.className = "breadcrumb breadcrumb_resized";
    } else {
      //RIPRISTINA LA DIMENSIONE ORIGINALE DEL MENU'
      navBar.className = "nav";
      navCover.className = "nav_cover";
      logo.className = "logo"
      breadcrumb.className = "breadcrumb";
    }
  } else {
      if (elementScroll > 45) {
        navBar.className = "navEdge resized_nav";
        navCover.className = "nav_cover resized_cover";
        logo.className = "logo logo_resized";
        breadcrumb.className = "breadcrumb breadcrumb_resized";
      } else {
        //RIPRISTINA LA DIMENSIONE ORIGINALE DEL MENU'
        navBar.className = "navEdge";
        navCover.className = "nav_cover";
        logo.className = "logo"
        breadcrumb.className = "breadcrumb";
      }
  }
}
//FUNZIONE CHE APRE LA SEGNALAZIONE RICHIESTA (CASO KEYPRESS)
function openReportPress(reportId, event) {
  "use strict";
  if(event.which === 13) {
    var reportLink = "general.php?id=viewReport&reportId=" + reportId;
    window.open(reportLink, "_self");
  }
}
//FUNZIONE CHE APRE LA SEGNALAZIONE RICHIESTA (CASO ONCLICK)
function openReportClick(reportId) {
  "use strict";
  var reportLink = "general.php?id=viewReport&reportId=" + reportId;
  window.open(reportLink, "_self");
}
//FUNZIONE PER STAMPARE LA SEGNALAZIONE
function printKey(event) {
  "use strict";
  if(event.which === 13) {
    window.print();
  }
}
