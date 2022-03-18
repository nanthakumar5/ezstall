<?php
namespace App\Controllers\Site\Myaccount\PaymentInfo;

use App\Controllers\BaseController;
use App\Models\Payments;

class Index extends BaseController
{
	public function __construct()
	{
		$this->payments = new Payments();	
	}

	public function index()
    {
    	$pager = service('pager'); 
		$page = (int)(($this->request->getVar('page')!==null) ? $this->request->getVar('page') :1)-1;
		$perpage =  5; 
		$offset = $page * $perpage;

    	$userdetail = getSiteUserDetails();
        $userid=$userdetail['id'];

		$paymentcount = $this->payments->getPayments('count', ['payment']);
		$data['payments'] = $this->payments->getPayments('all', ['payment'], ['userid' => $userid,'start' => $offset, 'length' => $perpage]);
	    $data['pager'] = $pager->makeLinks($page, $perpage, $paymentcount);
		$data['paymentinterval'] = $this->config->paymentinterval;
		$data['currencysymbol'] = $this->config->currencysymbol;
		$data['paymenttype'] = $this->config->paymenttype;



    	return view('site/myaccount/paymentinfo/index',$data);

    }
}