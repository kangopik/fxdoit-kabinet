<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
//           if ( IS_MAINTENANCE() == 1 )
//            redirect('maintenance');
       
    }

  
    public function index()
    {
       $Ctrl_data['page'] ='home' ;
       $Ctrl_data['title'] = 'Dapat DO-IT dari Trading Forex' ;
      //$this->load->view('v_play',$data) ;
      $this->load->view('v_layout',$Ctrl_data);
    }


    
   
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */
