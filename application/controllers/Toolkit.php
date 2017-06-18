<?php defined('BASEPATH') || exit('No direct script allowed');

class Toolkit extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function crud_generator()
	{
		if ($this->POST('generate'))
		{
			$key = $this->POST('generate');
			$response['html'] = '';
			$response['status'] = 0;
			
			$options = [
				'selectable'	=> $this->POST('selectable'),
				'insertable'	=> $this->POST('insertable'),
				'editable'		=> $this->POST('editable'),
				'deletable'		=> $this->POST('deletable'),
				'primary_key'	=> $this->POST('primary_key'),
				'json_api'		=> $this->POST('json_api')
			];

			var_dump($options['primary_key'] == "false");

			if ($key == 'controller')
			{
				$this->data['controllers'] = scandir(realpath(APPPATH . '/controllers'));
				$view_name = $this->POST('table') . '_all';
				foreach ($this->data['controllers'] as $controller)
				{
					$controller = pathinfo(realpath(APPPATH . '/controllers/' . $controller));
					if ($controller['filename'] === $this->POST('key'))
					{
						$response['status'] = 1;
						break;
					}
				}

				if ($response['status'] == 1)
				{
					$response['html'] .= '<p>Controller '. $this->POST('key') .' already exist. Modifying...</p>';
					$view_name = $this->POST('model') . '_all';
					$file_data = [
						'controller_name'	=> $this->POST('key'),
						'model_name'		=> ucfirst($this->POST('model') . '_m'),
						'title'				=> 'Title',
						'content'			=> $view_name
					];

					$this->load->model('toolkit/toolkit_m');

					if ($options['primary_key'] == "false")
						$file_data['columns']	= $this->toolkit_m->get_columns($this->POST('model'));
					else
						$file_data['columns']	= $this->toolkit_m->get_columns($this->POST('model'), ['COLUMN_KEY <> PRI']);
					$file_content = '<?php';
					$file_content .= $this->load->view('toolkit/php_template/new_controller_template', $file_data, TRUE);

					if (file_put_contents('application/controllers/' . $this->POST('key') . '.php', $file_content))
						$response['html'] .= '<p style="color: green;">'. $this->POST('key') .'.php generated at application/controllers</p>';	
					else
						$response['html'] .= '<p style="color: red;">Error generating controller '. $this->POST('key') .'.php</p>';
				}
				else
				{
					$response['html'] .= '<p>Generating '. $this->POST('key') .'.php...</p>';
					$view_name = $this->POST('model') . '_all';
					$file_data = [
						'controller_name'	=> $this->POST('key'),
						'model_name'		=> ucfirst($this->POST('model') . '_m'),
						'title'				=> 'Title',
						'content'			=> $view_name
					];

					$this->load->model('toolkit/toolkit_m');

					$file_content = '<?php';
					$file_content .= $this->load->view('toolkit/php_template/new_controller_template', $file_data, TRUE);

					if (file_put_contents('application/controllers/' . $this->POST('key') . '.php', $file_content))
						$response['html'] .= '<p style="color: green;">'. $this->POST('key') .'.php generated at application/controllers</p>';	
					else
						$response['html'] .= '<p style="color: red;">Error generating controller '. $this->POST('key') .'.php</p>';
				}
			}
			else
			{
				$this->data['models'] = scandir(realpath(APPPATH . '/models'));
				$model_name = ucfirst($this->POST('key') . '_m');
				foreach ($this->data['models'] as $models)
				{
					$models = pathinfo(realpath(APPPATH . '/models/' . $models));
					if ($models['filename'] === $model_name)
					{
						$response['status'] = 1;
						break;
					}
				}

				$this->load->model('toolkit/toolkit_m');

				if ($response['status'] == 1)
				{
					$response['html'] .= '<p>Model ' . $model_name . ' already exist. Modifying...</p>';
					$response['html'] .= '<p style="color: green;">Model ' . $model_name . '.php has been modified</p>';
				}
				else
				{
					$response['html'] .= '<p>Generating '. $model_name .'.php...</p>';

					$file_data = [
						'model_name'		=> ucfirst($model_name),
						'table_name'		=> $this->POST('key'),
						'primary_key'		=> $this->toolkit_m->get_primary_key($this->POST('key'))
					];
					$file_content = '<?php';
					$file_content .= $this->load->view('toolkit/php_template/new_model_template', $file_data, TRUE);

					if (file_put_contents('application/models/' . $model_name . '.php', $file_content))
						$response['html'] .= '<p style="color: green;">'. $model_name .'.php generated at application/models</p>';	
					else
						$response['html'] .= '<p style="color: red;">Error generating model '. $model_name .'.php</p>';
				}

				$view_name = $this->POST('key') . '_all';

				$response['html'] .= '<p>Generating '. $view_name .'.php...</p>';

				$file_data = [
					'view_name'			=> $view_name,
					'table_name'		=> ucwords(str_replace('_', ' ', $this->POST('key'))),
					'primary_key'		=> $this->toolkit_m->get_primary_key($this->POST('key'))
				];

				$file_content = '';
				$file_content .= $this->load->view('toolkit/html_template/new_select_all', $file_data, TRUE);

				if (file_put_contents('application/views/' . $view_name . '.php', $file_content))
					$response['html'] .= '<p style="color: green;">'. $view_name .'.php generated at application/views</p>';	
				else
					$response['html'] .= '<p style="color: red;">Error generating view '. $view_name .'.php</p>';

			}
			echo $response['html'];
			exit;
		}

		$this->data['title']	= 'CRUD Generator';
		$this->data['content']	= 'crud-generator';
		$this->template($this->data, 'toolkit');
	}

	public function model_generator()
	{
		
	}

	public function check_table()
	{
		$this->data['table_name'] 	= $this->POST('table_name');
		$this->data['response']		= [
			'table_name'	=> $this->data['table_name'],
			'status'		=> 0,
			'active_db'		=> $this->db->database
		];

		$this->load->model('toolkit/toolkit_m');

		if (isset($this->data['table_name']))
		{
			$is_exist = $this->toolkit_m->check_table($this->data['table_name']);
			if ($is_exist)
				$this->data['response']['status'] = 1;
		}

		echo json_encode($this->data['response']);
	}

	public function check_controller()
	{
		$this->data['controllers'] = scandir(realpath(APPPATH . '/controllers'));
		$response['status'] = 0;
		foreach ($this->data['controllers'] as $controller)
		{
			$controller = pathinfo(realpath(APPPATH . '/controllers/' . $controller));
			if ($controller['filename'] === $this->POST('controller_name'))
			{
				$response['status'] = 1;
				$contents = file_get_contents(APPPATH . '/controllers/' . $controller['filename'] . '.php');
				$contents = explode(' ', $contents);
				$response['method_list'] = [];
				for ($i = 0; $i < count($contents); $i++)
				{
					if ($contents[$i] == 'function')
					{
						$method_name = '';
						$temp = str_split($contents[$i + 1]);
						foreach ($temp as $t)
						{
							if ($t == '(')
								break;
							$method_name .= $t;
						}
						$response['method_list'] []= $method_name;
					}
				}
				break;
			}
		}
		echo json_encode($response);
	}
}
