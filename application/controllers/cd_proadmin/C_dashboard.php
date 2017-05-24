<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_dashboard extends CI_Controller {
   
    public function __construct() {
        parent::__construct();

        if ( IS_MAINTENANCE() == 1 )
           redirect('maintenance');

        if  ($this->session->userdata('username') != 'proadmin')
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

    public function index() 
    {
        $user_id = $this->session->userdata('user_id');
        $data['title'] = 'Proadmin Dasboard';
        $data['username'] = $this->session->userdata('username');
        $data['user_id'] = $user_id;
        $checkbonus = XDB(1,'GET','t_users_bonus',array('user_id'=>$user_id));
        $data['akumulasi bonus'] = number_format($checkbonus['akumulasi_bonus']) ;
        $downline = XDB(1,'GET','t_users_downline',array('user_id'=>$user_id));
        $data['deadline'] = $downline['week_end'] ;
        $data['users_downline'] =  $downline;
       
      $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_dashboard_index',$data); 
    }


   function RecheckDownline()
   {
       for ($b=0;$b<6;$b++)
          {
            $total = XDB(1,'GETALL','t_users_downline',array('board'=>$b ))['TOTAL'];
             if($total != 0)
             {
               $table = 't_board_'.$b  ;
                $check = XDB(1,'GETALL',$table,array('id !='=>0 ))['RESULT'];
                foreach($check as $r)
                {
                  $do = XDB(1,'GET','t_users_downline',array('user_id'=>$r->user_id))['total_downline'];
                  XDB(1,'UPDATE',$table,array('user_id'=>$r->user_id),array('total_downline'=>$do));
                }
             }
          }

           $message = 'Komposisi Downline TELAH di-Refresh!';
        $this->session->set_flashdata('success',$message);
        redirect('cd_proadmin/C_dashboard/Event');
   }



   function COMPETITION($no_board=NULL)
   {
     if ($_POST['password'] == '22Maret2017')
     {
        $this->load->helper('competition') ;
        if ($no_board==NULL)
        {
            for ($b=0;$b<6;$b++)
          {
            $check = XDB(1,'GETALL','t_users_downline',array('board'=>$b ))['TOTAL'];
             if($check != 0)
             {
              $this->load->helper('competition');
              COMPETITION($b);
             }
          }
        }
        
      
       $message = 'Kompetisi Sponsor selesai, susunan kini berubah!';
        $dataform = array('type'=>3, 'event'=>'SPONSOR COMPETITON DONE!!') ;
           $this->db->insert('t_log_fly',$dataform);
        $this->session->set_flashdata('success',$message);
        redirect('cd_proadmin/C_dashboard/Event');
     }
     else
     {
        $message = 'Password Kompetisi SALAH!';
        $this->session->set_flashdata('failed',$message);
        redirect('cd_proadmin/C_dashboard/Event');
     }
   
  }

   function Account_List()
   {
      $ctrl_data['title'] = VERBOSE(__FUNCTION__) ;
      $ctrl_data['subtitle'] = 'List Akun Trading' ;
      $ctrl_data['item_list'] = XDB(1,'GETALL','t_users_account',array('id !='=>0))['RESULT'];
       $this->load->view('vd_member/v_proadmin_akunlist',$ctrl_data);
   }

   function Open_Account_Confirm($account_id)
    {
      XDB(1,'UPDATE','t_users_account',array('account_id'=>$account_id),array('status'=>1));
      $this->session->set_flashdata('success','Akun '.$account_id.' Terbentuk!')
      redirect('cd_proadmin/C_dashboard/Account_List');
    }


  function Event()
  { 
      $ctrl_data['title'] = VERBOSE(__FUNCTION__) ;
      $ctrl_data['message'] = 'Tentukan Event Yang Akan dijalankan';
      $this->load->view('vd_proadmin/v_dashboard_event',$ctrl_data) ;
  }



    public function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');
        session_destroy();
        redirect('');
    }
     function dashboard()
    {
      $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_dashboard');
    }

    

    function VerifikasiManual($user_id)
    {
         $dataform = array('ver' => 1) ;
        $this->db->where(array('user_id' => $user_id)) ;
        $this->db->update('t_users',$dataform) ;
        redirect('cd_proadmin/C_dashboard/VerifikasiMember') ;
    }

    function VerifikasiMember()
    {
        $this->db->where(array('ver' => 0));
        $q = $this->db->get('t_users') ;
        $ctrl_data['item_list'] = $q->result();
        $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_vermanual',$ctrl_data) ;
    }



/* huskyin.com - function dibuat oleh Rian 
    FUNGSINYA untuk menggene-rate PIN dan dimasukkan ke dalam database
*/
    function orderpin()
    {


        $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_orderpin') ;
    }


    function alltrx()
    {
        $this->load->model('M_pkt');
        $data['t_valtrade']=$this->M_pkt->lihat_valtrade();
        $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_alltrx',$data);
    }

/* ############################################ TENTANG PIN #####################################################*/

    function pinmaker()
    {
        $ctrl_data['title'] = 'Pin Maker' ;
        $ctrl_data['message'] = '';
        $ctrl_data['listpin'] = array();
        $this->data['controller_message'] = '<i>Note : masukan jumlah pin dan kode stockis yang akan dibuat</i>' ;
       $this->form_validation->set_rules('jumlah_pin','Jumlah Pin','trim|required|numeric',
                                            array('numeric'=>'GAGAL! Jumlah Pin harus Angka!'));
       $this->form_validation->set_rules('pin','PIN Anda','trim|required|numeric',
                                            array('numeric'=>'GAGAL! PIN harus Angka saja!',
                                               'required' => 'GAGAL! PIN TIDAK BOLEH kosong!'));
       $this->form_validation->set_rules('kode_stockis','Kode Stockis','trim|required|numeric|exact_length[3]',
                                            array('numeric'=>'GAGAL! Token harus Angka saja!',
                                               'exact_length'=> 'GAGAL! Kode stokis harus TEPAT 3 digit angka!',
                                               'required' => 'GAGAL! Token TIDAK BOLEH kosong!'));

      $this->form_validation->set_error_delimiters('','<br/>') ;
      if ($this->form_validation->run() == TRUE )
      {
         $jumlahpin = $_POST['jumlah_pin'] ;
         $kodestockis = $_POST['kode_stockis'] ;
         $pangkat = $_POST['pangkat'];
         $user_id = $this->session->userdata('user_id') ;
         $nominal = NominalPin($pangkat) ;

         
         if ($_POST['pin'] != '')
         {
          $pin = $_POST['pin'] ;

          $checkpin = $this->M_pin->checkpin_user_id($_POST['pin'],$this->session->userdata('user_id')) ;
             if ($checkpin == 'PIN COCOK')
            {

                for ( $i = 0 ; $i < $jumlahpin ; $i++)
                {
                    $hasil_generate = $this->M_pin->pinmaker($kodestockis,$nominal,$user_id,$pangkat) ;
                    if ($hasil_generate['s'] == 'SUCCESS')
                    {
                          $listpin[$i] = $hasil_generate['pin_tercipta'] ;
           
                    }
                 }
              $ctrl_data['listpin'] = $listpin ;
              $ctrl_data['message'] = $jumlahpin.' PIN baru tercipta untuk paket /pangkat : '.$pangkat ;
             $jumlahpin = 0 ; 
            }
            else
              $ctrl_data['message'] = '<font color="red">ERROR! '.$checkpin.'</font>' ;
          }
      }
      unset($formdata) ;
      unset($listpin);
      unset($_POST['pin']) ;  unset($_POST['jumlahpin']) ;
      $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_pinmaker',$ctrl_data);
    }



   function ValidatePin($no_pin)
   {
     $this->db->where(array('pin' => $no_pin));
     $q = $this->db->get('t_pin');
     $status = $q->row_array()['status'];
     if ($status == 0)
     {
        $sql = "UPDATE t_pin SET status=1 WHERE pin=?" ;
        $this->db->query($sql,$no_pin) ;
        $this->session->set_flashdata('success','Pin Ter-Validasi untuk nomor: '.$no_pin) ;

       
     }
       redirect('cd_proadmin/C_dashboard/daftarpin');
   }





   function DeletePin($pin)
   {
      $where_array = array('pin' => $pin) ;
      $this->db->where($where_array) ;
      $this->db->delete('t_pin');
       $this->session->set_flashdata('success','Pin no: '.$pin.' telah TERHAPUS!') ;
      redirect('cd_proadmin/C_dashboard/daftarpin') ;
   }

    function DeletePinRO($pin)
   {
      $where_array = array('pin' => $pin) ;
      $this->db->where($where_array) ;
      $this->db->delete('t_pin');
      $this->session->set_flashdata('success','Pin no: '.$pin.' telah TERHAPUS!') ;
      redirect('cd_proadmin/C_dashboard/daftarpinro') ;
   }



   function jualpinro($no_pin)
   {
     $this->db->where(array('pin' => $no_pin));
     $q = $this->db->get('t_pin');
     $status = $q->row_array()['status'];
     if ($status == 0)
     {
        $sql = "UPDATE t_pin SET code=1 WHERE pin=?" ;
        $this->db->query($sql,$no_pin) ;
        $this->session->set_flashdata('success','Pin Ter-Validasi untuk nomor: '.$no_pin) ;

       
     }
       redirect('cd_proadmin/C_dashboard/daftarpinro');
   }


   public function daftarpin()
    {
      $data['title'] = 'Daftar Pin' ;
      $data['message'] = '' ;
        $this->load->model('M_pin');    
        $data['t_pin'] = $this->M_pin->lihatpin();
        $this->load->view('vd_proadmin/v_dafpin',$data);
    }

    public function daftarpinro()
    {
      $data['title'] = 'Daftar Pin Re-Entry' ;
      $data['message'] = '' ;
        $this->load->model('M_pin');    
        $data['t_pin'] = $this->M_pin->lihatpinro();
        $this->load->view('vd_proadmin/v_dafpinro',$data);
    }
    





   function general()
    {
      $this->load->model('M_users');
      $data['t_general']=$this->M_users->general();
      $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_general',$data);
    }


function postgeneral()
     {
   
    $this->load->model('M_users');
    $this->M_users->update_general();
    redirect('cd_proadmin/C_dashboard/general');
    }



   function edprofil()
        { 
        $username = $this->session->userdata('username');    
        $data['t_users'] = $this->M_users->get_profil($username);
        $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_edprofil',$data);
        }
    function postprofil()
     {
    $id = $this->input->post('id');
    $user_id = $this->input->post('user_id');
    $alamat = $this->input->post('alamat');
    $nama = $this->input->post('nama');
    $sponsor_id = $this->input->post('sponsor_id');
    $tgl_registrasi = $this->input->post('tgl_registrasi');
    $email = $this->input->post('email');
    $provinsi = $this->input->post('provinsi');
    $wa = $this->input->post('wa');
    $bbm = $this->input->post('bbm');
    $hp = $this->input->post('hp');
    $ktp = $this->input->post('ktp');
    $bank = $this->input->post('bank');
    $rek = $this->input->post('rek');
     $data = array(
            'alamat' => $alamat,
            'nama' => $nama,
            'sponsor_id' => $sponsor_id,
            'tgl_registrasi' => $tgl_registrasi,
            'email' => $email,
            'provinsi' => $provinsi,
            'wa' => $wa,
            'bbm' => $bbm,
            'hp' => $hp,
            'ktp' => $ktp,
            'bank' => $bank,
            'rek' => $rek
            );
    $where = array ('user_id' => $this->session->userdata['user_id'] ) ;
    $this->M_users->update_users($where,$data,'t_users');
    redirect('Pages');
    }
   
    function akun()
        { 
        $username = $this->session->userdata('username');    
        $data['t_users'] = $this->M_users->get_profil($username);
        $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_akun',$data);
        }


    function postakun()
     {
    $password = $this->input->post('password');
     $data = array('password' => $password);
    $where = array ('user_id' => $this->session->userdata['user_id'] ) ;
    $this->M_users->update_users($where,$data,'t_users');
    redirect('Pages');
    }
    function paket()
    {
      $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_paket');
    }
    function post_pkt()
    {
        $data=array
        (
        'user_id'=>$_POST['user_id'],
        'nama_pkt'=>$_POST['nama_pkt'],
        'list_pkt'=>'0',
        'diskon_pkt'=>$_POST['diskon_pkt'],
        'minimal_pkt'=>$_POST['minimal_pkt'],
        'tgl_pkt' => date('Y-m-d')
        );
        $this->load->model('M_pkt');
        $this->M_pkt->insert($data);
        redirect('Pages'); 
    }


    function lihat_pkt()
    {
      $ctrl_data['message'] = '' ;
      $this->load->model('M_pkt');
      $ctrl_data['t_paket']=$this->M_pkt->lihat_pkt();
      $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_dafpaket',$ctrl_data);
    }



    function edit_pkt()
    {
    $where = array('user_id' => $user_id);
    $data['t_paket'] = $this->M_pkt->edit_pkt($where,'t_paket')->result();
    $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_editpkt',$data);
    }



    function edit_paket()
    {
        $user_id = $this->input->post('user_id');
        $diskon_pkt = $this->input->post('diskon_pkt');
        $top_up = $this->input->post('top_up');
        $exclusive = $this->input->post('exclusive') ;

    }


    function update_pkt()
    {
      $ctrl_data['message'] = '' ;

      $this->form_validation->set_rules('diskon_pkt','Diskon Paket','trim|required|numeric',
                                            array('numeric'=>'ERROR! Diskon paket harus Angka dan titik saja!'));
      
       $this->form_validation->set_error_delimiters('','<br/>') ;

      
     
       $PASS = $PASS_1 = $PASS_1B = $PASS_2 = FALSE ;
       if ($this->form_validation->run() == TRUE )
         $PASS = TRUE ;
       else
         $ctrl_data['message'] = '' ;

       if($PASS)
       {
          $PASS = FALSE ;
          // Check Operator dan passwordnya 
          $operator = $_POST['operator'] ;
           $check_op = $this->M_pkt->check_operator_user($this->session->userdata('user_id'),$operator) ;
           if ($check_op['s'] == 'SUCCESS')
           {
              $no_operator = $check_op['no_operator'] ;
              $password_opr = $_POST['password_opr'] ;
              $check_pass = $this->M_pkt->check_operator_password($this->session->userdata('user_id'),$password_opr,$no_operator) ;
              if($check_pass['s'] == 'SUCCESS')
              {
                  $PASS_1 = TRUE ;
              }
              else
                 $ctrl_data['message'] = $check_pass['s'] ;
           }
           else
              $ctrl_data['message'] = $check_op['s'] ;

       }

       if ($PASS_1)
       {
          $merchant_id = $this->input->post('merchant_id');
          $diskon_pkt = $this->input->post('diskon_pkt');
          $top_up = $this->input->post('top_up');
          $exclusive = $this->input->post('exclusive') ;
          $data = array(
                        'user_id' => $merchant_id,
                         'diskon_pkt' => $diskon_pkt,
                         'tgl_pkt' => date('Y-m-d'),
                          'exclusive' => $exclusive
                                );
           $where = array('user_id' => $merchant_id);
           $this->M_pkt->update_pkt($where,$data,'t_paket');
                        
            //khusus untuk top_up deposit
            $this->M_pkt->M_TambahDepositMerchant($merchant_id,$top_up);
          // redirect('cd_proadmin/C_dashboard/lihat_pkt');
            $ctrl_data['message'] = '<h4><font color="green">Merchant '.$merchant_id.' Ter-Update!</font></h4>';

       }
       if(!$PASS)
         $ctrl_data['message'] = '<h4><font color="red">'.$ctrl_data['message'].'</font></h4>';

        /* Menampilkan jumlah transaksi milik ID tertentu (untuk sementara ditulis 0 dulu ) - huskyin.com
          $this->db->select_sum()

            Writes a “SELECT SUM(field)” portion for your query. As with select_max(), You can optionally include a second parameter to rename the resulting field.

            $this->db->select_sum('age');
            $query = $this->db->get('members'); // Produces: SELECT SUM(age) as age FROM members


          Sumur: http://localhost/Codeigniter-3.0.6/user_guide/database/query_builder.html?highlight=db%20sum#CI_DB_query_builder::select_sum
        */


      $ctrl_data['t_paket']=$this->M_pkt->lihat_pkt();
      $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_dafpaket',$ctrl_data);
    }


    function topupmanager()
    {

        $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_topupmanager') ;
    }

    
    function hapus_pkt($id)
    {
      $this->load->model('M_pkt');
      $this->M_pkt->hapus_pkt($id); 
      redirect('Pages','refresh');
    }
    function validasi()
    {
      $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_validasi');
    }
    function valusers()
    {
      $this->load->model('M_users');
      $data['t_users']=$this->M_users->lihat();
      $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_valusers',$data);
    }



    /* Fungsi ini dibuat oleh Wahid dan diselesaikan oleh Rian, gunanya untuk membuat pesan notifikasi (pengumuman) kepada seluruh member. 
    */
     function posnotif()
    {
       $this->form_validation->set_rules('subject', 'Judul Pesan', 'trim|required',
                                        array('required' => '<b> JUDUL TIDAK BOLEH KOSONG! </b>')) ;
        $this->form_validation->set_error_delimiters('','<br/>') ;
        if ($this->form_validation->run() == TRUE)
        {
             $data = array(
             'tujuan' => $_POST['tujuan'],   
             'subject'=>$_POST['subject'],
             'message'=>$_POST['message'],
             'tgl_notif' => date('Y-m-d')
                );

        $this->load->model('M_users');
        $this->M_users->insertnotif($data);


        }

      $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_posnotif');
    }






    function daftarposnotif()
    {
      $this->load->model('M_users');
      $data['t_notif']=$this->M_users->lihatnotif();
      $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_dafnotif',$data);
    }
    function hapus_notif($id)
    {
      $this->load->model('M_users');
      $this->M_users->hapus_notif($id); 
      redirect('Pages','refresh');
    }


    function payment()
    {
      $this->load->model('M_users');
      $data['t_users_bonus']=$this->M_membership->M_B7_lihatpayment();
      $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_payment',$data);
    }

     function transpayment()
    {
    $user_id = $_POST['user_id'];
    $transfer= $this->M_membership->M_B6_ClearTotalBonus($user_id,$_POST['operator']);
    $data['t_users_bonus']=$this->M_membership->M_B7_lihatpayment();
      $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_payment',$data);
    }


    function EditBonusSponsor()
    {
       $ctrl_data['title'] = 'Edit Bonus' ;  
      $ctrl_data['message'] = 'Setting Bonus Sponsor saat registrasi member baru' ;
      $this->form_validation->set_rules('newvalue', 'Nilai Baru', 'trim|numeric',
                                         array('numeric'=> 'GAGAL! Jumlah Pin harus Angka!')) ;
      $this->form_validation->set_rules('pin','PIN Anda','trim|required|numeric',
                                            array('numeric'=>'GAGAL! PIN harus Angka saja!',
                                               'required' => 'GAGAL! PIN TIDAK BOLEH kosong!'));

      $this->form_validation->set_error_delimiters('','</br>') ;

      if ($this->form_validation->run() == TRUE)
      {
          $newvalue = $this->input->post('newvalue') ;
          $setting = $this->input->post('setting') ;
          $pin = $this->input->post('pin') ;
          $checkpin = $this->M_pin->checkpin_user_id($pin,$this->session->userdata('user_id')) ;
             if ($checkpin == 'PIN COCOK')
             {
                date_default_timezone_set('Asia/Jakarta');
                $now = date('Y-m-d H:i:s') ;
                $where_array = array('setting' => $setting) ;
                $row_array = array('value' => $newvalue , 'last_change' => $now) ;
                $this->db->where($where_array) ;
                $this->db->update('t_setting',$row_array) ;
               
             }
             else
                 $ctrl_data['message'] = 'Pin TIDAK COCOK!!' ;
        
      }
     
        $sql = "SELECT * FROM t_setting WHERE setting LIKE ? ";
        $q = $this->db->query($sql,'bonussponsor%') ;
        $ctrl_data['item_list'] = $q->result();

        $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_editbonus',$ctrl_data) ;

    }



    function EditBonusRO()
    {
         $ctrl_data['title'] = 'Setting Bonus Re-Entry' ;  
      $ctrl_data['message'] = 'Setting Bonus Sponsor saat Repeat Order Produk' ;
      $this->form_validation->set_rules('newvalue', 'Nilai Baru', 'trim|numeric',
                                         array('numeric'=> 'GAGAL! Jumlah Pin harus Angka!')) ;
      $this->form_validation->set_rules('pin','PIN Anda','trim|required|numeric',
                                            array('numeric'=>'GAGAL! PIN harus Angka saja!',
                                               'required' => 'GAGAL! PIN TIDAK BOLEH kosong!'));

      $this->form_validation->set_error_delimiters('','</br>') ;

      if ($this->form_validation->run() == TRUE)
      {
          $newvalue = $this->input->post('newvalue') ;
          $setting = $this->input->post('setting') ;
          $pin = $this->input->post('pin') ;
          $checkpin = $this->M_pin->checkpin_user_id($pin,$this->session->userdata('user_id')) ;
             if ($checkpin == 'PIN COCOK')
             {
               date_default_timezone_set('Asia/Jakarta');
                $now = date('Y-m-d H:i:s') ;
                $where_array = array('setting' => $setting) ;
                $row_array = array('value' => $newvalue , 'last_change' => $now) ;
                $this->db->where($where_array) ;
                $this->db->update('t_setting',$row_array) ;
               // $sql = "UPDATE t_setting SET value=? , last_change=$now WHERE setting = ?" ;
               // $this->db->query($sql, array($newvalue,$setting)) ;
               
             }
             else
                 $ctrl_data['message'] = 'Pin TIDAK COCOK!!' ;
        
      }
     
        $sql = "SELECT * FROM t_setting WHERE setting LIKE ? ";
        $q = $this->db->query($sql,'bonusRO%') ;
        $ctrl_data['item_list'] = $q->result();

        $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_editbonusRO',$ctrl_data) ;

    }

    function ResetBonusRO()
    {
      $row_array = array('bonus_RO' => 0) ;
      $this->db->update('t_users_bonus',$row_array) ;
      $this->db->truncate('t_boxro_1');
      $this->db->truncate('t_boxro_2');
      $this->db->truncate('t_boxro_3');
      $this->EditBonusRO() ;
    }





    function LogRegister()
    {
        $ctrl_data['title'] = 'Catatan Registrasi Berdasarkan Waktu' ;
        $ctrl_data['message'] = 'Search untuk pencarian Data Member' ;
        $sql = "SELECT * FROM t_users ORDER BY tgl_registrasi DESC ";
        $q = $this->db->query($sql) ;
        $ctrl_data['item_list'] = $q->result() ;
        $this->load->view('vd_proadmin/v_logregister',$ctrl_data) ;

    }


    function LogFly()
    {
      $ctrl_data['title'] = 'Catatan (Log) Event Fly' ;
        $ctrl_data['message'] = 'Catatan Log Fly Board dan Kualifikasi' ;
        $sql = "SELECT * FROM t_log_fly ORDER BY id DESC ";
        $q = $this->db->query($sql) ;
        $ctrl_data['item_list'] = $q->result() ;
        $this->load->view('vd_proadmin/v_logfly',$ctrl_data) ;
    }


    function LogBonus()
    {
         $ctrl_data['title'] = 'Catatan Bonus Milik Member' ;
         $ctrl_data['message'] = 'Rekap Bonus Member yang masuk Antrian Transfer  ' ;
        $b = 0;
     $ctrl_data['item_list'] = $c = XDB(1,'GETALL','t_users_bonus',array('status_transfer !='=>0))['RESULT'];
      $sql = "SELECT SUM(transfer_queue) as total FROM t_users_bonus" ;
      $b = $this->db->query($sql)->row_array() ;
     $ctrl_data['total'] = $b['total']; 

     // Untuk Reward
     $sql = "SELECT * FROM t_users_bonus WHERE reward_1 != 'WAIT' OR reward_2 != 'WAIT' OR reward_3 != 'WAIT'
            OR reward_4 != 'WAIT' OR reward_5 != 'WAIT' " ;
     $ctrl_data['reward_list'] = $this->db->query($sql)->result();

         $this->load->view('vd_proadmin/v_logbonus',$ctrl_data) ;
    }

    function LogReward()
    {
           // Untuk Reward
      $ctrl_data['title'] = 'Catatan Reward yang telah dicapai' ;
         $ctrl_data['message'] = 'Harap membaca kembali ketentuan pemncairan Reward, Rekap terbaru klik Re-Check' ;
     $sql = "SELECT * FROM t_users_bonus WHERE reward_1 != 'WAIT' OR reward_2 != 'WAIT' OR reward_3 != 'WAIT'
            OR reward_4 != 'WAIT' OR reward_5 != 'WAIT' " ;
     $ctrl_data['item_list'] = $this->db->query($sql)->result();
     $this->load->view('vd_proadmin/v_logreward',$ctrl_data) ;

    }

    function BonusRecheck()
    {
       // Check lagi mana yg harus masuk list
      $sql = "UPDATE t_users_bonus SET status_transfer=1  WHERE akumulasi_bonus != 0 OR net_transfer != 0 ";
      $this->db->query($sql);
       redirect('cd_proadmin/C_dashboard/LogBonus');
    }

  
  function AntrianBonus()
  {

      $this->form_validation->set_rules('limit','Limit Bonus','trim|required|numeric',
                                          array('numeric' => 'ERROR! Limit bonus harus Angka!',
                                            'required' => 'ERROR! Limit Bonus tidak boleh kosong!'));
       $this->form_validation->set_rules('pin','PIN Anda','trim|required|numeric',
                                            array('numeric'=>'GAGAL! PIN harus Angka saja!',
                                               'required' => 'GAGAL! PIN TIDAK BOLEH kosong!'));
      $this->form_validation->set_error_delimiters('','<br/>');
      if ($this->form_validation->run() == TRUE )
      {
          $checkpin = $this->M_pin->checkpin_user_id($_POST['pin'],$this->session->userdata('user_id')) ;
          if ($checkpin == 'PIN COCOK')
          { // Pin Cocok
              $limit = $this->input->post('limit') ;
              

              $condition = $this->input->post('kondisi') ;
           
                  $this->load->helper('bonus');
                 $transfer = TRANSFERQUEUE($condition,$limit) ;
                  $this->session->set_flashdata('success','Sebanyak '.$transfer.' Akumulasi Bonus dimasukkan ke Daftar Antrian!') ;
              
                /* sementara Gak usah pake Mysql procedure dulu 
               $sql = "CALL AntrianBonusFilter('$limit') "; 
              else
               $sql = "CALL AntrianBonus('$limit') "; 
              
              $this->db->query($sql) ; */

           

          } // Pin cocok
          else
          {
             $this->session->set_flashdata('error','<font color="red">Error! Pin SALAH!</font>') ;
          }
      } // Form Validation TRUE

      redirect('cd_proadmin/C_dashboard/LogBonus');
  }

  function GoTransferQueue($user_id)
  {
    $limit =1 ; $kondisi = 0;
    $this->load->helper('bonus');
    TRANSFERQUEUE($kondisi,$limit,$user_id) ;
    $name = XDB(1,'GET','t_users',array('user_id'=>$user_id))['nama'];
    $this->session->set_flashdata('success','Akumulasi Bonus '.$name.' dimasukkan ke Daftar Antrian!') ;
    redirect('cd_proadmin/C_dashboard/LogBonus');
  }




 
  function TransferBonus($user_id=NULL,$operator_id=NULL)
  {
    /*
     $tanggal = date('Y-m-d') ;
      $sql = "UPDATE t_users_bonus SET nominal_transfer = transfer_queue WHERE user_id=? " ;
         $this->db->query($sql,$user_id);
  $sql3 = "UPDATE t_users_bonus SET total_bonus_ditransfer = total_bonus_ditransfer + transfer_queue  WHERE user_id=?" ;
        $this->db->query($sql3,array($user_id)) ;

      $sql1 = "UPDATE t_users_bonus SET transfer_queue = 0 WHERE user_id=? " ;
        $this->db->query($sql1,$user_id);
      $sql2 = "UPDATE t_users_bonus SET tgl_ditransfer = ? WHERE user_id=?" ;
        $this->db->query($sql2,array($tanggal,$user_id)) ;
        */
       $this->load->helper('bonus');
       TRANSFERBONUS($user_id,$operator_id) ;

       if ($user_id != NULL)
       {
          $name = XDB(1,'GET','t_users',array('user_id'=>$user_id))['nama'];
          $this->session->set_flashdata('success','Bonus milik '.$name.' telah DITRANSFER!') ;
       }
   
     redirect('cd_proadmin/C_dashboard/LogBonus');
  }

  function ClearBonus($user_id=NULL)
  {
    if ($user_id == NULL){
      XDB(1,'UPDATE','t_users_bonus',array('status_transfer'=>2),array('status_transfer'=>0));
      $name = "semua yang DONE ";
    }
    else{
       $name = XDB(1,'GET','t_users',array('user_id'=>$user_id))['nama'];
      XDB(1,'UPDATE','t_users_bonus',array('status_transfer'=>2,'user_id'=>$user_id),array('status_transfer'=>0));
    }

    $this->session->set_flashdata('success','Bonus '.$name.' di-Clear kan !') ;
    $this->BonusRecheck();
  }
 


    function FrontEnd($part=NULL)
    {
        $ctrl_data['title'] = 'Untuk Mengedit Halaman Website' ;
        /* Diedit dengan TimyMCE
        Sumur : https://www.tinymce.com/docs/get-started/first-steps/
  
        */

        if (is_null($part))
        {
             $ctrl_data['message'] = 'Klik Bagian Website yang ingin di-edit!' ;

        }
        else
        {
             $ctrl_data['message'] = 'Bagian '.$part. 'diedit!!' ;

        }


         $this->load->view('vd_proadmin/v_frontend',$ctrl_data) ;
    }


    function RewardCheck()
    {
      // Nanti dihapus kalo dah benar
      $this->RewardZero() ;
       $s = 0;
      for ($j=1 ; $j < 6 ;$j++ )
      {
        $find = 'reward_'.$j;
        $check = XDB(1,'GETALL','t_users_bonus',array($find=>'HOLD'))['RESULT'];
         foreach($check as $r)
         {
            $qu = XDB(1,'GET','t_users_downline',array('user_id'=>$r->user_id))['qualified'];
           
            if ($qu == 1){ 
              XDB(1,'UPDATE','t_users_bonus',array('user_id'=>$r->user_id),array($find=>'OK'));
              $s++ ;
            }
         }  
      }
      $this->session->set_flashdata('success','Reward diperbaharui sebanyaK: '.$s) ;
       redirect('cd_proadmin/C_dashboard/LogReward');
    }

    function RewardZero()
    { // Yang belum berhak harus di Hold kembali
         $s = 0;
      for ($j=1 ; $j < 6 ;$j++ )
      {
        $find = 'reward_'.$j;
        $check = XDB(1,'GETALL','t_users_bonus',array($find=>'OK'))['RESULT'];
         foreach($check as $r)
         {
            $qu = XDB(1,'GET','t_users_downline',array('user_id'=>$r->user_id))['qualified'];
           
            if ($qu != 1){ 
              XDB(1,'UPDATE','t_users_bonus',array('user_id'=>$r->user_id),array($find=>'HOLD'));
              $s++ ;
            }
         }  
      }


    }

    function PencairanReward($no_reward,$user_id,$operator_id=NULL)
    { 
        if ($operator_id == NULL)
          $operator_id = $this->session->userdata('user_id');

        $name = XDB(1,'GET','t_users',array('user_id'=>$user_id))['nama'];

        $find = 'reward_'.$no_reward ;
        XDB(1,'UPDATE','t_users_bonus',array('user_id'=>$user_id),array($find=>'DONE'));
        $this->session->set_flashdata('success','Reward milik: '.$name.' telah diberikan!') ;
       redirect('cd_proadmin/C_dashboard/LogReward');
    }

    


    
       

}    
