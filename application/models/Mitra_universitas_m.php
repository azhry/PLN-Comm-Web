<?php defined('BASEPATH') || exit('No direct script allowed');

class Mitra_universitas_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'mitra_universitas';
		$this->data['primary_key'] = 'id_mitra';
	}
}

