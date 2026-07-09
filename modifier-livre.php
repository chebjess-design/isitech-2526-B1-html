<?php

require 'database.php';

if(!isset($_GET['id'])){
    die("Livre introuvable");
}

$id = $_GET['id'];

$stmt = $pdo->prepare(
"SELECT * FROM livres WHERE id = ?"
);

$stmt->execute([$id]);

$livre = $stmt->fetch();

if(!$livre){
    die("Livre inexistant");
}

$message = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $titre = trim($_POST['titre']);
    $auteur = trim($_POST['auteur']);
    $isbn = trim($_POST['isbn']);
    $annee = $_POST['annee'];
    $resume = trim($_POST['resume']);
    $categorie = trim($_POST['categorie']);
    $disponible = isset($_POST['disponible']) ? 1 : 0;

    $update = $pdo->prepare(
    "UPDATE livres
    SET titre=?,
        auteur=?,
        isbn=?,
        annee=?,
        resume=?,
        categorie=?,
        disponible=?
    WHERE id=?"
    );

    $update->execute([
        $titre,
        $auteur,
        $isbn,
        $annee,
        $resume,
        $categorie,
        $disponible,
        $id
    ]);

    $message = "Livre modifié avec succès";

    $stmt = $pdo->prepare(
    "SELECT * FROM livres WHERE id=?"
    );

    $stmt->execute([$id]);

    $livre = $stmt->fetch();
}

include 'header.php';
?>

<h2>Modifier un livre</h2>

<p><?= $message ?></p>

<form method="POST">

<label>Titre</label>
<br>
<input
type="text"
name="titre"
value="<?= htmlspecialchars($livre['titre']) ?>"
required>

<br><br>

<label>Auteur</label>
<br>
<input
type="text"
name="auteur"
value="<?= htmlspecialchars($livre['auteur']) ?>"
required>

<br><br>

<label>ISBN</label>
<br>
<input
type="text"
name="isbn"
value="<?= htmlspecialchars($livre['isbn']) ?>">

<br><br>

<label>Année</label>
<br>
<input
type="number"
name="annee"
value="<?= htmlspecialchars($livre['annee']) ?>">

<br><br>

<label>Catégorie</label>
<br>
<input
type="text"
name="categorie"
value="<?= htmlspecialchars($livre['categorie']) ?>"
required>

<br><br>

<label>Résumé</label>
<br>
<textarea
name="resume"
rows="6"
cols="50"><?= htmlspecialchars($livre['resume']) ?></textarea>

<br><br>

<label>
<input
type="checkbox"
name="disponible"
<?= $livre['disponible'] ? 'checked' : '' ?>>
Disponible
</label>

<br><br>

<button type="submit">
Enregistrer les modifications
</button>

</form>

<?php include 'footer.php'; ?>