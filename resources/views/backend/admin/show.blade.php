@extends('home')
@section('admin.card')
    <div class="card">
        <div class="card-header">管理者頁面</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">查看{{$user->email}}帳號</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" class="form-control" disabled name="email" type="text" value={{$user->email}}>
                    </div>

                    <div class="form-group">
                        <label for="last_name">姓</label>
                        <input id="last_name" class="form-control" disabled name="last_name" type="text" value={{$user->first_name}}>
                    </div>

                    <div class="form-group">
                        <label for="first_name">名</label>
                        <input id="first_name" class="form-control" disabled name="first_name" type="text" value={{$user->last_name}}>
                    </div>
                </div>
                  <!-- /.box-body -->
                <div class="box-footer text-right">
                    <a href={{route('admin.user.index')}} class="btn btn-text">回列表</a>
                </div>
        </div>
    </div>
@endsection
