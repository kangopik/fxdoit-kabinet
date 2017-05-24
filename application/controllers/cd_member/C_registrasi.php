<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_registrasi extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
          /* if ( IS_MAINTENANCE() == 1 )
           redirect('maintenance'); */
       
    }
  
    public function index()
    {
       	$Ctrl_data['page'] = 'registrasi';
       	$Ctrl_data['title'] = 'Registrasi' ;
      	//$this->load->view('v_play',$data) ;
      	$this->load->view('vd_member/v_registrasi',$Ctrl_data);
    }
    
}