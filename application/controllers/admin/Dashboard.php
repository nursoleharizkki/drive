<?php defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// check session data
		if (!$this->session->userdata('user_id')) {
			// ALERT
			$alertStatus  = 'failed';
			$alertMessage = 'Anda tidak memiliki Hak Akses atau Session anda sudah habis';
			getAlert($alertStatus, $alertMessage);
			redirect('auth');
		}
	}

	public function index()
	{

			// DATA
			$data['setting'] = getSetting();
			if ($this->session->userdata('user_group') == 1 or $this->session->userdata('user_group') == 2) {
				$url = "https://upbuhaluoleo.test-web.my.id/api/get_widget";
			} else {
				$url = "https://upbuhaluoleo.test-web.my.id/api/get_widget_pegawai?nip=" . $this->session->userdata('user_nip');
			}
			$get_url = file_get_contents($url, false);
			$data['widget'] = json_decode($get_url);
			// print_r($data['widget']);
			// die;
			// $data['widget']  = $this->m_content->widget();

			// TEMPLATE
			$view = "_backend/dashboard";
			$viewCategory = "all";
			renderTemplate($data, $view, $viewCategory);
		
	}
}
