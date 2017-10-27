<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	private $msg;

	public function __construct() {
        parent::__construct();
        $this->msg = '';
    }

	public function index()
	{
		if($this->session->userdata('user_id')){

			$this->load->model('usuarios');
			$user = $this->usuarios->get_user($this->session->userdata('user_id'));

			if($user){
				$this->session->set_userdata('logged',true);
				redirect('Dashboard');
			}else{
				$this->logout();
				$this->load->view('login');
			}
		}else
			$this->load->view('login');
	}

	public function login(){

		if(count($this->input->post()) <= 0){
			redirect('welcome');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('login', 'Login', 'required');
		$this->form_validation->set_rules('senha', 'Senha', 'required|callback_cb_valid_user['.$this->input->post('login').']');

		$this->form_validation->set_message('required', 'Field %s is riquired.');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

		if ($this->form_validation->run() == FALSE)
		{
			echo json_encode(array('status' => 0, 'msg' => validation_errors()));
		}else{
			echo json_encode(array('status' => 1, 'msg' => '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Login successful</div>'));
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('welcome');
	}

	public function new_user_view(){
		$this->load->view('new_user');
	}

	public function new_user(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nome', 'Name', 'required');
		$this->form_validation->set_rules('login', 'Login', 'required|callback_cb_valid_login');
		$this->form_validation->set_rules('pass', 'Password', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		$this->form_validation->set_message('required', 'Field %s is riquired.');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

		if ($this->form_validation->run() == FALSE)
		{
			echo json_encode(array('status' => 0, 'msg' => validation_errors()));
		}else{
			echo json_encode(array('status' => 1, 'msg' => '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Create successful</div>'));
		}
	}

	public function cb_valid_login($user){
		if(!empty($user)){
				$this->load->model('usuarios');
				$user_id = $this->usuarios->valid_login($user);

				if(!$user_id){
					$user = $this->usuarios->insert_user();
					if($user){
						return true;
					}else{
						$this->form_validation->set_message('cb_valid_login', 'Unexpected error, please try again.');
						return false;
					}
				}else{
					$this->form_validation->set_message('cb_valid_login', 'Username alredy in use.');
					return false;
				}
		}
	}

	public function cb_valid_user($pass, $user){
		if(!empty($user) && !empty($pass)){
			if (!$this->cb_valid_ip()) {
				$this->load->model('usuarios');
				$user_id = $this->usuarios->valid_user($user, $pass);

				if($user_id){
					$this->session->set_userdata('user_id', $user_id['id_user']);
					$this->session->set_userdata('nome', $user_id['nome']);
					$this->session->set_userdata('login', $user);
					
					$ip = $this->cb_client_ip();
					$this->load->model('block_ip');
					$row = $this->block_ip->get_ip($ip);
					(is_array($row))? $this->block_ip->delete_ip($row['ip']) : '';

					return true;
				}else{
					$this->form_validation->set_message('cb_valid_user', 'User or pass invalid. '. $this->msg);
					return false;
				}
			}else
				return false;
		}
	}

	private function cb_valid_ip(){
		$ip = $this->cb_client_ip();
		$this->load->model('block_ip');
		$row = $this->block_ip->get_ip($ip);
		if (!is_array($row)) {
			$this->msg = 'You have more 2 attemps.';
			$this->form_validation->set_message('cb_valid_user', $this->msg);
			return false;
		}elseif($row['attemps'] == 3){
			$min = ceil((strtotime($row['dt_allow']) - time()) / 60);
			if($min <= 0){
				$this->block_ip->delete_ip($row['ip']);
				$this->msg = '';
				return false;
			}
			$this->msg = 'You have exceeded your attempts. Wait '.$min.' minutes.';
			$this->form_validation->set_message('cb_valid_user', $this->msg);
			return true;
		}else{
			$this->block_ip->update_ip($row['ip']);
			$this->msg = 'You have more '.(3 - (++$row['attemps'])).' attemps.';
			$this->form_validation->set_message('cb_valid_user', $this->msg);
			return false;
		}
	}

	private function cb_client_ip() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}
}
