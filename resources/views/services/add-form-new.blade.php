<form action="" method="POST" id="addForm">
    @csrf

    <div class="form-group">
        <label for="Code">Code</label>
        <input type="text" class="form-control" id="Code" name="Code">
    </div>

    <div class="form-group">
        <label for="Libelle">Libellé</label>
        <input type="text" class="form-control" id="Libelle" name="Libelle">
    </div>

    <div class="form-group">
        <label for="Categorie">Catégorie</label>
        <input type="text" class="form-control" id="Categorie" name="Categorie">
    </div>

    <div class="form-group">
        <label for="PrixUnitaire">Prix Unitaire</label>
        <input type="number" class="form-control" id="PrixUnitaire" name="PrixUnitaire">
    </div>

    <div class="form-group">
        <label for="DureeMoyenne">Durée Moyenne</label>
        <input type="text" class="form-control" id="DureeMoyenne" name="DureeMoyenne">
    </div>

    <div class="form-group">
        <label for="UniteFacturation">Unité de Facturation</label>
        <input type="text" class="form-control" id="UniteFacturation" name="UniteFacturation">
    </div>

    <button type="submit" class="btn btn-primary">
        Enregistrer
    </button>
</form>

<script>
$(document).ready(function () {

    $("#formServiceCreate").validate({
        rules: {
            Code: {
                required: true
            },
            Libelle: {
                required: false
            },
            Categorie: {
                required: false
            },
            PrixUnitaire: {
                required: true,
                number: true
            },
            DureeMoyenne: {
                required: false
            },
            UniteFacturation: {
                required: true
            }
        },
        messages: {
            Code: {
                required: "Le code est obligatoire."
            },
            PrixUnitaire: {
                required: "Le prix unitaire est obligatoire.",
                number: "Veuillez entrer un nombre valide."
            },
            UniteFacturation: {
                required: "L'unité de facturation est obligatoire."
            }
        },
        errorElement: 'small',
        errorClass: 'text-danger'
    });

});
</script>