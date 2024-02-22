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
    <form action="{{route('ad.index')}}" method="get">
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
                        <label>{{$custom[strtolower('user')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple"  id="user_id" name="user_id[]" data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($userAd as $user)
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
            <a href="{{  route('ad.index') }}"
               class="btn btn-success"> {{$custom[strtolower('remove_filter')]??"lang not found"}}</a>
        </div>
    </form>
</div>
