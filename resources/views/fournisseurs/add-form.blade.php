<form action="{{ route('fournisseurs.store') }}" id="addForm" method="POST">
        @csrf

        <div class="form-row">

            <!-- Nom -->
            <div class="form-group col-md-6">
                <label for="Nom">
                    Nom fournisseur <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="Nom"
                    id="Nom"
                    class="form-control @error('Nom') is-invalid @enderror"
                    value="{{ old('Nom') }}"
                    placeholder="Nom du fournisseur"
                    required
                >

                @error('Nom')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <!-- Type -->
            <div class="form-group col-md-6">
                <label for="Type">
                    Type fournisseur
                </label>

                <select
                    name="Type"
                    id="Type"
                    class="form-control @error('Type') is-invalid @enderror"
                >
                    <option value="">-- Sélectionner --</option>

                    <option value="Prestataire"
                    {{ old('Type')=='Prestataire' ? 'selected':'' }}>
                        Prestataire
                    </option>

                    <option value="Grossiste"
                    {{ old('Type')=='Grossiste' ? 'selected':'' }}>
                        Grossiste
                    </option>

                    <option value="Distributeur"
                    {{ old('Type')=='Distributeur' ? 'selected':'' }}>
                        Distributeur
                    </option>

                    <option value="Sous-traitant"
                    {{ old('Type')=='Sous-traitant' ? 'selected':'' }}>
                        Sous-traitant
                    </option>
                </select>

                @error('Type')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

        </div>


        <div class="form-row">

            <!-- Contact -->
            <div class="form-group col-md-6">
                <label for="Contact">
                    Personne Contact
                </label>

                <input
                    type="text"
                    name="Contact"
                    id="Contact"
                    class="form-control @error('Contact') is-invalid @enderror"
                    value="{{ old('Contact') }}"
                    placeholder="Nom du contact"
                >

                @error('Contact')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <!-- Téléphone -->
            <div class="form-group col-md-6">
                <label for="Telephone">
                    Téléphone <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="Telephone"
                    id="Telephone"
                    class="form-control @error('Telephone') is-invalid @enderror"
                    value="{{ old('Téléphone') }}"
                    placeholder="+225 XX XX XX XX"
                    required
                >

                @error('Telephone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

        </div>


        <div class="form-row">

            <!-- Email -->
            <div class="form-group col-md-6">
                <label for="Email">
                    Email
                </label>

                <input
                    type="email"
                    name="Email"
                    id="Email"
                    class="form-control @error('Email') is-invalid @enderror"
                    value="{{ old('Email') }}"
                    placeholder="email@domaine.com"
                >

                @error('Email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <!-- Etat -->
            <div class="form-group col-md-6">
                <label for="Etat">
                    Etat
                </label>

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

                    <option value="S"
                    {{ old('Etat')=='S' ? 'selected':'' }}>
                        Suspendu
                    </option>
                </select>

                @error('Etat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

        </div>


        <!-- Adresse -->
        <div class="form-group">
            <label for="Adresse">
                Adresse
            </label>

            <textarea
                name="Adresse"
                id="Adresse"
                rows="3"
                class="form-control @error('Adresse') is-invalid @enderror"
                placeholder="Adresse complète"
            >{{ old('Adresse') }}</textarea>

            @error('Adresse')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>


        <hr>

        <div class="text-right">
            <a href="{{ route('fournisseurs.index') }}"
                class="btn btn-secondary">
                Annuler
            </a>

            <button type="submit"
                    id="saveFournisseur" 
                    class="btn btn-primary">
                Enregistrer
            </button>
        </div>

    </form>
