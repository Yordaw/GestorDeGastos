window.onload = inici;

function inici(){
const nomUsu = document.getElementById();
    obtindreDades(nomUsu);

    taula();
}

function taula(){
    var dadesEcoUsuari = {
        "id": Array(),
        "descripcion":  Array(),
        "cantidad": Array(),
        "categoria": Array()
    };

}

function mostrarTaula(dadesEcoUsuari) {
    const taula = document.getElementById('taulaMoviments');

    dadesEcoUsuari.forEach(element => {
        element.forEach(date => {
            let row = document.createElement('td');
            row.innerHTML = date;
            row.appendChild(row);
        })
    });

}

function obtindreDades(nomUsu){
    fetch(`connect.php?nomUsu=${nomUsu}`)
    .then(response=>response.json())
    .then(data => {
        console.log('Taula de '+nomUsu+' carregada.');
        mostrarTaula(data);
    })
    .catch(error=>{
        console.log('Error al carregar la taula ')
    });
}

