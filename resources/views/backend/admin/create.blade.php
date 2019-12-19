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
                <h3 class="box-title">新增帳號</h3>
            </div><!-- /.box-header -->
            {!! Form::open(['url'=>route('admin.user.store'), 'method'=>'POST']) !!}

                <div class="box-body table-responsive no-padding">
                    @csrf
                    <div class="form-group">
                        {{Form::label('', '信箱')}}
                        {{Form::email('email')}}
                        @if ($errors->has('email'))
                            <div class="invalid-feedbadk">
                                <strong style="color:red;">{{$errors->first('email')}}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{Form::label('', '密碼')}}
                        {{Form::password("password")}}
                        @if ($errors->has('password'))
                            <div class="invalid-feedbadk">
                                <strong style="color:red;">{{$errors->first('password')}}</strong>
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
                        @if ($errors->has('first_name'))
                            <div class="invalid-feedbadk">
                                <strong style="color:red;">{{$errors->first('last_name')}}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="box-footer text-right">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-text">取消</a>
                        {{Form::submit('儲存')}}
                    </div>{{-- /.box-footer --}}
                    <br><br>
                    ----------------{{ Form::label('title_label','測試元件') }}----------------------<br>
                    {{ Form::text('title','哈囉! 你好',['size'=>30,'placeholder'=>'123']) }}<br>
                    {{ Form::textarea('content','內容') }}<br>
                    {{ Form::label('password_label','密碼會顯示.......') }}
                    {{ Form::password('password') }}<br>
                    {{ Form::file('upload') }}<br><br>
                    {{ Form::checkbox('habit', 'reading', true) }}看書<br><br>

                    {{ Form::radio('city', 'taipei', true) }}Taipei<br>
                    {{ Form::radio('city', 'taichung') }}Taichung<br>
                    {{ Form::radio('city', 'kaohsiung') }}Kaohsiung<br><br>

                    {{ Form::select('size', ['L'=>'大','M'=>'中','S'=>'小'], 'M') }}<br><br>
                    {{ Form::selectRange('number', 10, 20) }}<br><br>
                    {{ Form::submit('submit') }}<br><br>
                    {{ Form::button('button') }}

            {!! Form::close() !!}
         </div><!-- /.box -->
        </div>
    </div>
@endsection
