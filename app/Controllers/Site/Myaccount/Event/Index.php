<?php 
namespace App\Controllers\Site\Myaccount\Event;

use App\Controllers\BaseController;
use App\Models\Users;
use App\Models\Event;
use App\Models\Stripe;

class Index extends BaseController
{
	public function __construct()
	{	
		$this->event = new Event();
		$this->users = new Users();
		$this->stripe = new Stripe();
	}
    
    public function index()
    { 			
		$userdetail = getSiteUserDetails();
		$userid = $userdetail['id'];
		
		if ($this->request->getMethod()=='post')
        {
			$requestData = $this->request->getPost();
			if(isset($requestData['stripepay'])){
				$payment = $this->stripe->stripepayment($requestData);
				if($payment){
					$usersubscriptioncount = $userdetail['subscription_count'];
					$this->users->action(['user_id' => $userid, 'actionid' => $userid, 'subscriptioncount' => $usersubscriptioncount+1]);
					$this->session->setFlashdata('success', 'Successfully paid.');
				}else{
					$this->session->setFlashdata('danger', 'Try Later.');
				}
				
				return redirect()->to(base_url().'/myaccount/dashboard'); 
			}else{
				$result = $this->event->delete($requestData);
				
				if($result){
					$this->session->setFlashdata('success', 'Event deleted successfully.');
					return redirect()->to(base_url().'/myaccount/events'); 
				}else{
					$this->session->setFlashdata('danger', 'Try Later');
					return redirect()->to(base_url().'/myaccount/events'); 
				}
			}
        }
		
    	$pager = service('pager'); 
		$page = (int)(($this->request->getVar('page')!==null) ? $this->request->getVar('page') :1)-1;
		$perpage =  5; 
		$offset = $page * $perpage;
		
		if($this->request->getVar('q')!==null){
			$searchdata = ['search' => ['value' => $this->request->getVar('q')], 'page' => 'events'];
			$data['search'] = $this->request->getVar('q');
		}else{
			$searchdata = [];
			$data['search'] = '';
		}
		
		$eventcount = $this->event->getEvent('count', ['event'], $searchdata+['status' => ['1'], 'userid' => $userid]);
		$event = $this->event->getEvent('all', ['event'], $searchdata+['status' => ['1'], 'start' => $offset, 'length' => $perpage, 'userid' => $userid]);
        $data['list'] = $event;
        $data['pager'] = $pager->makeLinks($page, $perpage, $eventcount);
		$data['userid'] = $userid;
		$data['eventcount'] = $eventcount;
    	$data['stripe'] = view('site/common/stripe/stripe1', ['stripepublishkey' => $this->config->stripepublishkey, 'userdetail' => $userdetail]);
		
		return view('site/myaccount/event/index', $data);
    }

    public function action($id='')
	{   
		$userid = getSiteUserID();
		$checksubscription = checkSubscription();
		$checksubscriptiontype = $checksubscription['type'];
		$checksubscriptionfacility = $checksubscription['facility'];
		$checksubscriptionproducer = $checksubscription['producer'];
		$eventcount = $this->event->getEvent('count', ['event'], ['status' => ['1'], 'userid' => $userid]);
		
		if($checksubscriptiontype=='2' && $checksubscriptionfacility!='1'){
			$this->session->setFlashdata('danger', 'Please subscribe the account.');
			return redirect()->to(base_url().'/myaccount/subscription'); 
		}elseif($checksubscriptiontype=='3' && $checksubscriptionproducer <= $eventcount){
			$this->session->setFlashdata('danger', 'Please subscribe the account.');
			return redirect()->to(base_url().'/myaccount/events'); 
		}
		
		if($id!=''){
			$result = $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id, 'status' => ['1'], 'userid' => $userid]);
			if($result){
				$data['result'] = $result;
			}else{
				$this->session->setFlashdata('danger', 'No Record Found.');
				return redirect()->to(base_url().'/myaccount/events'); 
			}
		}
		
		if ($this->request->getMethod()=='post'){
            $result = $this->event->action($this->request->getPost());
			
			if($result){
				$this->session->setFlashdata('success', 'Event submitted successfully.');
				return redirect()->to(base_url().'/myaccount/events'); 
			}else{
				$this->session->setFlashdata('danger', 'Try Later.');
				return redirect()->to(base_url().'/myaccount/events'); 
			}
        } 
		
		$data['userid'] = $userid;
		$data['statuslist'] = $this->config->status1;
		return view('site/myaccount/event/action', $data);
	}
}
