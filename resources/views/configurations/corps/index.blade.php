@extends('layouts.material')


@section('content')

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Nouveau corp</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {!! form_start($form) !!}
                <div class="modal-body">
                    {!! form_row($form->name) !!}
                    {!! form_row($form->abreviation) !!}
                    {!! form_row($form->category_id) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                {!! form_end($form) !!}
            </div>
        </div>
    </div>
    <h3 class="m-b-0 text-white text-center bg-primary">Les corps</h3>

    <div class="card card-outline-info">
        <div class="card-body">
            @can('ACTIONS_CONFIGURATION')
            <button data-toggle="modal" data-target="#add" data-whatever="@getbootstrap" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></button>
            @endcan
            <table class="table table-bordered text-center" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Libellé</th>
                    <th>Abréviation</th>
                    <th>Catégorie</th>
                    @can('ACTIONS_CONFIGURATION')
                        <th>Actions</th>
                    @endcan
                </tr>
                </thead>
                <tbody>
                @foreach($corps as $corp)
                    <tr>
                        <td>{{ $corp->id }}</td>
                        <td>{{ $corp->name }}</td>
                        <td>{{ $corp->abreviation }}</td>
                        <td>{{ $corp->category->name }}</td>
                        @can('ACTIONS_CONFIGURATION')
                        <td>
                            <button id="corp{{ $corp->id }}"
                                    data-category="{{ $corp->category_id }}" data-name="{{ $corp->name }}"
                                    data-abreviation="{{ $corp->abreviation }}"
                                    data-route="{{ route('corp.update', $corp) }}"
                                    onclick="updateCorp({{ $corp->id }})" class="btn btn-sm btn-outline-warning">
                                <i class="mdi mdi-18px mdi-pencil"></i>
                            </button>


                            <form action="{{ route('corp.destroy', $corp) }}" id="del{{ $corp->id }}" style="display: inline-block;" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="button"
                                        onclick="myHelpers.deleteConfirmation('{{ 'del'. $corp->id }}')">
                                    <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
                            </form>
                        </td>
                        @endcan
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
        let $category = $('#category_id')
        let $form = $('form')


        function updateCorp(id) {
            let $el = $('#corp'+id)
            $modal.modal('show')
            $name.val($el.attr('data-name'))
            $abreviation.val($el.attr('data-abreviation'))
            $category.val($el.attr('data-category'))
            $form.attr('action', $el.attr('data-route'))
            $form.append("<input type='hidden' name='_method' value='PUT'>")
        }

        $modal.on('hidden.bs.modal', function (e) {
            $name.val('')
            $abreviation.val('')
            $category.val(null)
            $form.attr('action', '')
            $('input[name="_method"]').remove()
        })
    </script>
@endsection
