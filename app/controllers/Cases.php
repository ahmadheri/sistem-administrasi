<?php 

class Cases extends Controller
{
    public function __construct()
    {
        $this->kasusModel = $this->model('Kasus');
    }

    public function index()
    {
        $kasus = $this->kasusModel->getAllCases();

        $data = [
            'kasus' => $kasus
        ];

        $this->view('kasus/index', $data);
    }
}

?>