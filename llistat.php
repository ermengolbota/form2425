<?php
//activem el mostrar errors. NOMÉS PER DESENVOLUPAMENT
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// preparem les variables per a la connexió a la base de dades
$servername = "localhost";
$username = "ebota_daw";
$password = "Ee_0j(pbe^PfaQM/";
$dbname = "ebota_daw";

?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llistat d'inscrits</title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/estils.css">
</head>

<body>
    <?php
    // Comprovem la connexió
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        //Si no es pot connectar, mostrem un missatge d'error i abortem el php
        // no té sentit continuar sense connexió
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT id, nom FROM PERSONES";
    // Sense Prepared Statements seria directament :
    //      $result = $conn->query($sql);
    // Però amb Prepared Statements que ofereix seguretat i rendiment
    // cal fer-ho amb dos passos
    // 1. Preparem la consulta
    // 2. Executem la consulta
    //En aquest cas realment no caldria Prepared Statements, ja que no 
    // hi ha dades de l'usuari involucrades, però ho fem per practicar
    // i tenir-ho com a costum
    

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }
    $result = $stmt->get_result();


    echo "<div id='informacio'>";
    if ($result->num_rows > 0) {
        // Si hem obtingut algun registre...
        echo "<h1>Llistat d'inscrits</h1>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>";
            echo $row["id"] . " -  " . $row["nom"];
            echo " - <a href='index.php?id=" . $row["id"] . "' title='editar' >editar</a>";
            echo " - <a href='delete.php?id=" . $row["id"] . "' title='esborrar' >esborrar</a>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<h1>No hi ha inscrits</h1>";
    }
    $conn->close();
    ?>
    <a href="index.php">Portada</a>
    </div>


</body>