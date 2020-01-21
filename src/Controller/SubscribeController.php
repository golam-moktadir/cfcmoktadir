<?php
namespace App\Controller;
use App\Controller\B2mController;

class SubscribeController extends B2mController{

	public function initialize(){
		parent::initialize();
		$this->loadModel('Subscribe');
		$this->loadModel('ChargingSubscribers');	
	}
	public function subscribe(){

		$dndbd = $this->obj->dndbd();
		if(!empty($dndbd)){
			return $this->redirect('/');
		}
		$dndbd = $this->obj->dndbd_portal();	
		if(!empty($dndbd)){
			return $this->redirect('/');
		}
		$data = $this->Subscribe->find()->where(['msisdn'=>$this->msisdn])->first();
		$subs_date = date('Y-m-d',strtotime($data['subs_date']));
		
		if(date('Y-m-d') == $subs_date){
			return $this->redirect('/subscribe/same-day-error');
		}		
		$this->ConsentSentLog('subs');
		
	}
	public function sameDayError(){}

  	public function subscribeAction($consent){
  		$this->autoRender = false;
		$this->ConsentBackLog($consent);
		
		if($consent == 'yes'){
			if($this->opr == 'gp'){
				$vmsisdn = $this->msisdn;
				$referenceCode = '102542';
				$srv_key = 'd32f0a805f5547e0aca901cee8cb8722';	//e146ce7afe344f258b148b7d0ad128cc; 
	        													//d32f0a805f5547e0aca901cee8cb8722; 
				$call_back_url = 'http://dev.b2mwap.com/cfcmoktadir/subscribe/subscribe-callback';
				$c_url = base64_encode($call_back_url);

				$source_url = "http://192.168.2.38:8080/gp_dpdp/charging/get_crg_url.php?vmsisdn=$vmsisdn&referenceCode=$referenceCode&srv_key=$srv_key&succeess_url=$c_url&fail_url=$c_url&cancel_url=$c_url";

				$ch = curl_init($source_url);;
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$rsp = curl_exec($ch);
				curl_close($ch);
				return $this->redirect($rsp);
			}
			else if($this->opr == 'robi'){
				$this->RobiWapConsent();
				$this->RobiConsentRequestLog();
			}			
		}
		else{
			return $this->redirect('/');
		}

  	}	
	public function subscribeCallback(){
		//$this->ConsentBackLogTelco($consent); 
		//$this->ConsentResponseLog($consent);
		$data = $this->Subscribe->find()->where(['msisdn'=>$this->msisdn])->first();

		if($_REQUEST['statuscode'] == '200'){ // statuscode => gp, resultcode => robi
			$this->SubsRequestLog('subs');
			$this->ChargeLog($_REQUEST['statuscode'],'subs');
			if(empty($data['id'])){
				$this->insertSubscriber();
				$this->insertChargingSubscriber();					
			}
			else{
				$this->updateSubscriber('1');
				$this->updateChargingSubscriber();					
			}
			return $this->redirect('/');
		}
		else if($_REQUEST['statuscode'] == '500'){
			return $this->redirect('/home/balance-alert');
		}
		else{
			return $this->redirect('/');
		}
	}
	public function unsubscribe(){
		                   
		if($this->opr == 'robi'){
			$this->unsub_robi_curl();
		}
		if($this->opr == 'gp'){
			$this->unsub_gp_curl();
		}
		$this->updateSubscriber('0');
		$this->SubsRequestLog('unsubs');

		$this->loadModel('dndbdRobi');
		$this->loadModel('dndbdRobiCache');
		
		if($this->opr == 'robi'){
			$data = $this->Subscribe->find()->where(['msisdn'=>$this->msisdn])->first();
			$subs_date = date('Y-m-d',strtotime($data['subs_date']));

			if(date('Y-m-d') == $subs_date){
				$value = $this->dndbdRobi->newEntity();
				$value->msisdn = $this->msisdn;
				$value->opr = 'robi';
				$value->date = date('Y-m-d');
				$value->description = 'Same day';
				$value->flag = '1';
				$this->dndbdRobi->save($value);

				$value = $this->dndbdRobiCache->newEntity();
				$value->msisdn = $this->msisdn;
				$value->opr = 'robi';
				$value->date = date('Y-m-d');
				$value->description = 'Same day';
				$value->flag = '1';
				$this->dndbdRobiCache->save($value);
			}	
		}
		return $this->redirect('/');
	}
}
?>