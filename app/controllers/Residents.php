<?php 

class Residents extends Controller
{
    public function __construct()
    {
        $this->residentModel = $this->model('Resident');
    }

    public function index()
    {
        $residents = $this->residentModel->getAllResidents();

        $data = [
            'residents' => $residents
        ];

        $this->view('residents/index', $data);
    }

    public function create()
    {
        $data = [
            'no_identitas' => '',
            'nama' => '',
            'tempat_lahir' => '',
            'tanggal_lahir' => '',
            'jenis_kelamin' => '',
            'alamat' => '',
            'nomorIdentitasError' => '',
            'namaPendudukError' => '',
            'tempatLahirError' => '',
            'tanggalLahirError' => '',
            'jenisKelaminError' => '',
            'alamatError' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'user_id' => intval($_SESSION['user_id']),
                'no_identitas' => trim($_POST['no_identitas']),
                'nama' => trim($_POST['nama']),
                'tempat_lahir' => trim($_POST['tempat_lahir']),
                'tanggal_lahir' => date('Y-m-d H:i:s', strtotime($_POST['tanggal_lahir'])),
                // 'jenis_kelamin' => implode(',', $_POST['jenis_kelamin']),
                'jenis_kelamin' => [trim($_POST['jenis_kelamin'])],
                'alamat' => trim($_POST['alamat']),
                'nomorIdentitasError' => '',
                'namaPendudukError' => '',
                'tempatLahirError' => '',
                'tanggalLahirError' => '',
                'jenisKelaminError' => '',
                'alamatError' => '',
                'message' => '',
            ];

            // Validation
            if (empty($data['no_identitas'])) {
                $data['nomorIdentitasError'] = 'Nomor Identitas Mohon Diisi';
            }

            if (empty($data['nama'])) {
                $data['namaPendudukError'] = 'Nama Penduduk tidak boleh kosong';
            }

            if (empty($data['tempat_lahir'])) {
                $data['tempatLahirError'] = 'Tempat Lahir tidak boleh kosong';
            }

            // 1970-01-01 00:00:00 meaning empty
            if ($data['tanggal_lahir'] == '1970-01-01 00:00:00') {
                $data['tanggalLahirError'] = 'Tanggal Lahir tidak boleh kosong';
            }

            if (empty($data['jenis_kelamin'])) {
                $data['jenisKelaminError'] = 'Jenis Kelamin tidak boleh kosong';
            }

            if (empty($data['alamat'])) {
                $data['alamatError'] = 'Alamat tidak boleh kosong';
            }

            if ( empty($data['nomorIdentitasError']) && empty($data['namaPendudukError']) && empty($data['tempatLahirError'])
                && empty($data['tanggalLahirError']) && empty($data['jenisKelaminError']) && empty($data['alamatError'])) {

                    if ($this->residentModel->createResident($data)) {
                        $_SESSION['success'] = 'Data Penduduk Berhasil Ditambahkan';
                        header('location: '. URLROOT . '/residents');
                    } else {
                        die("Something went wrong, please try again");
                    }
                }
        }

        $this->view('residents/create', $data);
    }

    public function detail($id)
    {
        $resident = $this->residentModel->findResidentById($id);

        $data = [
            'resident' => $resident
        ];

        $this->view('residents/detail', $data);
    }

    public function edit($id)
    {
        $resident = $this->residentModel->findResidentById($id);

        $data = [
            'resident' => $resident,
            'user' => $_SESSION['user_id'],
            'no_identitas' => '',
            'nama' => '',
            'tempat_lahir' => '',
            'tanggal_lahir' => '',
            'jenis_kelamin' => '',
            'alamat' => '',
            'nomorIdentitasError' => '',
            'namaPendudukError' => '',
            'tempatLahirError' => '',
            'tanggalLahirError' => '',
            'jenisKelaminError' => '',
            'alamatError' => '',
        ];

        $this->view('residents/edit', $data);

    }

    public function update($id) 
    {
        $resident = $this->residentModel->findResidentById($id);

        $data = [
            'resident' => $resident,
            'user_id' => $_SESSION['user_id'],
            'no_identitas' => '',
            'nama' => '',
            'tempat_lahir' => '',
            'tanggal_lahir' => '',
            'jenis_kelamin' => '',
            'alamat' => '',
            'nomorIdentitasError' => '',
            'namaPendudukError' => '',
            'tempatLahirError' => '',
            'tanggalLahirError' => '',
            'jenisKelaminError' => '',
            'alamatError' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'resident' => $resident,
                'user_id' => $_SESSION['user_id'],
                'no_identitas' => trim($_POST['no_identitas']),
                'nama' => trim($_POST['nama']),
                'tempat_lahir' => trim($_POST['tempat_lahir']),
                'tanggal_lahir' => date('Y-m-d H:i:s', strtotime($_POST['tanggal_lahir'])),
                'jenis_kelamin' => implode(',', $_POST['jenis_kelamin']),
                'alamat' => trim($_POST['alamat']),
                'nomorIdentitasError' => '',
                'namaPendudukError' => '',
                'tempatLahirError' => '',
                'tanggalLahirError' => '',
                'jenisKelaminError' => '',
                'alamatError' => '',
                'message' => ''
            ];

            if (empty($data['no_identitas'])) {
                $data['nomorIdentitasError'] = 'No identitas tidak boleh kosong';
            }

            if (empty($data['nama'])) {
                $data['namaError'] = 'Nama tidak boleh kosong';
            }

            if (empty($data['tempat_lahir'])) {
                $data['tempatLahirError'] = 'Tempat Lahir tidak boleh kosong';
            }

            if (empty($data['tanggal_lahir'])) {
                $data['tanggalLahirError'] = 'Tanggal Lahir tidak boleh kosong';
            }

            if (empty($data['jenis_kelamin'])) {
                $data['jenisKelaminError'] = 'Jenis Kelamin tidak boleh kosong';
            }

            if (empty($data['alamat'])) {
                $data['alamatError'] = 'Alamat tidak boleh kosong';
            }

            if ( empty($data['nomorIdentitasError']) && empty($data['namaError']) && empty($data['tempatLahirError']) 
                && empty($data['tanggalLahirError']) && empty($data['jenisKelaminError']) 
                && empty($data['alamatError']) ) {

                    if ($this->residentModel->updateResident($data)) {
                        $_SESSION['status'] = "SUCCESS";
                        header('location: ' . URLROOT . '/residents');
                    } else {
                        die("Something went wrong, please try again");
                    }

                } else {
                    $this->view('residents/edit', $data);
                }
        }

        $this->view('residents/edit', $data);

    }

    public function delete($id)
    {
        $resident = $this->residentModel->findResidentById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($this->residentModel->deleteResident($id)) {
                header('location: ' . URLROOT . '/residents');
            } else {
                die('Something went wrong!');
            }
        }
    }
}

?>