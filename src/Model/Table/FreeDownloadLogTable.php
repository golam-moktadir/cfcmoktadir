<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class FreeDownloadLogTable extends Table{

	public function initialize(array $config){
		$this->setTable('cfc_free_download_log'); 
	}
}

?>