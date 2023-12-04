<?php
require_once __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','cv');

function wrapText($text, $lineLength = 50) {
    return wordwrap($text, $lineLength, "\n", true);
}

try {
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $telephone = $_POST["telephone"];
    $pays = $_POST["pays"];
    $adresse = $_POST["adresse"];
    $email = $_POST["email"];
    $competence = wrapText($_POST["competence"], 50);
    $experience = wrapText($_POST["experience"], 50);

    if (empty($prenom) || empty($nom) || empty($telephone) || empty($pays) || empty($adresse) || empty($email) || empty($competence) || empty($experience)) {
        echo "Veuillez remplir tous les champs du formulaire.";
    } else {
        $requete = "INSERT INTO informations (Pays, Prenom, Nom, Telephone, Adresse, Email, Competence, Experience) VALUES ('$pays', '$prenom', '$nom', '$telephone', '$adresse', '$email', '$competence', '$experience' )";

        try {
            $insertion = $dbh->query($requete);

            if ($insertion !== false) {
                echo "Données insérées avec succès dans la base de données.";

                echo "<p>Prénom : $prenom</p><p>Nom : $nom</p><p>Téléphone : $telephone</p><p>Pays : $pays</p><p>Adresse : $adresse</p><p>Email : $email</p><p>Compétence : $competence</p><p>Experience : $experience</p>";

                $dompdf = new Dompdf();
                $html = "<html><body style='text-align: left;'><table border='1' style='margin: auto;'>";
                $html .= "<tr><td><strong>Prénom:</strong></td><td>$prenom</td></tr>";
                $html .= "<tr><td><strong>Nom:</strong></td><td>$nom</td></tr>";
                $html .= "<tr><td><strong>Téléphone:</strong></td><td>$telephone</td></tr>";
                $html .= "<tr><td><strong>Pays:</strong></td><td>$pays</td></tr>";
                $html .= "<tr><td><strong>Adresse:</strong></td><td>$adresse</td></tr>";
                $html .= "<tr><td><strong>Email:</strong></td><td>$email</td></tr>";
                $html .= "<tr><td><strong>Compétence:</strong></td><td>$competence</td></tr>";
                $html .= "<tr><td><strong>Expérience:</strong></td><td>$experience</td></tr>";
                $html .= "</table></body></html>";

                $dompdf->loadHtml($html);

                $dompdf->render();

                $output = $dompdf->output();

                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="informations.pdf"');
                echo $output;
            } else {
                $errorInfo = $dbh->errorInfo();
                echo "Erreur lors de l'insertion : " . $requete . "<br>" . $errorInfo[2];
            }

            $dbh = null;
        } catch (Exception $e) {
            echo 'Exception capturée : ', $e->getMessage(), "\n";
        }
    }
}
?>