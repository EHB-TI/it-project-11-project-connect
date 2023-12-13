@extends('components.head')
@section('title', 'Home')

    <div class="app-container">
        @include('components.nav-bar')
        <div class="app-content ml-[max(250px,_20%)] p-5">
            <div class="btn btn-primary btn-block" style="width: 100%; max-width: 1319px; height: 50px; flex-shrink: 0; border-radius: 22px; border: 1px solid #3D3D3D;">
                <span style="display: flex; justify-content: center; align-items: center; height: 100%;">
                    <span style="font-size: 2em;">
                        +
                    </span>
                </span>
            </div>
    
        </div>
    
    </div>

@extends('components.footer')
@section('title', 'Home')