<?php
include("../elements/navbar.php");
include("../connection.php");

// Verif du formulaire 
if (
    !isset($_POST['grp_name'])
    || !isset($_POST['grp_creatdate'])
) {
    echo "Il manque des informations";
    return;
}

$grp_name = $_POST['grp_name'];
$grp_createdate = $_POST['grp_createdate'];

// faire l'insertion en base
$insertGroup = $mysqlClient->prepare('insert into groupe (grp_name, grp_createdate) values (:grp_name, :grp_createdate)');
$insertGroup->execute([
    'grp_name' => $grp_name,
    'grp_createdate' => $grp_createdate,
]);
