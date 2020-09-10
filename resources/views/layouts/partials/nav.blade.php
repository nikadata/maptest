<!-- Start Top Bar -->
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Maprom</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('new_household') }}" role="button">Add +</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('list') }}">Households</a>
                </li>
                <!--
                <li class="nav-item">
                    // <a class="nav-link " href="{{ route('search') }}">Search Households</a>
                </li>
                -->
                <!--
                <li class="nav-item">
                 //   <a class="nav-link " href="{{ route('households') }}">Stats Households</a>
                </li>
                -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('village_list') }}">Villages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('village_search') }}">Search Villages</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dependency tables
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('country') }}">Countries</a>
                        <a class="dropdown-item" href="{{ route('district') }}">Districts</a>
                        <a class="dropdown-item" href="{{ route('extended') }}">Extended Family</a>
                        <a class="dropdown-item" href="{{ route('skill') }}">Jobs</a>
                        <a class="dropdown-item" href="{{ route('social') }}">Social classes</a>
                        <a class="dropdown-item" href="{{ route('source') }}">Sources</a>
                        <a class="dropdown-item" href="{{ route('county') }}">Sub-districts</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('statistics') }}">Statistics</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">|   {{ Auth::user()->name }}   |</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tools')}}">Tools</a>
                </li>
                <button type="submit" class="btn btn-default">
                <li role="button">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form></li>
                </button>
                </ul>
        </div>
    </nav>
</div>
