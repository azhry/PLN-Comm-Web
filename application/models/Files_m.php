<?php defined('BASEPATH') || exit('No direct script allowed');

class Files_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'files';
		$this->data['primary_key'] = 'FILE_ID';
	}
}

