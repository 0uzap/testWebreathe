function creationGraphique(ctx, moduleData) {
    console.log("Données du module :", moduleData);
    
    const dates = moduleData.mesures.map(mesure => new Date(mesure.date));
    const valeurs = moduleData.mesures.map(mesure => mesure.valeur);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label:'Valeurs',
                data: valeurs,
                borderColor: 'blue',
                fill: false
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: 'time',
                    time: {
                        unit: 'day'
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Date'
                    }
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Valeur'
                    }
                }]
            }
        }
    })
}