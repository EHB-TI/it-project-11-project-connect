@extends('components.head')
@section('title', 'Home')
@section('content')
    <!-- Hier voeg je de content van de pagina toe -->
    <div onclick="window.location.href='{{ route('spaces.create') }}'" class="btn btn-primary btn-block" style="width: 100%; max-width: 1319px; height: 50px; flex-shrink: 0; border-radius: 22px; border: 1px solid #3D3D3D;">
        <span style="display: flex; justify-content: center; align-items: center; height: 100%;">
            <span style="font-size: 2em;">
                +
            </span>
        </span>
    </div>

    
@endsection
