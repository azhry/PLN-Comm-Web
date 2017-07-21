<?php defined('BASEPATH') || exit('No direct script allowed');

class Pengabdian_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'pengabdian';
		$this->data['primary_key'] = 'id_pengabdian';
	}
}

