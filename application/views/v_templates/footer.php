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
<script src="<?= base_url()?>assets/dist/js/custom.js"></script>
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
      fontColor: '#495057',
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
          borderColor: 'fuchsia',
          pointBorderColor: 'fuchsia',
          pointBackgroundColor: 'fuchsia',
          fill: false,
          lineTension: 0.3,
          pointRadius: 3,
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "#5a5c69",
          pointHoverBorderColor: "#5a5c69",
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
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
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
          backgroundColor: "#ffe9f4",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
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
  })
</script>

<?php } ?>

</body>
</html>