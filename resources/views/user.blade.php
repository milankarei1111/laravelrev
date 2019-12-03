@extends('home')
@section('user.card')
    <div class="card">
        <div class="card-header">User Dashboard</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            使用者 登入頁面
        </div>
    </div>
@endsection
