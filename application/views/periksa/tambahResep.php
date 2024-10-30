<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card shadow-lg">
          <div class="card-header bg-fuchsia">
            <h3 class="card-title">Tambah Resep</h3>
            <div class="card-tools">
              <a onclick="history.go(-1);" class="btn btn-tool">
                <i class="fas fa-times text-white"></i>
              </a>
            </div>
          </div>
          <div class="card-body">
            <?= form_open('', '', ['idUser' => userdata('idUser')]); ?>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="idPeriksa">ID Periksa</label>
                  <input readonly value="<?= set_value('idPeriksa', $periksa->idPeriksa); ?>" type="text" id="idPeriksa" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nmPasien">Nama Pasien</label>
                  <input readonly value="<?= set_value('nmPasien', $periksa->nmPasien); ?>" type="text" id="nmPasien" class="form-control">
                </div>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="kdObat">Obat *</label>
                  <select multiple name="kdObat[]" id="kdObat" class="form-control select2">
                    <?php foreach ($data['obat'] as $obat) { ?>
                      <option <?= set_select('kdObat[]', $obat->kdObat, in_array($obat->kdObat, $pr_obat)); ?> value="<?= $obat->kdObat ?>"><?= $obat->nmObat; ?></option>
                    <?php } ?>
                  </select>
                  <?= form_error('kdObat'); ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group" id="jumlahObatContainer">
                  <!-- Input jumlah obat akan ditambahkan di sini -->
                  <?php 
                  $old_input = $this->session->flashdata('old_input');
                  $jumlahObatValues = $old_input['jumlahObat'] ?? set_value('jumlahObat');
                  if ($jumlahObatValues) {
                    foreach ($jumlahObatValues as $jumlah) { ?>
                      <input type="number" name="jumlahObat[]" class="form-control mt-2" min="1" value="<?= $jumlah ?>">
                    <?php }
                  }
                  ?>
                  <?= form_error('jumlahObat'); ?>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group" id="aturanObatContainer">
                  <?php 
                  $aturanValues = $old_input['aturan'] ?? set_value('aturan');
                  if ($aturanValues) {
                    foreach ($aturanValues as $aturan) { ?>
                      <input type="text" name="aturan[]" class="form-control mt-2" value="<?= $aturan ?>">
                    <?php }
                  }
                  ?>
                  <?= form_error('aturan'); ?>
                </div>
              </div>
            </div>
            <div class="text-right">
              <button type="submit" class="btn bg-fuchsia">Simpan Resep</button>
              <button type="reset" class="btn btn-default">Reset</button>
            </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $(function() {
    $('.select2').select2();
  });

  $(document).ready(function() {
    $('#kdObat').change(function() {
      $('#jumlahObatContainer').empty();
      $('#aturanObatContainer').empty();
      $('#kdObat option:selected').each(function() {
        var kdObat = $(this).val();
        var nmObat = $(this).text();
        var inputField = '<input type="number" name="jumlahObat[]" class="form-control mt-2" min="1" placeholder="Jumlah untuk ' + nmObat + '" data-kdobat="' + kdObat + '">';
        var aturanField = '<input type="text" name="aturan[]" class="form-control mt-2" placeholder="Aturan obat untuk ' + nmObat + '">';
        $('#jumlahObatContainer').append(inputField);
        $('#aturanObatContainer').append(aturanField);
      });
    });
    
    <?php if (!empty($old_input['kdObat'])): ?>
        <?php foreach ($old_input['kdObat'] as $index => $kdObat): ?>
            $('#kdObat').find('option[value="<?= $kdObat ?>"]').prop('selected', true);
        <?php endforeach; ?>
        $('#kdObat').trigger('change');
    <?php endif; ?>
  });
</script>
