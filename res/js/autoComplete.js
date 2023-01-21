var xhr = new XMLHttpRequest();
//? from = 1 -> forum
//? from = 2 -> admin Utilisateur
//? from = 3 -> admin forum

function getSuggestions(from) {
    if(from == 1) {
        xhr.open('GET', "./res/php/suggestions.php?table="+from, true);
        xhr.addEventListener('readystatechange', forum);
    }
    else if(from == 2) {
        xhr.open('GET', "./res/php/suggestions.php?table="+from, true);
        xhr.addEventListener('readystatechange', adminUtilisateur);
    }
    else if(from == 3) {
        xhr.open('GET', "./res/php/suggestions.php?table=1", true);
        xhr.addEventListener('readystatechange', adminForum);
    }
    xhr.send(null);
}

function adminForum() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        var table = document.getElementById("Sujets");
        var input = document.getElementById("searchForum");
        var tab = xhr.responseText.split("|");
        var entete = "<th>idSujet</th><th>Titre</th><th>Date de création</th><th>Statut</th><th>Nombre de post</th><th></th><th>Fermer</th><th>Supprimer</th>"
        table.innerHTML = entete;
        for (var i = 0; i < tab.length; i++) {
            var closed = false;
            var row = tab[i].split(";");
            if (!row[1].toLowerCase().includes(input.value.toLowerCase())) {
                continue;
            }
            var tr = document.createElement("tr");
            for (var j = 0; j < row.length-1; j++) {
                var td = document.createElement("td");
                if (row[j] == "null") { 
                    row[j] = ""; 
                }
                if (row[j] == "Résolu") {
                    closed = true;
                }

                td.innerHTML = row[j];
                tr.appendChild(td);
            }
            var td = document.createElement("td");
            if (!closed) {
                var button = document.createElement("button");
                button.setAttribute("type", "button");
                button.setAttribute("class", "btn btn-danger");
                button.setAttribute("onclick", "closeSubject(" + row[0] + ", 0)");
                button.innerHTML = "Fermer";
                td.appendChild(button);
            }
            tr.appendChild(td);

            var td = document.createElement("td");
            var button = document.createElement("button");
            button.setAttribute("type", "button");
            button.setAttribute("class", "supp");
            button.setAttribute("onclick", "deleteSubject(" + row[0] + ", 0)");
            button.innerHTML = "Supprimer";
            td.appendChild(button);
            tr.appendChild(td);
            table.appendChild(tr);
        }
    }
}

function adminUtilisateur() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        var table = document.getElementById("Utilisateurs");
        var input = document.getElementById("searchUtilisateur");
        var tab = xhr.responseText.split("|");
        var entete = "<tr><th>idUtilisateur</th><th>Nom</th><th>Prenom</th><th>Email</th><th>Username</th><th>Tel</th><th>Adresse</th><th>Code postal</th><th>Date de naissance</th><th></th><th>Date début Banissement</th><th>Date Fin Banissement</th><th>Désactiver</th></tr>"
        table.innerHTML = entete;
        for (var i = 0; i < tab.length; i++) {
            var row = tab[i].split(";");
            if (!row[1].toLowerCase().includes(input.value.toLowerCase()) || row[12] == 1) {
                continue;
            }
            var tr = document.createElement("tr");
            for (var j = 0; j < row.length-1; j++) {
                var td = document.createElement("td");
                if (row[j] == "null") { 
                    row[j] = ""; 
                }
                td.innerHTML = row[j];
                tr.appendChild(td);

            }
            var td = document.createElement("td");
            var button = document.createElement("button");
            button.setAttribute("type", "button");
            button.setAttribute("class", "supp");
            button.setAttribute("onclick", "window.location.href='./res/php/desactiver.php?idUtilisateur=" + row[0] + "'");
            button.innerHTML = "Désactiver";
            td.appendChild(button);
            tr.appendChild(td);
            table.appendChild(tr);
        }
    }
}

function forum() {
    var contenu = document.getElementById("contenu");
    contenu.innerHTML = "";
    //? Si le fichier est chargé sans erreur
    if (xhr.readyState === 4 && xhr.status === 200) {
        var tab = xhr.responseText.split("|");
        for (var i = 0; i < tab.length; i++) {
            var input = document.getElementById("search");
            var row = tab[i].split(";");
            if (!row[1].toLowerCase().includes(input.value.toLowerCase())) {
                continue;
            }
            var div = document.createElement("div");
            var h2 = document.createElement("h2");
            if (row[3] == "Résolu") {
                h2.innerHTML = row[1]+" ["+row[3]+"]";
            }
            else {
                h2.innerHTML = row[1];
            }
            var p = document.createElement("p");
            p.innerHTML = "Créer par " + row[6] + " le " + row[2] + " - " + row[4] + " posts";
            div.setAttribute("class", "topic");
            div.setAttribute("onclick", "window.location.href='./afficheSujet.php?idSujet=" + row[0] + "'");
            div.appendChild(h2);
            div.appendChild(p);
            contenu.appendChild(div);
        }
    }
}