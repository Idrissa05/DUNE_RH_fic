@extends('layouts.material')

@section('content')
<div class="card">
        <div class="card-body">
            <h3 class="card-title offset-4">Informations de <b>{{ $agent->nom . $agent->prenom }}</b></h3>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-outline-inverse">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Identification agent</h4>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" action="">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label  col-md-5"><b>Type :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->type }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                @if($agent->type == 'Titulaire')
                                                <label class="control-label  col-md-5"><b>Matricule :</b></label>
                                                @endif
                                                @if($agent->type != 'Titulaire')
                                                <label class="control-label  col-md-5"><b>Identifiant :</b></label>
                                                @endif
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->matricule }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label  col-md-5"><b>Non & prénom :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->nom . $agent->prenom }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label  col-md-5"><b>Sexe :</b></label>
                                                <div class="col-md-7">
                                                    @if($agent->sexe == 0)
                                                    <p class="form-control-static"> Masculin</p>
                                                    @endif
                                                    @if($agent->sexe == 1)
                                                    <p class="form-control-static"> Feminin</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-5"><b>Date de naissance :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->date_naiss }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label col-md-5"> <b>Lieu de naissance :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->lieu_naiss }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                        <!--/span-->
                                        <!--/span-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-5"><b>Nationnalité :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->nationnalite }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-5"><b>Réference acte de naissance :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->ref_acte_naiss }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-5"><b>Date établissement acte de naissance</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->date_etablissement_acte_naiss }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-5"><b>Lieu d'établissement acte de naissance :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->lieu_etablissement_acte_naiss }} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-outline-inverse">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Situation administrative</h4>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" action="">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label  col-md-5"><b>Ref engagement :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->grades->first()->ref_engagement }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label  col-md-5"><b>Date engagement :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->grades->first()->date_engagement}} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    @if($agent->type == 'Titulaire')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label  col-md-5"><b>Ref titularisation :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->grades->last()->ref_titularisation }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label  col-md-5"><b>Date titularisation :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static">{{ $agent->grades->last()->date_titularisation }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    @endif
                                    <!--/row-->
                                        <!--/span-->
                                        <!--/span-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-5"><b>Fonction :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->grades->last()->fonction->name ?? '' }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label col-md-5"> <b>Cadre :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->grades->last()->cadre->name ?? '' }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-5"><b>Corps :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->grades->last()->corp->name ?? '' }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-5"><b>Catégorie :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->grades->last()->category->name ?? '' }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        @if($agent->type = 'Titulaire')
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-5"><b>Classe :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->grades->last()->name ?? '' }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-5"><b>Echelon :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->grades->last()->echelon->name ?? '' }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-5"><b>Indice :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->grades->last()->indice->value ?? '' }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-5"><b>Salaire :</b></label>
                                                <div class="col-md-7">
                                                    <p class="form-control-static"> {{ $agent->grades->last()->indice->salary ?? '' }} </p>
                                                </div>
                                            </div>
                                        </div> 
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if($agent->affectations)
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-outline-inverse">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Affectations</h4>
                        </div>
                        <div class="card-body">
                        <table class="table table table-sm text-center table-striped" style="font-size: 8px;">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Ref</th>
                                <th>Date</th> '
                                <th>Date prise service</th>
                                <th>Etablissement</th>
                                <th>Type etablissement</th>
                                <th>Secteur pedagogique</th>
                                <th>Inspection</th>
                                <th>Commune</th>
                                <th>Département</th>
                                <th>Région</th>
                                <th>Observation</th>
                            </tr>
                            </thead>

                            <tbody class="text-center">
                            @php
                                $i = 1;
                            @endphp
                            @foreach($agent->affectations as $affectation)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $affectation->ref }}</td>
                                    <td>{{ $affectation->date }}</td>
                                    <td>{{ $affectation->date_prise_effet}}</td>
                                    <td>{{ $affectation->etablissement->name }}</td>
                                    <td>{{ $affectation->etablissement->typeEtablissement->name }}</td>
                                    <td>{{ $affectation->etablissement->secteurPedagogique->name }}</td>
                                    <td>{{ $affectation->etablissement->secteurPedagogique->inspection->name }}</td>
                                    <td>{{ $affectation->etablissement->secteurPedagogique->inspection->commune->name }}</td>
                                    <td>{{ $affectation->etablissement->secteurPedagogique->inspection->commune->departement->name }}</td>
                                    <td>{{ $affectation->etablissement->secteurPedagogique->inspection->commune->departement->region->name }}</td>
                                    <td>{{ $affectation->observation }}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($agent->formations == [])
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-outline-inverse">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Formations</h4>
                        </div>
                        <div class="card-body">
                        <table class="table table table-sm text-center table-striped" style="font-size: 8px;">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Date début</th>
                                <th>Date fin</th> 
                                <th>École de formation</th>
                                <th>Diplôme</th>
                                <th>Niveau d'étude</th>
                                <th>Équivalence du diplôme</th>
                            </tr>
                            </thead>

                            <tbody class="text-center">
                            @php
                                $i = 1;
                            @endphp
                            @foreach($agent->formations as $formation)
                                <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $formation->date_debut->format('d/m/Y') }}</td>
                                <td>{{ $formation->date_fin->format('d/m/Y') }}</td>
                                <td>{{ $formation->ecoleFormation->name }}</td>
                                <td>{{ $formation->diplome->name }}</td>
                                <td>{{ $formation->diplome->niveauEtude->name }}</td>
                                <td>{{ $formation->diplome->equivalenceDiplome->name }}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($agent->matrimoniales == [])
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-outline-inverse">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Situations matrimoniales</h4>
                        </div>
                        <div class="card-body">
                        <table class="table table table-sm text-center table-striped" style="font-size: 8px;">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Date</th> 
                            </tr>
                            </thead>

                            <tbody class="text-center">
                            @php
                                $i = 1;
                            @endphp
                            @foreach($agent->matrimoniales as $matrimoniale)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $matrimoniale->name }}</td>
                                    <td>{{ $matrimoniale->withPivot->date }}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($agent->conjoints == [])
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-outline-inverse">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white"># Conjoint(e)s</h4>
                        </div>
                        <div class="card-body">
                        <table class="table table-sm text-center table-striped" style="font-size: 8px;">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>N° Matricule</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Date naissance</th> '
                                <th>Lieu naissance</th>
                                <th>Sexe</th>
                                <th>Nationalité</th>
                                <th>Téléphone</th>
                                <th>Employeur</th>
                                <th>Profession</th>
                                <th>Ref acte mariage</th>
                            </tr>
                            </thead>

                            <tbody class="text-center">
                            @php
                                $i = 1;
                            @endphp
                            @foreach($agent->conjoints as $conjoint)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $conjoint->matricule }}</td>
                                    <td>{{ $conjoint->nom }}</td>
                                    <td>{{ $conjoint->prenom }}</td>
                                    <td>{{ formaterDate($conjoint->date_naiss) }}</td>
                                    <td>{{ $conjoint->lieu_naiss }}</td>
                                    <td>{{ $conjoint->sexe }}</td>
                                    <td>{{ $conjoint->nationnalite }}</td>
                                    <td>{{ $conjoint->tel }}</td>
                                    <td>{{ $conjoint->employeur }}</td>
                                    <td>{{ $conjoint->profession }}</td>
                                    <td>{{ $conjoint->ref_acte_mariage }}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($agent->enfants == [])
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-outline-inverse">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Enfants</h4>
                        </div>
                        <div class="card-body">
                        <table class="table table table-sm text-center table-striped" style="font-size: 8px;">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Date naissance</th>
                                <th>Lieu de naissance</th>
                                <th>Ref acte de naissance</th>
                                <th>Sexe</th> 
                            </tr>
                            </thead>

                            <tbody class="text-center">
                            @php
                                $i = 1;
                            @endphp
                            @foreach($agent->enfants as $enfant)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $enfant->prenom }}</td>
                                    <td>{{ $enfant->date_naiss }}</td>
                                    <td>{{ $enfant->lieu_naiss }}</td>
                                    <td>{{ $enfant->ref_acte_naiss }}</td>
                                    <td>{{ $enfant->sexe }}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($agent->experiences == [])
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-outline-inverse">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Expériences</h4>
                        </div>
                        <div class="card-body">
                        <table class="table table table-sm text-center table-striped" style="font-size: 8px;">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Organisation</th>
                                <th>Date début</th> 
                                <th>Date fin</th>
                                <th>Fonction</th>
                                <th>Tâche</th>
                                <th>Observation</th>
                            </tr>
                            </thead>

                            <tbody class="text-center">
                            @php
                                $i = 1;
                            @endphp
                            @foreach($agent->experiences as $experience)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $experience->organisation }}</td>
                                    <td>{{ formaterDate($experience->date_debut) }}</td>
                                    <td>{{ formaterDate($experience->date_fin) }}</td>
                                    <td>{{ $experience->fonction }}</td>
                                    <td>{{ $experience->tache}}</td>
                                    <td>{{ $experience->observation}}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($agent->maladies == [])
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-outline-inverse">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Maladies</h4>
                        </div>
                        <div class="card-body">
                        <table class="table table table-sm text-center table-striped" style="font-size: 8px;">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Maladie</th>
                                <th>Observation</th> 
                                <th>Date observation</th>
                            </tr>
                            </thead>

                            <tbody class="text-center">
                            @php
                                $i = 1;
                            @endphp
                            @foreach($agent->maladies as $maladie)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $maladie->name }}</td>
                                    <td>{{ $maladie->withPivot->observation }}</td>
                                    <td>{{ $maladie->withPivot->date_observation }}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($agent->conges == [])
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-outline-inverse">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Congés</h4>
                        </div>
                        <div class="card-body">
                        <table class="table table table-sm text-center table-striped" style="font-size: 8px;">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Ref decision</th>
                                <th>Date debut</th>
                                <th>Date fin</th> 
                                <th>Observation</th>
                            </tr>
                            </thead>

                            <tbody class="text-center">
                            @php
                                $i = 1;
                            @endphp
                            @foreach($agent->conges as $conge)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $conge->ref_decision }}</td>
                                    <td>{{ $conge->date_debut }}</td>
                                    <td>{{ $conge->date_fin }}</td>
                                    <td>{{ $conge->observation }}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($agent->notations == [])
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-outline-inverse">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Notations</h4>
                        </div>
                        <div class="card-body">
                        <table class="table table table-sm text-center table-striped" style="font-size: 8px;">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Date debut</th>
                                <th>Date fin</th> 
                                <th>Note</th>
                                <th>Responsable</th>
                                <th>Observation</th>
                            </tr>
                            </thead>

                            <tbody class="text-center">
                            @php
                                $i = 1;
                            @endphp
                            @foreach($agent->notations as $notation)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $notation->date_debut }}</td>
                                    <td>{{ $notation->date_fin }}</td>
                                    <td>{{ $notation->note }}</td>
                                    <td>{{ $notation->responsable }}</td>
                                    <td>{{ $notation->observation }}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($agent->positions == [])
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-outline-inverse">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Positions</h4>
                        </div>
                        <div class="card-body">
                        <table class="table table table-sm text-center table-striped" style="font-size: 8px;">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Position</th>
                                <th>Ref decision</th>
                                <th>Date decision</th>
                                <th>Date prise effet</th>
                                <th>Date fin</th> 
                                <th>Observation</th> 
                            </tr>
                            </thead>

                            <tbody class="text-center">
                                <tr>
                                    <td>1</td>
                                    <td>{{ $agent->positions->last()->name }}</td>
                                    <td>{{ $agent->positions->last()->withPivot->ref_decision }}</td>
                                    <td>{{ $agent->positions->last()->withPivot->date_decision }}</td>
                                    <td>{{ $agent->positions->last()->withPivot->date_effet }}</td>
                                    <td>{{ $agent->positions->last()->withPivot->date_fin }}</td>
                                    <td>{{ $agent->positions->last()->withPivot->observation }}</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection