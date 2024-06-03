@extends('layouts.web')
@push('styles')
@endpush
@section('content')
    <div class="container">
        @include('includes.navbar_left')

        <div class="page__content">
            @include('includes.navbar_top')

            <div class="row">
                <div class="col-lg-6">
                    <h2>Todos os jogos</h2>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('web.game.list') }}" class="w-full" method="GET">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <input type="text" name="searchTerm" class="form-control" placeholder="Digite o nome do jogo" value="{{ $search }}">
                            <input type="hidden" name="tab" value="{{ $tab }}" id="">

                            <span class="input-group-text" style="padding-right: 5px;">
                                <button type="submit">
                                    Buscar
                                </button>
                            </span>
                        </div>
                    </form>

                </div>
            </div>
            <div class="row">
                @if($games->count() > 0)
                    @foreach($games as $game)
                        <div class="col-xl-2 col-lg-2 col-md-3 col-6 caixa-loop-elementos">
                            <a href="{{ route('web.game.index', ['slug' => $game->slug]) }}" class="inner-loop-elementos">
                                <img src="{{ asset('storage/'.$game->image) }}" alt="{{ $game->name }}" class="img-fluid rounded-3">
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
{{--                    {{ $games->links() }}--}}
                    {{ $games->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
