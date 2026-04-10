@extends('layouts.master')
@section('main-content')
<div class="breadcrumb">
    <h1>Blank Page</h1>
    <ul>
        <li><a href="">UI Kits</a></li>
        <li>Blank Page</li>
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
                    <input type="date" id="date_debut" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Date fin</label>
                    <input type="date" id="date_fin" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Etat</label>
                    <select id="etat" class="form-control">
                        <option value="">Tous</option>
                        <option value="Actif">Actif</option>
                        <option value="Inactif">Inactif</option>
                        <option value="Supprime">Supprimé</option>
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

            <button class="btn btn-primary" id="btnAdd">
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
                    <tr>
                        <td>1</td>
                        <td>Dalo</td>
                        <td>0747427163</td>
                        <td>dalomarc@gmail.com</td>
                        <td>Admin</td>
                        <td>2025-03-02</td>
                        <td>
                            {{-- <button class="btn btn-primary" type="button">Text</button> --}}
                            {{-- <button class="btn btn-danger" type="button">Text</button>
                            <button class="btn btn-warning" type="button">Text</button> --}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


<!-- 🧾 MODAL AJOUT -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Ajouter Client</h5>
            </div>

            <div class="modal-body">
                <form id="addForm">
                    @csrf
                    <input type="text" name="nom" class="form-control mb-2" placeholder="Nom" required>
                    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button class="btn btn-success" id="saveClient">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<!-- 📋 MODAL DETAILS -->
<div class="modal fade" id="detailModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Détails Client</h5>
            </div>

            <div class="modal-body" id="detailContent"></div>

            <div class="modal-footer">
                <button class="btn btn-warning" id="btnEdit">Modifier</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-js')
<script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
<script src="{{asset('assets/js/datatables.script.js')}}"></script> 
<script>
$(function () {

    // 📊 DATATABLE
    let table = $('#clientTable').DataTable({
        processing: true,
        //serverSide: true,
        // ajax: {
        //     url: "{{ route('clients.list') }}",
        //     data: function (d) {
        //         d.date_debut = $('#date_debut').val();
        //         d.date_fin = $('#date_fin').val();
        //         d.etat = $('#etat').val();
        //     }
        // },
        columns: [
            @foreach($columns as $col)
                { data: "{{ $col }}" },
            @endforeach
            {
                data: 'id',
                render: function (data, type, row) {
                    return `
                        <button title="Modifier" class="btn btn-info btn-sm btnDetail" data-id="${data}">📋</button>
                        <button title="Modifier" class="btn btn-${row.etat === 'Actif' ? 'danger' : 'success'} btn-sm btnToggle" data-id="${data}">
                            ${row.etat === 'Actif' ? '👎' : '👍'}
                        </button>
                    `;
                }
            }
        ]
    });

    // 🔍 FILTRE
    $('#btnFilter').click(() => table.ajax.reload());

    // ➕ OUVRIR MODAL AJOUT
    $('#btnAdd').click(() => $('#addModal').modal('show'));

    // 💾 ENREGISTRER CLIENT
    $('#saveClient').click(function () {

        Swal.fire({
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