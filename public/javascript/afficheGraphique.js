import {getModuleData} from './recupApi';
import {creationGraphique} from './creationGraphique';

async function afficheGraphique() {
    const modulesData = await getModuleData();

    console.log("Données des modules :", modulesData);

    modulesData.forEach(moduleData => {
        const ctx = document.getElementById(`chart-${moduleData.id}`).getContext('2d');
        creationGraphique(ctx, moduleData);
    });
}


document.addEventListener('DOMContentLoaded', function() {
    afficheGraphique();
})