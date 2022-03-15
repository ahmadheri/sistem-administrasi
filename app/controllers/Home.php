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
        $totalReportsOnProcess1 = $this->reportModel->countReportStatusProses1();
        $totalReportsOnProcess2 = $this->reportModel->countReportStatusProses2();
        $totalReportsDone = $this->reportModel->countReportStatusSelesai();
        $totalReportsCancel = $this->reportModel->countReportStatusCancel();

        $data = [
            'userCount' => $userCount,
            'reportCount' => $reportCount,
            'residentCount' => $residentCount,
            'totalReportsIn' => $totalReportsIn,
            'totalReportsOnProcess1' => $totalReportsOnProcess1,
            'totalReportsOnProcess2' => $totalReportsOnProcess2,
            'totalReportsDone' => $totalReportsDone,
            'totalReportsCancel' => $totalReportsCancel
        ];

        $this->view('home', $data);
    }
}
