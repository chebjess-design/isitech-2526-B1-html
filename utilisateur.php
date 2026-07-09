<?php

require 'database.php';

$req = $pdo->query(
"SELECT * FROM utilisateurs
ORDER BY nom"
);

$utilisateurs = $req->fetchAll();

include 'header.php';
?>

<h2>Liste des utilisateurs</h2>

<p>
<a href="ajout-utilisateur.php">
Ajouter un utilisateur
</a>
</p>

<table border="1">

<tr>
<th>Nom</th>
<th>Prénom</th>
<th>Email</th>
<th>Téléphone</th>
<th>Actif</th>
<th>Actions</th>
</tr>

<?php foreach($utilisateurs as $user): ?>

<tr>

<td><?= htmlspecialchars($user['nom']) ?></td>

<td><?= htmlspecialchars($user['prenom']) ?></td>

<td><?= htmlspecialchars($user['email']) ?></td>

<td><?= htmlspecialchars($user['telephone']) ?></td>

<td>
<?= $user['actif'] ? 'Oui' : 'Non' ?>
</td>

<td>

<a href="modifier-utilisateur.php?id=<?= $user['id'] ?>">
Modifier
</a>

|

<a href="desactiver-utilisateur.php?id=<?= $user['id'] ?>">
Désactiver
</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<?php include 'footer.php'; ?>