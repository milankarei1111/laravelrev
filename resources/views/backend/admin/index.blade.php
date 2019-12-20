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
            @if (Session::has('meassage'))
                <div class="alert alert-info">{{Session::get('meassage')}}</div>
            @endif
            <div class="box box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">帳號列表</h3>
                    <div class="no-margin pull-right">
                        <a href="{{route('admin.user.create')}}" class="btn btn-primary btn-md">
                            <i class="fa fa-plus fa-fw"></i> 新增帳號
                        </a>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th class="text-center" style="width: 4em;">#</th>
                            <th class="text-left">信箱</th>
                            <th class="text-left">姓氏</th>
                            <th class="text-left">名字</th>
                            <th class="text-center" style="width: 4em;">編輯</th>
                            {{-- <th class="text-center" style="width: 4em;">刪除</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>{{ $user->first_name}}</td>
                                    <td>{{ $user->last_name}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-default btn-xs" href="{{ route('admin.user.edit', $user->id) }}">
                                            編輯
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-default btn-xs" href="{{ route('admin.user.show', $user->id) }}">
                                            查看
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="999" class="text-center">查無資料!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>{{-- /.box-body --}}

                <div class="box-footer clearfix">
                    {{$users->links()}}
                </div>{{-- /.box-footer --}}
            </div><!-- /.box -->
        </div>
    </div>
@endsection
