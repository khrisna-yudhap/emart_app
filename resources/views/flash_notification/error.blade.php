@if (session()->has('max-product-exceeded'))
    <div class="alert alert-orange bg-orange text-white alert-dismissible fade show" role="alert">
        {{ session('max-product-exceeded') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
@endif
