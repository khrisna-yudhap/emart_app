@extends('layouts.front_main')

@section('content')
    <div class="page-welcomer my-5">
        <h1 class="mb-0" style="color: #555">Hello, welcome to E-Mart!
            <br>
            <span style="font-weight: 300">
                What do you want to buy today?
            </span>
        </h1>
    </div>
    @include('flash_notification.success')
    @include('flash_notification.error')
    <div class="card mt-3" style="border: none;">
        <div class="card-body">
            <div class="card-title mb-5">
                <span class="h3 text-muted">Our Product</span>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-2 mb-3">
                        <div class="card py-3 px-3 d-flex justify-content-center">
                            <img class="align-self-center mb-3"
                                src="{{ asset('storage/product_img/' . $product->product_image) }}"
                                style="min-height: 150px; max-height: 150px">
                            <h3>{{ Str::limit($product->product_name, 15) }}</h3>
                            <span>{{ Str::limit($product->product_desc, 32) }}</span>
                            <span class="h3 mb-0 mt-2 text-lime">Rp. {{ $product->price }}</span>
                            <span class="mb-3 text-orange">Stock : {{ $product->stock }}</span>

                            @if (Auth()->check())
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <button type="submit" class="btn btn-lime"
                                        {{ $product->stock == 0 ? 'disabled' : '' }}>
                                        {{ $product->stock == 0 ? 'Out of stock' : 'Add to cart' }}
                                    </button>
                                </form>
                            @else
                                <button onclick="redirect()" class=" btn btn-lime"
                                    {{ $product->stock == 0 ? 'disabled' : '' }}>
                                    {{ $product->stock == 0 ? 'Out of stock' : 'Add to cart' }}
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function redirect() {
            var url = "{{ route('login') }}";
            window.location.href = (url);
        }
    </script>
@endpush
