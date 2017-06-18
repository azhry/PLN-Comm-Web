 defined('BASEPATH') || exit('No direct script allowed');

class <?= $model_name ?> extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = '<?= $table_name ?>';
		$this->data['primary_key'] = '<?= $primary_key ?>';
	}
}

