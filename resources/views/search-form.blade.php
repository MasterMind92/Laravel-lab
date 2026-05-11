
<form id="filterForm"  method="POST" class="row align-items-end" action= {{$search['route']}}>
    @csrf
    <div class="col-md-3">
        <label>Date début</label>
        <input type="date" id="date_debut" name="dateDeb" class="form-control" value="{{session('dateDeb')}}">
    </div>

    <div class="col-md-3">
        <label>Date fin</label>
        <input type="date" id="date_fin" name="dateFin" class="form-control" value="{{session('dateFin')}}">
    </div>

    <div class="col-md-3">
        <label>Etat</label>
        <select id="etat" name="@isset($search['name']) {{$search['name']}} @endisset @empty($search['name']) Etat @endempty" class="form-control">
            @isset($search['values'])

                <option @if(session($search['name']) == "0") selected @endif value="">Tous</option>

                @foreach ($search['values'] as $item)

                <option @if(session($search['name']) == $item['value']) selected  @endif value="{{$item['value']}}">{{$item['lib']}}</option>
                   
                @endforeach
            @endisset
        </select>
    </div>

    <div class="col-md-3">
        <button type="submit" id="btnFilter" class="btn btn-primary">
            Rechercher
        </button>
    </div>

</form>