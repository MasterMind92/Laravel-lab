<form id="form-modif" 
        method="POST"
        action="{{ isset($reservation) ? route('reservations.update', $reservation->ReservationID) : route('reservations.store') }}">

    @csrf

    @if(isset($reservation))
        @method('PUT')
    @endif


    {{-- <div class="modal-header">
        <h5 class="modal-title">
            {{ isset($reservation) ? 'Modifier réservation' : 'Nouvelle réservation' }}
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body"> --}}

        <input type="hidden" name="ReservationID" id="ReservationID"
                value="{{ $reservation->ReservationID ?? '' }}">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Numéro *</label>
                <input type="text" class="form-control" name="Numero" id="Numero"
                        value="{{ $reservation->Numero ?? '' }}">
            </div>

            <div class="form-group col-md-6">
                <label>Statut *</label>
                <select class="form-control" name="Statut" id="Statut">
                    <option value="">-- Choisir --</option>
                    <option value="1" {{ ($reservation->Statut ?? '') == '1' ? 'selected' : '' }}>En attente</option>
                    <option value="2" {{ ($reservation->Statut ?? '') == '2' ? 'selected' : '' }}>Confirmée</option>
                    <option value="3" {{ ($reservation->Statut ?? '') == '3' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Date arrivée *</label>
                <input type="datetime-local" class="form-control" name="DateArrivee" id="DateArrivee"
                        value="{{ isset($reservation->DateArrivee) ? date('Y-m-d\TH:i', strtotime($reservation->DateArrivee)) : '' }}">
            </div>

            <div class="form-group col-md-6">
                <label>Date départ *</label>
                <input type="datetime-local" class="form-control" name="DateDepart" id="DateDepart"
                        value="{{ isset($reservation->DateDepart) ? date('Y-m-d\TH:i', strtotime($reservation->DateDepart)) : '' }}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Adultes</label>
                <input type="number" class="form-control" name="NbAdultes" id="NbAdultes"
                        value="{{ $reservation->NbAdultes ?? 0 }}">
            </div>

            <div class="form-group col-md-3">
                <label>Enfants</label>
                <input type="number" class="form-control" name="NbEnfants" id="NbEnfants"
                        value="{{ $reservation->NbEnfants ?? 0 }}">
            </div>

            <div class="form-group col-md-6">
                <label>Source</label>
                <input type="text" class="form-control" name="Source" id="Source"
                        value="{{ $reservation->Source ?? '' }}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Client *</label>
                <select class="form-control" name="fkClient" id="fkClient">
                    <option value="">-- Choisir --</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->ClientID }}"
                            {{ ($reservation->fkClient ?? '') == $client->ClientID ? 'selected' : '' }}>
                            {{ $client->Nom }} {{ $client->Prenom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label>Appartement *</label>
                <select class="form-control" name="fkAppart" id="fkAppart">
                    <option value="">-- Choisir --</option>
                    @foreach($appartements as $appart)
                        <option value="{{ $appart->AppartementID }}"
                            {{ ($reservation->fkAppart ?? '') == $appart->AppartementID ? 'selected' : '' }}>
                            {{ $appart->Code }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Notes</label>
            <input type="number" class="form-control" name="Notes" id="Notes"
                    value="{{ $reservation->Notes ?? 0 }}">
        </div>

        <button type="submit" id="modifReserv" class="btn btn-primary">
            {{ isset($reservation) ? 'Mettre à jour' : 'Enregistrer' }}
        </button>

    {{-- </div> --}}

</form>