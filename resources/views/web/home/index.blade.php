@extends('layouts.web')

@section('title', config('setting')->software_name)

@section('seo')
    <link rel="canonical" href="{{ url()->current() }}"/>
    <meta name="description" content="  ">
    <meta name="keywords" content="{{ config('setting')->software_description }}">

    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title"
          content="{{ config('setting')->software_name }} | {{ config('setting')->software_description }}"/>
    <meta property="og:description" content="{{ config('setting')->software_description }}"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:site_name" content="{{ config('setting')->software_name }}"/>
    <meta property="og:image" content="{{ asset('storage/' . config('setting')->software_logo_white) }}"/>
    <meta property="og:image:secure_url" content="{{ asset('storage/' . config('setting')->software_logo_white) }}"/>
    <meta property="og:image:width" content="1024"/>
    <meta property="og:image:height" content="571"/>

    <meta name="twitter:title" content="{{ config('setting')->software_name }}">
    <meta name="twitter:description" content="{{ config('setting')->software_description }}">
    <meta name="twitter:image"
          content="{{ asset('storage/' . config('setting')->software_logo_white) }}"> <!-- Substitua pelo link da imagem que deseja exibir -->
    <meta name="twitter:url" content="{{ url('/') }}"> <!-- Substitua pelo link da sua página -->
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/splide-core.min.css') }}">
@endpush

@section('content')
    <div class="container">
        @include('includes.navbar_left')

        <div class="page__content">
            @include('includes.navbar_top')

            <section class="modelo-destaque-jogos">
                @if(config('setting')->promo_banner)
                    <section id="image-carousel" class="splide" aria-label="">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li class="splide__slide">
                                    <a href="https://{{ config('setting')->promo_link }}">
                                        <img src="{{ asset('storage/' . config('setting')->promo_banner) }}"
                                             alt="Banner Promocional">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </section>
                @endif
                @if(count($gamesPopulars) > 0)
                    @include('includes.title', ['link' => url('/games?tab=popular'), 'title' => 'Populares', 'icon' => 'fa-duotone fa-stars'])

                    <div class="row mt-3">
                        @foreach($gamesPopulars as $game)
                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 caixa-loop-elementos">
                                <a href="{{ route('web.game.index', ['slug' => $game->slug]) }}"
                                   class="inner-loop-elementos">
                                    <img src="{{ asset('storage/'.$game->image) }}" alt="{{ $game->name }}"
                                         class="img-fluid rounded-3">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif


                @if(count($gamesSuggestions) > 0)
                    @include('includes.title', ['link' => '#', 'title' => 'Suggestões', 'icon' => 'fa-duotone fa-bolt'])

                    <div class="row mt-3">
                        @foreach($gamesSuggestions as $game)
                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 caixa-loop-elementos">
                                <a href="{{ route('web.game.index', ['slug' => $game->slug]) }}"
                                   class="inner-loop-elementos">
                                    <img src="{{ asset('storage/'.$game->image) }}" alt="{{ $game->name }}"
                                         class="img-fluid rounded-3">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if(count($games) > 0)
                    @include('includes.title', ['link' => url('/games?tab=all'), 'title' => 'Todos os Jogos', 'icon' => 'fa-duotone fa-gamepad-modern'])

                    <div class="row mt-3">
                        @foreach($games as $game)
                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 caixa-loop-elementos">
                                <a href="{{ route('web.game.index', ['slug' => $game->slug]) }}"
                                   class="inner-loop-elementos">
                                    <img src="{{ asset('storage/'.$game->image) }}" alt="{{ $game->name }}"
                                         class="img-fluid rounded-3">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

            <div class="mt-5">
                @include('includes.title', ['link' => url('painel/affiliates'), 'title' => 'Afiliados', 'icon' => 'fa-light fa-face-tongue-money', 'labelLink' => 'Menu'])
            </div>

            <section class="affiliate-block">
                <div class="affiliate-block-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="{{ asset('/assets/images/business_afiliado.png') }}" alt="" class="img-fluid">
                        </div>
                        <div class="col-lg-8">
                            <div class="affiliate-info my-3">
                                <h1>SAIBA MAIS SOBRE NOSSO <span>PROGRAMA DE AFILIADOS</span></h1>
                                <p>
                                    Trabalhe conosco como afiliado e obtenha lucros significativos por meio de suas
                                    indicações.
                                    Oferecemos condições especiais exclusivas para nossos afiliados.
                                </p>
                                <form action="{{ route('panel.affiliates.join') }}" method="post">
                                    @csrf
                                    <div class="input-group mb-3 mt-3">
                                        <input type="text" name="email" class="form-control"
                                               placeholder="Digite seu email" aria-label="Seu e-mail"
                                               aria-describedby="affiliate-mail">
                                        <button type="submit" class="input-group-text" id="affiliate-mail"><span
                                                class="mx-2">Enviar agora</span> <i class="fa-solid fa-envelope"></i>
                                        </button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <div class="mt-5">
                @include('includes.title', ['link' => url('como-funciona'), 'title' => 'F.A.Q', 'icon' => 'fa-light fa-circle-info', 'labelLink' => 'Saiba mais'])
            </div>

            @include('web.home.sections.faq')

            @include('includes.footer')
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/splide.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Splide('#image-carousel', {
                arrows: false,
                pagination: false,
                type: 'loop',
                autoplay: 'play',
            }).mount();
        });
    </script>
@endpush

