@if (Auth()->check())
    <div class="user-details w-100 bg-lime ">
        <div class="container d-flex justify-content-end">
            <div class="d-flex align-items-center gap-2">
                <div class="badge p-2 bg-lime cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="150" height="50" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-user-square-rounded">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
                        <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                        <path d="M6 20.05v-.05a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.05" />
                    </svg>
                    <span class="text-white" style="font-size: 1rem">

                        {{ Auth()->user()->first_name . ' ' . Auth()->user()->last_name }}

                    </span>
                </div>
                |
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button style="border:none;" class="bg-lime text-white">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                            <path d="M9 12h12l-3 -3" />
                            <path d="M18 15l3 -3" />
                        </svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
@endif
<div class="header w-100 bg-white py-1 shadow" style="border-bottom: 1px solid #eee;">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="brand-logo">
            <a href="{{ route('index') }}">
                <img src="{{ asset('assets/img/emart-logo.png') }}" alt="e-mart" width="180">
            </a>
        </div>

        <div class="menu-list p-2 d-flex gap-3 align-items-center">
            @if (Auth()->check())
                <a href="{{ route('cart.index') }}" class="btn btn-orange position-relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 17h-11v-14h-2" />
                        <path d="M6 5l14 1l-1 7h-13" />
                    </svg>
                    @if ($cartItemTotal != 0)
                        <span class="badge bg-lime badge-notification badge-pill">{{ $cartItemTotal }}</span>
                    @endif
                    Cart
                </a>
            @else
                <span class="h3 mb-0">
                    <a class="btn btn-lime text-white" href="{{ route('login') }}">Login</a>
                    <a class="btn bg-transparent text-orange" href="{{ route('register') }}">Sign Up</a>
                </span>
            @endif
        </div>
    </div>
</div>
