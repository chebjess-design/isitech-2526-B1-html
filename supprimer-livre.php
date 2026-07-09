<?php

require 'database.php';

if(!isset($_GET['id'])){
    die("Livre introuvable");
}

$id = $_GET['id'];

$stmt = $pdo->prepare(
"DELETE FROM livres WHERE id=?"
);

$stmt->execute([$id]);

header("Location: catalogue.php");
exit;