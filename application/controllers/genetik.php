<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Genetik extends CI_Controller
{

    private $PRAKTIKUM = 'PRAKTIKUM';
    private $TEORI = 'TEORI';
    private $LABORATORIUM = 'LABORATORIUM';

    private $jenis_semester;
    private $tahun_akademik;
    private $populasi;
    private $crossOver;
    private $mutasi;

    private $jumlah_rank;
    private $r;
    private $rank;

    private $fitness = array();
    private $pengampu = array();
    private $individu = array(array(array()));
    private $sks = array();
    private $dosen = array();
    private $asdos = array();
    public $nama_matkul = array();
    private $individu_baru = array(array(array()));

    private $jam = array();
    private $hari = array();
    private $idosen = array();

    //waktu keinginan dosen
    private $waktu_dosen = array(array());
    private $jenis_mk = array(); //reguler or praktikum

    private $ruangLaboratorium = array();
    private $ruangReguler = array();
    private $logAmbilData;
    private $logInisialisasi;
    private $individu_solusi = array(array());
    private $log;
    private $induk = array();

    //jumat
    private $kode_jumat;
    private $range_jumat = array();
    private $kode_dhuhur;
    private $is_waktu_dosen_tidak_bersedia_empty;



    function __construct($jenis_semester, $tahun_akademik, $populasi, $crossOver, $mutasi, $kode_jumat, $range_jumat, $kode_dhuhur)
    {
        parent::__construct();

        $this->jenis_semester = $jenis_semester;
        $this->tahun_akademik = $tahun_akademik;
        $this->populasi       = intval($populasi);
        $this->crossOver      = $crossOver;
        $this->mutasi         = $mutasi;
        $this->kode_jumat     = intval($kode_jumat);
        $this->range_jumat    = explode('-', $range_jumat); //$hari_jam = explode(':', $this->waktu_dosen[$j][1]);
        $this->kode_dhuhur    = intval($kode_dhuhur);
    }

    public function dosen()
    {
        return $this->nama_matkul;
    }
    public function populasi()
    {
        return $this->populasi;
    }

    public function pengampu()
    {
        return count($this->pengampu);
    }
    public function jumlah_jam()
    {
        return count($this->jam);
    }
    public function jumlah_hari()
    {
        return count($this->hari);
    }
    public function ruangan()
    {
        return  count($this->ruangReguler);
    }
    public function ruanganR()
    {
        return  $this->ruangReguler;
    }

    public function rank()
    {
        return $this->rank;
    }
    public function sks()
    {
        return $this->sks;
    }

    public function fitness()
    {
        return $this->fitness;
    }
    public function jumlahRank()
    {
        return $this->jumlah_rank;
    }
    public function individuBaru()
    {
        return $this->individu_baru;
    }
    public function induk()
    {
        return ($this->induk);
    }

    public function individu()
    {
        return $this->individu;
    }

    public function individuSolusi()
    {
        return $this->individu_solusi;
    }

    public function AmbilData()
    {

        $rs_data = $this->db->query("SELECT   a.kode,"
            . "       b.sks,"
            . "       a.kode_dosen,"
            . "       b.jenis, "
            . "       b.nama "
            . "FROM pengampu a "
            . "LEFT JOIN matakuliah b "
            . "ON a.kode_mk = b.kode "
            . "WHERE b.semester%2 = $this->jenis_semester "
            . "      AND a.tahun_akademik = '$this->tahun_akademik'");

        $i = 0;
        foreach ($rs_data->result() as $data) {
            $this->pengampu[$i] = intval($data->kode);
            $this->sks[$i]         = intval($data->sks);
            $this->dosen[$i]       = intval($data->kode_dosen);
            $this->nama_matkul[$i]       = ($data->nama);
            $this->jenis_mk[$i]    = $data->jenis;
            $i++;
        }

        // echo implode(" ", $this->jenis_mk);
        // // echo $p
        // var_dump($this->pengampu);
        // var_dump($this->nama_matkul);
        // var_dump($this->sks);
        // var_dump($this->dosen);
        // var_dump($rs_data);
        // exit();

        //Fill Array of Jam Variables
        $rs_jam = $this->db->query("SELECT kode FROM jam");
        $i      = 0;
        foreach ($rs_jam->result() as $data) {
            $this->jam[$i] = intval($data->kode);
            $i++;
        }
        // var_dump($rs_jam);
        // exit();

        //Fill Array of Hari Variables
        $rs_hari = $this->db->query("SELECT kode FROM hari");
        $i       = 0;
        foreach ($rs_hari->result() as $data) {
            $this->hari[$i] = intval($data->kode);
            $i++;
        }


        $rs_RuangReguler = $this->db->query("SELECT kode "
            . "FROM ruang "
            . "WHERE jenis = '$this->TEORI'");
        $i               = 0;
        foreach ($rs_RuangReguler->result() as $data) {
            $this->ruangReguler[$i] = intval($data->kode);
            $i++;
        }


        $rs_Ruanglaboratorium = $this->db->query("SELECT kode "
            . "FROM ruang "
            . "WHERE jenis = '$this->LABORATORIUM'");
        $i                    = 0;
        foreach ($rs_Ruanglaboratorium->result() as $data) {
            $this->ruangLaboratorium[$i] = intval($data->kode);
            $i++;
        }

        // var_dump($this->ruangLaboratorium);
        // exit(0);

        $rs_WaktuDosen = $this->db->query("SELECT kode_dosen," .
            "CONCAT_WS(':',kode_hari,kode_jam) as kode_hari_jam " .
            "FROM waktu_tidak_bersedia");
        $i             = 0;
        foreach ($rs_WaktuDosen->result() as $data) {
            $this->idosen[$i]         = intval($data->kode_dosen);
            $this->waktu_dosen[$i][0] = intval($data->kode_dosen);
            $this->waktu_dosen[$i][1] = $data->kode_hari_jam;
            $i++;
        }
    }


    public function Inisialisai()
    {
        // global  $jumlah_pengampu, $jumlah_jam, $jumlah_hari, $jumlah_ruang_reguler, $jumlah_ruang_lab;
        $jumlah_pengampu = count($this->pengampu);
        $jumlah_jam = count($this->jam);
        $jumlah_hari = count($this->hari);
        $jumlah_ruang_reguler = count($this->ruangReguler);
        $jumlah_ruang_lab = count($this->ruangLaboratorium);


        // var_dump($this->sks);
        // var_dump($jumlah_pengampu + $jumlah_jam + $jumlah_hari + $jumlah_ruang_reguler);
        // var_dump($jumlah_pengampu);
        // var_dump($jumlah_jam);
        // var_dump($jumlah_hari);
        // var_dump($jumlah_ruang_reguler);
        // var_dump($jumlah_ruang_lab);
        // exit();

        for ($i = 0; $i < $this->populasi; $i++) {
            for ($j = 0; $j < $jumlah_pengampu; $j++) {
                $sks = $this->sks[$j];
                $this->individu[$i][$j][0] = $j;

                // Penentuan jam secara acak ketika 1 sks 
                if ($sks == 1) {
                    $this->individu[$i][$j][1] = mt_rand(0,  $jumlah_jam - 1);
                }

                // Penentuan jam secara acak ketika 2 sks 
                if ($sks == 2) {
                    $this->individu[$i][$j][1] = mt_rand(0, ($jumlah_jam - 1) - 1);
                }

                // Penentuan jam secara acak ketika 3 sks
                if ($sks == 3) {
                    $this->individu[$i][$j][1] = mt_rand(0, ($jumlah_jam - 1) - 2);
                }

                // Penentuan jam secara acak ketika 4 sks
                if ($sks == 4) {
                    $this->individu[$i][$j][1] = mt_rand(0, ($jumlah_jam - 1) - 3);
                }

                $this->individu[$i][$j][2] = mt_rand(0, $jumlah_hari - 1); // Penentuan hari secara acak 

                if ($this->jenis_mk[$j] === $this->TEORI) {
                    $this->individu[$i][$j][3] = intval($this->ruangReguler[mt_rand(0, $jumlah_ruang_reguler - 1)]);
                } else {
                    $this->individu[$i][$j][3] = intval($this->ruangLaboratorium[mt_rand(0, $jumlah_ruang_lab - 1)]);
                }
                // echo json_encode($this->individu[$i]) . '<br><hr>';

                // echo 'Pengampu ' . json_encode($this->individu[$i][$j][0]) . '<br>';
                // echo 'jumlah jam ' . json_encode($this->individu[$i][$j][1]) . '<br>';
                // echo 'jumlah hari ' . json_encode($this->individu[$i][$j][2]) . '<br>';
                // echo 'Ruangan ' . json_encode($this->individu[$i][$j][3]) . '<hr>';
                // echo 'Inisialisasi' . json_encode($this->individu[$i][$j]) . '<br>';
            }
            // echo  json_encode($this->individu[0]) . '<br>';
            // exit();
        }
        // var_dump(json_encode($this->individu));
        // exit();
    }

    private function CekFitness($indv)
    {
        $penalty = 0;

        $hari_jumat = intval($this->kode_jumat);
        $jumat_0 = intval($this->range_jumat[0]);
        $jumat_1 = intval($this->range_jumat[1]);
        $jumat_2 = intval($this->range_jumat[2]);

        // var_dump($jumat_1);
        // exit();

        $jumlah_pengampu = count($this->pengampu);
        // var_dump($jumlah_pengampu);
        // exit();
        for ($i = 0; $i < $jumlah_pengampu; $i++) {

            $sks = intval($this->sks[$i]);

            $jam_a = intval($this->individu[$indv][$i][1]);
            $hari_a = intval($this->individu[$indv][$i][2]);
            $ruang_a = intval($this->individu[$indv][$i][3]);
            $dosen_a = intval($this->dosen[$i]);
            // var_dump($ruang_a);

            for ($j = 0; $j < $jumlah_pengampu; $j++) {

                $jam_b = intval($this->individu[$indv][$j][1]);
                $hari_b = intval($this->individu[$indv][$j][2]);
                $ruang_b = intval($this->individu[$indv][$j][3]);
                $dosen_b = intval($this->dosen[$j]);
                // var_dump($ruang_b);
                // exit();

                //1.bentrok ruang dan waktu dan 3.bentrok dosen

                //ketika pemasaran matakuliah sama, maka langsung ke perulangan berikutnya
                if ($i == $j)
                    continue;

                //#region Bentrok Ruang dan Waktu
                //Ketika jam,hari dan ruangnya sama, maka penalty + satu
                if (
                    $jam_a == $jam_b &&
                    $hari_a == $hari_b &&
                    $ruang_a == $ruang_b
                ) {
                    $penalty += 1;
                }

                //Ketika sks  = 2, 
                //hari dan ruang sama, dan 
                //jam kedua sama dengan jam pertama matakuliah yang lain, maka penalty + 1
                if ($sks >= 2) {
                    if (
                        $jam_a + 1 == $jam_b &&
                        $hari_a == $hari_b &&
                        $ruang_a == $ruang_b
                    ) {
                        $penalty += 1;
                    }
                }


                //Ketika sks  = 3, 
                //hari dan ruang sama dan 
                //jam ketiga sama dengan jam pertama matakuliah yang lain, maka penalty + 1
                if ($sks >= 3) {
                    if (
                        $jam_a + 2 == $jam_b &&
                        $hari_a == $hari_b &&
                        $ruang_a == $ruang_b
                    ) {
                        $penalty += 1;
                    }
                }

                //Ketika sks  = 4, 
                //hari dan ruang sama dan 
                //jam ketiga sama dengan jam pertama matakuliah yang lain, maka penalty + 1
                if ($sks >= 4) {
                    if (
                        $jam_a + 3 == $jam_b &&
                        $hari_a == $hari_b &&
                        $ruang_a == $ruang_b
                    ) {
                        $penalty += 1;
                    }
                }

                //______________________BENTROK DOSEN
                if (
                    //ketika jam sama
                    $jam_a == $jam_b &&
                    //dan hari sama
                    $hari_a == $hari_b &&
                    //dan dosennya sama
                    $dosen_a == $dosen_b
                ) {
                    //maka...
                    $penalty += 1;
                }



                if ($sks >= 2) {
                    if (
                        //ketika jam sama
                        ($jam_a + 1) == $jam_b &&
                        //dan hari sama
                        $hari_a == $hari_b &&
                        //dan dosennya sama
                        $dosen_a == $dosen_b
                    ) {
                        //maka...
                        $penalty += 1;
                    }
                }

                if ($sks >= 3) {
                    if (
                        //ketika jam sama
                        ($jam_a + 2) == $jam_b &&
                        //dan hari sama
                        $hari_a == $hari_b &&
                        //dan dosennya sama
                        $dosen_a == $dosen_b
                    ) {
                        //maka...
                        $penalty += 1;
                    }
                }

                if ($sks >= 4) {
                    if (
                        //ketika jam sama
                        ($jam_a + 3) == $jam_b &&
                        //dan hari sama
                        $hari_a == $hari_b &&
                        //dan dosennya sama
                        $dosen_a == $dosen_b
                    ) {
                        //maka...
                        $penalty += 1;
                    }
                }
                // echo ' penalti - ' . json_encode($penalty);
            }

            //
            // #region Bentrok sholat Jumat
            if (($hari_a  + 1) == $hari_jumat) //2.bentrok sholat jumat
            {

                if ($sks == 1) {
                    if (

                        ($jam_a == ($jumat_0 - 1)) ||
                        ($jam_a == ($jumat_1 - 1)) ||
                        ($jam_a == ($jumat_2 - 1))

                    ) {

                        $penalty += 1;
                    }
                }


                if ($sks == 2) {
                    if (
                        ($jam_a == ($jumat_0 - 2)) ||
                        ($jam_a == ($jumat_0 - 1)) ||
                        ($jam_a == ($jumat_1 - 1)) ||
                        ($jam_a == ($jumat_2 - 1))
                    ) {

                        // echo '$sks = ' . $sks . '<br>';
                        // echo '$jam_a = ' . $jam_a . '<br>';
                        // echo '($jumat_0 - 2) = ' . ($jumat_0 - 2) . '<br>';
                        // echo '($jumat_0 - 1) = ' . ($jumat_0 - 1) . '<br>';
                        // echo '($jumat_1 - 1) = ' . ($jumat_1 - 1) . '<br>';
                        // echo '($jumat_2 - 1) = ' . ($jumat_2 - 1) . '<br>';
                        // exit();


                        $penalty += 1;
                    }
                }

                if ($sks == 3) {
                    if (
                        ($jam_a == ($jumat_0 - 3)) ||
                        ($jam_a == ($jumat_0 - 2)) ||
                        ($jam_a == ($jumat_0 - 1)) ||
                        ($jam_a == ($jumat_1 - 1)) ||
                        ($jam_a == ($jumat_2 - 1))
                    ) {
                        $penalty += 1;
                    }
                }

                if ($sks == 4) {
                    if (
                        ($jam_a == ($jumat_0 - 4)) ||
                        ($jam_a == ($jumat_0 - 3)) ||
                        ($jam_a == ($jumat_0 - 2)) ||
                        ($jam_a == ($jumat_0 - 1)) ||
                        ($jam_a == ($jumat_1 - 1)) ||
                        ($jam_a == ($jumat_2 - 1))
                    ) {
                        $penalty += 1;
                    }
                }
            }
            //#endregion

            //#region Bentrok dengan Waktu Keinginan Dosen
            //Boolean penaltyForKeinginanDosen = false;

            $jumlah_waktu_tidak_bersedia = count($this->idosen);


            for ($j = 0; $j < $jumlah_waktu_tidak_bersedia; $j++) {
                if ($dosen_a == $this->idosen[$j]) {
                    $hari_jam = explode(':', $this->waktu_dosen[$j][1]);

                    if (
                        $this->jam[$jam_a] == $hari_jam[1] &&
                        $this->hari[$hari_a] == $hari_jam[0]
                    ) {
                        $penalty += 1;
                    }
                }
            }


            //#endregion

            //#region Bentrok waktu dhuhur
            /*
            if ($jam_a == ($this->kode_dhuhur - 1))
            {                
                $penalty += 1;
            }
            */
            // var_dump($jam_b);
            // var_dump($hari_b);
            // var_dump($ruang_b);
            // var_dump($dosen_b);
        }

        $fitness = floatval(1 / (1 + $penalty));

        // var_dump($jam_b);
        // var_dump($hari_b);
        // var_dump($ruang_b);
        // var_dump($dosen_b);
        // exit();
        // var_dump($penalty);
        // var_dump($fitness);
        // exit();
        return $fitness;
    }




    public function HitungFitness()
    {
        //hard constraint
        //1.bentrok ruang dan waktu
        //2.bentrok sholat jumat
        //3.bentrok dosen
        //4.bentrok keinginan waktu dosen 
        //5.bentrok waktu dhuhur 
        //=>6.praktikum harus pada ruang lab {telah ditetapkan dari awal perandoman
        //    bahwa jika praktikum harus ada pada LAB dan mata kuliah reguler harus 
        //    pada kelas reguler


        //soft constraint //TODO
        $fitness = array();

        for ($indv = 0; $indv < $this->populasi; $indv++) {
            $fitness[$indv] = $this->CekFitness($indv);
            // echo 'fitness h' . var_dump(explode(",", json_encode($fitness)));
        }
        // exit();
        return $fitness;
    }

    #endregion

    #region Seleksi
    public function Seleksi($fitness)
    {
        $jumlah = 0;
        $this->rank   = array();

        for ($i = 0; $i < $this->populasi; $i++) {
            //proses ranking berdasarkan nilai fitness
            // var_dump($this->populasi);
            // exit();
            $this->rank[$i] = 1;
            // var_dump($fitness);
            for ($j = 0; $j < $this->populasi; $j++) {
                //ketika nilai fitness jadwal sekarang lebih dari nilai fitness jadwal yang lain,
                //ranking + 1;
                //if (i == j) continue;

                $fitnessA = floatval($fitness[$i]);
                $fitnessB = floatval($fitness[$j]);


                if ($fitnessA > $fitnessB) {
                    $this->rank[$i] += 1;
                }
            }
            // var_dump($fitnessA);
            // echo '<br> fitness ' . json_encode($fitness) . '<br>';
            // echo '<br> A ' . json_decode($fitnessA) . '-' . 'B ' . json_decode($fitnessB);


            $jumlah +=  $this->rank[$i];

            // echo '<br>' . json_encode($this->individu[$i]) . '<br>';
        }
        // echo '<br> Rank ' . var_dump(explode(",", json_encode($this->rank))) . '<br>';
        // echo '<br> Total Rank ' . var_dump(explode(",", json_encode($jumlah))) . '<br>';
        // var_dump($this->rank);
        $this->jumlah_rank = count($this->rank);


        for ($i = 0; $i < $this->populasi; $i++) {
            //proses seleksi berdasarkan ranking yang telah dibuat
            //int nexRandom = random.Next(1, jumlah);
            //random = new Random(nexRandom);
            $target = mt_rand(0, $jumlah - 1);
            // echo '<b>target</b> ' . json_encode($target) . '<br>';
            // var_dump($target);
            // exit();

            $cek    = 0; /*kumulatif */
            for ($j = 0; $j < $this->jumlah_rank; $j++) {
                $cek += $this->rank[$j];
                // echo 'cek ' . json_encode($cek) . '<br>';;
                if (intval($cek) >= intval($target)) {
                    // echo '<b>cek 1</b> ' . json_encode($cek) . '<br>';
                    $this->induk[$i] = $j;
                    break;
                };
            }


            // echo 'induk - ' . json_encode($this->induk[$i]) . '<br>';
        }
        // echo 'cek - ' . json_decode($cek) . '<br>';

    }
    //#endregion

    public function StartCrossOver()
    {
        $this->individu_baru = array(array(array()));
        $jumlah_pengampu = count($this->pengampu);

        for ($i = 0; $i < $this->populasi; $i += 2) //perulangan untuk jadwal yang terpilih
        {
            $b = 0;

            $cr = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();
            // var_dump($cr) . '<br>';
            // echo '<b>Induk Crossover</b>' . json_encode($this->induk[$i]) . '<br> ';

            //Two point crossover
            if (floatval($cr) < floatval($this->crossOver)) {
                //ketika nilai random kurang dari nilai probabilitas pertukaran
                //maka jadwal mengalami prtukaran

                $a = mt_rand(0, $jumlah_pengampu - 2);
                while ($b <= $a) {
                    $b = mt_rand(0, $jumlah_pengampu - 1);
                }
                // echo 'A' . json_encode($a) . '<br>';
                // echo 'B' . json_encode($b) . '<br><br>';



                // var_dump($this->induk);
                // var_dump($this->populasi);
                // var_dump($this->crossOver);

                // echo json_encode($cr) . '<br><br>';
                // var_dump($b);
                // exit();

                //penentuan jadwal baru dari awal sampai titik pertama
                for ($j = 0; $j < $a; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        ($this->individu_baru[$i][$j][$k]     = $this->individu[$this->induk[$i]][$j][$k]) . '<br> ';
                        ($this->individu_baru[$i + 1][$j][$k] = $this->individu[$this->induk[$i + 1]][$j][$k]) . '<br>';
                    }
                    // echo 'A' . json_encode($this->individu_baru[$i][$j]) . '<br> ';
                    // echo 'A tambah 1' . json_encode($this->individu_baru[$i + 1][$j]) . '<br> ';

                }

                //Penentuan jadwal baru dai titik pertama sampai titik kedua
                for ($j = $a; $j < $b; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        ($this->individu_baru[$i][$j][$k]     = $this->individu[$this->induk[$i + 1]][$j][$k]) . '<br> - ';
                        ($this->individu_baru[$i + 1][$j][$k] = $this->individu[$this->induk[$i]][$j][$k]) . '<br>';
                    }
                    // echo 'B' . json_encode($this->individu_baru[$i][$j]) . '<br> ';
                    // echo 'B tambah 1' . json_encode($this->individu_baru[$i + 1][$j]) . '<br> ';
                }
                // echo 'B' . json_encode($this->individu_baru[$i + 1]) . '<br><br> ';
                // var_dump($this->individu_baru[$i][$j][$k]);

                //penentuan jadwal baru dari titik kedua sampai akhir
                for ($j = $b; $j < $jumlah_pengampu; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        ($this->individu_baru[$i][$j][$k]     = $this->individu[$this->induk[$i]][$j][$k]) . '<br>';
                        ($this->individu_baru[$i + 1][$j][$k] = $this->individu[$this->induk[$i + 1]][$j][$k]) . '<br> ';
                    }
                    // echo 'pengampu' . json_encode($this->individu_baru[$i][$j]) . '<br> ';
                }
            } else { //Ketika nilai random lebih dari nilai probabilitas pertukaran, maka jadwal baru sama dengan jadwal terpilih
                for ($j = 0; $j < $jumlah_pengampu; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        $this->individu_baru[$i][$j][$k]     = $this->individu[$this->induk[$i]][$j][$k];
                        $this->individu_baru[$i + 1][$j][$k] = $this->individu[$this->induk[$i + 1]][$j][$k];
                    }
                }
            }

            // var_dump($this->induk);
            // echo var_dump(explode(" - ", json_encode($this->individu_baru)));

            // var_dump($this->induk);
            // exit();
            // echo '<br>' . json_encode($cr);
        }


        // var_dump($jumlah_pengampu);

        $jumlah_pengampu = count($this->pengampu);

        for ($i = 0; $i < $this->populasi; $i += 2) {
            for ($j = 0; $j < $jumlah_pengampu; $j++) {
                for ($k = 0; $k < 4; $k++) {
                    /* echo json_encode*/
                    ($this->individu[$i][$j][$k] = $this->individu_baru[$i][$j][$k]);
                    /* echo json_encode*/
                    ($this->individu[$i + 1][$j][$k] = $this->individu_baru[$i + 1][$j][$k]);
                }
                // echo 'Individu baru - ' .  json_encode($this->individu[$i][$j]) . '<br> ';
                // echo 'Individu baru + 1 - ' .  json_encode($this->individu[$i + 1][$j]) . '<br> ';
            }
            // echo 'pengampu' . json_encode($this->individu[$i][0]) . '<br> ';
            // exit();
        }
        // var_dump($a);
        // var_dump($b);



    }

    public function Mutasi()
    {
        $this->fitness = array();
        //proses perandoman atau penggantian komponen untuk tiap jadwal baru
        $r       = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();
        $jumlah_pengampu = count($this->pengampu);
        $jumlah_jam = count($this->jam);
        $jumlah_hari = count($this->hari);
        $jumlah_ruang_reguler = count($this->ruangReguler);
        $jumlah_ruang_lab = count($this->ruangLaboratorium);

        // echo 'Nilai Random - ' . json_encode($r) . '<br>';
        // echo 'Nilai induk - ' . json_encode($this->induk) . '<br>';
        for ($i = 0; $i < $this->populasi; $i++) {
            //Ketika nilai random kurang dari nilai probalitas Mutasi, 
            //maka terjadi penggantian komponen

            $krom = mt_rand(0, $jumlah_pengampu - 1);
            $j = intval($this->sks[$krom]);
            if ($r < $this->mutasi) {
                //Penentuan pada matakuliah dan kelas yang mana yang akan dirandomkan atau diganti

                switch ($j) {
                    case 1:
                        $this->individu[$i][$krom][1] = mt_rand(0, $jumlah_jam - 1);
                        break;
                    case 2:
                        $this->individu[$i][$krom][1] = mt_rand(0, ($jumlah_jam - 1) - 1);
                        break;
                    case 3:
                        $this->individu[$i][$krom][1] = mt_rand(0, ($jumlah_jam - 1) - 2);
                        break;
                    case 4:
                        $this->individu[$i][$krom][1] = mt_rand(0, ($jumlah_jam - 1) - 3);
                        break;
                }
                //Proses penggantian hari
                $this->individu[$i][$krom][2] = mt_rand(0, $jumlah_hari - 1);

                //proses penggantian ruang               

                if ($this->jenis_mk[$krom] === $this->TEORI) {
                    $this->individu[$i][$krom][3] = $this->ruangReguler[mt_rand(0, $jumlah_ruang_reguler - 1)];
                } else {
                    $this->individu[$i][$krom][3] = $this->ruangLaboratorium[mt_rand(0, $jumlah_ruang_lab - 1)];
                }
                // var_dump($this->individu[$i][$krom][1]);

            }
            // echo 'random krom  - ' . json_encode($krom) . '<br><br>';
            // echo 'SKS  - ' . json_encode($this->sks) . '<br><br>';
            // echo 'J   - ' . json_decode($j) . '<br><br>';
            // echo 'pengampu  - ' . json_decode($this->individu[$i][$krom][0]) . '<br>';
            // echo 'Jam       - ' . json_decode($this->individu[$i][$krom][1]) . '<br>';
            // echo 'hari      - ' . json_decode($this->individu[$i][$krom][2]) . '<br>';
            // echo 'Ruangan   - ' . json_decode($this->individu[$i][$krom][3]) . '<br>';


            $this->fitness[$i] = $this->CekFitness($i);
            // echo 'Fitnes Mutasi - ' . json_decode($this->fitness[$i]) . '<br>';
        }
        // var_dump($j);
        // echo 'Fitnes after Mutasi - ' . var_dump(explode(",", json_encode($this->fitness))) . '<br>';
        // for ($j = 0; $j < count($this->fitness); $j++) {
        // }


        // exit();
        return $this->fitness;
    }

    public function GetIndividu($indv)
    {
        //return individu;

        //int[,] individu_solusi = new int[mata_kuliah.Length, 4];
        $this->individu_solusi = array(array());
        for ($j = 0; $j < count($this->pengampu); $j++) {
            $this->individu_solusi[$j][0] = intval($this->pengampu[$this->individu[$indv][$j][0]]);
            $this->individu_solusi[$j][1] = intval($this->jam[$this->individu[$indv][$j][1]]);
            $this->individu_solusi[$j][2] = intval($this->hari[$this->individu[$indv][$j][2]]);
            $this->individu_solusi[$j][3] = intval($this->individu[$indv][$j][3]);

            // echo 'Fitness individu  - ' . json_encode($this->fitness) . '<br>';
            // echo 'Pengampu  - ' . json_decode($this->individu_solusi[$j][0]) . '<br>';
            // echo 'Jam  - ' . json_decode($this->individu_solusi[$j][1]) . '<br>';
            // echo 'Hari  - ' . json_decode($this->individu_solusi[$j][2]) . '<br>';
            // echo 'individu baru  - ' . json_decode($this->individu_solusi[$j][3]) . '<br>';
        }
        // exit();
        // exit();
        // var_dump($this->individu_solusi[$j][0]);
        // var_dump($this->individu_solusi[$j][1]);
        // var_dump($this->individu_solusi[$j][2]);
        return $this->individu_solusi;
        // var_dump($this->individu_baru);
    }

    // public function fit()
    // {
    //     return $this->CekFitness($indv);
    // }
    // public function getCrossover()
    // {
    //     return $this->Mutasi();
    // }
}
