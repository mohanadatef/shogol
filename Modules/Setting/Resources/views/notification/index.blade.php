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
                        <h1>{{$custom[strtolower('Notification')]??"lang not found"}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??"lang not found"}}</a></li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('Notification')]??"lang not found"}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="get" action="">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{$custom[strtolower('title')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('description')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('type')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('pusher')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('receiver')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('Time')]??"lang not found"}}</th>

                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="title-{{$data->id}}">{{$data->title->value??""}}</td>
                                                <td id="description-{{$data->id}}">{{$data->description->value??""}}</td>
                                                <td id="type-{{$data->id}}">{{$data->type??""}}</td>
                                                <td id="pusher-{{$data->id}}">{{$data->pusher->fullname ?? ""}}</td>
                                                <td id="receiver-{{$data->id}}"> {{$data->receiver->fullname??""}}</td>
                                                <td id="Time-{{$data->id}}">{{$data->createdAtValue??""}}</td>

                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>{{$custom[strtolower('title')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('description')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('type')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('pusher')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('receiver')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('Time')]??"lang not found"}}</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    {{ $datas->links('includes.admin.dataTables.pagination', ['paginator' => $datas,'perPage' =>Request::get('perPage') ?? $datas->perPage()]) }}
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </form>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')
@endsection
