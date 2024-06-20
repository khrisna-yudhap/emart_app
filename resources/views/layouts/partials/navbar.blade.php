      <!-- Navbar -->
      <header class="navbar navbar-expand-md navbar-overlap d-print-none" data-bs-theme="dark">
          <div class="container-xl">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                  aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                  <a href="{{ route('admin.index') }}">
                      <img src="{{ asset('assets/img/emart-logo.png') }}" width="150" alt="Tabler" class="">
                  </a>
              </h1>
              <div class="navbar-nav flex-row order-md-last">
                  <div class="d-none d-md-flex">
                      <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                          data-bs-toggle="tooltip" data-bs-placement="bottom">
                          <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                              viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                              stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path
                                  d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                          </svg>
                      </a>
                      <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                          data-bs-toggle="tooltip" data-bs-placement="bottom">
                          <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                              viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                              stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                              <path
                                  d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                          </svg>
                      </a>

                  </div>
                  <div class="nav-item dropdown">
                      <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                          aria-label="Open user menu">

                          <div class="d-none d-xl-block ps-2">
                              <div>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }} <small
                                      class="text-muted">(logged in)</small></div>
                              <div class="mt-1 small text-muted">Administrator</div>
                          </div>
                      </a>
                      <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                          <form action="{{ route('logout') }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button class="dropdown-item">Sign Out</button>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="collapse navbar-collapse" id="navbar-menu">
                  <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                      <ul class="navbar-nav">
                          <li class="nav-item ">
                              <a class="nav-link " href="{{ route('admin.index') }}">
                                  <span
                                      class="nav-link-title @if ($pageIndex == 0) text-lime h3 @endif mb-0">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"
                                          class="icon icon-tabler icons-tabler-outline icon-tabler-chart-pie">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                          <path
                                              d="M10 3.2a9 9 0 1 0 10.8 10.8a1 1 0 0 0 -1 -1h-6.8a2 2 0 0 1 -2 -2v-7a.9 .9 0 0 0 -1 -.8" />
                                          <path d="M15 3.5a9 9 0 0 1 5.5 5.5h-4.5a1 1 0 0 1 -1 -1v-4.5" />
                                      </svg>
                                      Dashboard
                                  </span>
                              </a>
                          </li>
                          <li class="nav-item ">
                              <a class="nav-link " href="{{ route('admin.users') }}">

                                  <span
                                      class="nav-link-title @if ($pageIndex == 1) text-lime h3 @endif  mb-0">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"
                                          class="icon icon-tabler icons-tabler-outline icon-tabler-user-cog">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                          <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                          <path d="M6 21v-2a4 4 0 0 1 4 -4h2.5" />
                                          <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                          <path d="M19.001 15.5v1.5" />
                                          <path d="M19.001 21v1.5" />
                                          <path d="M22.032 17.25l-1.299 .75" />
                                          <path d="M17.27 20l-1.3 .75" />
                                          <path d="M15.97 17.25l1.3 .75" />
                                          <path d="M20.733 20l1.3 .75" />
                                      </svg>
                                      Users Management
                                  </span>
                              </a>
                          </li>
                          <li class="nav-item dropdown ">
                              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                  data-bs-auto-close="false" role="button" aria-expanded="true">
                                  <span
                                      class="nav-link-title @if ($pageIndex == 2) text-lime h3 @endif  mb-0">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"
                                          class="icon icon-tabler icons-tabler-outline icon-tabler-package">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                          <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                          <path d="M12 12l8 -4.5" />
                                          <path d="M12 12l0 9" />
                                          <path d="M12 12l-8 -4.5" />
                                          <path d="M16 5.25l-8 4.5" />
                                      </svg>
                                      Products Management
                                  </span>
                              </a>
                              <div class="dropdown-menu">
                                  <div class="dropdown-menu-columns">
                                      <div class="dropdown-menu-column">
                                          <a class="dropdown-item " href="{{ route('product.index') }}">
                                              Product
                                          </a>
                                          <a class="dropdown-item " href="{{ route('category.index') }}">
                                              Category
                                          </a>
                                      </div>
                                  </div>
                              </div>
                          </li>

                      </ul>
                  </div>
              </div>
          </div>
      </header>
