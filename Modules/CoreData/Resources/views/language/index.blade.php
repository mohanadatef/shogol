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
                        <h1>{{$custom[strtolower('Language')]??"lang not found"}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??"lang not found"}}</a></li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('Language')]??"lang not found"}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="get" action="">
                <div class="container-fluid">
                    @include('coredata::language.filter')
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            @permission('language-create')
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#modal-create">
                                            {{$custom[strtolower('Create')]??"lang not found"}}
                                        </button>
                                    </h3>
                                </div>
                                @endpermission
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{$custom[strtolower('Name')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('Code')]??"lang not found"}}</th>
                                            @permission('language-change-status')
                                            <th>{{$custom[strtolower('Status')]??"lang not found"}}</th>
                                            @endpermission
                                            <th>{{$custom[strtolower('action')]??"lang not found"}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="name-{{$data->id}}">{{$data->name}}</td>
                                                <td id="code-{{$data->id}}"
                                                    data-order="{{$data->order}}">{{$data->code}}</td>
                                                    @permission('language-change-status')
                                                <td>
                                                    <input onfocus="changeStatus({{$data->id}})" type="checkbox"
                                                           name="status" @if($data->status) checked
                                                           @endif id="status-{{$data->id}}"
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success">
                                                </td>
                                                @endpermission
                                                <td>
                                                @permission('language-edit')
                                                    <button type="button"
                                                            class="btn btn-outline-primary btn-block btn-sm"
                                                            onclick="showItem({{$data->id}})">
                                                        <i class="fa fa-edit"></i> {{$custom[strtolower('Edit')]??"lang not found"}}
                                                    </button>
                                                    <button id="openModael{{$data->id}}" type="button" class="d-none"
                                                            data-toggle="modal"
                                                            data-target="#modal-edit">
                                                    </button>
                                                    @endpermission
                                                    @permission('language-delete')
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
                                            <th>{{$custom[strtolower('Name')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('Code')]??"lang not found"}}</th>
                                            @permission('language-change-status')
                                            <th>{{$custom[strtolower('Status')]??"lang not found"}}</th>
                                            @endpermission
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
    @permission('language-create')
    <div class="modal fade" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content bg-success">
                <div class="modal-header">
                    <h4 class="modal-title">{{$custom[strtolower('Create')]??"lang not found"}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="create" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group{{ $errors->has('title') ? ' is-invalid' : "" }}">
                                <label for="name">{{$custom[strtolower('Name')]??"lang not found"}}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                       value="{{Request::old('title')}}" placeholder="{{$custom[strtolower('Enter_Name')]??"lang not found"}}">
                            </div>
                            <div class="form-group{{ $errors->has('code') ? ' is-invalid' : "" }}">
                                <label for="code">{{$custom[strtolower('Code')]??"lang not found"}}</label>
                                <input type="text" name="code" class="form-control" id="code"
                                       value="{{Request::old('code')}}" placeholder="{{$custom[strtolower('Enter_Code')]??"lang not found"}}">
                            </div>
                            <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                <label for="order">{{$custom[strtolower('Order')]??"lang not found"}}</label>
                                <input type="text" name="order" class="form-control" id="order"
                                       value="{{Request::old('order')}}" placeholder="{{$custom[strtolower('Enter_Order')]??"lang not found"}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light"
                                data-dismiss="modal">{{$custom[strtolower('Close')]??"lang not found"}}</button>
                        <button type="submit" class="btn btn-outline-light">{{$custom[strtolower('Create')]??"lang not found"}}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endpermission
    @permission('language-edit')
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">{{$custom[strtolower('Edit')]??"lang not found"}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit" action="" method="post" name="edit" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group{{ $errors->has('title') ? ' is-invalid' : "" }}">
                                <label for="name">{{$custom[strtolower('Name')]??"lang not found"}}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                       value="" placeholder="{{$custom[strtolower('Enter_Name')]??"lang not found"}}">
                            </div>
                            <div class="form-group{{ $errors->has('code') ? ' is-invalid' : "" }}">
                                <label for="code">{{$custom[strtolower('Code')]??"lang not found"}}</label>
                                <input type="text" name="code" class="form-control" id="code"
                                       value="" placeholder="{{$custom[strtolower('Enter_Code')]??"lang not found"}}">
                            </div>
                            <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                <label for="order">{{$custom[strtolower('Order')]??"lang not found"}}</label>
                                <input type="text" name="order" class="form-control" id="order"
                                       value="" placeholder="{{$custom[strtolower('Enter_Order')]??"lang not found"}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light"
                                data-dismiss="modal">{{$custom[strtolower('Close')]??"lang not found"}}</button>
                        <button type="submit" class="btn btn-outline-light">{{$custom[strtolower('Update')]??"lang not found"}}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endpermission
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')

    <script>
        //show item
        function showData(res) {
            $(`#edit #name`).val(res.name);
            $(`#edit #code`).val(res.code);
            $('#edit #order').val(res.order);
        }

        //edit data
        function updateItem(res) {
            document.getElementById('name-' + res.id).innerHTML = res.name;
            document.getElementById('code-' + res.id).innerHTML = res.code;
            $(`#code-${res.id}`).attr('data-order', res.order);
        }
    </script>

@endsection
