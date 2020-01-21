<?php
namespace App\Model\Table;
use Cake\ORM\Table;
class SubscribeTable extends Table{

	public function initialize(array $config){
		$this->setTable('subscribers');
	}
}
?>