async function getModuleData() {
    try {
        const response = await fetch('https://s3-4677.nuage-peda.fr/testWeBreathe/public/api');

        if (!response.ok) {
            throw new Error('Erreur: ' + response.status + ' ' + response.statusText);
        }

        const data = await response.json();
        return data;
    } catch (e) {
        console.error('Erreur lors de la récupération des données:', error);
    }
}