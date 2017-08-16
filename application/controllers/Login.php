<?php defined('BASEPATH') || exit('No direct script allowed');

class Login extends MY_Controller
{
	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['user_id'] = $this->session->userdata('user_id');
		if (isset($this->data['user_id']))
		{
			redirect('user');
			exit;
		}
		
	}

	public function index()
	{
		if ($this->_check_authentication())
		{
			redirect('user');
			exit;
		}

		$this->load->view('login');
	}

	private function _check_authentication()
	{
		if ($this->POST('login'))
		{
			$this->load->model('users_m');
			$email 		= $this->POST('email');
			$password	= md5($this->POST('password'));

			$this->data['user'] = $this->users_m->get_row([
				'EMAIL' 	=> $email, 
				'PASSWORD' 	=> $password
			]);

			if (isset($this->data['user']))
			{
				$user_session = [
					'user_id'	=> $this->data['user']->USER_ID,
					'email'		=> $this->data['user']->EMAIL,
					'name'		=> $this->data['user']->NAME,
					'conn_id'	=> $this->data['user']->CONNECTION_ID
				];
				$this->session->set_userdata($user_session);
				return TRUE;
			}
		}

		return FALSE;
	}
}