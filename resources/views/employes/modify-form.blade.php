<form id="form-modif"  action="" method="POST">

    @csrf

    @method('PUT')

    <input type="hidden" name="EmployeID" id="EmployeID" value="">

    <div class="form-row">
        <!-- Matricule -->
        <div class="form-group col-md-6">
            <label for="Matricule">Matricule</label>
            <input type="text" name="Matricule" id="Matricule" class="form-control"
                value="{{ old('Matricule', $employe->Matricule ?? '') }}" required>
        </div>

        <!-- Nom -->
        <div class="form-group col-md-6">
            <label for="Nom">Nom</label>
            <input type="text" name="Nom" id="Nom" class="form-control"
                value="{{ old('Nom', $employe->Nom ?? '') }}" required>
        </div>
    </div>

    <div class="form-row">
        <!-- Prénom -->
        <div class="form-group col-md-6">
            <label for="Prénom">Prénom</label>
            <input type="text" name="Prenom" id="Prenom" class="form-control"
                value="{{ old('Prénom', $employe->Prénom ?? '') }}" required>
        </div>

        <!-- Poste -->
        <div class="form-group col-md-6">
            <label for="Poste">Poste</label>
            <input type="text" name="Poste" id="Poste" class="form-control"
                value="{{ old('Poste', $employe->Poste ?? '') }}">
        </div>
    </div>

    <div class="form-row">
        <!-- Email -->
        <div class="form-group col-md-6">
            <label for="Email">Email</label>
            <input type="email" name="Email" id="Email" class="form-control"
                value="{{ old('Email', $employe->Email ?? '') }}">
        </div>

        <!-- Telephone -->
        <div class="form-group col-md-6">
            <label for="Telephone">Telephone</label>
            <input type="text" name="Telephone" id="Telephone" class="form-control"
                value="{{ old('Telephone', $employe->Telephone ?? '') }}">
        </div>
    </div>

    <div class="form-row">
        <!-- Date Embauche -->
        <div class="form-group col-md-6">
            <label for="DateEmbauche">Date d'embauche</label>
            <input type="datetime-local" name="DateEmbauche" id="DateEmbauche" class="form-control"
                value="{{ old('DateEmbauche', isset($employe->DateEmbauche) ? date('Y-m-d\TH:i', strtotime($employe->DateEmbauche)) : '') }}">
        </div>

        <!-- Statut -->
        <div class="form-group col-md-6">
            <label for="Statut">Statut</label>
            <select name="Statut" id="Statut" class="form-control">
                <option value="">-- Sélectionner --</option>
                <option value="A" {{ old('Statut', $employe->Statut ?? '') == 'A' ? 'selected' : '' }}>Actif</option>
                <option value="I" {{ old('Statut', $employe->Statut ?? '') == 'I' ? 'selected' : '' }}>Inactif</option>
            </select>
        </div>
    </div>

    <div class="form-group text-right">
        <button type="submit" id="modifEmploye" class="btn btn-primary">
            {{ isset($employe) ? 'Mettre à jour' : 'Enregistrer' }}
        </button>
    </div>

</form>