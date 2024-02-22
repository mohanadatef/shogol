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
                        <h1>{{$custom[strtolower('Status')]??"lang not found"}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??"lang not found"}}</a></li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('Status')]??"lang not found"}}</li>
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
                                <div class="card-header">
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                             <th>{{$custom[strtolower('Name')]??"lang not found"}}</th>
                                             @permission('status-change-status')
                                            <th>{{$custom[strtolower('Status')]??"lang not found"}}</th>
                                            @endpermission
                                             <th>{{$custom[strtolower('action')]??"lang not found"}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="name-{{$data->id}}"
                                                    data-order="{{$data->order}}">{{$data->name->value ??""}}</td>
                                                    @permission('status-change-status')
                                                    <td>
                                                    <input onfocus="changeStatus({{$data->id}})" type="checkbox"
                                                           name="status" @if($data->status) checked
                                                           @endif id="status-{{$data->id}}"
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success">
                                                </td>
                                                @endpermission
                                                <td>
                                                @permission('status-edit')
                                                    <a href="{{  route('status.edit',$data->id) }}"
                                                       class="btn btn-outline-primary btn-block btn-sm"><i
                                                            class="fa fa-edit"></i>{{$custom[strtolower('Edit')]??""}}
                                                    </a>
                                                    @endpermission
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                             <th>{{$custom[strtolower('Name')]??"lang not found"}}</th>
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
    @permission('status-edit')
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
                                    class="form-group{{ $errors->has('name['.$lang->code.']') ? ' is-invalid' : "" }}">
                                    <label for="name">{{$custom[strtolower('Name')]??"lang not found"}} {{$lang->name}}</label>
                                    <input type="text" name="name[{{$lang->code}}]" class="form-control"
                                           id="name-{{$lang->code}}"
                                           value="" placeholder="{{$custom[strtolower('Enter_Name')]??"lang not found"}} {{$lang->name}}">
                                </div>
                                <div
                                    class="form-group{{ $errors->has('task_owner['.$lang->code.']') ? ' is-invalid' : "" }}">
                                    <label for="task_owner">{{$custom[strtolower('task_owner')]??"lang not found"}} {{$lang->name}}</label>
                                    <input type="text" name="task_owner[{{$lang->code}}]" class="form-control"
                                           id="task-owner-{{$lang->code}}"
                                           value="" placeholder="{{$custom[strtolower('Enter_task_owner')]??"lang not found"}} {{$lang->name}}">
                                </div>
                                <div
                                    class="form-group{{ $errors->has('offer_owner['.$lang->code.']') ? ' is-invalid' : "" }}">
                                    <label for="offer_owner">{{$custom[strtolower('offer_owner')]??"lang not found"}} {{$lang->name}}</label>
                                    <input type="text" name="offer_owner[{{$lang->code}}]" class="form-control"
                                           id="offer-owner-{{$lang->code}}"
                                           value="" placeholder="{{$custom[strtolower('Enter_offer_owner')]??"lang not found"}} {{$lang->name}}">
                                </div>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">{{$custom[strtolower('Close')]??"lang not found"}}</button>
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
            console.log(res)
            for (let i in res.translation) {
                $(`#edit #name-${res.translation[i].language.code}`).val(res.translation[i].value);
                $(`#edit #task-owner-${res.translation[i].language.code}`).val(res.translation[i].value);
                $(`#edit #offer-owner-${res.translation[i].language.code}`).val(res.translation[i].value);
            }
            $('#edit #order').val(res.order);
        }
        //edit data
        function updateItem(res) {
            document.getElementById('name-' + res.id).innerHTML = res.name;
            $(`#name-${res.id}`).attr('data-order', res.order);
        }
    </script>
@endsection
