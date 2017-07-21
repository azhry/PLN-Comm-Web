<?php defined('BASEPATH') || exit('No direct script allowed');

class Sarana_prasarana_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'sarana_prasarana';
		$this->data['primary_key'] = 'id_sarana';
	}
}

