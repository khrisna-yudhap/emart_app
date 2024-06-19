<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ $title }}</title>
    <!-- CSS files -->
    <link href="{{ asset('assets/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/demo.min.css') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <script src="{{ asset('assets/dist/js/demo-theme.min.js') }}"></script>
    <div class="page page-center">
        <div class="container container-tight">
            <div class="text-center">
                <a href="{{ route('index') }}" class="navbar-brand navbar-brand-autodark"><img
                        src="{{ asset('assets/img/emart-logo.png') }}" height="120" alt="logo"></a>
            </div>

            <form class="card card-md col-lg" action="{{ route('user.post') }}" method="POST" autocomplete="off"
                novalidate>
                @csrf
                <div class="card-body">
                    <h1 class="card-title text-center text-lime h2 mb-4"><b>Register Your E-Mart Account</b></h1>
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                            placeholder="Jonathan" name="first_name" value="{{ old('first_name') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                            placeholder="Doe" name="last_name" value="{{ old('last_name') }}">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="your@email.com" name="email" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="email" class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="085123123" name="phone" value="{{ old('phone') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group input-group-flat">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Your Password" autocomplete="off" name="password">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter your address">{{ old('address') }}</textarea>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-lime w-100">Create new account</button>
                    </div>

                    <div class="text-center text-muted mt-3">
                        Already have account? <a href="{{ route('login') }}" class="text-lime" tabindex="-1">Sign
                            in</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('assets/dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('assets/dist/js/demo.min.js') }}" defer></script>
</body>

</html>
