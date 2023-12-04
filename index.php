<!DOCTYPE html>
<html>
<head>
    <title>Formulaire</title>
    <link rel="stylesheet" href="/index.css">
</head>
<body>
<form action="traitement.php" method="post">
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom"><br>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom"><br>

    <label for="telephone">Téléphone :</label>
    <input type="text" id="telephone" name="telephone"><br>

    <label for="pays">Pays :</label>
    <input type="text" id="pays" name="pays"><br>

    <label for="adresse">Adresse :</label>
    <input type="text" id="adresse" name="adresse"><br>

    <label for="email">Email :</label>
    <input type="text" id="email" name="email"><br>

    <label for="competence">Compétence :</label>
    <textarea id="competence" name="competence" wrap="soft"></textarea>

    <label for="experience">Experience :</label>
    <textarea id="experience" name="experience" wrap="soft"></textarea>

    <label for="ville">Ville :</label>
    <input type="text" id="ville" name="ville"><br>

    <input type="submit" value="Envoyer">
</form>
</body>
</html>