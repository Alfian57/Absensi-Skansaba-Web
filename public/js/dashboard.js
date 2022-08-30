$(document).ready(function() {
    $('.datatable-without-search').DataTable({
        "searching": false,
        "ordering": false
    })

    $('.btn-delete').click(function(event) {
        let form =  $(this).closest("form")
        event.preventDefault();
        Swal.fire({
            title: 'Data Akan Terhapus',
            text: "Lanjutkan ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            confirmButtonClass: 'btn-danger',
            denyButtonText: `Batal`,
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit()
            }
        });
    });

    $('.btn-logout').click(function(event) {
        let form =  $(this).closest("form")
        event.preventDefault();
        Swal.fire({
            title: 'Anda Akan Melakukan Logout',
            text: "Lanjutkan ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Logout',
            confirmButtonClass: 'btn-danger',
            denyButtonText: `Batal`,
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit()
            }
        });
    });

    $('.btn-submit-logout').click(function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Anda Akan Melakukan Logout',
            text: "Lanjutkan ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Logout',
            confirmButtonClass: 'btn-danger',
            denyButtonText: `Batal`,
        }).then((result) => {
            if (result.isConfirmed) {
                $('#logout-form').submit()
            }
        });
    });

    $('#basic-datatables').DataTable({});

    $('#multi-filter-select').DataTable({
        "pageLength": 5,
        initComplete: function() {
            this.api().columns().every(function() {
                var column = this;
                var select = $(
                        '<select class="form-control"><option value=""></option></select>'
                    )
                    .appendTo($(column.footer()).empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                column.data().unique().sort().each(function(d, j) {
                    select.append('<option value="' + d + '">' + d +
                        '</option>')
                });
            });
        }
    });

    // Add Row
    $('#add-row').DataTable({
        "pageLength": 5,
    });

    var action =
        '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg> </button> </div> </td>';

    $('#addRowButton').click(function() {
        $('#add-row').dataTable().fnAddData([
            $("#addName").val(),
            $("#addPosition").val(),
            $("#addOffice").val(),
            action
        ]);
        $('#addRowModal').modal('hide');

    });
});