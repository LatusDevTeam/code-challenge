@extends('layouts/wrapper')

@section('layout')
    <header class="header"></header>

    <div class="container-fluid main-content">
        <div class="row">
            <div class="page col-md-9 offset-md-3 col-lg-10 offset-lg-2">
                <div class="page-header">
                    <h1>@yield('page-header')</h1>
                </div>

                @yield('content')

            </div>
        </div>
    </div>
@endsection
