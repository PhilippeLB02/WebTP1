<?php error_reporting(E_ALL); ?>

<?php
function sanitize($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}




//Variables
$nom = "";
$prenom = "";
$numeroDeTelephone = "";
$nbDeCalifornien = 0;
$nbDeBoston = 0;
$nbDeSaumon = 0;
$nbDAvocat = 0;
$nbDeOmelette = 0;
$nbTotalDeSushi = 0;

//Erreur des variables
$erreurNom = "";
$erreurPrenom = "";
$erreurNumeroDeTelephone = "";
$erreurNbDeSushi = "";
$error = false;
$formulaireOK = false;



if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $nom = sanitize($_POST["Nom"]);
    $prenom = sanitize($_POST["Prenom"]);
    $numeroDeTelephone = sanitize($_POST["numeroDeTelephone"]);
    $nbDeCalifornien = sanitize($_POST["nbDeCalifornien"]);
    $nbDeBoston = sanitize($_POST["nbDeBoston"]);
    $nbDeSaumon = sanitize($_POST["nbDeSaumon"]);
    $nbDAvocat= sanitize($_POST["nbDAvocat"]);
    $nbDeOmelette = sanitize($_POST["nbDeOmelette"]);

    if (empty($nom)){
        $erreurNom = "Votre nom est invalide.";
        $error = true;
    }

    if (empty($prenom)){
        $erreurPrenom = "Votre prenom est invalide.";
        $error = true;
    }

    if (empty($numeroDeTelephone)){
        $erreurNumeroDeTelephone = "Votre numero de telephone est invalide.";
        $error = true;
    }

    $nbTotalDeSushi = $nbDeCalifornien . $nbDeBoston . $nbDeSaumon . $nbDAvocat . $nbDeOmelette;

    if (empty($nbTotalDeSushi)){
        $erreurNbDeSushi = "Veuillez entree un nombre positif de sushi.";
        $error = true;
    }

    $formulaireOK = !$error;

    if ($error) {

    } else {
        $text = $nom . "," .
            $prenom . "," .
            $numeroDeTelephone . "," .
            $nbDeCalifornien . "," .
            $nbDeBoston . "," .
            $nbDeSaumon . "," .
            $nbDAvocat . "," .
            $nbDeOmelette . "\n";
            file_put_contents("sauvegarde.txt", $text);
    }

}
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Sushi++</title>
    <link rel="icon" href="img/favicon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>

<div class="col-lg-3"></div>
    <div class="col-lg-6">
        <div class="row">
            <img src="img/logo.png">
        </div>
        <div class="row">
            <p>
                <br>
                2020 rue Futomaki, Montréal (QC) J1J K2K <br>
                Téléphone: 514-123-4567
                <br>
            </p>
        </div>
        <div class="row">
            <h1>Facture</h1>
        </div>
        <div class="row">
            <div class="col-lg-4"><p>Maki californien</p></div>
            <div class="col-lg-5"><p>......................</p></div>
        </div>
    </div>


</body>

</html>
