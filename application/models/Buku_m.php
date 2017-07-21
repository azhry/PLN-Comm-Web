<?php defined('BASEPATH') || exit('No direct script allowed');

class Buku_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'buku';
		$this->data['primary_key'] = 'id_buku';
	}
}

