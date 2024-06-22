@extends('layouts.front_main')

@section('content')
    <a class="btn btn-dark my-3" href="{{ route('index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
        </svg>
        Back</a>

    @include('flash_notification.success')
    <div class="card card-md">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h1>
                        My Cart
                    </h1>
                </div>
            </div>
            <table class="table table-transparent table-responsive " style="vertical-align:middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 1%">No.</th>
                        <th class="text-center" style="width: 15%">Product</th>
                        <th></th>
                        <th class="text-center" style="width: 1%">Quantity</th>
                        <th class="text-center" style="width: 10%;">Price</th>
                        <th class="text-center" style="width: 10%">Total</th>
                    </tr>
                </thead>
                @if (count($cart_items) == 0)
                    <tr>
                        <td colspan="8" class="text-muted text-center">There's nothing in your cart yet.</td>
                    </tr>
                @endif
                @foreach ($cart_items as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center"><img src="{{ asset('storage/product_img/' . $item->product_image) }}"
                                alt="#" style="max-height: 70px">
                        </td>
                        <td>
                            <p class="strong mb-1">{{ $item->product_name }}</p>
                            <div class="text-muted">{{ $item->product_desc }}</div>
                        </td>
                        <td class="text-center">
                            {{ $item->item_quantity }}
                        </td>
                        <td class="text-center">Rp. {{ $item->price }}</td>
                        <td class="text-center">Rp. {{ $item->item_price }}</td>
                    </tr>
                @endforeach
                @if (count($cart_items) != 0)
                    <tr>
                        <td></td>
                        <td colspan="4" class="strong text-end">Subtotal</td>
                        <td class="text-center text-lime h3 mb-0">Rp. {{ $subTotal }}</td>
                    </tr>
                @endif
            </table>

            @if (count($cart_items) != 0)
                <div class="action-panel d-flex gap-3 justify-content-between">
                    <form action="{{ route('cart.destroy') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">
                        <button class="btn bg-red text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 7l16 0" />
                                <path d="M10 11l0 6" />
                                <path d="M14 11l0 6" />
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                            </svg>
                            Clear Shopping Cart</button>
                    </form>

                    <form action="{{ route('order.checkout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth()->User()->id }}">
                        <input type="hidden" name="total_price" value="{{ $subTotal }}">
                        <button class="btn btn-lime" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 12l5 5l10 -10" />
                                <path d="M2 12l5 5m5 -5l5 -5" />
                            </svg>
                            Check out
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </div>
@endsection
