<?php
class Pages extends Controller
{
    public function __construct()
    {
        $this->pageModel = $this->model('Page');
    }

    // public function index()
    // {
    //     $this->view('pages/index');
    // }

    // public function about()
    // {
    //     $this->view('pages/about');
    // }
}
