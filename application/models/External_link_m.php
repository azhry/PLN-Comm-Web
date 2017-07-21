<?php defined('BASEPATH') || exit('No direct script allowed');

class External_link_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'external_link';
		$this->data['primary_key'] = 'id';
	}
}

