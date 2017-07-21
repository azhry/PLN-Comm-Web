<?php defined('BASEPATH') || exit('No direct script allowed');

class Kebijakan_publik_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'kebijakan_publik';
		$this->data['primary_key'] = 'id_kebijakan';
	}
}

