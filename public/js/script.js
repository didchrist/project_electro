/* fonction pour le menu déroulant */
function menuProduits(e, aLien) {
  e.preventDefault();
  var sousMenu = document.getElementById("menuderoulant");
  var closeButton = document.getElementById("close");
  var tableauMenu = document.querySelectorAll(".menu");
  console.log(tableauMenu);
  sousMenu.style.display = "flex";

  window.addEventListener("click", function (event) {
    var verif = true;
    tableauMenu.forEach(function (element) {
      console.log(element);
      if (event.target == element) {
        verif = false;
      }
    });
    if (event.target != aLien && event.target != sousMenu && verif) {
      sousMenu.style.display = "none";
    }
  });

  closeButton.onclick = function (event) {
    event.preventDefault();
    sousMenu.style.display = "none";
  };
}
/* fonction sous menu PEM */
document.getElementById("lien-Pem").addEventListener("click", function (event) {
  event.preventDefault();
  var sousMenuPem = document.getElementById("sous-menu-pem");
  var sousMenu = document.getElementById("sous-menu");

  sousMenuPem.style.display = "flex";
  sousMenu.style.display = "none";
});
/* fonction sous menu Pose */
document.getElementById("lien-Pose").addEventListener("click", function (event) {
  event.preventDefault();
  var sousMenuPose = document.getElementById("sous-menu-pose");
  var sousMenu = document.getElementById("sous-menu");

  sousMenuPose.style.display = "flex";
  sousMenu.style.display = "none";
});
/* fonction pour le sous menu des caves à vin */
document.getElementById("lien-cave").addEventListener("click", function (event) {
  event.preventDefault();
  var sousMenuPose = document.getElementById("sous-menu-pose");
  var sousMenuCave = document.getElementById("sous-menu-cave");

  sousMenuPose.style.display = "none";
  sousMenuCave.style.display = "flex";
});
/* fonction pour tout les boutons retour */
var menu = document.querySelectorAll(".retour");
menu.forEach((element) => {
  element.addEventListener("click", function (event) {
    event.preventDefault();
    var sousMenuNiveau2 = document.querySelectorAll(".niveau2");
    var sousMenuNiveau3 = document.querySelectorAll(".niveau3");
    if (this.className == "retour menu") {
      var sousMenu = document.getElementById("sous-menu");
      sousMenuNiveau2.forEach((element) => {
        element.style.display = "none";
      });
      sousMenu.style.display = "flex";
    } else if (this.className == "retour menu pose") {
      var sousMenuPose = document.getElementById("sous-menu-pose");
      sousMenuNiveau3.forEach((element) => {
        element.style.display = "none";
      });
      sousMenuPose.style.display = "flex";
    }
  });
});
/* fonction pour la barre de recherche */
document.getElementById("barre-de-recherche").addEventListener("input", function (evt) {
  var recherche = this.value;
  var boite = document.getElementById("recherche");
  var child = boite.lastElementChild;
  while (child) {
    boite.removeChild(child);
    child = boite.lastElementChild;
  }
  var data = JSON.stringify({ recherche: recherche });
  if (recherche != "") {
    fetch("/recherche", { method: "post", headers: { "content-type": "application/json" }, body: data })
      .then((response) => response.json())
      .then((result) => {
        console.log(result);

        for (element in result["code"]) {
          var nouvelleBoite = document.createElement("div");
          var nouveaulien = document.createElement("a");
          nouveaulien.setAttribute("href", "/?code=" + result["code"][element].code_article);
          nouveaulien.innerHTML = result["code"][element].code_article;
          boite.append(nouvelleBoite);
          nouvelleBoite.append(nouveaulien);
        }
        for (element in result["marque"]) {
          var nouvelleBoite = document.createElement("div");
          var nouveaulien = document.createElement("a");
          nouveaulien.setAttribute("href", "/?marque=" + result["marque"][element].marque);
          nouveaulien.innerHTML = result["marque"][element].marque;
          boite.append(nouvelleBoite);
          nouvelleBoite.append(nouveaulien);
        }
        for (element in result["famille"]) {
          var nouvelleBoite = document.createElement("div");
          var nouveaulien = document.createElement("a");
          nouveaulien.setAttribute("href", "/?famille=" + result["famille"][element].famille);
          nouveaulien.innerHTML = result["famille"][element].famille;
          boite.append(nouvelleBoite);
          nouvelleBoite.append(nouveaulien);
        }
        for (element in result["sousFamille"]) {
          var nouvelleBoite = document.createElement("div");
          var nouveaulien = document.createElement("a");
          nouveaulien.setAttribute("href", "/?sous_famille=" + result["sousFamille"][element].sous_famille);
          nouveaulien.innerHTML = result["sousFamille"][element].sous_famille;
          boite.append(nouvelleBoite);
          nouvelleBoite.append(nouveaulien);
        }
        for (element in result["univers"]) {
          var nouvelleBoite = document.createElement("div");
          var nouveaulien = document.createElement("a");
          nouveaulien.setAttribute("href", "/?univers=" + result["univers"][element].univers);
          nouveaulien.innerHTML = result["univers"][element].univers;
          boite.append(nouvelleBoite);
          nouvelleBoite.append(nouveaulien);
        }
      });
  }
});
/* document.getElementById("barre-de-recherche").addEventListener("blur", function () {
  var champResultat = document.getElementById("recherche");
  champResultat.addEventListener('click', function () {
    
  })
  champResultat.style.display = "none";
}); */
document.getElementById("barre-de-recherche").addEventListener("focus", function () {
  var champResultat = document.getElementById("recherche");
  champResultat.style.display = "flex";
});
