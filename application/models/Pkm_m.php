<?php defined('BASEPATH') || exit('No direct script allowed');

class Pkm_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'pkm';
		$this->data['primary_key'] = 'id_pkm';
	}
}

