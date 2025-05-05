<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        table {
            border: 2px solid black;
            border-collapse: collapse;
        }
        thead th {
            background-color: black;
            color: white;
        }
        tr, th, td {
            border: 2px solid black;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<?php
    $serverName = "tcp:gestordegastos.database.windows.net,1433";
    $connectionOptions = array(
        "Database" => "spendsmart",
        "Uid" => "spendsmart",
        "PWD" => "gestorgastos123@",
        "LoginTimeout" => 30,
        "Encrypt" => 1,
        "TrustServerCertificate" => 0
    );


    $conn = sqlsrv_connect($serverName, $connectionOptions);
    ?>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Contrasenya</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (!$conn) {
                    die("Connection failed: " . print_r(sqlsrv_errors(), true));
                } else {
                    $sql = "SELECT nom, cognoms, correu, contrasenya FROM usuaris";
                    $stmt = sqlsrv_query($conn, $sql);

                    if ($stmt === false) {
                        die("Query failed: " . print_r(sqlsrv_errors(), true));
                    }

                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        echo "
                    <tr>
                        <td>{$row['nom']}</td>
                        <td>{$row['cognoms']}</td>
                        <td>{$row['correu']}</td>
                        <td>{$row['contrasenya']}</td>
                    </tr>
                    ";
                    }

                    sqlsrv_free_stmt($stmt);
                    sqlsrv_close($conn);
                }
            ?>
        </tbody>
    </table>
</body>
</html>
