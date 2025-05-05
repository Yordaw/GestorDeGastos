<?php
    $errors = [];
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = trim($_POST["nom"] ?? '');
        $cognoms = trim($_POST["cognoms"] ?? '');
        $correu = trim($_POST["correu"] ?? '');
        $contrasenya = $_POST["contrasenya"] ?? '';
        $confirmacio_contrasenya = $_POST["confirmacio_contrasenya"] ?? '';

        if (empty($nom)) $errors[] = "El campo 'Nom' es obligatori.";
        if (empty($cognoms)) $errors[] = "El campo 'Cognoms' es obligatori.";
        if (empty($correu)) $errors[] = "El campo 'Correu electrònic' es obligatori.";
        if (empty($contrasenya)) $errors[] = "El campo 'Contrasenya' es obligatori.";

        if ($contrasenya !== $confirmacio_contrasenya) {
            $errors[] = "Las contraseñas no coinciden.";
        }

        if (empty($errors)) {
            $connectionInfo = array(
                "UID" => "spendsmart",
                "PWD" => "gestorgastos123@",
                "Database" => "spendsmart",
                "LoginTimeout" => 30,
                "Encrypt" => 1,
                "TrustServerCertificate" => 0
            );
            $serverName = "tcp:gestordegastos.database.windows.net,1433";
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            if (!$conn) {
                die("Connection failed: " . print_r(sqlsrv_errors(), true));
            }

            $sql = "INSERT INTO usuaris (nom, cognoms, email, contrasenya) VALUES (?, ?, ?, ?)";
            $contrasenya_hashed = password_hash($contrasenya, PASSWORD_DEFAULT);
            $params = array($nom, $cognoms, $correu, $contrasenya_hashed);

            $stmt = sqlsrv_prepare($conn, $sql, $params);

            if ($stmt === false) {
                die("Prepare failed: " . print_r(sqlsrv_errors(), true));
            }

            if (sqlsrv_execute($stmt)) {
                $adresaIP = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
                $missatgeBenvinguda = function ($nom, $cognoms, $contrasenya, $adresaIP) {
                    echo "<p style='color:green'>Benvingut/da, $nom $cognoms! (IP: $adresaIP connexió: " . date("d-m-Y H:i:s") . ").</p>";
                    echo "<h3>
                        <a href='./formulari.html'>Nuevo usuario</a>
                        </h3> 
                        <h3>
                        <a href='./listaUsuaris.php'>Lista usuarios</a>
                        </h3>";
                };
                $missatgeBenvinguda($nom, $cognoms, $contrasenya_hashed, $adresaIP);
            } else {
                echo "<p style='color:red;'>Error al insertar: " . print_r(sqlsrv_errors(), true) . "</p>";
            }

            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);
        } else {
            foreach ($errors as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
        }
    }
    ?>