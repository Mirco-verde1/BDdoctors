@extends('layouts.app')

<title>{{ __('BDoctors - Show') }}</title>

@section('content')

<div id="app">
    <div class="container margin-top-container">
        <div class="row">

            @if(isset($user->id))

            <div class="col-xl-12 col-lg-12 mx-auto">
                <nav class="secondary-nav">
                    <div>
                        <ul class="d-flex justify-content-around">
                            <li class="active-nav">
                                Info Generali
                            </li>
                            <li>
                                <a href="#reviews-nav">Recensioni</a>
                            </li>
                            <li>
                                <a href="#curriculum-nav">Curriculum</a>
                            </li>
                            <li>
                                <a href="#add-reviews-nav">Lascia una recensione</a>
                            </li>
                        </ul>
                    </div>
                </nav>

                {{-- box con shadow --}}
                <div class="box-general">
                    <div class="profile">

                        <div class="row">

                            <figure class="doctor-pic-show-container">
                                <img class="doctor-pic-show" src="{{ URL::asset('storage/'.$user->detail->pic) }}"
                                    alt="{{$user->name}} {{$user->lastname}}">
                            </figure>

                            <div class="col-lg-7 offset-md-1 col-md-8 info">
                                <h1>{{$user->name}} {{$user->lastname}}</h1>

                                @foreach ($user->departments as $department)
                                    <h5 class="department">{{$department->type}}</h5>
                                @endforeach

                                @php
                                    $voteSum = 0;

                                    foreach ($user->votes as $vote) {
                                        $voteSum += $vote->value;
                                    }

                                    $voteAverage = $voteSum / count($user->votes);
                                @endphp

                                <span>
                                    Media voti:
                                    @for ($f = 0; $f < intval(ceil($voteAverage)); $f++)
                                        <i class="fas fa-star"></i>
                                    @endfor

                                    @for ($e = 0; $e < (5 - intval(ceil($voteAverage))); $e++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                </span>

                                <form action="{{ route('send.vote', $user->id) }}" method="post">
                                    @csrf
                                    @method('POST')

                                    <div class="row">
                                        <label class="col-md-12" for="votes[]">Vota</label>
                                        <select class="form-control col-md-4" id="votes[]" name="votes[]">
                                            @foreach ($votes as $vote)
                                            <option value="{{ $vote->id }}">{{ $vote->value }}</option>
                                            @endforeach
                                        </select>
                                        <input class="btn btn-success offset-md-2 col-md-2" type="submit" value="Invia">
                                    </div>
                                </form>

                                {{-------------------------------------------- qui inserire medical services --------------------------------------------}}

                            </div>

                        </div>
                        <div class="column">
                            <span><b>Indirizzo:</b> {{$user->address}}</span>
                            <br>
                            <span><b>Email:</b> {{$user->email}}</span>
                            <br>
                            <span><b>Telefono:</b> {{$user->detail->phone}}</span>
                        </div>
                    </div>
                </div>


                {{--************ RECENSIONI ************--}}



                <nav id="reviews-nav" class="secondary-nav margin-top-container">
                    <div>
                        <ul class="justify-content-center">
                            <li>
                                <b class="active-nav">Recensioni</b>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="box-general">
                    <div class="profile">

                        <div class="row justify-content-md-center">

                            @foreach ($user->reviews as $review)
                                <div class="container-review col-md-11">
                                    <div class="header-review d-flex justify-content-between">
                                        <h5 class="text-capitalize"><b>{{$review->name}}</b></h5>
                                        <h5><b>{{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y')}}</b></h5>
                                    </div>
                                    <span>{{$review->body}}</>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>


                {{--************ CURRICULUM ************--}}

                <nav id="curriculum-nav" class="secondary-nav margin-top-container">
                    <div>
                        <ul class="justify-content-center">
                            <li>
                                <b class="active-nav">Curriculum</b>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="box-general">
                    <div class="profile">
                        <div class="row">
                            <div class="curriculum">
                                @markdown($user->detail->curriculum)
                            </div>
                        </div>
                    </div>
                </div>

                {{--************ RECENSIONE ************--}}

                <nav id="add-reviews-nav" class="secondary-nav margin-top-container">
                    <div>
                        <ul class="justify-content-center">
                            <li>
                                <h1 class="active-nav">Lascia una recensione</h1>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="box-general">
                    <div class="profile">
                        <div class="">
                            <form action="{{ route('review.store', [ 'user_id' => $user->id]) }}" method="post">
                                @csrf
                                @method('POST')

                                <div class="form-group position-relative">
                                    <label for="name" class="form-label">Nome</label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}"
                                        type="text" name="name" placeholder="Nome">
                                    <div class="invalid-tooltip">
                                        {{ $errors->first('name') }}
                                    </div>
                                </div>

                                <div class="form-group position-relative">
                                    <label for="email">Email</label>
                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}"
                                        type="text" name="email" placeholder="Email">
                                    <div class="invalid-tooltip">
                                        {{ $errors->first('email') }}
                                    </div>
                                </div>

                                <div class="form-group position-relative">
                                    <label for="body">Testo </label>
                                    <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"
                                        type="text" name="body" placeholder="Testo" rows="6"></textarea>
                                    <div class="invalid-tooltip">
                                        {{ $errors->first('body') }}
                                    </div>
                                </div>

                                <input class="btn btn-success" type="submit" value="Invia">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @else

                <div class="container">
                    <div class="row">
                        <div class="text-left row">
                            <div class="col-lg-7 col-md-7 col-sm-11 text">
                                <span>Spiacenti, il medico che hai richiesto non è presente nel nostro database.</span>
                                <br>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-11">
                                <img class="img-fluid doctor-clipart" src="../../../img/doctor-clipart.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            @endif

        </div>
        {{-- row --}}

    </div>
    {{-- container --}}

</div>

@endsection
