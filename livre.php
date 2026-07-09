<?php

require_once "database.php";

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare(
"SELECT * FROM livres WHERE id=?"
);

$stmt->execute([$id]);

$livre = $stmt->fetch();

include "header.php";

if(!$livre){

echo "<h2>Livre introuvable</h2>";

}else{

?>

<div class="card">

<h2><?= htmlspecialchars($livre['titre']) ?></h2>

<p><strong>Auteur :</strong> <?= htmlspecialchars($livre['auteur']) ?></p>

<p><strong>ISBN :</strong> <?= htmlspecialchars($livre['isbn']) ?></p>

<p><strong>Année :</strong> <?= htmlspecialchars($livre['annee']) ?></p>

<p><strong>Catégorie :</strong> <?= htmlspecialchars($livre['categorie'] ?? 'Roman') ?></p>

<p><strong>Résumé :</strong><br>
<?= htmlspecialchars($livre['resume'] ?? 'Aucun résumé disponible.') ?>
</p>

</div>
<?php } ?>

<?php include "footer.php";?>