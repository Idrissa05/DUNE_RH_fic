@extends('layouts.material')


@section('content')

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Nouvelle matrimoniale</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {!! form_start($form) !!}
                <div class="modal-body">
                            {!! form_row($form->agent_id) !!}
                            {!! form_row($form->matrimoniale_id) !!}
                            {!! form_row($form->date) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                {!! form_end($form) !!}
            </div>
        </div>
    </div>

    <h3 class="m-b-0 text-white text-center bg-primary">Agent matrimoniale</h3>

    <div class="card card-outline-info">
        <div class="card-body">

            <button data-toggle="modal" data-target="#add" data-whatever="@getbootstrap" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></button>

            <table class="table table-bordered text-center" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Situations matrimoniales</th>
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
                { data: 'matrimoniales', name: 'matrimoniales' },
            ]", 'route' => route('agent-matrimoniale.index')], ['scroll' => '450px'])
        })
    </script>
@endsection
