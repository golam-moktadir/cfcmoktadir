<?php
namespace App\Controller;
use App\Controller\AppController;
class B2mController extends AppController{

	public $obj;
	public $msisdn;
	public $opr;
	public $channel = 'Portal';
	public $ta = 'NULL'; 
	public $f = 'NULL';
	public $e = 'NULL';
    public $affiliate_id = 'NULL';
    public $aff_sub = 'NULL';	
	
	public function initialize(){
		parent::initialize();
		
		date_default_timezone_set('Asia/Dhaka');
		$this->viewBuilder()->setLayout('cfc_layout');
		$this->set('ContentCMS','http://b2mcms.b2mwap.com');
		
		require_once(ROOT.DS."vendor".DS."myclass".DS."CommonClass.php");
		$this->obj = new CommonClass;
		$this->msisdn = $this->obj->get_msisdn();
		$this->opr = $this->obj->operator();

		// if($this->opr == 'no opr'){
		// 	echo "<p>Please Use your Mobile Phone Browser with WAP Settings to Download the Content. For Help line call 01732701937, 01735996754</p>";
		// 	exit;
		// }
	}
	
	public function ConsentBackLog($consent){

		$this->loadModel('ConsentBackLog');

		$date           = date('Y-m-d');
		$time           = date('H:i:s');
		$sp_id      	= '200011';
		$nonce      	= date('YmdHis').mt_rand(1000,9999);
		$created    	= date('Y-m-d').'T'.date('H:i:s').'Z';	
		$passwordDigest = $this->obj->getDigestPass($nonce, $created);
		$passwordDigest_enc = urlencode($passwordDigest);
		$msisdn 		= $this->msisdn;
		$transactionId  = $this->obj->generateCode();
		$product_id     = '0300394469'; //auto_renewal_pid

		$channel = (isset($_REQUEST['channel'])) ? $_REQUEST['channel'] : 'NULL';
		$ta = (isset($_REQUEST['ta'])) ? $_REQUEST['ta'] : 'NULL';
		$affiliate_id = (isset($_REQUEST['$affiliate_id'])) ? $_REQUEST['$affiliate_id'] : 'NULL';
		$affiliate_sub = (isset($_REQUEST['$aff_sub'])) ? $_REQUEST['$aff_sub'] : 'NULL';

		$value = $this->ConsentBackLog->newEntity();
		$value->msisdn = $this->msisdn;
		$value->operator = $this->opr;
		$value->channel = $channel;
		$value->transaction_id = $transactionId;
		$value->is_charge_success = '0';
		$value->status = 'null';
		$value->user_confirmation = $consent;
		$value->postback_status = $consent;
		$value->affiliate_id = $affiliate_id;
		$value->affiliate_sub = $affiliate_sub;
		$value->content_id = '1';
		$value->reference_id = $this->msisdn.date('Ymd');
		$value->response_parameters = 'null';
		$value->created = date('Y-m-d H:i:s');
		$this->ConsentBackLog->save($value);
	}
    public function setChannel($channel, $ta, $f, $e, $affiliate_id, $aff_sub){
        $this->channel = $channel;
        $this->ta = $ta;
        $this->f = $f;
        $this->e = $e;
        $this->affiliate_id = $affiliate_id;
        $this->aff_sub = $aff_sub;
    }
	public function RobiWapConsent($nonce,$created){
		$this->loadModel('SdpWapConsent');
		$value = $this->SdpWapConsent->newEntity();
		$value->msisdn = $this->msisdn;
		$value->service = 'CFC';
		$value->product_id = '0300394469';
		$value->transaction_id = $this->obj->generateCode();
		$value->nonce = date('YmdHis').mt_rand(1000,9999);
		$value->passwordDigest = $this->obj->getDigestPass($nonce, $created);
		$value->passwordDigest_encoded = urlencode($this->obj->getDigestPass($nonce, $created));
		$value->date_added = date('Y-m-d H:i:s');		
		$this->SdpWapConsent->save($value);
	}
	public function RobiConsentRequestLog($nonce,$created){
			$this->loadModel('ConsentRequestLog');
			$value = $this->ConsentRequestLog->newEntity();
			$value->msisdn = $this->msisdn;
			$value->service = 'CFC';
			$value->product_id = '0300394469';
			$value->transaction_id = $this->obj->generateCode();
			$value->nonce = date('YmdHis').mt_rand(1000,9999);
			$value->created = date('Y-m-d').'T'.date('H:i:s').'Z';
			$value->passwordDigest =  $this->obj->getDigestPass($nonce, $created);
			$value->passwordDigest_encoded =  urlencode($this->obj->getDigestPass($nonce, $created));
			$value->date_added = date('Y-m-d H:i:s');
			$value->channel = $this->channel;
			$value->ta = $this->ta;		
			$this->ConsentRequestLog->save($value);	
	}

	public function ConsentBackLogTelco($consent){

		$this->loadModel('SdpWapConsent');
	    $this->SdpWapConsent->query()
		  		    	    ->update()
						    ->set([
									'msisdn' => $this->msisdn,
									'service' => 'CFC',
									'product_id' => '0300394469',
									'confirm_result' => $consent,
									'result_code' => '1',
									'is_double_confirm' =>$consent,
									//'transaction_id' => $_SESSION['transactionId'],
									'date_added' => date("Y-m-d H:i:s")
								  	])
							->where(['transaction_id' => '2365874156'])
							->execute();
	}
	public function ConsentResponseLog($consent){

		 $this->loadModel('ConsentResponseLog');
		 $value = $this->ConsentResponseLog->newEntity();
		 $value->msisdn = $this->msisdn;
		 $value->service = 'CFC';
		 $value->confirm_result = $consent;
		 $value->result_code = '1';
		 $value->is_double_confirm = $consent;
		 $value->transaction_id = '2365874156';
		 $value->channel = 'Portal';
		 $value->ta = '';
		 $value->d_date = date('Y-m-d');
		 $value->d_time = date('H:i:s');
		 $this->ConsentResponseLog->save($value);
	}
	public function SubsRequestLog($consent){

		$this->loadModel('SubsRequestLog');
		$value = $this->SubsRequestLog->newEntity();
		$value->msisdn = $this->msisdn;
		$value->opr = $this->opr;
		$value->service = 'CFC';
		$value->serviceid = '25656_Cricket_fun_club_daily';
		$value->tid = '';
		$value->source = $consent;
		$value->type = 'portal';
		$value->log = isset($_REQUEST['resultCode']) ? $_REQUEST['resultCode'] : 'NULL';
		$value->d_date = date('Y-m-d');
		$value->t_time = date('H:i:s');
		$this->SubsRequestLog->save($value);
	}
	public function ChargeLog($log,$source){
		$this->loadModel('ChargeLog');
		$value = $this->ChargeLog->newEntity();
		$value->msisdn = $this->msisdn;
		$value->opr = $this->opr;
		$value->service = 'CFC';
		$value->sub_service = 'NULL';
		$value->channel = 'Portal';
		$value->source = $source;
		$value->log = $log;
		$value->d_date = date('Y-m-d');
		$value->t_time = date('H-i-s');
		$this->ChargeLog->save($value);
	}
	public function insertSubscriber(){

		$value = $this->Subscribe->newEntity();
		$value->msisdn = $this->msisdn;
		$value->opr = $this->opr;
		$value->channel = $this->channel;
		$value->status = '1';
		$value->service = 'CFC';
		$value->subs_date = date('Y-m-d');
		$value->charge_date = date('Y-m-d');
		$value->shortcode = '25656';
		$value->entry = date('Y-m-d H:i:s');
		$value->last_update = date('Y-m-d');
		$this->Subscribe->save($value);
	}
	public function insertChargingSubscriber(){

		$value = $this->ChargingSubscribers->newEntity();
		$value->msisdn = $this->msisdn;
		$value->opr = $this->opr;
		$value->service = 'CFC';
		$value->sub_service = 'NULL';
		$value->channel = 'portal';
		$value->push_date = date('Y-m-d');
		$value->next_date = date('Y-m-d', strtotime('+1 day'));
		$value->next_content_push_date = date('Y-m-d', strtotime('+1 week'));
		$value->counter = 0;
		$this->ChargingSubscribers->save($value);	
	}
	public function ConsentSentLog($consent){
		$this->loadModel('ConsentSentLog');
		$value = $this->ConsentSentLog->newEntity();
		$value->msisdn = $this->msisdn;
		$value->operator = $this->opr;
		$value->channel = $this->channel;
		$value->transaction_id = $this->obj->generateCode();
		$value->sid = '';
		$value->confirm_portal_consent = $consent;
		$value->reference_id = $this->msisdn.date('Ymd');
		$value->raw_msisdn = $this->msisdn;
		$value->callback_url = 'http://dev.b2mwap.com.cfcmoktadir/subscribe/subscribe-callback';
		$value->consent_url = 'As per telco wise various consent URL';
		$value->created = date('Y-m-d H:i:s');
		$this->ConsentSentLog->save($value);
	}

	public function updateSubscriber($status){
		$this->Subscribe->query()
						->update()
						->set([
							'msisdn'    => $this->msisdn,
				            'opr'       => $this->opr,
				            'channel'   => 'channel',
				            'status' => $status,
				            'service'   => 'CFC',
				            'subs_date' => date('Y-m-d'),
				            'unsubs_date' => date('Y-m-d H:i:s'),
				            'shortcode' => '25656',
				            'entry' => date('Y-m-d H:i:s'),
				            'last_update' => date('Y-m-d')
							  ])
						->where(['msisdn' => $this->msisdn])
						->execute();
	}
	public function updateChargingSubscriber(){
		$this->ChargingSubscribers->query()
								  ->update()
								  ->set([
										'msisdn'    => $this->msisdn,
							            'opr'       => $this->opr,
							            'service'   => 'CFC',
							            'sub_service' => 'NULL',
							            'channel'   => 'portal',
							            'push_date' => date('Y-m-d'),
							            'next_date' => date('Y-m-d', strtotime('+1 day')),
							            'next_content_push_date' => date('Y-m-d', strtotime('+1 week')),
							            'counter'   => 0,
							            'counter_reset_date' => date('Y-m-d')
								       ])
								->where(['msisdn' => $this->msisdn])
								->execute();
	}
	public function unsub_robi_curl(){
			$productID = '0300394210';
            $url = "http://192.168.2.177:8310/robi_sm/robi_sm/subscriptionApi/subscribe_product/frm_cso/cfc_unsub.php";
            $post_data = "MSISDN=" . $this->msisdn . "&productID=" . $productID;
            // curl action
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "$url");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  
            $result = curl_exec($ch);
            curl_close($ch);
	}
	public function unsub_gp_curl(){
            $vmsisdn = $this->msisdn;
            $referenceCode = '102542';

            $source_url = "http://192.168.2.38:8080/gp_dpdp/unsubscription/unsub_request.php?vmsisdn=$vmsisdn&referenceCode=$referenceCode";

            $ch  = curl_init($source_url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $rsp = curl_exec($ch);
            curl_close($ch);

            $decoded_data   = json_decode($rsp);
            $status_code    = $decoded_data->statusInfo->statusCode;
	}
}

?>