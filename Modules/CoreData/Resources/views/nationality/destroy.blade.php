@extends('includes.admin.master_admin')
@section('title')
    {{$custom[strtolower('Index')]??"lang not found"}}
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
                        <h1>{{$custom[strtolower('Nationality')]??"lang not found"}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??"lang not found"}}</a></li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('Nationality')]??"lang not found"}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
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
                                         <th>{{$custom[strtolower('Name')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Image')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('page')]??"lang not found"}} - {{$custom[strtolower('count')]??"lang not found"}}</th>
                                         <th>{{$custom[strtolower('action')]??"lang not found"}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($datas as $data)
                                        <tr id="data-{{$data->id}}">
                                            <td id="name-{{$data->id}}">{{$data->name->value ?? ""}}</td>
                                            <td>
                                                <img src="{{getFile($data->logo->file??null,pathType()['ip'],getFileNameServer($data->logo))}}"
                                                     id="logo-{{$data->id}}" style="width:100px;height: 100px">
                                            </td>
                                            <td>
                                                <a href="{{  route('user.index',['nationality_id'=>$data->id]) }}"
                                                   class="btn btn-outline-primary btn-block btn-sm">{{$custom[strtolower('user')]??""}}{{" - " .$data->user->count()}}</a>
                                            </td>
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
                                         <th>{{$custom[strtolower('Name')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Image')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('page')]??"lang not found"}} - {{$custom[strtolower('count')]??"lang not found"}}</th>
                                         <th>{{$custom[strtolower('action')]??"lang not found"}}</th>
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
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')
@endsection
