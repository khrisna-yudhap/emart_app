@if (session()->has('success-register'))
    <div class="alert alert-lime alert-dismissible fade show" role="alert">
        {{ session('success-register') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
@endif

@if (session()->has('add-to-cart-success'))
    <div class="alert alert-lime bg-lime text-white alert-dismissible fade show" role="alert">
        {{ session('add-to-cart-success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
@endif

@if (session()->has('success-clear-cart'))
    <div class="alert alert-orange bg-orange text-white alert-dismissible fade show" role="alert">
        {{ session('success-clear-cart') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
@endif
