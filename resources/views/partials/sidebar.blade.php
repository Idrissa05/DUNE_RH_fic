<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li> <a class="waves-effect waves-dark" href="{{ route('home') }}" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu">Accueil</span></a>
        <li>
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple-outline"></i><span class="hide-menu">Agents </span></a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="{{ route('agent.index') }}">Liste agents</a></li>
                <li><a href="{{ route('formation.index') }}">Formations</a></li>
            </ul>
        </li>

        <li>
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings-outline"></i><span class="hide-menu">Configurations </span></a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="{{ route('category.index') }}">Catégories</a></li>
                <li><a href="{{ route('classe.index') }}">Classes</a></li>
                <li><a href="{{ route('echelon.index') }}">Échelons</a></li>
                <li><a href="{{ route('localite.index') }}">Localités</a></li>
                <li><a href="{{ route('typeetablissement.index') }}">Types d'établissement</a></li>
                <li><a href="{{ route('inspection.index') }}">Inspections</a></li>
                <li><a href="{{ route('etablissement.index') }}">Établissements</a></li>
                <li><a href="{{ route('ecoleformation.index') }}">Écoles de formation</a></li>
                <li><a href="{{ route('equivalencediplome.index') }}">Équivalence diplôme</a></li>
                <li><a href="{{ route('niveauetude.index') }}">Niveaux étude</a></li>
                <li><a href="{{ route('maladie.index') }}">Maladies</a></li>
                <li><a href="{{ route('matrimoniale.index') }}">Matrimoniales</a></li>
                <li><a href="{{ route('diplome.index') }}">Diplômes</a></li>

            </ul>
        </li>

    </ul>
</nav>
