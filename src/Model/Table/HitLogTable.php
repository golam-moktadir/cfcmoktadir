<?php
namespace App\Model\Table;
use Cake\ORM\Table;
class HitLogTable extends Table{

	public function initialize(array $config){
		$this->setTable('hit_log');
	}
}
?>