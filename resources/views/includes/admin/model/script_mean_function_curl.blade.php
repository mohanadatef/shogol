<script>
    $('#modal-create').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select").val('').end()
            .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
    });
    $('#modal-edit').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select").val('').end()
            .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
    });
    $('#modal-forgotpassword').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select").val('').end()
            .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
    });
    /*header ajax*/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*global variable*/
    var id;
    var url;
    var model = window.location.href.split('/');
    model = model[model.length - 2]+'/'+model[model.length - 1].split('?')[0]
    /*create item*/
    $(document).ready(function () {
        $("#create").on("submit", function (event) {
            event.preventDefault();
            url = "{{url('model')}}";
            url = url.replace('model', model);
            $.ajax({
                type: "post",
                url: url,
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (res) {
                    $('#body').append(res);
                    $('#modal-create').modal('toggle');
                    $('#create').trigger("reset");
                    toastr.success('{{$custom[strtolower('Create_Done')]??"lang not found"}}');
                    location.reload();
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err])
                    }
                }
            });
        });
    });

    /*get id for item*/
    function selectItem(data) {
        id = data;
    }

    /*show item in model edit*/
    function showItem(data) {
        id = data;
        url = "{{url('model/id')}}";
        url = url.replace('id', id);
        url = url.replace('model', model);
        $.ajax({
            type: "get",
            url: url,
            success: function (res) {
                showData(res);
                $(`#openModael${res.id}`).click();
            }, error: function (res) {
                for (let err in res.responseJSON.errors) {
                    toastr.error(res.responseJSON.errors[err]);
                }
            }
        });
    }

    /*edit data*/
    $(document).ready(function () {
        $("#edit").on("submit", function (event) {
            event.preventDefault();
            url = "{{url('model/id')}}";
            url = url.replace('id', id);
            url = url.replace('model', model);
            $.ajax({
                type: "post",
                url: url,
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (res) {
                    updateItem(res);
                    $('#modal-edit').modal('toggle');
                    toastr.info('{{$custom[strtolower('Edit_Done')]??"lang not found"}}');
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err]);
                    }
                }
            });
        });
    });

    /*change status for item*/
    function changeStatus(data) {
        url = "{{url('model/change_status/id')}}";
        url = url.replace('id', data);
        url = url.replace('model', model);
        $.ajax({
            type: "GET",
            url: url,
            success: function () {
                $(`#status-${data}:checkbox:checked`).length == 1 ? toastr.info('{{$custom[strtolower('Active_Done')]??"lang not found"}}') : toastr.warning('{{$custom[strtolower('An_Active_Done')]??"lang not found"}}');
            }, error: function (res) {
                for (let err in res.responseJSON.errors) {
                    toastr.error(res.responseJSON.errors[err]);
                }
            }
        });
    }

    /*change approve for item*/
    function acceptApprove(data,route = null) {
        if(route == null)
        {
        url = "{{url('model/accept_approve/id')}}";
        url = url.replace('id', data);
        url = url.replace('model', model);
        }else{
            url = route;
        }
        $.ajax({
            type: "GET",
            url: url,
            success: function () {
                toastr.info('{{$custom[strtolower('Approve_Done')]??"lang not found"}}')
                location.reload();
            }, error: function (res) {
                for (let err in res.responseJSON.errors) {
                    toastr.error(res.responseJSON.errors[err]);
                }
            }
        });
    }

    /*show item in model edit*/
    function rejectCommentApprove(data) {
        id = data;
        $(`#openModael${id}`).click();
    }
    //reject
    $(document).ready(function () {
        $("#reject").on("submit", function (event) {
            event.preventDefault();
            url = "{{url('model/reject_approve/id')}}";
            url = url.replace('id', id);
            url = url.replace('model', model);
            form = new FormData(this)
            form.append( 'id', id );
            $.ajax({
                type: "post",
                url: url,
                data: form,
                contentType: false,
                processData: false,
                success: function () {
                    $('#modal-reject-comment').modal('toggle');
                    $('#reject').trigger("reset");
                    toastr.info('{{$custom[strtolower('An_Approve_Done')]??"lang not found"}}');
                    location.reload();
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err]);
                    }
                }
            });
        });
    });

    /*show item in model edit*/
    function canselComment(data) {
        id = data;
        $(`#openModael${id}`).click();
    }
    //cansel
    $(document).ready(function () {
        $("#cansel").on("submit", function (event) {
            event.preventDefault();
            url = "{{url('model/cansel/id')}}";
            url = url.replace('id', id);
            url = url.replace('model', model);
            form = new FormData(this)
            form.append( 'id', id );
            $.ajax({
                type: "post",
                url: url,
                data: form,
                contentType: false,
                processData: false,
                success: function () {
                    $('#modal-cansel').modal('toggle');
                    $('#cansel').trigger("reset");
                    toastr.info('{{$custom[strtolower('cansel_Done')]??"lang not found"}}');
                    location.reload();
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err]);
                    }
                }
            });
        });
    });

    /*delete item*/
    function deleteItem() {
        url = "{{url('model/id')}}";
        url = url.replace('id', id);
        url = url.replace('model', model);
        $.ajax({
            type: "delete",
            url: url,
            success: function (res) {
                document.getElementById('data-' + id);
                $('#modal-delete').modal('toggle');
                if(res.message == true){
                    toastr.success('{{$custom[strtolower('Delete_Done')]??"lang not found"}}');
                    location.reload();
                }else{
                    toastr.warning('{{$custom[strtolower('can_t_delete')]??"lang not found"}}');
                }
            }, error: function (res) {
                for (let err in res.responseJSON.errors) {
                    toastr.error(res.responseJSON.errors[err]);
                }
            }
        });
    }

    /*change password data*/
    $(document).ready(function () {
        $("#forgotpassword").on("submit", function (event) {
            event.preventDefault();
            url = "{{url('forgotpassword/id')}}";
            url = url.replace('id', id);
            $.ajax({
                type: "post",
                url: url,
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (res) {
                    $('#modal-forgotpassword').modal('toggle');
                    toastr.info('{{$custom[strtolower('Edit_Password')]??"lang not found"}}');
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err]);
                    }
                }
            });
        });
    });
    /*verified for item*/
    function verified(data) {
        url = "{{url('model/verified/id')}}";
        url = url.replace('id', data);
        url = url.replace('model', model);
        $.ajax({
            type: "GET",
            url: url,
            success: function () {
                 toastr.info('{{$custom[strtolower('Done')]??"lang not found"}}');
                 location.reload();
            }, error: function (res) {
                for (let err in res.responseJSON.errors) {
                    toastr.error(res.responseJSON.errors[err]);
                }
            }
        });
    }
    /*solved for Reports*/
    function solved(data) {
            event.preventDefault();
            url = "{{url('model/solved/id')}}";
            url = url.replace('id',data)
            url = url.replace('model', model);
            $.ajax({
                type: "POST",
                url: url,
                data: null,
                contentType: false,
                processData: false,
                success: function (res) {
                    toastr.success('{{$custom[strtolower('solved')]??"lang not found"}}');
                    location.reload();
                }, error: function (res) {
                        toastr.error(res.responseJSON.errors)
                    }

            });
        }

</script>
@yield('curl')
