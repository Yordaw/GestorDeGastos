<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$imprimirMsg = function($nom, $cognoms, $ip_address) {
	$dataihora = date('d/m/Y H:i:s a', time());;
	$ip_msg = "(IP: " . $ip_address . " Connexió: " . $dataihora . ")";
    echo "<p style='color:green;'>Benvingut/da, $nom $cognoms! " . $ip_msg . "</p>";
};

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $cognoms = $_POST['cognoms'];
    $correu = $_POST['correu'];
    $contrasenya = $_POST['contrasenya'];
    $confirmacio_contrasenya = $_POST['confirmacio_contrasenya'];

    $errors = [];

    // Validació dels camps
    if (empty($nom)) {
        $errors[] = "El camp Nom és obligatori.";
    }
    if (empty($cognoms)) {
        $errors[] = "El camp Cognoms és obligatori.";
    }
    if (empty($correu) || !filter_var($correu, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "El camp Correu electrònic és obligatori i ha de tenir un format vàlid.";
    }
    if (empty($contrasenya)) {
        $errors[] = "El camp Contrasenya és obligatori.";
    }
    if ($contrasenya !== $confirmacio_contrasenya) {
        $errors[] = "Les contrasenyes no coincideixen.";
    }

    // Mostra els errors o el missatge de benvinguda
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
		//Connectar a la BD
		$connexioBD= mysqli_connect("localhost", "spendsmart","spendsmart","contactes");
        if(!$connexioBD){
            die("Connexio fallida: ".mysqli_error($connexioBD));
        }else{
            $sql="INSERT INTO usuaris(nom,cognoms,correu,contrasenya) VALUES('".$nom."','".$cognoms."','".$correu."','".$contrasenya."')";
            if($result=mysqli_query($connexioBD,$sql)){
                echo "Registro insertado correctamente, por favor vuelve atrás y mira la lista de usuarios.";
            }else{
                echo "Registre no insertado correctamente, algo ha fallado... ". mysqli_error($connexioBD);
            }
        }
		
    }
}

?>