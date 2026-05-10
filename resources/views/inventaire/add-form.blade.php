<form method="POST">
    @csrf

    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label for="Reference">Référence</label>
                <input type="text"
                       class="form-control"
                       id="ArticleID"
                       name="Reference">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Libelle">Libellé</label>
                <input type="text"
                       class="form-control"
                       name="Libelle">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Categorie">Catégorie</label>
                <input type="text"
                       class="form-control"
                       name="Categorie">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="QuantiteStock">Quantité en stock</label>
                <input type="number"
                       class="form-control"
                       name="QuantiteStock"
                       value="0">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="SeuilMin">Seuil minimum</label>
                <input type="text"
                       class="form-control"
                       name="SeuilMin"
                       value="0">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="fkAppart">Appartement</label>

                <select class="form-control"
                        name="fkAppart">

                    <option value="">Sélectionnez</option>

                    @foreach($appartements as $appartement)
                        <option value="{{ $appartement->AppartementID }}">
                            {{ $appartement->Code }}
                        </option>
                    @endforeach

                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="fkCommande">Commande</label>

                <select class="form-control"
                        name="fkCommande">

                    <option value="">Sélectionnez</option>

                    @foreach($commandes as $commande)
                        <option value="{{ $commande->CommandeID }}">
                            {{ $commande->CommandeID }}
                        </option>
                    @endforeach

                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Localisation">Localisation</label>
                <input type="text"
                       class="form-control"
                       name="Localisation">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Etat">Etat</label>
                <select
                    name="Etat"
                    id="Etat"
                    class="form-control @error('Etat') is-invalid @enderror"
                >
                    <option value="">-- Sélectionner --</option>

                    <option value="A"
                    {{ old('Etat')=='A' ? 'selected':'' }}>
                        Actif
                    </option>

                    <option value="I"
                    {{ old('Etat')=='I' ? 'selected':'' }}>
                        Inactif
                    </option>

                </select>
            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-primary">
        Enregistrer
    </button>
</form>