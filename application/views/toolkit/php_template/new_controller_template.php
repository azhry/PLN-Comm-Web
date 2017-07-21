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
		<?php if ($insertable == TRUE): ?>
if ($this->POST('insert'))
		{
			$this->data['entry'] = [
		<?php foreach ($insertable_fields as $field): ?>
		<?= '"' . $field->COLUMN_NAME . '" => $this->POST("' . $field->COLUMN_NAME . '"),' . "\n" ?>
		<?php endforeach; ?>
	];
			$this-><?= $model_name ?>->insert($this->data['entry']);
			redirect('<?= strtolower($controller_name) ?>');
			exit;
		}
		<?php endif; ?>

		<?php if ($deletable == TRUE): ?>
if ($this->POST('delete') && $this->POST('<?= $primary_key_column ?>'))
		{
			$this-><?= $model_name ?>->delete($this->POST('<?= $primary_key_column ?>'));
			exit;
		}
		<?php endif; ?>
		
		<?php if ($editable == TRUE): ?>
if ($this->POST('edit') && $this->POST('edit_<?= $primary_key_column ?>'))
		{
			$this->data['entry'] = [
		<?php foreach ($editable_fields as $field): ?>
		<?= '"' . $field->COLUMN_NAME . '" => $this->POST("' . $field->COLUMN_NAME . '"),' . "\n" ?>
		<?php endforeach; ?>
	];
			$this-><?= $model_name ?>->update($this->POST('edit_<?= $primary_key_column ?>'), $this->data['entry']);
			redirect('<?= strtolower($controller_name) ?>');
			exit;
		}

		if ($this->POST('get') && $this->POST('<?= $primary_key_column ?>'))
		{
			$this->data['<?= strtolower($table) ?>'] = $this-><?= $model_name ?>->get_row(['<?= $primary_key_column ?>' => $this->POST('<?= $primary_key_column ?>')]);
			echo json_encode($this->data['<?= strtolower($table) ?>']);
			exit;
		}
		<?php endif; ?>
		
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
		$this->template($this->data<?= (strlen($template) > 0) ? ', "' . $template . '"' : '' ?>);
	}

<?php if ($selectable): ?>

	public function detail_<?= strtolower($table) ?>()
	{
		$this->data['<?= $primary_key_column ?>'] = $this->uri->segment(3);
		if (!isset($this->data['<?= $primary_key_column ?>']))
		{
			redirect('<?= strtolower($controller_name) ?>');
			exit;
		}

		$this->data['columns']	= <?php 
			$string_content = '[';
			foreach ($columns as $column)
				$string_content .= '"'.$column->COLUMN_NAME.'",';
			$string_content .= ']';
			echo $string_content;
		?>;
		$this->data['data'] = $this-><?= $model_name ?>->get_row(['<?= $primary_key_column ?>' => $this->data['<?= $primary_key_column ?>']]);
		$this->data['title'] 	= '<?= $title_detail ?>';
		$this->data['content'] 	= '<?= $content_detail ?>';
		$this->template($this->data<?= (strlen($template) > 0) ? ', "' . $template . '"' : '' ?>);
	}

<?php endif; ?>

}