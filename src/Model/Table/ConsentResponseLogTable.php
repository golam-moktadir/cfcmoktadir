<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class ConsentResponseLogTable extends Table{
	
	public function initialize(array $config){
		$this->setTable('robi_consent_response_log');
	}
}

?>