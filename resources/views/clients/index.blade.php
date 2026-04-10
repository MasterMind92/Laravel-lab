@extends('layouts.horizontal-master')
@section('main-content')
<div class="breadcrumb">
    <h1>
        @isset($title)
        {{$title['label']}}
        @endisset
    </h1>
    <ul>
        
        <li>
            @isset($title)
                <a href="{{$title['link']}}">{{$title['label']}}</a>
            @endisset
        </li>
        <li>
           @isset($title)
            <li>
                {{$title['label']}}
            </li>
            @endisset
        </li>
    </ul>

</div>

<div class="separator-breadcrumb border-top"></div>
{{-- end of breadcrumb --}}

    <!-- 🔍 FORMULAIRE DE RECHERCHE -->

    <div class="card mb-4">
        <div class="card-body">
            <form id="filterForm" class="row align-items-end">

                <div class="col-md-3">
                    <label>Date début</label>
                    <input type="date" id="date_debut" class="form-control" value="{{session('dateDeb')}}">
                </div>

                <div class="col-md-3">
                    <label>Date fin</label>
                    <input type="date" id="date_fin" class="form-control" value="{{session('dateFin')}}">
                </div>

                <div class="col-md-3">
                    <label>Etat</label>
                    <select id="etat" class="form-control">
                        <option @if(session('etat') == "0")selected @endif value="">Tous</option>
                        <option @if(session('etat')=="A")selected  @endif value="Actif">Actif</option>
                        <option @if(session('etat')=="I")selected @endif value="Inactif">Inactif</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <button type="button" id="btnFilter" class="btn btn-primary">
                        Rechercher
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- 📊 SECTION TABLE -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Gestion des Clients</h5>

            <button class="btn btn-primary" id="btnAdd" data-toggle="modal" data-target="#addModal">
                ➕ Ajouter
            </button>
        </div>

        <div class="card-body">
            <table id="clientTable" class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        @foreach($columns as $col)
                            <th>{{ $col}}</th>
                        @endforeach
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($clients as $item)
                        <tr>
                            <td>{{$item['ClientID']}}</td>
                            <td>{{$item['Nom']}}</td>
                            <td>{{$item['Telephone']}}</td>
                            <td>{{$item['Email']}}</td>
                            <td>{{$item['TypeClient']}}</td>
                            <td> <span class="badge badge-pill badge-primary">{{$item['Statut']}}</span> </td>
                            <td>{{$item['created_at']}}</td>
                            <td>
                                <button class="btn btn-warning" title="Details" data-toggle="modal" data-target="#modal-details" data-id="{{$item['ClientID']}}"  type="button"> <i class="i-Pen"></i> Details</button>
                                <button class="btn btn-primary" name="activer"  title="Activer" data-id="{{$item['ClientID']}}" type="button">Activer</button>
                                <button class="btn btn-danger"  name="desactiver" title="Desactiver"  data-id="{{$item['ClientID']}}" type="button">Desactiver</button>
                            </td>
                        </tr>
                    @endforeach
                    
                    {{-- <tr>
                        <td>2</td>
                        <td>Dalo</td>
                        <td>0747427163</td>
                        <td>dalomarc@gmail.com</td>
                        <td>Admin</td>
                        <td> <span class="badge badge-pill badge-primary">Activé</span> </td>
                        <td>2025-03-02</td>
                        <td>
                            <button class="btn btn-warning" title="Details" data-toggle="modal" data-target="#modal-details" type="button"> <i class="i-Pen"></i> Details</button>
                            <button class="btn btn-primary" title="Activer" type="button">Activer</button>
                            <button class="btn btn-danger" title="Desactiver"  type="button">Desactiver</button>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>

    

<!-- 🧾 MODAL AJOUT -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter Client</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                @include('clients.add-form')
            </div>

        </div>
    </div>
</div>

<!-- 🧾 MODAL AJOUT -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter Client</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                @include('clients.add-form')
            </div>

        </div>
    </div>
</div>

<!-- 📋 MODAL DETAILS -->
<div class="modal fade" id="modal-details">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Détails Client</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="detailContent">
                 @include('clients.modify-form')
            </div>

            
        </div>
    </div>
</div>

@endsection

@section('page-js')
<script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script> 
<script src="{{asset('assets/js/sweetalert.script.js')}}"></script> 
<script>
$(function () {

    // 📊 DATATABLE
    let table = $('#clientTable').DataTable();


    $("#clientTable").delegate("button[name='activer']","click",function(){
        
        let id = $(this).attr("data-id");
        swal({
            title: "Confirmer ?",
            text: "Activer cet {élément}",
            icon: "warning",
            showCancelButton: true
        }).then(result => {

            if (result.isConfirmed) {

                $.get("{{ route('clients.activate') }}", {id:id,"activer":true}, function (data) {
                    console.log(data);
                    
                    $('#addModal').modal('hide');
                    table.ajax.reload();

                    Swal.fire("Succès", "Client ajouté", "success");
                });
            }
        });
    });

    $("#clientTable").delegate("button[name='desactiver']","click",function(data){
        console.log(data);
        let id = $(this).attr("data-id");

        swal({
            title: "Confirmer ?",
            text: "Desactiver cet {élément}",
            icon: "warning",
            showCancelButton: true
        }).then(result => {

            if (result.isConfirmed) {

                $.post("{{ route('clients.store') }}", {id:id,"activer":false} , function () {

                    $('#addModal').modal('hide');
                    table.ajax.reload();

                    Swal.fire("Succès", "Client ajouté", "success");
                });
            }
        });
    });
    //BOUTON ACTIVER
    let btnActive = $("button[name='activer']");

    let btnUnactive = $("button[name='desactiver']");

    // BOUTON DESACTIVER


    // 🔍 FILTRE
    $('#btnFilter').click(() => table.ajax.reload());

    // ➕ OUVRIR MODAL AJOUT
    $('#btnAdd').click(() => $('#addModal').modal('show'));

    // 💾 ENREGISTRER CLIENT
    $('#saveClient').click(function () {

        swal({
            title: "Confirmer ?",
            text: "Ajouter ce client",
            icon: "warning",
            showCancelButton: true
        }).then(result => {
            if (result.isConfirmed) {

                $.post("{{ route('clients.store') }}", $('#addForm').serialize(), function () {

                    $('#addModal').modal('hide');
                    table.ajax.reload();

                    Swal.fire("Succès", "Client ajouté", "success");
                });
            }
        });
    });

    // 📋 DETAILS
    $('#clientTable').on('click', '.btnDetail', function () {

        let id = $(this).data('id');

        $.get(`/clients/${id}`, function (data) {

            $('#detailContent').html(`
                <p><strong>Nom:</strong> ${data.nom}</p>
                <p><strong>Email:</strong> ${data.email}</p>
            `);

            $('#detailModal').modal('show');
        });
    });

    // 🔄 ACTIVER / DESACTIVER
    $('#clientTable').on('click', '.btnToggle', function () {

        let id = $(this).data('id');

        Swal.fire({
            title: "Changer statut ?",
            icon: "question",
            showCancelButton: true
        }).then(result => {
            if (result.isConfirmed) {

                $.post(`/clients/toggle/${id}`, {_token: "{{ csrf_token() }}"}, function () {

                    table.ajax.reload();
                    Swal.fire("Succès", "Statut modifié", "success");
                });
            }
        });
    });

});
</script>   

@endsection