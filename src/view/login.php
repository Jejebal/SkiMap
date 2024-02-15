<h1><?= $titre ?></h1>

<p id="erreur"><?= $erreur ?></p>

<form method="post">

    <label for="pseudo">Rentrez votre nom :</label>
    <input type="text" id="pseudo" name="pseudo">

    <label for="password">Rentrez votre mot de passe :</label>
    <input type="password" id="password" name="password">

    <input type="submit" value="Login">

</form>

<a href="/inscrire">S'inscrire</a>