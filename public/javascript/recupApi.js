/*export async function getModuleData() {
    try {
        const response = await fetch('https://s3-4677.nuage-peda.fr/testWeBreathe/public/api/modules');

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
*/
// export {getModuleData};