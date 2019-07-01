<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li> <a class="waves-effect waves-dark" href="{{ route('home') }}" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu">Accueil</span></a>
        <li>
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple-outline"></i><span class="hide-menu">Agents </span></a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="{{ route('agent.index') }}">Liste agents</a></li>
                <li><a href="{{ route('affectation.index') }}">Affectations</a></li>
                <li><a href="{{ route('avancement.index') }}">Avancements</a></li>
                <li><a href="{{ route('conge.index') }}">Congés</a></li>
                <li><a href="{{ route('conjoint.index') }}">Conjoints</a></li>
                <li><a href="{{ route('deces.index') }}">Decès</a></li>
                <li><a href="{{ route('enfant.index') }}">Enfants</a></li>
                <li><a href="{{ route('experience.index') }}">Expériences</a></li>
                <li><a href="{{ route('formation.index') }}">Formations</a></li>
                <li><a href="{{ route('agent-maladie.index') }}">Maladies</a></li>
                <li><a href="{{ route('agent-matrimoniale.index') }}">Matrimoniales</a></li>
                <li><a href="{{ route('migration.index') }}">Migrations agents</a></li>
                <li><a href="{{ route('notation.index') }}">Notations</a></li>
                <li><a href="{{ route('agent-position.index') }}">Positions</a></li>
                <li><a href="{{ route('reclassement.index') }}">Reclassements</a></li>
                <li><a href="{{ route('retraite.index') }}">Retraites</a></li>
            </ul>
        </li>

        <li>
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings-outline"></i><span class="hide-menu">Configurations </span></a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="{{ route('cadre.index') }}">Cadres</a></li>
                <li><a href="{{ route('category.index') }}">Catégories</a></li>
                <li><a href="{{ route('categoryAuxiliaire.index') }}">Catégories Auxiliaires</a></li>
                <li><a href="{{ route('classe.index') }}">Classes</a></li>
                <li><a href="{{ route('corp.index') }}">Corps</a></li>
                <li><a href="{{ route('diplome.index') }}">Diplômes</a></li>
                <li><a href="{{ route('echelon.index') }}">Échelons</a></li>
                <li><a href="{{ route('ecoleformation.index') }}">Écoles de formation</a></li>
                <li><a href="{{ route('equivalencediplome.index') }}">Équivalence diplôme</a></li>
                <li><a href="{{ route('etablissement.index') }}">Établissements</a></li>
                <li><a href="{{ route('fonction.index') }}">Fonctions</a></li>
                <li><a href="{{ route('indice.index') }}">Indices</a></li>
                <li><a href="{{ route('inspection.index') }}">Inspections</a></li>
                <li><a href="{{ route('maladie.index') }}">Maladies</a></li>
                <li><a href="{{ route('matrimoniale.index') }}">Matrimoniales</a></li>
                <li><a href="{{ route('niveauetude.index') }}">Niveaux étude</a></li>
                <li><a href="{{ route('position.index') }}">Positions</a></li>
                <li><a href="{{ route('secteurPedagogique.index') }}">Secteurs pédagogiques</a></li>
                <li><a href="{{ route('typeetablissement.index') }}">Types d'établissement</a></li>

            </ul>
        </li>
        <li>
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Administration </span></a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="{{ route('role.index') }}">Rôles</a></li>
                <li><a href="{{ route('users.index') }}">Utilisateurs</a></li>
                <li><a href="{{ route('config.index') }}">Système</a></li>

            </ul>
        </li>
        <!--<li> <a class="waves-effect waves-dark" href="{{ route('report.index') }}" aria-expanded="false"><i class="mdi mdi-file-document-box"></i><span class="hide-menu">Génération de Requêtes</span></a>-->
    </ul>
</nav>
