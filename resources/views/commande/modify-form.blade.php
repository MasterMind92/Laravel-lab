<form action="" id="form-modif" method="POST">
    @csrf

    <div class="card">
        {{-- <div class="card-header">
            <h4>Nouvelle Commande</h4>
        </div> --}}

        <input type="hidden" name="CommandeID" id="CommandeID">

        <div class="card-body">

            <div class="form-group">
                <label>Reference Commande *</label>
                <input type="text" class="form-control" name="Reference" id="Reference" value="" required readonly>
            </div>

            <div class="form-group">
                <label for="DateCommande">Date de commande</label>
                <input type="datetime-local" name="DateCommande" id="DateCommande" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="DateLivraisonPrévue">Date de livraison prévue</label>
                <input type="datetime-local" name="DateLivraisonPrévue" id="DateLivraisonPrévue" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="DateLivraisonRéelle">Date de livraison réelle</label>
                <input type="datetime-local" name="DateLivraisonRéelle" id="DateLivraisonRéelle" class="form-control">
            </div>

            <div class="form-group">
                <label for="Statut">Statut</label>
                <select name="Statut" id="Statut" inert class="form-control">
                    <option value="3">Non-livré</option>
                    <option value="2">Livré</option>
                    <option value="1">En cours</option>
                    <option value="0">Initié</option>
                </select>
            </div>

            <div class="form-group">
                <label for="MontantTotal">Montant total</label>
                <input type="number" name="MontantTotal" id="MontantTotal" class="form-control" min="0" required>
            </div>

            <div class="form-group">
                <label for="Etat">État</label>
                <select name="Etat" id="Etat" class="form-control">
                    <option value="A" selected >Actif</option>
                    <option value="I">Annulé</option>
                </select>
            </div>

        </div>

        <div class="card-footer text-right">
            <button id="modifReserv" type="submit" class="btn btn-primary">Enregistrer</button>
            <button data-dismiss="modal" class="btn btn-secondary">Annuler</button>
        </div>
    </div>

</form>