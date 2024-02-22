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
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                {{$custom[strtolower('show')]??""}}
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group{{ $errors->has('name') ? ' is-invalid' : "" }}">
                                    <label for="name">{{$custom[strtolower('Name')]??"lang not found"}}</label>
                                    <input type="text" name="name" class="form-control" disabled id="name"
                                           value="{{$data->name}}">
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' is-invalid' : "" }}">
                                    <label
                                        for="description">{{$custom[strtolower('description')]??"lang not found"}}</label>
                                    <input type="text" name="description" class="form-control" disabled id="description"
                                           value="{{$data->description}}">
                                </div>
                                <div class="form-group{{ $errors->has('price') ? ' is-invalid' : "" }}">
                                    <label for="price">{{$custom[strtolower('price')]??"lang not found"}}</label>
                                    <input type="text" name="price" class="form-control" disabled id="price"
                                           value="{{$data->price}}">
                                </div>
                                <div class="form-group{{ $errors->has('user') ? ' is-invalid' : "" }}">
                                    <label for="user">{{$custom[strtolower('user')]??"lang not found"}}</label>
                                    <input type="text" name="user" class="form-control" disabled id="user"
                                           value="{{$data->user->fullname}}">
                                </div>
                                <div class="form-group{{ $errors->has('currency') ? ' is-invalid' : "" }}">
                                    <label for="currency">{{$custom[strtolower('currency')]??"lang not found"}}</label>
                                    <input type="text" name="currency" class="form-control" disabled id="currency"
                                           value="{{$data->currency->name->value ?? ""}}">
                                </div>
                                <div class="form-group{{ $errors->has('created_at') ? ' is-invalid' : "" }}">
                                    <label
                                        for="created_at">{{$custom[strtolower('created_at')]??"lang not found"}}</label>
                                    <input type="text" name="created_at" class="form-control" disabled id="created_at"
                                           value="{{$data->created_at}}">
                                </div>
                                <div>
                                    <label for="category">{{$custom[strtolower('category')]??"lang not found"}}</label>
                                    @foreach($data->category as $category)
                                        <br>
                                        {{$category->name->value ?? ""}}
                                    @endforeach
                                </div>
                                <div>
                                    <label for="document">{{$custom[strtolower('document')]??"lang not found"}}</label>
                                    @foreach($data->documents as $documents)
                                        <br>
                                        <a href="{{getFile($documents->file,pathType()['up'],getFileNameServer($documents))}}"
                                           download>{{$documents->file}}</a>
                                    @endforeach
                                </div>
                                <div class="form-group{{ $errors->has('status') ? ' is-invalid' : "" }}">
                                    <label for="status">{{$custom[strtolower('status')]??"lang not found"}}</label>
                                    <input type="text" name="status" class="form-control" disabled id="status"
                                           value="{{$data->status->name->value ?? ""}}">
                                </div>
                                <div>
                                    @if($data->status_id == statusType()['cs'])
                                        <br>
                                        {{($custom[strtolower('done_by')]??"lang not found" ).' : '. $data->cansel_comments->done_by_user->fullname}}
                                        <br>
                                        {{($custom[strtolower('cancellation')]??"lang not found" ).' : '. $data->cansel_comments->cancellation->name->value ?? ""}}
                                        <br>
                                        {{($custom[strtolower('comment')]??"lang not found" ).' : '. $data->cansel_comments->comment}}
                                        <br>
                                        {{($custom[strtolower('created_at')]??"lang not found" ).' : '. $data->cansel_comments->created_at}}
                                    @endif
                                </div>
                                <!-- /.form-group -->
                                <!-- /.col -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{  route('ad.index') }}" class="btn btn-outline-primary btn-flat btn-sm">{{$custom[strtolower('back')]??""}}</a>
                            </div>

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
    @include('includes.admin.model.script_mean_function_curl')
@endsection
