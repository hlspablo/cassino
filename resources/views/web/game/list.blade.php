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
            <div class="">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                    {{ $games->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
