<?php defined('BASEPATH') || exit('No direct script allowed');

class Sertifikasi_akreditasi_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'sertifikasi_akreditasi';
		$this->data['primary_key'] = 'id';
	}
}

