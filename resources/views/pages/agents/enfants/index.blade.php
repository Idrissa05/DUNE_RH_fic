@extends('layouts.material')


@section('content')
    <h3 class="m-b-0 text-white text-center bg-primary">Les enfants</h3>

<div class="card card-outline-info">
    <div class="card-body">

        <a href="{{ route('enfant.create') }}" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></a>

        <table class="table table-bordered text-center" id="myTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Prénom</th>
                <th>Date naissance</th> '
                <th>Lieu naissance</th>
                <th>Ref Acte Naissance</th>
                <th>Sexe</th>
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
        { data: 'prenom', name: 'prenom' },
        { data: 'date_naiss', name: 'date_naiss' },
        { data: 'lieu_naiss', name: 'lien_naiss' },
        { data: 'ref_acte_naiss', name: 'ref_acte_naiss' },
        { data: 'sexe', name: 'sexe' },
        { data: 'agent', name: 'agent' },
        { data: 'actions', name: 'Actions', searchable: false, orderable: false },
    ]", 'route' => route('enfant.index')], ['scroll' => '450px'])
    })
</script>
@endsection
