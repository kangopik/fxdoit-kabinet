<?php if(!defined('BASEPATH')) exit('No direct script allowed') ;
/*
Halaman untuk me-Reset kembali keseluruhan .
AWAS fungsi ini SANGAT BERBAHAYA karena bisa menghilangkan seluruh database.
PASTIKAN database sudah di-backup sebelum melakukanini...
*/


Class C_factoryreset extends CI_Controller
{
	 public function __construct() {
        parent::__construct();

         if  (!$this->session->userdata('username') == 'proadmin')
        redirect('') ;
         else
        {

            if (!match_ip()) 
            {
                redirect('');
            }
            else
            {
                
                 if(! check_token($this->session->userdata('username')))
                redirect('');
            }

        }
        
        $this->load->model('M_users');
        $this->load->model('M_membership');
        $this->load->model('M_pin');
        $this->load->model('M_pkt');
        $this->load->model('M_general');
        
    }

/*
    public function index()
    {
    	$ctrl_data['message'] = 'Halaman untuk me-Reset kembali keseluruhan .
AWAS fungsi ini SANGAT BERBAHAYA karena bisa menghilangkan keseluruhan database.
PASTIKAN database sudah di-backup sebelum melakukan ini.';
           

    	$this->load->view('v_reset',$ctrl_data) ;
    }
*/


    function reset_all_data()
    {
    		$sql = " TRUNCATE TABLE `ci_sessions` ";  // 1
        		$query = $this->db->query($sql) ;

        	$sql = " TRUNCATE TABLE `t_frontpage` "; //2
        		$query = $this->db->query($sql) ;

        	$sql = " TRUNCATE TABLE `t_message` "; //3
        		$query = $this->db->query($sql) ;

        	$sql = " TRUNCATE TABLE `t_notif` "; //4
        		$query = $this->db->query($sql) ;	

        	$sql = " TRUNCATE TABLE `t_paket` "; //5
        		$query = $this->db->query($sql) ;

        	$sql = " TRUNCATE TABLE `t_pin` "; //6
        		$query = $this->db->query($sql) ;

        	$sql = " TRUNCATE TABLE `t_stockis` "; //7
        		$query = $this->db->query($sql) ;

    		$sql = " TRUNCATE TABLE `t_users` "; //8
        		$query = $this->db->query($sql) ;

        	$sql = " TRUNCATE TABLE `t_users_profile` "; //9
        		$query = $this->db->query($sql) ;

        	$sql = " TRUNCATE TABLE `t_users_downline` "; //10
        		$query = $this->db->query($sql) ;

        	$sql = " TRUNCATE TABLE `t_users_bonus` "; //11
        		$query = $this->db->query($sql) ;

        	$sql = " TRUNCATE TABLE `t_log` "; //12
        		$query = $this->db->query($sql) ;

          $sql = " TRUNCATE TABLE `t_valtrade` "; //13
            $query = $this->db->query($sql) ;

        	$sql = " TRUNCATE TABLE `t_order` "; //14
            $query = $this->db->query($sql) ;




        		
    }



    function original_pin($pin_proadmin,$pin_member,$pin_stockis,$stockis_member,$stockis_merchant)
    {
    	$data_proadmin = array(
    		'id' => 1 ,
    		'pin' => $pin_proadmin,
    		'stockis' => $stockis_member,
    		'user_id' => 'BELUM DIGUNAKAN',
    		'status' => '1',
    		'tgl_generate' => date("Y-m-d") ,
    		'tgl_expired' => date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day")),
    		'code' => 'A');
    		$this->db->insert('t_pin',$data_proadmin) ;


    	$data_member = array(
    		'id' => 2 ,
    		'pin' => $pin_member,
    		'stockis' => $stockis_member,
    		'user_id' => 'Belum Digunakan',
    		'status' => '1',
    		'tgl_generate' => date("Y-m-d") ,
    		'tgl_expired' => date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day")),
    		'code' => 'A');
    		$this->db->insert('t_pin',$data_member) ;


    	$data_stockis = array(
    		'id' => 3 ,
    		'pin' => $pin_stockis,
    		'stockis' => $stockis_merchant,
    		'user_id' => 'BELUM DIGUNAKAN',
    		'status' => '1',
    		'tgl_generate' => date("Y-m-d") ,
    		'tgl_expired' => date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day")),
    		'code' => 'A');
    		$this->db->insert('t_pin',$data_stockis) ;




    }






     function index()
    {
    	$ctrl_data['message'] = 'Halaman untuk me-Reset kembali keseluruhan .
AWAS fungsi ini SANGAT BERBAHAYA karena bisa menghilangkan keseluruhan database.
PASTIKAN database sudah di-backup sebelum melakukan ini.';
    	 $message = ' ';
        $set_flashdata = 'error' ;

    	 $this->form_validation->set_rules('pin_proadmin','PIN Anda','trim|required|numeric|exact_length[12]',
                                            array('numeric'=>'PIN proadmin harus Angka saja!',
                                            	   'exact_length[12]' => 'Pin proadmin HARUS PAS 12 digit!'));
       $this->form_validation->set_rules('pin_member','PIN Anda','trim|required|numeric|exact_length[12]',
                                            array('numeric'=>'PIN member harus Angka saja!',
                                            	   'exact_length[12]' => 'Pin member HARUS PAS 12 digit!'));                                   	   
      	$this->form_validation->set_rules('pin_merchant','PIN Anda','trim|required|numeric|exact_length[12]',
                                            array('numeric'=>'PIN merchant harus Angka saja!',
                                            	   'exact_length[12]' => 'Pin merchant HARUS PAS 12 digit!'));                                      	   
       
        $this->form_validation->set_rules('password_proadmin','Password Baru','required',
                                            array('required'=>'Password Tidak boleh kosong!'));
        $this->form_validation->set_rules('conf_password_proadmin','Password Pro Admin','required') ;

 		$this->form_validation->set_rules('password_member','Password Baru','required',
                                            array('required'=>'Password Tidak boleh kosong!'));
        $this->form_validation->set_rules('conf_password_member','Password Baru Konf.','required') ;





       $this->form_validation->set_error_delimiters('','<br/>') ;

        if ($this->form_validation->run() == TRUE ) // Jika Form terisi dengan benar baru check
        { // BEGIN IF FORM_VALIDATION TRUE

        		$password_proadmin = password_hash($_POST['password_proadmin'],PASSWORD_DEFAULT);
      $password_member = password_hash($_POST['password_member'],PASSWORD_DEFAULT);

      	$data_proadmin = array(
      		'username' 		=> 'proadmin',
      		'user_id' 		=> 'proadmin',
      		'sponsor_id' 	=> 'proadmin',
          'level'       => 'proadmin',
      		'password' 		=> $password_proadmin,
      		'email' 		=> $_POST['email_proadmin'],
      		'hp' 			=> $_POST['hp_proadmin'],
      		'pin' 			=> $_POST['pin_proadmin'],
          'ver' =>  1 
      	);


      	$data_member = array(
      		'username' 		=> 'C2MM_one',
      		'user_id' 		=> 'PM101100001',
      		'sponsor_id' 	=> 'proadmin', // ini adalah satu-satunya member yg DISPONSORI pro-admin
          'level'       => 'member',
      		'password' 		=> $password_member ,
      		'email' 		=> $_POST['email_member'],
      		'hp' 			=> $_POST['hp_member'],
      		'pin' 			=> $_POST['pin_member'] ,
          'ver'	 => 1
      	);

      		if($_POST['password_proadmin'] != $_POST['conf_password_proadmin'])
      		{
      			$message = $message.'<br>Password Proadmin TIDAK SAMA' ;
      			$PASS = FALSE ;
      		}
      		if($_POST['password_member'] != $_POST['conf_password_member'])
      		{
      			$message = $message.'<br>Password Member TIDAK SAMA' ;
      			$PASS = FALSE ;
      		}	
      		if ($_POST['password_reset'] != '1@mGenius!')
      		{
      			$message = $message.'- <br>Password Reset Salah!' ;
      			$PASS = FALSE ;
      		}
      		else
      			$PASS = TRUE ;

        

        if (!$PASS)
        {
                $set_flashdata = 'error';
                

        }
     
        else
        { //BEGIN IF  $_POST['password_reset'] == '1@mGenius!'

            $this->reset_all_data() ;
            $this->original_pin($_POST['pin_proadmin'],$_POST['pin_member'],$_POST['pin_merchant'],$_POST['stockis_member'], 
            $_POST['stockis_merchant']) ;
           	

           	//1.  input database t_users
           		$data_proadmin['pin'] = $_POST['pin_proadmin'];
           		$data_proadmin['stockis'] = $_POST['stockis_member'];
           	
                $input_t_users = $this->db->insert('t_users',$data_proadmin) ;

            //2. input database ke t_users_profile
                $data_profile['user_id'] = $data_proadmin['user_id'];
                $data_profile['username'] = $data_proadmin['username'];
                $data_profile['pin'] = '' ;
                $input_t_users_profile = $this->db->insert('t_users_profile',$data_profile) ;
    		
    		//3. input database t_users_downline
                $data_downline['user_id'] = $data_proadmin['user_id'];
                $data_downline['list_downline'] = 'LIST:' ;
                $input_t_users_downline = $this->db->insert('t_users_downline',$data_downline) ;


              //4.  input database t_users_bonus
                $data_bonus['user_id'] = $data_proadmin['user_id'] ;
                $data_bonus['status'] = 2;
                $data_bonus['deadline_tutup_poin'] =  date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day")) ;
                $input_t_users_bonus = $this->db->insert('t_users_bonus',$data_bonus) ;

                $this->M_pin->pinterpakai($_POST['pin_proadmin'],$data_proadmin['user_id']) ;


               //4.  input database t_paket
                $data_paket['user_id'] = $data_proadmin['user_id'] ;
                $data_paket['nama_merchant'] = 'C2MM ADMINISTRATOR';
                $data_paket['kategori'] =  'PROADMIN' ;
                $input_t_user_paket = $this->db->insert('t_paket',$data_paket) ;

                




            //check pin di database 
           $datapin = $data_member['pin'] ;
           $cek_pin = $this->M_pin->checkpin($datapin);
              
            //  BEGIN if Cek_pin 'SUCCESS'
          if ( $cek_pin['s'] == 'SUCCESS')
          {
             $data['stockis'] = $cek_pin['stockis'] ;     

             // Tentukan userleve
             if ($data['stockis'] == '999')
                $data['level'] = 'ADMIN' ;
              else
                $data['level'] = 'MEMBER' ;



            // Buat ID-nya 1.  input database t_users
            $data_member['pin'] = $_POST['pin_member'] ;
           	$data_member['stockis'] = $_POST['stockis_member'];
            $inputmember = $this->db->insert('t_users',$data_member) ;
            
             //  BEGIN if inputmember 'SUCCESS'
            if ($inputmember)
            {

                
               
                $set_flashdata = 'success';
                $message = '<h1> DaTA TER-RESET SEMPURNA! <br> Untuk RESET proadmin, ID Anda: '.$data_member['user_id'].' Pin Proadmin: '.$data_proadmin['pin'].'<br>sedangkan untuk member: <b>--ID Anda: '.$data_member['user_id'].'-- PIN Anda: '.$data_member['pin'].'<br></b> </h1>-- HARAP SIMPAN BAIK-BAIK, DATA INI HANYA DIPERLIHATKAN <u>SEKALI!</u>, untuk selanjutnya Anda dapat login dengan  username dan password Anda (yang diisi di form pendaftaran).' ;


               
               
                //2. input database ke t_users_profile
                $data_profile['user_id'] = $data_member['user_id'];
                $data_profile['username'] = $data_member['username'];
                $data_profile['pin'] = '' ;
                $input_t_users_profile = $this->db->insert('t_users_profile',$data_profile) ;

                //3. input database t_users_downline
                $data_downline['user_id'] = $data_member['user_id'];
                $data_downline['list_downline'] = 'LIST:' ;
                $input_t_users_downline = $this->db->insert('t_users_downline',$data_downline) ;

                //4.  input database t_users_bonus
                $data_bonus['user_id'] = $data_member['user_id'] ;
                $data_bonus['status'] = 2;
                $data_bonus['deadline_tutup_poin'] =  date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day")) ;
                $input_t_users_bonus = $this->db->insert('t_users_bonus',$data_bonus) ;

                $this->M_pin->pinterpakai($datapin,$data_member['user_id']) ;

                //  BEGIN if INputuser 'SUCCESS'
                if ($input_t_users_profile)
                {
                   
                       // tambahkan daftar downline buat sponsornya
                       $input_list_downline = $this->M_membership->M_A5_inputlistdownline($data_member['sponsor_id'],$data_member['user_id']) ;
                       if ($input_list_downline['s'] == 'SUCCESS')
                       {
                           // $set_flashdata = 'success' ;
                         //  $message = 'REGISTRASI SUKSES! -- '.$message ;
                        //  $testing = $this->M_membership->M_A3_inputjaringan($data['sponsor_id']) ;

                           $message = $message.'<br>Listing Added -'.$input_list_downline['s'] ;
                          
                            // Kemudian daftarkan downline buat uplinenya...untuk upline level 1,2,3

                            
                              $user_id = $data_member['user_id'] ;
                             $batas_level = batas_lv() ;
                            for ($i = 0; $i < $batas_level ; $i++)
                              {
                                $get_sponsor = $this->M_membership->M_A2_getsponsor($user_id) ; // upline 1, 2, dst ...
                                $user_id = $get_sponsor['id'] ;
                                // echo 'User ID Generasi ke '.$i.' adalah '.$user_id.'<br>' ;
                                $input_jaringan = $this->M_membership->M_A3_inputjaringan($user_id) ;

                                if($input_jaringan['s'] == 'SUCCESS')
                                  $message1 = '-Upline Added' ;
                                else
                                  $message1 = '-Upline Failed' ;
                              }

                              if ($message1 == '-Upline Added')
                              {
                                    $message = $message.$message1 ;
                                     $set_flashdata = 'success' ;  
                                   $message = $message.'<br>Listing Add-'.$input_list_downline['s'] ;
                                   $message = 'REGISTRASI SUKSES! -- '.$message ;
                                    $this->session->set_flashdata('success',$message) ;  
                                  
                                  
                                    redirect('Gate/registersuccess') ;
                                   
                              }

                       }

                       else
                       {
                          $set_flashdata = 'error' ;
                          $message = $message.'LIST'.$input_list_downline['s'].'<br>List ID: '.$input_list_downline['list_id'];

                       }                         
                   
                }
                else
                {
                	  $message = 'REGISTRASI GAGAL! LIST downline error' ;
                }
                
              
            } //  END if inputmember 'SUCCESS' 
             else 
            {
                   $message = 'REGISTRASI GAGAL! '.$inputmember['s'] ;
            }

           //  END if Cek_pin 'SUCCESS' 
          }
         else
         {
            $message = 'REGISTRASI GAGAL! '.$cek_pin['s'] ;
         }
         
        } //BEGIN IF  $_POST['password_reset'] == '1@mGenius!'




        } // END IF FORM_VALIDATION TRUE

             $ctrl_data['message'] = $message. $ctrl_data['message'] ;  
           $this->session->set_flashdata($set_flashdata,$message) ;

    	$this->load->view('v_reset',$ctrl_data) ;
         // redirect("cd_proadmin/C_factoryreset") ;


    } 
    /*  END  Fungsi Post Create diselesaikan oleh Rian */ 


}
?>
