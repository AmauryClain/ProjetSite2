<?php
include('elements/navbar.php');
include('connection.php');


@$keywords = $_GET['keywords'];
@$submit =  $_GET['submit'];
if (isset($submit) && !empty(trim($keywords))) {
    $words = explode(" ", trim($keywords));
    for ($i = 0; $i < count($words); $i++) {
        $kw[$i] = "g.grp_name like '%" . $words[$i] . "%'";
    }
    include('connection.php');
    $res = $mysqlClient->prepare('select g.grp_name from groupe g where ' . implode(' or ', $kw) . ' order by g.grp_name asc');
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();
    $tab = $res->fetchAll();
    $display = "yes";
}
?>

<form class="d-flex" role="search" name="fo" method="get" action="">
    <input class="form-control me-2" type="search" name="keywords" placeholder="Search" value="<?php echo $keywords ?>" aria-label="Search">
    <button class="btn btn-outline-success" name="submit" type="submit">Search</button>
</form>
<?php if (@$display == "yes") {
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