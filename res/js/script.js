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


function afficher(x) {
    window.location.href = "./afficheSujet.php?idSujet=" + x;
}

function deletePost(x, idSujet) {
    if (confirm("Voulez vous vraiment supprimer ?") == true) {
        window.location.href = "./res/php/deletePost.php?idPost=" + x+"&idSujet="+idSujet;
    }
}