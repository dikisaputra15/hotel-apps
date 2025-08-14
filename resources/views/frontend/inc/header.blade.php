<nav class="navbar navbar-expand-lg px-lg-3 py-lg-2 shadow sticky-top">
    <div class="container">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="/"> <span class="h5 fw-bold fs-3"> Lippo Carita </span> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Lippo Carita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                          <a class="nav-link {{ Request::routeIs('index*') ? 'active' : ''}}" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link me-2 {{ Request::is('rooms*') ? 'active' : ''}} " href="/rooms">Rooms</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link me-2 {{ Request::is('facilities*') ? 'active' : ''}}" href="/facilities">Facilities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-2 {{ Request::is('about*') ? 'active' : ''}}" href="/about">About</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link me-2 {{ Request::is('contact*') ? 'active' : ''}}" href="/contact">Contact</a>
                        </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link me-2 {{ Request::is('login') ? 'active' : ''}}" href="/login">Login</a>
                        </li>
                    @endguest

                        @if(auth()->user())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                            </a>
                            <ul class="dropdown-menu ">
                                @if(auth()->user()->is_admin == 1)
                                    <li><a class="dropdown-item" href="/dashboard">
                                        <i class="bi bi-pc-display" style="font-size:15px"></i>&nbsp; My Dashboard</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                <li><a class="dropdown-item mt-2 mb-2" href="/myaccount">
                                    <i class="bi bi-person-vcard-fill" style="font-size:15px"></i> &nbsp;My account</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item mt-2 mb-2" href="/history">
                                    <i class="bi bi-cart-check-fill" style="font-size:15px" aria-hidden="true"></i>&nbsp; history</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item mt-2 mb-2" href="/logout">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>.logout{fill:#ff1100}</style><path class="logout" d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/></svg> &nbsp; logout</a></li>
                            </ul>
                        </li>
                        @endif


                </ul>

            </div>
        </div>
    </div>
  </nav>

  {{-- ketika di scroll gaterlalu keliatan --}}

