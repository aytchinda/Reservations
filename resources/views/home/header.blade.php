<header class="header-area">
    <!-- Navbar Area -->
    <div class="oneMusic-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="oneMusicNav">

                    <!-- Nav brand -->
                    <a href="{{ url('/') }}" class="nav-brand"><img src="{{ asset('img/core-img/logo.png') }}"
                            alt="Logo"></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>


                                <li><a href="{{ url('/contact') }}">Contact</a></li>
                            </ul>

                            <!-- Login/Register & Cart Button -->
                            <div class="login-register-cart-button d-flex align-items-center">
                                <!-- Login/Register -->
                                @if (Route::has('login'))
                                    @auth
                                        <div class="login-register-btn mr-50">
                                            <span>Bienvenue, {{ Auth::user()->name }}</span>
                                            <a href="{{ url('/') }}">Home</a>
                                             <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    @else
                                        <div class="login-register-btn mr-50">
                                            <a href="{{ route('login') }}" id="loginBtn">Login</a>
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}" id="registerBtn">Register</a>
                                            @endif
                                        </div>
                                    @endauth
                                @endif

                                <!-- Cart Button -->
                                <div class="cart-btn">
                                    <p><span class="icon-shopping-cart"></span> <span class="quantity">1</span></p>
                                </div>
                            </div>
                        </div>
                        <!-- Nav End -->

                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
