@extends('layouts.material')

@section('content')
    <div class="page-section">
        <section class="card card-fluid">
            <h3 class="m-b-0 text-white text-center bg-primary">Avancements Automatique</h3>
            <div class="card-body">
                <div class="table-responsive m-t-0">
                    <a href="{{route('avancement.index')}}" class="btn btn-outline-secondary"><i class="mdi mdi-keyboard-backspace"></i> Retour</a>
                    <table id="myTable" class="table table-bordered text-center table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Matricule</th>
                            <th>Agent</th>
                            <th>Catégorie</th>
                            <th>Classe</th>
                            <th>Echelon</th>
                            <th>Dernière Evolution</th>
                            <th>Date</th>
                            <th>Action</th>
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
                { data: 'agent_id', name: 'agent_id' },
                { data: 'matricule', name: 'matricule' },
                { data: 'full_name', name: 'full_name' },
                { data: 'category', name: 'category' },
                { data: 'classe', name: 'classe' },
                { data: 'echelon', name: 'echelon' },
                { data: 'type', name: 'type' },
                { data: 'date', name: 'date' },
                { data: 'action', name: 'Actions', searchable: false, orderable: false },
            ]", 'route' => route('avancement.auto')], ['scroll' => '450px'])
        })
    </script>
@stop
