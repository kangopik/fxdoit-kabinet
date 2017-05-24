<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_requestib extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
          /* if ( IS_MAINTENANCE() == 1 )
           redirect('maintenance'); */
       
    }
  
    public function index()
    {
       	$Ctrl_data['page'] = 'requestib';
       	$Ctrl_data['title'] = 'fxdoit';
      	//$this->load->view('v_play',$data) ;
      	$this->load->view('vd_pages/v_requestib',$Ctrl_data);
    }
    
}