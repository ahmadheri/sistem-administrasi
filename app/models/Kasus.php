<?php 

class Kasus
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllCases()
    {
        $this->db->query('SELECT * FROM cases');
        $result = $this->db->resultSet(); 

        return $result;
    }

    // public function createCase($dataReportId, $dataTempatKejadian, $dataWaktuKejadian, $dataPelanggaran, 
    // $dataDeskripsiKejadian, $dataTindakPidana, $dataBarangBukti)
    // {
    //     $this->db->query('INSERT INTO cases (report_id, tempat_kejadian, waktu_kejadian,
    //     pelanggaran, deskripsi_kejadian, tindak_pidana, barang_bukti) VALUES (:report_id, 
    //     :tempat_kejadian, :waktu_kejadian, :pelanggaran, :deskripsi_kejadian, :tindak_pidana, 
    //     :barang_bukti)');

    //     $this->db->bind(':report_id', $dataReportId);
    //     $this->db->bind(':tempat_kejadian', $dataTempatKejadian);
    //     $this->db->bind(':waktu_kejadian', $dataWaktuKejadian);
    //     $this->db->bind(':pelanggaran', $dataPelanggaran);
    //     $this->db->bind(':deskripsi_kejadian', $dataDeskripsiKejadian);
    //     $this->db->bind(':tindak_pidana', $dataTindakPidana);
    //     $this->db->bind(':barang_bukti', $dataBarangBukti);

    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}

?>