<?php
include('elements/navbar.php');
include('connection.php');

// recupere la liste des genres de musiques
$listGenre = $mysqlClient->prepare('select * from music_genre order by mgr_name asc');
$listGenre->execute();
$genres = $listGenre->fetchAll();

// recupere la liste des groupes
$listGroup = $mysqlClient->prepare('select g.grp_id, g.grp_name from groupe g order by g.grp_name asc');
$listGroup->execute();
$groups = $listGroup->fetchAll();
?>

<div class="form-check form-switch " id="grpdiv">
    <input class="form-check-input" type="checkbox" role="switch" name="groupCheck" id="groupCheck" onclick="groupCheck()">
    <label class="form-check-label" for="groupCheck">Groupe</label>
</div>
<div class="form-check form-switch" id="memdiv">
    <input class="form-check-input" type="checkbox" role="switch" name="memberCheck" id="memberCheck" onclick="memberCheck()">
    <label class="form-check-label" for="memberCheck">Musicien</label>
</div>
<div class="form-check form-switch" id="albdiv">
    <input class="form-check-input" type="checkbox" role="switch" name="albumCheck" id="albumCheck" onclick="albumCheck()">
    <label class="form-check-label" for="albumCheck" name="albumCheck" type="submit">Album</label>
</div>
<!-- FORMULAIRE AJOUT GROUPE -->
<div class="group_form_container" id="groupForm" style="display: none;">
    <h5 class="form_title">Ajouter un groupe</h5>
    <form action="creategroup/post_create_group.php" method="POST">
        <div class="mb-3">
            <label for="grp_name" class="form-label">Nom du groupe</label>
            <input type="text" class="form-control" id="grp_name" name="grp_name">
        </div>
        <div class="mb-3">
            <label for="grp_createdate" class="form-label">Date de création du groupe</label>
            <input type="date" class="form-control" id="grp_createdate" name="grp_createdate">
        </div>
        <div class="mb-3">
            <select name="mgr_id" class="form-select" aria-label="metal genre select">
                <option selected>Genre de musique</option>
                <?php
                foreach ($genres as $genre) {
                ?><option value="<?php echo $genre['mgr_id'] ?>"><?php echo $genre['mgr_name'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Confirmer</button>
    </form>
</div>
<!-- FORMULAIRE AJOUT MEMBRE -->
<div class="group_form_container" id="memberForm" style="display: none;">
    <h5 class="form_title">Ajouter un musicien</h5>
    <form action="creategroup/post_create_member.php" method="POST">
        <div class="mb-3">
            <label for="mbr_firstName" class="form-label">Prénom *</label>
            <input type="text" class="form-control" id="mbr_firstName" name="mbr_firstName">
        </div>
        <div class="mb-3">
            <label for="mbr_lastName" class="form-label">Nom *</label>
            <input type="text" class="form-control" id="mbr_lastName" name="mbr_lastName">
        </div>
        <div class="mb-3">
            <label for="mbr_nickname" class="form-label">Surnom *</label>
            <input type="text" class="form-control" id="mbr_nickname" name="mbr_nickname">
        </div>
        <div class="mb-3">
            <label for="mbr_birthdate" class="form-label">Date de naissance *</label>
            <input type="date" class="form-control" id="mbr_birthdate" name="mbr_birthdate">
        </div>
        <div class="mb-3">
            <select name="grp_id" class="form-select" aria-label="metal group select">
                <option selected>Groupe</option>
                <?php
                foreach ($groups as $group) {
                ?><option value="<?php echo $group['grp_id'] ?>"><?php echo $group['grp_name'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <select name="role" class="form-select" aria-label="metal group select">
                <option selected>Role</option>
                <option value="Guitare">Guitare</option>
                <option value="Basse">Basse</option>
                <option value="Chant">Chant</option>
                <option value="Batterie">Batterie</option>
                <option value="GuitareCh">Guitare + chant</option>
                <option value="BasseCh">Basse + chant</option>
                <option value="Autre">Autre</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="mbr_joinDate" class="form-label">Quand a-t-il rejoint le groupe *</label>
            <input type="date" class="form-control" id="mbr_joinDate" name="mbr_joinDate">
        </div>
        <button type="submit" class="btn btn-primary">Confirmer</button>
    </form>
</div>
<!-- FORMULAIRE AJOUT ALBUM -->
<div class="group_form_container" id="albumForm" style="display: none;">
    <h5 class="form_title">Ajouter un album</h5>
    <form action="creategroup/post_create_album.php" method="POST">
        <div class="mb-3">
            <label for="alb_name" class="form-label">Nom de l'album</label>
            <input type="text" class="form-control" id="alb_name" name="alb_name">
        </div>
        <div class="mb-3">
            <select name="grp_id" class="form-select" aria-label="metal group select">
                <option selected>Groupe</option>
                <?php
                foreach ($groups as $group) {
                ?><option value="<?php echo $group['grp_id'] ?>"><?php echo $group['grp_name'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="alb_createdate" class="form-label">Date de création de l'album</label>
            <input type="date" class="form-control" id="alb_createdate" name="alb_createdate">
        </div>
        <button type="submit" class="btn btn-primary">Confirmer</button>
    </form>
</div>

<!-- Script qui gere les checkbox  -->
<script>
    function groupCheck() {
        // checkbox
        var checkBox = document.getElementById("groupCheck");
        // affichage
        var form = document.getElementById("groupForm");
        // element à cacher
        var memdiv = document.getElementById("memdiv");
        var albdiv = document.getElementById("albdiv");
        var memberCheck = document.getElementById("memberCheck");
        var albumCheck = document.getElementById("albumCheck");
        var albumform = document.getElementById("albumForm");
        var memberform = document.getElementById("memberForm");

        if (checkBox.checked == true) {
            form.style.display = "block";
            memberCheck.checked = false;
            albumCheck.checked = false;
            memberform.style.display = "none";
            albumform.style.display = "none";
            memdiv.style.display = "none";
            albdiv.style.display = "none";
        } else {
            form.style.display = "none";
            memdiv.style.display = "block";
            albdiv.style.display = "block";
        }
    }

    function memberCheck() {
        // checkbox
        var checkBox = document.getElementById("memberCheck");
        // affichage
        var form = document.getElementById("memberForm");
        // element à cacher
        var grpdiv = document.getElementById("grpdiv");
        var albdiv = document.getElementById("albdiv");
        var groupCheck = document.getElementById("groupCheck");
        var albumCheck = document.getElementById("albumCheck");
        var groupform = document.getElementById("groupForm");
        var albumform = document.getElementById("albumForm");

        if (checkBox.checked == true) {
            form.style.display = "block";
            groupCheck.checked = false;
            albumCheck.checked = false;
            albumform.style.display = "none";
            groupform.style.display = "none";
            grpdiv.style.display = "none";
            albdiv.style.display = "none";
        } else {
            form.style.display = "none";
            grpdiv.style.display = "block";
            albdiv.style.display = "block";
        }
    }

    function albumCheck() {
        // checkbox
        var checkBox = document.getElementById("albumCheck");
        // affichage
        var form = document.getElementById("albumForm");
        // element à cacher
        var grpdiv = document.getElementById("grpdiv");
        var memdiv = document.getElementById("memdiv");
        var groupCheck = document.getElementById("groupCheck");
        var memberCheck = document.getElementById("memberCheck");
        var groupform = document.getElementById("groupForm");
        var memberform = document.getElementById("memberForm");

        if (checkBox.checked == true) {
            form.style.display = "block";
            groupCheck.checked = false;
            memberCheck.checked = false;
            groupform.style.display = "none";
            memberform.style.display = "none";
            grpdiv.style.display = "none";
            memdiv.style.display = "none";
        } else {
            form.style.display = "none";
            grpdiv.style.display = "block";
            memdiv.style.display = "block";
        }
    }
</script>