<?php

namespace App\Controllers\Api\Users;

use App\Controllers\BaseController;

use App\Models\Users;

class Index extends BaseController
{
    public function __construct()
    {       
        $this->users = new users();             
    }
    
   public function index($id='')
    {
        $post       = $this->request->getPost(); 
        $validation = \Config\Services::validation();
        if($id==1){
        $validation->setRules([   
                'id'        => 'required',
            ],
            [ 
                'id'    => [
                    'required' => 'Id is required.',
                ],
            ]
        );
        }

        if($validation->withRequest($this->request)->run() == ($id!='' ? true : false)){
            $actionid   = (isset($post['id'])) ? $post['id'] : '';
            $datas        = $this->users->getUsers('all', ['users'],($id!=''? ['id' => $actionid] : []) + ['status' => ['1']]);
            
            if(count($datas) > 0){ 
                $result = [];
                foreach($datas as $data){  
                    $result[] = [                              
                        'id'               => $data['id'],
                        'name'             => $data['name'],
                        'email'         => $data['email']
                        
                    ];
                } 
                $json = ['1', count($datas). ' Record(s) Found', $datas];
            }else {
                $json = ['0', 'No Record(s) Found', []];
            }
        }else{
            $json = ['0', $validation->getErrors(), []];
        } 

        echo json_encode([ 
            'status'        => $json[0],            
            'message'       => $json[1],  
            'result'        => $json[2],  
        ]);
        
        die;
    }
    
    public function action($id='')
    {   
        $post       = $this->request->getPost(); 
        
        $validation = \Config\Services::validation();
        $validation->setRules([        
                'name'              => 'required',
                'email'             => 'required|valid_email', 
                'password'          => 'required',
                'type'              => 'required',
                'status'            => 'required'
            ]+($id!='' ? ['id' => 'required'] : []),
            [ 
                'id'     => [
                    'required' => 'Id is required.',
                ],
                'name'     => [
                    'required' => 'Name is required.',
                ],
                'email'     => [
                    'required' => 'Email is required.',
                ],
                'password'     => [
                    'required' => 'Password is required.',
                ],
                'type'     => [
                    'required' => 'Type is required.',
                ],
                'status'     => [
                    'required' => 'Status is required.',
                ],
            ]
        ); 
        
        $actionid = $id!='' ? $post['id'] : '';
                
        if($validation->withRequest($this->request)->run()){
            $check_email = $this->users->getUsers('row', ['users'], ($id!='' ? ['neqid' => $actionid] : [])+['email' => $post['email'], 'status' => ['1','2']]);

            if($check_email){
                $json = ['0', 'Email Id Already Exists.', []];
            }else{
                $post['actionid'] = $actionid;
                $datas = $this->users->action($post); 
                
                if($datas){
                    $json = ['1', 'User Submitted Successfully', []];
                }else{
                    $json = ['0', 'Try Later', []]; 
                }                
            }
        }else{
            $json = ['0', $validation->getErrors(), []];
        }
        
        echo json_encode([ 
            'status'        => $json[0],            
            'message'       => $json[1],  
            'result'        => $json[2],  
        ]);
        
        die;
    }
    
    public function delete(){

        $post = $this->request->getPost();
        
        $validation = \Config\Services::validation();
        $validation->setRules([                
                'id'      => 'required'
            ],
            [ 
                'id'     => [
                    'required' => 'ID is required.',
                ]
            ]
        ); 
    
        if($validation->withRequest($this->request)->run()){ 
            
            $action = $this->users->delete($post);

            if($action){
                $json =  ['1','Deleted successfully.',[]];
            }else{
                $json = ['0', 'Try again later', []]; 
            }
        }else{
            $json = ['0', $validation->getErrors(), []];
        }

        echo json_encode([ 
            'status'        => $json[0],            
            'message'       => $json[1],  
            'result'        => $json[2],  
        ]);

        die;
    } 
}