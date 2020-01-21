<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class SubsRequestLogTable extends Table{
	public function initialize(array $config){
		$this->setTable('user_subs_request_log');
	}
}

?>