<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>
    <style>
        body{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        table{
            border: 2px solid black;
            border-collapse: collapse;
        }
        thead th{
            background-color: black;
            color: white;
        }
        tr, th, td{
            border: 2px solid black;
            border-collapse: collapse;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Contrasenya</th>
        </thead>
        <tbody>
            <?php
            $connexioBD= mysqli_connect("localhost", "spendsmart","spendsmart","contactes");
            if(!$connexioBD){
                die("Connexio fallida: ".mysqli_connect_error());
            }else{
                $sql="SELECT * FROM usuaris";
                $result=mysqli_query($connexioBD,$sql);
                if($result){
                   while($row = mysqli_fetch_assoc($result)){
                        echo 
                        "<tr>
                            <td>".$row["nom"]."</td>"
                            ."<td>".$row["cognoms"]."</td>"
                            ."<td>".$row["correu"]."</td>"
                            ."<td>".$row["contrasenya"]."</td>
                        </tr>";
                   }
                }else{
                    echo "Error: ". mysqli_connect_error();
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>