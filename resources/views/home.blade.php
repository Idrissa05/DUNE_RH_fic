@extends('layouts.material')

@section('content')

    <div class="card-outline-info">
        <div class="card-body">
            <h2 class="text-primary text-center">Tableau de bord</h2>
            <hr class="divider">
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header bg-secondary text-white"><i class="mdi mdi-account-multiple-outline mdi-36px"></i></div>
                        <div class="card-body">
                            <p>
                                Liste des agents probables retraités de l’année en cours.
                            </p>
                            <a href="{{ route('prints.retraitables') }}" target="_blank" title="imprimer" class="btn btn-sm btn-red"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card text-center">
                        <div class="card-header bg-secondary text-white"><i class="mdi mdi-account-multiple-outline mdi-36px"></i></div>
                        <div class="card-body">
                            <p>
                                Liste ou tableau des agents par sexe et catégorie.
                            </p>
                            <form action="{{ route('prints.list') }}" class="form-inline align-items-end" target="_blank">
                                <select name="categorie" class="form-control form-control-sm ml-5 mr-3">
                                    <option value="">Sélectionner une catégorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <select name="sexe" class="form-control form-control-sm">
                                    <option value="">Sélectionner un sexe</option>
                                    <option value="M">Masculin</option>
                                    <option value="F">Féminin</option>
                                </select>
                                <button title="imprimer" class="btn btn-sm btn-red mt-1 ml-5"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header bg-secondary text-white"><i class="mdi mdi-account-multiple-outline mdi-36px"></i></div>
                        <div class="card-body">
                            <p>
                                Liste agent par corps.
                            </p>
                            <form action="{{ route('prints.parcorps') }}" class="form-inline align-items-end" target="_blank">
                                <select name="corp" class="form-control form-control-sm mr-1">
                                    <option value="">Sélectionner un corps</option>
                                    @foreach($corps as $corp)
                                        <option value="{{ $corp->id }}">{{ $corp->name }}</option>
                                    @endforeach
                                </select>

                                <button title="imprimer" class="btn btn-sm btn-red mt-1"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header bg-secondary text-white"><i class="mdi mdi-account-multiple-outline mdi-36px"></i></div>
                        <div class="card-body">
                            <p>
                                Liste agent par position particulière.
                            </p>
                            <form action="{{ route('prints.parposition') }}" class="form-inline align-items-end" target="_blank">
                                <select name="position" class="form-control form-control-sm mr-1">
                                    <option value="">Sélectionner une position</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                                <button title="imprimer" class="btn btn-sm btn-red mt-1"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header bg-secondary text-white"><i class="mdi mdi-account-multiple-outline mdi-36px"></i></div>
                        <div class="card-body">
                            <p>
                                Liste des agents par situation matrimoniale.
                            </p>
                            <form action="{{ route('prints.parmatrimoniale') }}" class="form-inline align-items-end" target="_blank">
                                <select name="matrimoniale" class="form-control form-control-sm mr-1">
                                    <option value="">Sélectionner une situation</option>
                                    @foreach($matrimoniales as $matrimoniale)
                                        <option value="{{ $matrimoniale->id }}">{{ $matrimoniale->name }}</option>
                                    @endforeach
                                </select>
                                <button title="imprimer" class="btn btn-sm btn-red mt-1"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-header bg-secondary text-white"><i class="mdi mdi-account-multiple-outline mdi-36px"></i></div>
                        <div class="card-body">
                            <p>
                                Liste individuelle agent.
                            </p>
                            <form action="{{ route('prints.infos') }}" class="form-inline align-items-end" target="_blank">
                                <select name="agent" required class="form-control form-control-sm mr-1">
                                    <option value="">Sélectionner un agent</option>
                                    @foreach($agents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->matricule .' - '.$agent->fullName }}</option>
                                    @endforeach
                                </select>
                                <button title="imprimer" class="btn btn-sm btn-red mt-1"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-header bg-secondary text-white"><i class="mdi mdi-account-multiple-outline mdi-36px"></i></div>
                        <div class="card-body">
                            <p>
                                Historique avancement
                            </p>
                            <form action="{{ route('prints.history') }}" class="form-inline align-items-end" target="_blank">
                                <select name="agent" required class="form-control form-control-sm mr-1">
                                    <option value="">Sélectionner un agent</option>
                                    @foreach($agents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->matricule .' - '.$agent->fullName }}</option>
                                    @endforeach
                                </select>
                                <button title="imprimer" class="btn btn-sm btn-red mt-1"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card text-center">
                        <div class="card-header bg-secondary text-white"><i class="mdi mdi-account-multiple-outline mdi-36px"></i></div>
                        <div class="card-body">
                            <p>
                                Liste par secteur pédagogique, inspection, département, région, sexe.
                            </p>
                            <form action="{{ route('prints.par') }}" class="form-inline" target="_blank">
                                <div class="d-flex flex-row mb-2">
                                    <select name="region" id="region_id" class="form-control form-control-sm mr-1">
                                        <option value="">Sélectionner une région</option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                    <select name="departement" id="departement_id" class="form-control form-control-sm mr-1">
                                        <option value="">Sélectionner un département</option>
                                    </select>
                                    <select name="commune" id="commune_id" class="form-control form-control-sm mr-1">
                                        <option value="">Sélectionner une commune</option>
                                    </select>
                                </div>
                                <div class="d-flex flex-row align-items-end">
                                    <select name="inspection" id="inspection_id" class="form-control form-control-sm mr-1">
                                        <option value="">Sélectionner une inspection</option>
                                    </select>
                                    <select name="secteur" id="secteur_pedagogique_id" class="form-control form-control-sm mr-1">
                                        <option value="">Sélectionner un secteur</option>
                                    </select>
                                    <select name="sexe" class="form-control form-control-sm mr-1">
                                        <option value="">Sélectionner un sexe</option>
                                        <option value="M">Masculin</option>
                                        <option value="F">Féminin</option>
                                    </select>
                                    <button title="imprimer" class="btn btn-sm btn-red mt-1"><i class="mdi mdi-printer mdi-18px"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            $('#region_id').on('change', function(e){
                let region_id = $("#region_id option:selected").val();
                $.get('/api?model=departement&column=region_id&id=' + region_id,function(data) {
                    $('#departement_id').empty().append('<option value selected="selected">Sélectionner un département</option>');
                    $.each(data, function(index, departement){
                        $('#departement_id').append('<option value="'+ departement.id +'">'+ departement.name +'</option>');
                    })
                });
            });

            $('#departement_id').on('change', function(e){
                let departement_id = $("#departement_id option:selected").val();
                $.get('/api?model=commune&column=departement_id&id=' + departement_id,function(data) {
                    $('#commune_id').empty().append('<option value selected="selected">Sélectionner une commune</option>');
                    $.each(data, function(index, commune){
                        $('#commune_id').append('<option value="'+ commune.id +'">'+ commune.name +'</option>');
                    })
                });
            });

            $('#commune_id').on('change', function(e){
                let commune_id = $("#commune_id option:selected").val();
                $.get('/api?model=inspection&column=commune_id&id=' + commune_id,function(data) {
                    $('#inspection_id').empty().append('<option value selected="selected">Sélectionner une inspection</option>');
                    $.each(data, function(index, inspection){
                        $('#inspection_id').append('<option value="'+ inspection.id +'">'+ inspection.name +'</option>');
                    })
                });
            });

            $('#inspection_id').on('change', function(e){
                let inspection_id = $("#inspection_id option:selected").val();
                $.get('/api?model=secteurPedagogique&column=inspection_id&id=' + inspection_id,function(data) {
                    $('#secteur_pedagogique_id').empty().append('<option value selected="selected">Sélectionner un secteur</option>');
                    $.each(data, function(index, secteur){
                        $('#secteur_pedagogique_id').append('<option value="'+ secteur.id +'">'+ secteur.name +'</option>');
                    })
                });
            });
        })
    </script>
@endsection