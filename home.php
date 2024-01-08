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
    $res = $mysqlClient->prepare('select g.grp_name from groupe g where ' . implode(' or ', $kw) . ' order by g.grp_name asc');
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();
    $tab = $res->fetchAll();
    $displayGrp = "yes";
};



// Recherche musiciens
if ($searchType == "mem") {
    $displaySearch = "yes";
};
if (isset($submit) && !empty(trim($keywords)) && $searchType == "mem") {
    $words = explode(" ", trim($keywords));
    for ($i = 0; $i < count($words); $i++) {
        $kw[$i] = "g.grp_name like '%" . $words[$i] . "%'";
    }
    include('connection.php');
    $res = $mysqlClient->prepare('select g.grp_name from groupe g where ' . implode(' or ', $kw) . ' order by g.grp_name asc');
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();
    $tab = $res->fetchAll();
    $displayMem = "yes";
};
// Recherche albums
if ($searchType == "alb") {
    $displaySearch = "yes";
};
if (isset($submit) && !empty(trim($keywords)) && $searchType == "alb") {
    $words = explode(" ", trim($keywords));
    for ($i = 0; $i < count($words); $i++) {
        $kw[$i] = "g.grp_name like '%" . $words[$i] . "%'";
    }
    include('connection.php');
    $res = $mysqlClient->prepare('select g.grp_name from groupe g where ' . implode(' or ', $kw) . ' order by g.grp_name asc');
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();
    $tab = $res->fetchAll();
    $displayAlb = "yes";
};



?>

<h5>Que souhaitez-vous rechercher ?</h5>
<form class="btnsearch" method="get" action="">
    <input type="hidden" name="searchType" value="">
    <button name="searchType" value="grp" type="submit" class="btn btn-secondary">Groupe</button>
    <button name="searchType" value="mem" type="submit" class="btn btn-secondary">Musicien</button>
    <button name="searchType" value="alb" type="submit" class="btn btn-secondary">Album</button>
</form>

<form class="d-flex" role="search" name="fo" method="get" action="" <?php echo ($displaySearch == "yes") ? 'style="display: flex !important;"' : 'style="display: none !important;"'; ?>>
    <input type="hidden" name="searchType" value="<?php echo htmlspecialchars($searchType); ?>">
    <input class="form-control me-2" type="search" name="keywords" placeholder="Search" value="<?php echo $keywords ?>" aria-label="Search">
    <button class="btn btn-outline-success" name="submit" type="submit">Search</button>
</form>
<!-- Affiche les groupes -->
<?php if (@$displayGrp == "yes") {
?>
    <div class="searchresults">
        <div id="nbrResult"><?= count($tab) . " " . (count($tab) > 1 ? "résultats trouvés" : "résultat trouvé") ?></div>
        <?php for ($i = 0; $i < count($tab); $i++) { ?>
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $tab[$i]["grp_name"] ?></h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- Affiche les musiciens -->
<?php } ?>
<?php if (@$displayMem == "yes") {
?>
    <div class="searchresults">
        <div id="nbrResult"><?= count($tab) . " " . (count($tab) > 1 ? "résultats trouvés" : "résultat trouvé") ?></div>
        <?php for ($i = 0; $i < count($tab); $i++) { ?>
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $tab[$i]["grp_name"] ?></h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>
<!-- Affiche les albums -->
<?php if (@$displayAlb == "yes") {
?>
    <div class="searchresults">
        <div id="nbrResult"><?= count($tab) . " " . (count($tab) > 1 ? "résultats trouvés" : "résultat trouvé") ?></div>
        <?php for ($i = 0; $i < count($tab); $i++) { ?>
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $tab[$i]["grp_name"] ?></h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>