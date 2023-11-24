<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">

        <div class="d-flex flex-row">
            <a class="navbar-brand" href="{{ route('home') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">  Каталог  </button>
                <ul class="dropdown-menu" style="">
                    @foreach ($categories as $category)
                        <li><a class="dropdown-item" href="{{ route('catalog.category', ['catagory' => $category->slug]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Поиск" aria-label="Поиск">
                <button class="btn btn-outline-dark" type="submit"><ya-tr-span data-index="244-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Search" data-translation="Поиск" data-ch="1" data-type="trSpan">Поиск</ya-tr-span></button>
            </form>
        </div>
        <div class="d-flex flex-row">
            <div class="ms-3">
                <a href="{{ route('wishlist') }}" class="btn btn-primary position-relative mr-4">
                    Избранное
                    @if($countWishList !== 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $countWishList }}
                            <span class="visually-hidden">непрочитанные сообщения</span>
                        </span>
                    @endif
                </a>
                {{-- <button type="button" class="btn btn-primary position-relative mr-4">
                    Избранное
                    @if($countWishList !== 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $countWishList }}
                            <span class="visually-hidden">непрочитанные сообщения</span>
                        </span>
                    @endif

                </button> --}}
            </div>
            <div class="mx-3">
                <button type="button" class="btn btn-primary position-relative">
                    Корзина
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3
                        <span class="visually-hidden">непрочитанные сообщения</span>
                    </span>
                </button>
            </div>

            <div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>


    </div>
</nav>