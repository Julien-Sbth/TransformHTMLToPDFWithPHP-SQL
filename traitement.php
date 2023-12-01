<?php
require_once __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;

define('DB_HOST','YOUR_HOSTNAME');
define('DB_USER','YOUR_USERNAME');
define('DB_PASS','YOUR_PASSWORD');
define('DB_NAME','YOUR_DB');

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
    if (empty($prenom) || empty($nom) || empty($telephone) || empty($pays)) {
        echo "Veuillez remplir tous les champs du formulaire.";
    } else {
        $requete = "INSERT INTO informations (Pays, Prenom, Nom, Telephone) VALUES ('$pays', '$prenom', '$nom', '$telephone')";

        try {
            $insertion = $dbh->query($requete);

            if ($insertion !== false) {
                echo "Données insérées avec succès dans la base de données.";

                echo "<p>Prénom : $prenom</p><p>Nom : $nom</p><p>Téléphone : $telephone</p><p>Pays : $pays</p>";

                $dompdf = new Dompdf();
                $html = "<html><body><p>Prénom : $prenom</p><p>Nom : $nom</p><p>Téléphone : $telephone</p><p>Pays : $pays</p></body></html>";

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