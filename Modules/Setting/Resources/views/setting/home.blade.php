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
                        <h1>{{$custom[strtolower('home_setting')]??""}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                        href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??""}}</a></li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('home_setting')]??""}}</li>
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
                        @include('errors.error')
                        <!-- jquery validation -->
                        <form action="{{route('setting.update')}}" method="post" id="edit"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card card-primary">
                                <div class="card-header">
                                    {{$custom[strtolower('section_1')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($language as $lang)
                                            <div class="col-md-6">
                                                <div
                                                        class="form-group{{ $errors->has('home_section_1_title['.$lang->code.']') ? ' is-invalid' : "" }}">
                                                    <label
                                                            for="home_section_1_title">{{$custom[strtolower('home_section_1_title')]??"lang not found"}} {{$lang->name}}</label>
                                                    <textarea type="text"
                                                              name="home_section_1_title[{{$lang->code}}]"
                                                              class="form-control"
                                                              id="home_section_1_title_{{$lang->code}}"
                                                              placeholder="{{$custom[strtolower('Enter_home_section_1_title')]??"lang not found"}} {{$lang->name}}">{{getSetting('home_section_1_title')->home_section_1_titleValue()[$lang->code]??""}}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-md-6">
                                            <img src="{{getImageSetting('home_section_1_image','first')}}"
                                                 style="width:100px;height: 100px">
                                            <div
                                                    class="form-group{{ $errors->has('home_section_1_image') ? ' has-error' : "" }}">
                                                <label>{{$custom[strtolower('home_section_1_image')]??'image'}}</label>
                                                <input type="file" value="" name="home_section_1_image"/>
                                                <label for="home_section_1_image">jpg, png, gif</label>
                                            </div>
                                        </div>
                                        @foreach($language as $lang)
                                            <div class="col-md-6">
                                                <div
                                                        class="form-group{{ $errors->has('home_section_1_description['.$lang->code.']') ? ' is-invalid' : "" }}">
                                                    <label
                                                            for="home_section_1_description">{{$custom[strtolower('home_section_1_description')]??"lang not found"}} {{$lang->name}}</label>
                                                    <textarea type="text"
                                                              name="home_section_1_description[{{$lang->code}}]"
                                                              class="form-control"
                                                              id="home_section_1_description_{{$lang->code}}"
                                                              placeholder="{{$custom[strtolower('Enter_home_section_1_description')]??"lang not found"}} {{$lang->name}}">{{getSetting('home_section_1_description')->home_section_1_descriptionValue()[$lang->code]??""}}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-md-6">
                                            <div
                                                    class="form-group{{ $errors->has(strtolower('home_section_1_link')) ? ' is-invalid' : "" }}">
                                                <label
                                                        for="{{strtolower('home_section_1_link')}}">{{$custom[strtolower('home_section_1_link')]??"link"}}</label>
                                                <input type="text" name="home_section_2_link_link" class="form-control"
                                                       id="home_section_2_link_link"
                                                       value="{{$datas[strtolower('home_section_1_link')]}}"
                                                       placeholder="{{$custom[strtolower('home_section_1_link')]??"lang not found"}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.form-group -->
                            <!-- /.col -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    {{$custom[strtolower('section_2')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($language as $lang)
                                            <div class="col-md-6">
                                                <div
                                                        class="form-group{{ $errors->has('home_section_2_title['.$lang->code.']') ? ' is-invalid' : "" }}">
                                                    <label
                                                            for="home_section_2_title">{{$custom[strtolower('home_section_2_title')]??"lang not found"}} {{$lang->name}}</label>
                                                    <textarea type="text"
                                                              name="home_section_2_title[{{$lang->code}}]"
                                                              class="form-control"
                                                              id="home_section_2_title_{{$lang->code}}"
                                                              placeholder="{{$custom[strtolower('Enter_home_section_2_title')]??"lang not found"}} {{$lang->name}}">{{getSetting('home_section_2_title')->home_section_2_titleValue()[$lang->code]??""}}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-md-6">
                                            <div
                                                    class="form-group{{ $errors->has('home_section_2_video_link') ? ' is-invalid' : "" }}">
                                                <label
                                                        for="home_section_2_video_link">{{$custom[strtolower('home_section_2_video_link')]??'link'}}</label>
                                                <input type="text" name="home_section_2_video_link" class="form-control"
                                                       id="home_section_2_video_link"
                                                       value="{{$datas[strtolower('home_section_2_video_link')]}}"
                                                       placeholder="{{$custom[strtolower('home_section_2_video_link')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        @foreach($language as $lang)
                                            <div class="col-md-6">
                                                <div
                                                        class="form-group{{ $errors->has('home_section_2_description['.$lang->code.']') ? ' is-invalid' : "" }}">
                                                    <label
                                                            for="home_section_2_description">{{$custom[strtolower('home_section_2_description')]??"lang not found"}} {{$lang->name}}</label>
                                                    <textarea type="text"
                                                              name="home_section_2_description[{{$lang->code}}]"
                                                              class="form-control"
                                                              id="home_section_2_description_{{$lang->code}}"
                                                              placeholder="{{$custom[strtolower('Enter_home_section_2_description')]??"lang not found"}} {{$lang->name}}">{{getSetting('home_section_2_description')->home_section_2_descriptionValue()[$lang->code]??""}}</textarea>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card card-primary">
                                <div class="card-header">
                                    {{$custom[strtolower('section_3')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($language as $lang)
                                            <div class="col-md-6">
                                                <div
                                                        class="form-group{{ $errors->has('home_section_3_title['.$lang->code.']') ? ' is-invalid' : "" }}">
                                                    <label
                                                            for="home_section_3_title">{{$custom[strtolower('home_section_3_title')]??"lang not found"}} {{$lang->name}}</label>
                                                    <textarea type="text"
                                                              name="home_section_3_title[{{$lang->code}}]"
                                                              class="form-control"
                                                              id="home_section_3_title_{{$lang->code}}"
                                                              placeholder="{{$custom[strtolower('Enter_home_section_3_title')]??"lang not found"}} {{$lang->name}}">{{getSetting('home_section_3_title')->home_section_3_titleValue()[$lang->code]??""}}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-md-6">
                                            @foreach (getImageSetting('home_section_3_image') as $image )
                                                <div id="{{$image['id']}}">
                                                    <img src="{{$image['file']}}" style="width:100px;height: 100px">
                                                    <div class="btn btn-danger delete-image" style="bottom:15px"
                                                         onclick="deleteImage({{$image['id']}})">x
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div
                                                    class="form-group{{ $errors->has('home_section_3_image') ? ' has-error' : "" }}">
                                                <label>{{$custom[strtolower('home_section_3_image')]??'image'}}</label>
                                                <input type="file" value="" name="home_section_3_image[]" multiple/>
                                                <label for="home_section_3_image">jpg, png, gif</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card card-primary">
                                <div class="card-header">
                                    {{$custom[strtolower('section_4')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($language as $lang)
                                            <div class="col-md-6">
                                                <div
                                                        class="form-group{{ $errors->has('home_section_4_title['.$lang->code.']') ? ' is-invalid' : "" }}">
                                                    <label
                                                            for="home_section_4_title">{{$custom[strtolower('home_section_4_title')]??"lang not found"}} {{$lang->name}}</label>
                                                    <textarea type="text"
                                                              name="home_section_4_title[{{$lang->code}}]"
                                                              class="form-control"
                                                              id="home_section_4_title_{{$lang->code}}"
                                                              placeholder="{{$custom[strtolower('Enter_home_section_4_title')]??"lang not found"}} {{$lang->name}}">{{getSetting('home_section_4_title')->home_section_4_titleValue()[$lang->code]??""}}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-md-6">

                                            <div
                                                    class="form-group{{ $errors->has('home_section_4_url') ? ' is-invalid' : "" }}">
                                                <label
                                                        for="home_section_4_url">{{$custom[strtolower('home_section_4_url')]??'url'}}</label>
                                                <input type="text" name="home_section_4_url" class="form-control"
                                                       id="home_section_4_url"
                                                       value="{{$datas[strtolower('home_section_4_url')]}}"
                                                       placeholder="{{$custom[strtolower('home_section_4_url')]??"lang not found"}}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card card-primary">
                                <div class="card-header">
                                    {{$custom[strtolower('section_5')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($language as $lang)
                                            <div class="col-md-6">
                                                <div
                                                        class="form-group{{ $errors->has('home_section_5_title['.$lang->code.']') ? ' is-invalid' : "" }}">
                                                    <label
                                                            for="home_section_5_title">{{$custom[strtolower('home_section_5_title')]??"lang not found"}} {{$lang->name}}</label>
                                                    <textarea type="text"
                                                              name="home_section_5_title[{{$lang->code}}]"
                                                              class="form-control"
                                                              id="home_section_5_title_{{$lang->code}}"
                                                              placeholder="{{$custom[strtolower('Enter_home_section_5_title')]??"lang not found"}} {{$lang->name}}">{{getSetting('home_section_5_title')->home_section_5_titleValue()[$lang->code]??""}}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-md-6">
                                            <img src="{{getImageSetting('home_section_5_image','first')}}"
                                                 style="width:100px;height: 100px">
                                            <div
                                                    class="form-group{{ $errors->has('home_section_5_image') ? ' has-error' : "" }}">
                                                <label>{{$custom[strtolower('home_section_5_image')]??'image'}}</label>
                                                <input type="file" value="" name="home_section_5_image"/>
                                                <label for="home_section_5_image">jpg, png, gif</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card card-primary">
                                <div class="card-header">
                                    {{$custom[strtolower('category')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('home_main_category') ? ' has-error' : "" }}">
                                                <label>{{$custom[strtolower('home_main_category')]??'category'}}</label>
                                                <select name="home_main_category" id="home_main_category"
                                                        class="form-control select2"
                                                        data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                                                    @foreach($category as $c)
                                                        <option value="{{$c->id}}" @if($c->id == getSetting('home_main_category')->value) selected @endif>{{$c->name->value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('home_category') ? ' has-error' : "" }}">
                                                <label>{{$custom[strtolower('home_category')]??'category'}}</label>
                                                <select class="form-control select2" multiple="multiple"
                                                        id="home_category" data-max="6"
                                                        name="home_category[]"
                                                        data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                                                    @foreach($category as $c)
                                                        <option value="{{$c->id}}" @if(in_array($c->id ,explode(',', getSetting('home_category')->value))) selected @endif>{{$c->name->value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card-footer">
                                <button type="submit"
                                        class="btn btn-primary">{{$custom[strtolower('Update')]??""}}</button>
                            </div>
                            <!-- /.card -->
                        </form>
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
            $(function () {
                // Summernote
                $('#home_section_1_title_{{$lang->code}}').summernote();
                $('#home_section_1_description_{{$lang->code}}').summernote();
                $('#home_section_2_title_{{$lang->code}}').summernote();
                $('#home_section_2_description_{{$lang->code}}').summernote();
                $('#home_section_3_title_{{$lang->code}}').summernote();
                $('#home_section_4_title_{{$lang->code}}').summernote();
                $('#home_section_5_title_{{$lang->code}}').summernote();
            })
        </script>
    @endforeach
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function deleteImage(id) {
            url = "{{route('media.remove')}}";
            $.ajax({
                type: "delete",
                url: url,
                data: {'id': id},
                success: function (res) {
                    document.getElementById(id).remove();
                    toastr.success('{{$custom[strtolower('Delete_Done')]??"lang not found"}}');
                }, error: function (res) {
                    toastr.error(res.responseJSON.message);
                }
            });
        }
    </script>
    {!! JsValidator::formRequest('Modules\Setting\Http\Requests\Setting\EditRequest','#edit') !!}
@endsection
