<form id="addForm" 
      method="POST" 
      action="{{ isset($appartement) ? route('apartements.update', $appartement->AppartementID) : route('appartements.store') }}">

    @csrf

    @if(isset($appartement))
        @method('PUT')
    @endif

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
            <div class="input-group">
                <input 
                    class="form-control" 
                    type="text" 
                    name="Surface" 
                    id="Surface" 
                    placeholder="Recipient's text" 
                    aria-label="Recipient's text" 
                    aria-describedby="my-addon"
                    value="{{ $appartement->Surface ?? '' }}"
                />
                <div class="input-group-append">
                    <span class="input-group-text" id="my-addon">m²</span>
                </div>
            </div>
            
        </div>

        <div class="form-group col-md-4">
            <label for="Etage">A l'Etage ?</label>
            <select name="Etage" id="Etage" class="form-control" >
                <option value="0" selected>Non</option>
                <option value="1" >Oui</option>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label>Capacité Max (en personnes)*</label>
            <input type="number" class="form-control" name="CapaciteMax" id="CapaciteMax"
                value="{{ $appartement->CapaciteMax ?? 1 }}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Disponibilité p</label>
            <select class="form-control" name="Etat" id="Etat">
                <option value="">-- Choisir --</option>
                <option value="Disponible" {{ ($appartement->Etat ?? '') == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="Occupe" {{ ($appartement->Etat ?? '') == 'Occupe' ? 'selected' : '' }}>Occupé</option>
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

    <button type="submit" id="saveClient" class="btn btn-primary">
        {{ isset($appartement) ? 'Mettre à jour' : 'Enregistrer' }}
    </button>

</form>