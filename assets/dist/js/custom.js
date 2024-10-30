$(function() {
    $('.gijgo').datepicker({
      uiLibrary: 'bootstrap4',
      format: 'yyyy-mm-dd'
    });
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
      $('#tanggal').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
    }
    $('#tanggal').daterangepicker({
      startDate: start,
      endDate: end,
      ranges: {
        'Hari ini': [moment(), moment()],
        'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
        '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
        'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
        'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'Tahun ini': [moment().startOf('year'), moment().endOf('year')],
        'Tahun lalu': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
      }
    }, cb);
    cb(start, end);

    $('[data-toggle="tooltip"]').tooltip();
    var table = $('.datatable').DataTable({
      buttons: ['excel','print'],
      dom: "<'row mb-2'<'col-md-3 col-lg-2'l><'col-md-3 col-lg-2'f><'col-md-6 col-lg-8 text-right'B>>" +
    "<'row'<'col-md-12'tr>>" +
    "<'row'<'col-md-5'i><'col-md-7'p>>",
      lengthMenu: [
        [5, 10, 25, 50, 100, -1],
        [5, 10, 25, 50, 100, "All"]
      ],
      columnDefs: [{
        targets: -1,
        orderable: false,
        searchable: false
      }],
      initComplete: function () {
        $('.datatable thead th').addClass('bg-fuchsia');
        $('.dt-buttons .buttons-excel, .dt-buttons .buttons-print').addClass('bg-fuchsia');
      }
    });
    table.buttons().container().appendTo('#dataTable_wrapper .col-md-5:eq(0)');


    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    });
});