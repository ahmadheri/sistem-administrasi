<?php
class Home extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->reportModel = $this->model('Report');
        $this->residentModel = $this->model('Resident');
    }

    public function index()
    {
        $userCount = $this->userModel->countUser();
        $reportCount = $this->reportModel->countReport();
        $residentCount = $this->residentModel->countResident();
        $totalReportsIn = $this->reportModel->countReportStatusMasuk();
        $totalReportsOnProcess = $this->reportModel->countReportStatusProses();
        $totalReportsDone = $this->reportModel->countReportStatusSelesai();
        $totalReportsCancel = $this->reportModel->countReportStatusCancel();

        $data = [
            'userCount' => $userCount,
            'reportCount' => $reportCount,
            'residentCount' => $residentCount,
            'totalReportsIn' => $totalReportsIn,
            'totalReportsOnProcess' => $totalReportsOnProcess,
            'totalReportsDone' => $totalReportsDone,
            'totalReportsCancel' => $totalReportsCancel
        ];

        $this->view('home', $data);
    }
}
