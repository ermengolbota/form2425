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
    <title>Esborrar inscrit</title>
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
        die("Error en la connexió amb la base de dades: " . $conn->connect_error);
    }

    if (!isset($_GET['id'])) {
        die("<h1 id='informacio'>No s'ha indicat cap persona per esborrar</h1>");
    }

    $sql = "DELETE FROM PERSONES WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la sentència " . $conn->error);
    }
    $stmt->bind_param("i", $_GET['id']);

    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }
    ?>

    <div id='informacio'>
        <?php

        if ($stmt->affected_rows > 0) {
            // output data of each row
            echo "<h1>Esborrat $stmt->affected_rows elements </h1>";
        } else {
            echo "<h1>No s'ha eliminat cap inscrit</h1>";
        }
        $conn->close();
        ?>
        <a href="llistat.php">Tornar al llistat</a>
    </div>

    echo "</div>";

    ?>

</body>