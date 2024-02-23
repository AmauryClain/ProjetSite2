<?php
include('elements/navbar.php');
include('connection.php');


@$keywords = $_GET['keywords'];
@$submit =  $_GET['submit'];
@$searchType = $_GET['searchType'];
$displaySearch = "";

// Recherche groupes
if ($searchType == "grp") {
    $displaySearch = "yes";
};
if (isset($submit) && !empty(trim($keywords)) && $searchType == "grp") {
    $words = explode(" ", trim($keywords));
    for ($i = 0; $i < count($words); $i++) {
        $kw[$i] = "g.grp_name like '%" . $words[$i] . "%'";
    }
    include('connection.php');
    $res = $mysqlClient->prepare('select g.grp_createdate, g.grp_name, mgr_name from groupe g inner join grp_genre gg on gg.grp_id = g.grp_id inner join music_genre mg on mg.mgr_id = gg.mgr_id where ' . implode(' or ', $kw) . ' order by g.grp_name asc');
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();
    $tab = $res->fetchAll();


    $displayGrp = "yes";
};



// Recherche musiciens
if ($searchType == "mem") {
    $displaySearch = "yes";

    if (isset($submit) && !empty(trim($keywords))) {
        $words = explode(" ", trim($keywords));
        $kw = array_map(function ($word) {
            return "CONCAT(m.mbr_firstName, ' ', m.mbr_lastName) LIKE '%" . $word . "%'";
        }, $words);

        include('connection.php');
        $res = $mysqlClient->prepare('SELECT m.mbr_firstName, m.mbr_lastName, m.mbr_nickname, mbr_role, g.grp_name, m.mbr_birthdate, m.mbr_joinDate FROM membre m inner join grp_membre gm on gm.mbr_id = m.mbr_id inner join groupe g on g.grp_id = gm.grp_id WHERE ' . implode(' OR ', $kw));
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();
        $tab = $res->fetchAll();
        $displayMem = "yes";
    }
}
// Recherche albums
if ($searchType == "alb") {
    $displaySearch = "yes";
};
if (isset($submit) && !empty(trim($keywords)) && $searchType == "alb") {
    $words = explode(" ", trim($keywords));
    for ($i = 0; $i < count($words); $i++) {
        $kw[$i] = "a.alb_name like '%" . $words[$i] . "%'";
    }
    include('connection.php');
    $res = $mysqlClient->prepare('select a.alb_name, a.alb_createdate, g.grp_name from album a inner join groupe g on g.grp_id = a.grp_id where ' . implode(' or ', $kw));
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();
    $tab = $res->fetchAll();
    $displayAlb = "yes";
};



?>
<div class="mx-5 h-100vh">
    <h5 class="my-1">Que souhaitez-vous rechercher ?</h5>
    <form class="btnsearch my-3" method="get" action="">
        <input type="hidden" name="searchType" value="">
        <button name="searchType" value="grp" type="submit" class="btn btn-secondary">Groupe</button>
        <button name="searchType" value="mem" type="submit" class="btn btn-secondary">Musicien</button>
        <button name="searchType" value="alb" type="submit" class="btn btn-secondary">Album</button>
    </form>

    <form class="my-3 d-flex" role="search" name="fo" method="get" action="" <?php echo ($displaySearch == "yes") ? 'style="display: flex !important;"' : 'style="display: none !important;"'; ?>>
        <input type="hidden" name="searchType" value="<?php echo htmlspecialchars($searchType); ?>">
        <input class="form-control me-2" type="search" name="keywords" placeholder="Search" value="<?php echo $keywords ?>" aria-label="Search">
        <button class="btn btn-outline-success" name="submit" type="submit">Search</button>
    </form>
    <!-- Affiche les groupes -->
    <?php if (@$displayGrp == "yes") {
    ?>
        <div id="nbrResult"><?= count($tab) . " " . (count($tab) > 1 ? "résultats trouvés" : "résultat trouvé") ?></div>
        <div class="searchresults d-flex">
            <?php for ($i = 0; $i < count($tab); $i++) { ?>
                <div class="card m-2" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $tab[$i]["grp_name"] ?></h5>
                        <p class="card-text"><strong>Genre : </strong><?php echo $tab[$i]["mgr_name"] ?><br /><strong>Date de création : </strong><?php echo $tab[$i]["grp_createdate"] ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- Affiche les musiciens -->
    <?php } ?>
    <?php if (@$displayMem == "yes") {
    ?>
        <div id="nbrResult"><?= count($tab) . " " . (count($tab) > 1 ? "résultats trouvés" : "résultat trouvé") ?></div>
        <div class="searchresults d-flex">
            <?php for ($i = 0; $i < count($tab); $i++) { ?>
                <div class="card m-2" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $tab[$i]["mbr_firstName"] . ' ' . $tab[$i]["mbr_lastName"] ?></h5>
                        <p class="card-text"><strong>Surnom : </strong><?php echo $tab[$i]["mbr_nickname"] ?><br /><strong>Date de naissance : </strong><?php echo $tab[$i]["mbr_birthdate"] ?><br /><strong>Role : </strong><?php echo $tab[$i]["mbr_role"] ?><br /><strong>Groupe : </strong><?php echo $tab[$i]["grp_name"] ?><br /><strong>Rejoint le groupe le : </strong><?php echo $tab[$i]["mbr_joinDate"] ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <!-- Affiche les albums -->
    <?php if (@$displayAlb == "yes") {
    ?>
        <div id="nbrResult"><?= count($tab) . " " . (count($tab) > 1 ? "résultats trouvés" : "résultat trouvé") ?></div>
        <div class="searchresults d-flex">
            <?php for ($i = 0; $i < count($tab); $i++) { ?>
                <div class="card m-2" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $tab[$i]["alb_name"] ?></h5>
                        <p class="card-text"><strong>Sortie : </strong><?php echo $tab[$i]["alb_createdate"] ?><br /><strong>Groupe : </strong><?php echo $tab[$i]["grp_name"] ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>