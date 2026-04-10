<form method="POST" action="" enctype="application/x-www-form-urlencoded">
    @csrf

    <div class="form-row">

        <!-- Nom -->
        <div class="form-group col-md-6">
            <label>Nom *</label>
            <input type="text" name="Nom" id="" class="form-control" placeholder="Nom du client" required>
        </div>

        <!-- Prénom -->
        <div class="form-group col-md-6">
            <label>Prénom *</label>
            <input type="text" name="Prenom" id="" class="form-control" placeholder="Prénom du client" required>
        </div>

        <!-- Email -->
        <div class="form-group col-md-6">
            <label>Email</label>
            <input type="email" name="Email" id="" class="form-control" placeholder="email@example.com" required>
        </div>

        <!-- Téléphone -->
        <div class="form-group col-md-6">
            <label>Téléphone</label>
            <input type="text" name="Telephone" id="" class="form-control" placeholder="Ex: 0700000000" required>
        </div>

        <!-- Adresse -->
        <div class="form-group col-md-12">
            <label>Adresse</label>
            <input type="text" name="Adresse" id="" class="form-control" placeholder="Adresse complète" required>
        </div>

        <!-- Date de naissance -->
        <div class="form-group col-md-4">
            <label>Date de naissance</label>
            <input type="date" name="DateNaissance" id="" class="form-control" required>
        </div>

        <!-- Type Client -->
        <div class="form-group col-md-4">
            <label>Type Client</label>
            <select name="TypeClient" id="" class="form-control" required>
                <option value="">-- Choisir --</option>
                <option value="Standard">Standard</option>
                <option value="Premium">Premium</option>
                <option value="VIP">VIP</option>
            </select>
        </div>

        <!-- Statut -->
        <div class="form-group col-md-4">
            <label>Statut</label>
            <select name="Statut" id="" class="form-control" required>
                <option value="Actif">Actif</option>
                <option value="Inactif">Inactif</option>
            </select>
        </div>

        <!-- Points fidélité -->
        <div class="form-group col-md-6">
            <label>Points Fidélité</label>
            <input type="number" name="PointsFidelite" id="" class="form-control" value="0" min="0">
        </div>

    </div>

    <div class="d-flex justify-content-end">
        <button type="reset" data-dismiss="modal" aria-label="Close" class="btn btn-secondary mr-2">
            Annuler
        </button>
        <button type="submit" class="btn btn-success">
            Modifier
        </button>
    </div>
    
</form>