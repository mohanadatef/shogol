@extends('includes.admin.master_admin')
@section('title')
     {{$custom[strtolower('Create')]??"lang not found"}}
@endsection
@section('head_style')
    @include('includes.admin.dataTables.head_DataTables')
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{asset('public/AdminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$custom[strtolower('Role')]??""}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??""}}</a></li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('Role')]??""}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                {{$custom[strtolower('Create')]??""}}
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('errors.error')
                            <form action="{{route('role.store')}}" method="post" id="create" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @foreach($language as $lang)
                                        <div
                                            class="form-group{{ $errors->has('name['.$lang->code.']') ? ' is-invalid' : "" }}">
                                            <label for="name">{{$custom[strtolower('Name')]??"lang not found"}} {{$lang->name}}</label>
                                            <input type="text" name="name[{{$lang->code}}]" class="form-control"
                                                   id="name[{{$lang->code}}]"
                                                   value="{{Request::old('name['.$lang->code.']')}}"
                                                   placeholder="{{$custom[strtolower('Enter_Name')]??"lang not found"}} {{$lang->name}}">
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="is_web">{{$custom[strtolower('is_web')]??'lang not found'}}</label>
                                            <div class="icheck-success d-inline">
                                                <input type="radio"    name="is_web" value="1" id="radioSuccess1">
                                                <label for="radioSuccess1">
                                                    {{$custom[strtolower('Active')]??'lang not found'}}
                                                </label>
                                            </div>
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" checked name="is_web" value="0"  id="radioSuccess2">
                                                <label for="radioSuccess2">
                                                    {{$custom[strtolower('unactive')]??'lang not found'}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="is_approve">{{$custom[strtolower('is_approve')]??'lang not found'}}</label>
                                            <div class="icheck-success d-inline">
                                                <input type="radio"    name="is_approve" value="1" id="radioSuccess3">
                                                <label for="radioSuccess3">
                                                    {{$custom[strtolower('Active')]??'lang not found'}}
                                                </label>
                                            </div>
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" checked name="is_approve" value="0"  id="radioSuccess4">
                                                <label for="radioSuccess4">
                                                    {{$custom[strtolower('unactive')]??'lang not found'}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="is_report">{{$custom[strtolower('is_report')]??'lang not found'}}</label>
                                            <div class="icheck-success d-inline">
                                                <input type="radio"    name="is_report" value="1" id="radioSuccess5">
                                                <label for="radioSuccess5">
                                                    {{$custom[strtolower('Active')]??'lang not found'}}
                                                </label>
                                            </div>
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" checked name="is_report" value="0"  id="radioSuccess6">
                                                <label for="radioSuccess6">
                                                    {{$custom[strtolower('unactive')]??'lang not found'}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="is_verified">{{$custom[strtolower('is_verified')]??'lang not found'}}</label>
                                            <div class="icheck-success d-inline">
                                                <input type="radio"    name="is_verified" value="1" id="radioSuccess7">
                                                <label for="radioSuccess7">
                                                    {{$custom[strtolower('Active')]??'lang not found'}}
                                                </label>
                                            </div>
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" checked name="is_verified" value="0"  id="radioSuccess8">
                                                <label for="radioSuccess8">
                                                    {{$custom[strtolower('unactive')]??'lang not found'}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group{{ $errors->has('permission') ? ' has-error' : "" }}">
                                            <label>{{trans('lang.Permission')}}</label>
                                            <select class="duallistbox" multiple="multiple" name="permission[]">
                                                @foreach($permission as $pe)
                                                    <option  value="{{$pe->id}}">{{$pe->display_name->value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{$custom[strtolower('Create')]??""}}</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script_style')
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{asset('public/AdminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <script>
        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox();
    </script>
    {!! JsValidator::formRequest('Modules\Acl\Http\Requests\Role\CreateRequest','#create') !!}
@endsection
