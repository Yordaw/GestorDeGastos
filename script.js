window.onload = inici;

function inici(){
    fetchDadesUsu(idUsuari);

    taula();
}

function taula(){
    var dadesEcoUsuari = {
        "id": Array(),
        "descripcion":  Array(),
        "cantidad": Array(),
        "categoria": Array(),
    };


    mostrarTaula(dadesEcoUsuari);
     
}


function mostrarTaula(dadesEcoUsuari) {
    const taula = document.getElementById('taulaMoviments');

    dadesEcoUsuari.forEach(element => {
        
    });

}

async function fetchDadesUsu() {
    const id = 1; // Supongamos que este ID proviene del login
    const resposta = await fetch(`getUserData.php?user_id=${id}`);
    const dades = await response.json();

    if (data.error) {
        document.body.innerHTML = `<p>${dades.error}</p>`;
        return;
    }

    // Mostrar nombre y resumen
    document.getElementById('userName').textContent = `Bienvenido, ${data.user}`;
    document.getElementById('userSummary').textContent = data.summary;

    // Crear tabla



}

