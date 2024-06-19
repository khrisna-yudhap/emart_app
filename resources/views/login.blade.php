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
        <div class="container container-tight py-4">
            <div class="text-center">
                {{-- LOGO --}}
                <a href="{{ route('index') }}" class="navbar-brand navbar-brand-autodark"><img
                        src="{{ asset('assets/img/emart-logo.png') }}" height="120" alt="logo"></a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center text-lime mb-4">Sign In to your account</h2>

                    @include('flash_notification.success')

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="close"></button>
                        </div>
                    @endif
                    <form action="{{ route('login.post') }}" method="POST" autocomplete="off" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="your@email.com" name="email" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="Your password" autocomplete="off" type="password" name="password">

                        </div>
                        <div class="mb-2">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input bg-lime" />
                                <span class="form-check-label">Remember me on this device</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-lime w-100">Sign in</button>
                        </div>
                    </form>
                    <div class="text-center text-muted mt-3">
                        Don't have account yet? <a href="{{ route('register') }}" class="text-lime" tabindex="-1">Sign
                            up</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('assets/dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('assets/dist/js/demo.min.js') }}" defer></script>
</body>

</html>
