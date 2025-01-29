<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripció finalitzada</title>
</head>
<h1>Inscripció finalitzada</h1>
<?php
echo "<h1>Dades:</h1>";
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "Hola" . $_POST['nom'] . "<br>";
    echo "T'enviarem la informació del curs a " . $_POST['email'] . "<br>";
    echo "<div id='agraiment'>moltes gràcies per inscriure't</div>";
} else {
    echo "<div id='error'>  ERROR: Dades del formulari incorrectes</div>";
}
?>

<body>

</body>

</html>