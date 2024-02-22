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
        @permission('dashboard-report')
        <!-- Main content -->
        <section class="content">
            <form method="get" action="">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{$custom[strtolower('general')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('visitor')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('client')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('freelancer')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('Ad')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('task')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('offer')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('tag')]??"lang not found"}}</th>
                                            <th>{{$custom[strtolower('category')]??"lang not found"}}</th>

                                        </tr>

                                        <tbody id="body">
                                            <tr>
                                                <td>{{$custom[strtolower('total')]??"lang not found"}}</td>
                                                <td> @foreach ($datas['visitor'] as $key=>$value)
                                                    {{$value['name'] != 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                                <td> @foreach ($datas['client'] as $key=>$value)
                                                    {{$value['name'] != 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                                <td> @foreach ($datas['freelancer'] as $key=>$value)
                                                    {{$value['name'] != 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                                <td> @foreach ($datas['ad'] as $key=>$value)
                                                    {{$value['name'] != 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                                <td> @foreach ($datas['task'] as $key=>$value)
                                                    {{$value['name'] != 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                                <td> @foreach ($datas['offer'] as $key=>$value)
                                                    {{$value['name'] != 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                                <td> @foreach ($datas['tag'] as $key=>$value)
                                                    {{$value['name'] != 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                                <td> @foreach ($datas['category'] as $key=>$value)
                                                    {{$value['name'] != 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                 <td>{{$custom[strtolower('day')]??"lang not found"}}</td>
                                                 <td> @foreach ($datas['visitor'] as $key=>$value)
                                                    {{$value['name'] == 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                                <td> @foreach ($datas['client'] as $key=>$value)
                                                    {{$value['name'] == 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                                <td> @foreach ($datas['freelancer'] as $key=>$value)
                                                    {{$value['name'] == 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                                <td> @foreach ($datas['ad'] as $key=>$value)
                                                    {{$value['name'] == 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                                <td> @foreach ($datas['task'] as $key=>$value)
                                                    {{$value['name'] == 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                                <td> @foreach ($datas['offer'] as $key=>$value)
                                                    {{$value['name'] == 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                                <td> @foreach ($datas['tag'] as $key=>$value)
                                                    {{$value['name'] == 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                                <td> @foreach ($datas['category'] as $key=>$value)
                                                    {{$value['name'] == 'day' ? $value['count'] : ""}}
                                                    @endforeach
                                                </td>
                                            </tr>

                                            </thead>
                                        </tbody>
                                    </table>
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
        @endpermission

        <!-- /.content -->
    </div>
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')
    {{-- todo check it -heba-  --}}
    <script type="text/javascript">
    $(function ()
        $("#example2").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false, paging: false,searching: false,info:false,
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
    </script>
@endsection
