<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">{{$custom[strtolower('filter')]??"lang not found"}}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool collapsible">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <form action="{{route('task.index')}}" method="get">
        <div class="card-body" id="filter" style="display: none">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('category')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple" id="category"
                                name="category[]"
                                data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($category as $my)
                                <option value="{{$my->id}}"
                                        id="option-category-{{$my->id}}"
                                        @if(Request::get('category') && in_array($my->id,Request::get('category'))) selected @endif>{{$my->name->value ?? ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('currency')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple" id="currency_id"
                                name="currency_id[]"
                                data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($currency as $my)
                                <option value="{{$my->id}}"
                                        id="option-currency-{{$my->id}}"
                                        @if(Request::get('currency_id') && in_array($my->id,Request::get('currency_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('status')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple"  id="status_id" name="status_id[]" data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($status as $my)
                                <option value="{{$my->id}}"
                                        id="option-status-{{$my->id}}"
                                        @if(Request::get('status_id') && in_array($my->id,Request::get('status_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('user_create')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple"  id="user_id" name="user_id[]" data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($userTask as $user)
                                <option value="{{$user->id}}"
                                        id="option-user-{{$user->id}}"
                                        @if(Request::get('user_id') && in_array($user->id,Request::get('user_id'))) selected @endif>{{$user->fullname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('freelancer')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple"  id="freelancer_id" name="freelancer_id[]" data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($freelancer as $free)
                                <option value="{{$free->id}}"
                                        id="option-free-{{$free->id}}"
                                        @if(Request::get('free_id') && in_array($free->id,Request::get('free_id'))) selected @endif>{{$free->fullname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
               {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('country')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple" id="country"
                                name="country_id[]"
                                data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($country as $my)
                                <option value="{{$my->id}}"
                                        id="option-country-{{$my->id}}"
                                        @if(Request::get('country_id') && in_array($my->id,Request::get('country_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('city')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple" id="city"
                                name="city_id[]"
                                data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($city as $my)
                                <option value="{{$my->id}}"
                                        id="option-city-{{$my->id}}"
                                        @if(Request::get('city_id') && in_array($my->id,Request::get('city_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('state')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple" id="state"
                                name="state_id[]"
                                data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($state as $my)
                                <option value="{{$my->id}}"
                                        id="option-state-{{$my->id}}"
                                        @if(Request::get('state_id') && in_array($my->id,Request::get('state_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>--}}
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('type')]??"lang not found"}}</label>
                        <select class="form-control"  id="type" name="type">
                            <option value="" id="option-type" @if(empty(Request::get('type')) &&  Request::get('type') === null) @else selected @endif>{{$custom[strtolower('select')]??"lang not found"}}</option>
                            <option value="{{taskType()['gt']}}" id="option-type-{{taskType()['gt']}}" @if(Request::get('type') &&  Request::get('type') == taskType()['gt']) selected @endif>{{$custom[strtolower(taskType()['gt'])]??"lang not found"}}</option>
                            <option value="{{taskType()['st']}}" id="option-type-{{taskType()['st']}}" @if(Request::get('type') &&  Request::get('type') == taskType()['st']) selected @endif>{{$custom[strtolower(taskType()['st'])]??"lang not found"}}</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('type_work')]??"lang not found"}}</label>
                        <select class="form-control"  id="type_work" name="type_work">
                            <option value="" id="option-type_work" @if(empty(Request::get('type_work')) &&  Request::get('type_work') === null) @else selected @endif>{{$custom[strtolower('select')]??"lang not found"}}</option>
                            <option value="{{workType()['on']}}" id="option-type_work-{{workType()['on']}}" @if(Request::get('type_work') &&  Request::get('type_work') == workType()['on']) selected @endif>{{$custom[strtolower(workType()['on'])]??"lang not found"}}</option>
                            <option value="{{workType()['of']}}" id="option-type_work-{{workType()['of']}}" @if(Request::get('type_work') &&  Request::get('type_work') == workType()['of']) selected @endif>{{$custom[strtolower(workType()['of'])]??"lang not found"}}</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('name')]??"lang not found"}}</label>
                        <input type="text" name="name" class="form-control" id="name"
                               value="{{Request::old('name')}}" placeholder="{{$custom[strtolower('name')]??"lang not found"}}">
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <button type="submit"
                    class="btn btn-primary">{{$custom[strtolower('filter')]??"lang not found"}}</button>
            <a href="{{  route('task.index') }}"
               class="btn btn-success"> {{$custom[strtolower('remove_filter')]??"lang not found"}}</a>
        </div>
    </form>
</div>
