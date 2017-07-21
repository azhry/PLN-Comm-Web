<?php defined('BASEPATH') || exit('No direct script allowed');

class Pemakalah_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'pemakalah';
		$this->data['primary_key'] = 'id_pemakalah';
	}
}

