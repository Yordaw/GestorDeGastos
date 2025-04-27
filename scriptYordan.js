window.onload = inici;

function inici() {
    fetchDadesUsu();
    taula();
}

function taula() {
    var dadesEcoUsuari = {
        "id": [],
        "descripcion": [],
        "cantidad": [],
        "categoria": [],
    };

    mostrarTaula(dadesEcoUsuari);
}

function mostrarTaula(dadesEcoUsuari) {
    const taula = document.getElementById('taulaMoviments');
    
    // Aquí puedes generar filas si tienes datos reales
    // dadesEcoUsuari.forEach(element => { ... });
}

async function fetchDadesUsu() {
    const id = 1; // Supongamos que este ID proviene del login
    const resposta = await fetch(`getUserData.php?user_id=${id}`);
    const dades = await resposta.json();

    if (dades.error) {
        document.body.innerHTML = `<p>${dades.error}</p>`;
        return;
    }

    // Mostrar nombre y resumen
    document.getElementById('userName').textContent = `Bienvenido, ${dades.user}`;
    document.getElementById('userSummary').textContent = dades.summary;

    // Calcular presupuesto restante y actualizar barra
    const presupuestoTotal = dades.presupuestoTotal; // ej. 1000
    const gastosTotales = dades.gastosTotales; // ej. 350

    const porcentajeRestante = Math.max(0, ((presupuestoTotal - gastosTotales) / presupuestoTotal) * 100);
    
    const barra = document.getElementById('barraEconomia');
    barra.style.width = `${porcentajeRestante}%`;

    // Cambiar color según el nivel
    if (porcentajeRestante > 60) {
        barra.style.backgroundColor = '#4caf50'; // verde
    } else if (porcentajeRestante > 30) {
        barra.style.backgroundColor = '#ff9800'; // naranja
    } else {
        barra.style.backgroundColor = '#f44336'; // rojo
    }
}
