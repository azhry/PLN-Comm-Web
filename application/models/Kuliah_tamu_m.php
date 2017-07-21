<?php defined('BASEPATH') || exit('No direct script allowed');

class Kuliah_tamu_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'kuliah_tamu';
		$this->data['primary_key'] = 'id_kuliah';
	}
}

