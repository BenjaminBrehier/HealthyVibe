window.addEventListener('DOMContentLoaded', (event) => {
    //!Ajoute un event listener sur tous les éléments .post pour afficher la bordure de la couleur du profil on hover
    for (var i = 0; i < document.getElementsByClassName('post').length; i++) {
        document.getElementsByClassName('post')[i].addEventListener('mouseover', function () {
            var profil = this.getElementsByClassName('profil')[0];
            this.style.borderTop = '1px dashed ' + profil.children[0].style["color"];
            this.style.borderRight = '1px dashed ' + profil.children[0].style["color"];
            this.style.borderBottom = '1px dashed ' + profil.children[0].style["color"];
        }
        );
        document.getElementsByClassName('post')[i].addEventListener('mouseout', function () {
            this.style.borderTop = '1px solid #FFF';
            this.style.borderRight = '1px solid #FFF';
            this.style.borderBottom = '1px solid #FFF';
        }
        );
    }

    //!Pour chaque élément .reponse on ajoute un event listener permettant de clicker dessus et d'être redirigé vers le post parent
    for (var i = 0; i < document.getElementsByClassName('reponse').length; i++) {
        document.getElementsByClassName('reponse')[i].addEventListener('click', function () {
            //!Get l'url de la page puis redirect vers le post parent
            var tab = window.location.href.split("#");
            var url = tab[0] + "#" + this.getAttribute('name');
            window.location.href = url;
            window.scrollTo(window.scrollX, window.scrollY - 250);
            //!Changer brievement la couleur de fond du post parent avec la couleur de bordure du parent
            var post = document.getElementById(this.getAttribute('name'));
            var profil = post.getElementsByClassName('profil')[0];
            post.style.backgroundColor = profil.children[0].style["color"];
            setTimeout(function () {
                post.style.backgroundColor = "#FFF";
                post.style.transition = "background-color 1.5s";
            }, 500);
        }
        );
    }
});

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

function deletePost(idPost, idSujet, idUtilisateur) {
    if (confirm("Voulez vous vraiment supprimer (action irréversible) ?") == true) {
        window.location.href = "./res/php/deletePost.php?idPost=" + idPost + "&idSujet=" + idSujet + "&idUtilisateur=" + idUtilisateur;
    }
}

function closeSubject(idSujet, from) {
    if (confirm("Voulez vous vraiment fermer le sujet (action irréversible) ?") == true) {
        window.location.href = "./res/php/closeSubject.php?idSujet=" + idSujet + "&from=" + from;
    }
}

function deleteSubject(idSujet, from) {
    if (confirm("Voulez vous vraiment supprimer le sujet (action irréversible) ?") == true) {
        window.location.href = "./res/php/deleteSubject.php?idSujet=" + idSujet + "&from=" + from;
    }
}

//!Fonction permettant de répondre à un post et de modifier le contenu de la div#divReponse pour afficher le post parent
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
    var tab = window.location.href.split("#");
    var url = tab[0] + "#form";
    window.location.href = url;
}

function nonRepondre() {
    var divReponse = document.getElementById('divReponse');
    divReponse.style.display = 'none';
    document.getElementById('idPost').setAttribute('value', null);
}

//!Fonction permettant de désactiver le commpte d'un utilisateur
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

//!Fonction permettant de réactiver le compte d'un utilisateur
function reactiverCompte(idUtilisateur) {
    if (confirm("Voulez vous vraiment réactiver ce compte ?") == true) {
        window.location.href = "./res/php/reactiverCompte.php?idUtilisateur=" + idUtilisateur;
    }
}

//!Fonction permettant de rendre inactif un casque
function rendreInactif(idCasque) {
    if (confirm("Voulez vous vraiment rendre inactif ce casque ?") == true) {
        window.location.href = "./res/php/rendreInactif.php?idCasque=" + idCasque;
    }
}
