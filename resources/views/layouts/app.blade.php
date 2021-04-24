<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('BDoctors') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    {{-- Braintree --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

    {{-- Swiper --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>
<body>
    <div id="app">

        <go-top bg-color="#1DB487" :bottom="50"></go-top>

        @include('layouts/guest/partials/navbar')

        <main class="py-3 margin-top-container">

            @yield('content')

        </main>

        @include('layouts/guest/partials/footer')
    </div>

    <script>
        var button = document.querySelector('#submit-button');
        braintree.dropin.create({
        authorization: "sandbox_x6mvdvj5_r7czy6mhvckbb4v2",
        container: '#dropin-container'
        }, function (createErr, instance) {
        button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
        $.get('{{ route('payment.make') }}', {payload}, function (response) {
        if (response.success) {
        alert('Payment successfull!');
        } else {
        alert('Payment failed');
        }
        }, 'json');
        console.log(err);
        });
        });
        });
        </script>
</body>
</html>
