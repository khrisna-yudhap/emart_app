@if (session()->has('success-register'))
    <div class="alert alert-lime alert-dismissible fade show" role="alert">
        {{ session('success-register') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
@endif
