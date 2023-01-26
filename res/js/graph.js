var xhr = new XMLHttpRequest();

//! Permet de charger ou recharger les réquetes des donnees en fonction de la page
function reload(from) {
    var dateDebut = document.getElementById("dateDebut").value;
    var dateFin = document.getElementById("dateFin").value;

    if (dateDebut != "") {
        document.getElementById("dateFin").setAttribute("min", dateDebut);
    } else {
        document.getElementById("dateFin").setAttribute("min", "2019-01-01");
    }

    if (dateFin != "") {
        document.getElementById("dateDebut").setAttribute("max", dateFin);
    } else {
        document.getElementById("dateDebut").setAttribute("max", "3000-12-31");
    }

    if (dateDebut == "" || dateFin == "") {
        var dateDebut = "2019-01-01 00:00:00";
        var dateFin = "3000-12-31 23:59:59";
    }

    xhr.open('GET', "./res/php/graph.php?dateDebut=" + dateDebut + " 00:00:00&dateFin=" + dateFin + " 23:59:59&from=" + from, true);
    if (from == "espaceSantee") {
        xhr.addEventListener('readystatechange', getGraphSante);
    }
    else {
        xhr.addEventListener('readystatechange', getGraphEnv);
    }
    xhr.send(null);
}

//! Permet de créer les graphique de l'espace santé avec les données reçues
function getGraphSante() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        //! Création des graphiques
        var tempChart = Highcharts.chart('graphique1', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Température corporelle'
            },
            xAxis: {
                categories: ['temps (en heure)'],
                title: {
                    text: 'Dates'
                },
            },
            yAxis: {
                title: {
                    text: 'Température (en °C)'
                }
            },
            series: [{
                name: 'Température corporelle',
                type: 'column',
                data: []
            },
            {
                name: 'moyenne',
                type: 'line',
                visible: false,
                data: []
            }]
        });
        var decibelChart = Highcharts.chart('graphique2', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Décibel'
            },
            xAxis: {
                categories: ['temps (en heure)'],
                title: {
                    text: 'Dates'
                }
            },
            yAxis: {
                title: {
                    text: 'Décibel (en dB)'
                }
            },
            series: [{
                name: 'Décibel',
                data: []
            },
            {
                name: 'moyenne',
                visible: false,
                data: []
            }]
        });
        var poulChart = Highcharts.chart('graphique3', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Pouls'
            },
            xAxis: {
                categories: ['temps (en heure)'],
                title: {
                    text: 'Dates'
                }
            },
            yAxis: {
                title: {
                    text: 'Pouls (en bpm)'
                }
            },
            series: [{
                name: 'Pouls',
                data: []
            },
            {
                name: 'moyenne',
                visible: false,
                data: []
            }]
        });
        var tab = xhr.responseText.split("|");
        //? Exemple de données : 79&17-01-2023 15:02:00;78&17-01-2023 15:01:00;80&17-01-2023 15:00:00|36.6&17-01-2023 15:02:00;35.8&17-01-2023 15:01:00;36.5&17-01-2023 15:00:00|75&17-01-2023 15:02:00;70&17-01-2023 15:01:00;80&17-01-2023 15:00:00
        //? Format : pouls|températureCorp|décibelInterne|températureExt|gaz|decibelExt
        if (tab.length > 0) {
            if (tab[0] != "0") {
                var tabPoul = tab[0].split(";");
                var tabDate = [];
                var tabPoulData = [];
                for (var i = 0; i < tabPoul.length; i++) {
                    var poul = tabPoul[i].split("&");
                    tabDate.push(poul[1]);
                    tabPoulData.push(parseFloat(poul[0]));
                }
                poulChart.xAxis[0].setCategories(tabDate);
                poulChart.series[0].setData(tabPoulData);

                //! Calcul de la moyenne et ajout de la ligne
                moy = [tabPoulData.reduce((a, b) => a + b, 0) / tabPoulData.length];
                const tabMoys = Array(tabPoulData.length).fill(Math.round(moy));
                poulChart.series[1].setData(tabMoys);
            }

            if (tab[1] != "0") {
                var tabTemp = tab[1].split(";");
                var tabDate = [];
                var tabTempData = [];
                for (var i = 0; i < tabTemp.length; i++) {
                    var temp = tabTemp[i].split("&");
                    tabDate.push(temp[1]);
                    tabTempData.push(parseFloat(temp[0]));
                }
                tempChart.xAxis[0].setCategories(tabDate);
                tempChart.series[0].setData(tabTempData);

                //! Calcul de la moyenne et ajout de la ligne
                moy = [tabTempData.reduce((a, b) => a + b, 0) / tabTempData.length];
                const tabMoys = Array(tabTempData.length).fill(Math.round(moy));
                tempChart.series[1].setData(tabMoys);
            }

            if (tab[2] != "0") {
                var tabDecibel = tab[2].split(";");
                var tabDate = [];
                var tabDecibelData = [];
                for (var i = 0; i < tabDecibel.length; i++) {
                    var decibel = tabDecibel[i].split("&");
                    tabDate.push(decibel[1]);
                    tabDecibelData.push(parseFloat(decibel[0]));
                }
                decibelChart.xAxis[0].setCategories(tabDate);
                decibelChart.series[0].setData(tabDecibelData);

                //! Calcul de la moyenne et ajout de la ligne
                moy = [tabDecibelData.reduce((a, b) => a + b, 0) / tabDecibelData.length];
                const tabMoys = Array(tabDecibelData.length).fill(Math.round(moy));
                decibelChart.series[1].setData(tabMoys);
            }
        }

    }
}

//! Permet de créer les graphique de l'espace environnement avec les données reçues
function getGraphEnv() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        var tempExtChart = Highcharts.chart('graphique1', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Température extérieure'
            },
            xAxis: {
                categories: ['temps (en heure)'],
                title: {
                    text: 'Dates'
                }
            },
            yAxis: {
                title: {
                    text: 'Température (en °C)'
                }
            },
            series: [{
                name: 'Température extérieure',
                type: 'column',
                data: []
            },
            {
                name: 'moyenne',
                type: 'line',
                visible: false,
                data: []
            }]
        });
        var gazChart = Highcharts.chart('graphique2', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'CO2'
            },
            xAxis: {
                categories: ['temps (en heure)'],
                title: {
                    text: 'Dates'
                }
            },
            yAxis: {
                title: {
                    text: 'CO2 (en ppm)'
                }
            },
            series: [{
                name: 'CO2',
                data: []
            },
            {
                name: 'moyenne',
                visible: false,
                data: []
            }]
        });
        var decibelExtChart = Highcharts.chart('graphique3', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Décibel extérieur'
            },
            xAxis: {
                categories: ['temps (en heure)'],
                title: {
                    text: 'Dates'
                }
            },
            yAxis: {
                title: {
                    text: 'Décibel extérieur (en dB)'
                }
            },
            series: [{
                name: 'Décibel extérieur',
                data: []
            },
            {
                name: 'moyenne',
                visible: false,
                data: []
            }]
        });
        var tab = xhr.responseText.split("|");
        console.log(tab);
        //Format des données : 79&17-01-2023 15:02:00;78&17-01-2023 15:01:00;80&17-01-2023 15:00:00|36.6&17-01-2023 15:02:00;35.8&17-01-2023 15:01:00;36.5&17-01-2023 15:00:00|75&17-01-2023 15:02:00;70&17-01-2023 15:01:00;80&17-01-2023 15:00:00
        if (tab.length > 0) {
            if (tab[3] != "0") {
                var tabTemp = tab[3].split(";");
                var tabDate = [];
                var tabTempData = [];
                for (var i = 0; i < tabTemp.length; i++) {
                    var temp = tabTemp[i].split("&");
                    tabDate.push(temp[1]);
                    tabTempData.push(parseFloat(temp[0]));
                }
                tempExtChart.xAxis[0].setCategories(tabDate);
                tempExtChart.series[0].setData(tabTempData);

                //! Calcul de la moyenne et ajout de la ligne
                moy = [tabTempData.reduce((a, b) => a + b, 0) / tabTempData.length];
                const tabMoys = Array(tabTempData.length).fill(Math.round(moy));
                tempExtChart.series[1].setData(tabMoys);
            }

            if (tab[4] != "0") {
                var tabPoul = tab[4].split(";");
                var tabDate = [];
                var tabPoulData = [];
                for (var i = 0; i < tabPoul.length; i++) {
                    var poul = tabPoul[i].split("&");
                    tabDate.push(poul[1]);
                    tabPoulData.push(parseFloat(poul[0]));
                }
                gazChart.xAxis[0].setCategories(tabDate);
                gazChart.series[0].setData(tabPoulData);

                //! Calcul de la moyenne et ajout de la ligne
                moy = [tabPoulData.reduce((a, b) => a + b, 0) / tabPoulData.length];
                const tabMoys = Array(tabPoulData.length).fill(Math.round(moy));
                gazChart.series[1].setData(tabMoys);
            }

            if (tab[5] != "0") {
                var tabdecibel = tab[5].split(";");
                var tabDate = [];
                var tabdecibelData = [];
                for (var i = 0; i < tabdecibel.length; i++) {
                    var decibel = tabdecibel[i].split("&");
                    tabDate.push(poul[1]);
                    tabdecibelData.push(parseFloat(decibel[0]));
                }
                decibelExtChart.xAxis[0].setCategories(tabDate);
                decibelExtChart.series[0].setData(tabdecibelData);

                //! Calcul de la moyenne et ajout de la ligne
                moy = [tabdecibelData.reduce((a, b) => a + b, 0) / tabdecibelData.length];
                const tabMoys = Array(tabdecibelData.length).fill(Math.round(moy));
                decibelExtChart.series[1].setData(tabMoys);
            }
        }
    }
}