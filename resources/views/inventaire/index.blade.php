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
            <form id="filterForm"  method="POST" class="row align-items-end" action= {{route("inventaire.search")}}>
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
                    <select id="etat" name="Statut" class="form-control">
                        <option @if(!session('Statut')) selected @endif value="">Tous</option>
                        <option @if(session('Statut')=="A") selected  @endif value="A">Actif</option>
                        <option @if(session('Statut')=="I") selected @endif value="I">Inactif</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <button type="submit" id="btnFilter" class="btn btn-primary">
                        Rechercher
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- 📊 SECTION TABLE -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Gestion des {{$title['label']}}</h5>

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

                    
                </tbody>
            </table>
        </div>
    </div>

    

<!-- 🧾 MODAL AJOUT -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter {{$title['label']}}</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                @include('inventaire.add-form')
            </div>

        </div>
    </div>
</div>



<!-- 📋 MODAL DETAILS -->
<div class="modal fade" id="modal-details">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Détails {{$title['label']}}</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="detailContent">
                 @include('inventaire.modify-form')
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
    let table = $('#clientTable').DataTable({
        "ajax": {
            "url": "{{route('inventaire.list')}}",
            "type": "POST",
            headers: {
                'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
            },
            "data":function(data) {
                data.date_debut = $('#date_debut').val();
                data.date_fin = $('#date_fin').val();
                data.etat = $('#etat').val();
            },
        },
    });


    $("#clientTable").delegate("button[name='activer']","click",function(){
        
        let id = $(this).attr("data-id");

        swal({
            title: "Confirmer ?",
            text: "Activer cet {élément}",
            icon: "warning",
            showCancelButton: true

        }).then(result => {

            if (result) {
                
                let options = {
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('inventaire.state', ['state'=>true]) }}",
                    data: {id:id},
                    dataType: "json",
                    success: function (response) {

                        console.log(response);
                    
                        $('#addModal').modal('hide');

                        if (response.status) {
                            swal("Succès", response.msg, "success");
                        }else{
                            swal("Echec", response.msg, "warning");
                        }
                    
                        table.ajax.reload();
                    }
                };

                $.ajax(options);

            }
        });
    });

    $("#clientTable").delegate("button[name='desactiver']","click",function(){

        let id = $(this).attr("data-id");

        console.log(id);
        
        swal({
            title: "Confirmer ?",
            text: "Desactiver cet {élément}",
            icon: "warning",
            showCancelButton: true
        }).then(result => {

            if (result) {
                
                let options = {
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('inventaire.state', ['state' => 0]) }}",
                    data: {id:id},
                    dataType: "json",
                    success: function (response) {

                        console.log(response);

                        $('#addModal').modal('hide');

                        if (response.status) {
                            swal("Succès", response.msg, "success");
                        }else{
                            swal("Echec", response.msg, "warning");
                        }
                    
                        table.ajax.reload();

                    }
                };

                $.ajax(options);

                
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
    $('#btnAdd').click(function(){
        // generation et insertion de l'id
        let options = {
            url: "{{ route('inventaire.generate.id') }} ",
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {},
            success: function (response) {
                //apres avoir recuperer la reponse
                console.log(response);
                
                // injecter celle-ci dans le champ code
                $("#ArticleID").val(response.data.ID);

            },
        };
        // execution requete ajax
        $.ajax(options);


        $('#addModal').modal('show')

    });

    // 💾 MODIFIER CLIENT
    $('#modifClient').click(function (e) {
        e.preventDefault();

        swal({
            title: "Confirmer ?",
            text: "Modifier ce client",
            icon: "warning",
            showCancelButton: true

        }).then(result => {
            
            // console.log(result,result.isConfirmed);
            
            if (result) {

                let id = $('#form-modif').find('input[name="ClientID"]').val();

                var options = {
                    url: `/clients/${id}`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#form-modif').serialize() + '&_method=PUT',
                    success: function (response) {
                        $('#modal-details').modal('hide');
                        table.ajax.reload();

                        if(response.status){
                            swal("Information", response.msg, "success");

                        }else{

                            swal("Information", response.msg, "warning");
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr.responseJSON);
                    }
                };

                $.ajax(options);

            }
        });
    });

    // 💾 ENREGISTRER CLIENT
    $('#saveClient').click(function (e) {
        e.preventDefault();

        swal({
            title: "Confirmer ?",
            text: "Ajouter ce client",
            icon: "warning",
            showCancelButton: true

        }).then(result => {
            
            // console.log(result,result.isConfirmed);
            
            if (result) {

                var options = {
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('inventaire.store') }}",
                    data: $('#addForm').serialize(),
                    dataType: "json",
                    success: function (response) {
                        console.log(response);

                        $('#addModal').modal('hide');
                        table.ajax.reload();

                        if(response.status){
                            swal("Information", response.msg, "success");

                        }else{

                            swal("Information", response.msg, "warning");
                        }
                
                        
                    }
                };

                $.ajax(options);

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

    function fillForm(formId, data) {
        console.log(formId, data);
        
        $(`#${formId} :input`).each(function() {

            let id = $(this).attr('id');
            let type = $(this).attr('type');

            if (!id || data[id] === undefined) return;

            if (type === 'checkbox') {
                $(this).prop('checked', data[id]);
            } 
            else if (type === 'radio') {
                if ($(this).val() == data[id]) {
                    $(this).prop('checked', true);
                }
            } 
            else {
                $(this).val(data[id]);
            }
        });
    }

    // 🔄 ACTIVER / DESACTIVER
    $('#clientTable').on('click', 'button[name="details"]', function () {

        let id = $(this).data('id');

        // effectuer une requete ajax
        // pour recuperer les infos du client
        // en fonction de l'id 

        var options = {
            type: "get",
            headers: {
                'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
            },
            url: `/clients/${id}`,
            data: {'id':id},
            dataType: "json",
            success: function (data) {
                console.log(data);

                fillForm("form-modif", data.data);
            }
        };

        $.ajax(options);

        

        // swal({
        //     title: "Changer statut ?",
        //     icon: "question",
        //     showCancelButton: true
        // }).then(result => {
        //     if (result.isConfirmed) {

        //         $.post(`/clients/toggle/${id}`, {_token: "{{ csrf_token() }}"}, function () {

        //             table.ajax.reload();
        //             swal("Succès", "Statut modifié", "success");
        //         });
        //     }
        // });
    });

    

});
</script>   

@endsection