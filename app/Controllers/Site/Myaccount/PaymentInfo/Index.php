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

    	$userid = getSiteUserID();

		$paymentcount = $this->payments->getPayments('count', ['payment']);
		$data['payments'] = $this->payments->getPayments('all', ['payment','users'], ['start' => $offset, 'length' => $perpage]);

	    $data['pager'] = $pager->makeLinks($page, $perpage, $paymentcount);
		$data['paymentinterval'] = $this->config->paymentinterval;
		$data['currencysymbol'] = $this->config->currencysymbol;
		$data['paymenttype'] = $this->config->paymenttype;

    	return view('site/myaccount/paymentinfo/index',$data);

    }

	public function view($id)
	{
    	$userid = getSiteUserID();
		//$result = $this->payments->getPayments('row', ['payment'], ['userid' => $userid, 'id' => $id]);
		$result = $this->payments->getPayments('row', ['payment','users'], [ 'id' => $id]);

		if($result){
			$data['result'] = $result;
		}else{
			$this->session->setFlashdata('danger', 'No Record Found.');
			return redirect()->to(base_url().'/myaccount/payments'); 
		}
		
		return view('site/myaccount/paymentinfo/view', $data);
	}	
}