<?php defined('BASEPATH') || exit('No direct script allowed');

class Penghargaan_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'penghargaan';
		$this->data['primary_key'] = 'id_penghargaan';
	}
}

