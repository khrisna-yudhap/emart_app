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
            <div class="row">
                <div class="col-3">
                    <p class="h3">Client Contact</p>
                    <address>
                        {{ $userData->address }} <br><br>
                        {{ $userData->email . ' | ' . $userData->phone }}
                    </address>
                </div>
                <div class="col-12 my-5">
                    <h1>{{ $orderData->invoice_id }}</h1>
                </div>
            </div>
            <table class="table table-transparent table-responsive">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 1%"></th>
                        <th>Product</th>
                        <th class="text-center" style="width: 1%">Qnt</th>
                        <th class="text-end" style="width: 1%">Unit</th>
                        <th class="text-end" style="width: 1%">Amount</th>
                    </tr>
                </thead>
                <tr>
                    <td class="text-center">1</td>
                    <td>
                        <p class="strong mb-1">Logo Creation</p>
                        <div class="text-muted">Logo and business cards design</div>
                    </td>
                    <td class="text-center">
                        1
                    </td>
                    <td class="text-end">$1.800,00</td>
                    <td class="text-end">$1.800,00</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>
                        <p class="strong mb-1">Online Store Design &amp; Development</p>
                        <div class="text-muted">Design/Development for all popular modern browsers</div>
                    </td>
                    <td class="text-center">
                        1
                    </td>
                    <td class="text-end">$20.000,00</td>
                    <td class="text-end">$20.000,00</td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>
                        <p class="strong mb-1">App Design</p>
                        <div class="text-muted">Promotional mobile application</div>
                    </td>
                    <td class="text-center">
                        1
                    </td>
                    <td class="text-end">$3.200,00</td>
                    <td class="text-end">$3.200,00</td>
                </tr>
                <tr>
                    <td colspan="4" class="strong text-end">Subtotal</td>
                    <td class="text-end">$25.000,00</td>
                </tr>
                <tr>
                    <td colspan="4" class="strong text-end">Vat Rate</td>
                    <td class="text-end">20%</td>
                </tr>
                <tr>
                    <td colspan="4" class="strong text-end">Vat Due</td>
                    <td class="text-end">$5.000,00</td>
                </tr>
                <tr>
                    <td colspan="4" class="font-weight-bold text-uppercase text-end">Total Due</td>
                    <td class="font-weight-bold text-end">$30.000,00</td>
                </tr>
            </table>
            <p class="text-muted text-center mt-5">Thank you very much for doing business with us. We look forward to
                working with
                you again!</p>
        </div>
    </div>
@endsection
