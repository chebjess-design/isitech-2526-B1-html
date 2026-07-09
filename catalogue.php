<?php

require_once "database.php";

include "header.php";

$recherche = $_GET['recherche'] ?? '';

if($recherche != ''){

    $sql = "
    SELECT *
    FROM livres
    WHERE titre LIKE ?
    OR auteur LIKE ?
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        "%$recherche%",
        "%$recherche%"
    ]);

}else{

    $stmt = $pdo->query(
        "SELECT * FROM livres"
    );

}

$livres = $stmt->fetchAll();

?>

<h2>Catalogue</h2>

<form method="GET">

<input
type="text"
name="recherche"
placeholder="Titre ou auteur">

<button type="submit">
Rechercher
</button>

</form>

<br>

<table border="1">

<tr>
    <th>Titre</th>
    <th>Auteur</th>
    <th>Catégorie</th>
    <th>Disponibilité</th>
    <th>Couverture</th>
    <th>Détail</th>
</tr>

<?php foreach($livres as $livre): ?>

<tr>

<td><?= htmlspecialchars($livre['titre']) ?></td>

<td><?= htmlspecialchars($livre['auteur']) ?></td>

<td><?= htmlspecialchars($livre['categorie']) ?></td>

<td>
<?= $livre['disponible']
? '<span class="disponible">Disponible</span>'
: '<span class="indisponible">Indisponible</span>' ?>
</td>

<td>

<?php

$image = "livre.jpg";

if (str_contains($livre['titre'], 'Harry Potter')) {
    $image = 'harry-potter.jpg';
}
elseif ($livre['titre'] == 'Le Seigneur des Anneaux') {
    $image = 'seigneur-des-anneaux.jpg';
}
elseif ($livre['titre'] == '1984') {
    $image = '1984.jpg';
}
elseif ($livre['titre'] == 'Le Petit Prince') {
    $image = 'petit-prince.jpg';
}
elseif (str_contains($livre['titre'], 'Étranger')) {
    $image = 'etranger.jpg';
}
elseif (str_contains($livre['titre'], 'Misérables')) {
    $image = 'miserables.jpg';
}

?>
<img
src="images/<?= $image ?>"
class="couverture"
alt="Couverture">

</td>

<td>
<a href="livre.php?id=<?= $livre['id'] ?>" class="loupe">📖</a>
<a href="modifier-livre.php?id=<?= $livre['id'] ?>">
Modifier
</a>
<a
href="supprimer-livre.php?id=<?= $livre['id'] ?>"
onclick="return confirm('Voulez-vous vraiment supprimer ce livre ?')">
Supprimer
</a>
</td>

</tr>

<?php endforeach; ?>

</table>

<td>
</td>

<?php include "footer.php";?>