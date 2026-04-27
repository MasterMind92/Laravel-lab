<form action="{{ route('services.store') }}" method="POST">
    @csrf

    <div class="form-row">

        <!-- Code -->
        <div class="form-group col-md-6">
            <label for="Code">
                Code <span class="text-danger">*</span>
            </label>

            <input 
                type="text"
                name="Code"
                id="Code"
                class="form-control @error('Code') is-invalid @enderror"
                value="{{ old('Code') }}"
                placeholder="Ex: SRV001"
                required
            >

            @error('Code')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <!-- Catégorie -->
        <div class="form-group col-md-6">
            <label for="Categorie">
                Catégorie
            </label>

            <select 
                name="Categorie"
                id="Categorie"
                class="form-control @error('Categorie') is-invalid @enderror"
            >
                <option value="">-- Sélectionner --</option>
                <option value="Consultation"
                    {{ old('Categorie')=='Consultation' ? 'selected':'' }}>
                    Consultation
                </option>

                <option value="Maintenance"
                    {{ old('Categorie')=='Maintenance' ? 'selected':'' }}>
                    Maintenance
                </option>

                <option value="Installation"
                    {{ old('Categorie')=='Installation' ? 'selected':'' }}>
                    Installation
                </option>
            </select>

            @error('Categorie')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

    </div>


    <!-- Libellé -->
    <div class="form-group">
        <label for="Libelle">
            Libellé
        </label>

        <input
            type="text"
            name="Libelle"
            id="Libelle"
            class="form-control @error('Libelle') is-invalid @enderror"
            value="{{ old('Libelle') }}"
            placeholder="Nom du service"
        >

        @error('Libelle')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>


    <div class="form-row">

        <!-- Prix -->
        <div class="form-group col-md-6">
            <label for="PrixUnitaire">
                Prix Unitaire <span class="text-danger">*</span>
            </label>

            <input
                type="number"
                min="0"
                name="PrixUnitaire"
                id="PrixUnitaire"
                class="form-control @error('PrixUnitaire') is-invalid @enderror"
                value="{{ old('PrixUnitaire') }}"
                placeholder="0"
                required
            >

            @error('PrixUnitaire')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>


        <!-- Durée moyenne -->
        <div class="form-group col-md-6">
            <label for="DureeMoyenne">
                Durée Moyenne
            </label>

            <input
                type="text"
                name="DureeMoyenne"
                id="DureeMoyenne"
                class="form-control @error('DureeMoyenne') is-invalid @enderror"
                value="{{ old('DureeMoyenne') }}"
                placeholder="Ex: 2 heures"
            >

            @error('DureeMoyenne')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

    </div>


    <!-- Unité facturation -->
    <div class="form-group">
        <label for="UniteFacturation">
            Unité de Facturation <span class="text-danger">*</span>
        </label>

        <select
            name="UniteFacturation"
            id="UniteFacturation"
            class="form-control @error('UniteFacturation') is-invalid @enderror"
            required
        >
            <option value="">-- Sélectionner --</option>

            <option value="Heure"
                {{ old('UniteFacturation')=='Heure' ? 'selected':'' }}>
                Heure
            </option>

            <option value="Jour"
                {{ old('UniteFacturation')=='Jour' ? 'selected':'' }}>
                Jour
            </option>

            <option value="Forfait"
                {{ old('UniteFacturation')=='Forfait' ? 'selected':'' }}>
                Forfait
            </option>

            <option value="Unité"
                {{ old('UniteFacturation')=='Unité' ? 'selected':'' }}>
                Unité
            </option>
        </select>

        @error('UniteFacturation')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>


    <hr>

    <div class="text-right">
        <a href="{{ route('services.index') }}"
            class="btn btn-secondary">
            Annuler
        </a>

        <button type="submit" class="btn btn-primary">
            Enregistrer
        </button>
    </div>

</form>