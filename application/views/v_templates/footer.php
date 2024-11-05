  </div>

  <div id="logoutModal" class="fade modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Logout?</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">Yakin ingin logout?</div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
        </div>
      </div>
    </div>
  </div>
  
  <footer class="main-footer shadow-lg">
    <strong>Copyright &copy; 
      <script>
        document.write(new Date().getFullYear());
      </script>
      <a href="#">Uyufinta</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <span class="text-info text-bold">
      Version 1.0.0
      </span>
    </div>
  </footer>

  <aside class="control-sidebar"></aside>

</div>


<script src="<?= base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url()?>assets/plugins/moment/moment.min.js"></script>
<script src="<?= base_url()?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url()?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?= base_url()?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url()?>assets/dist/js/adminlte.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?= base_url()?>assets/plugins/moment/moment.min.js"></script>
<script src="<?= base_url()?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url()?>assets/plugins/select2/js/select2.full.min.js"></script>

<script src="<?= base_url()?>assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?= base_url()?>assets/plugins/gijgo/js/gijgo.min.js"></script>
<script src="<?= base_url()?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url()?>assets/dist/js/jam.js"></script>
<script src="<?= base_url()?>assets/dist/js/deleteConfirm.js"></script>

<?=$this->session->flashdata('pesan')?>

<?php
$u1 = $this->uri->segment(1);
$u2 = $u1 . '/' . $this->uri->segment(2);
if ($u1 == "dashboard" || $u2 == "admin/index") { ?>

<script>
  function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
      s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
  }

  $(function() {
    'use strict'
    var ticksStyle = {
      fontColor: '#40E0D0',
      fontStyle: 'bold'
    }
    var mode = 'index'
    var intersect = true
    var ctx = document.getElementById("periksa-chart");
    var visitorsChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
        datasets: [{
          data: JSON.parse("<?= json_encode($pr) ?>"),
          backgroundColor: 'transparent',
          borderColor: '#40E0D0',
          pointBorderColor: '#40E0D0',
          pointBackgroundColor: '#40E0D0',
          fill: false,
          lineTension: 0.3,
          pointRadius: 3,
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "##40E0D0",
          pointHoverBorderColor: "##40E0D0",
          pointHitRadius: 10,
          pointBorderWidth: 2,
        }]
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: 5
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 12
            }
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10,
              callback: function(value, index, values) {
                return number_format(value);
              }
            },
            gridLines: {
              color: "rgb(48, 206, 209)",
              zeroLineColor: "rgb(224, 255, 255)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: "  #B0E0E6",
          bodyFontColor: "  #B0E0E66",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#00CED1',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: 'index',
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
            }
          }
        }
      }
    })
  });

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
        $('.datatable thead th').addClass('bg-info');
        $('.dt-buttons .buttons-excel, .dt-buttons .buttons-print').addClass('bg-info');
      }
    });
    table.buttons().container().appendTo('#dataTable_wrapper .col-md-5:eq(0)');


    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    });
  });
</script>

<?php } ?>

</body>
</html>