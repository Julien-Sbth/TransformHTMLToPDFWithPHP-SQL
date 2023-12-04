<!DOCTYPE html>
<html>
<head>
    <title>Formulaire</title>
    <link rel="stylesheet" href="/index.css">
</head>
<body>
<form action="traitement.php" method="post">
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom"><br><br>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom"><br><br>

    <label for="telephone">Téléphone :</label>
    <input type="text" id="telephone" name="telephone"><br><br>

    <label for="pays">Pays :</label>
    <input type="text" id="pays" name="pays"><br><br>

    <label for="adresse">Adresse :</label>
    <input type="text" id="adresse" name="adresse"><br><br>

    <label for="email">Email :</label>
    <input type="text" id="email" name="email"><br><br>

    <label for="competence">Compétence :</label>
    <input type="text" id="competence" name="competence"><br><br>

    <label for="experience">Experience :</label>
    <textarea type="text" id="experience" name="experience" placeholder="Description"></textarea><br>

    <label for="ville">Ville :</label>
    <input type="text" id="ville" name="ville"><br><br>

    <input type="submit" value="Envoyer">
</form>
</body>
</html>