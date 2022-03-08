<?php

class Reports extends Controller
{
    public function __construct()
    {
        $this->reportModel = $this->model('Report');
        $this->caseModel = $this->model('Kasus');
    }

    public function index()
    {
        // Get all Reports
        $reports = $this->reportModel->getAllReports();

        $data = [
            'reports' => $reports,
        ];

        $this->view('reports/index', $data);
    }

    public function create()
    {

        $residents = $this->reportModel->findResident();

        $data = [
            'residents' => $residents,
            'user_id' => $_SESSION['user_id'],
            'nama_pelapor' => '',
            'waktu_kejadian' => '',
            'tempat_kejadian' => '',
            'pelanggaran' => '',
            'pelaku' => '',
            'korban' => '',
            'deskripsi_kejadian' => '',
            'waktu_dilaporkan' => '',
            'tindak_pidana' => '',
            'nama_saksi' => '',
            'alamat_saksi' => '',
            'barang_bukti' => '',
            'uraian_kejadian' => '',
            'namaPelaporError' => '',
            'waktuKejadianError' => '',
            'tempatKejadianError' => '',
            'pelanggaranError' => '',
            'pelakuError' => '',
            'korbanError' => '',
            'deskripsiKejadianError' => '',
            'waktuDilaporkanError' => '',
            'tindakPidanaError' => '',
            'namaSaksiError' => '',
            'alamatSaksiError' => '',
            'barangBuktiError' => '',
            'uraianKejadianError' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'residents' => $residents,
                'user_id' => intval($_SESSION['user_id']),
                'nama_pelapor' => trim($_POST['nama_pelapor']),
                'waktu_kejadian' => date('Y-m-d H:i:s', strtotime($_POST['waktu_kejadian'])),
                'tempat_kejadian' => trim($_POST['tempat_kejadian']),
                'pelanggaran' => trim($_POST['pelanggaran']),
                'pelaku' => trim($_POST['pelaku']),
                'korban' => trim($_POST['korban']),
                'deskripsi_kejadian' => trim($_POST['deskripsi_kejadian']),
                'waktu_dilaporkan' => date('Y-m-d H:i:s', strtotime($_POST['waktu_dilaporkan'])),
                'tindak_pidana' => trim($_POST['tindak_pidana']),
                'nama_saksi' => trim($_POST['nama_saksi']),
                'alamat_saksi' => trim($_POST['alamat_saksi']),
                'barang_bukti' => trim($_POST['barang_bukti']),
                'uraian_kejadian' => trim($_POST['uraian_kejadian']),
                'namaPelaporError' => '',
                'waktuKejadianError' => '',
                'tempatKejadianError' => '',
                'pelanggaranError' => '',
                'pelakuError' => '',
                'korbanError' => '',
                'deskripsiKejadianError' => '',
                'waktuDilaporkanError' => '',
                'tindakPidanaError' => '',
                'namaSaksiError' => '',
                'alamatSaksiError' => '',
                'barangBuktiError' => '',
                'uraianKejadianError' => '',
                'message' => ''
            ];

            // Validation 
            if (empty($data['nama_pelapor'])) {
                $data['namaPelaporError'] = 'Mohon diisi nama pelapor';
                // $_SESSION['danger'] = 'Mohon diisi nama pelapor';
            }
            
            // 1970-01-01 00:00:00 meaning empty
            if ($data['waktu_kejadian'] == '1970-01-01 00:00:00' ) {
                $data['waktuKejadianError'] = 'Waktu Kejadian tidak boleh kosong';
            }

            if (empty($data['tempat_kejadian'])) {
                $data['tempatKejadianError'] = 'Tempat Kejadian tidak boleh kosong';
            }

            if (empty($data['pelanggaran'])) {
                $data['pelanggaranError'] = 'Field Pelanggaran tidak boleh kosong';
            }

            if (empty($data['pelaku'])) {
                $data['pelakuError'] = 'Field Pelaku tidak boleh kosong';
            }

            if (empty($data['korban'])) {
                $data['korbanError'] = 'Field Korban tidak boleh kosong';
            }

            if (empty($data['deskripsi_kejadian'])) {
                $data['deskripsiKejadianError'] = 'Field Deskripsi Kejadian tidak boleh kosong';
            }

            // 1970-01-01 00:00:00 meaning empty
            if ($data['waktu_dilaporkan'] == '1970-01-01 00:00:00') {
                $data['waktuDilaporkanError'] = 'Field Waktu Dilaporkan tidak boleh kosong';
            }

            if (empty($data['tindak_pidana'])) {
                $data['tindakPidanaError'] = 'Field Tindak Pidana tidak boleh kosong';
            }

            if (empty($data['nama_saksi'])) {
                $data['namaSaksiError'] = 'Field Nama Saksi tidak boleh kosong';
            }

            if (empty($data['alamat_saksi'])) {
                $data['alamatSaksiError'] = 'Field Alamat Saksi tidak boleh kosong';
            }

            if (empty($data['barang_bukti'])) {
                $data['barangBuktiError'] = 'Field Barang Bukti tidak boleh kosong';
            }

            if (empty($data['uraian_kejadian'])) {
                $data['uraianKejadianError'] = 'Field Uraian Kejadian tidak boleh kosong';
            }

            // checking the error if empty 
            if (empty($data['namaPelaporError']) && empty($data['waktuKejadianError']) && empty($data['tempatKejadianError']) 
                && empty($data['pelanggaranError']) && empty($data['pelakuError']) && empty($data['korbanError']) 
                && empty($data['deskripsiKejadianError']) && empty($data['waktuDilaporkanError']) && empty($data['tindakPidanaError']) 
                && empty($data['namaSaksiError']) && empty($data['alamatSaksiError']) && empty($data['barangBuktiError']) 
                && empty($data['uraianKejadianError'])) {

                    $success = $this->reportModel->createReport($data);

                    if( $success ) {
                        $_SESSION['success'] = "Laporan berhasil ditambahkan";
                        header('location: ' . URLROOT . '/reports');
                        // showMessage();
                    } else {
                        die("Something went wrong, please try again");
                    }

                }
        }

        $this->view('reports/create', $data);
    }

    public function show($id)
    {
        $report = $this->reportModel->findReportById($id);

        $data = [
            'report' => $report
        ];

        $this->view('reports/show', $data);
    }

    public function edit($id)
    {
        $report = $this->reportModel->findReportById($id);
        $residents = $this->reportModel->findResident();

        $data = [
            'report' => $report,
            'residents' => $residents,
            'user_id' => $_SESSION['user_id'],
            'nama_pelapor' => '',
            'waktu_kejadian' => '',
            'tempat_kejadian' => '',
            'pelanggaran' => '',
            'pelaku' => '',
            'korban' => '',
            'deskripsi_kejadian' => '',
            'waktu_dilaporkan' => '',
            'status_laporan' => '',
            'tindak_pidana' => '',
            'nama_saksi' => '',
            'alamat_saksi' => '',
            'barang_bukti' => '',
            'uraian_kejadian' => '',
            'namaPelaporError' => '',
            'waktuKejadianError' => '',
            'tempatKejadianError' => '',
            'pelanggaranError' => '',
            'pelakuError' => '',
            'korbanError' => '',
            'deskripsiKejadianError' => '',
            'waktuDilaporkanError' => '',
            'tindakPidanaError' => '',
            'namaSaksiError' => '',
            'alamatSaksiError' => '',
            'barangBuktiError' => '',
            'uraianKejadianError' => '',
        ];

        $this->view('reports/edit', $data);
    }

    public function update($id)
    {
        $report = $this->reportModel->findReportById($id);

        $data = [
            'report' => $report,
            'user_id' => $_SESSION['user_id'],
            'nama_pelapor' => '',
            'waktu_kejadian' => '',
            'tempat_kejadian' => '',
            'pelanggaran' => '',
            'pelaku' => '',
            'korban' => '',
            'deskripsi_kejadian' => '',
            'waktu_dilaporkan' => '',
            'status_laporan' => '',
            'tindak_pidana' => '',
            'nama_saksi' => '',
            'alamat_saksi' => '',
            'barang_bukti' => '',
            'uraian_kejadian' => '',
            'namaPelaporError' => '',
            'waktuKejadianError' => '',
            'tempatKejadianError' => '',
            'pelanggaranError' => '',
            'pelakuError' => '',
            'korbanError' => '',
            'deskripsiKejadianError' => '',
            'waktuDilaporkanError' => '',
            'statusLaporanError' => '',
            'tindakPidanaError' => '',
            'namaSaksiError' => '',
            'alamatSaksiError' => '',
            'barangBuktiError' => '',
            'uraianKejadianError' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) ) {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'report' => $report,
                'user_id' => intval($_SESSION['user_id']),
                'nama_pelapor' => trim($_POST['nama_pelapor']),
                'waktu_kejadian' => date('Y-m-d H:i:s', strtotime($_POST['waktu_kejadian'])),
                'tempat_kejadian' => trim($_POST['tempat_kejadian']),
                'pelanggaran' => trim($_POST['pelanggaran']),
                'pelaku' => trim($_POST['pelaku']),
                'korban' => trim($_POST['korban']),
                'deskripsi_kejadian' => trim($_POST['deskripsi_kejadian']),
                'waktu_dilaporkan' => date('Y-m-d H:i:s', strtotime($_POST['waktu_dilaporkan'])),
                // 'status_laporan' => trim($_POST['status_laporan']),
                'status_laporan' => implode(',', $_POST['status_laporan']),
                'tindak_pidana' => trim($_POST['tindak_pidana']),
                'nama_saksi' => trim($_POST['nama_saksi']),
                'alamat_saksi' => trim($_POST['alamat_saksi']),
                'barang_bukti' => trim($_POST['barang_bukti']),
                'uraian_kejadian' => trim($_POST['uraian_kejadian']),
                'namaPelaporError' => '',
                'waktuKejadianError' => '',
                'tempatKejadianError' => '',
                'pelanggaranError' => '',
                'pelakuError' => '',
                'korbanError' => '',
                'deskripsiKejadianError' => '',
                'waktuDilaporkanError' => '',
                'statusLaporanError' => '',
                'tindakPidanaError' => '',
                'namaSaksiError' => '',
                'alamatSaksiError' => '',
                'barangBuktiError' => '',
                'uraianKejadianError' => '',
                'message' => ''
            ];

            if (empty($data['nama_pelapor'])) {
                $data['namaPelaporError'] = 'Mohon diisi nama pelapor';
            }

            if (empty($data['waktu_kejadian'])) {
                $data['waktuKejadianError'] = 'Waktu Kejadian tidak boleh kosong';
            }

            if (empty($data['tempat_kejadian'])) {
                $data['tempatKejadianError'] = 'Tempat Kejadian tidak boleh kosong';
            }

            if (empty($data['pelanggaran'])) {
                $data['pelanggaranError'] = 'Field Pelanggaran tidak boleh kosong';
            }

            if (empty($data['pelaku'])) {
                $data['pelakuError'] = 'Field Pelaku tidak boleh kosong';
            }

            if (empty($data['korban'])) {
                $data['korbanError'] = 'Field Korban tidak boleh kosong';
            }

            if (empty($data['deskripsi_kejadian'])) {
                $data['deskripsiKejadianError'] = 'Field Deskripsi Kejadian tidak boleh kosong';
            }

            // 1970-01-01 00:00:00 meaning empty
            if ($data['waktu_dilaporkan'] == '1970-01-01 00:00:00') {
                $data['waktuDilaporkanError'] = 'Field Waktu Dilaporkan tidak boleh kosong';
            }

            if (empty($data['status_laporan'])) {
                $data['statusLaporanError'] = 'Pilih status laporan saat ini';
            }

            if (empty($data['tindak_pidana'])) {
                $data['tindakPidanaError'] = 'Field Tindak Pidana tidak boleh kosong';
            }

            if (empty($data['nama_saksi'])) {
                $data['namaSaksiError'] = 'Field Nama Saksi tidak boleh kosong';
            }

            if (empty($data['alamat_saksi'])) {
                $data['alamatSaksiError'] = 'Field Alamat Saksi tidak boleh kosong';
            }

            if (empty($data['barang_bukti'])) {
                $data['barangBuktiError'] = 'Field Barang Bukti tidak boleh kosong';
            }

            if (empty($data['uraian_kejadian'])) {
                $data['uraianKejadianError'] = 'Field Uraian Kejadian tidak boleh kosong';
            }

            if (empty($data['namaPelaporError']) && empty($data['waktuKejadianError']) && empty($data['tempatKejadianError']) && empty($data['pelanggaranError'])
                && empty($data['pelakuError']) && empty($data['korbanError']) && empty($data['deskripsiKejadianError'])
                && empty($data['waktuDilaporkanError']) && empty($data['statusLaporanError'])  && empty($data['tindakPidanaError']) && empty($data['namaSaksiError'])
                && empty($data['alamatSaksiError']) && empty($data['barangBuktiError']) && empty($data['uraianKejadianError'])) {

                    if ($this->reportModel->updateReport($data)) {
                        $_SESSION['status'] = "SUCCESS";
                        header('location: ' . URLROOT . '/reports');
                    } else {
                        die("Something went wrong, please try again");
                    }

                } else {
                    $this->view('reports/edit', $data);
                }

        }

        $this->view('reports/edit', $data);
    }

    public function delete($id)
    {
        $report = $this->reportModel->findReportById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            if($this->reportModel->deleteReport($id)) {
                header('location: ' . URLROOT . '/reports');
            } else {
                die('Something went wrong!');
            }

        }
    }

    public function print($id)
    {
        $report = $this->reportModel->findReportById($id);

        $data = [
            'report' => $report
        ];

        $this->view('reports/print', $data);
    }

   
}
