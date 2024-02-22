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
                        <h1>{{$custom[strtolower('Page')]??""}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??""}}</a></li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('Page')]??""}}</li>
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
                            <form action="{{route('page.store')}}" method="post" id="create" enctype="multipart/form-data">
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
                                        @foreach($language as $lang)
                                            <div
                                                class="form-group{{ $errors->has('description['.$lang->code.']') ? ' is-invalid' : "" }}">
                                                <label for="description">{{$custom[strtolower('Description')]??"lang not found"}} {{$lang->name}}</label>
                                                <textarea type="text" name="description[{{$lang->code}}]" class="form-control" id="{{$lang->code}}"
                                                          placeholder="{{$custom[strtolower('Enter_Description')]??"lang not found"}} {{$lang->name}}">{{Request::old('description['.$lang->code.']')}}</textarea>
                                            </div>
                                        @endforeach
                                    <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                        <label for="order">{{$custom[strtolower('Order')]??"lang not found"}}</label>
                                        <input type="text" name="order" class="form-control" id="order"
                                               value="{{Request::old('order')}}" placeholder="{{$custom[strtolower('Enter_Order')]??"lang not found"}}">
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
@section('script_style')
    @foreach($language as $lang)
    <script>
        $(function ()  {
            // Summernote
            $('#{{$lang->code}}').summernote();

        })
    </script>
    @endforeach
    {!! JsValidator::formRequest('Modules\Setting\Http\Requests\Page\CreateRequest','#create') !!}
@endsection
