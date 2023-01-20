var xhr = new XMLHttpRequest();
function getSuggestions(from) {
    if(from == 0) {
        xhr.open('GET', "./res/php/suggestions.php?table="+from, true);
        xhr.addEventListener('readystatechange', admin);
    }
    else if(from == 1) {
        xhr.open('GET', "./res/php/suggestions.php?table="+from, true);
        xhr.addEventListener('readystatechange', forum);
    }
    xhr.send(null);
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
            if (!row[2].toLowerCase().includes(input.value.toLowerCase())) {
                continue;
            }
            var div = document.createElement("div");
            var h2 = document.createElement("h2");
            h2.innerHTML = row[2];
            var p = document.createElement("p");
            if (row.length == 5) {
                p.innerHTML = "Par " + row[1] + " le " + row[3] + " - " + row[4] + " posts";
            } else {
                p.innerHTML = "Par " + row[1] + " le " + row[3] + " - 0 posts";
            }
            div.setAttribute("class", "topic");
            div.setAttribute("onclick", "window.location.href='./afficheSujet.php?idSujet=" + row[0] + "'");
            div.appendChild(h2);
            div.appendChild(p);
            contenu.appendChild(div);
        }
    }
}