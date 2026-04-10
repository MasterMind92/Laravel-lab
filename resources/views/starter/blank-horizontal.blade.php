@extends('layouts.horizontal-master')
@section('page-css')

@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Horizontal Sidebar</h1>
    <ul>
        <li><a href="">Starter</a></li>
        <li>Blank Page</li>
    </ul>
</div>
<div class="separator-breadcrumb border-top"></div>


<!-- Content Goes Here-->
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


@endsection