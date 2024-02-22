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
    <form action="{{route('user.index')}}" method="get">
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
                        <label>{{$custom[strtolower('job_name')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple" id="job_name"
                                name="job_name_id[]"
                                data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($job_name as $my)
                                <option value="{{$my->id}}"
                                        id="option-job_name-{{$my->id}}"
                                        @if(Request::get('job_name_id') && in_array($my->id,Request::get('job_name_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('nationality')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple" id="nationality"
                                name="nationality_id[]"
                                data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($nationality as $my)
                                <option value="{{$my->id}}"
                                        id="option-nationality-{{$my->id}}"
                                        @if(Request::get('nationality_id') && in_array($my->id,Request::get('nationality_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('role')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple" id="role_id"
                                name="role_id[]"
                                data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($role as $my)
                                <option value="{{$my->id}}"
                                        id="option-role-{{$my->id}}"
                                        @if(Request::get('role_id') && in_array($my->id,Request::get('role_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('gender')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple" id="gender"
                                name="gender_id[]"
                                data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($gender as $my)
                                <option value="{{$my->id}}"
                                        id="option-gender-{{$my->id}}"
                                        @if(Request::get('gender_id') && in_array($my->id,Request::get('gender_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('status')]??"lang not found"}}</label>
                        <select class="form-control"  id="status" name="status">
                                <option value="" id="option-status" @if(empty(Request::get('status')) &&  Request::get('status') === null) @else selected @endif>{{$custom[strtolower('select')]??"lang not found"}}</option>
                                <option value="1" id="option-status-1" @if(Request::get('status') &&  Request::get('status') == 1) selected @endif>{{$custom[strtolower('active')]??"lang not found"}}</option>
                                <option value="0" id="option-status-0" @if(empty(Request::get('status')) &&  Request::get('status') === "0") selected @endif>{{$custom[strtolower('unactive')]??"lang not found"}}</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('approve')]??"lang not found"}}</label>
                        <select class="form-control"  id="approve" name="approve">
                            <option value="" id="option-approve" @if(empty(Request::get('approve')) &&  Request::get('approve') === null) @else selected @endif>{{$custom[strtolower('select')]??"lang not found"}}</option>
                            <option value="1" id="option-approve-1" @if(Request::get('approve') &&  Request::get('approve') == 1) selected @endif>{{$custom[strtolower('approve')]??"lang not found"}}</option>
                            <option value="0" id="option-approve-0" @if(empty(Request::get('approve')) &&  Request::get('approve') === "0") selected @endif>{{$custom[strtolower('wait_approve')]??"lang not found"}}</option>
                            <option value="2" id="option-approve-2" @if(Request::get('approve') &&  Request::get('approve') == 2) selected @endif>{{$custom[strtolower('unapprove')]??"lang not found"}}</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <button type="submit" class="btn btn-primary">{{$custom[strtolower('filter')]??"lang not found"}}</button>
            <a href="{{  route('user.index') }}" class="btn btn-success"> {{$custom[strtolower('remove_filter')]??"lang not found"}}</a>
        </div>
    </form>
</div>
