<?php defined('BASEPATH') || exit('No direct script allowed');

class Strata_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'strata';
		$this->data['primary_key'] = 'id_strata';
	}
}

