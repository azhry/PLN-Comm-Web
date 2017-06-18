<?php defined('BASEPATH') || exit('No direct script allowed');

class Controllerku extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Bahan_baku_m');
	}

	public function index()
	{
		$this->data['data']		= $this->Bahan_baku_m->get();
		$this->data['columns']	= ["id_bahan_baku","id_suplier","nama_bahan","jenis_bahan","stok","satuan","harga","tanggal",];
		$this->data['title'] 	= 'Title';
		$this->data['content'] 	= 'bahan_baku_all';
		$this->template($this->data);
	}
}

