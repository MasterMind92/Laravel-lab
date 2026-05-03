<form action="" id="addForm" method="POST">
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
                    <option value="0" selected>Initié</option>
                    <option value="3" >Non-livré</option>
                    <option value="2">Livré</option>
                    <option value="1">En cours</option>
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
                    <option value="I">Inactif</option>
                </select>
            </div>

        </div>

        <div class="card-footer text-right">
            <button  id="saveCmd" type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="" class="btn btn-secondary">Annuler</a>
        </div>
    </div>

</form>