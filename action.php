<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripció finalitzada</title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/estils.css">
</head>
<div id="informacio">
    <h1>Inscripció finalitzada</h1>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['nom']) && !empty($_POST['email'])) {
        echo "Gràcies " . $_POST['nom'] . "<br>";
        echo "T'enviarem la informació del curs a " . $_POST['email'] . "<br>";
        echo "<div id='agraiment'>Moltes gràcies per inscriure't</div>";
    } else {
        echo "<div id='error'>  ERROR: Dades del formulari incorrectes</div>";
    }
    ?>
    <p><a href="./index.html">Tornar a la pàgina principal</a></p>
</div>

<body>

</body>

</html>