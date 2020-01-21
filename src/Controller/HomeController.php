<?php
namespace App\Controller;
use App\Controller\B2mController;

class HomeController extends B2mController{

	public function initialize(){
		parent::initialize();
		$this->loadModel('Subscribe');
		$this->loadModel('Home');
		$this->loadModel('News');
		$this->loadModel('ChargingSubscribers');
	}
	public function index(){

		if(!$this->getRequest()->getSession()->check('new_user')){
			$this->loadModel('HitLog');
			$value = $this->HitLog->newEntity();
			$value->msisdn = $this->msisdn;
			$value->opr = $this->opr;
			$value->browser = $this->obj->device_browser($browser = TRUE);
			$value->user_agent = trim($_SERVER['HTTP_USER_AGENT']);
			$value->ip = implode(',', $this->obj->get_client_ip());
			$value->d_date = date('Y-m-d');
			$value->d_time = date('Y-m-d H:i:s');
			$this->HitLog->save($value);
		}
		$data = $this->Subscribe->find()->where(['msisdn'=>$this->msisdn])->first();
		
		if($data['status'] == 1){
			$data = $this->ChargingSubscribers->find()->where(['msisdn'=>$this->msisdn])->first();
			if(date('Y-m-d') != date('Y-m-d', strtotime($data['counter_reset_date']))){
				$this->updateChargingSubscriber();
			}
			$this->set('status',1);
		}
		$this->set('msisdn',$this->msisdn);
		$this->set('news',$this->News->find()->where(['service_id'=>41])->order(['id'=>'desc'])->first());
	
		$this->set('wallpaper',$this->Home->find()->where(['type'=>'Wallpaper','projects'=>'CFC,','status'=>'published'])->order('rand()')->limit(6));		
	
		$this->set('animation',$this->Home->find()->where(['type'=>'Animation','projects'=>'CFC,','status'=>'published'])->order('rand()')->limit(6));		

		$this->set('video',$this->Home->find()->where(['type'=>'Video','projects'=>'CFC,','status'=>'published'])->order('rand()')->limit(6));		
	}
	public function details($id){
		$this->set('data', $this->Home->find()->where(['id'=>$id])->first());
	}
	public function select(){
		$this->autoRender = false;
	}
	public function balanceAlert(){}	
}
?>