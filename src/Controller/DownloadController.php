<?php
namespace App\Controller;
use App\Controller\B2mController;

class DownloadController extends B2mController{

	public function initialize(){
		parent::initialize();
		$this->loadModel('ChargingSubscribers');
		$this->loadModel('FreeDownloadLog');
		$this->loadModel('Home');
		$this->loadModel('Subscribe');
		$this->loadModel('ChargeDownloadLog');
	}
	public function freeFileDownload($id,$file,$type,$price){

		$dndbd = $this->obj->dndbd();
		if(!empty($dndbd)){
			return $this->redirect('/');
		}
		$dndbd = $this->obj->dndbd_portal();	
		if(!empty($dndbd)){
			return $this->redirect('/');
		}
		$data = $this->Subscribe->find()->where(['msisdn'=>$this->msisdn])->first();
		
		if($data['status'] == 0){
			$this->ConsentSentLog('ondemand');
			return $this->redirect("/download/sub-ondemand-consent/$id/$file/$type/$price");
		}
		else if($data['status'] == 1){
			$data = $this->ChargingSubscribers->find()->where(['msisdn'=>$this->msisdn])->first();			
			if($data['counter'] <= 4){
				$counter = $data['counter'] + 1;

				$value = $this->FreeDownloadLog->newEntity();
				$value->msisdn = $this->msisdn;
				$value->opr = $this->opr;
				$value->d_date = date('Y-m-d');
				$value->d_time = date('Y-m-d H:i:s');
				$value->content_id = $id;
				$value->charged = '0.00';
				$value->content_type = $type;
				$value->phone_model = 'Android';
				$value->unit_price = '0.00';
				$value->downloads = 1;
				$value->revenue = '0.00';
				$this->FreeDownloadLog->save($value);
				$this->ChargingSubscribers->query()
										  ->update()
										  ->set(['counter'=>$counter])
										  ->where(['msisdn'=>$this->msisdn])->execute();				
				$this->set('data', $this->Home->find()->where(['id'=>$id])->first());
			}
			else{
				$this->ConsentSentLog('ondemand');
				return $this->redirect("/download/over/$id/$file/$type/$price");
			}
		}
	}
	public function freeDownloadProcess($ContentFile,$cat_id){
        if($cat_id == 28)
            $dir='Wallpaper/Sprots';
        if($cat_id == 30)
            $dir='Animation/Sports';
        if($cat_id == 31)
            $dir='Video/Sports';
		
		$subscribe = $this->Subscribe->find()->where(['msisdn'=>$this->msisdn])->first();
		$data = $this->ChargingSubscribers->find()->where(['msisdn'=>$this->msisdn])->first();			
	
        if($subscribe['status'] == 0 or $data['counter'] == 5){
			return $this->redirect('/download/error-download');
		}
		else{
			$path='/srv/www/htdocs_wap/b2m_cms/upload/content/'.$dir.'/'.$ContentFile;
			return $this->response->withFile($path,['download'=>true, 'name'=>$ContentFile]);
		}
	}
	public function subOndemandConsent($id,$file,$type,$price){		
		$this->set('id',$id);
		$this->set('file',$file);
		$this->set('type',$type);
		$this->set('price',$price);
	}
	public function ondemandAction($id,$file,$type,$price){
				
		$referenceCode = "";
		$srv_key = "";

		switch ($type) {
			case 'Video':
				$referenceCode = "100003";
				$srv_key = "b042b5489f2e4804a431ce1425ddb5e6";
				break;

			case 'Wallpaper':
				$referenceCode = "100002";
				$srv_key = "2a4813fcccdf4f9db7bedd9a5a807e4c";
				break;

			case 'Animation':
				$referenceCode = "100001";
				$srv_key = "d63a983fed55418590d4f7b9c5c332cb";
				break;

			case 'Game':
				$referenceCode = "100005";
				$srv_key = "8175fdf42d0744a188c61213f0d2cc67";
				break;
		}
		$call_back_url = "http://dev.b2mwap.com/cfcmoktadir/download/ondemand-callback/$type/$file/$id/$price/";
		$s_url        = base64_encode($call_back_url);

		$source_url = "http://192.168.2.38:8080/gp_dpdp/charging/get_crg_url.php?vmsisdn=$this->msisdn&referenceCode=$referenceCode&srv_key=$srv_key&succeess_url=$s_url&fail_url=$s_url&cancel_url=$s_url";
		$ch  = curl_init($source_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		echo $rsp = curl_exec($ch);
		curl_close($ch);
		return $this->redirect($rsp);
	}
	public function ondemandCallback($type,$file,$id,$price){

		if($_REQUEST['statuscode'] == '200'){// statuscode => gp, resultcode => robi
			$this->ChargeLog($_REQUEST['statuscode'],'ondemand');
			$value = $this->ChargeDownloadLog->newEntity();

			$value->msisdn = $this->msisdn;
			$value->opr = $this->opr;
			$value->d_date = date('Y-m-d');
			$value->d_time = date('Y-m-d H:i:s');
			$value->content_id = $id;
			$value->charged = $price;
			$value->content_type = $type;
			$value->unit_price = $price;
			$value->downloads = 1;
			$value->revenue = $price;

			$this->ChargeDownloadLog->save($value);
			return $this->redirect("/download/file-download/$id");
		}
		else if($_REQUEST['statuscode'] == '500'){
			return $this->redirect("/home/balance-alert");
		}
		else{
			return $this->redirect('/');
		} 
	}
	public function fileDownload($id){
		$this->set('data', $this->Home->find()->where(['id'=>$id])->first());
	}
	public function downloadProcess($ContentFile,$cat_id,$id){
		if($cat_id == 28)
            $dir='Wallpaper/Sprots';
        if($cat_id == 30)
            $dir='Animation/Sports';
        if($cat_id == 31)
            $dir='Video/Sports';

		$data = $this->ChargeDownloadLog->find()->where(['content_id'=>$id,'msisdn'=>$this->msisdn,'d_date'=>date('Y-m-d')])->first();
		if(empty($data['id'])){
			return $this->redirect('/download/error-download');
		}
		else{
			$path='/srv/www/htdocs_wap/b2m_cms/upload/content/'.$dir.'/'.$ContentFile;
			return $this->response->withFile($path,['download'=>true, 'name'=>$ContentFile]);
		}
	}
	public function over($id,$file,$type,$price){
		$this->set('id',$id);
		$this->set('file',$file);
		$this->set('type',$type);
		$this->set('price',$price);
	}
	public function errorDownload(){}
}

?>