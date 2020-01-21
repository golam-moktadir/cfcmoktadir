<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class ConsentSentLogTable extends Table{

	public function initialize(array $config){
		$this->setTable('consent_sent_log');
	}
}
?>