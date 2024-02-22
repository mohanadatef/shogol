@extends('includes.admin.master_admin')
@section('title')
    {{ $custom[strtolower('DashBoard')]??"" }}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$custom[strtolower('Home')]??""}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                @foreach($datas as $key => $data)
                    {{$custom[strtolower($key)]??"lang not found"}}
                    <div class="row">
                        @foreach($data as $keys => $d)
                            <div class="col-md-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{$d['count']}}</h3>
                                        <p>{{$custom[strtolower($d['name'])]??"lang not found"}}</p>
                                        {{$custom[strtolower('from')]??"lang not found"}}
                                        {{$dates[$keys]['start']}}
                                        <br>
                                        {{$custom[strtolower('to')]??"lang not found"}}
                                        {{ $dates[$keys]['end']}}
                                    </div>
                                    @php
                                        if($key == userRole()['uc'] || $key == userRole()['uf'] || $key == userRole()['um'])
                                        {
                                            $url = 'user';
                                        }else{
                                            $url = $key;
                                        }
                                    @endphp
                                    <a href="{{route($url.'.index',['role'=>$key,'created_at'=>$dates[$keys]['start'].' - '.$dates[$keys]['end']])}}"
                                       class="small-box-footer">{{$custom[strtolower('More_info')]??"lang not found"}}
                                        <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
            @endforeach
            <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
