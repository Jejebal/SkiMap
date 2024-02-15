<h1><?= $titre ?></h1>

<p id="erreur"><?= $erreur ?></p>

<form method="post">

    <label for="pseudo">Rentrez votre nom :</label>
    <input type="text" id="pseudo" name="pseudo" require>

    <label for="motPasse">Rentrez votre mot de passe :</label>
    <input type="password" id="password" name="password" require>

    <label for="confirmation">Confirmer votre mot de passe :</label>
    <input type="password" id="confirmation" name="confirmation" require>

    <input type="submit" value="S'inscrire">

</form>

<a href="/">Ce connecter</a>