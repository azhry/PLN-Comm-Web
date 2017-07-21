<?php defined('BASEPATH') || exit('No direct script allowed');

class Buku extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Buku_m');
	}

	public function index()
	{
		if ($this->POST('insert'))
		{
			$this->data['entry'] = [
				"id_buku" => $this->POST("id_buku"),
				"id_user" => $this->POST("id_user"),
				"judul_buku" => $this->POST("judul_buku"),
				"tahun_terbit" => $this->POST("tahun_terbit"),
				"jumlah_hal" => $this->POST("jumlah_hal"),
				"penerbit" => $this->POST("penerbit"),
			];
			$this->Buku_m->insert($this->data['entry']);
			redirect('buku');
			exit;
		}
		
		if ($this->POST('delete') && $this->POST('id_buku'))
		{
			$this->Buku_m->delete($this->POST('id_buku'));
			exit;
		}
				
		if ($this->POST('edit') && $this->POST('edit_id_buku'))
		{
			$this->data['entry'] = [
				"id_buku" => $this->POST("id_buku"),
				"id_user" => $this->POST("id_user"),
				"judul_buku" => $this->POST("judul_buku"),
				"tahun_terbit" => $this->POST("tahun_terbit"),
				"jumlah_hal" => $this->POST("jumlah_hal"),
				"penerbit" => $this->POST("penerbit"),
			];
			$this->Buku_m->update($this->POST('edit_id_buku'), $this->data['entry']);
			redirect('buku');
			exit;
		}

		if ($this->POST('get') && $this->POST('id_buku'))
		{
			$this->data['buku'] = $this->Buku_m->get_row(['id_buku' => $this->POST('id_buku')]);
			echo json_encode($this->data['buku']);
			exit;
		}
				
		$this->data['data']		= $this->Buku_m->get();
		$this->data['columns']	= ["id_buku","id_user","judul_buku","tahun_terbit","jumlah_hal","penerbit",];
		$this->data['title'] 	= 'Title';
		$this->data['content'] 	= 'buku_all';
		$this->template($this->data, "material-design");
	}


	public function detail_buku()
	{
		$this->data['id_buku'] = $this->uri->segment(3);
		if (!isset($this->data['id_buku']))
		{
			redirect('buku');
			exit;
		}

		$this->data['columns']	= ["id_buku","id_user","judul_buku","tahun_terbit","jumlah_hal","penerbit",];
		$this->data['data'] = $this->Buku_m->get_row(['id_buku' => $this->data['id_buku']]);
		$this->data['title'] 	= 'Title';
		$this->data['content'] 	= 'buku_detail';
		$this->template($this->data, "material-design");
	}


}