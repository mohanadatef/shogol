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
                        <h1>{{$custom[strtolower('User')]??"lang not found"}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??"lang not found"}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('User')]??"lang not found"}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @permission('user-filter')
                @include('acl::user.filter')
                @endpermission
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @permission('user-create')
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

                                        <th>{{$custom[strtolower('user_Name')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Full_Name')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Email')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Mobile')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Role')]??"lang not found"}}</th>
                                        @permission('user-change-status')
                                        <th>{{$custom[strtolower('Status')]??"lang not found"}}</th>
                                        @endpermission
                                        <th>{{$custom[strtolower('Approve')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('action')]??"lang not found"}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="body">
                                    @forelse($datas as $data)
                                        <tr id="data-{{$data->id}}">
                                            <td id="user-name-{{$data->id}}">{{$data->username}}</td>
                                            <td id="full-name-{{$data->id}}">{{$data->fullname}}</td>
                                            <td id="email-{{$data->id}}">{{$data->email ?? ""}}</td>
                                            <td id="mobile-{{$data->id}}">{{$data->mobile}}</td>
                                            <td id="role-{{$data->id}}">{{$data->role->name->value ?? ""}}</td>
                                            @permission('user-change-status')
                                            <td>
                                                @if($data->id != user()->id)
                                                    <input onfocus="changeStatus({{$data->id}})" type="checkbox"
                                                           name="status" @if($data->status) checked
                                                           @endif id="status-{{$data->id}}"
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success">
                                                @endif
                                            </td>
                                            @endpermission
                                            <td>
                                                @if($data->email_verified_at != null || !$data->role->is_verified)
                                                    @permission('user-approve')
                                                    @if($data->approve != 1 && $data->role->is_approve)
                                                        <button type="button"
                                                                class="btn btn-outline-success btn-flat btn-sm"
                                                                onclick="acceptApprove({{$data->id}})">
                                                            <i></i> {{$custom[strtolower('accept')]??"lang not found"}}
                                                        </button>
                                                        @if($data->approve == 0)
                                                            <button type="button"
                                                                    class="btn btn-outline-danger btn-flat btn-sm"
                                                                    onclick="rejectCommentApprove({{$data->id}})">
                                                                <i></i> {{$custom[strtolower('reject')]??"lang not found"}}
                                                            </button>
                                                            <button id="openModael{{$data->id}}" type="button"
                                                                    class="d-none"
                                                                    data-toggle="modal"
                                                                    data-target="#modal-reject-comment">
                                                            </button>
                                                        @else
                                                            <br>
                                                            {{$custom[strtolower('comment')]??"lang not found" .' : '. $data->reject_comments->comment}}
                                                            <br>
                                                            {{$custom[strtolower('created_at')]??"lang not found" .' : '. $data->reject_comments->created_at}}
                                                        @endif
                                                    @else
                                                        {{($custom[strtolower('approve_at')]??"lang not found" ).' : '.$data->approved_at}}
                                                    @endif
                                                    @endpermission
                                                @else
                                                    @permission('user-verified')
                                                    {{$custom[strtolower('verified')]??"lang not found"}}
                                                    <br>
                                                    {{$custom[strtolower('or')]??"lang not found"}}
                                                    <br>
                                                    <button type="button" id="verified-{{$data->id}}"
                                                            class="btn btn-outline-success btn-flat btn-sm"
                                                            onclick="verified({{$data->id}})">
                                                        <i></i> {{$custom[strtolower('verified_manule')]??"lang not found"}}
                                                    </button>
                                                    @endpermission
                                                @endif
                                            </td>
                                            <td>
                                                @permission('user-delete')
                                                @if($data->id != user()->id)
                                                    <button type="button"
                                                            class="btn btn-outline-danger btn-block btn-sm"
                                                            onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                            data-target="#modal-delete">
                                                        <i></i> {{$custom[strtolower('Delete')]??"lang not found"}}
                                                    </button>
                                                @endif
                                                @endpermission
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
                                        @permission('user-change-status')
                                        <th>{{$custom[strtolower('Status')]??"lang not found"}}</th>
                                        @endpermission
                                        <th>{{$custom[strtolower('Approve')]??"lang not found"}}</th>
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
    @permission('user-create')
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
                            <div class="form-group{{ $errors->has('fullname') ? ' is-invalid' : "" }}">
                                <label for="fullname">{{$custom[strtolower('fullname')]??"lang not found"}}</label>
                                <input type="text" name="fullname" class="form-control" id="fullname"
                                       value="{{Request::old('fullname')}}"
                                       placeholder="{{$custom[strtolower('Enter_fullname')]??"lang not found"}}">
                            </div>
                            <div class="form-group{{ $errors->has('username') ? ' is-invalid' : "" }}">
                                <label for="username">{{$custom[strtolower('username')]??"lang not found"}}</label>
                                <input type="text" name="username" class="form-control" id="username"
                                       value="{{Request::old('username')}}"
                                       placeholder="{{$custom[strtolower('Enter_username')]??"lang not found"}}">
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' is-invalid' : "" }}">
                                <label for="email">{{$custom[strtolower('email')]??"lang not found"}}</label>
                                <input type="email" name="email" class="form-control" id="email"
                                       value="{{Request::old('email')}}"
                                       placeholder="{{$custom[strtolower('Enter_email')]??"lang not found"}}">
                            </div>
                            <div class="form-group{{ $errors->has('mobile') ? ' is-invalid' : "" }}">
                                <label for="mobile">{{$custom[strtolower('mobile')]??"lang not found"}}</label>
                                <input type="text" name="mobile" class="form-control" id="mobile"
                                       value="{{Request::old('mobile')}}"
                                       placeholder="{{$custom[strtolower('Enter_mobile')]??"lang not found"}}">
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' is-invalid' : "" }}">
                                <label for="password">{{$custom[strtolower('password')]??"lang not found"}}</label>
                                <input type="password" name="password" class="form-control" id="password"
                                       value="{{Request::old('password')}}"
                                       placeholder="{{$custom[strtolower('Enter_password')]??"lang not found"}}">
                            </div>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' is-invalid' : "" }}">
                                <label
                                    for="password_confirmation">{{$custom[strtolower('password_confirmation')]??"lang not found"}}</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                       id="password_confirmation"
                                       value="{{Request::old('password_confirmation')}}"
                                       placeholder="{{$custom[strtolower('Enter_password_confirmation')]??"lang not found"}}">
                            </div>
                            <div class="form-group" hidden>
                                <label>{{$custom[strtolower('role_id')]??"lang not found"}}</label>
                                <input type="text" name="role_id" class="form-control" id="role_id"
                                       value="{{1}}"
                                       placeholder="{{$custom[strtolower('Enter_role')]??"lang not found"}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light"
                                data-dismiss="modal">{{$custom[strtolower('Close')]??"lang not found"}}</button>
                        <button type="submit"
                                class="btn btn-outline-light">{{$custom[strtolower('Create')]??"lang not found"}}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endpermission
    @permission('user-approve')
    <div class="modal fade" id="modal-reject-comment">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">{{$custom[strtolower('reject')]??"lang not found"}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="reject" action="" method="post" name="reject" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <p>{{$custom[strtolower('reject_title')]??"lang not found"}}</p>
                            <textarea name="comment"></textarea>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light"
                                data-dismiss="modal">{{$custom[strtolower('Close')]??"lang not found"}}</button>
                        <button type="submit"
                                class="btn btn-outline-light">{{$custom[strtolower('reject')]??"lang not found"}}</button>
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
