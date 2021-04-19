        @extends('layouts.app')

        <title>{{ __('BDoctors - Homepage') }}</title>


        @section('content')
        <div id="app">
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
        </div>
    </div>


</div>


@endsection
