<?php defined('BASEPATH') || exit('No direct script allowed');

class Publikasi_artikel_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'publikasi_artikel';
		$this->data['primary_key'] = 'id_publikasi';
	}
}

