<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class ChargeDownloadLogTable extends Table{
	public function initialize(array $config){
		$this->setTable('mc_charge_download_log');

	}
}

?>