<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class ConsentBackLogTable extends Table{

	public function initialize(array $config){
		$this->setTable('consent_back_log');
	}
}
?>