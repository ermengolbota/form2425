<?php

// Funcions per a la gestió d'arrays utilitzades en el codi

// count per saber la longitud d'un array
// https://www.w3schools.com/php/func_array_count.asp

// in_array per trobar elements en un array
// https://www.w3schools.com/php/func_array_in_array.asp

// implode per convertir un array en una cadena
// https://www.w3schools.com/php/func_string_implode.asp
// https://www.php.net/manual/es/function.implode.php



//El següent codi farà que es mostrin sempre els errors i warnings.
//Això és molt útil per depurar el codi.
//però mai s'ha de fer en un servidor de producció.

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 
// La gestió dels paràmetres i errors està basat en el codi de
// https://www.w3schools.com/php/php_form_validation.asp
//

// Funció clear_input
// Donda una variable obtinguda d'un formulari es valida
// i es netejar per eliminar-ne caracters no desitjats
// trim --> espais en blanc
// stripslashes --> barres invertides
// htmlspecialchars --> caracters especials (escapaments)
// tot això per evitar atacs de tipus XSS
function clear_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Inicialitzem les variables a la cadena buida
$errors = -1;

$nom = "";
$nomErr = "";

$email = "";
$emailErr = "";

$cicles = "";
$ciclesErr = "";

//Diferenciem si hem rebut dades per POST (s'ha enviat el formulari),
//o si s'ha accedit directament a la pàgina sense haver omplert el formulari encara
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = 0;

    if (empty($_POST['nom'])) {
        $nomErr = " El nom és obligatori ";
        $errors++;
    } else {
        $nom = clear_input($_POST['nom']);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $nom)) {
            $nomErr = " * Només es permeten lletres i espais en blanc ";
            $errors++;
        }
    }

    if (empty($_POST['email'])) {
        $emailErr = " El correu és obligatori ";
        $errors++;
    } else {
        $email = clear_input($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = " El correu no té un format vàlid ";
            $errors++;
        }
    }


    if (isset($_POST['cicles']) && count($_POST['cicles']) > 0) {
        //Si s'ha seleccionat algun cicle, els guardem en una cadena separada per comes
        $cicles = implode(", ", $_POST['cicles']);
    } else {
        //Si no s'ha seleccionat cap cicle, prepraem el missatge d'error
        $errors++;
        $ciclesErr = "Com a mínim s'han de seleccionar uns estudis";
    }
} else {
    //Si no hem rebut dades per POST, no cal fer res previ, simplement mostrar el formulari
}
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripció finalitzada</title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/estils.css">
</head>

<body>


    <?php
    if ($errors == 0) {
        //S'ha enviat el form i no hi ha cap error
    
        echo "<div id='informacio'><h1>Dades guardades $cicles</h1>";
        echo "<p><strong>$nom</strong>, moltes gràcies per inscriure't amb el correu $email</p>";
        echo "<p>Has seleccionat els estudis de: $cicles</p>";
        echo "<p><a href='./'>Tornar a la pàgina principal</a></p>";
        echo "</div>";

    } else {
        //Hem de mostrar el formulari perquè 
        //1. No s'ha enviat mai (és la primera càrrega de la pàgina)
        //2. S'ha enviat però hi ha errors
        ?>

        <form id="informacio" action="./index.php" method="post">

            <h1>Institut Pedralbes</h1>
            <?php
            if ($errors > 0) {
                echo "<div class='error'>ATENCIÓ: Hi ha $errors errors en el formulari </div>";
            }
            ?>
            <div class="item">
                <label for="idNom">* Nom: <span class="error"> <?php echo $nomErr; ?> </span>
                </label>
                <!-- La variable $nomErr només tindrà valor si el camp nom no estava bé, per tant el div no es veurà sempre. -->
                <input type="text" placeholder="El teu nom" id="idNom" name="nom" value="<?php echo $nom; ?>">
            </div>
            <div class="item">
                <label for="idEmail">* Correu electrònic: <span class="error"> <?php echo $emailErr; ?> </span>
                </label>
                <input type="text" placeholder="correu@servidor..." id="idEmail" name="email" value="<?php echo $email; ?>">
            </div>

            <div class="error"><?php echo $ciclesErr; ?></div>
            <fieldset class="item" id="cicles">
                <legend>Estudis:</legend>
                <input type="checkbox" id="idDaw" name="cicles[]" value="DAW" <?php if (isset($_POST['cicles']) && in_array("DAW", $_POST['cicles']))
                    echo "checked"; ?>>
                <label for="idDaw">DAW</label>

                <input type="checkbox" id="idDam" name="cicles[]" value="DAM" <?php if (isset($_POST['cicles']) && in_array("DAM", $_POST['cicles']))
                    echo "checked"; ?>>
                <label for="idDam">DAM</label>

                <input type="checkbox" id="idAsix" name="cicles[]" value="ASIX" <?php if (isset($_POST['cicles']) && in_array("ASIX", $_POST['cicles']))
                    echo "checked"; ?>>
                <label for="idAsix">ASIX</label>

                <input type="checkbox" id="idSmx" name="cicles[]" value="SMX" <?php if (isset($_POST['cicles']) && in_array("SMX", $_POST['cicles']))
                    echo "checked"; ?>>
                <label for="idSmx">SMX</label>

                <input type="checkbox" id="idPfi" name="cicles[]" value="PFI" <?php if (isset($_POST['cicles']) && in_array("PFI", $_POST['cicles']))
                    echo "checked"; ?>>
                <label for="idPfi">PFI</label>

            </fieldset>
            <button type="submit" class="item">Enviar</button>
        </form>

        <?php
    }
    ?>


</body>

</html>