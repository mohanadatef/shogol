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
                        <h1>{{$custom[strtolower('Setting')]??""}}</h1>
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
                    @include('errors.error')
                        <!-- jquery validation -->
                        <form action="{{route('setting.update')}}" method="post" id="edit" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-primary">
                                <div class="card-header">
                                    {{$custom[strtolower('main')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('name') ? ' is-invalid' : "" }}">
                                                <label for="name">{{$custom[strtolower('name')]??'name'}}</label>
                                                <input type="text" name="name" class="form-control"
                                                       id="name"
                                                       value="{{$datas[strtolower('name')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="{{getLogoSetting()}}" style="width:100px;height: 100px">
                                            <div class="form-group{{ $errors->has('logo') ? ' has-error' : "" }}">
                                                <label>{{$custom[strtolower('logo')]??'logo'}}</label>
                                                <input type="file" value="" name="logos"/>
                                                <label for="logo">jpg, png, gif</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has(strtolower('Version')) ? ' is-invalid' : "" }}">
                                                <label for="{{strtolower('Version')}}">{{$custom[strtolower('Version')]??'name'}}</label>
                                                <input type="text" name="{{strtolower('Version')}}" class="form-control"
                                                       id="{{strtolower('Version')}}"
                                                       value="{{$datas[strtolower('Version')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has(strtolower('swear')) ? ' is-invalid' : "" }}">
                                                <label for="{{strtolower('swear')}}">{{$custom[strtolower('swear')]??"swear"}}</label>
                                                <textarea type="text" name="{{strtolower('swear')}}" class="form-control" id="{{strtolower('swear')}}"
                                                          placeholder="{{$custom[strtolower('Enter_Description')]??"lang not found"}}">{{$datas['swear']}}</textarea>
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
                                    {{$custom[strtolower('email')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div
                                                class="form-group{{ $errors->has('mail_configHost') ? ' is-invalid' : "" }}">
                                                <label
                                                    for="mail_configHost">{{$custom[strtolower('mail_configHost')]??'mail_configHost'}}</label>
                                                <input type="text" name="mail_configHost" class="form-control"
                                                       id="mail_configHost"
                                                       value="{{$datas[strtolower('mail_configHost')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="form-group{{ $errors->has('mail_config_port') ? ' is-invalid' : "" }}">
                                                <label
                                                    for="mail_config_port">{{$custom[strtolower('mail_config_port')]??'mail_config_port'}}</label>
                                                <input type="text" name="mail_config_port" class="form-control"
                                                       id="mail_config_port"
                                                       value="{{$datas[strtolower('mail_config_port')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="form-group{{ $errors->has('mail_config_encryption') ? ' is-invalid' : "" }}">
                                                <label
                                                    for="mail_config_encryption">{{$custom[strtolower('mail_config_encryption')]??'mail_config_encryption'}}</label>
                                                <input type="text" name="mail_config_encryption" class="form-control"
                                                       id="mail_config_encryption"
                                                       value="{{$datas[strtolower('mail_config_encryption')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="form-group{{ $errors->has('mail_config_address') ? ' is-invalid' : "" }}">
                                                <label
                                                    for="mail_config_address">{{$custom[strtolower('mail_config_address')]??'mail_config_address'}}</label>
                                                <input type="text" name="mail_config_address" class="form-control"
                                                       id="mail_config_address"
                                                       value="{{$datas[strtolower('mail_config_address')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="form-group{{ $errors->has('mail_config_password') ? ' is-invalid' : "" }}">
                                                <label
                                                    for="mail_config_password">{{$custom[strtolower('mail_config_password')]??'mail_config_password'}}</label>
                                                <input type="text" name="mail_config_password" class="form-control"
                                                       id="mail_config_password"
                                                       value="{{$datas[strtolower('mail_config_password')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
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
                                    {{$custom[strtolower('links')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('verify_mail_link') ? ' is-invalid' : "" }}">
                                                <label for="verify_mail_link">{{$custom[strtolower('verify_mail_link')]??'verify_mail_link'}}</label>
                                                <input type="text" name="verify_mail_link" class="form-control"
                                                       id="verify_mail_link"
                                                       value="{{$datas[strtolower('verify_mail_link')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('accept_mail_link') ? ' is-invalid' : "" }}">
                                                <label for="accept_mail_link">{{$custom[strtolower('accept_mail_link')]??'accept_mail_link'}}</label>
                                                <input type="text" name="accept_mail_link" class="form-control"
                                                       id="accept_mail_link"
                                                       value="{{$datas[strtolower('accept_mail_link')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('reject_mail_link') ? ' is-invalid' : "" }}">
                                                <label for="reject_mail_link">{{$custom[strtolower('reject_mail_link')]??'reject_mail_link'}}</label>
                                                <input type="text" name="reject_mail_link" class="form-control"
                                                       id="reject_mail_link"
                                                       value="{{$datas[strtolower('reject_mail_link')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('facebook') ? ' is-invalid' : "" }}">
                                                <label for="facebook">{{$custom[strtolower('facebook')]??'facebook'}}</label>
                                                <input type="text" name="facebook" class="form-control"
                                                       id="facebook"
                                                       value="{{$datas[strtolower('facebook')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('youtube') ? ' is-invalid' : "" }}">
                                                <label for="youtube">{{$custom[strtolower('youtube')]??'facebook'}}</label>
                                                <input type="text" name="youtube" class="form-control"
                                                       id="youtube"
                                                       value="{{$datas[strtolower('youtube')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('linkedIn') ? ' is-invalid' : "" }}">
                                                <label for="linkedIn">{{$custom[strtolower('linkedIn')]??'facebook'}}</label>
                                                <input type="text" name="linkedIn" class="form-control"
                                                       id="linkedIn"
                                                       value="{{$datas[strtolower('linkedIn')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('instagram') ? ' is-invalid' : "" }}">
                                                <label for="instagram">{{$custom[strtolower('instagram')]??'instagram'}}</label>
                                                <input type="text" name="instagram" class="form-control"
                                                       id="instagram"
                                                       value="{{$datas[strtolower('instagram')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('snapchat') ? ' is-invalid' : "" }}">
                                                <label for="snapchat">{{$custom[strtolower('snapchat')]??'snapchat'}}</label>
                                                <input type="text" name="snapchat" class="form-control"
                                                       id="snapchat"
                                                       value="{{$datas[strtolower('snapchat')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('twitter') ? ' is-invalid' : "" }}">
                                                <label for="twitter">{{$custom[strtolower('twitter')]??'twitter'}}</label>
                                                <input type="text" name="twitter" class="form-control"
                                                       id="twitter"
                                                       value="{{$datas[strtolower('twitter')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('ios') ? ' is-invalid' : "" }}">
                                                <label for="ios">{{$custom[strtolower('ios')]??'ios'}}</label>
                                                <input type="text" name="ios" class="form-control"
                                                       id="ios"
                                                       value="{{$datas[strtolower('ios')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('android') ? ' is-invalid' : "" }}">
                                                <label for="android">{{$custom[strtolower('android')]??'facebook'}}</label>
                                                <input type="text" name="android" class="form-control"
                                                       id="android"
                                                       value="{{$datas[strtolower('android')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
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
                                    {{$custom[strtolower('manage_profile')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('performers_profile_open') ? ' is-invalid' : "" }}">
                                                <label for="performers_profile_open">{{$custom[strtolower('performers_profile_open')]??'performers_profile_open'}}</label>
                                                <input type="text" name="performers_profile_open" class="form-control"
                                                       id="performers_profile_open"
                                                       value="{{$datas[strtolower('performers_profile_open')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('skill_count_required') ? ' is-invalid' : "" }}">
                                                <label for="skill_count_required">{{$custom[strtolower('skill_count_required')]??'skill_count_required'}}</label>
                                                <input type="text" name="skill_count_required" class="form-control"
                                                       id="skill_count_required"
                                                       value="{{$datas[strtolower('skill_count_required')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
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
                                    {{$custom[strtolower('ad')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('freelancer_ad_count') ? ' is-invalid' : "" }}">
                                                <label for="freelancer_ad_count">{{$custom[strtolower('freelancer_ad_count')]??'freelancer_ad_count'}}</label>
                                                <input type="text" name="freelancer_ad_count" class="form-control"
                                                       id="freelancer_ad_count"
                                                       value="{{$datas[strtolower('freelancer_ad_count')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('time_out_ad') ? ' is-invalid' : "" }}">
                                                <label for="time_out_ad">{{$custom[strtolower('time_out_ad')]??'time_out_ad'}}</label>
                                                <input type="text" name="time_out_ad" class="form-control"
                                                       id="time_out_ad"
                                                       value="{{$datas[strtolower('time_out_ad')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('videos_ad_count') ? ' is-invalid' : "" }}">
                                                <label for="videos_ad_count">{{$custom[strtolower('videos_ad_count')]??'videos_ad_count'}}</label>
                                                <input type="text" name="videos_ad_count" class="form-control"
                                                       id="videos_ad_count"
                                                       value="{{$datas[strtolower('videos_ad_count')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('images_ad_count') ? ' is-invalid' : "" }}">
                                                <label for="images_ad_count">{{$custom[strtolower('images_ad_count')]??'images_ad_count'}}</label>
                                                <input type="text" name="images_ad_count" class="form-control"
                                                       id="images_ad_count"
                                                       value="{{$datas[strtolower('images_ad_count')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
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
                                    {{$custom[strtolower('offer')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('time_out_offer') ? ' is-invalid' : "" }}">
                                                <label for="time_out_offer">{{$custom[strtolower('time_out_offer')]??'time_out_offer'}}</label>
                                                <input type="text" name="time_out_offer" class="form-control"
                                                       id="time_out_offer"
                                                       value="{{$datas[strtolower('time_out_offer')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
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
                                    {{$custom[strtolower('task')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('category_task_count_required') ? ' is-invalid' : "" }}">
                                                <label for="category_task_count_required">{{$custom[strtolower('category_task_count_required')]??'category_task_count_required'}}</label>
                                                <input type="text" name="category_task_count_required" class="form-control"
                                                       id="category_task_count_required"
                                                       value="{{$datas[strtolower('category_task_count_required')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('client_task_count') ? ' is-invalid' : "" }}">
                                                <label for="client_task_count">{{$custom[strtolower('client_task_count')]??'client_task_count'}}</label>
                                                <input type="text" name="client_task_count" class="form-control"
                                                       id="client_task_count"
                                                       value="{{$datas[strtolower('client_task_count')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('freelancer_task_count') ? ' is-invalid' : "" }}">
                                                <label for="freelancer_task_count">{{$custom[strtolower('freelancer_task_count')]??'freelancer_task_count'}}</label>
                                                <input type="text" name="freelancer_task_count" class="form-control"
                                                       id="freelancer_task_count"
                                                       value="{{$datas[strtolower('freelancer_task_count')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('time_out_task') ? ' is-invalid' : "" }}">
                                                <label for="time_out_task">{{$custom[strtolower('time_out_task')]??'time_out_task'}}</label>
                                                <input type="text" name="time_out_task" class="form-control"
                                                       id="time_out_task"
                                                       value="{{$datas[strtolower('time_out_task')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('videos_task_count') ? ' is-invalid' : "" }}">
                                                <label for="videos_task_count">{{$custom[strtolower('videos_task_count')]??'videos_task_count'}}</label>
                                                <input type="text" name="videos_task_count" class="form-control"
                                                       id="videos_task_count"
                                                       value="{{$datas[strtolower('videos_task_count')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('images_task_count') ? ' is-invalid' : "" }}">
                                                <label for="images_task_count">{{$custom[strtolower('images_task_count')]??'images_task_count'}}</label>
                                                <input type="text" name="images_task_count" class="form-control"
                                                       id="images_task_count"
                                                       value="{{$datas[strtolower('images_task_count')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
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
                                    {{$custom[strtolower('Notification')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('fcm_secret_key') ? ' is-invalid' : "" }}">
                                                <label for="fcm_secret_key">{{$custom[strtolower('fcm_secret_key')]??'fcm_secret_key'}}</label>
                                                <input type="text" name="fcm_secret_key" class="form-control"
                                                       id="fcm_secret_key"
                                                       value="{{$datas[strtolower('fcm_secret_key')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('firebase_api_key') ? ' is-invalid' : "" }}">
                                                <label for="firebase_api_key">{{$custom[strtolower('firebase_api_key')]??'firebase_api_key'}}</label>
                                                <input type="text" name="firebase_api_key" class="form-control"
                                                       id="firebase_api_key"
                                                       value="{{$datas[strtolower('firebase_api_key')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('firebase_auth_domain') ? ' is-invalid' : "" }}">
                                                <label for="firebase_auth_domain">{{$custom[strtolower('firebase_auth_domain')]??'firebase_auth_domain'}}</label>
                                                <input type="text" name="firebase_auth_domain" class="form-control"
                                                       id="firebase_auth_domain"
                                                       value="{{$datas[strtolower('firebase_auth_domain')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('firebase_database_url') ? ' is-invalid' : "" }}">
                                                <label for="firebase_database_url">{{$custom[strtolower('firebase_database_url')]??'firebase_database_url'}}</label>
                                                <input type="text" name="firebase_database_url" class="form-control"
                                                       id="firebase_database_url"
                                                       value="{{$datas[strtolower('firebase_database_url')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('firebase_project_id') ? ' is-invalid' : "" }}">
                                                <label for="firebase_project_id">{{$custom[strtolower('firebase_project_id')]??'firebase_project_id'}}</label>
                                                <input type="text" name="firebase_project_id" class="form-control"
                                                       id="firebase_project_id"
                                                       value="{{$datas[strtolower('firebase_project_id')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('firebase_storage_bucket') ? ' is-invalid' : "" }}">
                                                <label for="firebase_storage_bucket">{{$custom[strtolower('firebase_storage_bucket')]??'firebase_storage_bucket'}}</label>
                                                <input type="text" name="firebase_storage_bucket" class="form-control"
                                                       id="firebase_storage_bucket"
                                                       value="{{$datas[strtolower('firebase_storage_bucket')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('firebase_messaging_sender_id') ? ' is-invalid' : "" }}">
                                                <label for="firebase_messaging_sender_id">{{$custom[strtolower('firebase_messaging_sender_id')]??'firebase_messaging_sender_id'}}</label>
                                                <input type="text" name="firebase_messaging_sender_id" class="form-control"
                                                       id="firebase_messaging_sender_id"
                                                       value="{{$datas[strtolower('firebase_messaging_sender_id')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('firebase_app_id') ? ' is-invalid' : "" }}">
                                                <label for="firebase_app_id">{{$custom[strtolower('firebase_app_id')]??'firebase_app_id'}}</label>
                                                <input type="text" name="firebase_app_id" class="form-control"
                                                       id="firebase_app_id"
                                                       value="{{$datas[strtolower('firebase_app_id')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('firebase_measurement_id') ? ' is-invalid' : "" }}">
                                                <label for="firebase_measurement_id">{{$custom[strtolower('firebase_messaging_sender_id')]??'firebase_messaging_sender_id'}}</label>
                                                <input type="text" name="firebase_measurement_id" class="form-control"
                                                       id="firebase_measurement_id"
                                                       value="{{$datas[strtolower('firebase_measurement_id')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="is_send_notification">{{$custom[strtolower('is_send_notification')]??'is_send_notification'}}</label>
                                            <div class="icheck-success d-inline">
                                              <input type="radio" @if($datas[strtolower('is_send_notification')]) checked @endif name="is_send_notification" value="1" id="radioSuccess1">
                                              <label for="radioSuccess1">
                                                  {{$custom[strtolower('Active')]??'Active'}}
                                              </label>
                                            </div>
                                            <div class="icheck-danger d-inline">
                                              <input type="radio" @if(!$datas[strtolower('is_send_notification')]) checked @endif name="is_send_notification" value="0"  id="radioSuccess2">
                                              <label for="radioSuccess2">
                                                  {{$custom[strtolower('Suspended')]??'Suspended'}}
                                              </label>
                                            </div>
                                        </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                            <div class="card card-primary">
                                <div class="card-header">
                                    {{$custom[strtolower('otp')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('otp_authorization') ? ' is-invalid' : "" }}">
                                                <label for="otp_authorization">{{$custom[strtolower('otp_authorization')]??'otp_authorization'}}</label>
                                                <input type="text" name="otp_authorization" class="form-control"
                                                       id="otp_authorization"
                                                       value="{{$datas[strtolower('otp_authorization')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('otp_app_id') ? ' is-invalid' : "" }}">
                                                <label for="otp_app_id">{{$custom[strtolower('otp_app_id')]??'otp_app_id'}}</label>
                                                <input type="text" name="otp_app_id" class="form-control"
                                                       id="otp_app_id"
                                                       value="{{$datas[strtolower('otp_app_id')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{$custom[strtolower('Update')]??""}}</button>
                            </div>
                        <!-- /.card -->
                        </form>
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
    <script>
        $(function ()  {
            // Summernote
            $('#swear').summernote();
        })
    </script>
    {!! JsValidator::formRequest('Modules\Setting\Http\Requests\Setting\EditRequest','#edit') !!}
@endsection
