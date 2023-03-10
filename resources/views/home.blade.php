@extends('layouts.material')

@section('content')

    <div class="card-outline-info">
        <div class="card-body">
            <h2 class="text-themecolor text-center">Tableau de bord</h2>
            <hr class="divider">
            <div class="row">
            <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-header bg-secondary text-white"><i class="mdi mdi-account-multiple-outline mdi-36px"></i></div>
                        <div class="card-body">
                            <p>
                                Etat nominatif.
                            </p>
                            <a href="{{ route('print.etatnominatif') }}" target="_blank" title="imprimer" class="btn btn-sm btn-themecolor"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h4 class="text-center bg-secondary text-white">{{ ('Nombre agent par sexe') }}</h4>
                            </div>
                            <div class="card-block">
                                <canvas class="card-block" id="myChart_D" data-labels="{{ implode(', ', $labels) }}" data-nombre_agent="{{ implode(', ', $nombres_agents) }}" width="600" height="400">
                                </canvas>
                            </div>
                            <div class="card-footer">

                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h4 class="text-center bg-secondary text-white">{{ ('Nombre agent par région') }}</h4>
                            </div>
                            <div class="card-block">
                                <canvas class="card-block" id="myChart_R" data-labelsR="{{ implode(', ', $labels_regions) }}" data-nombre_region="{{ implode(', ', $nombres_agentsR) }}" width="600" height="400">
                                </canvas>
                            </div>
                            <div class="card-footer">

                            </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h4 class="text-center bg-secondary text-white">{{ ('Nombre agent par sexe et région') }}</h4>
                            </div>
                            <div class="card-block">
                                <canvas class="card-block" id="myChart_SR" data-label_SR="{{ implode(', ', $labels_regions) }}" data-nombre_agentSR="{{ implode(', ', $tableaux1) }}" width="600" height="400">
                                </canvas>
                            </div>
                            <div class="card-footer">

                            </div>
                    </div>
                </div>    
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h4 class="text-center bg-secondary text-white">{{ ('Nombre agent par type') }}</h4>
                            </div>
                            <div class="card-block">
                                <canvas class="card-block" id="myChart_T" data-labelsT="{{ implode(', ', $labels_types) }}" data-nombre_type="{{ implode(', ', $nombres_agentsT) }}" width="600" height="400">
                                </canvas>
                            </div>
                            <div class="card-footer">

                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h4 class="text-center bg-secondary text-white">{{ ("Nombre agent par tranche d'age") }}</h4>
                            </div>
                            <div class="card-block">
                                <canvas class="card-block" id="myChart_A" data-labelsA="{{ implode(', ', $age_tranche_labels) }}" data-nombre_age="{{ implode(', ', $nombre_agent_tranche_ages) }}" width="600" height="400">
                                </canvas>
                            </div>
                            <div class="card-footer">

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
                                Liste des agents probables retraités de l’année en cours ({{ $nombreAgentRetraitable }}).
                            </p>
                            <a href="{{ route('prints.retraitables') }}" target="_blank" title="imprimer" class="btn btn-sm btn-themecolor"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</a>
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
                               <form action="{{ route('prints.list') }}" class="form-inline row" target="_blank">
                                   <div class="form-group col-md-3 offset-md-1">
                                       <select name="categorie" class="select">
                                           <option value="">Sélectionner une catégorie</option>
                                           @foreach($categories as $category)
                                               <option value="{{ $category['name'] }}">{{ $category['name'] }}</option>
                                           @endforeach
                                       </select>
                                   </div>
                                   <div class="form-group col-md-3 offset-md-1">
                                       <select name="sexe" class="select">
                                           <option value="">Sélectionner un sexe</option>
                                           <option value="M">Masculin</option>
                                           <option value="F">Féminin</option>
                                       </select>
                                   </div>
                                   <div class="form-group col-md-3 offset-md-1">
                                       <button title="imprimer" class="btn btn-sm btn-themecolor"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</button>
                                   </div>
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
                            <form action="{{ route('prints.parcorps') }}" class="" target="_blank">
                                <div class="form-group align-items-center">
                                    <select name="corp" class="select">
                                        <option value="">Sélectionner un corps</option>
                                        @foreach($corps as $corp)
                                            <option value="{{ $corp->id }}">{{ $corp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group align-items-center">
                                    <button title="imprimer" class="btn btn-sm btn-themecolor align-items-center"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</button>

                                </div>
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
                            <form action="{{ route('prints.parposition') }}" class="" target="_blank">
                               <div class="form-group align-items-center">
                                   <select name="position" class="select">
                                       <option value="">Sélectionner une position</option>
                                       @foreach($positions as $position)
                                           <option value="{{ $position->id }}">{{ $position->name }}</option>
                                       @endforeach
                                   </select>
                               </div>
                                <div class="form-group align-items-center">
                                    <button title="imprimer" class="btn btn-sm btn-themecolor"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</button>

                                </div>
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
                            <form action="{{ route('prints.parmatrimoniale') }}" class="" target="_blank">
                                <div class="form-group align-items-center">
                                    <select name="matrimoniale" class="select">
                                        <option value="">Sélectionner une situation</option>
                                        @foreach($matrimoniales as $matrimoniale)
                                            <option value="{{ $matrimoniale->id }}">{{ $matrimoniale->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group align-items-center">
                                    <button title="imprimer" class="btn btn-sm btn-themecolor"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</button>

                                </div>
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
                                Fiche individuelle agent.
                            </p>
                            <form action="{{ route('prints.infos') }}" class="" target="_blank">
                                <div class="form-group align-items-center">
                                    <select name="agent" required class="agent col-md-10">
                                        <option value="">Sélectionner un agent</option>
                                    </select>
                                </div>
                                <div class="form-group align-items-center">
                                    <button title="imprimer" class="btn btn-sm btn-themecolor"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</button>

                                </div>
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
                            <form action="{{ route('prints.history') }}" class="" target="_blank">
                                <div class="form-group align-items-center">
                                    <select name="agent" required class="agent col-md-10">
                                        <option value="">Sélectionner un agent</option>
                                    </select>
                                </div>
                                <div class="form-group alert-link">
                                    <button title="imprimer" class="btn btn-sm btn-themecolor"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-header bg-secondary text-white"><i class="mdi mdi-account-multiple-outline mdi-36px"></i></div>
                        <div class="card-body">
                            <p>
                                Liste par critères.
                            </p>
                            <form action="{{ route('prints.par') }}" class="" target="_blank">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <select name="region" id="region_id" class="select">
                                            <option value="">Sélectionner une région</option>
                                            @foreach($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                   <div class="form-group col-md-3">
                                       <select name="departement" id="departement_id" class="select">
                                           <option value="">Sélectionner un département</option>
                                       </select>
                                   </div>
                                    <div class="form-group col-md-3">
                                        <select name="commune" id="commune_id" class="select">
                                            <option value="">Sélectionner une commune</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select name="inspection" id="inspection_id" class="select">
                                            <option value="">Sélectionner une inspection</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <select name="secteur" id="secteur_pedagogique_id" class="select">
                                            <option value="">Sélectionner un secteur</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select name="etablissement" id="etablissement_id" class="select">
                                            <option value="">Sélectionner un établissement</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select name="fonction" id="fonction_id" class="select col-md-9">
                                            <option value="">Sélectionner une fonction</option>
                                            @foreach($fonctions as $fonction)
                                                <option value="{{ $fonction->id }}">{{ $fonction->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                   <div class="form-group col-md-3">
                                       <select name="sexe" class="select col-md-9">
                                           <option value="">Sélectionner un sexe</option>
                                           <option value="M">Masculin</option>
                                           <option value="F">Féminin</option>
                                       </select>
                                   </div>
                                </div>
                                <button title="imprimer" class="btn btn-sm btn-themecolor"><i class="mdi mdi-printer mdi-18px"></i> Imprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/js/Chart.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.BarFunnel.js') }}"></script>
    <script>
  var ctx = document.getElementById('myChart_SR');
  var libelles = ctx.getAttribute('data-label_SR')
  var stocks = ctx.getAttribute('data-nombre_agentSR')
  var donnees1 = JSON.parse("{{ json_encode($donnees1) }}");
  var donnees2 = JSON.parse("{{ json_encode($donnees2) }}");
  var donnees3 = JSON.parse("{{ json_encode($donnees3) }}");
  console.log(donnees1, donnees2 ,donnees3)
  console.log(libelles)
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: libelles.split(', '),
        datasets: [{
            label: 'Autre',
            data: donnees1,
            backgroundColor: [
                'rgba(255, 0, 0, 0.6)',
                'rgba(173, 255, 47, 0.6)',
                'rgba(0, 0, 255, 0.6)',
                'rgba(255, 215, 0, 0.6)',
                'rgba(139, 0, 0, 0.6)',
                'rgba(128, 128, 0, 0.6)',
                'rgba(0, 100, 0, 0.6)',
                'rgba(139, 69, 19, 0.6)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(173, 255, 47, 1)',
                'rgba(0, 0, 255, 1)',
                'rgba(255, 215, 0, 1)',
                'rgba(139, 0, 0, 1)',
                'rgba(128, 128, O, 1)',
                'rgba(0, 100, 0, 1)',
                'rgba(139, 69, 19, 1)'
            ],
            borderWidth: 1
        },
        {
            label: 'Femme',
            data: donnees3,
            backgroundColor: [
                'rgba(255, 0, 0, 0.6)',
                'rgba(173, 255, 47, 0.6)',
                'rgba(0, 0, 255, 0.6)',
                'rgba(255, 215, 0, 0.6)',
                'rgba(139, 0, 0, 0.6)',
                'rgba(128, 128, 0, 0.6)',
                'rgba(0, 100, 0, 0.6)',
                'rgba(139, 69, 19, 0.6)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(173, 255, 47, 1)',
                'rgba(0, 0, 255, 1)',
                'rgba(255, 215, 0, 1)',
                'rgba(139, 0, 0, 1)',
                'rgba(128, 128, O, 1)',
                'rgba(0, 100, 0, 1)',
                'rgba(139, 69, 19, 1)'
            ],
            borderWidth: 1
        },
        {
            label: 'Homme',
            data: donnees2,
            backgroundColor: [
                'rgba(255, 0, 0, 0.6)',
                'rgba(173, 255, 47, 0.6)',
                'rgba(0, 0, 255, 0.6)',
                'rgba(255, 215, 0, 0.6)',
                'rgba(139, 0, 0, 0.6)',
                'rgba(128, 128, 0, 0.6)',
                'rgba(0, 100, 0, 0.6)',
                'rgba(139, 69, 19, 0.6)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(173, 255, 47, 1)',
                'rgba(0, 0, 255, 1)',
                'rgba(255, 215, 0, 1)',
                'rgba(139, 0, 0, 1)',
                'rgba(128, 128, O, 1)',
                'rgba(0, 100, 0, 1)',
                'rgba(139, 69, 19, 1)'
            ],
            borderWidth: 1
        }
        
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
    <script>
  var ctx = document.getElementById('myChart_D');
  var libelles = ctx.getAttribute('data-labels')
  var stocks = ctx.getAttribute('data-nombre_agent')
  console.log(libelles)
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: libelles.split(', '),
        datasets: [{
            label: '# Agents',
            data: stocks.split(', '),
            backgroundColor: [
                'rgba(255, 0, 0, 0.6)',
                'rgba(173, 255, 47, 0.6)',
                'rgba(0, 0, 255, 0.6)',
                'rgba(255, 215, 0, 0.6)',
                'rgba(139, 0, 0, 0.6)',
                'rgba(128, 128, 0, 0.6)',
                'rgba(0, 100, 0, 0.6)',
                'rgba(139, 69, 19, 0.6)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(173, 255, 47, 1)',
                'rgba(0, 0, 255, 1)',
                'rgba(255, 215, 0, 1)',
                'rgba(139, 0, 0, 1)',
                'rgba(128, 128, O, 1)',
                'rgba(0, 100, 0, 1)',
                'rgba(139, 69, 19, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
<script>
  var ctx = document.getElementById('myChart_T');
  var libelles = ctx.getAttribute('data-labelsT')
  var stocks = ctx.getAttribute('data-nombre_type')
  console.log(libelles)
 var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: libelles.split(', '),
        datasets: [{
            label: '# Agents',
            data: stocks.split(', '),
            backgroundColor: [
                'rgba(255, 0, 0, 0.6)',
                'rgba(173, 255, 47, 0.6)',
                'rgba(0, 0, 255, 0.6)',
                'rgba(255, 215, 0, 0.6)',
                'rgba(139, 0, 0, 0.6)',
                'rgba(128, 128, 0, 0.6)',
                'rgba(0, 100, 0, 0.6)',
                'rgba(139, 69, 19, 0.6)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(173, 255, 47, 1)',
                'rgba(0, 0, 255, 1)',
                'rgba(255, 215, 0, 1)',
                'rgba(139, 0, 0, 1)',
                'rgba(128, 128, O, 1)',
                'rgba(0, 100, 0, 1)',
                'rgba(139, 69, 19, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
<script>
  var ctx = document.getElementById('myChart_A');
  var libelles = ctx.getAttribute('data-labelsA')
  var stocks = ctx.getAttribute('data-nombre_age')
  console.log(libelles)
 var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: libelles.split(', '),
        datasets: [{
            label: '# Agents',
            data: stocks.split(', '),
            backgroundColor: [
                'rgba(255, 0, 0, 0.6)',
                'rgba(173, 255, 47, 0.6)',
                'rgba(0, 0, 255, 0.6)',
                'rgba(255, 215, 0, 0.6)',
                'rgba(139, 0, 0, 0.6)',
                'rgba(128, 128, 0, 0.6)',
                'rgba(0, 100, 0, 0.6)',
                'rgba(139, 69, 19, 0.6)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(173, 255, 47, 1)',
                'rgba(0, 0, 255, 1)',
                'rgba(255, 215, 0, 1)',
                'rgba(139, 0, 0, 1)',
                'rgba(128, 128, O, 1)',
                'rgba(0, 100, 0, 1)',
                'rgba(139, 69, 19, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
<script>
  var ctx = document.getElementById('myChart_R');
  var libelles = ctx.getAttribute('data-labelsR')
  var stocks = ctx.getAttribute('data-nombre_region')
  console.log(libelles)
 var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: libelles.split(', '),
        datasets: [{
            label: '# Agents',
            data: stocks.split(', '),
            backgroundColor: [
                'rgba(255, 0, 0, 0.6)',
                'rgba(173, 255, 47, 0.6)',
                'rgba(0, 0, 255, 0.6)',
                'rgba(255, 215, 0, 0.6)',
                'rgba(139, 0, 0, 0.6)',
                'rgba(128, 128, 0, 0.6)',
                'rgba(0, 100, 0, 0.6)',
                'rgba(139, 69, 19, 0.6)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(173, 255, 47, 1)',
                'rgba(0, 0, 255, 1)',
                'rgba(255, 215, 0, 1)',
                'rgba(139, 0, 0, 1)',
                'rgba(128, 128, O, 1)',
                'rgba(0, 100, 0, 1)',
                'rgba(139, 69, 19, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
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
            $('#secteur_pedagogique_id').on('change', function(e){
                let secteur_id = $("#secteur_pedagogique_id option:selected").val();
                $.get('/api?model=etablissement&column=secteur_pedagogique_id&id=' + secteur_id,function(data) {
                    $('#etablissement_id').empty().append('<option value selected="selected">Sélectionner un établissement</option>');
                    $.each(data, function(index, secteur){
                        $('#etablissement_id').append('<option value="'+ secteur.id +'">'+ secteur.name +'</option>');
                    })
                });
            });
        })
    </script>
@endsection
