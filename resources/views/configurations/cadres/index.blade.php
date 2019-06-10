@extends('layouts.material')


@section('content')

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Nouveau cadre</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {!! form_start($form) !!}
                <div class="modal-body">
                    {!! form_row($form->name) !!}
                    {!! form_row($form->abreviation) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                {!! form_end($form) !!}
            </div>
        </div>
    </div>

    <h3 class="m-b-0 text-white text-center bg-primary">Les cadres</h3>

    <div class="card card-outline-info">
        <div class="card-body">

            <button data-toggle="modal" data-target="#add" data-whatever="@getbootstrap" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></button>
            <table class="table table-bordered text-center" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Libellé</th>
                    <th>Abréviation</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cadres as $cadre)
                    <tr>
                        <td>{{ $cadre->id }}</td>
                        <td>{{ $cadre->name }}</td>
                        <td>{{ $cadre->abreviation }}</td>
                        <td>
                            <button id="cadre{{ $cadre->id }}"
                                    data-abreviation="{{ $cadre->abreviation }}"
                                    data-name="{{ $cadre->name }}"
                                    data-route="{{ route('cadre.update', $cadre) }}"
                                    onclick="updateCadre({{ $cadre->id }})" class="btn btn-sm btn-outline-warning">
                                <i class="mdi mdi-18px mdi-pencil"></i>
                            </button>


                            <form action="{{ route('cadre.destroy', $cadre) }}" id="del{{ $cadre->id }}" style="display: inline-block;" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="button"
                                        onclick="myHelpers.deleteConfirmation('{{ 'del'. $cadre->id }}')">
                                    <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    @include('dataTable')
    <script>

        @if($errors->any())
            $('#add').modal('show')
        @endif

        let $modal = $('#add')
        let $name = $('#name')
        let $abreviation = $('#abreviation')
        let $form = $('form')


        function updateCadre(id) {
            let $el = $('#cadre'+id)
            $modal.modal('show')
            $name.val($el.attr('data-name'))
            $abreviation.val($el.attr('data-abreviation'))
            $form.attr('action', $el.attr('data-route'))
            $form.append("<input type='hidden' name='_method' value='PUT'>")
        }

        $modal.on('hidden.bs.modal', function (e) {
            $name.val('')
            $abreviation.val('')
            $form.attr('action', '')
            $('input[name="_method"]').remove()
        })
    </script>
@endsection