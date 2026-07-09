<?php

require_once "database.php";

$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$titre = trim($_POST["titre"]);
$auteur = trim($_POST["auteur"]);
$isbn = trim($_POST["isbn"]);

if(
empty($titre)
||
empty($auteur)
||
empty($isbn)
){

$message = "Veuillez remplir tous les champs obligatoires.";

}else{

$verif = $pdo->prepare(
"SELECT id FROM livres WHERE isbn=?"
);

$verif->execute([$isbn]);

if($verif->fetch()){

$message = "ISBN déjà utilisé.";

}else{

$sql = "
INSERT INTO livres
(titre,auteur,isbn,annee,resume,categorie)
VALUES
(?,?,?,?,?,?)
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
$_POST["titre"],
$_POST["auteur"],
$_POST["isbn"],
$_POST["annee"],
$_POST["resume"],
$_POST["categorie"]
]);

$message = "Livre ajouté avec succès.";

}

}

}

include "header.php";?>

<h2>Ajouter un livre</h2>

<p><?= $message ?></p>

<form method="POST">

Titre :
<input type="text" name="titre"><br><br>

Auteur :
<input type="text" name="auteur"><br><br>

ISBN :
<input type="text" name="isbn"><br><br>

Année :
<input type="number" name="annee"><br><br>

Catégorie :
<input type="text" name="categorie"><br><br>

Résumé :

<textarea name="resume"></textarea>

<br><br>

<button type="submit">
Ajouter
</button>

</form>

<?php include "footer.php"; ?>