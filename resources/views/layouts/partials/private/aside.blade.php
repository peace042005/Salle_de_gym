<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <!-- sidebar for only admin role -->
            @if( auth()->user()->role === "admin" )
                <li>
                    <a href="{{ route('admin.dashboad') }}" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Accueil</span>
                    </a>
                </li>
                <hr>
                <li>
                    <a href="{{ route('management.pricing.index') }}" aria-expanded="false">
                        <i class="fas fa-heart"></i>
                        <span class="nav-text">Gérer les plans tarifs</span>
                    </a>
                </li>
            @endif

            <!-- sidebar for only manager role -->
            @if( auth()->user()->role === "manager" )
                <li>
                    <a href="{{ route('manager.dashboad') }}" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Accueil</span>
                    </a>
                </li>
                <hr>
                
                <!-- <li>
                    <a href="coatch.html" aria-expanded="false">
                        <i class="fas fa-user-check"></i>
                        <span class="nav-text">Gérer les coach</span>
                    </a>
                </li>
                <li>
                    <a href="Gestion financière.html" aria-expanded="false">
                        <i class="fas fa-table"></i>
                        <span class="nav-text">Gérer les achats</span>
                    </a>
                </li>
                <li>
                    <a href="salaire.html" aria-expanded="false">
                        <i class="fas fa-table"></i>
                        <span class="nav-text">Gérer les salaire</span>
                    </a>
                </li>
                <li>
                    <a href="Programmation.html" aria-expanded="false">
                        <i class="fas fa-table"></i>
                        <span class="nav-text">Programmation</span>
                    </a>
                </li> -->
            @endif

            <!-- sidebar for only user role -->
            @if( auth()->user()->role === "user" )
                <li>
                    <a href="{{ route('user.dashboad') }}" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Acceuil</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Mes achats</span>
                    </a>
                </li>
                <li>
                    <a href="" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Mon abonnement</span>
                    </a>
                </li> -->
            @endif

            <!-- sidebar for user with admin role -->
            @if( auth()->user()->role === "admin" || auth()->user()->role === "manager" )
                <li>
                    <a href="{{ route('management.outfit.index') }}" aria-expanded="false">
                        <i class="fas fa-table"></i>
                        <span class="nav-text">Gérer les équipements</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('management.room.index') }}" aria-expanded="false">
                        <i class="fas fa-table"></i>
                        <span class="nav-text">Gérer les gymnases</span>
                    </a>
                </li>
                <hr>
                <li>
                    <a href="{{ route('management.purchase.index') }}" aria-expanded="false">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Gérer les achats</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('management.subscription.index') }}" aria-expanded="false">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Gérer les abonnés</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>