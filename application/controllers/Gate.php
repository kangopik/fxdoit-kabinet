<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gate extends CI_Controller
{
  function __construct(){
        parent::__construct();  

        if ( IS_MAINTENANCE() == 1 )
           redirect('maintenance');
            
         $this->load->model('M_users');
        $this->load->model('M_pkt');
        $this->load->model('M_membership');
        $this->load->model('M_pin') ;
        $this->load->model('M_registrasi') ;
        $this->load->model('M_manager') ;
        $this->load->model('M_verrify') ;

        /*
        Khusus untuk Gate Tidak dikunci karena untuk login 
        */
        
       
        

  }

  function index()
  {
    echo 'test' ;
  }

  function TESTFUNCTION($stockis)
  {
    $pin = $this->M_pin->MAmbilPinBaru($stockis) ;
    echo $pin['pin'] ;
  }


   public function form_login()
    {
       $ctrl_data['page'] = VERBOSE(__FUNCTION__);
       $ctrl_data['title'] ='Login your account' ;
      if ($this->session->userdata('is_login') )  //or 'userlevel'
        {
            redirect('');
            
        }

      $ctrl_data['active'] = 'Login' ;
      $this->load->view('vd_pages/v_login',$ctrl_data);
    }


    function Merchant()
    {
       $this->session->set_userdata('posting_register' , TRUE);
      $data['title'] = 'Merchant Afiliasi C2MM' ;
      $data['active'] ='Merchant' ;
      $this->load->view('vd_pages/v_merchant',$data);
    }









/* Fungsi Login, diselesaikan oleh Rian, dengan dilengkapi Errors Handler , dibuat oleh Rian
===============================================================================================================================
*/
  


  function verrify()
  {
       if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
        {
        // Verify data
          $email = $this->input->get('email') ;
          $hash = $this->input->get('hash') ;

          //$email = mysql_real_escape_string($_GET['email']); // Set email variable
          //$hash = mysql_real_escape_string($_GET['hash']); // Set hash variable

          $check = $this->M_verrify->M_CheckVerificationEmail($email,$hash) ;
          if ($check['s'] = 'SUCCESS')
          {
             $this->M_verrify->DelVerrify($email) ;
            $this->session->set_flashdata('success','Email '.$email.' telah Ter-verifikasi, kini Anda bisa login dengan email dan password Anda.') ;
            unset($_GET) ;
            redirect() ;
          }
          else{
            $message = $this->session->set_flashdata('verrify','Email GAGAL, silahkan check lagi') ;
            $this->session->set_flashdata('failed',$message);
            redirect();

          }

        }
  }


  function resetpassword()
  {
     $ctrl_data['title'] = VERBOSE(__FUNCTION__) ;
    if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
        {
        // Verify data
          $email = $this->input->get('email') ;
          $hash = $this->input->get('hash') ;
          $check = XDB(1,'GET','t_verrify',array('email'=>$email,'hash'=>$hash));
          $ctrl_data['user_id']=$user_id = $check['user_id'] ;
          $ctrl_data['email'] =$email ;
        }
        else
        {
          $this->form_validation->set_rules('password','Password','trim');
          date_default_timezone_set('Asia/Jakarta');  
          $time = date('Y-m-d H:i:s');

          $this->form_validation->set_error_delimiters('','<br/>') ;
          if ($this->form_validation->run() == TRUE )
          {
             $ctrl_data['user_id'] = $user_id = $this->input->post('user_id');
             $ctrl_data['email'] = $email = $this->input->post('email');
             $password = $this->input->post('password');
             $repassword = $this->input->post('repassword');
             if ($password != $repassword)
             {
                $message = 'Password TIDAK Cocok!' ;
                $this->session->set_flashdata('failed',$message);
             }
             else
             {
                $password_jadi = password_hash($password,PASSWORD_DEFAULT);
                XDB(1,'DELETE','t_verrify',array('email'=>$email));
                XDB(1,'UPDATE','t_users',array('email' => $email),array('password'=>$password_jadi)) ;
                $message = 'Password SUKSES ter-Reset';
                $this->session->set_flashdata('success',$message);
                redirect();
             }  
          }
        }
        
          $this->load->view('vd_pages/v_resetpassword',$ctrl_data) ;
        
       
  }




   public function login()
  {  
      if ($this->session->userdata('is_login') )  //or 'userlevel'
        {
            redirect('');
        }

      $data = array('username' => $this->input->post('username', TRUE),
                    'password' => ($this->input->post('password', TRUE)));

	// huskyon.com - Inisiasi sementara
      if ($this->session->flashdata('captcha') == $this->input->post('recaptcha'))
      {
         $data['captcha'] = TRUE ;
         $hasil = $this->M_users->validate($data);
          $check = $hasil['s'] ;
          $message = 'Username ATAU Password salah!' ;
       }
      else{
        $check ='FAILED' ;
        $message = 'captcha SALAH, yang benar:'.$this->session->flashdata('captcha') ;
      }
  
    if ($check == 'SUCCESS') 
    {
      	 // if registration successful, create a session

      	//Set ke Session (semua informasi dari tabel t_user dipindahkan ke sini)
					$session_data = array(
								      'is_login' => TRUE,
								      'user_id' 	=> $hasil['user_id'],
        					   'username'   => $hasil['username'],
                     'nama'   => $hasil['nama'],
                     'email' => $hasil['email'],
        					   'userlevel'  => $hasil['userlevel'],
        					    'password'   =>  $hasil['password'],
        					    'token_login' => '1@mGeniusMan!'.$hasil['username'],
                      'match_ip' => $_SERVER['REMOTE_ADDR'].$hasil['user_id'],
                      'last_ip' => $hasil['last_ip'],
                      'last_login' => $hasil['last_login'],
        					   'rank'  	=>	$hasil['rank']) ;
        					  
       			       $this->session->set_userdata($session_data);

                   $this->M_users->set_lastlogin($this->session->userdata('user_id'),$_SERVER['REMOTE_ADDR']) ;
                
                   
             if ($this->session->userdata('user_id') =='PROADMIN') 
              {
                // $this->M_pin->hapus_pin_kadaluarsa() ;
                 redirect('cd_proadmin/C_dashboard');
               }
              else
              {
                redirect('cd_member/C_dashboard');
               }        
    }
    if ($hasil['s'] == 'UNVERIFIED')
    {
       $message = 'Mohon maaf,email Anda:'.$hasil['email']. ' BELUM TER-VERIFIKASI, mohon cek email Anda dan klik tautan verifikasi yang telah kami kirimkan pada Anda!<br>
                <a href="'.base_url().'Gate/KirimVerifikasiLagi/'.$hasil['user_id'].'">Kirim Lagi</a>';
          $this->session->set_flashdata('failed',$message) ;
          redirect() ;
    }
    else 
    {
      $this->session->set_flashdata('failed',$message) ;
      //redirect('Home/login');
      echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
    }

  }
/* END Fungsi Login, diselesaikan oleh Rian, dengan dilengkapi Errors Handler , dibuat oleh Rian
===============================================================================================================================
*/

    function KirimVerifikasiLagi($user_id)
    {
      $where_array = array('user_id' => $user_id) ;
      $data = $this->M_users-> MTableOperation('GET','t_users','',$where_array,1) ;
       $kirim = $this->M_verrify->MSend_Mail($data['nama'],$data['email'],$data['user_id'],'VERRIFICATION') ;
        $message = 'Email verifikasi telah dikirimkan lagi ke email Anda:'.$data['email']. ' , mohon cek email Anda dan klik tautan verifikasi yang telah kami kirimkan pada Anda!<br>';
          $this->session->set_flashdata('success',$message) ;
          redirect();
    }

    function ResetPassword2()
    {
        $email = $this->input->post('email'); 
        $where_array = array('email' => $email) ;
        $data = $this->M_users-> MTableOperation('GET','t_users','',$where_array,1) ;
        if (!$data)
        {
        $message = 'Maaf, email:'.$email. ' , TIDAK DITEMUKAN dalam data kami, harap perbaiki data Anda!<br>';
          $this->session->set_flashdata('failed',$message) ;
        }
        else
        {
           $passwordreset = '1242424' ;
           $password_jadi = password_hash($passwordreset,PASSWORD_DEFAULT);
           $dataform = array('password' => $password_jadi);
            $this->M_users->MTableOperation('UPDATE','t_users',$dataform,$where_array,1) ;
            $this->M_verrify->MResetPassword($email,$data['nama'],$passwordreset);
        }
       

    }


    public function logout()
     {
            $this->load->library('session');
            //Set ke Session (semua informasi dari tabel t_user dipindahkan ke sini)
          $session_data = array(
                'is_login' => $this->session->userdata('is_login'),
                'user_id'   => $this->session->userdata('user_id'),
                     'username'   => $this->session->userdata('username'),
                     'userlevel'  => $this->session->userdata('userlevel'),
                      'password'   =>  $this->session->userdata('password'),
                      'sponsor_id' => $this->session->userdata('sponsor_id'),
                      'nama'       => $this->session->userdata('nama'),
                      'tgl_pasif'  => $this->session->userdata('tgl_pasif'),
                      'token_login' =>   '$2y$10$E7jKGZDnADugmAcF3Q1qWOf9aV6SlOFx3ybukudNG4kp3KPIZCQU2'.$this->session->userdata('username'),
                     'status'   => $this->session->userdata('status'));
            $this->session->unset_userdata($session_data);         
            $this->session->sess_destroy();
            redirect(base_url());
     }

   



public function email_check()
    {
        // allow only Ajax request    
        if($this->input->is_ajax_request()) 
        {
        // grab the email value from the post variable.
        $email = $this->input->post('email');
        // check in database - table name : tbl_users  , Field name in the table : email
        $pattern = '/^admin/' ;
        if (preg_match($pattern,$email) )
        {
          // set the json object as output                 
         $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">Email Not Available</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>')));
        }
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_emails|min_length[5]|max_length[40]');
        if($this->form_validation->run() == false) 
        {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">Wrong Email!</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>')));

        }


        if(!$this->form_validation->is_unique($email, 't_users.email')) 
          {
        // set the json object as output                 
         $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">Email Not Available</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>')));
          }
        }
    }

/* check username in table database */

public function username_check()
    {
         // allow only Ajax request    
        if($this->input->is_ajax_request()) 
        {
        // grab thevalue from the post variable.
        $username = $this->input->post('username');
        // check in database - table name : tbl_users  , Field name in the table : username
        $pattern = '/^admin/' ;
        if (preg_match($pattern,$username) )
        {
          // set the json object as output                 
         $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">Username Not Available</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>')));
        }


        $this->form_validation->set_rules('username', 'username', 'trim|required|alpha_dash|min_length[5]|max_length[40]');
        if($this->form_validation->run() == false) 
        {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">Wrong character, Username Min.5 - 40 length</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>')));

        }
        $sql = "SELECT username FROM t_users WHERE username LIKE ?" ;
        $d = $this->db->query($sql,array($username.'%')) ;

        if($d->num_rows() != 0) 
          {
        // set the json object as output                 
         $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">Username Not Available</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>')));
          }
        }
    }


public function hp_check()
    {
         // allow only Ajax request    
        if($this->input->is_ajax_request()) 
        {
        // grab thevalue from the post variable.
        $hp = $this->input->post('hp');
        // check in database - table name : tbl_users  , Field name in the table : hp
       

         $this->form_validation->set_rules('hp', 'hp', 'trim|required|numeric|min_length[2]|max_length[20]');
        if($this->form_validation->run() == false) 
        {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">No. HP salah!</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>')));

        }


        if(!$this->form_validation->is_unique($hp, 't_users.hp')) 
          {
        // set the json object as output                 
         $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">No.hp Not Available</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>')));
          }
        }
    }


public function pin_check()
    {
         // allow only Ajax request    
        if($this->input->is_ajax_request()) 
        {
        // grab thevalue from the post variable.
        $pin = $this->input->post('pin');
        $pangkat = $this->input->post('pangkat') ;
        // check in database - table name : tbl_users  , Field name in the table : pin
       

         $this->form_validation->set_rules('pin', 'pin', 'trim|required|min_length[2]|max_length[18]');
        if($this->form_validation->run() == false) 
        {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">No. pin salah!</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>','switch' =>'OFF')));

        }


        if($this->form_validation->is_unique($pin, 't_pin.pin')) 
        {
             $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">PIN TIDAK ADA atau TIDAK SESUAI!</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>','switch' => 'OFF')));

        }
        else
        {
         // di database PIN harus ADA dan TERVALIDASI ( 'status' = 1)
        $sql = "SELECT * FROM t_pin WHERE pin=? AND pangkat=? ";   

        $condition = array($pin,$pangkat)  ;
        $query = $this->db->query($sql,$condition);  
       
        if ($query->num_rows() == 1)
        {
          $result = $query->row_array();
          $status_pin = $result['status'] ;
          if ($status_pin == 1)
          {
            $s = 'SUCCESS' ;
            $stockis = $result['stockis']; 
          }
          if ($status_pin == 0)
          {
            $s = 'PIN BELUM TERVALIDASI!';
             $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">'.$s.'</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>',  'switch' => 'OFF')));

          }
          if ($status_pin == 2)
          {
            $s = 'PIN SUDAH DIGUNAKAN!' ;
             $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">'.$s.'</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>', 'switch' => 'OFF')));
          }
          elseif ($status_pin == 1)
          {
              if ($result['pangkat'] != $pangkat )
                $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">Pangkat dan PIN TIDAK SESUAI !!</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>' , 'switch' => 'OFF')));
          }

        }
        elseif($query->num_rows() == 0)
            $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">PIN SALAH ATAU TIDAK SESUAI!</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>', 'switch' => 'OFF')));

        }


        }
    }





public function sponsor_id_check()
    {
         


         // allow only Ajax request    
        if($this->input->is_ajax_request()) 
        {
        // grab thevalue from the post variable.
        $sponsor_id = $this->input->post('sponsor_id');
        // check in database - table name : tbl_users  , Field name in the table : sponsor_id
        $pattern = '/^admin/' ;
        if (preg_match($pattern,$sponsor_id) )
        {
          // set the json object as output                 
         $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">sponsor_id Not Available</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>', 'switch' => 'OFF')));
        }


        $sql ="SELECT * FROM t_users WHERE username=?" ;
        $query = $this->db->query($sql,array($sponsor_id)) ;
        $result =  $query->row_array() ; $username_sponsor = $result['username'] ;

        $sql1 ="SELECT * FROM t_users WHERE user_id=?" ;
        $query1 = $this->db->query($sql1,array($result['user_id'])) ;
        $result1 =  $query1->row_array() ;
        $nama_sponsor = $result1['nama'] ;
       
        if($query->num_rows() != 1) 
          {
        // set the json object as output                 
         $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">Sponsor Tidak Ditemukan</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>','switch' => 'OFF')));
          }
          else
          {/*
               $this->output->set_content_type('application/json')->set_output(json_encode(array('kenali_sponsor_anda' => '<b><font style="color:lightblue;"><h3>Kenali sponsor Anda. Betulkah ini? '.$nama_sponsor.' ('.$username_sponsor.') <br>USER ID: '.$sponsor_id.'<br><h3></font><br>
                  <img src="'.lihatfoto($sponsor_id).'">                       '))); */

          }
         
        }
    }

public function conf_password_check()
    {
         // allow only Ajax request    
        if($this->input->is_ajax_request()) 
        {
        // grab thevalue from the post variable.
        $conf_password = $this->input->post('conf_password');
        $password = $this->input->post('password') ;


        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[5]|max_length[40]');
        if($this->form_validation->run() == false) 
        {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">Password Min.5 - 40 length</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>')));

        }


        if ($conf_password != $password)
          {
        // set the json object as output                 
         $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">Password NOT Match!</font></b>','submitbutton' => '<b><font style="color:red;">Off , Plese FIX Error First!</font></b>','switch'=>'OFF')));
          }
        }
    }


public function upline_check()
    {
         
         // allow only Ajax request    
        if($this->input->is_ajax_request()) 
        {
          // grab thevalue from the post variable.
          $upline_id = $this->input->post('upline');
          $posisi = $this->input->post('posisi') ;

          $sql = "SELECT * FROM t_users WHERE user_id =? ";
          $s = $this->db->query($sql,$upline_id);
          $s = $s->num_rows();
          if ($s == 0)
          {
              $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">Maaf, upline tidak ditemukan, mohon pilih tempat lain atau lihat Pohon Jaringan</font></b>','switch' => 'OFF')));
          } 
          else
          {

                 // cari database 
              $downline = 'downline_'.$posisi ;
              $sql = "SELECT $downline FROM t_users WHERE user_id=?" ;
              $q = $this->db->query($sql,$upline_id);
              $q = $q->row_array();
              if ($q[$downline] != '') // sudah terisi
              {
                   // set the json object as output                 
             $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => '<b><font style="color:red;">Maaf, posisi upline sebelah '.$posisi.' sudah terisi, mohon pilih tempat lain atau lihat Pohon Jaringan</font></b>','switch' => 'OFF')));
              }
          }

         
         
        }
    }





    function registersuccess()
    {
      $data['active'] = 'Register Success' ;
      $this->load->view('vd_pages/v_registersuccess',$data) ;

    }



 public function create()
    {
      $data['title'] = 'Registration Form' ;
      $data['active'] = 'Register' ;
        $this->session->set_userdata('posting_register' , TRUE);
      $this->load->view('vd_member/v_registrasi',$data);
    }


/*======Fungsi Register (Post Create) , diselesaikan oleh Rian ================================================================================================================
*/
   function post_create()
    {
         $company ='Fxdoit' ;
         $PASS_00 = FALSE ;   
        /*  huskyin.com - Membuat session data untuk mencegah data terkirim dua kali pada koneksi lambat
        sumber: 
        --http://blog.rosihanari.net/script-php-untuk-mencegah-submit-form-berulang-kali/
        --http://www.kurungkurawal.com/2013/05/14/cegah-double-post-dengan-http-postredirectget/
        */
        if($this->session->userdata('posting_register') == FALSE)
        {
           $data['active'] = 'Register' ;
           $this->load->view('vd_pages/v_register',$data);
          die();
        }
        else
        {
          $this->session->set_userdata('posting_register', FALSE);
          date_default_timezone_set('Asia/Jakarta');  

          $desired_length = 10; //or whatever length you want
          $unique = uniqid();

          $password = substr($unique, 0, $desired_length);
          $pin = rand(100000,999999);

           $password_jadi = password_hash($password,PASSWORD_DEFAULT);
           $data = array(
            'nama'      => $this->input->post('nama'),
            'email'      => $this->input->post('email'),
             'username' => $this->input->post('email'),
             'hp'      => $this->input->post('hp'),
            'rank' => 1 ,
            'password'  => $password_jadi,
            'email_verify' => 0,
            'register_date' => date('Y-m-d H:i:s'),
            'reg_type' => 'FORM'
           
       			); // Nanti diganti sesuai pangkat Sponsornya
          $PASS_00 = TRUE ;

          
          $dataprofile = array(
             'type_id'      => $this->input->post('type_id'),
            'no_id'      => $this->input->post('no_id'),
               'city'      => $this->input->post('city'),
            'province'  => $this->input->post('province'),
             'country'  => $this->input->post('country'),
           
            ); // Nanti diganti sesuai pangkat Sponsornya

          $datawallet = array(
             'type_akun'  => $this->input->post('type_akun'),
             'leverage'  => $this->input->post('leverage'),
             'pin' => $pin,
          );


        }
        
        if($PASS_00)
        {
            $message = 'REGISTRASI GAGAL! <br>';
            $set_flashdata = 'error' ;
            $check_setuju = $this->input->post('check_setuju') ;

            $PASS = TRUE ;

            if ($PASS)
            { 
                if($this->session->userdata('user_id') != '')
                {
                   $PASS = FALSE ;
                    $message = 'REGISTRASI GAGAL! Anda sudah pernah terdaftar <br>';
                    $set_flashdata = 'error' ;
                }
            }
            
   
            if ($PASS)
            {  // semua test BERHASIL, lakukan registrasi di sini...
              $user_id = $data['user_id'] = $dataprofile['user_id'] = $datawallet['user_id'] =
                   $this->M_manager->CreateId($_POST['province']);
                   $datawallet['deposit'] = 10000 ;
            	$this->db->insert('t_users',$data);
            	$this->db->insert('t_users_profile',$dataprofile);
            	$this->db->insert('t_users_wallet',$datawallet) ;

                 //kirim email pendaftaran untuk konfirmasi
                 //if (EMAIL_CONFIRMATION($user_id) == 1)
                // {
                  // di online tolong un-comment ini
            
  // $confirm = $this->M_verrify->MSend_Email2($data['nama'],$data['email'],$data['user_id'],'VERRIFICATION') ;
           
                 //   if ($confirm == 'SUCCESS')
                 //       $message = 'REGISTRATION SUCCESS, email verification send to: '.$data['email'].' , plese click your verification in email' ;
                 //   else{
                      $message = 'REGISTRATION SUCCESS,Now you may login with your email' ;
                      $where_array = array('user_id' => $data['user_id']);
                      $this->db->where($where_array);
                      $this->db->set('email_verify',1);
                      $this->db->update('t_users') ;
                //    }
        
                    $set_flashdata = 'success';
                         $this->session->set_flashdata('success',$message) ;
                // }
                    $ctrl_data['message'] = $message;
                    $ctrl_data['password'] = $password ;
                    $ctrl_data['pin'] = $pin;
                    $ctrl_data['no_akun'] = $user_id;
                    $this->load->view('vd_pages/v_register_success',$ctrl_data);
                 
            }
            elseif (!$PASS)
            {
                $set_flashdata = 'error';
                  $this->session->set_flashdata('error',$message) ;
                   redirect('Gate/create');
            }
         
        }
        else
          redirect('cd_member/C_registrasi');
        
        
    }   
    /*  END  Fungsi Post Create diselesaikan oleh Rian */ 

    function RegisterPanaloka($company,$user_id) // diambil dari AJax
    {
        
          $url_client = "http://localhost/panaloka.com/api/RegisterC2mm?userid=".$userid ;
          $client = curl_init($url_client) ;

          curl_setopt($client,CURLOPT_RETURNTRANSFER,1) ;
          // get response from Resource
          $response = curl_exec($client) ;
          $result = json_decode($response) ;

          if ($result->status == 200 )
            $message = 'SUCCESS' ;
          else
            $message = 'FAILED' ;
        
        return $message ;
    }


    function RequestId($user_id,$pangkat)
    {
       $list_id =array() ;
       $list_id[0] = $user_id ;
        for ($i=1 ; $i < $pangkat ; $i++ )
        {
             $tmp = (int)$i ;
             $kd = sprintf("%02s", $tmp);
             $list_id[$i] = $user_id.'_'.$kd ;
             
        }
        return  $list_id ;
    }


   

  

  
}