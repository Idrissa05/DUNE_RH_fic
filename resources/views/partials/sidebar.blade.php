<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li> <a class="waves-effect waves-dark" href="{{ route('home') }}" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu">Accueil</span></a>
        <li>
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple-outline"></i><span class="hide-menu">Agents </span></a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="/addd">Liste agents</a></li>
                <li> <a href="/jdhhd"></a>

            </ul>
        </li>

        <li>
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings-outline"></i><span class="hide-menu">Configurations </span></a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="{{ route('category.index') }}">Catégories</a></li>

            </ul>
        </li>

    </ul>
</nav>
