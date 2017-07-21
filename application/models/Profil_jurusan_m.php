<?php defined('BASEPATH') || exit('No direct script allowed');

class Profil_jurusan_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'profil_jurusan';
		$this->data['primary_key'] = 'id_jenis';
	}
}

