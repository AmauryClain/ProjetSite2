<?php
include('../connection.php');
include("../elements/navbar.php");

// Verif du formulaire
if (
    empty($_POST['mbr_firstName']) ||
    empty($_POST['mbr_lastName']) ||
    empty($_POST['mbr_nickname']) ||
    empty($_POST['mbr_birthdate']) ||
    empty($_POST['mbr_joinDate'])
) {
    echo "Il manque des informations";
    return;
}
if ($_POST['grp_id'] == "Groupe") {
    echo "Il manque le groupe";
    return;
}
if ($_POST['role'] == "Role") {
    echo "Il manque le role";
    return;
}

// initialisation des variables
$mbr_firstName = $_POST['mbr_firstName'];
$mbr_lastName = $_POST['mbr_lastName'];
$mbr_nickname = $_POST['mbr_nickname'];
$mbr_birthdate = $_POST['mbr_birthdate'];
$mbr_joinDate = $_POST['mbr_joinDate'];
$grp_id = $_POST['grp_id'];
$role = $_POST['role'];

// insertion dans la base 
$insertMember = $mysqlClient->prepare('insert into membre
(mbr_firstName, mbr_lastName, mbr_nickname, mbr_birthdate, mbr_joinDate, mbr_role)
values
(:mbr_firstName, :mbr_lastName, :mbr_nickname, :mbr_birthdate, :mbr_joinDate, :role)');
$insertMember->execute([
    'mbr_firstName' => $mbr_firstName,
    'mbr_lastName' => $mbr_lastName,
    'mbr_nickname' => $mbr_nickname,
    'mbr_birthdate' => $mbr_birthdate,
    'mbr_joinDate' => $mbr_joinDate,
    'role' => $role
]);

// recupere l'id du membre que l'on vient d'ajouter
$getNewMemberId = $mysqlClient->prepare('select m.mbr_id from membre m where concat(m.mbr_firstName, " ", m.mbr_lastName) = :full_name');
$getNewMemberId->execute([
    'full_name' => $mbr_firstName . ' ' . $mbr_lastName
]);
$result = $getNewMemberId->fetch(PDO::FETCH_ASSOC);
$newMemberId = $result['mbr_id'];

// affecte ce membre au groupe selectionné
$addGroupMember = $mysqlClient->prepare('insert into grp_membre (mbr_id, grp_id) values (:newMemberId, :grp_id)');
$addGroupMember->execute([
    'newMemberId' => $newMemberId,
    'grp_id' => $grp_id
]);
?>

<p>le membre à bien été ajouté</p>