    <section class="content">
      <div class="container-fluid">
        <div class="card shadow-lg">
          <div class="card-header">
            <div class="row">
              <div class="col d-flex">
                <h3 class="card-title align-self-center">Tabel <?= $title; ?></h3>
              </div>
              <div class="col text-right">
                <a href="<?= site_url('user/add'); ?>" class="btn btn-sm bg-info">
                  <i class="fas fa-plus"></i> Tambah User
                </a>
                <a href="<?= site_url('user/cetakBidan'); ?>" target="_blank" class="btn btn-sm btn-default">
              <i class="fas fa-print"></i> Laporan
            </a>
              </div>
            </div>
          </div>
          <div class="card-body table-responsive text-nowrap">
            <table class="table table-striped table-bordered datatable">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th>Nama Lengkap</th>
                  <th>Username</th>
                  <th>Akses</th>
                  <th>Akun</th>
                  <th class="text-center">Status Login</th>
                  <th>Foto</th>
                  <th width="10%">Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php $no = 1;
              if (count((array) $dataUser) > 0) { ?>
                <?php foreach ($dataUser as $row) { ?>
                <tr>
                  <td><?=$no++?>.</td>
                  <td><?=$row->fullName?></td>
                  <td><?=$row->username?></td>
                  <td>
                    <div class="badge badge-<?=$row->role == 1 ? 'primary' : 'warning' ?>">
                      <?= $row->role == 1 ? 'Super Admin' : 'Bidan'?>
                    </div>
                  </td>
                  <td>
                    <div class="badge badge-<?= $row->active == 1 ? 'primary' : 'danger'; ?>">
                      <?= $row->active == 1 ? "Aktif" : "Nonaktif"; ?>
                    </div>
                  </td>

                  <td class="text-center">
                    <?php
                    if ($row->is_online) {
                         echo "<span class='online-status'><span class='dot'></span> <span class='badge badge-success'>Online</span></span>";
                    } else {
                        // Hitung perbedaan waktu sejak user offline
                        $last_activity = strtotime($row->last_activity);
                        $diff = time() - $last_activity;

                        $satuan_waktu = [
                            31536000 => 'tahun',
                            2592000  => 'bulan',
                            86400    => 'hari',
                            3600     => 'jam',
                            60       => 'menit',
                            1       => 'detik',
                        ];

                        foreach ($satuan_waktu as $detik => $satuan) {
                            if ($diff < $detik) continue;
                            echo "<span class='badge badge-secondary'>Offline " . floor($diff / $detik) . " $satuan yang lalu</span>";
                            break;
                        }
                    }
                    ?>
                  </td>

                  <td class="text-center">
                    <?php if($row->image != null) { ?>
                      <img class="rounded-lg" src="<?=site_url('uploads/foto_profil/'.$row->image)?>" style="width: 50px;">
                    <?php } ?>
                  </td>
                  <td>
                    <div class="btn-group">
                      <a href="<?= site_url('user/toggle/' . $row->idUser); ?>" data-toggle="tooltip" data-placement="top" title="<?= !$row->active ? "Aktif" : "Nonaktif"; ?>kan User" class="btn btn-sm btn-outline-<?= $row->active == 1 ? 'danger' : 'success'; ?>">
                        <i class="fas fa-power-off"></i>
                      </a>
                    </div>
                    <div class="btn-group">
                      <a href="<?= site_url('user/edit/' . $row->idUser); ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="<?= site_url('user/delete/' . $row->idUser); ?>" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Yakin ingin hapus?');">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td colspan="6" class="text-center">Data Kosong</td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>