@extends('pdf.document')

@section('content')
    <h3 class="text-center text-monospace" style="border: #2f3d4a 1px solid;">Fiche agent</h3>
    <h5 class="text-capitalize"># Informations de base</h5>

    <table class="table table-borderless" style="font-size: 14px;">
        <tr>
            <td style="padding: 0" width="50%">
                <table class="table table-sm table-striped">
                    <tr>
                        <td>Matricule : </td>
                        <td>{{ $agent->matricule }}</td>
                    </tr>
                    <tr>
                        <td>Nom :</td>
                        <td>{{ $agent->nom }}</td>
                    </tr>
                    <tr>
                        <td>Prénom :</td>
                        <td>{{ $agent->prenom }}</td>
                    </tr>
                    <tr>
                        <td>Sexe :</td>
                        <td>{{ $agent->sexe }}</td>
                    </tr>
                    <tr>
                        <td>Date de naissance :</td>
                        <td>{{ formaterDate($agent->date_naiss) }}</td>
                    </tr>
                    <tr>
                        <td>Lieu de naissance :</td>
                        <td>{{ $agent->lieu_naiss }}</td>
                    </tr>
                    <tr>
                        <td>Réference acte de naissance :</td>
                        <td>{{ $agent->ref_acte_naiss }}</td>
                    </tr>
                    <tr>
                        <td>Date établissement acte :</td>
                        <td>{{ formaterDate($agent->date_etablissement_acte_naiss) }}</td>
                    </tr>
                    <tr>
                        <td>Lieu établissement acte :</td>
                        <td>{{ $agent->lieu_etablissement_acte_naiss }}</td>
                    </tr>
                </table>
            </td>
            <td></td>
            <td></td>
            <td style="padding: 0" width="50%">
                <table class="table table-sm">
                    <tr>
                        <td>Situation matrimoniale :</td>
                        <td>{{ $agent->matrimoniales->last()->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Nationalité :</td>
                        <td>{{ $agent->nationnalite }}</td>
                    </tr>
                    <tr>
                        <td>Cadre :</td>
                        <td>{{ $agent->grades->last()->cadre->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Corps :</td>
                        <td>{{ $agent->grades->last()->corp->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Type :</td>
                        <td>{{ $agent->type }}</td>
                    </tr>
                    <tr>
                        <td>Fonction :</td>
                        <td>{{ $agent->grades->last()->fonction->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Date prise de service :</td>
                        <td>{{ $agent->date_prise_service ? formaterDate($agent->date_prise_service) : '' }}</td>
                    </tr>
                    <tr>
                        <td>Nombre de conjoint(e)s :</td>
                        <td>{{ $agent->conjoints->count() }}</td>
                    </tr>
                    <tr>
                        <td>Nombre d'enfants :</td>
                        <td>{{ $agent->enfants->count() }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <h5 class="text-capitalize"># Conjoint(e)s</h5>

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

    <h5 class="text-capitalize"># Enfants</h5>

    <table class="table table-sm text-center table-striped" style="font-size: 8px;">
        <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Prénom</th>
            <th>Date naissance</th> '
            <th>Lieu naissance</th>
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
                <td>{{ formaterDate($enfant->date_naiss) }}</td>
                <td>{{ $enfant->lieu_naiss }}</td>
                <td>{{ $enfant->sexe }}</td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
        </tbody>
    </table>

    <h5 class="text-capitalize"># Formations</h5>

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
                <td>{{ $formation->date_debut->format('d/m/Y') ?? '' }}</td>
                <td>{{ $formation->date_fin->format('d/m/Y') ?? '' }}</td>
                <td>{{ $formation->ecoleFormation->name ?? '' }}</td>
                <td>{{ $formation->diplome->name ?? '' }}</td>
                <td>{{ $formation->diplome->niveauEtude->name ?? '' }}</td>
                <td>{{ $formation->diplome->equivalenceDiplome->name ?? '' }}</td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
        </tbody>
    </table>

    <h5 class="text-capitalize"># Expériences</h5>

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
@endsection
