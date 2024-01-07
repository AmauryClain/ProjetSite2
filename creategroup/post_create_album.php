<?php
include("../elements/navbar.php");
include("../connection.php");

// Verif du formulaire 
if (
    empty($_POST['alb_name']) ||
    empty($_POST['alb_createdate'])
) {
    echo "Il manque des informations";
    return;
}

if ($_POST['grp_id'] == "Groupe") {
    echo "Il manque le groupe";
    return;
}

// initialisation des variables
$alb_name = $_POST['alb_name'];
$alb_createdate = $_POST['alb_createdate'];
$grp_id = $_POST['grp_id'];

//faire l'insertion en base
$insertAlbum = $mysqlClient->prepare('insert into album (alb_name, alb_createdate, grp_id) values (:alb_name, :alb_createdate, :grp_id)');
$insertAlbum->execute([
    'alb_name' => $alb_name,
    'alb_createdate' => $alb_createdate,
    'grp_id' => $grp_id
]);
?>
<p>L'album à bien été ajouté</p>