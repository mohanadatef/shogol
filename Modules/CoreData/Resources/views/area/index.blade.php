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
                        <h1>{{$custom[strtolower('area')]??"lang not found"}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??"lang not found"}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('area')]??"lang not found"}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="get" action="">
                <div class="container-fluid">
                    @include('coredata::area.filter')
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            @permission('area-create')
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#modal-create">
                                            {{$custom[strtolower('Create')]??"lang not found"}}
                                        </button>
                                    </h3>
                                </div>
                                @endpermission
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th> {{$custom[strtolower('Name')]??"lang not found"}}</th>
                                            <th> {{$custom[strtolower('Country')]??"lang not found"}}</th>
                                            <th> {{$custom[strtolower('City')]??"lang not found"}}</th>
                                            <th> {{$custom[strtolower('area')]??"lang not found"}}</th>
                                            @permission('area-change-status')
                                            <th>{{$custom[strtolower('Status')]??"lang not found"}}</th>
                                            @endpermission
                                            <th> {{$custom[strtolower('action')]??"lang not found"}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="body">
                                        @forelse($datas as $data)
                                            <tr id="data-{{$data->id}}">
                                                <td id="name-{{$data->id}}"
                                                    data-order="{{$data->order}}">{{$data->name->value ??""}}</td>
                                                <td id="country-{{$data->id}}"><a
                                                        href="{{  route('country.index',['id'=>$data->country_id]) }}">{{$data->country->name->value ?? ""}}</a>
                                                </td>
                                                <td id="city-{{$data->id}}"><a
                                                        href="{{  route('city.index',['id'=>$data->city_id]) }}">{{$data->city->name->value ?? ""}}</a>
                                                </td>
                                                <td id="state-{{$data->id}}"><a
                                                        href="{{  route('state.index',['id'=>$data->state_id]) }}">{{$data->state->name->value ?? ""}}</a>
                                                </td>
                                                @permission('area-change-status')
                                                <td>
                                                    <input onfocus="changeStatus({{$data->id}})" type="checkbox"
                                                           name="status" @if($data->status) checked
                                                           @endif id="status-{{$data->id}}"
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success">
                                                </td>
                                                @endpermission
                                                <td>
                                                @permission('area-edit')
                                                    <button type="button"
                                                            class="btn btn-outline-primary btn-block btn-sm"
                                                            onclick="showItem({{$data->id}})">
                                                        <i class="fa fa-edit"></i> {{$custom[strtolower('Edit')]??"lang not found"}}
                                                    </button>
                                                    <button id="openModael{{$data->id}}" type="button" class="d-none"
                                                            data-toggle="modal"
                                                            data-target="#modal-edit">
                                                    </button>
                                                    @endpermission
                                                    @permission('area-delete')
                                                    <button type="button"
                                                            class="btn btn-outline-danger btn-block btn-sm"
                                                            onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                            data-target="#modal-delete">
                                                        <i></i> {{$custom[strtolower('Delete')]??"lang not found"}}
                                                    </button>
                                                    @endpermission
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th> {{$custom[strtolower('Name')]??"lang not found"}}</th>
                                            <th> {{$custom[strtolower('Country')]??"lang not found"}}</th>
                                            <th> {{$custom[strtolower('City')]??"lang not found"}}</th>
                                            <th> {{$custom[strtolower('area')]??"lang not found"}}</th>
                                            @permission('area-change-status')
                                            <th>{{$custom[strtolower('Status')]??"lang not found"}}</th>
                                            @endpermission
                                            <th> {{$custom[strtolower('action')]??"lang not found"}}</th>
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
    @permission('area-create')
    <div class="modal fade" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content bg-success">
                <div class="modal-header">
                    <h4 class="modal-title">{{$custom[strtolower('Create')]??"lang not found"}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="create" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
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
                            <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                <label for="order">{{$custom[strtolower('Order')]??"lang not found"}}</label>
                                <input type="text" name="order" class="form-control" id="order"
                                       value="{{Request::old('order')}}"
                                       placeholder="{{$custom[strtolower('Enter_Order')]??"lang not found"}}">
                            </div>
                            <div class="form-group{{ $errors->has('country_id') ? ' is-invalid' : "" }}">
                                <label>{{$custom[strtolower('Country')]??"lang not found"}}</label>
                                <select class="form-control" id="country" name="country_id"
                                        style="width: 100%;">
                                    <option value="0"
                                            id="option-country-0">{{$custom[strtolower('select')]??"lang not found"}}</option>
                                    @foreach($country as $my)
                                        <option value="{{$my->id}}"
                                                id="option-country-{{$my->id}}">{{$my->name->value ?? ""}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('city_id') ? ' is-invalid' : "" }}">
                                <label>{{$custom[strtolower('city')]??"lang not found"}}</label>
                                <select class="form-control" id="city-id" name="city_id"
                                        style="width: 100%;">
                                    <option value="0"
                                            selected>{{$custom[strtolower('Select')]??"lang not found"}}</option>
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('state_id') ? ' is-invalid' : "" }}">
                                <label>{{$custom[strtolower('state')]??"lang not found"}}</label>
                                <select class="form-control" id="state_id" name="state_id"
                                        style="width: 100%;">
                                    <option value="0"
                                            selected>{{$custom[strtolower('Select')]??"lang not found"}}</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light"
                                data-dismiss="modal">{{$custom[strtolower('Close')]??"lang not found"}}</button>
                        <button type="submit"
                                class="btn btn-outline-light">{{$custom[strtolower('Create')]??"lang not found"}}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endpermission
    @permission('area-edit')
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">{{$custom[strtolower('Edit')]??"lang not found"}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit" action="" method="post" name="edit" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            @foreach($language as $lang)
                                <div
                                    class="form-group{{ $errors->has('name['.$lang->code.']') ? ' is-invalid' : "" }}">
                                    <label
                                        for="name">{{$custom[strtolower('Name')]??"lang not found"}} {{$lang->name}}</label>
                                    <input type="text" name="name[{{$lang->code}}]" class="form-control"
                                           id="name-{{$lang->code}}"
                                           value=""
                                           placeholder="{{$custom[strtolower('Enter_Name')]??"lang not found"}} {{$lang->code}}">
                                </div>
                            @endforeach
                            <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                <label for="order">{{$custom[strtolower('Order')]??"lang not found"}}</label>
                                <input type="text" name="order" class="form-control" id="order"
                                       value="" placeholder="{{$custom[strtolower('Enter_Order')]??"lang not found"}}">
                            </div>
                            <div class="form-group{{ $errors->has('country_id') ? ' is-invalid' : "" }}">
                                <label>{{$custom[strtolower('Country')]??"lang not found"}}</label>
                                <select class="form-control" id="country-id" name="country_id"
                                        style="width: 100%;">
                                    @foreach($country as $my)
                                        <option value="{{$my->id}}"
                                                id="option-country-{{$my->id}}">{{$my->name->value ?? ""}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('city_id') ? ' is-invalid' : "" }}">
                                <label>{{$custom[strtolower('city')]??"lang not found"}}</label>
                                <select class="form-control" id="city_id" name="city_id"
                                        style="width: 100%;">
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('state_id') ? ' is-invalid' : "" }}">
                                <label>{{$custom[strtolower('state')]??"lang not found"}}</label>
                                <select class="form-control" id="state_id" name="state_id"
                                        style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light"
                                data-dismiss="modal">{{$custom[strtolower('Close')]??"lang not found"}}</button>
                        <button type="submit"
                                class="btn btn-outline-light">{{$custom[strtolower('Update')]??"lang not found"}}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endpermission
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')
    <script>
        //show item
        function showData(res) {
            $('#edit #country').val(res.country.name);
            $('#edit #city_id').val(res.city.name);
            var city = res.city_id;
            var country = res.country_id;
            var state = res.state_id;
            GetCity(country, city, 'edit');
            GetState(city, state, 'edit');
            $("#edit #country-id").val(country);
            $("#edit #city_id").val(city);
            $("#edit #state_id").val(state);
            for (let i in res.translation) {
                $(`#edit #name-${res.translation[i].language.code}`).val(res.translation[i].value);
            }
            $('#edit #order').val(res.order);
        }

        //edit data
        function updateItem(res) {
            document.getElementById('name-' + res.id).innerHTML = res.name;
            document.getElementById('country-' + res.id).innerHTML = res.country.name;
            document.getElementById('city-' + res.id).innerHTML = res.city.name;
            $(`#name-${res.id}`).attr('data-order', res.order);
        }

        //city list for country
        $('#create #country').change(function () {
            GetCity($(this).val(), 0, 'create');
        });
        //city list for country
        $('#edit #country-id').change(function () {
            GetCity($(this).val(), 0, 'edit');
        });

        function GetCity(country, city, ModelId) {
            url = '{{ route("city.list") }}';
            $.ajax({
                type: "GET",
                url: url,
                data: {'country_id': country},
                success: function (res) {
                    $(`#${ModelId} #city-id`).empty();
                    $(`#${ModelId} #city-id`).append('<option value="0">select</option>');
                    for (let x in res) {
                        for (let i in res[x]) {
                            if (res[x][i].id) {
                                if (res[x][i].id == city) {
                                    $(`#${ModelId} #city-id`).append(`<option value="${res[x][i].id}" selected>${res[x][i].name}</option>`);
                                } else {
                                    $(`#${ModelId} #city-id`).append(`<option value="${res[x][i].id}">${res[x][i].name}</option>`);
                                }
                            }
                        }
                    }
                    $(`#${ModelId} #city-id`).val(city);
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err]);
                    }
                }
            });
        }


          //state list for city
          $('#create #city-id').change(function () {
            GetState($(this).val(), 0, 'create');
        });
        //state list for city
        $('#edit #city_id').change(function () {
            GetState($(this).val(), 0, 'edit');
        });

        function GetState( city, state, ModelId) {
            url = '{{ route("state.list") }}';
            $.ajax({
                type: "GET",
                url: url,
                data: {'city_id': city},
                success: function (res) {
                    $(`#${ModelId} #state_id`).empty();
                    $(`#${ModelId} #state_id`).append('<option value="0">select</option>');
                    for (let x in res) {
                        for (let i in res[x]) {
                            if (res[x][i].id) {
                                if (res[x][i].id == state) {
                                    $(`#${ModelId} #state_id`).append(`<option value="${res[x][i].id}" selected>${res[x][i].name}</option>`);
                                } else {
                                    $(`#${ModelId} #state_id`).append(`<option value="${res[x][i].id}">${res[x][i].name}</option>`);
                                }
                            }
                        }
                    }
                    $(`#${ModelId} #state_id`).val(city);
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err]);
                    }
                }
            });
        }
    </script>
@endsection
