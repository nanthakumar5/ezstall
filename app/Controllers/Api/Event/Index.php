<?php

namespace App\Controllers\Api\Event;

use App\Controllers\BaseController;

use App\Models\Event;

class Index extends BaseController
{
    public function __construct()
    {       
        $this->event = new event();             
    }
    public function index($id='')
    {   
       
        $post       = $this->request->getPost();
        $validation = \Config\Services::validation();
        if($id==1){
        $validation->setRules([ 
            'id'              => 'required',
              ],
            [ 
                'id'     => [
                    'required' => 'ID is required.',
                ]
            ]
        ); 

       }
        if($validation->withRequest($this->request)->run()== ($id!='' ? true : false)){

            $actionid   = (isset($post['id'])) ? $post['id'] : ''; 
            $datas        = $this->event->getEvent('all', ['event'],($id!='' ? ['id' => $actionid] : [])+ ['status' => ['1']]);
            
            if(count($datas) > 0){ 
                $result = [];
                foreach($datas as $data){ 
                    $result[] = [                              
                        'id'               => $data['id'],
                        'name'             => $data['name'],
                        'location'         => $data['location'],
                        'mobile'           => $data['mobile'],
                        'start_date'       => $data['start_date'],
                        'end_date'         => $data['end_date'],
                        'start_time'       => $data['start_time'],
                        'end_time'         => $data['end_time'],
                        'stalls_price'     => $data['stalls_price'],
                        'rvspots_price'    => $data['rvspots_price'],
                        'image'            => $data['image'] != '' ? base_url().'/assets/uploads/event/'.$data['image'] : '',
                    ];
                }         
            $json = ['1', count($datas).' Record(s) Found', $result];
            }else{
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
    public function action()
    {   
        $post       = $this->request->getPost();  
        
        $validation = \Config\Services::validation();
        $validation->setRules([                
                
            'name'              => 'required',
            'location'          => 'required', 
            'mobile'            => 'required',
            'start_date'        => 'required',
            'end_date'          => 'required',
            'start_time'        => 'required',
            'end_time'          => 'required',
            'stalls_price'      => 'required',
            'rvspots_price'     => 'required',
            'image'             => 'required',
            'status'            => 'required',

            ],
            
            [ 
                'name'     => [
                    'required' => 'Name is required.',
                ],
                'location'     => [
                    'required' => 'Location is required.',
                ],
                'mobile'     => [
                    'required' => 'Mobile is required.',
                ],
                'start_date'     => [
                    'required' => 'Start_date is required.',
                ],
                'end_date'     => [
                    'required' => 'End_date is required.',
                ],
                'start_time'     => [
                    'required' => 'Start_time is required.',
                ],
                'end_time'     => [
                    'required' => 'End_time is required.',
                ],
                'stalls_price'     => [
                    'required' => 'Stalls_price is required.',
                ],
                'rvspots_price'     => [
                    'required' => 'Rvspots_price is required.',
                ],
                'image'     => [
                    'required' => 'Image is required.',
                ],
                'status'     => [
                    'required' => 'Status is required.',
                ],
            ]
        ); 

        if($validation->withRequest($this->request)->run()){
            $post['actionid']           = (isset($post['id'])) ? $post['id'] : ''; 
            $datas = $this->event->action($post); 
                
            if($datas){
                $json = ['1', 'User Submitted Successfully', []];
            }else{
                $json = ['0', 'Try Later', []]; 
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