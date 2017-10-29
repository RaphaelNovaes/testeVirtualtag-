<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
	
	public function __construct() {
        parent::__construct();
    }

    public function index(){
    	if(!$this->session->userdata('logged')){
			redirect('welcome');
		}else{
			$this->carrega_dashboard();
		}	
    }

	protected function carrega_dashboard(){
		$this->load->view('dashboard');
	}

	public function change_pass_view(){
		$this->load->view('change_pass');
	}

	public function change_img_view(){
		$this->load->view('change_img');
	}

	public function main_view(){
		$this->load->view('main');
	}

	public function valid_img(){

		$config['file_name']            = $this->session->userdata('login').'_'.$this->session->userdata('user_id');
		$config['overwrite']            = true;
		$config['upload_path']          = 'includes/imgs';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1024;
        $config['max_width']            = 800;
        $config['max_height']           = 800;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());

            echo json_encode(array('status' => 0, 'data' => $error));
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            echo json_encode(array('status' => 1, 'data' => '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Change Sucessful.</div>'));
        }
	}

	public function change_pass(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('pass_old', 'Old Password', 'required|callback_cb_valid_pass['.$this->session->userdata('login').']');
		$this->form_validation->set_rules('new_pass', 'New Password', 'required');

		$this->form_validation->set_message('required', 'Field %s is required.');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');

		if ($this->form_validation->run() == FALSE)
		{
			echo json_encode(array('status' => 0, 'msg' => validation_errors()));
		}else{
			$this->load->model('usuarios');
			$user = $this->usuarios->get_user($this->session->userdata('id_user'));
			$return =  $this->usuarios->change_pass($this->session->userdata('login'), $this->input->post('new_pass'));
			if($return){
				$response = $this->sendEmail($user['email']);
				if($response){
					$msg = 'Login successful';
					$alert = 'success';
				}else{
					$msg = 'Your password has changed, but there was an error sending email.';
					$alert = 'danger';
				}
			}else{
				$msg = 'Unexpected error, please try again.';
				$alert = 'danger';
			}

			echo json_encode(array('status' => 1, 'msg' => '<div class="alert alert-'.$alert.'"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>'));
		}
	}

	public function cb_valid_pass($pass, $login){
		if(!empty($login) && !empty($pass)){
			$this->load->model('usuarios');
			$user_id = $this->usuarios->valid_user($login, $pass);

			if($user_id){
				return true;
			}else{
				$this->form_validation->set_message('cb_valid_pass', 'Pass invalid. ');
				return false;
			}
		}
		$this->form_validation->set_message('cb_valid_pass', 'Field %s is required. ');
		return false;
	}

	public function sendEmail($email){
		$this->load->library('email');

		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'Email';
		$config['smtp_pass'] = 'senha';
		$config['protocol']  = 'smtp';
		$config['validate']  = TRUE;
		$config['mailtype']  = 'html';
		$config['charset']   = 'utf-8';
		$config['newline']   = "\r\n";

		$this->email->initialize($config);

		$this->email->from('raphaelnovaess@gmail.com', 'Raphael');
		$this->email->to($email);

		$this->email->subject('Change Password');
		$this->email->message('Your password has been changed');

		$this->email->send();

		$error = $this->email->print_debugger();
	}

	public function products_view(){
		$this->load->view('products');
	}

	public function definitions_view(){
		$this->load->view('definitions');
	}

	public function read_cvs(){
		$row = 1;
		if (($handle = fopen("includes/product-list.csv", "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			    $num = count($data);
			    for ($c=0; $c < $num; $c++) {
			    	if($row == 1){
			        	$columns[$c] = $data[$c];
			    	}else{
			        	$rows[$row-1][$columns[$c]] = $data[$c]; 
			    	}
			    } 
			    $row++;
			}
			fclose($handle);
		}
		$this->load->model('products');
		$this->products->insert_products($rows);
	}

	public function get_products(){
		$this->load->model('products');
		$data['data'] = $this->products->get_products();
		echo json_encode($data);
	}

	public function get_last_product(){
		$this->load->model('products');
		$data = $this->products->get_last_product();
		echo json_encode($data);
	}

	public function put_product(){
		$this->load->model('products');
		$this->products->put_product();
	}

	public function del_product(){
		$this->load->model('products');
		$this->products->del_product();
	}

	public function post_product(){
		$this->load->model('products');
		$this->products->post_product();
	}
}
