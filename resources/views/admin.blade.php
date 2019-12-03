@extends('home')
@section('admin.card')
    <div class="card">
        <div class="card-header">admin Dashboard</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            管理者頁面
        </div>
    </div>
@endsection
