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
                        <h1>{{$custom[strtolower('Notification')]??""}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??""}}</a></li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('Notification')]??""}}</li>
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
                                {{$custom[strtolower('Push')]??""}}
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('errors.error')
                            <form action="{{route('notification.store')}}" method="post" id="create" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                        @foreach($language as $lang)
                                            <div
                                                class="form-group{{ $errors->has('title['.$lang->code.']') ? ' is-invalid' : "" }}">
                                                <label for="title">{{$custom[strtolower('title')]??"lang not found"}} {{$lang->name}}</label>
                                                <input type="text" name="title[{{$lang->code}}]" class="form-control"
                                                id="title[{{$lang->code}}]"
                                                value="{{Request::old('title['.$lang->code.']')}}"
                                                placeholder="{{$custom[strtolower('title')]??"lang not found"}} {{$lang->name}}">
                                            </div>
                                        @endforeach
                                        @foreach($language as $lang)
                                            <div
                                                class="form-group{{ $errors->has('description['.$lang->code.']') ? ' is-invalid' : "" }}">
                                                <label for="description">{{$custom[strtolower('Description')]??"lang not found"}} {{$lang->name}}</label>
                                                <textarea type="text" name="description[{{$lang->code}}]" class="form-control" id="{{$lang->code}}"
                                                          placeholder="{{$custom[strtolower('Enter_Description')]??"lang not found"}} {{$lang->name}}">{{Request::old('description['.$lang->code.']')}}</textarea>
                                            </div>
                                        @endforeach

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{$custom[strtolower('category')]??"lang not found"}}</label>
                                                    <select class="form-control select2" multiple="multiple" id="category"
                                                            name="category[]"
                                                            data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                                                        @foreach($category as $my)
                                                            <option value="{{$my->id}}"
                                                                    id="option-category-{{$my->id}}"
                                                                    @if(Request::get('category') && in_array($my->id,Request::get('category'))) selected @endif>{{$my->name->value ?? ""}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{$custom[strtolower('job_name')]??"lang not found"}}</label>
                                                    <select class="form-control select2" multiple="multiple" id="job_name"
                                                            name="job_name_id[]"
                                                            data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                                                        @foreach($job_name as $my)
                                                            <option value="{{$my->id}}"
                                                                    id="option-job_name-{{$my->id}}"
                                                                    @if(Request::get('job_name_id') && in_array($my->id,Request::get('job_name_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{$custom[strtolower('nationality')]??"lang not found"}}</label>
                                                    <select class="form-control select2" multiple="multiple" id="nationality"
                                                            name="nationality_id[]"
                                                            data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                                                        @foreach($nationality as $my)
                                                            <option value="{{$my->id}}"
                                                                    id="option-nationality-{{$my->id}}"
                                                                    @if(Request::get('nationality_id') && in_array($my->id,Request::get('nationality_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{$custom[strtolower('country')]??"lang not found"}}</label>
                                                    <select class="form-control select2" multiple="multiple" id="country"
                                                            name="country_id[]"
                                                            data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                                                        @foreach($country as $my)
                                                            <option value="{{$my->id}}"
                                                                    id="option-country-{{$my->id}}"
                                                                    @if(Request::get('country_id') && in_array($my->id,Request::get('country_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{$custom[strtolower('city')]??"lang not found"}}</label>
                                                    <select class="form-control select2" multiple="multiple" id="city"
                                                            name="city_id[]"
                                                            data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                                                        @foreach($city as $my)
                                                            <option value="{{$my->id}}"
                                                                    id="option-city-{{$my->id}}"
                                                                    @if(Request::get('city_id') && in_array($my->id,Request::get('city_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{$custom[strtolower('state')]??"lang not found"}}</label>
                                                    <select class="form-control select2" multiple="multiple" id="state"
                                                            name="state_id[]"
                                                            data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                                                        @foreach($state as $my)
                                                            <option value="{{$my->id}}"
                                                                    id="option-state-{{$my->id}}"
                                                                    @if(Request::get('state_id') && in_array($my->id,Request::get('state_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{$custom[strtolower('gender')]??"lang not found"}}</label>
                                                    <select class="form-control select2" multiple="multiple" id="gender"
                                                            name="gender_id[]"
                                                            data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                                                        @foreach($gender as $my)
                                                            <option value="{{$my->id}}"
                                                                    id="option-gender-{{$my->id}}"
                                                                    @if(Request::get('gender_id') && in_array($my->id,Request::get('gender_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{$custom[strtolower('status')]??"lang not found"}}</label>
                                                    <select class="form-control"  id="status" name="status">
                                                            <option value="" id="option-status" @if(empty(Request::get('status')) &&  Request::get('status') === null) @else selected @endif>{{$custom[strtolower('select')]??"lang not found"}}</option>
                                                            <option value="1" id="option-status-1" @if(Request::get('status') &&  Request::get('status') == 1) selected @endif>{{$custom[strtolower('active')]??"lang not found"}}</option>
                                                            <option value="0" id="option-status-0" @if(empty(Request::get('status')) &&  Request::get('status') === "0") selected @endif>{{$custom[strtolower('unactive')]??"lang not found"}}</option>
                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{$custom[strtolower('approve')]??"lang not found"}}</label>
                                                    <select class="form-control"  id="approve" name="approve">
                                                        <option value="" id="option-approve" @if(empty(Request::get('approve')) &&  Request::get('approve') === null) @else selected @endif>{{$custom[strtolower('select')]??"lang not found"}}</option>
                                                        <option value="1" id="option-approve-1" @if(Request::get('approve') &&  Request::get('approve') == 1) selected @endif>{{$custom[strtolower('approve')]??"lang not found"}}</option>
                                                        <option value="0" id="option-approve-0" @if(empty(Request::get('approve')) &&  Request::get('approve') === "0") selected @endif>{{$custom[strtolower('wait_approve')]??"lang not found"}}</option>
                                                        <option value="2" id="option-approve-2" @if(Request::get('approve') &&  Request::get('approve') == 2) selected @endif>{{$custom[strtolower('unapprove')]??"lang not found"}}</option>
                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{$custom[strtolower('role')]??"lang not found"}}</label>
                                                    <select class="form-control select2" multiple="multiple" id="role_id"
                                                            name="role_id[]"
                                                            data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                                                        @foreach($role as $my)
                                                            <option value="{{$my->id}}"
                                                                    id="option-role-{{$my->id}}"
                                                                    @if(Request::get('role_id') && in_array($my->id,Request::get('role_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                        </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{$custom[strtolower('Push')]??""}}</button>

                                    <a href="{{route('notification.push') }}"
                                        class="btn btn-success"> {{$custom[strtolower('Reset')]??"lang not found"}}</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
