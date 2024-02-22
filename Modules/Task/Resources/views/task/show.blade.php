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
                        <h1>{{$custom[strtolower('task')]??"lang not found"}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??"lang not found"}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('task')]??"lang not found"}}</li>
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
                            <form action="{{route('task.update',$data->id)}}" method="post"  enctype="multipart/form-data">
                                @csrf
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
                                <div class="form-group{{ $errors->has('time') ? ' is-invalid' : "" }}">
                                    <label for="time">{{$custom[strtolower('time')]??"lang not found"}}</label>
                                    <input type="text" name="time" class="form-control" disabled id="time"
                                           value="{{$data->time}}">
                                </div>
                                <div class="form-group{{ $errors->has('user') ? ' is-invalid' : "" }}">
                                    <label for="user">{{$custom[strtolower('user')]??"lang not found"}}</label>
                                    <input type="text" name="user" class="form-control" disabled id="user"
                                           value="{{$data->user->fullname}}">
                                </div>
                                <div class="form-group{{ $errors->has('status') ? ' is-invalid' : "" }}">
                                    <label for="status">{{$custom[strtolower('status')]??"lang not found"}}</label>
                                    @if($data->status_id == 6)
                                        <select class="form-control"   id="status_id" name="status_id" >
                                            @foreach($status as $my)
                                                <option value="{{$my->id}}"
                                                        id="option-status-{{$my->id}}"
                                                        @if($data->status_id == $my->id) selected @endif>{{$my->name->value ?? ""}}</option>
                                            @endforeach
                                        </select>
                                        @else
                                    <input type="text" name="status" class="form-control" disabled id="status"
                                           value="{{$data->status->name->value ?? ""}}">
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('currency') ? ' is-invalid' : "" }}">
                                    <label for="currency">{{$custom[strtolower('currency')]??"lang not found"}}</label>
                                    <input type="text" name="currency" class="form-control" disabled id="currency"
                                           value="{{$data->currency->name->value ?? ""}}">
                                </div>
                                <div class="form-group{{ $errors->has('type_work') ? ' is-invalid' : "" }}">
                                    <label
                                        for="type_work">{{$custom[strtolower('type_work')]??"lang not found"}}</label>
                                    <input type="text" name="type_work" class="form-control" disabled id="type_work"
                                           value="{{$data->type_work}}">
                                </div>
                               {{-- <div class="form-group{{ $errors->has('country') ? ' is-invalid' : "" }}">
                                    <label for="country">{{$custom[strtolower('country')]??"lang not found"}}</label>
                                    <input type="text" name="country" class="form-control" disabled id="country"
                                           value="{{$data->country->name->value ?? ""}}">
                                </div>
                                <div class="form-group{{ $errors->has('city') ? ' is-invalid' : "" }}">
                                    <label for="city">{{$custom[strtolower('city')]??"lang not found"}}</label>
                                    <input type="text" name="city" class="form-control" disabled id="city"
                                           value="{{$data->city->name->value ?? ""}}">
                                </div>
                                <div class="form-group{{ $errors->has('state') ? ' is-invalid' : "" }}">
                                    <label for="state">{{$custom[strtolower('state')]??"lang not found"}}</label>
                                    <input type="text" name="state" class="form-control" disabled id="state"
                                           value="{{$data->state->name->value ?? ""}}">
                                </div>
                               --}} <div class="form-group{{ $errors->has('address') ? ' is-invalid' : "" }}">
                                    <label for="address">{{$custom[strtolower('address')]??"lang not found"}}</label>
                                    <input type="text" name="address" class="form-control" disabled id="address"
                                           value="{{$data->address}}">
                                </div>
                                <div class="form-group{{ $errors->has('created_at') ? ' is-invalid' : "" }}">
                                    <label
                                        for="created_at">{{$custom[strtolower('created_at')]??"lang not found"}}</label>
                                    <input type="text" name="created_at" class="form-control" disabled id="created_at"
                                           value="{{$data->created_at}}">
                                </div>
                                <div class="form-group{{ $errors->has('approved_at') ? ' is-invalid' : "" }}">
                                    <label
                                        for="approved_at">{{$custom[strtolower('approved_at')]??"lang not found"}}</label>
                                    <input type="text" name="approved_at" class="form-control" disabled id="approved_at"
                                           value="{{$data->approved_at}}">
                                </div>
                                <div class="form-group{{ $errors->has('freelancer') ? ' is-invalid' : "" }}">
                                    <label
                                        for="freelancer">{{$custom[strtolower('freelancer')]??"lang not found"}}</label>
                                    <input type="text" name="freelancer" class="form-control" disabled id="freelancer"
                                           value="{{$data->freelancer->fullname ?? ""}}">
                                </div>
                                <div class="form-group{{ $errors->has('type') ? ' is-invalid' : "" }}">
                                    <label for="type">{{$custom[strtolower('type')]??"lang not found"}}</label>
                                    <input type="text" name="type" class="form-control" disabled id="type"
                                           value="{{$data->type}}">
                                </div>
                                <div>
                                    <label for="category">{{$custom[strtolower('category')]??"lang not found"}}</label>
                                    @if(!in_array($data->status_id,[statusType()['ns'],statusType()['os']]))
                                        @foreach($data->category as $category)
                                            <br>
                                            {{$category->name->value ?? ""}}
                                        @endforeach
                                    @else
                                        <select class="form-control select2"  multiple="multiple" id="category"  name="category[]">
                                            <option value="0" id="option-category-0">{{$custom[strtolower('select')]??"lang not found"}}</option>
                                            @foreach($category as $c)
                                                <option value="{{$c->id}}" id="option-category-{{$c->id}}" @if(in_array($c->id,$data->category->pluck('id')->toArray())) selected @endif>{{$c->name->value ?? ""}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <div>
                                    <label for="document">{{$custom[strtolower('document')]??"lang not found"}}</label>
                                    @foreach($data->documents as $documents)
                                        <a href="{{getFile($documents->file,pathType()['up'],getFileNameServer($documents))}}"
                                           download>{{$documents->file}}</a>
                                    @endforeach
                                </div>
                                <div>
                                    @if($data->status_id == statusType()['us'])
                                        <br>
                                        {{($custom[strtolower('comment')]??"lang not found") .' : '. $data->reject_comments->comment}}
                                        <br>
                                        {{($custom[strtolower('created_at')]??"lang not found") .' : '. $data->reject_comments->created_at}}
                                    @elseif($data->status_id == statusType()['cs'])
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
                                <a href="{{  route('task.index') }}"
                                   class="btn btn-outline-primary btn-flat btn-sm">{{$custom[strtolower('back')]??""}}</a>
                                   @permission('task-approve')
                                @if(in_array($data->status_id,[statusType()['ns'],statusType()['os']]))
                                    <button type="submit" class="btn btn-outline-primary btn-flat btn-sm">{{$custom[strtolower('accept')]??""}}</button>
                                @endif
                                @endpermission
                                <button type="submit" class="btn btn-outline-primary btn-flat btn-sm">{{$custom[strtolower('update')]??""}}</button>
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
    @include('includes.admin.model.script_mean_function_curl')
@endsection
