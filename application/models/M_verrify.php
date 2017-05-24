<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_verrify extends CI_Model {
   
var $table = 't_verrify' ;

    function M_Email()
    {
        parent::Model();
        $this->load->library('email') ;
    }

    function M_verifyEmailAddress($name_user,$email)
    {
        $hash = md5(rand(0,1000)) ;
        $password = rand(1000,5000);
        $verificationText = $name_user.md5($password).$email ;
        $urlhash = $hash ;
        $sql = "UPDATE t_users SET ver=1 WHERE email=? " ;
        $this->db->query($sql,array($email));
        return $this->db->affected_rows();
    }



    function MSend_Mail($nama,$email,$user_id,$type_message) 
    {
        
       
        // jika sudah pernah ada sebelumnya di t_verify, hapus!!
        $sql = "SELECT * FROM t_verrify WHERE email=?";
        $q = $this->db->query($sql,$email);
        if ($q->num_rows() > 0)
        {
            $where_array = array('email' => $email );
            $this->db->delete('t_verrify',$where_array) ;
        }
        $hash = md5(rand(0,1000)) ;
        $dataform = array('hash' => $hash , 'user_id'=>$user_id, 'email' => $email) ;
        $this->db->insert('t_verrify',$dataform) ;


            $username = $nama ;
            // Configure email library

            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'kusewain.com' ;
            $config['smtp_port'] = 25;
            $config['smtp_user'] = 'noreply@kusewain.com';
            $config['smtp_pass'] = 'esidu1711';
            $config['mailtype']  ='html';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE ;

            // Load email library and passing configured values to email library 
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
        if($type_message == 'VERRIFICATION')
        {
            $message = "Dear, ".$username. ".<br>
            Kami ucapkan selamat bergabung dengan Kusewain.com,  e-commerce sewa-menyewa terpopuler.<br>
            Berikut Adalah Data Anda: <br>
            Username login : ".$email."<br>
            Password login : (Tidak ditunjukan) <br>
            User ID member  : ".$user_id." <br>
           <br>
            Verifikasikan pendaftaran dengan klik tautan berikut atau copy-paste 
            ke alamat browser: 
           ".base_url()."Gate/verrify?email=".$email."&hash=".$hash." <br>
            Terima Kasih,
             \r Team Kusewain.com .
            " ;

            $subject = 'Kusewain - Harap Verifikasi Email Anda' ;
        }
        if ($type_message == 'RESETPASSWORD')  
        {
             $passwordreset = '1242424' ;
           $password_jadi = password_hash($passwordreset,PASSWORD_DEFAULT);
           $where_array = array('user_id' => $user_id);
           $dataform = array('password' => $password_jadi);
           $this->db->set($dataform);
           $this->db->update('t_users',$where_array);

            $message = "Dear, ".$username. ".<br>
            Password Anda sudah ter-Reset<br>
            Password baru Anda : ".$passwordreset."<br>
            Silahkan login dengan menggunakan password ini <br>
            Terima Kasih,
             \r Team Kusewain.com .
            " ;

            $subject = 'Kusewain - Harap Verifikasi Email Anda' ;
        }
            

            // Sender email address
            $this->email->from('noreply@kusewain.com', 'Kusewain - Ecommerce Sewa Menyewa ');
            // Receiver email address
            $this->email->to($email);
            // Subject of email
            $this->email->subject($subject);
            // Message in email
            $this->email->message($message);

            if ($this->email->send()) {
                $s = 'SUCCESS';
              
            } else {
                $s = 'FAILED';
               
            }
            
        return $s ;
    }


    // Dari PHPMailer
    function MSend_Email2($username,$email,$user_id,$type_message)
    {
        $this->load->library('email');
        // jika sudah pernah ada sebelumnya di t_verify, hapus!!
        $sql = "SELECT * FROM t_verrify WHERE email=?";
        $q = $this->db->query($sql,$email);
        if ($q->num_rows() > 0)
        {
            $where_array = array('email' => $email );
            $this->db->delete('t_verrify',$where_array) ;
        }
        $hash = md5(rand(0,1000)) ;
        $dataform = array('hash' => $hash , 'user_id'=>$user_id, 'email' => $email) ;
        $this->db->insert('t_verrify',$dataform) ;



        if($type_message == 'VERRIFICATION')
        {
            $message = "Dear, ".$username. ".<br>
            Kami ucapkan selamat bergabung dengan Kusewain.com,  e-commerce sewa-menyewa terpopuler.<br>
            Berikut Adalah Data Anda: <br>
            Username login : ".$email."<br>
            Password login : (Tidak ditunjukan) <br>
            User ID member  : ".$user_id." <br>
           <br>
            Verifikasikan pendaftaran dengan klik tautan berikut atau copy-paste 
            ke alamat browser: 
           ".base_url()."Gate/verrify?email=".$email."&hash=".$hash." <br>
            Terima Kasih,
             \r Team Kusewain.com .
            " ;

            $subject = 'Kusewain - Harap Verifikasi Email Anda' ;
        }
        if ($type_message == 'RESETPASSWORD')  
        {

            $message = "Reset Password <br>
            Silahkan klik link di bawah ini untuk me-Reset password Anda:<br>
            ".base_url()."Gate/resetpassword?email=".$email."&hash=".$hash."
             \r <br> Team Kusewain.com .
            " ;

            $subject = 'Kusewain - Reset Password' ;
        }


        // Get full html:
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
            <title>' . html_escape($subject) . '</title>
            <style type="text/css">
                body {
                    font-family: Arial, Verdana, Helvetica, sans-serif;
                    font-size: 16px;
                }
            </style>
        </head>
        <body>
        ' . $message . '
        </body>
        </html>';
        // Also, for getting full html you may use the following internal method:
        //$body = $this->email->full_html($subject, $message);

        $result = $this->email
                ->from('noreply@kusewain.com')
                ->reply_to('rianhariadi@gmail.com')    // Optional, an account where a human being reads.
                ->to($email)
                ->subject($subject)
                ->message($body)
                ->send();

       // var_dump($result);
       // echo '<br />';
       // echo $this->email->print_debugger();

       // exit;
                if ($result)
                    return 'SUCCESS';
                else
                    return 'FAILED' ;
                exit ;

    }








    function MResetPassword($email,$nama,$passwordreset)
    {

    }




    function M_CheckVerificationEmail($email,$hash) //Get
    {  
       
             $where = array('email' => $email , 'hash'=>$hash) ;
             $this->db->where($where) ;
             $q = $this->db->get('t_verrify') ;
             if ($q->num_rows() == 1) // Verification match , set ke database bahwa user ter-verifikasi
             {
                $where1 = array('email'=>$email) ;
                $table = 't_users' ; // Tabel data User
                $dataform = array('email_verify'=> 1 );
                $this->db->where($where1);
                $this->db->update($table,$dataform) ;
                $s = 'SUCCESS' ;
             }
             else
             {
                $s = 'FAILED' ;
             }  
      

      
        return array('s'=>$s , 'message' => '') ;
    }


    function DelVerrify($email) 
    {
        $where_array = array('email' => $email) ;
        $this->db->where($where_array) ;
        $this->db->delete('t_verrify',$where_array) ;

    
    }



    
}