<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class ChargingSubscribersTable extends Table{
	public function initialize(array $config){
		$this->setTable('charging_subscribers');
	}
}

?>