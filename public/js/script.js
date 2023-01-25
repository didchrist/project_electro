/* fonction pour le menu déroulant */
function menuProduits(e, aLien) {
    e.preventDefault();
    var sousMenu = document.getElementById('menuderoulant');
    var closeButton = document.getElementById('close');
    var tableauMenu = document.querySelectorAll('.menu');
    console.log(tableauMenu);
    sousMenu.style.display = 'flex';
    
    window.addEventListener('click', function(event) {
        var verif = true;
        tableauMenu.forEach(function(element){
            console.log(element);
            if (event.target == element) {
                verif = false;
            }
        })
        if (event.target != aLien && event.target != sousMenu && verif) {
            sousMenu.style.display = 'none';
        }
    })
    
    closeButton.onclick = function(event) {
        event.preventDefault();
        sousMenu.style.display = 'none';
    }
}
/* fonction sous menu PEM */
document.getElementById('lien-Pem').addEventListener('click', function(event){
    event.preventDefault();
    var sousMenuPem = document.getElementById('sous-menu-pem');
    var sousMenu = document.getElementById('sous-menu');
    
    sousMenuPem.style.display = 'flex';
    sousMenu.style.display = 'none';

})
/* fonction sous menu Pose */
document.getElementById('lien-Pose').addEventListener('click',function(event){
    event.preventDefault();
    var sousMenuPose = document.getElementById('sous-menu-pose');
    var sousMenu = document.getElementById('sous-menu');

    sousMenuPose.style.display = 'flex';
    sousMenu.style.display = 'none';
})
/* fonction pour le sous menu des caves à vin */
document.getElementById('lien-cave').addEventListener('click', function(event) {
    event.preventDefault();
    var sousMenuPose = document.getElementById('sous-menu-pose');
    var sousMenuCave = document.getElementById('sous-menu-cave');

    sousMenuPose.style.display = 'none';
    sousMenuCave.style.display = 'flex';
})
/* fonction pour tout les boutons retour */
var menu = document.querySelectorAll('.retour');
menu.forEach(element => {
    element.addEventListener('click',function(event) {
        event.preventDefault();
        var sousMenuNiveau2 = document.querySelectorAll('.niveau2');
        var sousMenuNiveau3 = document.querySelectorAll('.niveau3');
        if (this.className == 'retour menu'){
            var sousMenu = document.getElementById('sous-menu');
            sousMenuNiveau2.forEach(element => {
                element.style.display = 'none';    
            });
            sousMenu.style.display = 'flex';
        } else if (this.className == 'retour menu pose') {
            var sousMenuPose = document.getElementById('sous-menu-pose');
            sousMenuNiveau3.forEach(element => {
                element.style.display = 'none';
            })
            sousMenuPose.style.display = 'flex';
        }
    })
});
/* fonction pour la barre de recherche */
document.getElementById('barre-de-recherche').addEventListener('input', function(evt) {
    var recherche = this.value;
    var data = JSON.stringify({'recherche': recherche});
    fetch('/recherche', { method: 'post', headers: {"content-type": "application/json"}, body: data})
    .then(response => response.json())
    .then(result=> console.log(result))
});