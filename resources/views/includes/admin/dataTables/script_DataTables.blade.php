@include('includes.admin.model.mean_model')
<!-- DataTables  & Plugins -->
<script src="{{asset('public/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/AdminLTE/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('public/AdminLTE/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('public/AdminLTE/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('public/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script type="text/javascript">
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false, "buttons": ["copy", "colvis"],paging: false,searching: true,info:false,order:[[0, 'desc']]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
<script>
    function setPerPage(){
        if (window.location.href.indexOf('perPage') !== -1) {
            window.location.href = window.location.href.replace(/&?perPage=(\d+)/g, `&perPage=${$('.per-page-select').val()}`);
        } else {
            if (window.location.href.indexOf('?') !== -1) {
                window.location.href = window.location.href + `&perPage=${$('.per-page-select').val()}`;
            } else {
                window.location.href = window.location.href + `?perPage=${$('.per-page-select').val()}`;
            }
        }
    }
</script>
@include('includes.admin.model.script_mean_function_curl')
@yield('DataTables')

