<?php
namespace App\Controller;
use App\Controller\B2mController;

class DetailsController extends B2mController{

	public $paginate = ['limit'=>12];
	
	public function initialize(){
		parent::initialize();
		$this->loadModel('Home');
		$this->loadModel('Subscribe');
		$this->loadComponent('Paginator');
	}
	public function contentDetails($title){

		$this->set('title',$title);
		$data = $this->Subscribe->find()->where(['msisdn'=>$this->msisdn])->first();
		
		if($data['status'] == 1){
			$this->set('status',1);
		}
		$this->set('details', $this->paginate($this->Home->find()->where(['type'=>$title,'projects'=>'CFC,','status'=>'published'])));
	}
	public function newsDetails(){
		$this->autoRender = false;
		echo "This Page is Under Construction";
	}
}
?>
