<div class="pq-background-overlay"></div>
<header id="pq-header" class="pq-header-style-1  pq-has-sticky">
    <div class="pq-header-diff-block">
        <div class="row g-0">
            <div class="col-lg-12">

                <div class="pq-bottom-header pq-header-sticky animated fadeInDown animate__faster">
                    <div class="row g-0">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <a class="navbar-brand me-5" href="{{ route('app.welcome') }}">
                                    <img class="img-fluid logo" src="{{ asset('template/logo.png') }}" alt="fitsense">
                                </a>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <div id="pq-menu-contain" class="pq-menu-contain">
                                        <ul id="pq-main-menu" class="navbar-nav ml-auto">
                                            <div class="col-lg-12 text-end me-0 ">
                                                @if ( \Request::is('*/overview') )
                                                    <a href="{{ route('gym.rooms.subscription') }} " type="button" class="btn btn-secondary">M'abonner à la salle</a>
                                                @else
                                                    <a href="{{ route('app.rooms.map') }} " type="button" class="btn btn-secondary">Salle a proximité</a>
                                                @endif

                                                @guest()
                                                <!-- <a href="{{ route('login') }}" type="button" class="btn btn-primary">Connexion</a> -->
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Connexion</button>
                                                <a href="{{ route('register') }}" type="button" class="btn btn-secondary">S'inscrire</a>
                                                @else
                                                    <!-- redirect user to coresponding dashboard -->
                                                    @if( auth()->user()->role == 'admin' )
                                                        <a href="{{ route('admin.dashboad') }}" target="_blank" type="button" class="btn btn-primary">Mon compte</a>
                                                    @elseif( auth()->user()->role == 'manager' )
                                                        <a href="{{ route('manager.dashboad') }}" target="_blank" type="button" class="btn btn-primary">Mon compte</a>
                                                    @else
                                                        <a href="{{ route('user.dashboad') }}" target="_blank" type="button" class="btn btn-primary">Mon compte</a>
                                                    @endif

                                                    <a href="javascript:void" onclick="document.getElementById('logout-form').submit();" type="button" class="btn btn-primary">Déconnexion</a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                @endguest
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>