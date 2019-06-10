@extends('layouts.material')


@section('content')
    <h3 class="m-b-0 text-white text-center bg-primary">Les conjoints</h3>

<div class="card card-outline-info">
    <div class="card-body">

        <a href="{{ route('conjoint.create') }}" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></a>

        <table class="table table-bordered text-center" id="myTable">
            <thead>
            <tr>
                <th>#</th>
                <th>N° Matricule</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date naissance</th> '
                <th>Lieu naissance</th>
                <th>Sexe</th>
                <th>Nationalité</th>
                <th>Téléphone</th>
                <th>Employeur</th>
                <th>Profession</th>
                <th>Ref acte mariage</th>
                <th>Agent</th>
                <th>Actions</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function () {
    @include('dataTableAjax', ['columns' => "[
        { data: 'id', name: 'id' },
        { data: 'matricule', name: 'matricule' },
        { data: 'nom', name: 'nom' },
        { data: 'prenom', name: 'prenom' },
        { data: 'date_naiss', name: 'date_naiss' },
        { data: 'lieu_naiss', name: 'lien_naiss' },
        { data: 'sexe', name: 'sexe' },
        { data: 'nationnalite', name: 'nationalite' },
        { data: 'tel', name: 'tel' },
        { data: 'employeur', name: 'employeur' },
        { data: 'profession', name: 'profession' },
        { data: 'ref_acte_mariage', name: 'ref_acte_mariage' },
        { data: 'agent', name: 'agent' },
        { data: 'actions', name: 'Actions', searchable: false, orderable: false },
    ]", 'route' => route('conjoint.index')], ['scroll' => '450px'])
    })
</script>
@endsection