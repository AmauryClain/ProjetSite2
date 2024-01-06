<?php
include("../elements/navbar.php");
include("../connection.php");

// Verif du formulaire 
if (
    empty($_POST['grp_name']) ||
    empty($_POST['grp_createdate'])
) {
    echo "Il manque des informations";
    return;
}

if ($_POST['mgr_id'] == "Genre de musique") {
    echo "Il manque le genre";
    return;
}


$mgr_id = $_POST['mgr_id'];
$grp_name = $_POST['grp_name'];
$grp_createdate = $_POST['grp_createdate'];

// faire l'insertion en base
$insertGroup = $mysqlClient->prepare('insert into groupe (grp_name, grp_createdate) values (:grp_name, :grp_createdate)');
$insertGroup->execute([
    'grp_name' => $grp_name,
    'grp_createdate' => $grp_createdate,
]);


$getNewGroupId = $mysqlClient->prepare('select g.grp_id from groupe g where g.grp_name = :grp_name');
$getNewGroupId->execute([
    'grp_name' => $grp_name
]);

$result = $getNewGroupId->fetch(PDO::FETCH_ASSOC);
$newGroupId = $result['grp_id'];

echo $newGroupId;

$addGroupGenre = $mysqlClient->prepare('insert into grp_genre (grp_id, mgr_id) values (:newGroupId, :mgr_id)');
$addGroupGenre->execute([
    'newGroupId' => $newGroupId,
    'mgr_id' => $mgr_id
]);
