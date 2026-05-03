<form action="" id="form-modif" method="POST">
    @csrf

    <div class="card">
        <div class="card-header">
            <h4>Nouvelle Commande</h4>
        </div>

        <div class="card-body">

            <div class="form-group">
                <label for="DateCommande">Date de commande</label>
                <input type="datetime-local" name="DateCommande" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="DateLivraisonPrévue">Date de livraison prévue</label>
                <input type="datetime-local" name="DateLivraisonPrévue" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="DateLivraisonRéelle">Date de livraison réelle</label>
                <input type="datetime-local" name="DateLivraisonRéelle" class="form-control">
            </div>

            <div class="form-group">
                <label for="Statut">Statut</label>
                <select name="Statut" class="form-control">
                    <option value="Non-livré" selected>Non-livré</option>
                    <option value="Livré">Livré</option>
                    <option value="En cours">En cours</option>
                </select>
            </div>

            <div class="form-group">
                <label for="MontantTotal">Montant total</label>
                <input type="number" name="MontantTotal" class="form-control" min="0" required>
            </div>

            <div class="form-group">
                <label for="Etat">État</label>
                <select name="Etat" class="form-control">
                    <option value="A">Actif</option>
                    <option value="Aé">Annulé</option>
                </select>
            </div>

        </div>

        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="#" class="btn btn-secondary">Annuler</a>
        </div>
    </div>

</form>