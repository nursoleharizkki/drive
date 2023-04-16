<?php
defined('BASEPATH') or exit('No direct script access allowed');
class gallery extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
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

            //DATA
            $data['setting'] = getSetting();
            $data['title'] = 'file';
            if ($this->session->userdata('user_group') == 1 or $this->session->userdata('user_group') == 2) {
                $url = "https://upbuhaluoleo.test-web.my.id/api/get_gallery";
            } else {
                $url = "https://upbuhaluoleo.test-web.my.id/api/get_gallery_pegawai?nip=" . $this->session->userdata('user_nip');
            }

            $get_url = file_get_contents($url, false);
            $data['gallery'] = json_decode($get_url);
            // echo '<pre>';
            // print_r(($data['gallery']));
            // echo '</pre>';
            // die;
            // TEMPLATE
            $view = "_backend/gallery";
            $viewCategory = "all";
            renderTemplate($data, $view, $viewCategory);
        
    }

    public function pegawai()
    {
            //DATA
            $data['setting'] = getSetting();
            $data['title'] = 'file';

            $url = "https://upbuhaluoleo.test-web.my.id/api/get_gallery_pegawai?nip=" . $this->uri->segment(4);

            $get_url = file_get_contents($url, false);
            $data['gallery'] = json_decode($get_url);
            // TEMPLATE
            $view = "_backend/gallery_pegawai";
            $viewCategory = "all";
            renderTemplate($data, $view, $viewCategory);
        
    }
}
