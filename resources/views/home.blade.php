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

        </div>
    </div>
@endsection