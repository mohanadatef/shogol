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
                        <h1>{{$custom[strtolower('ContactUs')]??"lang not found"}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??"lang not found"}}</a></li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('ContactUs')]??"lang not found"}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="get" action="">
                <div class="container-fluid">
                    @include('setting::contact_us.filter')
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{$custom[strtolower('Subject')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('Name')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('Email')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('Mobile')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('description')]??"lang not found"}}</th>
                                            @permission('contact-us-change-status')
                                            <th>{{$custom[strtolower('Status')]??"lang not found"}}</th>
                                            @endpermission
                                            <th>{{$custom[strtolower('action')]??"lang not found"}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="subject-{{$data->id}}">{{$data->subject}}</td>
                                                <td id="name-{{$data->id}}">{{$data->name}}</td>
                                                <td id="email-{{$data->id}}">{{$data->email}}</td>
                                                <td id="mobile-{{$data->id}}">{{$data->mobile}}</td>
                                                <td id="description-{{$data->id}}">{{$data->description}}</td>
                                                @permission('contact-us-change-status')
                                                <td>
                                                    <input onfocus="changeStatus({{$data->id}})" type="checkbox"
                                                           name="status" @if($data->status) checked
                                                           @endif id="status-{{$data->id}}"
                                                           data-bootstrap-switch data-read-color="danger"
                                                           data-unread-color="success">
                                                </td>
                                                @endpermission
                                                <td>
                                                @permission('contact-us-delete')
                                                    <button type="button"
                                                            class="btn btn-outline-danger btn-block btn-sm"
                                                            onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                            data-target="#modal-delete"><i></i> {{$custom[strtolower('Delete')]??"lang not found"}}
                                                    </button>
                                                    @endpermission
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>{{$custom[strtolower('Subject')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('Name')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('Email')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('Mobile')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('description')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('Status')]??"lang not found"}}</th>
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
            </form>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')
@endsection
