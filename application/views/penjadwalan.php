<style>
  .block {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 0px solid #CCCCCC;
    margin: 1em 0;
  }
</style>
<div class="content">
  <div class="header">
    <h1 class="page-title"><?php echo $page_title; ?></h1>
  </div>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>">Beranda</a> <span class="divider">/</span></li>
    <li class="active"><?php echo $page_title; ?></li>
  </ul>

  <div class="container-fluid">
    <?php if (isset($msg)) { ?>
      <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <?php echo $msg; ?>
      </div>
    <?php } ?>

    <div class="row-fluid">

      <form class="form form-horizontal mt-4 col-lg-12" method="POST" action="">
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label>Semester</label>
              <select id="semester_tipe" name="semester_tipe" class="form-select shadow-none col-12">
                <option selected hidden>Pilih Semester...</option>
                <!-- <option value="1" <?php echo isset($semester_tipe) ? ($semester_tipe === '1' ? 'selected' : '') : ''; ?> /> GANJIL
                <option value="0" <?php echo isset($semester_tipe) ? ($semester_tipe === '0' ? 'selected' : '') : ''; ?> /> GENAP -->
                <option value="1" <?php echo $this->session->userdata('pengampu_semester_tipe') === '1' ? 'selected' : ''; ?> /> GANJIL
                <option value="0" <?php echo $this->session->userdata('pengampu_semester_tipe') === '0' ? 'selected' : ''; ?> /> GENAP

              </select>

            </div>
            <div class="form-group">
              <label>Tahun Akademik</label>
              <select id="tahun_akademik" name="tahun_akademik" class="form-select shadow-none col-12">
                <option selected hidden>Pilih Tahun Akademik...</option>
                <!-- <option value="2022-2023" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2022-2023' ? 'selected' : '') : ''; ?> /> 2022-2023 -->
                <option value="2022-2023" <?php echo $this->session->userdata('pengampu_tahun_akademik') === '2022-2023' ? 'selected' : ''; ?> /> 2022-2023

              </select>
            </div>
            <div class="form-group">
              <label>Jumlah Populasi</label>
              <input type="text" name="jumlah_populasi" value="<?php echo isset($jumlah_populasi) ? $jumlah_populasi : '50'; ?>" class="form-control">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label>Probabilitas CrossOver</label>
              <select name="probabilitas_crossover" class="form-select shadow-none col-12">
                <option selected hidden>Masukan Probabilitas CrossOver</option>
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '1.0'; ?>"> 1.0
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.90'; ?>"> 0.90
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.80'; ?>"> 0.80
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.70'; ?>"> 0.70
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.60'; ?>"> 0.60
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.50'; ?>"> 0.50
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.40'; ?>"> 0.40
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.30'; ?>"> 0.30
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.20'; ?>"> 0.20
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.10'; ?>"> 0.10
              </select>
              <!-- <input type="text" class="form-control" name="probabilitas_crossover" value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.70'; ?>"> -->
            </div>
            <div class="form-group">
              <label>Probabilitas Mutasi</label>
              <select name="probabilitas_mutasi" class="form-select shadow-none col-12">
                <option selected hidden>Masukan Probabilitas Mutasi</option>
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '1.0'; ?>"> 1.0
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.90'; ?>"> 0.90
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.80'; ?>"> 0.80
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.70'; ?>"> 0.70
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.60'; ?>"> 0.60
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.50'; ?>"> 0.50
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.40'; ?>"> 0.40
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.30'; ?>"> 0.30
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.20'; ?>"> 0.20
                <option value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover : '0.10'; ?>"> 0.10
              </select>
              <!-- <input type="text" class="form-control" name="probabilitas_mutasi" value="<?php echo isset($probabilitas_mutasi) ? $probabilitas_mutasi : '0.40'; ?>"> -->
            </div>
            <div class="form-group">
              <label>Jumlah Generasi</label>
              <input type="text" class="form-control" name="jumlah_generasi" value="<?php echo isset($jumlah_generasi) ? $jumlah_generasi : '1000'; ?>">
            </div>
          </div>
          <div class="form">
            <button type="submit" class="btn btn-info text-white mb-3" onclick="ShowProgressAnimation();">Proses</button>

          </div>
        </div>
      </form>

      <?php if ($rs_jadwal->num_rows() !== 0) : ?>
        <a href="<?php echo base_url(); ?>web/excel_report"> <button class="btn btn-primary pull-right"><i class="mdi mdi-file-excel"></i> Export to Excel</button></a>
        <br><br>
      <?php endif; ?>

      <div id="loading-div-background">
        <div id="loading-div" class="ui-corner-all">
          <img style="height:50px;width:50px;margin:30px;" src="<?php echo base_url() ?>assets/img/please_wait.gif" alt="Loading.." /><br>PROCESSING<br>PLEASE WAIT
        </div>
      </div>

      <?php if ($rs_jadwal->num_rows() === 0) : ?>
        <!--
		<div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">�</button>             
			Tidak ada data.
        </div>
		-->
      <?php else : ?>
        <div id="content_ajax">

          <div class="pagination pull-right" id="ajax_paging">
            <ul>
              <?php echo $this->pagination->create_links(); ?>
            </ul>
          </div>
          <thead>
            <tr>
              <!-- <th>Ambil data jadwal</th> -->
            </tr>
            <tr>
              <td>


              </td>
            </tr>
          </thead>
          <div class="widget-content">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Hari</th>
                  <th>Sesi</th>
                  <th>Jam</th>
                  <th>Matakuliah</th>
                  <th>SKS</th>
                  <th>Semester</th>
                  <th>Kelas</th>
                  <th>Dosen</th>
                  <th>Asisten Dosen</th>
                  <th>Ruang</th>

                </tr>
              </thead>
              <tbody>
                <?php
                // echo '<hr><h4>CrossOver</h4>' . json_encode($crossover[0]); 
                ?>
                <?php
                // echo '<hr><h4>fitness</h4>'  . var_dump($fitness) . '<br><hr>';
                // for ($i = 0; $i < 5; $i++) {
                //   for ($j = 0; $j < $pengampu; $j++) {
                //     $sks = $skss[$j];
                //     echo json_encode($individu[$i][$j][0]) . '<br>';
                //     echo json_encode($individu[$i][$j][2]) . '<br>';
                //     echo json_encode($individu[$i][$j][3]) . '<br>';
                //     echo json_encode($individu[$i][$j][4]) . '<br>';
                //   }
                //   // echo json_encode($individu[$i][$j]);
                // }
                ?>

                <?php
                // echo '<hr><h4>Mutasi</h4>'  . var_dump($mutasi) . '<br>';
                // echo '<hr><h4>crosover</h4>'  . var_dump($crossover) . '<br>';
                // echo '<hr><h4>individu baru</h4>'  . json_encode($individu_baru) . '<br>';
                // echo '<hr><h4>rank</h4>'  . var_dump($rank) . '<br>';
                // echo '<hr><h4>induk</h4>'  . var_dump($induk) . '<br>';
                // echo '<hr><h4>fitness</h4>'  . var_dump($fitness) . '<br>';
                ?>

                <?php
                // var_dump($produk);
                echo '<hr>';
                // echo $pengampu;
                // var_dump($rs_jadwal);
                // var_dump($jadwal_kuliah);
                $i =  1;
                foreach ($rs_jadwal->result() as $jadwal) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $jadwal->hari; ?></td>
                    <td><?php echo $jadwal->sesi; ?></td>
                    <td><?php echo $jadwal->jam_kuliah; ?></td>
                    <td><?php echo $jadwal->nama_mk; ?></td>
                    <td><?php echo $jadwal->sks; ?></td>
                    <td><?php echo $jadwal->semester; ?></td>
                    <td><?php echo $jadwal->kelas; ?></td>
                    <td><?php echo $jadwal->dosen; ?></td>
                    <td><?php echo $jadwal->asdos; ?></td>
                    <td><?php echo $jadwal->ruang; ?></td>
                  </tr>
                <?php $i++;
                } ?>

              </tbody>
            </table>

          </div>


          <div class="pagination pull-right" id="ajax_paging">
            <ul>
              <?php echo $this->pagination->create_links(); ?>
            </ul>
          </div>
        </div>
      <?php endif; ?>
      <footer>
        <hr />
      </footer>
    </div>
  </div>
</div>