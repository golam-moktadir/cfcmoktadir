<?php
namespace App\Model\Table;
use Cake\ORM\Table;
class HomeTable extends Table{

	public function initialize(array $config){
		$this->setTable('b2m_cms_content');
	}
	public static function defaultConnectionName() {
        return 'b2m_cms';
    }
}
?>