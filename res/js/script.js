// L'image img#image
var image = document.getElementById("image");

// La fonction previewPicture
var previewPicture = function (e) {
    // e.files contient un objet FileList
    const [picture] = e.files

    // "picture" est un objet File
    if (picture) {
        // On change l'URL de l'image
        image.src = URL.createObjectURL(picture)
    }
}


function afficher(idSujet) {
    window.location.href = "./afficheSujet.php?idSujet=" + idSujet;
}

function deletePost(idPost, idSujet) {
    if (confirm("Voulez vous vraiment supprimer (action irréversible) ?") == true) {
        window.location.href = "./res/php/deletePost.php?idPost=" + idPost+"&idSujet="+idSujet;
    }
}

function closeSubject(idSujet, idUtilisateur) {
    if (confirm("Voulez vous vraiment fermer le sujet (action irréversible) ?") == true) {
        window.location.href = "./res/php/closeSubject.php?idSujet=" +idSujet+"&idUtilisateur="+idUtilisateur;
    }
}