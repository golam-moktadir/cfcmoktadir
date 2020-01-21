<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class ChargeLogTable extends Table{
	public function initialize(array $config){
		$this->setTable('charge_log');
	}
}
?>