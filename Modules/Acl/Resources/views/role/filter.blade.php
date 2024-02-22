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
    <form action="{{route('role.index')}}" method="get">
        <div class="card-body" id="filter" style="display: none">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('is_web')]??"lang not found"}}</label>
                        <select class="form-control"  id="is_web" name="is_web">
                                <option value="" id="option-is-web" @if(empty(Request::get('is_web')) &&  Request::get('is_web') === null) @else selected @endif>{{$custom[strtolower('select')]??"lang not found"}}</option>
                                <option value="1" id="option-is-web-1" @if(Request::get('is_web') &&  Request::get('is_web') == 1) selected @endif>{{$custom[strtolower('active')]??"lang not found"}}</option>
                                <option value="0" id="option-is-web-0" @if(empty(Request::get('is_web')) &&  Request::get('is_web') === "0") selected @endif>{{$custom[strtolower('unactive')]??"lang not found"}}</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('is_approve')]??"lang not found"}}</label>
                        <select class="form-control"  id="is_approve" name="is_approve">
                            <option value="" id="option-is-approve" @if(empty(Request::get('is_approve')) &&  Request::get('is_approve') === null) @else selected @endif>{{$custom[strtolower('select')]??"lang not found"}}</option>
                            <option value="1" id="option-is-approve-1" @if(Request::get('is_approve') &&  Request::get('is_approve') == 1) selected @endif>{{$custom[strtolower('active')]??"lang not found"}}</option>
                            <option value="0" id="option-is-approve-0" @if(empty(Request::get('is_approve')) &&  Request::get('is_approve') === "0") selected @endif>{{$custom[strtolower('unactive')]??"lang not found"}}</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('is_verified')]??"lang not found"}}</label>
                        <select class="form-control"  id="is_verified" name="is_verified">
                            <option value="" id="option-is-verified" @if(empty(Request::get('is_verified')) &&  Request::get('is_verified') === null) @else selected @endif>{{$custom[strtolower('select')]??"lang not found"}}</option>
                            <option value="1" id="option-is-verified-1" @if(Request::get('is_verified') &&  Request::get('is_verified') == 1) selected @endif>{{$custom[strtolower('active')]??"lang not found"}}</option>
                            <option value="0" id="option-is-verified-0" @if(empty(Request::get('is_verified')) &&  Request::get('is_verified') === "0") selected @endif>{{$custom[strtolower('unactive')]??"lang not found"}}</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('is_report')]??"lang not found"}}</label>
                        <select class="form-control"  id="is_report" name="is_report">
                            <option value="" id="option-is-report" @if(empty(Request::get('is_report')) &&  Request::get('is_report') === null) @else selected @endif>{{$custom[strtolower('select')]??"lang not found"}}</option>
                            <option value="1" id="option-is-report-1" @if(Request::get('is_report') &&  Request::get('is_report') == 1) selected @endif>{{$custom[strtolower('active')]??"lang not found"}}</option>
                            <option value="0" id="option-is-report-0" @if(empty(Request::get('is_report')) &&  Request::get('is_report') === "0") selected @endif>{{$custom[strtolower('unactive')]??"lang not found"}}</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <button type="submit" class="btn btn-primary">{{$custom[strtolower('filter')]??"lang not found"}}</button>
            <a href="{{  route('role.index') }}" class="btn btn-success"> {{$custom[strtolower('remove_filter')]??"lang not found"}}</a>
        </div>
    </form>
</div>
