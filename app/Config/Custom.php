<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Custom extends BaseConfig
{
	public $usertype    = ['1'=>'Admin','2'=>'Facility','3'=>'Producer','4'=>'Stall Manager','5'=>'Horse Owner'];
	public $status1  	= ['1'=>'Enable','2'=>'Disable'];
}
