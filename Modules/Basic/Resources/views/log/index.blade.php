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
                        <h1>{{$custom[strtolower('log')]??"lang not found"}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??"lang not found"}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('log')]??"lang not found"}}</li>
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
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{$custom[strtolower('action')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('url')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('comment')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('done_by')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('affected')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('created_at')]??"lang not found"}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr>
                                                <td>{{$custom[strtolower($data->action)]??"lang not found"}}</td>
                                                <td>{{$data->url}}</td>
                                                <td>{{$custom[strtolower($data->comment)]??$data->comment}}</td>
                                                @if($data->done_by)
                                                    <td>{{$data->done_by_user->fullname}}</td>
                                                @else
                                                    <td>{{$custom[strtolower('visitor')]??"lang not found"}}</td>
                                                @endif
                                                <td>{{$custom[strtolower(basename($data->affected_type))]??basename($data->affected_type)}}</td>
                                                <td>{{$data->created_at}}</td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>{{$custom[strtolower('action')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('url')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('comment')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('done_by')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('affected')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('created_at')]??"lang not found"}}</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    {{ $datas->appends($_GET)->links('includes.admin.dataTables.pagination', ['paginator' => $datas,'perPage' =>Request::get('perPage') ?? $datas->perPage()]) }}
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
