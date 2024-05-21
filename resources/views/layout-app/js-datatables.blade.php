<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "language": {
                "paginate": {
                    "next": "التالي",
                    "previous": "السابق"
                },
                "search": "بحث ",
                "lengthMenu": "إظهار _MENU_ سجل",
                "info": "إظهار _START_ إلى _END_ من أصل _TOTAL_ سجل",
                "zeroRecords": "لم يتم العثور على سجلات مطابقة للبحث",
                "infoFiltered": "",
                "infoEmpty": "",
            },
            "info": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "autoWidth": false
        });
        $('#example2').DataTable({
          "language": {
                "paginate": {
                    "next": "التالي",
                    "previous": "السابق"
                },
                "search": "بحث ",
                "lengthMenu": "إظهار _MENU_ سجل",
                "info": "إظهار _START_ إلى _END_ من أصل _TOTAL_ سجل",
                "zeroRecords": "لم يتم العثور على سجلات مطابقة للبحث",
                "infoFiltered": "",
                "infoEmpty": "",
            },
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

    });
</script>
