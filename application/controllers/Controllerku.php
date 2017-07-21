<?php defined('BASEPATH') || exit('No direct script allowed');

class Controllerku extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Buku_m');
	}

	public function index()
	{
		
				
				
		$this->data['data']		= $this->Buku_m->get();
		$this->data['columns']	= ["id_buku","id_user","judul_buku","tahun_terbit","jumlah_hal","penerbit",];
		$this->data['title'] 	= 'Title';
		$this->data['content'] 	= 'buku_all';
		$this->template($this->data, "material-design");
	}


}