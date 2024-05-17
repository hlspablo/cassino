
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>

        <!-- SEO -->
        @yield('seo')

        <meta name="robots" content="index, follow">
        <meta name="Version" content="v1.0.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- favicon -->
        <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{  asset('assets/images/favicon.png')}}" type="image/x-icon">

        <!-- Bootstrap -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- iziModal -->
        <link href="{{ asset('assets/css/iziModal.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/css/iziToast.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Fontawesome -->
        <link href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet" type="text/css" />


        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" id="theme-opt" />

        @stack('styles')

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-');
        </script>
    </head>

    <body>
        @if(!in_array(request()->route()->getName(), ['web.vgames.show']) && !empty(config('setting')->promo_text))
            <div class="banner-top">
                <p>{{ config('setting')->promo_text }}</p>
            </div>
        @endif

        <main class="page">
            @yield('content')
        </main>


        <!-- javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/iziModal.min.js') }}"></script>
        <script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        @stack('scripts')
        <x-flash></x-flash>
    </body>

</html>
