@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    @yield('admin.card')
                    @yield('boss.card')
                    @yield('user.card')
            </div>
        </div>
    </div>
</div>
@endsection
