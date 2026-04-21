<form method="POST" action="" id="modifAppart" enctype="application/x-www-form-urlencoded">
    @csrf

    @method('PUT')

    <input type="hidden" name="AppartementID" id="AppartementID" />
    
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Code *</label>
            <input type="text" class="form-control" name="Code" id="Code"
                value="{{ $appartement->Code ?? '' }}">
        </div>

        <div class="form-group col-md-6">
            <label>Type</label>
            <input type="text" class="form-control" name="Type" id="Type"
                value="{{ $appartement->Type ?? '' }}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Surface</label>
            <input type="text" class="form-control" name="Surface" id="Surface"
                value="{{ $appartement->Surface ?? '' }}">
        </div>

        <div class="form-group col-md-4">
            <label>Etage</label>
            <input type="text" class="form-control" name="Etage" id="Etage"
                value="{{ $appartement->Etage ?? '' }}">
        </div>

        <div class="form-group col-md-4">
            <label>Capacité Max *</label>
            <input type="number" class="form-control" name="CapaciteMax" id="CapaciteMax"
                value="{{ $appartement->CapaciteMax ?? 1 }}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Etat</label>
            <select class="form-control" name="Etat" id="Etat">
                <option value="">-- Choisir --</option>
                <option value="Disponible" {{ ($appartement->Etat ?? '') == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="Occupé" {{ ($appartement->Etat ?? '') == 'Occupé' ? 'selected' : '' }}>Occupé</option>
                <option value="Maintenance" {{ ($appartement->Etat ?? '') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label>Dernier nettoyage *</label>
            <input type="datetime-local" class="form-control" name="DernierNettoyage" id="DernierNettoyage"
                value="{{ isset($appartement->DernierNettoyage) ? date('Y-m-d\TH:i', strtotime($appartement->DernierNettoyage)) : '' }}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Date dernière rénovation *</label>
            <input type="datetime-local" class="form-control" name="DateDerniereRenovation" id="DateDerniereRenovation"
                value="{{ isset($appartement->DateDerniereRenovation) ? date('Y-m-d\TH:i', strtotime($appartement->DateDerniereRenovation)) : '' }}">
        </div>

        <div class="form-group col-md-6">
            <label>Observations</label>
            <textarea class="form-control" name="Observations" id="Observations">{{ $appartement->Observations ?? '' }}</textarea>
        </div>
    </div>

    <button type="submit" id="saveAppart" class="btn btn-primary">
        {{ isset($appartement) ? 'Mettre à jour' : 'Enregistrer' }}
    </button>
    
</form>