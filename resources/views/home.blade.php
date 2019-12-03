@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    @yield('admin.card')
                    @yield('boss.card')
                    @yield('user.card')
                {{-- <div class="card-header">User Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    一般使用者登入頁面
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
