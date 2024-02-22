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
                        <h1>{{$custom[strtolower('ad')]??"lang not found"}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??"lang not found"}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('ad')]??"lang not found"}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="get" action="">
                <div class="container-fluid">
                @permission('ad-filter')
                @include('task::ad.filter')
                @endpermission
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{$custom[strtolower('Name')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('description')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('user')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('Status')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('action')]??"lang not found"}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="name-{{$data->id}}">{{$data->name}}</td>
                                                <td id="description-{{$data->id}}">{!! $data->description !!}</td>
                                                <td id="user-{{$data->id}}">{{$data->user->fullname}}</td>
                                                <td id="status-{{$data->id}}">{{$custom[strtolower('Status')]??"lang not found"}}
                                                    <a href="{{  route('status.index',['id'=>$data->status_id]) }}">
                                                        {{" : ".$data->status->name->value ?? ""}}</a>
                                                    @permission('ad-cansel')
                                                        @if($data->status_id == statusType()['cs'])
                                                        <br>
                                                        {{($custom[strtolower('done_by')]??"lang not found" ).' : '. $data->cansel_comments->done_by_user->fullname}}
                                                        <br>
                                                        {{($custom[strtolower('cancellation')]??"lang not found" ).' : '. $data->cansel_comments->cancellation->name ? $data->cansel_comments->cancellation->name->value ?? "" : ""}}
                                                        <br>
                                                        {{($custom[strtolower('comment')]??"lang not found" ).' : '. $data->cansel_comments->comment}}
                                                        <br>
                                                        {{($custom[strtolower('created_at')]??"lang not found" ).' : '. $data->cansel_comments->created_at}}
                                                    @else
                                                    <button type="button"
                                                            class="btn btn-outline-danger btn-flat btn-sm"
                                                            onclick="canselComment({{$data->id}})">
                                                        <i></i> {{$custom[strtolower('cansel')]??"lang not found"}}
                                                    </button>
                                                    <button id="openModael{{$data->id}}" type="button"
                                                            class="d-none"
                                                            data-toggle="modal"
                                                            data-target="#modal-cansel">
                                                    </button>
                                                    @endif
                                                    @endpermission
                                                </td>
                                                <td>
                                                @permission('ad-show')
                                                    <a href="{{  route('ad.show',$data->id) }}"
                                                       class="btn btn-outline-primary btn-block btn-sm"><i
                                                            class="fa fa-edit"></i>{{$custom[strtolower('open')]??""}}
                                                    </a>
                                                    @endpermission
                                                    @permission('ad-delete')
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
                                            <th>{{$custom[strtolower('description')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('user')]??"lang not found"}}</th>
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
    @permission('ad-cansel')
    <div class="modal fade" id="modal-cansel">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">{{$custom[strtolower('cansel')]??"lang not found"}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="cansel" action="" method="post" name="cansel" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group{{ $errors->has('cancellation_id') ? ' is-invalid' : "" }}">
                                <label>{{$custom[strtolower('cancellation')]??"lang not found"}}</label>
                                <select class="form-control select2" id="cancellation" name="cancellation_id"
                                        style="width: 100%;">
                                    <option value="0" id="option-cancellation-0">{{$custom[strtolower('select')]??"lang not found"}}</option>
                                    @foreach($cancellation as $my)
                                        <option value="{{$my->id}}" id="option-cancellation-{{$my->id}}">{{$my->name->value ?? ""}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p>{{$custom[strtolower('comment')]??"lang not found"}}</p>
                            <textarea name="comment"></textarea>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light"
                                data-dismiss="modal">{{$custom[strtolower('Close')]??"lang not found"}}</button>
                        <button type="submit"
                                class="btn btn-outline-light">{{$custom[strtolower('cansel')]??"lang not found"}}</button>
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
@endsection
