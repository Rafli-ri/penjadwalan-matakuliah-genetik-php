<div class="pagination" id="ajax_paging">
  <ul class="pagination">
    <?php echo $this->pagination->create_links(); ?>
  </ul>
</div>
<br>
<div class="widget-content">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Matakuliah</th>
        <th>Dosen</th>
        <th>Kelas</th>
        <th>Tahun Akademik</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <?php
      $i =  intval($start_number) + 1;
      foreach ($rs_pengampu->result() as $pengampu) { ?>
        <tr>
          <td><?php echo str_pad((int)$i, 3, 0, STR_PAD_LEFT); ?></td>
          <td><?php echo $pengampu->nama_mk; ?></td>
          <td><?php echo $pengampu->nama_dosen; ?></td>
          <td><?php echo $pengampu->kelas; ?></td>
          <td><?php echo $pengampu->tahun_akademik; ?></td>

          <td>
            <a href="<?php echo base_url() . 'web/pengampu_edit/' . $pengampu->kode; ?>" class="btn btn-primary"><i class="mdi mdi-pencil text-white"></i></a>
            <a href="<?php echo base_url() . 'web/pengampu_delete/' . $pengampu->kode; ?>" class="btn btn-danger" onClick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="mdi mdi-delete-forever text-white"></i></a>
          </td>
        </tr>
      <?php $i++;
      } ?>

    </tbody>
  </table>
</div>


<div class="pagination" id="ajax_paging">
  <ul>
    <?php echo $this->pagination->create_links(); ?>
  </ul>
</div>