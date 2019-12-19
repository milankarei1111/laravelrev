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
        <div class="box box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">編輯帳號</h3>
            </div><!-- /.box-header -->

            {{ Form::model($user, ['action'=>['Backend\AdminController@update', $user->id], 'method'=>'PATCH']) }}
                <div class="box-body table-responsive no-padding">
                    @csrf
                    <div class="form-group">
                        {{Form::label('', '信箱')}}
                        {{Form::text('email')}}
                        @if ($errors->has('email'))
                            <div class="invalid-feedbadk">
                                <strong style="color:red;">{{$errors->first('email')}}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{Form::label('', '姓氏')}}
                        {{Form::text('first_name')}}
                        @if ($errors->has('first_name'))
                            <div class="invalid-feedbadk">
                                <strong style="color:red;">{{$errors->first('first_name')}}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{Form::label('', '名字')}}
                        {{Form::text('last_name')}}
                        @if ($errors->has('last_name'))
                            <div class="invalid-feedbadk">
                                <strong style="color:red;">{{$errors->first('last_name')}}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="box-footer text-right">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-text">取消</a>
                        {{Form::submit('儲存')}}
                    </div>{{-- /.box-footer --}}
            {!! Form::close() !!}
         </div><!-- /.box -->
        </div>
    </div>
@endsection
