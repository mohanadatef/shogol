@extends('includes.admin.master_admin')
@section('title')
   {{$custom[strtolower('Delete' )]??"lang not found"}}{{$custom[strtolower('Index')]??"lang not found"}}
@endsection
@section('head_style')
    @include('includes.admin.dataTables.head_DataTables')
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$custom[strtolower('User')]??"lang not found"}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??"lang not found"}}</a></li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('User')]??"lang not found"}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @include('acl::user.filter')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    {{$custom[strtolower('Delete_Index_Message')]??"lang not found"}}
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{$custom[strtolower('user_Name')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Full_Name')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Email')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Mobile')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Role')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Avatar')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('action')]??"lang not found"}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($datas as $data)
                                        <tr id="data-{{$data->id}}">
                                            <td id="user-name-{{$data->id}}">{{$data->username}}</td>
                                            <td id="full-name-{{$data->id}}">{{$data->fullname}}</td>
                                            <td id="email-{{$data->id}}">{{$data->email}}</td>
                                            <td id="mobile-{{$data->id}}">{{$data->mobile}}</td>
                                            <td id="role-{{$data->id}}">{{$data->role}}</td>
                                            <td id="avatar-{{$data->id}}"><img src="{{ getImag($data->avatar,'User') }}"
                                                                              id="avatar-{{$data->id}}" style="width:100px;height: 100px"></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary btn-block btn-sm"
                                                        onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                        data-target="#modal-restore">
                                                    <i class="fa fa-edit"></i> {{$custom[strtolower('Restore')]??"lang not found"}}
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>{{$custom[strtolower('user_Name')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Full_Name')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Email')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Mobile')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Role')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Avatar')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('action')]??"lang not found"}} </th>
                                    </tr>
                                    </tfoot>
                                </table>
                                {{ $datas->appends($_GET)->links('includes.admin.dataTables.pagination', ['paginator' => $datas,'perPage' =>Request::get('perPage') ?? $datas->perPage()]) }}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')
@endsection
