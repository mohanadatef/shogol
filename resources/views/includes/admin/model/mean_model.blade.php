<!--delete-->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content bg-warning">
            <div class="modal-header">
                <h4 class="modal-title">{{$custom[strtolower('Delete')]??"lang not found"}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{$custom[strtolower('Delete_Message')]??"lang not found"}}</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">{{$custom[strtolower('Close')]??"lang not found"}}</button>
                <button type="submit" id="delete" onclick="deleteItem()" class="btn btn-outline-dark">
                    {{$custom[strtolower('Delete')]??"lang not found"}}
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

</div>
