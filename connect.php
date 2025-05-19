<?php
$servername = "sql208.infinityfr";
$username = "if0_38591381";
$password = "OQWrXAhqwiE";
$dbname = "if0_38591381_gestorgastos ";



// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} 

//Verificar que se ha recibido el nombre de la tabla
if(isset($_GET['nomUsu'])&&!empty($_GET['nomUsu'])){
    $n=$_GET['nomUsu'];
    //Açò fa que es substituisquen els caràcters no vàlids en SQL 
    $nSegur = $conn->real_escape_string($nombreTabla);
    $consulta = "SELECT * FROM ".$nSegur;
    $resultat = $conn-> query($sql);

    //la resposta la passem a un array php per a poder-lo passar, alhora a un json
    $data = array();
    if($result ->num_row > 0) {
        while($row = $result -> fetch_assoc()){
            $data[] = $row;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($data);

}else {
    // Si no se proporciona el parámetro 'tabla', puedes enviar un error
    http_response_code(400); // Bad Request
    echo json_encode(array("error" => "Por favor, especifica el nombre de la tabla."));
}

$conn->close();
?>