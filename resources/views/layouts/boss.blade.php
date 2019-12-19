@extends('home')
@section('boss.card')
    <div class="card">
        <div class="card-header">boss Dashboard</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            主管頁面
        </div>
    </div>
@endsection
