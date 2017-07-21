<?php defined('BASEPATH') || exit('No direct script allowed');

class Hki_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'hki';
		$this->data['primary_key'] = 'id_hki';
	}
}

