 defined('BASEPATH') || exit('No direct script allowed');

class <?= $controller_name ?> extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('<?= $model_name ?>');
	}

	public function index()
	{
		$this->data['data']		= $this-><?= $model_name ?>->get();
		$this->data['columns']	= <?php 
			$string_content = '[';
			foreach ($columns as $column)
				$string_content .= '"'.$column->COLUMN_NAME.'",';
			$string_content .= ']';
			echo $string_content;
		?>;
		$this->data['title'] 	= '<?= $title ?>';
		$this->data['content'] 	= '<?= $content ?>';
		$this->template($this->data);
	}
}

