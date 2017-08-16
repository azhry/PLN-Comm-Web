<?php defined('BASEPATH') || exit('No direct script allowed');

class List_access_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'list_access';
		$this->data['primary_key'] = 'USER_ID';
	}
}

