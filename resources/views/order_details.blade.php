@extends('layouts.main')

@section('content')
    <!-- Page header -->
    <div class="page-header  d-print-none text-white">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Detail Order
                    </div>
                    <h2 class="page-title">
                        {{ $orderData->invoice_id }}
                    </h2>
                </div>

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards mb-4">
                <div class="col-12">
                    <div class="row row-cards">

                    </div>
                </div>

            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header py-4 px-6">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="card-title h1 mb-3">Customer Data</h3>
                                <ul style="list-style: none; padding-left: 0;">
                                    <li><span
                                            class="mb-0 h4 text-lime">{{ $userData->first_name . ' ' . $userData->last_name }}</span>
                                    </li>
                                    <li><span class="text-muted">{{ $userData->email }}</span></li>
                                    <li> <span class="text-muted">{{ $userData->phone }}</span></li>
                                    <li class="mt-2"><span class="text-muted ">{{ $userData->address }}</span></li>
                                </ul>
                            </div>

                        </div>

                    </div>
                    <div class="card-body py-4 px-6">
                        <div class="card-title">Order List</div>
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
                            <tbody>
                                @foreach ($cartData as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center"><img
                                                src="{{ asset('storage/product_img/' . $item->product_image) }}"
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
                            </tbody>


                            <tr>
                                <td></td>
                                <td colspan="4" class="strong text-end">Subtotal</td>
                                <td class="text-center text-lime h3 mb-0">Rp. {{ $subTotal }}</td>
                            </tr>

                        </table>

                    </div>



                </div>
            </div>

        </div>
    </div>
@endsection
