@extends('layouts.material')


@section('content')

<div class="card card-outline-info">
    <div class="card-body">
        <h3 class="text-center label-default">Les reclassements</h3>

        <a href="{{ route('reclassement.create') }}" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></a>

        <table class="table table-bordered text-center" id="myTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Agent</th>
                <th>Catégorie</th> '
                <th>Classe</th>
                <th>Echelon</th>
                <th>Ref reclassement</th>
                <th>Date reclassement</th>
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
        { data: 'agent', name: 'agent' },
        { data: 'category', name: 'category' },
        { data: 'classe', name: 'classe' },
        { data: 'echelon', name: 'echelon' },
        { data: 'ref_reclassement', name: 'ref_reclassement' },
        { data: 'date_reclassement', name: 'date_reclassement' },
        { data: 'actions', name: 'Actions', searchable: false, orderable: false },
    ]", 'route' => route('reclassement.index')], ['scroll' => '450px'])
    })
</script>
@endsection