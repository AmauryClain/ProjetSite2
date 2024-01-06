<?php
try {

    $mysqlClient = new PDO(
        'mysql:host=localhost:8889;dbname=matching_music_group;charset=utf8',
        'root',
        'root',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die('Erreur: ' . $e->getMessage());
}


// $sqlquery = 'select g.grp_name, m.mbr_nickname from groupe g
// inner join grp_membre gm on g.grp_id = gm.grp_id
// inner join membre m on m.mbr_id = gm.mbr_id
// where mbr_nickname = :mbr_nickname and g.grp_id = :grp_id';

// $groupeliste = $mysqlClient->prepare($sqlquery);
// $groupeliste->execute([
//     'mbr_nickname' => "Dimebag Darrell",
//     'grp_id' => 1,
// ]);
// $groupes = $groupeliste->fetchAll();
