@extends('includes.admin.master_admin')
@section('title')
     {{$custom[strtolower('Create')]??"lang not found"}}
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
                        <h1>{{$custom[strtolower('Category')]??""}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??""}}</a></li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('Category')]??""}}</li>
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
                            <form action="{{route('category.store')}}" method="post" id="create" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                @foreach($language as $lang)
                                    <div
                                        class="form-group{{ $errors->has('name['.$lang->code.']') ? ' is-invalid' : "" }}">
                                        <label
                                            for="name">{{$custom[strtolower('Name')]??"lang not found"}} {{$lang->name}}</label>
                                        <input type="text" name="name[{{$lang->code}}]" class="form-control"
                                               id="name[{{$lang->code}}]"
                                               value="{{Request::old('name['.$lang->code.']')}}"
                                               placeholder="{{$custom[strtolower('Enter_Name')]??"lang not found"}} {{$lang->name}}">
                                    </div>
                                @endforeach
                                <div class="form-group{{ $errors->has('type_work') ? ' is-invalid' : "" }}">
                                    <label for="type_work">{{$custom[strtolower('type_work')]??'lang not found'}}</label>
                                    <div class="icheck-success d-inline">
                                        <input type="radio" checked  name="type_work" value="{{workType()['on']}}" id="radioSuccess1">
                                        <label for="radioSuccess1">
                                            {{$custom[strtolower(workType()['on'])]??"lang not found"}}
                                        </label>
                                    </div>
                                    <div class="icheck-danger d-inline">
                                        <input type="radio"  name="type_work" value="{{workType()['of']}}"  id="radioSuccess2">
                                        <label for="radioSuccess2">
                                            {{$custom[strtolower(workType()['of'])]??"lang not found"}}
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('category_id') ? ' is-invalid' : "" }}">
                                    <label>{{$custom[strtolower('category')]??"lang not found"}}</label>
                                    <select class="form-control select2" id="category" name="parent_id"
                                            style="width: 100%;">
                                        <option value="0" id="option-category-0">{{$custom[strtolower('select')]??"lang not found"}}</option>
                                        @foreach($category as $my)
                                            <option value="{{$my->id}}" id="option-category-{{$my->id}}">{{$my->name->value ?? ""}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                    <div class="form-group{{ $errors->has('tag') ? ' is-invalid' : "" }}">
                                        <label for="tag">{{$custom[strtolower('tag')]??"lang not found"}}</label>
                                        <textarea type="text" name="tag" class="form-control" id="tag"
                                               placeholder="{{$custom[strtolower('Enter_tag')]??"lang not found"}}"></textarea>
                                    </div>
                                <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                    <label for="order">{{$custom[strtolower('Order')]??"lang not found"}}</label>
                                    <input type="text" name="order" class="form-control" id="order"
                                           value="{{Request::old('order')}}"
                                           placeholder="{{$custom[strtolower('Enter_Order')]??"lang not found"}}">
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
                    <!-- right column -->
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script_style')
    {!! JsValidator::formRequest('Modules\CoreData\Http\Requests\Category\CreateRequest','#create') !!}
@endsection
