<?php error_reporting(E_ALL); ?>
<?php
function sanitize($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

function redirect($url)
{
    header('location : '.$url);
    exit();
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
$text = "";
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
            $nbDeOmelette . "\n" ;
            file_put_contents("sauvegarde.csv", $text);
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
<div class="col-lg-2"></div>
<div class="col-lg-8">
    <div class="row">
        <img src="img/logo.png">
    </div>
    <div class="row">
        <p>
            <br>
            2020 rue Futomaki, Montréal (QC) J1J K2K <br>
            Téléphone: 514-123-4567
        </p>
    </div>
    <div class="row">
        <h1>Menu des sushis</h1>
        <br>
    </div>
    <div class="row">
        <form action="index.php" method="post">
            <div class="row form-group">
                <div class="col-lg-3"><label form="Nom">Nom : </label></div>
                <div class="col-lg-9"><input class="form-control" type="text" id="Nom" name="Nom"
                                             value="<?php echo $nom; ?>"></div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3"><label form="Prenom">Premon : </label></div>
                <div class="col-lg-9"><input class="form-control" type="text" id="Prenom" name="Prenom"
                                             value="<?php echo $prenom; ?>"></div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3"><label form="Numero de telephone">Numero de telephone : </label></div>
                <div class="col-lg-9"><input class="form-control" placeholder="XXX-XXX-XXXX" type="text" id="nt"
                                             name="numeroDeTelephone" value="<?php echo $numeroDeTelephone; ?>">
                </div>
            </div>
            <br>
            <div class="row form-group">
                <div class="col-lg-3"><img src="img/california_roll.png" style="width:200px"></div>
                <div class="col-lg-3"><label form="Californien">Maki californien 6$ : </label></div>
                <div class="col-lg-6"><input class="form-control" type="text" id="nbDeCalifornien"
                                             name="nbDeCalifornien" value="<?php echo $nbDeCalifornien; ?>"></div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3"><img src="img/boston_roll.png" style="width:200px"></div>
                <div class="col-lg-3"><label form="Boston">Maki boston 7$ : </label></div>
                <div class="col-lg-6"><input class="form-control" type="text" id="nbDeBoston" name="nbDeBoston"
                                             value="<?php echo $nbDeBoston; ?>"></div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3"><img src="img/sashimi.png" style="width:200px"></div>
                <div class="col-lg-3"><label form="Saumon">Sashimi saumon 4$ : </label></div>
                <div class="col-lg-6"><input class="form-control" type="text" id="nbDeSaumon" name="nbDeSaumon"
                                             value="<?php echo $nbDeSaumon; ?>"></div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3"><img src="img/nigris.png" style="width:200px"></div>
                <div class="col-lg-3"><label form="Avocat">Nigris avocat 3$ : </label></div>
                <div class="col-lg-6"><input class="form-control" type="text" id="nbDAvocat" name="nbDAvocat"
                                             value="<?php echo $nbDAvocat; ?>"></div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3"><img src="img/sushi.png" style="width:200px"></div>
                <div class="col-lg-3"><label form="Omelette">Sushi omelette 2$ : </label></div>
                <div class="col-lg-6"><input class="form-control" type="text" id="nbDeOmelette" name="nbDeOmelette"
                                             value="<?php echo $nbDeOmelette; ?>"></div>
            </div>
            <?php
            if ($error){
                echo "<div class='ui red message'>".
                    "<div class='header'>Erreur dans le formulaire</div>";
                if (!empty($erreurNom)){
                    echo "<p>$erreurNom</p>";
                }
                if (!empty($erreurPrenom)){
                    echo "<p>$erreurPrenom</p>";
                }
                if (!empty($erreurNumeroDeTelephone)){
                    echo "<p>$erreurNumeroDeTelephone</p>";
                }
                if (!empty($erreurNbDeSushi)){
                    echo "<p>$erreurNbDeSushi</p>";
                }
                echo "</div>";
            } elseif ($formulaireOK){
                echo "<div class='ui green message'>".
                    "<div class='header'>Formulaire valide!</div>".
                    "</div>";
                echo '<script>window.location="validation.php"</script>';
            }

            ?>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <button class="ui button" type="submit">Envoyer</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="col-lg-2"></div>
</body>
</html>
