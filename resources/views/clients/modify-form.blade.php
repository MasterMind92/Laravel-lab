<form method="POST" action="" id="form-modif" enctype="application/x-www-form-urlencoded">
    @csrf

    @method('PUT')

    <input type="hidden" name="ClientID" id="ClientID" />
    
    <div class="form-row">

        <!-- Nom -->
        <div class="form-group col-md-6">
            <label>Nom *</label>
            <input type="text" name="Nom" id="Nom" class="form-control" placeholder="Nom du client" required>
        </div>

        <!-- Prénom -->
        <div class="form-group col-md-6">
            <label>Prénom *</label>
            <input type="text" name="Prenom" id="Prenom" class="form-control" placeholder="Prénom du client" required>
        </div>

        <!-- Email -->
        <div class="form-group col-md-6">
            <label>Email</label>
            <input type="email" name="Email" id="Email" class="form-control" placeholder="email@example.com" required>
        </div>

        <!-- Téléphone -->
        <div class="form-group col-md-6">
            <label>Téléphone</label>
            <input type="text" name="Telephone" id="Telephone" class="form-control" placeholder="Ex: 0700000000" required>
        </div>

        <!-- Adresse -->
        <div class="form-group col-md-12">
            <label>Adresse</label>
            <input type="text" name="Adresse" id="Adresse" class="form-control" placeholder="Adresse complète" required>
        </div>

        <!-- Date de naissance -->
        <div class="form-group col-md-4">
            <label>Date de naissance</label>
            <input type="date" name="DateNaissance" id="DateNaissance" class="form-control" required>
        </div>

        <!-- Type Client -->
        <div class="form-group col-md-4">
            <label>Type Client</label>
            <select name="TypeClient" id="TypeClient" class="form-control" required>
                <option value="">-- Choisir --</option>
                <option value="Standard">Standard</option>
                <option value="Premium">Premium</option>
                <option value="VIP">VIP</option>
            </select>
        </div>

        <!-- Statut -->
        <div class="form-group col-md-4">
            <label>Statut</label>
            <select name="Statut" id="Statut" class="form-control" required>
                <option value="A">Actif</option>
                <option value="I">Inactif</option>
            </select>
        </div>

        <!-- Points fidélité -->
        <div class="form-group col-md-6">
            <label>Points Fidélité</label>
            <input type="number" name="PointsFidelite" id="PointsFidelite" class="form-control" value="0" min="0">
        </div>

    </div>

    <div class="d-flex justify-content-end">
        <button type="reset" data-dismiss="modal" aria-label="Close" class="btn btn-secondary mr-2">
            Annuler
        </button>
        <button type="submit" id="modifClient" class="btn btn-success">
            Modifier
        </button>
    </div>
    
</form>