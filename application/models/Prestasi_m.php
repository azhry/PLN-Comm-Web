<?php defined('BASEPATH') || exit('No direct script allowed');

class Prestasi_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'prestasi';
		$this->data['primary_key'] = 'id';
	}
}

