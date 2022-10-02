<?php

class M_Asdos extends CI_Model
{

    public $limit;
    public $offset;
    public $sort;
    public $order;

    function __construct()
    {

        parent::__construct();
    }

    function get()
    {
        $rs = $this->db->query("SELECT * FROM asdos");
        return $rs;
    }
    function get_all()
    {
        $rs = $this->db->query("SELECT kode ,nama_asdos " .
            "FROM asdos " .
            "ORDER BY nama_asdos");

        return $rs;
    }

    function get_by_kode($kode)
    {
        $rs = $this->db->query("SELECT kode ,nama_asdos " .
            "FROM asdos " .
            "WHERE kode = $kode");
        return $rs;
    }

    function cek_for_update($kode_baru, $nama_asdos, $kode_lama)
    {
        /*
		var check = string.Format("SELECT CAST(COUNT(*) AS CHAR(1)) " +
                                          "FROM hari " +
                                          "WHERE (kode='{0}' OR nama='{1}') AND kode <> {2}",
                                          txtKodeHari.Text, txtNamaHari.Text, _selectedkodeHr);
                var i = int.Parse(_dbConnect.ExecuteScalar(check));
		*/

        $rs = $this->db->query("SELECT CAST(COUNT(*) AS CHAR(1)) as cnt " .
            "FROM asdos WHERE (kode=$kode_baru OR nama_asdos='$nama_asdos') AND kode <> $kode_lama");
        return $rs->row()->cnt;
    }

    function cek_for_insert($kode, $nama_asdos)
    {
        $rs = $this->db->query("SELECT CAST(COUNT(*) AS CHAR(1)) as cnt " .
            "FROM asdos WHERE kode=$kode OR nama_asdos='$nama_asdos'");
        return $rs->row()->cnt;
    }

    function update($kode, $data)
    {
        $this->db->where('kode', $kode);
        $this->db->update('asdos', $data);
    }

    function insert($data)
    {
        $this->db->insert('asdos', $data);
    }

    function delete($kode)
    {
        $this->db->query("DELETE FROM asdos WHERE kode = '$kode'");
    }
}
