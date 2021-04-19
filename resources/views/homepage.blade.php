<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
        <!-- Styles -->
         <link rel="stylesheet" href="{{asset('css/app.css')}}">
         <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <title>BDoctors - Home</title>
    </head>
    <body>
        <div id="app">
            @include('layouts/guest/partials/navbar')
            <div class="container-nav d-flex justify-content-center">
            <div>
            </div>
            </div>
            <div class="jumbotron">
            <div class="jumbotron-container-title scale-in-center">
                <span class="title"> Cerca il tuo dottore online</span>
                <br>
                <span class="subtitle">BDoctors</span>

                <search-component></search-component>

            </div>
            </div>
            <div>
                <h1 class="title-carousel">Dottori in evidenza </h1>
            </div>
            @include('layouts/guest/partials/carousel')
            @include('layouts/guest/partials/footer')

        </div>
    </div>
    @include('layouts/guest/partials/carousel')

</div>



@endsection
