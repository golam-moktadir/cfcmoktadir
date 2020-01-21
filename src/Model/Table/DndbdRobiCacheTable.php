<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class DndbdRobiCacheTable extends Table{

	public function initialize(array $config){
		$this->setTable('dndbd_robi_cache');
	}
}
?>