<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class ConsentRequestLogTable extends Table{
	public function initialize(array $config){
		$this->setTable('robi_consent_request_log');
	}
}

?>