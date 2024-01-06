<?php
include('elements/navbar.php');
include('connection.php');
$displayGroups = $mysqlClient->prepare('select * from groupe');
$displayGroups->execute();


@$keywords = $_GET['keywords'];
@$submit =  $_GET['submit'];
if (isset($submit) && !empty(trim($keywords))) {
    $words = explode(" ", trim($keywords));
    for ($i = 0; $i < count($words); $i++) {
        $kw[$i] = "g.grp_name like '%" . $words[$i] . "%'";
    }
    include('connection.php');
    $res = $mysqlClient->prepare('select g.grp_name from groupe g where ' . implode(' or ', $kw));
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
        <ol>
            <?php for ($i = 0; $i < count($tab); $i++) { ?>
                <li><?php echo $tab[$i]["grp_name"] ?></li>
            <?php } ?>
        </ol>
    </div>
<?php } ?>
<?php
foreach ($displayGroups as $group) {
    echo $group['grp_name'];
};
?>