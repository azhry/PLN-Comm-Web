<?php defined('BASEPATH') || exit('No direct script allowed');

class Controllermu extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Permintaan_bahan_baku_m');
	}

	public function index()
	{
		if ($this->POST('insert'))
		{
			$this->data['entry'] = [
				"id_permintaan" => $this->POST("id_permintaan"),
				"id_unit" => $this->POST("id_unit"),
				"tanggal_permintaan" => $this->POST("tanggal_permintaan"),
				"batas_waktu" => $this->POST("batas_waktu"),
				"keterangan" => $this->POST("keterangan"),
				"approved" => $this->POST("approved"),
				"nama" => $this->POST("nama"),
			];

			$this->Permintaan_bahan_baku_m->insert($this->data['entry']);
			redirect('controllermu');
			exit;
		}
		
		if ($this->POST('delete') && $this->POST('id_permintaan'))
		{
			$this->Permintaan_bahan_baku_m->delete($this->POST('id_permintaan'));
			exit;
		}
		
		if ($this->POST('edit') && $this->POST('id_permintaan'))
		{
			$this->data['entry'] = [
				"id_permintaan" => $this->POST("id_permintaan"),
				"id_unit" => $this->POST("id_unit"),
				"tanggal_permintaan" => $this->POST("tanggal_permintaan"),
				"batas_waktu" => $this->POST("batas_waktu"),
				"keterangan" => $this->POST("keterangan"),
				"approved" => $this->POST("approved"),
				"nama" => $this->POST("nama"),
			];

			$this->Permintaan_bahan_baku_m->update($this->POST('id_permintaan'), $this->data['entry']);
			redirect('controllermu');
			exit;
		}
		
		$this->data['data']		= $this->Permintaan_bahan_baku_m->get();
		$this->data['columns']	= ["id_permintaan","id_unit","tanggal_permintaan","batas_waktu","keterangan","approved","nama",];
		$this->data['title'] 	= 'Title';
		$this->data['content'] 	= 'permintaan_bahan_baku_all';
		$this->template($this->data);
	}
}