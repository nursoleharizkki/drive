<?php defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		// check session data
		if ($this->session->userdata('user_id')) {
			// ALERT
			$alertStatus  = 'success';
			$alertMessage = 'Selamat Datang, ' . $this->session->userdata('user_fullname');
			getAlert($alertStatus, $alertMessage);
			redirect('admin/dashboard');
		} else {
			// DATA
			$data['setting'] = getSetting();

			// TEMPLATE
			$view         = "_backend/auth/login2";
			$viewCategory = "single";
			renderTemplate($data, $view, $viewCategory);
		}
	}


	public function validate()
	{
		// csrfValidate();
		if ($_POST) {
			// Get Token
			
				$input_data = array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://upbuhaluoleo.test-web.my.id/api/login_account');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

				// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				// 	'Access-Token: ' . $token->access_token
				// ));

				curl_setopt($ch, CURLOPT_POST, count($input_data));
				curl_setopt($ch, CURLOPT_POSTFIELDS, $input_data);
                
                // if (curl_exec($ch) === false) {
                    // echo "ok";
                    $curl = curl_exec($ch);
            //         if (curl_errno($ch)) {
            //             $error_msg = curl_error($ch);
            //             	$alertStatus  = 'failed';
        				// 	getAlert($alertStatus, $error_msg);
        				// 	redirect('auth');
            //         }
                    
                    $response = (array) json_decode($curl);
                    if (!empty($response['data'])) {
    					$result = (array) $response['data'];
    					// SESSION DATA
    					$data = array(
    						'user_id'         => $result['user_id'],
    						'user_name'       => $result['user_name'],
    						'user_fullname'   => $result['user_fullname'],
    						'user_photo'      => $result['user_photo'],
    						'user_group'      => $result['group_id'],
    						'user_nip'      => $result['user_nip'],
    						'sess_rowpage'    => 10,
    						'IsAuthorized'    => true
    					);
    					$this->session->set_userdata($data);
    
    					redirect('admin/dashboard');
    				} else {
    					// ALERT
    					$alertStatus  = 'failed';
    					$alertMessage = 'Akun Tidak Valid';
    					getAlert($alertStatus, $alertMessage);
    					redirect('auth');
    				}
    //             } else {
    //                 // ALERT
				// 	$alertStatus  = 'failed';
				// 	$alertMessage = 'Akun Tidak Valid';
				// 	getAlert($alertStatus, $alertMessage);
				// 	redirect('auth');
    //             }
                
				

				curl_close($ch);
			

				
			}
		
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}
