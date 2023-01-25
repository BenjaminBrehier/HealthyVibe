var xhr = new XMLHttpRequest();

function reload(from) {
    var dateDebut = document.getElementById("dateDebut").value;
    var dateFin = document.getElementById("dateFin").value;

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

function getGraphSante() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        var tempChart = Highcharts.chart('graphique1', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Température corporelle'
            },
            xAxis: {
                categories: ['temps (en heure)']
            },
            yAxis: {
                title: {
                    text: 'température (en °C)'
                }
            },
            series: [{
                name: 'température corporelle',
                type: 'column',
                data: []
            },
            {
                name: 'moy',
                type: 'line',
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
                categories: ['temps (en heure)']
            },
            yAxis: {
                title: {
                    text: 'décibel (en dB)'
                }
            },
            series: [{
                name: 'décibel',
                data: []
            },
            {
                name: 'moy',
                data: []
            }]
        });
        var poulChart = Highcharts.chart('graphique3', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Poul'
            },
            xAxis: {
                categories: ['temps (en heure)']
            },
            yAxis: {
                title: {
                    text: 'poul (en bpm)'
                }
            },
            series: [{
                name: 'poul',
                data: []
            },
            {
                name: 'moy',
                data: []
            }]
        });
        var tab = xhr.responseText.split("|");
        //Format des données : 79&17-01-2023 15:02:00;78&17-01-2023 15:01:00;80&17-01-2023 15:00:00|36.6&17-01-2023 15:02:00;35.8&17-01-2023 15:01:00;36.5&17-01-2023 15:00:00|75&17-01-2023 15:02:00;70&17-01-2023 15:01:00;80&17-01-2023 15:00:00
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

                moy = [tabDecibelData.reduce((a, b) => a + b, 0) / tabDecibelData.length];
                const tabMoys = Array(tabDecibelData.length).fill(Math.round(moy));
                decibelChart.series[1].setData(tabMoys);
            }
        }
    
    }
}

function getGraphEnv() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.responseText);
        var tempExtChart = Highcharts.chart('graphique1', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Température extérieure'
            },
            xAxis: {
                categories: ['temps (en heure)']
            },
            yAxis: {
                title: {
                    text: 'température (en °C)'
                }
            },
            series: [{
                name: 'température extérieure',
                type: 'column',
                data: []
            },
            {
                name: 'moy',
                type: 'line',
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
                categories: ['temps (en heure)']
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
                name: 'moy',
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

                moy = [tabPoulData.reduce((a, b) => a + b, 0) / tabPoulData.length];
                const tabMoys = Array(tabPoulData.length).fill(Math.round(moy));
                gazChart.series[1].setData(tabMoys);
                console.log(gazChart);
            }
        }
    }
}