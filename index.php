<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Formulaire</title>
    <link rel="stylesheet" href="/index.css">
</head>
<body>
<form action="traitement.php" method="post" class="form-grid" enctype="multipart/form-data">
    <div class="input-group">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" placeholder="Prénom">
    </div>
    <div class="input-group">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" placeholder="Nom">
    </div>
    <div class="input-group">
        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" name="telephone" placeholder="Téléphone">
    </div>
    <div class="input-group">
        <label for="pays">Pays :</label>
        <input type="text" id="pays" name="pays" placeholder="Pays">
    </div>
    <div class="input-group">
        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" placeholder="adresse">
    </div>
    <div class="input-group">
        <label for="email">Email :</label>
        <input type="text" id="email" name="email" placeholder="email">
    </div>
    <div class="input-group">
        <label for="competence">Compétence :</label>
        <textarea id="competence" name="competence" wrap="soft" placeholder="Compétence"></textarea>
    </div>
    <div class="input-group">
        <label for="experience">Experience :</label>
        <textarea id="experience" name="experience" wrap="soft" placeholder="Expérience"></textarea>
    </div>

    <div class="input-group">
        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville" placeholder="Ville">
    </div>
    <div class="input-group">
        <label for="langue1">Langue 1 :</label>
        <input type="text" id="langue1" name="langue1" placeholder="Langue 1">
    </div>
    <div class="input-group">
        <label for="langue2">Langue 2 :</label>
        <input type="text" id="langue2" name="langue2" placeholder="Langue 2">
    </div>

    <p>Vous avez déjà envoyer un CV ?</p>
    <div class="input-group">
        <label for="verif_email">Adresse e-mail pour vérification :</label>
        <input type="text" id="verif_email" name="verif_email" placeholder="Entrez votre adresse e-mail">
    </div>
    <div class="input-group">
        <label for="verif_telephone">Numéro de téléphone pour vérification :</label>
        <input type="text" id="verif_telephone" name="verif_telephone" placeholder="Entrez votre numéro de téléphone">
    </div>

    <input type="submit" value="Envoyer">
</form>
</body>
</html>