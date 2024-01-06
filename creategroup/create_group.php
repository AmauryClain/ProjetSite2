<!-- FORMULAIRE GROUPE -->
<div class="group_form_container">

    <h5 class="form_title">Ajouter un groupe</h5>
    <form action="creategroup/post_create_group.php" method="POST">
        <div class="mb-3">
            <label for="grp_name" class="form-label">Nom du groupe</label>
            <input type="text" class="form-control" id="grp_name" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="grp_createdate" class="form-label">Date de création du groupe</label>
            <input type="date" class="form-control" id="grp_createdate">
        </div>
        <!-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> -->
        <button type="submit" class="btn btn-primary">Confirmer</button>
    </form>
</div>