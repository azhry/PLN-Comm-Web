<?php defined('BASEPATH') || exit('No direct script allowed');

class Dosen_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'dosen';
		$this->data['primary_key'] = 'NIP';
	}
}

