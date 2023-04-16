<?php
defined('BASEPATH') or exit('No direct script access allowed');
class pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            // ALERT
            $alertStatus  = 'failed';
            $alertMessage = 'Anda tidak memiliki Hak Akses atau Session anda sudah habis';
            getAlert($alertStatus, $alertMessage);
            redirect('admin/dashboard');
        }
    }

    public function index()
    {
        // API DATA PEGAWAI
        $url = "https://upbuhaluoleo.test-web.my.id/api/get_pegawai";
        $get_url = file_get_contents($url, false);
        $data['pegawai'] = json_decode($get_url);
        
        $data['setting'] = getSetting();
        $data['title'] = 'pegawai';
        
        // TEMPLATE
        $view = "_backend/pegawai";
        $viewCategory = "all";
        renderTemplate($data, $view, $viewCategory);
        
    }
}
