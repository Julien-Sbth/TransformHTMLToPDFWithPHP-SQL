<?php
global $html;
require_once __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'cv');

function wrapText($text, $lineLength = 50) {
    return wordwrap($text, $lineLength, "\n", true);
}

try {
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
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
    $langue1 = $_POST["langue1"];
    $langue2 = $_POST["langue2"];
    $formation = $_POST["formation"];
    $objectif = $_POST["objectif"];
    $profession = $_POST["profession"];
    $competence = wrapText($_POST["competence"], 50);
    $experience = wrapText($_POST["experience"], 50);

    $verif_email = $_POST["verif_email"];
    $verif_telephone = $_POST["verif_telephone"];

    $verification = $dbh->prepare("SELECT * FROM informations WHERE Email = :verif_email AND Telephone = :verif_telephone");
    $verification->bindParam(':verif_email', $verif_email);
    $verification->bindParam(':verif_telephone', $verif_telephone);
    $verification->execute();
    $existing_data = $verification->fetch(PDO::FETCH_ASSOC);

    $image_path = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image_base64 = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
        $image_data = 'data:' . mime_content_type($_FILES['image']['tmp_name']) . ';base64,' . $image_base64;

        $html .= "<img src='$image_data' alt='Image du CV'>";
    }

    if ($existing_data) {
        echo "<link rel='stylesheet' href='/css/index.css'> ";
        echo "<div class='centered-content'>";
        echo "<p>Données existantes de l'utilisateur :</p>";
        echo "<p>Prénom : " . $existing_data['Prenom'] . "</p>";
        echo "<p>Nom : " . $existing_data['Nom'] . "</p>";
        echo "<p>Pays : " . $existing_data['Pays'] . "</p>";
        echo "<p>Email : " . $existing_data['Email'] . "</p>";
        echo "<p>Adresse : " . $existing_data['Adresse'] . "</p>";
        echo "<p>Téléphone : " . $existing_data['Telephone'] . "</p>";
        echo "<p>Experience : " . $existing_data['Experience'] . "</p>";
        echo "<p>Competence : " . $existing_data['Competence'] . "</p>";
        echo "<p>Première Langue : " . $existing_data['Langue1'] . "</p>";
        echo "<p>Deuxieme Langue : " . $existing_data['Langue2'] . "</p>";
        echo "<p>Profession : " . $existing_data['Profession'] . "</p>";
        echo "<p>Objectif : " . $existing_data['Objectif'] . "</p>";
        echo "</div>";

        echo "<form method='post'>";
        echo "<p>Souhaitez-vous modifier des données ? </p>";
        echo "<input type='text' name='prenom' placeholder='" . $existing_data['Prenom'] . "'><br>";
        echo "<input type='text' name='nom' placeholder='" . $existing_data['Nom'] . "'><br>";
        echo "<input type='text' name='pays' placeholder='" . $existing_data['Pays'] . "'><br>";
        echo "<input type='text' name='adresse' placeholder='" . $existing_data['Adresse'] . "'><br>";
        echo "<input type='text' name='profession' placeholder='" . $existing_data['Profession'] . "'><br>";
        echo "<input type='text' name='objectif' placeholder='" . $existing_data['Objectif'] . "'><br>";
        echo "<input type='text' name='formation' placeholder='" . $existing_data['Formation'] . "'><br>";
        echo "<input type='text' name='langue1' placeholder='" . $existing_data['Langue1'] . "'><br>";
        echo "<input type='text' name='langue2' placeholder='" . $existing_data['Langue2'] . "'><br>";
        echo "<label for='competence'>Compétence :</label>";
        echo "<textarea id='competence' name='competence' placeholder='" . $existing_data['Pays'] . "' wrap='soft' ></textarea>";
        echo "<label for='experience'>Experience :</label>";
        echo "<textarea id='experience' name='experience' wrap='soft' required></textarea>";
        echo "<input type='mobile' id='telephone' name='telephone' placeholder='" . $existing_data['Telephone'] . "' required>";
        echo "<input type='email' id='email' name='email' placeholder='" . $existing_data['Email'] . "' required>";

        echo "<input type='hidden' id='verif_telephone' name='verif_telephone' value='verif_telephone'>";
        echo "<input type='hidden' id='verif_email' name='verif_email' value='verif_email'>";

        echo "<input type='submit' name='modifier' value='Modifier'>";
        echo "</form>";

        if (isset($_POST['modifier'])) {
            $update_query = "UPDATE informations SET Prenom = :prenom, Nom = :nom, Telephone = :telephone, Pays = :pays, Adresse = :adresse, Email = :email, Competence = :competence, Experience = :experience, Formation =:formation WHERE Email = :verif_email AND Telephone = :verif_telephone";

            $update_statement = $dbh->prepare($update_query);
            $update_statement->bindParam(':prenom', $_POST['prenom']);
            $update_statement->bindParam(':nom', $_POST['nom']);
            $update_statement->bindParam(':telephone', $_POST['telephone']);
            $update_statement->bindParam(':pays', $_POST['pays']);
            $update_statement->bindParam(':adresse', $_POST['adresse']);
            $update_statement->bindParam(':email', $_POST['email']);
            $update_statement->bindParam(':competence', $_POST['competence']);
            $update_statement->bindParam(':experience', $_POST['experience']);
            $update_statement->bindParam(':profession', $_POST['profession']);
            $update_statement->bindParam(':formation', $_POST['formation']);
            $update_statement->bindParam(':langue1', $_POST['langue1']);
            $update_statement->bindParam(':langue2', $_POST['langue2']);
            $update_statement->bindParam(':objectif', $_POST['objectif']);
            $update_statement->bindParam(':verif_email', $_POST['verif_email']);
            $update_statement->bindParam(':verif_telephone', $_POST['verif_telephone']);

            if ($update_statement->execute()) {
                echo "Données mises à jour avec succès.";
            } else {
                echo "Erreur lors de la mise à jour des données.";
            }
        }
    } else {
        if (empty($prenom) || empty($nom) || empty($telephone) || empty($pays) || empty($adresse) || empty($email) || empty($competence) || empty($experience)) {
            echo "Veuillez remplir tous les champs du formulaire.";
        } else {
            $requete = "INSERT INTO informations (Pays, Prenom, Nom, Telephone, Adresse, Email, Competence, Experience, Langue1, Langue2, Profession, Formation, Objectif) VALUES ('$pays', '$prenom', '$nom', '$telephone', '$adresse', '$email', '$competence', '$experience', '$langue1', '$langue2', '$profession', '$formation', '$objectif' )";

            try {
                $insertion = $dbh->exec($requete);

                if ($insertion !== false) {
                    echo "Données insérées avec succès dans la base de données.";
                    $template_file = 'cv.html';
                    $html = file_get_contents($template_file);
                    $html = str_replace(
                        ['{{prenom}}', '{{nom}}', '{{telephone}}', '{{pays}}', '{{adresse}}', '{{email}}', '{{competence}}', '{{experience}}', '{{formation}}', '{{profession}}', '{{objectif}}', '{{langue1}}', '{{langue2}}', '{{date}}'],
                        [$prenom, $nom, $telephone, $pays, $adresse, $email, $competence, $experience, $formation, $objectif, $profession, $langue1, $langue2, date('d-m-Y')],
                        $html
                    );

                    $dompdf = new Dompdf();
                    $dompdf->loadHtml($html);
                    $dompdf->render();

                    $output = $dompdf->output();

                    header('Content-Type: application/pdf');
                    header('Content-Disposition: attachment; filename="information.pdf"');
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
}
?>