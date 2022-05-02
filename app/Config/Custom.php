<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Custom extends BaseConfig
{
	public $usertype    		= ['1'=>'Admin','2'=>'Facility','3'=>'Producer','4'=>'Stall Manager','5'=>'Horse Owner'];
	public $status1  			= ['1'=>'Enable','2'=>'Disable'];
	public $paymentinterval 	= ['week' => 'Weekly Subscription', 'month' => 'Monthly Subscription', 'year' => 'Yearly Subscription'];
	public $paymenttype 		= ['1' => 'Payment', '2' => 'Subscription'];
	public $paymentuser 		= ['2' => 'Facility', '5' => 'Horse Owner'];
	public $paymentmethod 		= ['1'=>  'Live', '2'=>'Sandbox'];

	public $stripemode 		= "sandbox";
	public $stripepublishkey 	= "pk_test_51KP4cbSFHGSH4PJkqd00EEJHOmxlGF4eP3kAvIaLGqCspNVL8KqunYElZ0JbE4XE9FdJ253hbEX76Iv2JuakP2Eb00sceuljdR";
	public $stripesecretkey 	= "sk_test_51KP4cbSFHGSH4PJkmlyJCZBMy4uOvrKuQ6GhV2pzXKHpwoMXIagjggu2Idk6tQRh6kIpzfQ9CwdYqesZr44GuDlZ00zvV2O2sJ";
	// public $stripemode 			= "live";
	// public $stripepublishkey 	= "pk_live_51J73yoIxvVSbA04HKuyGDtsXXYyNTicHnYPYtuvLPFdXIZcY3bcM4qip2mUyMePoX2y1hGF01fnLGZb9GtX32ZYU00mjAqBEWU";
	// public $stripesecretkey 	= "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";
	
	public $currencysymbol 		= "$";
}
