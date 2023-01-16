// L'image img#image
var image = document.getElementById("image");

// La fonction previewPicture
var previewPicture = function (e) {

    // e.files contient un objet FileList
    const [picture] = e.files

    // "picture" est un objet File
    if (picture) {

        // L'objet FileReader
        var reader = new FileReader();

        // L'événement déclenché lorsque la lecture est complète
        reader.onload = function (e) {
            // On change l'URL de l'image (base64)
            image.src = e.target.result
        }

        // On lit le fichier "picture" uploadé
        reader.readAsDataURL(picture)

    }
}

function afficher(idSujet) {
    window.location.href = "./afficheSujet.php?idSujet=" + idSujet;
}

function deletePost(idPost, idSujet) {
    if (confirm("Voulez vous vraiment supprimer (action irréversible) ?") == true) {
        window.location.href = "./res/php/deletePost.php?idPost=" + idPost + "&idSujet=" + idSujet;
    }
}

function closeSubject(idSujet, idUtilisateur, from) {
    if (confirm("Voulez vous vraiment fermer le sujet (action irréversible) ?") == true) {
        window.location.href = "./res/php/closeSubject.php?idSujet=" + idSujet + "&idUtilisateur=" + idUtilisateur + "&from=" + from;
    }
}

function deleteSubject(idSujet, from) {
    if (confirm("Voulez vous vraiment supprimer le sujet (action irréversible) ?") == true) {
        window.location.href = "./res/php/deleteSubject.php?idSujet=" + idSujet + "&from=" + from;
    }
}

function repondre(idPost) {
    var profil = document.getElementById(idPost).getElementsByClassName('profil')[0];
    var contenu = document.getElementById(idPost).getElementsByClassName('contenu')[0];
    var contenuReponse = document.getElementById('contenuReponse');
    var divReponse = document.getElementById('divReponse');
    divReponse.style.display = 'flex';
    contenuReponse.style.borderLeft = '3px solid ' + profil.children[0].style["color"];
    contenuReponse.innerHTML = profil.innerHTML + contenu.innerHTML;
    var reponseToDelete = contenuReponse.getElementsByClassName('reponse')[0];
    if (reponseToDelete != null) {
        reponseToDelete.remove();
    }
    document.getElementById('idPost').setAttribute('value', idPost);
}

function nonRepondre() {
    var divReponse = document.getElementById('divReponse');
    divReponse.style.display = 'none';
    document.getElementById('idPost').setAttribute('value', null);
}

//Fonction permettant de désactiver le commpte d'un utilisateur
function desactiverCompte(idUtilisateur) {
    var date = prompt("Veuillez saisir une date jusqu'a laquelle le compte sera désactivé (format: AAAA-MM-JJ) ou saisissez 0 pour une durée indeterminée");
    if (date != null) {
        var regex = new RegExp("^[0-9]{4}-[0-9]{2}-[0-9]{2}$");
        if (regex.test(date)) {
            window.location.href = "./res/php/desactiverCompte.php?idUtilisateur=" + idUtilisateur + "&dateFin=" + date;
        } else if (date == 0) {
            window.location.href = "./res/php/desactiverCompte.php?idUtilisateur=" + idUtilisateur;
        } else {
            alert("La date n'est pas au bon format");
        }
    }
}

//Fonction permettant de réactiver le compte d'un utilisateur
function reactiverCompte(idUtilisateur) {
    if (confirm("Voulez vous vraiment réactiver ce compte ?") == true) {
        window.location.href = "./res/php/reactiverCompte.php?idUtilisateur=" + idUtilisateur;
    }
}
