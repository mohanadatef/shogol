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
                                {{$custom[strtolower('edit')]??""}}
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('errors.error')
                            <form action="{{route('category.update',$data->id)}}" method="post" id="edit" enctype="multipart/form-data">
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
                                    @endforeach
                                        <div class="form-group{{ $errors->has('type_work') ? ' is-invalid' : "" }}">
                                            <label for="type_work">{{$custom[strtolower('type_work')]??'lang not found'}}</label>
                                            <div class="icheck-success d-inline">
                                                <input type="radio" @if($data->type_work) checked @endif  name="type_work" value="{{workType()['on']}}" id="radioSuccess1">
                                                <label for="radioSuccess1">
                                                    {{$custom[strtolower(workType()['on'])]??"lang not found"}}
                                                </label>
                                            </div>
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" @if($data->type_work) checked @endif name="type_work" value="{{workType()['of']}}"  id="radioSuccess2">
                                                <label for="radioSuccess2">
                                                    {{$custom[strtolower(workType()['of'])]??"lang not found"}}
                                                </label>
                                            </div>
                                        </div>
                                    <div class="form-group{{ $errors->has('category_id') ? ' is-invalid' : "" }}">
                                        <label>{{$custom[strtolower('parent')]??"lang not found"}}</label>
                                        <select class="form-control" id="category_id" name="parent_id"
                                                style="width: 100%;">
                                            <option value="0" @if($data->parent_id == 0) selected @endif id="option-category-0">{{$custom[strtolower('select')]??"lang not found"}}</option>
                                            @foreach($category as $my)
                                                <option value="{{$my->id}}" @if($data->parent_id == $my->id) selected @endif id="option-category-{{$my->id}}">{{$my->name->value ?? ""}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        <div class="form-group{{ $errors->has('tag') ? ' is-invalid' : "" }}">
                                            <label for="tag">{{$custom[strtolower('tag')]??"lang not found"}}</label>
                                            <textarea type="text" name="tag" class="form-control" id="tag"
                                                      placeholder="{{$custom[strtolower('Enter_tag')]??"lang not found"}}">{{implode("-",$data->tags->pluck('name.value')->toArray())}}</textarea>
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
    <script>
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
    {!! JsValidator::formRequest('Modules\CoreData\Http\Requests\Category\EditRequest','#edit') !!}
@endsection
