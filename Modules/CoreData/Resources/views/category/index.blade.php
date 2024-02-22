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
                        <h1>{{$custom[strtolower('Category')]??"lang not found"}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??"lang not found"}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('Category')]??"lang not found"}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="get" action="">
                <div class="container-fluid">
                    @include('coredata::category.filter')
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        @permission('category-create')
                                        <a href="{{  route('category.create') }}"
                                           class="btn btn-success"> {{$custom[strtolower('Create')]??"lang not found"}}</a>
                                        @endpermission
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{$custom[strtolower('Name')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('parent')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('type_work')]??"lang not found"}}</th>
                                            @permission('category-change-status')
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
                                                <td id="parent-{{$data->id}}"><a
                                                        href="{{  route('category.index',['id'=>$data->parents->id ?? 0]) }}">{{$data->parents->name->value ??""}}</a>
                                                </td>
                                                <td id="type-work-{{$data->id}}">{{$custom[strtolower($data->type_work)]??"lang not found"}}</td>
                                                @permission('category-change-status')
                                                <td>
                                                    <input onfocus="changeStatus({{$data->id}})" type="checkbox"
                                                           name="status" @if($data->status) checked
                                                           @endif id="status-{{$data->id}}"
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success">
                                                </td>
                                                @endpermission
                                                <td>
                                                    @permission('category-edit')
                                                    <a href="{{  route('category.edit',$data->id) }}"
                                                       class="btn btn-outline-primary btn-block btn-sm"><i
                                                            class="fa fa-edit"></i>{{$custom[strtolower('Edit')]??""}}
                                                    </a>
                                                    @endpermission
                                                    @permission('category-delete')
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
                                            <th>{{$custom[strtolower('Name')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('parent')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('type_work')]??"lang not found"}}</th>
                                            @permission('category-change-status')
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
    @permission('category-edit')
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
                                    <label
                                        for="name">{{$custom[strtolower('Name')]??"lang not found"}} {{$lang->name}}</label>
                                    <input type="text" name="name[{{$lang->code}}]" class="form-control"
                                           id="name-{{$lang->code}}"
                                           value=""
                                           placeholder="{{$custom[strtolower('Enter_Name')]??"lang not found"}} {{$lang->name}}">
                                </div>
                            @endforeach
                            <div class="form-group{{ $errors->has('type_work') ? ' is-invalid' : "" }}">
                                <label>{{$custom[strtolower('type_work')]??"lang not found"}}</label>
                                <select class="form-control" id="type_work" name="type_work" style="width: 100%;">
                                    <option value="{{workType()['on']}}"
                                            id="type-work-on">{{$custom[strtolower(workType()['on'])]??"lang not found"}}</option>
                                    <option value="{{workType()['of']}}"
                                            id="type-work-of">{{$custom[strtolower(workType()['of'])]??"lang not found"}}</option>
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('category_id') ? ' is-invalid' : "" }}">
                                <label>{{$custom[strtolower('parent')]??"lang not found"}}</label>
                                <select class="form-control" id="category_id" name="parent_id"
                                        style="width: 100%;">
                                </select>
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
                $(`#edit #name-${res.translation[i].language.code}`).val(res.translation[i].value);
            }
            GetCategory(res.id,res.parents ? res.parents.id : 0);
            $('#edit #order').val(res.order);
            $("#edit #type_work").val(res.type_work);
        }


        function GetCategory(id,parent) {
            url = '{{ route("category.parent.list") }}';
            $.ajax({
                type: "GET",
                url: url,
                data: {'id': id},
                success: function (res) {
                    $(`#edit #category_id`).empty();
                    $(`#edit #category_id`).append('<option value="0">select</option>');
                    for (let x in res) {
                        for (let i in res[x]) {
                                $(`#edit #category_id`).append(`<option value="${res[x][i].id}">${res[x][i].name}</option>`);
                        }
                    }
                    $("#edit #category_id").val(parent);
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err]);
                    }
                }
            });
        }

    </script>
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')
@endsection
