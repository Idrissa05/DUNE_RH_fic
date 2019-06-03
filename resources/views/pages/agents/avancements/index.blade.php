@extends('layouts.material')

@section('content')
    <div class="page-section">
        <section class="card card-fluid">
            <h3 class="m-b-0 text-white text-center bg-primary">Les Avancements</h3>
            <div class="card-body">
                <div class="table-responsive m-t-0">
                    <a href="{{route('avancement.create')}}" class="btn btn-primary"><i class="mdi mdi-plus"></i> Avancement au Choix </a>
                    <a href="{{route('avancement.auto')}}" class="btn btn-primary"><i class="mdi mdi-view-list"></i> Avancement Automatique</a>
                    <table id="myTable" class="table table-bordered text-center table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Agent</th>
                            <th>Catégorie</th>
                            <th>Classe</th>
                            <th>Echelon</th>
                            <th>Ref Avancement</th>
                            <th>Date Avancement</th>
                            <th>Observation</th>
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
            @include('dataTableAjax', ['columns' => "[
                { data: 'id', name: 'id' },
                { data: 'agent', name: 'agent' },
                { data: 'category', name: 'category' },
                { data: 'classe', name: 'classe' },
                { data: 'echelon', name: 'echelon' },
                { data: 'ref_avancement', name: 'ref_avancement' },
                { data: 'date_decision_avancement', name: 'date_decision_avancement' },
                { data: 'observation_avancement', name: 'observation_avancement' },
                { data: 'action', name: 'Actions', searchable: false, orderable: false },
            ]", 'route' => route('avancement.index')], ['scroll' => '450px'])
        })
    </script>
@stop
