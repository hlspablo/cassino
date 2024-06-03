@extends('layouts.web')

@push('styles')

<style>
    .back-button {
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 1000;
        font-size: 24px;
        background-color: #0a0a0a;
        height: 45px;
        width: 45px;
        display: flex;
        justify-content: center;
        border-radius: 100px;
        align-items: center;
    }
    .icon-color {
        color: #fff;
    }
</style>

@endpush

@section('content')
   <div class="playgame">
       <div class="playgame-body">
           <iframe src="{{ $gameUrl }}" class="game-full"></iframe>
           <!-- Back Button -->
           <a href="javascript:history.back()" class="back-button">
               <i class="fas fa-arrow-left icon-color"></i>
           </a>
       </div>
   </div>

@endsection

@push('styles')

@endpush
