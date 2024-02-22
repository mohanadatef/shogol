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
                        <h1>{{$custom[strtolower('Permission')]??"lang not found"}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??"lang not found"}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('Permission')]??"lang not found"}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="get" action="">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{$custom[strtolower('name')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('display_name')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('description')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('action')]??"lang not found"}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="name-{{$data->id}}">{{$data->name}}</td>
                                                <td id="display-name-{{$data->id}}">{{$data->display_name->value ??""}}</td>
                                                <td id="description-{{$data->id}}">{{$data->description->value ??""}}</td>
                                                <td>
                                                    @permission('permission-edit')
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
                                                    @permission('permission-delete')
                                                    <button type="button"
                                                            class="btn btn-outline-danger btn-block btn-sm"
                                                            onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                            data-target="#modal-delete">
                                                        <i></i> {{$custom[strtolower('Delete')]??"lang not found"}}
                                                    </button>
                                                    @endpermission
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>{{$custom[strtolower('name')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('display_name')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('description')]??"lang not found"}}</th>
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
    @permission('permission-edit')
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
                            @foreach($language as $lang)
                                <div
                                    class="form-group{{ $errors->has('display_name['.$lang->code.']') ? ' is-invalid' : "" }}">
                                    <label
                                        for="display_name">{{$custom[strtolower('display_name')]??"lang not found"}} {{$lang->name}}</label>
                                    <input type="text" name="display_name[{{$lang->code}}]" class="form-control"
                                           id="display-name-{{$lang->code}}"
                                           value=""
                                           placeholder="{{$custom[strtolower('Enter_display_name')]??"lang not found"}} {{$lang->name}}">
                                </div>
                            @endforeach
                            @foreach($language as $lang)
                                <div
                                    class="form-group{{ $errors->has('description['.$lang->code.']') ? ' is-invalid' : "" }}">
                                    <label
                                        for="description">{{$custom[strtolower('description')]??"lang not found"}} {{$lang->name}}</label>
                                    <input type="text" name="description[{{$lang->code}}]" class="form-control"
                                           id="description-{{$lang->code}}"
                                           value=""
                                           placeholder="{{$custom[strtolower('Enter_description')]??"lang not found"}} {{$lang->name}}">
                                </div>
                            @endforeach
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light"
                                data-dismiss="modal">{{$custom[strtolower('Close')]??"lang not found"}}</button>
                        <button type="submit"
                                class="btn btn-outline-light">{{$custom[strtolower('Update')]??"lang not found"}}</button>
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
            for (let i in res.translation) {
                if (res.translation[i].key == 'display_name') {
                    $(`#edit #display-name-${res.translation[i].language.code}`).val(res.translation[i].value);
                } else {
                    $(`#edit #description-${res.translation[i].language.code}`).val(res.translation[i].value);
                }
            }
        }

        //edit data
        function updateItem(res) {
            document.getElementById('display-name-' + res.id).innerHTML = res.display_name;
            document.getElementById('description-' + res.id).innerHTML = res.description;
        }
    </script>
@endsection
