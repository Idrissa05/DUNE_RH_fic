@extends('layouts.material')

@section('content')
    <div class="page-section">
        <section class="card card-fluid">
            <h3 class="m-b-0 text-white text-center bg-primary">Migration Agents</h3>
            <div class="card-body">
                <div class="table-responsive m-t-0">
                    @can('EFFECTUER_MIGRATION')
                    <a href="{{route('migration.create')}}" class="btn btn-primary"><i class="mdi mdi-plus"></i> Effectuer Migration</a>
                    @endcan
                    <table id="myTable" class="table table-bordered text-center table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Agent</th>
                            <th>Matricule</th>
                            <th>Type</th>
                            <th>Cadre</th>
                            <th>Corps</th>
                            <th>Fonction</th>
                            <th>Catégorie</th>
                            <th>Classe</th>
                            <th>Echélon</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            @include('dataTableAjaxAllScrolling', ['columns' => "[
                { data: 'id', name: 'id' },
                { data: 'agent', name: 'agent' },
                { data: 'codeMat', name: 'codeMat' },
                { data: 'type', name: 'type' },
                { data: 'cadre', name: 'cadre' },
                { data: 'corps', name: 'corps' },
                { data: 'fonction', name: 'fonction' },
                { data: 'category_id', name: 'category_id' },
                { data: 'classe_id', name: 'classe_id' },
                { data: 'echelon_id', name: 'echelon_id' },
                { data: 'action', name: 'Actions', searchable: false, orderable: false },
            ]", 'route' => route('migration.index')], ['scroll' => '450px'])
        })
    </script>
@stop
