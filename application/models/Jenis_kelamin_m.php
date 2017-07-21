<?php defined('BASEPATH') || exit('No direct script allowed');

class Jenis_kelamin_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'jenis_kelamin';
		$this->data['primary_key'] = 'id_jenis_kelamin';
	}
}

