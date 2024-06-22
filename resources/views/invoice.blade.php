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

    <div class="card card-lg">
        <div class="card-body">
            <div class="row d-flex justify-content-between">
                <div class="col-3">
                    <p class="h3">Client Address</p>
                    <address>
                        {{ $userData->address }} <br><br>
                        {{ $userData->email . ' | ' . $userData->phone }}
                    </address>
                </div>
                <div class="col-4 d-block" style="text-align: end">
                    <p class="h1 text-muted mb-3">Payment Status</p>
                    <br>
                    @if ($orderData->status == 'unpaid')
                        <span class="bg-orange-lt py-2 px-6 h3 " style="border-radius: 10px;">Unpaid</span>
                        <br><br><br>
                        <p class="text-orange">Please complete the payment before ordering again.</p>
                    @elseif($orderData->status == 'paid')
                        <span class="bg-lime-lt py-2 px-6 h3 " style="border-radius: 10px;">Paid</span>
                    @endif


                    {{-- <address>
                        {{ $userData->address }} <br><br>
                        {{ $userData->email . ' | ' . $userData->phone }}
                    </address> --}}
                </div>

            </div>
            <div class="col-12 mb-5 mt-3">
                <h1>{{ $orderData->invoice_id }}</h1>
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

            <p class="text-muted text-center mt-5">Thank you very much for doing business with us!</p>
        </div>
    </div>
@endsection
