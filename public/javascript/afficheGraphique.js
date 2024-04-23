//import {creationGraphique} from'./creationGraphique';
//import { getModuleData } from './recupApi';

async function getModuleData() {
    try {
        const response = await fetch('https://s3-4677.nuage-peda.fr/testWeBreathe/public/api/modules');

        console.log(res);

        if (!response.ok) {
            throw new Error('Erreur: ' + response.status + ' ' + response.statusText);
        }

        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Erreur lors de la récupération des données:', error);
        throw error;
    }
}

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
    });
}

async function afficheGraphique() {
    console.log("cc");
    const modulesData = await getModuleData;

    console.log("Données des modules :", modulesData);

    modulesData.forEach((moduleData) => {
        const ctx = document.getElementById(`chart-${moduleData.id}`).getContext('2d');
        creationGraphique(ctx, moduleData);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    afficheGraphique();
})
