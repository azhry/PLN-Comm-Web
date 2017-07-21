<?php defined('BASEPATH') || exit('No direct script allowed');

class Toolkit extends MY_Controller
{
	private $metadata;
	private $opt;
	private $response;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('toolkit/toolkit_m');
		$this->opt = [];
		$this->metadata = [];
		$this->response = [];
		$this->response['html'] = '';
	}

	private function selectable($enable, $model, $template)
	{
		$this->metadata['primary_key_column']	= $this->toolkit_m->get_primary_key($model);
		if ($enable)
		{
			$this->metadata['selectable'] = TRUE;
			$this->metadata['title_detail'] = 'Title';
			$this->metadata['content_detail'] = $model . '_detail';

			$view_name = $model . '_detail';
			$this->metadata['table_name'] = $model;
			$this->response['html'] .= '<p>Generating '. $view_name .'.php...</p>';

			$file_content = '';
			$file_content .= $this->load->view($template . '/html_template/new_details', $this->metadata, TRUE);

			if (file_put_contents('application/views/' . $view_name . '.php', $file_content))
				$this->response['html'] .= '<p style="color: green;">'. $view_name .'.php generated at application/views</p>';	
			else
				$this->response['html'] .= '<p style="color: red;">Error generating view '. $view_name .'.php</p>';
		}
	}

	private function insertable($enable, $model)
	{
		if ($enable)
		{
			$this->metadata['insertable'] = TRUE;
			if ($this->toolkit_m->check_auto_increment($model))
				$this->metadata['insertable_fields'] = $this->toolkit_m->get_columns($model, ['COLUMN_KEY <> PRI']);
			else
				$this->metadata['insertable_fields'] = $this->toolkit_m->get_columns($model);
		}
	}

	private function editable($enable, $model)
	{
		if ($enable)
		{
			$this->metadata['editable'] = TRUE;
			if ($this->toolkit_m->check_auto_increment($model))
				$this->metadata['editable_fields'] = $this->toolkit_m->get_columns($model, ['COLUMN_KEY <> PRI']);
			else
				$this->metadata['editable_fields'] = $this->toolkit_m->get_columns($model);
		}
	}

	private function deletable($enable)
	{
		if ($enable) $this->metadata['deletable'] = TRUE;
	}

	private function primary_key($enable, $model)
	{
		if ($enable)
		{
			$this->metadata['primary_key'] = TRUE;
			$this->metadata['columns']	= $this->toolkit_m->get_columns($model);
		}
		else
			$this->metadata['columns']	= $this->toolkit_m->get_columns($model, ['COLUMN_KEY <> PRI']);
	}

	private function json_api($enable)
	{
		if ($enable) $this->metadata['json_api'] = TRUE;
	}

	private function set_options($opts, $model, $template)
	{
		$this->selectable($opts['selectable'] == 'true' ? TRUE : FALSE, $model, $template);
		$this->insertable($opts['insertable'] == 'true' ? TRUE : FALSE, $model);
		$this->editable($opts['editable'] == 'true' ? TRUE : FALSE, $model);
		$this->deletable($opts['deletable'] == 'true' ? TRUE : FALSE);
		$this->primary_key($opts['primary_key'] == 'true' ? TRUE : FALSE, $model);
		$this->json_api($opts['json_api'] == 'true' ? TRUE : FALSE);
	}

	private function generate_controller($template = '')
	{
		$this->response['status'] = 0;
		$existing_controllers = scandir(realpath(APPPATH . '/controllers'));
		foreach ($existing_controllers as $controller)
		{
			$controller = pathinfo(realpath(APPPATH . '/controllers/' . $controller));
			if ($controller['filename'] === $this->POST('controller'))
			{
				$this->response['status'] = 1;
				break;
			}
		}

		$view_name = $this->POST('table') . '_all';
		$this->metadata['controller_name']  = $this->POST('controller');
		$this->metadata['table']			= $this->POST('table');
		$this->metadata['model_name']		= ucfirst($this->POST('table') . '_m');
		$this->metadata['title']			= 'Title';
		$this->metadata['content']			= $view_name;
		$this->metadata['template']			= $template;

		if ($this->response['status'] == 1)
		{
			$this->response['html'] .= '<p>Controller '. $this->POST('controller') .' already exist. Modifying...</p>';

			$file_content = '<?php';
			$file_content .= $this->load->view('toolkit/php_template/new_controller_template', $this->metadata, TRUE);

			if (file_put_contents('application/controllers/' . $this->POST('controller') . '.php', $file_content))
				$this->response['html'] .= '<p style="color: green;">'. $this->POST('controller') .'.php generated at application/controllers</p>';	
			else
				$this->response['html'] .= '<p style="color: red;">Error generating controller '. $this->POST('controller') .'.php</p>';
		}
		else
		{
			$this->response['html'] .= '<p>Generating '. $this->POST('controller') .'.php...</p>';

			$file_content = '<?php';
			$file_content .= $this->load->view('toolkit/php_template/new_controller_template', $file_data, TRUE);

			if (file_put_contents('application/controllers/' . $this->POST('controller') . '.php', $file_content))
				$this->response['html'] .= '<p style="color: green;">'. $this->POST('controller') .'.php generated at application/controllers</p>';	
			else
				$this->response['html'] .= '<p style="color: red;">Error generating controller '. $this->POST('controller') .'.php</p>';
		}
	}

	private function generate_model()
	{
		$this->response['status'] = 0;
		$existing_models = scandir(realpath(APPPATH . '/models'));
		$model_name = ucfirst($this->POST('table') . '_m');
		foreach ($existing_models as $models)
		{
			$models = pathinfo(realpath(APPPATH . '/models/' . $models));
			if ($models['filename'] === $model_name)
			{
				$this->response['status'] = 1;
				break;
			}
		}

		if ($this->response['status'] == 1)
		{
			$this->response['html'] .= '<p>Model ' . $model_name . ' already exist. Modifying...</p>';
			$this->response['html'] .= '<p style="color: green;">Model ' . $model_name . '.php has been modified</p>';
		}
		else
		{
			$this->response['html'] .= '<p>Generating '. $model_name .'.php...</p>';

			$this->metadata['model_name']	= ucfirst($model_name);
			$this->metadata['table_name']	= $this->POST('table');
			$this->metadata['primary_key']	= $this->toolkit_m->get_primary_key($this->POST('table'));
			$file_content = '<?php';
			$file_content .= $this->load->view('toolkit/php_template/new_model_template', $this->metadata, TRUE);

			if (file_put_contents('application/models/' . $model_name . '.php', $file_content))
				$this->response['html'] .= '<p style="color: green;">'. $model_name .'.php generated at application/models</p>';	
			else
				$this->response['html'] .= '<p style="color: red;">Error generating model '. $model_name .'.php</p>';
		}
	}

	private function generate_view($template, $model)
	{
		$view_name = $model . '_all';

		$this->response['html'] .= '<p>Generating '. $view_name .'.php...</p>';

		$this->metadata['controller_name'] 	= $this->POST('controller');
		$this->metadata['model']			= $model;
		$this->metadata['view_name']		= $view_name;
		$this->metadata['table_name']		= ucwords(str_replace('_', ' ', $model));
		$this->metadata['primary_key']		= $this->toolkit_m->get_primary_key($model);
		$file_content = '';
		$file_content .= $this->load->view($template . '/html_template/new_select_all', $this->metadata, TRUE);

		if (file_put_contents('application/views/' . $view_name . '.php', $file_content))
			$this->response['html'] .= '<p style="color: green;">'. $view_name .'.php generated at application/views</p>';	
		else
			$this->response['html'] .= '<p style="color: red;">Error generating view '. $view_name .'.php</p>';
	}

	public function crud_generator()
	{
		if ($this->POST('generate'))
		{
			$this->response['status'] = 0;
			$this->response['html'] = '';
			
			$options = [
				'selectable'	=> $this->POST('selectable'),
				'insertable'	=> $this->POST('insertable'),
				'editable'		=> $this->POST('editable'),
				'deletable'		=> $this->POST('deletable'),
				'primary_key'	=> $this->POST('primary_key'),
				'json_api'		=> $this->POST('json_api')
			];

			foreach ($options as $key => $value)
				$this->metadata[$key] = FALSE;

			$this->metadata['template'] = 'material-design';
			$this->set_options($options, $this->POST('table'), $this->metadata['template']);
			$this->generate_controller($this->metadata['template']);
			$this->generate_model();
			$this->generate_view($this->metadata['template'], $this->POST('table'));

			echo $this->response['html'];
			exit;
		}

		$this->data['title']	= 'CRUD Generator';
		$this->data['content']	= 'crud-generator';
		$this->template($this->data, 'toolkit');
	}

	public function model_generator()
	{
		if ($this->POST('generate'))
		{
			$response['html'] = '';
			$this->data['root_project_directory'] = basename(realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'));
			$this->load->model('toolkit/toolkit_m');
			$response['html'] .= '<b>Checking database '. $this->db->database .'...</b><br><br>';
			$this->data['project_tables'] = $this->toolkit_m->get_all_tables();
			$this->data['root_project_directory'] = str_replace('-', '_', $this->data['root_project_directory']);
			foreach ($this->data['project_tables'] as $table)
			{
				$prefix = $this->POST('prefix');
				if ($prefix == 'true')
					$model_name = strtoupper($this->data['root_project_directory']) . '_' . $table->TABLE_NAME . '_m';
				else
					$model_name = $table->TABLE_NAME . '_m';

				$model_name = ucfirst($model_name);
				$response['html'] .= 'Generating model ' . $model_name . '.php<br>';
				if (file_exists(realpath(APPPATH . 'models/' . $model_name . '.php')))
					$response['html'] .= 'Model ' . $model_name . '.php already exists<br><br>';
				else
				{
					$file_data = [
						'model_name'		=> $model_name,
						'table_name'		=> $table->TABLE_NAME,
						'primary_key'		=> $this->toolkit_m->get_primary_key($table->TABLE_NAME)
					];
					$file_content = '<?php';
					$file_content .= $this->load->view('toolkit/php_template/new_model_template', $file_data, TRUE);
					if (file_put_contents('application/models/' . $model_name . '.php', $file_content))
						$response['html'] .= '<span style="color: green;">' . $model_name . '.php is generated to handle ' . $table->TABLE_NAME . ' table logic</span><br><br>';
					else
						$response['html'] .= '<span style="color: red;">Something went wrong while generating ' . $model_name . '.php</span><br><br>';
				}
			}

			echo json_encode($response);
			exit;
		}

		$this->data['title']	= 'Model Generator';
		$this->data['content']	= 'model-generator';
		$this->template($this->data, 'toolkit');
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
			if ($is_exist == TRUE)
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
