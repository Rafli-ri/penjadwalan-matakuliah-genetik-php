<?php if ($this->session->flashdata('msg')) { ?>
    <div class="alert alert-error alert-success alert-dismissible fade show">
        <?php echo $this->session->flashdata('msg'); ?>
        <button type="button" class="close" onclick="this.parentElement.style.display='none';" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
<h4 class="card-title mb-0 mx-4">Jumlah Data</h4>
<div class="mt-4 my-4">
    <div class="row text-center">
        <div class="col-md border-right">
            <h4 class="mb-0"><?= $jumlahDataDosen;  ?></h4>
            <span class="font-14 text-muted">Jumlah Dosen</span>
        </div>
        <div class="col-md">
            <h4 class="mb-0"><?= $jumlahDataMatkul;  ?></h4>
            <span class="font-14 text-muted">jumlah Matakuliah</span>
        </div>
        <div class="col-md">
            <h4 class="mb-0"><?= $jumlahDataRuangan;  ?></h4>
            <span class="font-14 text-muted">jumlah Ruangan</span>
        </div>


    </div>
</div>