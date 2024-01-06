<?php
include('elements/navbar.php');
include('connection.php');

$displayGroups = $mysqlClient->prepare('select * from groupe');
$displayGroups->execute();

foreach ($displayGroups as $group) {
    echo $group['grp_name'];
};
