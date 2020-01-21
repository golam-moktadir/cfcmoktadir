<?php
namespace App\Model\Table;
use Cake\ORM\Table;
class NewsTable extends Table{

	public function initialize(array $config){
		$this->setTable('alerts_content');
	}
}
?>