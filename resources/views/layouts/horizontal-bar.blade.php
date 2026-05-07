<div class="horizontal-bar-wrap">
    <div class="header-topnav">
        <div class="container-fluid">
            <div class=" topnav rtl-ps-none" id="" data-perfect-scrollbar data-suppress-scroll-x="true">
                <ul class="menu float-left">
                    {{-- <li class="{{ request()->is('starter/*') ? 'active' : '' }}">

                        <div>

                            <div>
                                <label class="toggle" for="drop-2">

                                    Starter Kits
                                </label>
                                <a href="#">
                                    <i class="nav-icon mr-2 i-Bar-Chart"></i>
                                    Starter Kits
                                </a>

                                <input type="checkbox" id="drop-2">
                                <ul>

                                    <li class="nav-item ">
                                        <a class="{{ Route::currentRouteName()=='dashboard' ? 'open' : '' }}"
                                            href="{{route('dashboard')}}">
                                            <i class="nav-icon mr-2 fa fa-list"></i>
                                            <span class="item-name">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('normal')}}"
                                            class="{{ Route::currentRouteName()=='normal' ? 'open' : '' }}">
                                            <i class="nav-icon mr-2 i-Clock-4"></i>
                                            <span class="item-name">Normal</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="{{ Route::currentRouteName()=='compact' ? 'open' : '' }}"
                                            href="{{route('compact')}}">
                                            <i class="nav-icon mr-2 i-Over-Time"></i>
                                            <span class="item-name">Compact</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="{{ Route::currentRouteName()=='horizontal' ? 'open' : '' }}"
                                            href="{{route('horizontal')}}">
                                            <i class="nav-icon mr-2 i-Clock"></i>
                                            <span class="item-name">Horizontal</span>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </li> --}}
                    <li class ="{{ request()->routeIs('clients.*') ? 'open' : '' }} ">
                        <div>
                            <a href="{{route('dashboard')}}" class="nav-item">
                                <i class="nav-icon mr-2 fa fa-chart-area"></i>
                                Tableau de Bord
                            </a>
                        </div>
                    </li>
                    <li class="{{ request()->is('starter/*') ? 'active' : '' }}">

                        <div>
                            <div>
                                <label class="toggle" for="drop-2">
                                    Appartements
                                </label>
                                <a href="{{route('appartements.index')}}" class="nav-item">
                                    <i class="nav-icon mr-2 fa fa-home"></i>
                                    Appartements
                                </a>

                                <input type="checkbox" id="drop-2">
                                <ul>
                                    <li class="nav-item">
                                        <a class="{{ Route::currentRouteName()=='commande.index' ? 'open' : '' }}"
                                            href="{{route('commande.index')}}">
                                            <i class="nav-icon mr-2 fa fa-list"></i>
                                            <span class="item-name">Commande</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="{{ Route::currentRouteName()=='inventaire.index' ? 'open' : '' }}"
                                            href="{{route('inventaire.index')}}">
                                            <i class="nav-icon mr-2 fa fa-list"></i>
                                            <span class="item-name">Inventaire</span>
                                        </a>
                                    </li>
                                    
                                </ul>

                            </div>
                        </div>
                    </li>

                    <li class =" {{ request()->routeIs('clients.*') ? 'open' : '' }} ">
                        <div>
                            <a href="{{route('clients.index')}}" class="nav-item">
                                <i class="nav-icon mr-2 fa fa-user"></i>
                                Clients
                            </a>
                        </div>
                    </li>
                    
                    <li>
                        <div>
                            <a href="{{route('reservations.index')}}" class="nav-item">
                                <i class="nav-icon mr-2 fa fa-recycle"></i>
                               Reservations
                            </a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <a href="{{route('clients.index')}}" class="nav-item">
                                <i class="nav-icon mr-2 fa fa-envelope"></i>
                                Facture
                            </a>
                        </div>
                    </li>
                    
                    <li class="{{ request()->is('starter/*') ? 'active' : '' }}">

                        <div>
                            <div>
                                <label class="toggle" for="drop-2">
                                    Fournisseur
                                </label>
                                <a href="{{route('fournisseurs.index')}}" class="nav-item">
                                    <i class="nav-icon mr-2 fa fa-users"></i>
                                    Fournisseur
                                </a>

                                <input type="checkbox" id="drop-2">
                                <ul>

                                    <li class="nav-item ">
                                        <a class="{{ Route::currentRouteName()=='dashboard' ? 'open' : '' }}"
                                            href="{{route('dashboard')}}">
                                            <i class="nav-icon mr-2 fa fa-list"></i>
                                            <span class="item-name">Services</span>
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="{{ Route::currentRouteName()=='compact' ? 'open' : '' }}"
                                            href="{{route('compact')}}">
                                            <i class="nav-icon mr-2 fa fa-share"></i>
                                            <span class="item-name">Prestation</span>
                                        </a>
                                    </li>
                                    
                                </ul>

                            </div>
                        </div>
                    </li>
                    
                    <li class="{{ request()->is('starter/*') ? 'active' : '' }}">

                        <div>

                            <div>
                                <label class="toggle" for="drop-2">
                                    Employés
                                </label>
                                <a href="{{route('reservations.index')}}" class="nav-item">
                                    <i class="nav-icon mr-2 fa fa-users"></i>
                                    Employés
                                </a>

                                <input type="checkbox" id="drop-2">
                                <ul>

                                    <li class="nav-item">
                                        <a class="{{ Route::currentRouteName()=='horizontal' ? 'open' : '' }}"
                                            href="{{route('horizontal')}}">
                                            <i class="nav-icon mr-2 fa fa-calendar"></i>
                                            <span class="item-name">Intervention</span>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </li>





                </ul>


            </div>
        </div>
    </div>

</div>
<!--=============== Horizontal bar End ================-->