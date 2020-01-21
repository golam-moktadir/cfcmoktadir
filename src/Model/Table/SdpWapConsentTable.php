<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class SdpWapConsentTable extends Table{

	public function initialize(array $config){
		$this->setTable('sdp_wap_consent');
	}
}
?>