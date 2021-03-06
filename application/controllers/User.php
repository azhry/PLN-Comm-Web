<?php defined('BASEPATH') || exit('No direct script allowed');

class User extends MY_Controller
{
	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['user_id'] = $this->session->userdata('user_id');
		if (!isset($this->data['user_id']))
		{
			redirect('login');
			exit;
		}
	}

	public function index()
	{
		$this->_mark_as_completed();
		$this->_quick_add_task();
		$this->_get_task_details();

		if ($action = $this->input->get('action'))
		{
			if ($action == 'get_list_members')
			{
				$this->_get_list_member();
			}
			else if ($action == 'get_todo_files')
			{
				$this->_get_todo_files();
			}
			exit;
		}

		if ($this->input->get('user_id'))
		{
			$this->_get_user();
			exit;
		}

		if ($this->POST('action'))
		{
			$this->_upload_file();
			exit;
		}

		if ($this->POST('get_task'))
		{
			$this->_get_task();
			exit;
		}

		if ($this->_delete_list())
		{
			// alert delete success
			$this->flashmsg('List deletion success!');
			redirect('user');
			exit;
		}


		if ($this->_create_list())
		{
			// alert create success
			$this->flashmsg('List creation success!');
			redirect('user');
			exit;
		}

		if ($this->_edit_list())
		{
			// alert edit success
			$this->flashmsg('List edit success!');
			redirect('user');
			exit;
		}

		if ($this->_share_list())
		{
			// alert share success
			$this->flashmsg('Share list success!');
			redirect('user');
			exit;
		}

		if ($this->POST('update_task'))
		{
			$this->_update_task();
			exit;
		}

		$this->load->model('todo_lists_m');
		$this->load->model('list_access_m');
		$this->load->model('todo_items_m');
		$this->load->model('users_m');
		$this->data['list_access']	= $this->list_access_m->get(['USER_ID' => $this->data['user_id']]);
		if (isset($this->data['list_access']))
		{
			$this->data['first_list'] = $this->data['list_access'][0];
			$this->data['first_list_item_ongoing'] = $this->todo_items_m->get(['LIST_ID' => $this->data['first_list']->LIST_ID, 'IS_COMPLETED' => 0]);
			$this->data['first_list_item_completed'] = $this->todo_items_m->get(['LIST_ID' => $this->data['first_list']->LIST_ID, 'IS_COMPLETED' => 1]);
		}
		$this->data['title'] 		= 'To-do List | ' . $this->title;
		$this->data['nav_title']	= $this->session->userdata('name');
		$this->data['content']		= 'todo_list';
		$this->template($this->data);
	}

	private function _upload_file()
	{
		if ($this->POST('action'))
		{
			$action = $this->POST('action');
			if ($action == 'upload_file')
			{
				$this->load->model('files_m');
				do
				{
					$file_id = mt_rand();
					$is_duplicate = $this->files_m->get_row(['FILE_ID' => $file_id]);
				}
				while ($is_duplicate);
				$file_name	= basename($_FILES['uploaded_file']['name']);
				$this->files_m->insert([
					'FILE_ID' 	=> $file_id,
					'TODO_ID'	=> $this->POST('todo_id'),
					'FILENAME'	=> $file_id . '-' . $file_name
				]);
				$this->upload_any_type($file_id . '-' . $file_name, 'uploads', 'uploaded_file');
				echo $file_id . '-' . $file_name;
				exit;
			}
		}
	}

	private function _get_todo_files()
	{
		$this->data['todo_id'] = $this->input->get('TODO_ID');
		if (!isset($this->data['todo_id']))
		{
			echo json_encode([]);
			exit;
		}

		$this->load->model('files_m');
		$this->data['files'] = $this->files_m->get(['TODO_ID' => $this->data['todo_id']]);
		echo json_encode($this->data['files']);
		exit;
	}

	private function _get_list_member()
	{
		$this->data['list_id'] = $this->input->get('LIST_ID');
		if (!isset($this->data['list_id']))
		{
			echo json_encode([]);
			exit;
		}

		$this->load->model('users_m');
		$this->load->model('todo_lists_m');
		$this->load->model('list_access_m');
		$this->data['list']			= $this->todo_lists_m->get_row(['LIST_ID' => $this->data['list_id']]);
		if (!isset($this->data['list']))
		{
			echo json_encode([]);
			exit;
		}
		$this->data['members']		= $this->list_access_m->get(['LIST_ID' => $this->data['list_id']]);
		$this->data['result']['list_name']	= $this->data['list']->LIST_NAME;
		$this->data['result']['members']	= [];
		foreach ($this->data['members'] as $member)
		{
			$user = $this->users_m->get_row(['USER_ID' => $member->USER_ID]);
			$this->data['result']['members']	[]= [
				'name'	=> $user->NAME,
				'email'	=> $user->EMAIL
			];
		}
		echo json_encode($this->data['result']);
		exit;
	}

	private function _create_list()
	{
		if ($this->POST('create_list'))
		{
			$this->load->model('todo_lists_m');
			$this->load->model('list_access_m');

			$data = [];
			
			do
			{
				$data['LIST_ID'] = mt_rand();
				$is_duplicate = $this->todo_lists_m->get_row(['LIST_ID' => $data['LIST_ID']]);
			}
			while ($is_duplicate);

			$list_id = $data['LIST_ID'];
			$data['LIST_NAME'] = $this->POST('list_name');
			$this->todo_lists_m->insert($data);

			$data = [];
			$data['LIST_ID'] 		= $list_id;
			$data['USER_ID']		= $this->session->userdata('user_id');
			$data['ACCESS_TYPE']	= 0;
			$this->list_access_m->insert($data);

			return TRUE;
		}

		return FALSE;
	}

	private function _edit_list()
	{
		if ($this->POST('edit_list'))
		{
			$this->load->model('todo_lists_m');
			$list_id 	= $this->POST('list_id');
			$list_name 	= $this->POST('list_name');
			$this->todo_lists_m->update($list_id, ['LIST_NAME' => $list_name]);
			return TRUE;
		}

		return FALSE;
	}

	private function _delete_list()
	{
		if ($this->POST('delete_list'))
		{
			$this->load->model('todo_lists_m');
			$this->load->model('list_access_m');
			$this->load->model('todo_items_m');
			$this->load->model('files_m');
			$data['LIST_ID'] = $this->POST('list_id');
			$todo_items = $this->todo_items_m->get(['LIST_ID' => $data['LIST_ID']]);
			foreach ($todo_items as $item)
			{
				$this->files_m->delete_by(['TODO_ID' => $item->TODO_ID]);
			}
			$this->todo_items_m->delete_by(['LIST_ID' => $data['LIST_ID']]);
			$this->list_access_m->delete_by(['LIST_ID' => $data['LIST_ID']]);
			$this->todo_lists_m->delete($data['LIST_ID']);
			return TRUE;
		}

		return FALSE;
	}

	private function _quick_add_task()
	{
		if ($this->POST('quick_add'))
		{
			$this->load->model('todo_items_m');

			$data = [];
			do
			{
				$data['TODO_ID'] = mt_rand();
				$is_duplicate = $this->todo_items_m->get_row(['TODO_ID' => $data['TODO_ID']]);
			}
			while ($is_duplicate);

			$data['LIST_ID'] 		= $this->POST('list_id');
			$data['ITEM_DESC']		= $this->POST('item_desc');
			$data['IS_COMPLETED']	= 0;
			$this->todo_items_m->insert($data);

			$response['status'] = 0;
			$response['ongoing'] = $this->todo_items_m->get([
				'LIST_ID' 		=> $data['LIST_ID'], 
				'IS_COMPLETED'	=> 0
			]);
			$response['list_id'] = $data['LIST_ID'];
			echo json_encode($response);

			exit;
		}
	}

	private function _add_task()
	{
		if ($this->POST('add'))
		{
			$this->load->model('todo_items_m');

			$data = [];
			do
			{
				$data['TODO_ID'] = mt_rand();
				$is_duplicate = $this->todo_items_m->get_row(['TODO_ID' => $data['TODO_ID']]);
			}
			while ($is_duplicate);

			$data['LIST_ID'] 		= $this->POST('list_id');
			$data['ITEM_DESC']		= $this->POST('item_desc');
			$data['DUE_DATE']		= $this->POST('due_date');
			$data['NOTE']			= $this->POST('note');
			$data['IS_COMPLETED']	= 0;
			$this->todo_items_m->insert($data);

			return TRUE;
		}

		return FALSE;	
	}

	private function _share_list()
	{
		if ($this->POST('share'))
		{
			$this->load->model('users_m');
			$this->load->model('list_access_m');

			$user = $this->users_m->get_row(['EMAIL' => $this->POST('email')]);
			if (!isset($user))
			{
				return FALSE;
			}
			
			$data = [];
			$data['USER_ID']		= $user->USER_ID;
			$data['LIST_ID']		= $this->POST('list_id');
			$data['ACCESS_TYPE']	= 1;

			$this->list_access_m->insert($data);

			return TRUE;
		}

		return FALSE;
	}

	private function _assign_task()
	{
		if ($this->POST('assign'))
		{
			$this->load->model('list_access_m');

			$data['ASSIGNED_USER_ID']	= $this->POST('user_id');
			
			$this->list_access_m->update($this->POST('todo_id'), $data);			

			return TRUE;
		}

		return FALSE;
	}

	private function _get_task()
	{
		if ($this->POST('get_task'))
		{
			$data['list_id'] = $this->POST('list_id');
			if (!isset($data['list_id']))
			{
				echo json_encode(['aaaa']);
				return FALSE;
			}

			$this->load->model('todo_items_m');
			$data['ongoing'] = $this->todo_items_m->get(['LIST_ID' => $data['list_id'], 'IS_COMPLETED' => 0]);
			$data['completed'] = $this->todo_items_m->get(['LIST_ID' => $data['list_id'], 'IS_COMPLETED' => 1]);
			echo json_encode($data);
			return TRUE;
		}
	}

	private function _get_task_details()
	{
		if ($this->POST('get_task_details'))
		{
			$this->load->model('todo_items_m');
			$this->load->model('list_access_m');
			$this->load->model('users_m');
			$data['TODO_ID'] = $this->POST('todo_id');
			$data['LIST_ID'] = $this->POST('list_id');
			$data['todo'] 	= $this->todo_items_m->get_row(['TODO_ID' => $data['TODO_ID']]);
			$data['assign']	= $this->users_m->get_row(['USER_ID' => $data['todo']->ASSIGN_TO]);
			$data['access'] = $this->list_access_m->get(['LIST_ID' => $data['LIST_ID']]);
			$data['members'] = [];
			foreach ($data['access'] as $access)
			{
				$data['members'] []= $this->users_m->get_row(['USER_ID' => $access->USER_ID]);
			}
			echo json_encode($data);
			exit;
		}
	}

	private function _mark_as_completed()
	{
		if ($this->POST('mark_as_completed'))
		{
			$this->load->model('todo_items_m');
			$data['TODO_ID'] 		= $this->POST('todo_id');
			$data['IS_COMPLETED'] 	= $this->POST('completed') == 'true' ? 1 : 0;
			$this->todo_items_m->update($data['TODO_ID'], $data);

			$response['ongoing'] = $this->todo_items_m->get([
				'LIST_ID' 		=> $this->POST('list_id'),
				'IS_COMPLETED'	=> 0
			]);
			$response['completed'] = $this->todo_items_m->get([
				'LIST_ID' 		=> $this->POST('list_id'),
				'IS_COMPLETED'	=> 1
			]);
			$response['list_id'] = $this->POST('list_id');
			$response['status'] = 0;
			echo json_encode($response);
			exit;
		}
	}

	private function _update_task()
	{
		if ($this->POST('update_task'))
		{
			$this->load->model('todo_items_m');
			$data['TODO_ID'] 	= $this->POST('todo_id');
			$data['LIST_ID'] 	= $this->POST('list_id');
			$data['ITEM_DESC'] 	= $this->POST('item_desc');
			$data['ASSIGN_TO'] 	= $this->POST('assign_to');
			$data['DUE_DATE']	= $this->POST('due_date');
			$data['NOTE']		= $this->POST('note');
			if ($data['DUE_DATE'] == '0000-00-00' or empty($data['DUE_DATE']))
			{
				$data['DUE_DATE'] = NULL;
			}
			$this->todo_items_m->update($data['TODO_ID'], $data);
			$response['item'] = $this->todo_items_m->get_row(['TODO_ID' => $data['TODO_ID'], 'LIST_ID' => $data['LIST_ID']]);
			echo json_encode($response['item']);
			return TRUE;
		}

		return FALSE;
	}

	private function _get_user()
	{
		$this->load->model('users_m');
		$user_id = $this->input->get('user_id');
		$user = $this->users_m->get_row(['USER_ID' => $user_id]);
		echo json_encode($user);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('user');
		exit;
	}
}