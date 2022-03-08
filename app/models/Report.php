<?php

class Report
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllReports()
    {
        $this->db->query(
            'SELECT reports.id, reports.nama_pelapor, reports.waktu_dilaporkan, reports.status_laporan, 
                    cases.tempat_kejadian, cases.waktu_kejadian, cases.pelanggaran 
            FROM reports
            INNER JOIN cases ON reports.kasus_id=cases.id ORDER BY reports.waktu_dilaporkan DESC');
        $result = $this->db->resultSet();

        return $result;
    }

    public function findReportById($id)
    {
        $this->db->query(
            'SELECT *
            FROM reports
            INNER JOIN cases ON reports.kasus_id=cases.id 
            WHERE reports.id= :id');

        $this->db->bind(':id', $id);
        $rowResult = $this->db->single();

        return $rowResult;
    }

    // public function paginate($number1, $number2)
    // {
    //     $this->db->query(
    //         'SELECT id, nama_pelapor, tempat_kejadian, pelanggaran, deskripsi_kejadian,
    //                 waktu_dilaporkan, status 
    //         FROM reports LIMIT :number1, :number2');
    //     $this->db->bind(':number1', $number1);
    //     $this->db->bind(':number2', $number2);
    //     $result = $this->db->resultSet();

    //     return $result;
    // }

    public function createReport($data) 
    {

        try {

            // start transaction
            $this->db->beginTransaction();

            // query insert data to case table
            $this->db->query(
                'INSERT INTO cases ( tempat_kejadian, waktu_kejadian, pelanggaran, 
                            deskripsi_kejadian, tindak_pidana, barang_bukti) 
                VALUES ( :tempat_kejadian, :waktu_kejadian, :pelanggaran, :deskripsi_kejadian,
                        :tindak_pidana, :barang_bukti)');

            $this->db->bind(':tempat_kejadian', $data['tempat_kejadian']);
            $this->db->bind(':waktu_kejadian', $data['waktu_kejadian']);
            $this->db->bind(':pelanggaran', $data['pelanggaran']);
            $this->db->bind(':deskripsi_kejadian', $data['deskripsi_kejadian']);
            $this->db->bind(':tindak_pidana', $data['tindak_pidana']);
            $this->db->bind(':barang_bukti', $data['barang_bukti']);

            $this->db->execute();
            $lastId = $this->db->getlastInsertId(); // get id of case for kasus_id column

            // query insert data to report table
            $this->db->query(
                'INSERT INTO reports (user_id, kasus_id, nama_pelapor, pelaku, korban, 
                            waktu_dilaporkan, nama_saksi, alamat_saksi, uraian_kejadian) 
                VALUES (:user_id, :kasus_id, :nama_pelapor, :pelaku, :korban, :waktu_dilaporkan,
                        :nama_saksi, :alamat_saksi, :uraian_kejadian)');

            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':kasus_id', $lastId); 
            $this->db->bind(':nama_pelapor', $data['nama_pelapor']);
            $this->db->bind(':pelaku', $data['pelaku']);
            $this->db->bind(':korban', $data['korban']);
            $this->db->bind(':waktu_dilaporkan', $data['waktu_dilaporkan']);
            $this->db->bind(':nama_saksi', $data['nama_saksi']);
            $this->db->bind(':alamat_saksi', $data['alamat_saksi']);
            $this->db->bind(':uraian_kejadian', $data['uraian_kejadian']);

            $this->db->execute();

            // if true, commit insert data
            $this->db->commit();

            // return true for success return
            return true;

        } catch (PDOException $e) {

            // rollback if failed to insert data
            $this->db->rollBack();

            echo "DATA YANG ANDA INPUT GAGAL MASUK KE DATABASE" . PHP_EOL;
            die($e->getMessage());

        }

    }

    public function updateReport($data)
    {
        // $this->db->query(
        //     'UPDATE reports 
        //     SET user_id = :user_id, nama_pelapor = :nama_pelapor, 
        //         waktu_kejadian = :waktu_kejadian, tempat_kejadian = :tempat_kejadian, 
        //         pelanggaran = :pelanggaran, pelaku = :pelaku, korban = :korban, 
        //         deskripsi_kejadian = :deskripsi_kejadian, waktu_dilaporkan = :waktu_dilaporkan,
        //         status = :status, tindak_pidana = :tindak_pidana, nama_saksi = :nama_saksi,
        //         alamat_saksi = :alamat_saksi, barang_bukti = :barang_bukti, uraian_kejadian = :uraian_kejadian 
        //     WHERE id = :id');

        // $this->db->bind(':id', $data['id']);
        // $this->db->bind(':user_id', $data['user_id']);
        // $this->db->bind(':nama_pelapor', $data['nama_pelapor']);
        // $this->db->bind(':waktu_kejadian', $data['waktu_kejadian']);
        // $this->db->bind(':tempat_kejadian', $data['tempat_kejadian']);
        // $this->db->bind(':pelanggaran', $data['pelanggaran']);
        // $this->db->bind(':pelaku', $data['pelaku']);
        // $this->db->bind(':korban', $data['korban']);
        // $this->db->bind(':deskripsi_kejadian', $data['deskripsi_kejadian']);
        // $this->db->bind(':waktu_dilaporkan', $data['waktu_dilaporkan']);
        // $this->db->bind(':status', $data['status']);
        // $this->db->bind(':tindak_pidana', $data['tindak_pidana']);
        // $this->db->bind(':nama_saksi', $data['nama_saksi']);
        // $this->db->bind(':alamat_saksi', $data['alamat_saksi']);
        // $this->db->bind(':barang_bukti', $data['barang_bukti']);
        // $this->db->bind(':uraian_kejadian', $data['uraian_kejadian']);
        
        // if ($this->db->execute()) {
        //     return true;
        // } else {
        //     return false;
        // }

        // ================================================================

        try {

            // start transaction
            $this->db->beginTransaction();

            // query insert data to case table
            $this->db->query(
                'UPDATE cases 
                SET tempat_kejadian = :tempat_kejadian, waktu_kejadian = :waktu_kejadian, 
                    pelanggaran = :pelanggaran, deskripsi_kejadian = :deskripsi_kejadian, 
                    tindak_pidana = :tindak_pidana, barang_bukti = :barang_bukti 
                WHERE id = :id');
                
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':tempat_kejadian', $data['tempat_kejadian']);
            $this->db->bind(':waktu_kejadian', $data['waktu_kejadian']);
            $this->db->bind(':pelanggaran', $data['pelanggaran']);
            $this->db->bind(':deskripsi_kejadian', $data['deskripsi_kejadian']);
            $this->db->bind(':tindak_pidana', $data['tindak_pidana']);
            $this->db->bind(':barang_bukti', $data['barang_bukti']);

            $this->db->execute();

            // query insert data to report table
            $this->db->query(
                'UPDATE reports 
                SET user_id = :user_id, kasus_id = :kasus_id, nama_pelapor = :nama_pelapor, pelaku = :pelaku,
                    korban = :korban, waktu_dilaporkan = :waktu_dilaporkan, status_laporan = :status_laporan, nama_saksi = :nama_saksi, 
                    alamat_saksi = :alamat_saksi, uraian_kejadian = :uraian_kejadian
                WHERE id = :id');

            $this->db->bind(':id', $data['id']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':kasus_id', $data['id']); // use the same id with case id because di insert bersamaan
            $this->db->bind(':nama_pelapor', $data['nama_pelapor']);
            $this->db->bind(':pelaku', $data['pelaku']);
            $this->db->bind(':korban', $data['korban']);
            $this->db->bind(':waktu_dilaporkan', $data['waktu_dilaporkan']);
            $this->db->bind(':status_laporan', $data['status_laporan']);
            $this->db->bind(':nama_saksi', $data['nama_saksi']);
            $this->db->bind(':alamat_saksi', $data['alamat_saksi']);
            $this->db->bind(':uraian_kejadian', $data['uraian_kejadian']);

            $this->db->execute();

            // if true, commit insert data
            $this->db->commit();

            // return true for success return
            return true;

        } catch (PDOException $e) {

            // rollback if failed to insert data
            $this->db->rollBack();

            echo "DATA YANG ANDA INPUT GAGAL MASUK KE DATABASE" . PHP_EOL;
            die($e->getMessage());

        }

    }

    public function deleteReport($id)
    {
        $this->db->query('DELETE FROM reports WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }

    // Count how many report come in
    public function countReport()
    {
        $this->db->query('SELECT COUNT(id) as count_reports FROM reports');
        
        $result = $this->db->fetchColumn();

        return $result;
    }

    public function countReportStatusMasuk()
    {
        $this->db->query('SELECT COUNT(status_laporan) FROM reports WHERE status_laporan="MASUK" ');

        $result = $this->db->fetchColumn();

        return $result;
    }

    public function countReportStatusProses()
    {
        $this->db->query('SELECT COUNT(status_laporan) FROM reports WHERE status_laporan="PROSES" ');

        $result = $this->db->fetchColumn();

        return $result;
    }

    public function countReportStatusSelesai()
    {
        $this->db->query('SELECT COUNT(status_laporan) FROM reports WHERE status_laporan="SELESAI" ');

        $result = $this->db->fetchColumn();

        return $result;
    }

    public function countReportStatusCancel()
    {
        $this->db->query('SELECT COUNT(status_laporan) FROM reports WHERE status_laporan="CANCEL" ');

        $result = $this->db->fetchColumn();

        return $result;
    }

    public function findResident()
    {
        $this->db->query('SELECT id, no_identitas, nama, alamat FROM residents');
        $result = $this->db->resultSet();

        return $result;
    }


    public function findResidentByName($keyword)
    {
        $this->db->query('SELECT no_identitas, nama FROM residents WHERE nama LIKE :keyword');
        $this->db->bind(':keyword', '%'. $keyword .'%');

        $result = $this->db->resultSet();

        return $result;
    }
    
    public function findReportByName($keyword)
    {
        $this->db->query('SELECT * FROM reports WHERE nama_pelapor LIKE :keyword');
        $this->db->bind(':keyword', '%'. $keyword .'%');

        $result = $this->db->rowCount();

        return $result;
    }

    public function getReportByName($keyword)
    {
        $this->db->query('SELECT * FROM reports WHERE nama_pelapor LIKE :keyword ');
        $this->db->bind(':keyword', '%'. $keyword .'%');

        $result = $this->db->resultSet();

        return $result;
    }

    public function paginateKeyword($keyword, $number1, $number2)
    {
        $this->db->query('SELECT * FROM reports WHERE nama_pelapor LIKE :keyword LIMIT :number1, :number2');
        $this->db->bind(':keyword', '%'. $keyword .'%');
        $this->db->bind(':number1', $number1);
        $this->db->bind(':number2', $number2);

        $result = $this->db->resultSet();

        return $result;
    }


}
