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

function closeSubject(idSujet, idUtilisateur) {
    if (confirm("Voulez vous vraiment fermer le sujet (action irréversible) ?") == true) {
        window.location.href = "./res/php/closeSubject.php?idSujet=" + idSujet + "&idUtilisateur=" + idUtilisateur;
    }
}

function deleteSubject(idSujet) {
    if (confirm("Voulez vous vraiment supprimer le sujet (action irréversible) ?") == true) {
        window.location.href = "./res/php/deleteSubject.php?idSujet=" + idSujet;
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
    contenuReponse.getElementsByClassName('reponse')[0].remove();
    document.getElementById('idPost').setAttribute('value', idPost);
}

function nonRepondre() {
    var divReponse = document.getElementById('divReponse');
    divReponse.style.display = 'none';
    document.getElementById('idPost').setAttribute('value', null);
}