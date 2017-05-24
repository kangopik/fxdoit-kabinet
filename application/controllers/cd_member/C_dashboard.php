<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_dashboard extends CI_Controller 
{
   public function __construct() {
        parent::__construct();    

        if ( IS_MAINTENANCE() == 1 )
           redirect('maintenance');
        

    if  ($this->session->userdata('userlevel') != 'member')
    {
         if  ($this->session->userdata('userlevel') != 'proadmin')
          redirect('') ; 
    }
                  


  
     else
    {
        if (!match_ip()) 
        {
            redirect('');
        }
    
    }
    

        $this->load->helper('text');
        $this->load->model('M_users');
        $this->load->model('M_membership');
        $this->load->model('M_pin');
        $this->load->model('M_pkt');
        $this->load->model('M_general');
    }


    
    public function index() 
    {
        $user_id = $this->session->userdata('user_id');  $data['user_id'] = $user_id;
        $data['title'] = 'Fxdoit Dashboard';
        $data['nama_lengkap'] = VERBOSE(XDB(1,'GET','t_users',array('user_id'=>$user_id))['nama']);
      
       
      $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_dashboard_index',$data); 
    }

    function Deposit()
    {
      $ctrl_data['title'] = VERBOSE(__FUNCTION__) ;
      $ctrl_data['subtitle'] = 'Form Deposit' ;
      $user_id = $this->session->userdata('user_id') ;
      $ctrl_data['option_acc'] = XDB(1,'GETALL','t_users_account',array('user_id' => $user_id))['RESULT'] ;
      $this->load->view('vd_member/v_dashboard_deposit',$ctrl_data);

    }

    function Open_Account()
    {
       $ctrl_data['title'] = VERBOSE(__FUNCTION__) ;
        $ctrl_data['subtitle'] = 'Form Membuka Akun' ;
      $user_id = $this->session->userdata('user_id') ;

      
       $this->form_validation->set_rules('account_type','Tipe Akun','trim|required');

        if ($this->form_validation->run() == TRUE ) // Jika Form terisi dengan benar baru check
        {
          $akun_type = $this->input->post('account_type');
          $swap = $this->input->post('swap');
          $dataform = array('user_id' => $this->session->userdata('user_id'),
                             'account_type' => $this->input->post('account_type'),
                             'swap_free' => $this->input->post('swap'),
                             
                            );
          XDB(1,'CREATE','t_users_account',NULL,$dataform);

        }

         $this->load->view('vd_member/v_dashboard_openaccount',$ctrl_data);
    }





    public function logout() 
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');
        session_destroy();
        redirect('Pages');
    }
    function Profil()
    {
        $id = $this->session->userdata('id');    
        $data['t_users'] = $this->M_users->get_users($id);
        $this->load->view('vd_member/v_edprofil',$data);
    }
    function edmember()
        {
          $this->load->view('vd_member/v_edmember');
        }
   

    


    function edpassword()
    {
        $ctrl_data['message'] = 'Silahkan Maskkan PIN dan Password Anda';
        $ctrl_data['title'] = 'Edit Password' ; 

        $this->form_validation->set_rules('pin','PIN Anda','trim|required|numeric',
                                            array('numeric'=>'PIN harus Angka saja!'));
        $this->form_validation->set_rules('old_password','Password Lama','trim|required');
        $this->form_validation->set_rules('new_password','Password Baru','trim|required',
                                            array('required'=>'Password Tidak boleh kosong!',
                                                   'min_lenght[5]'=>'Password minimal 5 karakter'));
        $this->form_validation->set_rules('new_password_conf','Password Baru Konf.','trim|required|matches[new_password]',
                                            array('matches[new_password]' => 'Konfirmasi password tidak sama!')) ;



        if ($this->form_validation->run() == TRUE ) // Jika Form terisi dengan benar baru check
        {
            
            $dataform = $this->input->post() ;
            $checkpin = $this->M_pin->checkpin_user_id($dataform['pin'],$this->session->userdata('user_id')) ;
            if ($checkpin == 'PIN COCOK')
            {
                 $process = $this->M_users->M_editpassword($dataform) ;
                 if ($process == 'SUCCESS')
                         $ctrl_data['message'] = 'Password Berhasil Terbaharui' ;
                 else
                        $ctrl_data['message'] = 'GAGAL! '.$process ;
            }
            else
                $ctrl_data['message'] = 'GAGAL! '. $checkpin ;
            

        }
      

        $ctrl_data['message'] ='<b>'.$ctrl_data['message'].'</b>' ;
        $this->load->view('vd_member/v_edpassword',$ctrl_data);
        unset($ctrl_data['message']) ;
    }



   
    function akun()
        { 
        $username = $this->session->userdata('username');    
        $data['t_users'] = $this->M_users->get_profil($username);
        $this->load->view('vd_member/v_akun',$data);
        }

    function postakun()
     {
    $password = $this->input->post('password');
     $data = array('password' => $password);
    $where = array ('user_id' => $this->session->userdata['user_id'] ) ;
    $this->M_users->update_users($where,$data,'t_users');
    redirect('Pages');
    }


    function DashboardPanel()
    {
        $user_id = $this->session->userdata('user_id') ;
        $check = $this->M_membership->MDashboardPanel( $user_id) ;

        return array(
            'status_profil' => $check['status_profil'], 
            'total_message'     => $check['total_message'] ,  
            'total_bonus'       => $check['total_bonus'],
            'total_sponsoring' => $check['total_sponsoring'],
            'total_kiri'       => $check['total_kiri'],
            'total_kanan'       => $check['total_kanan'],

        );
    }   




 ////////////////////////////////////////////////////
   function pasfoto($type)
    { 
         
        $rank = 2 ;
        $id = $this->session->userdata('user_id') ;
        $message = 'Silahkan Upload Foto Anda!' ;
        $title = 'Edit Foto' ;

        if (($type == 'pasfoto') || ($type == 'foto_ktp')){
                   $this->imagepath = 'upload/images/users_images/' ;
                   $table ='t_users';
                   $go_redirect = base_url().'cd_member/C_dashboard';

                  }
                  else{
                    $this->imagepath = 'upload/images/ibuhamil/' ;
                    $table ='t_bumil';
                    $go_redirect = 'Ibuhamil' ;
                  }
        $this->form_validation->set_rules('pin','PIN Anda','trim|required|numeric',
                                            array('numeric'=>'PIN harus Angka saja!'));
        $this->form_validation->set_error_delimiters('','<br/>') ;


      if ($this->form_validation->run() == TRUE ) // BEGIN Jika Form terisi dengan benar baru check
        {
           
           $user_id = $idtag = $id;
         

           if (isset($_FILES['image']['error'])) 

           {  
              //fungsi untuk memasukkan foto
              if ($_FILES['image']['error'] != 4)
              {
                  
                //Dimana foto itu?
                    if ( $_SERVER['HTTP_HOST'] != 'localhost') 
                     $this->imagepath = 'upload/images/users_images/' ;
                     else
                     $this->imagepath = 'upload\\images\\users_images\\' ;

                // jika sudah ada filenya, delete file yg lama
                $where_array = array('user_id' => $idtag ) ;
                $foto_lama = $this->M_users->MTableOperation('GET',$table,'',$where_array,$rank)[$type] ;
                $foto_lama = $foto_lama ;


                      $foto_lama = XDB(1,'GET',$table,$where_array)[$type] ;
                $foto_lama1 = str_replace('/','\\',$foto_lama) ;
                $foto_lama1 = photo_path().$foto_lama1 ;
                     @unlink($foto_lama1) ;

                $foto_lama2 = str_replace('\\','/',$foto_lama) ;
                $foto_lama2 = photo_path().$foto_lama2 ;
                     @unlink($foto_lama2) ;
                     $this->session->set_flashdata('delete','Foto yg di delete:'.$foto_lama);
                
                       
                      $config_upload['upload_path'] = $this->imagepath  ;
                      $config_upload['allowed_types'] = 'jpg|gif|png' ;
                      $config_upload['max_size'] = 990000 ; //990 kb
                      $config_upload['file_name'] = strtolower($type.'-'.$idtag) ;

                      $this->load->library('upload',$config_upload) ;


                      if($this->upload->do_upload("image"))
                      {
                        $image_data = $this->upload->data();
                        $image_type = $this->upload->data('file_type') ;
                        $foto_lama = $image_name = $this->upload->data('file_name') ;

                        // Jika nama FIle jpg atau JPG harus dibedakan...
                         if ( strpos($foto_lama,'.jpg'))
                                $extphoto =  '.jpg?';
                         if ( strpos($foto_lama,'.gif'))
                                $extphoto =  '.gif';
                         if ( strpos($foto_lama,'.png'))
                                $extphoto =  '.png';
                         if ( strpos($foto_lama,'.JPG'))
                                $extphoto =  '.JPG?';
                         if ( strpos($foto_lama,'.GIF'))
                                $extphoto =  '.GIF';
                         if ( strpos($foto_lama,'.PNG'))
                                $extphoto =  '.PNG';


                        /*sebelum di-save di database, lakukan operasi image dulu ..
                        From http://stackoverflow.com/questions/16949983/codeigniter-file-upload-and-resize
                        resize
                        */

                        $config['image_library'] = 'gd2' ;
                        $config['source_image'] = $image_data['full_path'] ;
                        $config['width'] = 250 ;
                        $config['maintain_ratio'] = TRUE ;
                     
                       

                        $this->load->library('image_lib',$config) ;
                        $this->image_lib->resize() ;

                     
                        
                        $params = strtolower($config['source_image']);
                        $dataform = array($type => $params.$extphoto) ;

                        $this->M_users-> MTableOperation('UPDATE',$table,$dataform,$where_array,$rank) ;
                        $this->session->set_flashdata('upload','Foto yg di upload:'.$params.$extphoto);
                        $message = 'Foto Sukses ter-Upload' ;
                     }
                     else
                        $message = 'Sorry, upload images failed!' ;
    
              }
            }

     }// END Jika Form terisi dengan benar baru check


      
        // Jika User belum memasukkan foto tampilkan foto 'No Photo'
        //  $config['pesan_dari_controller'] = 'GAGAL FORM VALIDATION!';

       $where_array = array('user_id' => $id ) ;
       $foto_lama = $this->M_users->MTableOperation('GET',$table,'',$where_array,$rank)[$type] ;
        $foto_lama = strtolower($foto_lama) ;

        $this->session->set_flashdata('warning',$message) ;

        //redirect($go_redirect) ;
        $ctrl_data['message'] = $message ;
        $ctrl_data['title'] = $title ;
        $this->load->view('vd_member/v_edfoto',$ctrl_data) ;
                
            

    }
    /////////////////////////////////////////////



    function account()
        { 
        $username = $this->session->userdata('username');    
        $data['t_users'] = $this->M_users->get_profil($username);
        $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_account',$data);
        }
    function dashboard()
        {
          $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_dashboard');
        }


 function downline()
    {
       $ctrl_data['user_id'] =  $this->session->userdata('user_id') ;
             $ctrl_data['sponsor_sejati'] = $this->session->userdata('sponsor_id') ;

             $ctrl_data['batas_level'] = 3;
            if (isset($_POST['user_induk']))
            {
               
                $data = array(
                'generasi' => $_POST['generasi'],
                'user_induk' => $_POST['user_induk']
                 ) ;

                 $ctrl_data['user_induk'] =  $_POST['user_induk'] ;
                 $ctrl_data['generasi'] =  $_POST['generasi'] ;
                  $cari_sponsor = $this->M_membership->M_A2_getsponsor($ctrl_data['user_induk']) ;
                  $ctrl_data['sponsor_id'] = $cari_sponsor['id'] ;

                  if ($ctrl_data['generasi'] < 0)
                  {
                    $ctrl_data['generasi'] = 0;
                  }  
               
            }
            else
            {
                $ctrl_data['user_induk'] =  $this->session->userdata('user_id') ;
                 $ctrl_data['generasi'] =  0 ;
                  $cari_sponsor = $this->M_membership->M_A2_getsponsor($ctrl_data['user_induk']) ;
                  $ctrl_data['sponsor_id'] = $cari_sponsor['id'] ;

                  if ($ctrl_data['generasi'] < 0)
                  {
                    $ctrl_data['generasi'] = 0;
                  }  

            }
      
            $list_downline = $this->M_membership->M_A4_listdownline($ctrl_data['user_induk']) ;
            $ctrl_data['list_downline'] = $list_downline['data_downline'] ;
             $ctrl_data['total_downline'] = $list_downline['i'] ;

             $list_downline = $this->M_membership->M_A4_listdownline($ctrl_data['user_id']) ;
            $ctrl_data['total_jaringan'] = $list_downline['total_jaringan'] ;


        $this->load->view('vd_member/v_downline_pagination',$ctrl_data) ;

    }


    function RO_BOX()
    {
        $message = 'Pin Kosong!' ;
        $this->form_validation->set_rules('pin','PIN Anda','trim|required');
        $this->form_validation->set_error_delimiters('','<br/>') ;
      if ($this->form_validation->run() == TRUE )
      {
         $user_id = $this->session->userdata('user_id') ;
         $pin = $this->input->post('pin');
         $checkpin = $this->M_pin->checkpin($pin) ;

         if ($checkpin['s'] == 'PIN BELUM TERVALIDASI!' ) 
         {
            if ($checkpin['stockis'] == 888){
                $ro = $this->M_membership->MRO_BOX($user_id,$pin) ;
    
                $message = '<font color="green">TRANSAKSI SUKSES! Silahkan cek posisi RO Anda di dashboard!</font>' ;
            }
            
         }
         else
            $message = '<font color="red">TRANSAKSI Re-ENTRY GAGAL - PIN '.$pin.' Error atau sudah terpakai</font>';
     
      }
       
         $this->session->set_flashdata('success_ro','<div class="well"><h2>'.$message.'</h2></div>') ;
        // $this->load->view('vd_'.$this->session->userdata('userlevel').'/v_boxro',$ctrl_data) ;
        redirect(base_url().'cd_member/C_dashboard/') ;
    }


    function check_RO()
    {
        $ctrl_data['user_id'] = $user_id = $this->session->userdata('user_id') ;
        $sql = "SELECT id, nrow FROM (SELECT *, @rownum:=@rownum + 1 AS nrow FROM t_boxro_1, (SELECT @rownum:=0) r 
        ORDER BY id ) d WHERE d.user_id=? " ;
        $box1 = $this->db->query($sql,$user_id);
        $ctrl_data['box1'] = $box1->result();


        $sql = "SELECT id, nrow FROM (SELECT *, @rownum:=@rownum + 1 AS nrow FROM t_boxro_2, (SELECT @rownum:=0) r 
        ORDER BY id ) d WHERE d.user_id=? ORDER BY id " ;
        $box2 = $this->db->query($sql,$user_id);
        $ctrl_data['box2'] = $box2->result();

        $sql = "SELECT id, nrow FROM (SELECT *, @rownum:=@rownum + 1 AS nrow FROM t_boxro_3, (SELECT @rownum:=0) r 
        ORDER BY id ) d WHERE d.user_id=? ORDER BY id " ;
        $box3 = $this->db->query($sql,$user_id);
        $ctrl_data['box3'] = $box3->result();

        $sql = "SELECT * FROM t_users_bonus WHERE user_id=? ORDER BY id " ;
        $deadline = $this->db->query($sql,$user_id); 
        $databonus = $deadline->row_array();
        $ctrl_data['deadline'] = $databonus['deadline_tutup_poin'];
        $ctrl_data['bonus_minggu_ini'] =  $databonus['bonus_sponsor']+$databonus['bonus_sponsor_last'] + 
        $databonus['bonus_RO']-$databonus['payment'] ;

        //$this->load->view('vd_'.$this->session->userdata('userlevel').'/v_boxro',$ctrl_data) ;

        return array('box1' => $ctrl_data['box1'],
                      'box2' => $ctrl_data['box2'],
                      'box3' =>  $ctrl_data['box3'],
                      'deadline' => $ctrl_data['deadline'],
                      'bonus_minggu_ini' => $ctrl_data['bonus_minggu_ini']
                        );

    }

    function VerifikasiMember()
    {
      $user_id = $this->session->userdata('user_id') ;
        XDB(1,'UPDATE','t_users',array('user_id'=>$user_id),array('ver' => 1));
      redirect('Membership/EditProfile');
    }







    
   
   
    
}