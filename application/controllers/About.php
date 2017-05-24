<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
          if ( IS_MAINTENANCE() == 1 )
           redirect('maintenance');
       
    }

  
    public function index()
    {
       $Ctrl_data['page'] = 'about';
       $Ctrl_data['title'] = 'Tentang Kami' ;
      //$this->load->view('v_play',$data) ;
      $this->load->view('vd_pages/v_about',$Ctrl_data);
    }


    
   
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */
