 @extends('includes.admin.master_admin')
@section('title')
    {{$custom[strtolower('edit')]??"lang not found"}}
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
                        <h1>{{$custom[strtolower('Status')]??""}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??""}}</a></li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('Status')]??""}}</li>
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
                                {{$custom[strtolower('edit')]??""}}
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('errors.error')
                            <form action="{{route('status.update',$data->id)}}" method="post" id="edit" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @foreach($language as $lang)
                                        <div
                                            class="form-group{{ $errors->has('name['.$lang->code.']') ? ' is-invalid' : "" }}">
                                            <label
                                                for="name">{{$custom[strtolower('Name')]??"lang not found"}} {{$lang->name}}</label>
                                            <input type="text" name="name[{{$lang->code}}]" class="form-control"
                                                   id="name-{{$lang->code}}"
                                                   value="{{$data->nameValue()[$lang->code]??""}}"
                                                   placeholder="{{$custom[strtolower('Enter_Name')]??"lang not found"}} {{$lang->name}}">
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('task_owner['.$lang->code.']') ? ' is-invalid' : "" }}">
                                            <label
                                                for="task_owner">{{$custom[strtolower('task_owner')]??"lang not found"}} {{$lang->name}}</label>
                                            <input type="text" name="task_owner[{{$lang->code}}]" class="form-control"
                                                   id="task_owner-{{$lang->code}}"
                                                   value="{{$data->task_ownerValue()[$lang->code]??""}}"
                                                   placeholder="{{$custom[strtolower('Enter_task_owner')]??"lang not found"}} {{$lang->name}}">
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('offer_owner['.$lang->code.']') ? ' is-invalid' : "" }}">
                                            <label
                                                for="offer_owner">{{$custom[strtolower('offer_owner')]??"lang not found"}} {{$lang->name}}</label>
                                            <input type="text" name="offer_owner[{{$lang->code}}]" class="form-control"
                                                   id="offer_owner-{{$lang->code}}"
                                                   value="{{$data->offer_ownerValue()[$lang->code]??""}}"
                                                   placeholder="{{$custom[strtolower('Enter_offer_owner')]??"lang not found"}} {{$lang->name}}">
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('offer_owner_description['.$lang->code.']') ? ' is-invalid' : "" }}">
                                            <label
                                                for="offer_owner_description">{{$custom[strtolower('offer_owner_description')]??"lang not found"}} {{$lang->name}}</label>
                                            <input type="text" name="offer_owner_description[{{$lang->code}}]" class="form-control"
                                                   id="offer_owner_description-{{$lang->code}}"
                                                   value="{{$data->offer_owner_descriptionValue()[$lang->code]??""}}"
                                                   placeholder="{{$custom[strtolower('Enter_offer_owner_description')]??"lang not found"}} {{$lang->name}}">
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('task_owner_description['.$lang->code.']') ? ' is-invalid' : "" }}">
                                            <label
                                                for="task_owner_description">{{$custom[strtolower('task_owner_description')]??"lang not found"}} {{$lang->name}}</label>
                                            <input type="text" name="task_owner_description[{{$lang->code}}]" class="form-control"
                                                   id="task_owner_description-{{$lang->code}}"
                                                   value="{{$data->task_owner_descriptionValue()[$lang->code]??""}}"
                                                   placeholder="{{$custom[strtolower('Enter_task_owner_description')]??"lang not found"}} {{$lang->name}}">
                                        </div>
                                    @endforeach
                                        <div class="form-group{{ $errors->has('task_owner_color') ? ' is-invalid' : "" }}">
                                            <label for="task_owner_color">{{$custom[strtolower('task_owner_color')]??"lang not found"}}</label>
                                            <input type="text" name="task_owner_color" class="form-control" id="order"
                                                   value="{{$data->task_owner_color}}" placeholder="{{$custom[strtolower('Enter_task_owner_color')]??"lang not found"}}">
                                        </div>
                                        <div class="form-group{{ $errors->has('offer_owner_color') ? ' is-invalid' : "" }}">
                                            <label for="offer_owner_color">{{$custom[strtolower('offer_owner_color')]??"lang not found"}}</label>
                                            <input type="text" name="offer_owner_color" class="form-control" id="order"
                                                   value="{{$data->offer_owner_color}}" placeholder="{{$custom[strtolower('Enter_offer_owner_color')]??"lang not found"}}">
                                        </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{$custom[strtolower('Update')]??""}}</button>
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
    {!! JsValidator::formRequest('Modules\CoreData\Http\Requests\Status\EditRequest','#edit') !!}
@endsection
