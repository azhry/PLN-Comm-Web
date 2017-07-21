<?php defined('BASEPATH') || exit('No direct script allowed');

class Penelitian_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'penelitian';
		$this->data['primary_key'] = 'id_penelitian';
	}
}

