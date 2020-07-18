<?php
include_once('ext/auth.php');
$return = $db->query("SELECT * FROM produit,type_produit,prix,stock");
$returnVente = $db->query("SELECT * FROM vente");
?>