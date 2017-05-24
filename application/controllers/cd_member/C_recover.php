<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_recover extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
          /* if ( IS_MAINTENANCE() == 1 )
           redirect('maintenance'); */
       
    }
  
    public function index()
    {
       	$Ctrl_data['page'] = 'recover';
       	$Ctrl_data['title'] = 'Recover' ;
      	//$this->load->view('v_play',$data) ;
      	$this->load->view('vd_member/v_recover',$Ctrl_data);
    }
    
}