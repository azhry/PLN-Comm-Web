<?php defined('BASEPATH') || exit('No direct script allowed');

class Toolkit_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['active_db'] 			= $this->db->database;
		$this->data['information_schema'] 	= 'information_schema';
	}

	public function get_all_tables()
	{
		$sql 	= 'SELECT TABLE_NAME FROM ' . $this->data['information_schema'] . '.TABLES WHERE TABLE_SCHEMA="' . $this->data['active_db'] . '"';
		$query 	= $this->db->query($sql);
		return $query->result();
	}

	public function check_table($table_name)
	{
		$this->load->library('user_agent');
		$platform = $this->agent->platform();
		if (strpos($platform, 'Windows') !== FALSE)		// windows case-insensitive, others don't
		{
			$this->db->select('TABLE_NAME');
			$this->db->from($this->data['information_schema'] . '.TABLES');
			$this->db->where('TABLE_NAME', $table_name);
			$this->db->where('TABLE_SCHEMA', $this->data['active_db']);
			$q = $this->db->get();
			$res = $q->result_array();
			foreach ($res as $row)
			{
				if (strtolower($row['TABLE_NAME']) == strtolower($table_name))
					return TRUE;
			}
			return FALSE;
		}

		$this->db->select('TABLE_NAME');
		$this->db->from($this->data['information_schema'] . '.TABLES');
		$this->db->where('TABLE_NAME', $table_name);
		$this->db->where('TABLE_SCHEMA', $this->data['active_db']);
		$query = $this->db->get()->result();

		if (isset($query) && count($query) > 0)
			return TRUE;
		return FALSE;
	}

	public function get_columns($table_name, $cond = '')
	{
		$this->db->select('COLUMN_NAME');
		$this->db->from($this->data['information_schema'] . '.COLUMNS');
		$this->db->where('TABLE_NAME', $table_name);
		$this->db->where('TABLE_SCHEMA', $this->data['active_db']);
		if (is_array($cond))
			$this->db->where($cond);
		if (is_string($cond) && strlen($cond) > 3)
			$this->db->where($cond);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_primary_key($table_name)
	{
		$sql = 'SELECT * FROM ' . $this->data['information_schema'] . '.COLUMNS WHERE TABLE_SCHEMA="' . $this->data['active_db'] . '" AND TABLE_NAME="' . $table_name . '" AND COLUMN_KEY="PRI"';
		$query = $this->db->query($sql);
		$result = $query->row();
		if (isset($result))
			return $result->COLUMN_NAME;
		else
		{
			$sql = 'SELECT * FROM ' . $this->data['information_schema'] . '.COLUMNS WHERE TABLE_SCHEMA="' . $this->data['active_db'] . '" AND TABLE_NAME="' . $table_name . '"';
			$query = $this->db->query($sql);
			$result = $query->row(); // assume first column as primary key
			return $result->COLUMN_NAME;
		}
	}

	public function check_auto_increment($table_name)
	{
		$sql = 'SELECT EXTRA FROM ' . $this->data['information_schema'] . '.COLUMNS WHERE TABLE_SCHEMA="' . $this->data['active_db'] . '" AND TABLE_NAME="' . $table_name . '" AND COLUMN_NAME="' . $this->get_primary_key($table_name) . '"';
		$query = $this->db->query($sql)->row();
		return $query->EXTRA == 'auto_increment';
	}
}
