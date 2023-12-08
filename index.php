<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Formulaire</title>
    <link rel="stylesheet" href="/index.css">
</head>
<body>
<form action="traitement.php" method="post" class="form-grid">
    <div class="input-group">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="Prénom">
    </div>
    <div class="input-group">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="Nom">
    </div>
    <div class="input-group">
        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" name="telephone" value="Téléphone">
    </div>
    <div class="input-group">
        <label for="pays">Pays :</label>
        <input type="text" id="pays" name="pays" value="Pays">
    </div>
    <div class="input-group">
        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" value="adresse">
    </div>
    <div class="input-group">
        <label for="email">Email :</label>
        <input type="text" id="email" name="email" value="email">
    </div>
    <div class="input-group">
        <label for="competence">Compétence :</label>
        <textarea id="competence" name="competence" wrap="soft"></textarea>
    </div>
    <div class="input-group">
        <label for="experience">Experience :</label>
        <textarea id="experience" name="experience" wrap="soft"></textarea>
    </div>
    <div class="input-group">
        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville" value="Ville">
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
<!-- l'utilisateur doit pouvoir revenir sur le pdf, récupérer l'ancien pdf et le modifier, afficher toutes les données

 Partie Données personnelle, numero prenom adresse mail nom-->