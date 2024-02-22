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
    <form action="{{route('currency.index')}}" method="get">
        <div class="card-body" id="filter" style="display: none">
            <div class="row">
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
            </div>
            <button type="submit" class="btn btn-primary">{{$custom[strtolower('filter')]??"lang not found"}}</button>
            <a href="{{  route('currency.index') }}" class="btn btn-success"> {{$custom[strtolower('remove_filter')]??"lang not found"}}</a>
        </div>
    </form>
</div>
