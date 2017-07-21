<?php defined('BASEPATH') || exit('No direct script allowed');

class Jabatan_fungsional_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'jabatan_fungsional';
		$this->data['primary_key'] = 'id_jabatan';
	}
}

