<?php defined('BASEPATH') || exit('No direct script allowed');

class Todo_items_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'todo_items';
		$this->data['primary_key'] = 'TODO_ID';
	}
}

