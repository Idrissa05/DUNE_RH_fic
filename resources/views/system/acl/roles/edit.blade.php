@extends('layouts.material')


@section('content')
    @if($role->id)
        <h3 class="m-b-0 text-white text-center bg-primary">Edition du rôle: {{ $role->name }}</h3>
    @else
        <h3 class="m-b-0 text-white text-center bg-primary">Créer un nouveau rôle</h3>
    @endif
    <div class="card card-outline-info">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    {!! form_start($form) !!}
                    {!! form_row($form->name) !!}
                    {!! form_row($form->permission_id) !!}
                    <div class="row">
                        <div class="col-md-4 offset-md-1">
                            <button type="button" onclick="selectionner()" title="Sélectionner tous" class="btn btn-outline-secondary btn-xs">Sélectionner tous</button>
                        </div>
                        <div class="col-md-4 offset-md-2">
                            <button type="button" onclick="deselectionner()" title="Desélectionner tous" class="btn btn-outline-secondary btn-xs">Desélectionner tous</button>
                        </div>
                    </div>
                    <div class="row mt-3">
                       <div class="col-md-6">
                           <button type="submit" title="Enregister" class="btn btn-primary btn-block"><i class="mdi mdi-18px mdi-content-save"></i> Enregistrer</button>
                       </div>
                        <div class="col-md-6">
                        <a href="{{ route('role.index') }}" title="Annuler" class="btn btn-secondary btn-block"><i class="mdi mdi-18px mdi-cancel"></i> Annuler</a>
                        </div>
                    </div>
                    {!! form_end($form) !!}

                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#permission_id').multiSelect({
            selectableHeader: "<div class='bg-secondary text-white text-center'>Élements à sélectionner</div>",
            selectionHeader: "<div class='bg-secondary text-white text-center'>Élements sélectionnés</div>",
            cssClass: 'w-100'
        })
        
        function selectionner() {
            $('#permission_id').multiSelect('select_all')
        }

        function deselectionner() {
            $('#permission_id').multiSelect('deselect_all')
        }
    </script>
@endsection
