<form method="POST">
    @csrf
    @method('PUT')

    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label for="Reference">Référence</label>
                <input type="text"
                       id="Reference"
                       name="Reference"
                       class="form-control"
                       value="">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Libelle">Libellé</label>
                <input type="text"
                       id="Libelle"
                       name="Libelle"
                       class="form-control"
                       value="">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Categorie">Catégorie</label>
                <input type="text"
                       id="Categorie"
                       name="Categorie"
                       class="form-control"
                       value="">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="QuantiteStock">Quantité en stock</label>
                <input type="number"
                       id="QuantiteStock"
                       name="QuantiteStock"
                       class="form-control"
                       value="">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="SeuilMin">Seuil minimum</label>
                <input type="text"
                       id="SeuilMin"
                       name="SeuilMin"
                       class="form-control"
                       value="">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="fkAppart">Appartement</label>

                <select id="fkAppart"
                        name="fkAppart"
                        class="form-control">

                    <option value="">Sélectionnez</option>

                    {{-- @foreach($appartements as $appartement)
                        <option value="{{ $appartement->AppartementID }}"
                            {{ $article->fkAppart == $appartement->AppartementID ? 'selected' : '' }}>
                            {{ $appartement->Libelle ?? $appartement->Nom ?? $appartement->AppartementID }}
                        </option>
                    @endforeach --}}

                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="fkCommande">Commande</label>

                <select id="fkCommande"
                        name="fkCommande"
                        class="form-control">

                    <option value="">Sélectionnez</option>

                    {{-- @foreach($commandes as $commande)
                        <option value="{{ $commande->CommandeID }}"
                            {{ $article->fkCommande == $commande->CommandeID ? 'selected' : '' }}>
                            {{ $commande->CommandeID }}
                        </option>
                    @endforeach --}}

                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="Localisation">Localisation</label>
                <input type="text"
                       id="Localisation"
                       name="Localisation"
                       class="form-control"
                       value="">
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
        Mettre à jour
    </button>
</form>