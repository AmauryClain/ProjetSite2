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
$insertGroup = $my