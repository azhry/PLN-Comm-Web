<?php defined('BASEPATH') || exit('No direct script allowed');

class Riwayat_pendidikan_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'riwayat_pendidikan';
		$this->data['primary_key'] = 'id';
	}
}

