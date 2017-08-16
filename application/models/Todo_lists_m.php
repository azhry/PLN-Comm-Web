<?php defined('BASEPATH') || exit('No direct script allowed');

class Todo_lists_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'todo_lists';
		$this->data['primary_key'] = 'LIST_ID';
	}
}

