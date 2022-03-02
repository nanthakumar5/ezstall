<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Siteauthentication2 implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
		$sitesession 	= session()->get('sitesession');
		
		if(isset($sitesession['userid'])){
			$users 	= new \App\Models\Users;
			
			$result = $users->getUsers('row', ['users'], ['id' => $sitesession['userid']]);				
			if(!$result){
				return redirect()->to('/login');
			}
		}else{
			return redirect()->to('/login');
		}			
    }
	
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}