<form action="" method="POST" id="form-modify">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="Code">Code</label>
        <input type="text" class="form-control" id="Code" name="Code" value="{{ $service->Code }}">
    </div>

    <div class="form-group">
        <label for="Libelle">Libellé</label>
        <input type="text" class="form-control" id="Libelle" name="Libelle" value="{{ $service->Libelle }}">
    </div>

    <div class="form-group">
        <label for="Categorie">Catégorie</label>
        <input type="text" class="form-control" id="Categorie" name="Categorie" value="{{ $service->Categorie }}">
    </div>

    <div class="form-group">
        <label for="PrixUnitaire">Prix Unitaire</label>
        <input type="number" class="form-control" id="PrixUnitaire" name="PrixUnitaire" value="{{ $service->PrixUnitaire }}">
    </div>

    <div class="form-group">
        <label for="DureeMoyenne">Durée Moyenne</label>
        <input type="text" class="form-control" id="DureeMoyenne" name="DureeMoyenne" value="{{ $service->DureeMoyenne }}">
    </div>

    <div class="form-group">
        <label for="UniteFacturation">Unité de Facturation</label>
        <input type="text" class="form-control" id="UniteFacturation" name="UniteFacturation" value="{{ $service->UniteFacturation }}">
    </div>

    <button type="submit" class="btn btn-primary">
        Modifier
    </button>
</form>

<script>
$(document).ready(function () {

    $("#formServiceEdit").validate({
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