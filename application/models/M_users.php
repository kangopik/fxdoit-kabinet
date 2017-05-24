<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_users extends CI_Model {
   
var $table = 't_users' ;


	function MTableOperation($operation,$table,$dataform,$where_array,$rank) 
    {
        /* Reference:
        http://localhost/Codeigniter-3.0.6/user_guide/database/query_builder.html */
        if ($table)
        {
            if ($operation == 'GET')
                    {
                        $this->db->where($where_array) ;
                        return $this->db->get($table)->row_array() ;
                    }
            if ($operation == 'GETDISCTINCT')
                    {   
                      
                        $this->db->like($where_array[0]);
                        $this->db->distinct($where_array[1]);
                        $this->db->group_by($where_array[2]) ;
                        $q = $this->db->get($table)->result() ;
                        return $q ;
                       
                    }
            if ($operation == 'GETALL')
                    {
                        $this->db->where($where_array) ;
                        return $this->db->get($table)->result() ;
                    }
            if ($operation == 'UPDATE')
                    {
                        $this->db->where($where_array);
                        $this->db->update($table,$dataform);
                    }  
            if ($operation == 'DELETE')
                    {
                        $this->db->where($where_array);
                        $this->db->delete($table);
                    }  
             if ($operation == 'DELETEALL')
                    {
                        $this->db->delete($table);
                    } 
            if ($operation == 'INSERT')
                    {
                        $this->db->insert($table,$dataform);
                    }  
            $s = 'QUERY SUCCESS!' ;
        }
        else
        $s = 'ACCESS DENIED!!' ;
        return $s ;
    }

   public function validate($data) 
   	{
		/* huskyin.com - Jangan langsung di-get dong, tentuin persyaratannya 
		$query = $this->db->get('users', $data);
		return $query;
		*/
		$progress = FALSE;
		$username = $data['username']; 
		$password = $data['password']; 
		$captcha =  $data['captcha'];

		$progress = ($captcha == TRUE ? TRUE : FALSE);
		if ($progress == FALSE)
		{
			return array('s' => 'FAILED', 'message' => 'Captcha Error!'); 
		}
		else
		{
			$sql = "SELECT * FROM t_users WHERE username=?  " ; 		
			$query = $this->db->query($sql, array($username)) ;
			$result = $query->row_array();
			if ($query->num_rows() != 1)
				return array('s' => 'FAILED', 'message' => 'Username salah atau TIDAK ditemukan!'); 
			else
			{
				
				$password_query = $result['password'] ;
				// jika password tidak benar, Out!  
				if(!password_verify($data['password'],$password_query) )
					return array ('s' => 'FAILED' , 'message' => 'Wrong Password!'); 
				else
				{	
                    if ($result['email_verify'] == 0)
                    {

                        return array( 
                                's'      => 'UNVERIFIED' ,
                                'email' => $result['email'],
                                'message' => $message );
					
							
                    }
                    else
                    {
                        $last_ip = long2ip($result['last_ip'])  ;
                      return array( 's'         => 'SUCCESS' ,
                                'message' => 'SUCCESS LOGIN' ,
                                'user_id'   => $result['user_id'],
                                'rank'      => $result['pangkat'], 
                               'username'   => $result['username'],
                               'email' => $result['email'],
                               'userlevel'  => $result['level'],
                                'password'   =>  $data['password'],
                                'nama'       => $result['nama'],
                                'pin' => $result['pin'],
                                'last_ip'   => $last_ip,
                                'last_login' => $result['last_login']) ;
                    }

				  
				}

			
			}

		}
	
	}




	function check_token($token)
	{
		$token = crypt($token, $this->session->userdata('username')) ;
		$user_id = $this->session->userdata('user_id');
		$sql = "SELECT `token` FROM t_users_bonus WHERE user_id=?" ;
		$query = $this->db->query($sql,array($user_id)) ;
		$result= $query->row_array() ;
		$result_token = $result['token'] ;
		if ($result_token == $token)
			return array('s' => 'SUCCESS');
		else
			return array('s' => 'FAILED') ;
	}



    function CreateId()
    {
        $tanggal = date('Ymd');
          $stringbill = 'KS98-' ;

          $sql = "SELECT MAX(RIGHT(user_id,7)) as id_max FROM t_users WHERE user_id LIKE ? " ;
          $query = $this->db->query($sql,array($stringbill.'%')) ;
          if ($query->num_rows() > 0)
          {
            foreach($query->result() AS $k)
            {
                $tmp = ((int)$k->id_max) + 1;
                $kd = sprintf("%07s",$tmp) ;
            }
          }
          else
          {
              
               $kd = "0000001" ;
          }

          $bill = $stringbill.$kd ;
          
          return $bill ;

    }



	function set_lastlogin($user_id,$ip)
	{	
		/* cara menyimpan ip ke database.
		Source: http://daipratt.co.uk/mysql-store-ip-address/
		*/
		
		date_default_timezone_set('Asia/Jakarta');
		 //Test if it is a shared client
			if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			  $ip=$_SERVER['HTTP_CLIENT_IP'];
			//Is it a proxy address
			}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}else{
			  $ip=$_SERVER['REMOTE_ADDR'];
			}
			//The value of $ip at this point would look something like: "192.0.34.166"
			$ip = ip2long($ip);
			//The $ip would now look something like: 1073732954


		$sql = "UPDATE t_users SET `last_ip`=? ,`last_login`= now() WHERE user_id=?  " ;
			$this->db->query($sql,array($ip,$user_id));
	}


	function M_fotoprofil($user_id, $params, $order)
	{
		if ($order == 'CREATE')
		{
			$sql = "UPDATE t_users SET `foto` = ? WHERE user_id=?  " ;
			$this->db->query($sql,array($params, $user_id));
			
		}
		if ($order == 'READ')
		{
			$sql = "SELECT * FROM t_users WHERE user_id=? " ;
			$query = $this->db->query($sql,array($user_id)) ;
			$result = $query->row_array() ;
			return $result['foto'] ;
			
		}


		

	}


	function lihatpayment(){
		$query=$this->db->get('t_users_bonus');
		$data=$query->result();
		return $data;
	}


	function check_captcha()
	{
       // logika captcha dibuat disini

		return TRUE ;
	}



	function checkpin($datapin) 
    {
    	// di database PIN harus ADA dan TERVALIDASI ( 'status' = 1)
        $sql = "select * from t_pin where pin=? and status=?";   

        $condition = array($datapin,'1')  ;
        $hasil = $this->db->query($sql,$condition);  
        return $hasil->result();
    }

    // kalo udah lewat seminggu week downline di nol kan kembali
    function MCheckResetMingguan($user_id)
    {
         date_default_timezone_set('Asia/Jakarta'); 
           $check = XDB(1,'GET','t_users_downline',array('user_id' => $user_id));
           if ($check['qualified'] == 0)
           {
                $rightnow = date('Y-m-d H:i:s');
                $expiration_date = strtotime($check['week_end']);
                if ($rightnow > $expiration_date) // dah lewat, di -reset lagi
                {
                    $nextweek  = date('Y-m-d',strtotime(date("Y-m-d H:i:s", time()) . " + 7 day"));
                 XDB(1,'UPDATE','t_users_downline',array('user_id'=>$user_id),
                    array('week_downline'=>0,
                          'week_start' => $rightnow,
                            'week_end' => $nextweek));
                 // dan tanggalannya dimajukan lagi
                 CLEAR_PAIDSPONSOR($user_id);

                 $s = 'RESET' ;
                }
                else
                 $s = 'CONTINUE' ;
           }
           else
            $s = 'QUALIFIED' ;
        return $s ;
    }


    function MResetMingguanAll($date)
    { 
         $s = FALSE ;
         date_default_timezone_set('Asia/Jakarta'); 
         if (USEDATE() == TRUE)
            $sql = "SELECT * FROM t_users_downline WHERE week_end < $date ";
        else
        $sql = "SELECT * FROM t_users_downline WHERE week_end < CURDATE() ";

        $q = $this->db->query($sql);
        $result = $q->result();
        foreach ($result as $row)
        {       
            $user_id = $row->user_id ;
            $rightnow = date('Y-m-d H:i:s');
            $nextweek  = date('Y-m-d',strtotime(date("Y-m-d H:i:s", time()) . " + 7 day"));
            $no_downline = $row->week_downline ;
             XDB(1,'UPDATE','t_users_downline',array('user_id'=>$user_id),
                    array('week_downline'=>0,
                          'week_start' => $rightnow,
                            'week_end' => $nextweek));
             $this->load->helper('board');
             // downline YG MENDUKUNG dia dibebastugaskan
              CLEAR_PAIDSPONSOR($user_id); 

          if ($no_downline != 0)
          {
            if ($row->qualified == 0)
             {
               $username = XDB(1,'GET','t_users',array('user_id'=>$user_id))['username'];
              $news = 'Sebanyak '.$no_downline.' downline mingguan:'.$username.' di-Reset karena GAGAL kualifikasi';
               $dataform = array('event'=>'FAILED QUALIFICATION:'.$username ,'downline' => $news) ;
              $this->db->insert('t_log_fly',$dataform);
             }
          } // punya downline TAPI Gak Qualified
          
           
           $s = TRUE ;

        }
        return $s ;
    }







    function M_editrekening($user_id,$dataform,$order)
    {
    	$table = 't_users_bonus' ;

    	if ($order == 'GET')
    	{
    		$sql = "SELECT * FROM $table WHERE user_id=?" ;
    		$query = $this->db->query($sql,array($user_id)) ;
    		$result = $query->row_array();
    		return array('bank'=> $result['bank'], 'no_rek'=>$result['no_rek'], 'nama_rek' => $result['nama_rek']  );

    	}
    	if ($order == 'EDIT')
    	{
    		$this->db->where(array('user_id' => $user_id));
       		 $this->db->update($table,$dataform);
       		 return 'SUCCESS' ;
    	}
    }



    function M_editpassword($dataform)
    {
    	$password = $dataform['old_password'] ;
    	$pin = $dataform['pin'] ;
    	$new_password = $dataform['new_password'] ;
    	$sql = "SELECT * FROM t_users WHERE user_id=? ";
    	$query = $this->db->query($sql,array($this->session->userdata('user_id'))) ;
    	$result = $query->row_array();

    
    	if(!password_verify($password,$result['password']))
    		$s = 'PASSWORD LAMA SALAH!' ;
    	else
    	{
    		
    			$new_password = password_hash($new_password, PASSWORD_DEFAULT);
    			$sql = "UPDATE t_users SET `password`=? WHERE user_id=? ";
    			$query = $this->db->query($sql,array($new_password,$this->session->userdata('user_id'))) ;
    			$s = 'SUCCESS' ;
    		
    	}

    	return  $s ;

    }

    function M_editprofile($dataform)
    {
    	
    		$this->db->where('user_id',$dataform['user_id']) ;
    		$this->db->update('t_users_profile',$dataform) ;
    		$status = 'SUCCESS'; 

    	return $status ;
    }


     function M_editusers($dataform)
    {
    	
    		$this->db->where('user_id',$dataform['user_id']) ;
    		$this->db->update('t_users',$dataform) ;	
    		$status = 'SUCCESS'; 

    	return $status ;
    }



    function get_users($user_id)
    {
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('t_users');
		$data = $query->row_array();
		return $data;
	}



    
    function get_users_profile($id)
    {
		$this->db->where('user_id',$id);
		$query = $this->db->get('t_users_profile');
		$data = $query->result();
		return $data;
	}

	function lihat(){
		$query=$this->db->get('t_users');
		$data=$query->result();
		return $data;
	}

	function edit_users($where,$table)
	{      
        return $this->db->get_where($table,$where);
    }
    function update_users($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
	}
	function hapus_users($id) 
	{
		$this->db->where('id',$id);
		$this->db->delete('t_users');
	}
	function get_profil($username)
    {
		$this->db->where('username',$username);
		$query = $this->db->get('t_users');
		$data = $query->result();
		return $data;
	}
	function bonus_user($user_id)
    {
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('t_users');
		$data = $query->result();
		return $data;
	}
	function bonus($user_id)
    {
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('t_users_bonus');
		$data = $query->result();
		return $data;
	}

	
	function insertnotif($data)
	{
	$this->db->insert('t_notif',$data);
	}

	function lihatnotif(){
		$query=$this->db->get('t_notif');
		$data=$query->result();
		return $data;
	}
	
	function hapus_notif($id) 
	{
		$this->db->where('id',$id);
		$this->db->delete('t_notif');
	}


	function general()
	{
		$query=$this->db->get('t_general');
		$data=$query->result();
		return $data;
	}

	function update_general(){
		$update_general = array(		
		    'web_prus' => $this->input->post('web_prus'),
		    'nama_prus' => $this->input->post('nama_prus'),
		    'alamat_prus' => $this->input->post('alamat_prus'),
		    'email_prus' => $this->input->post('email_prus'),
		    'copyright_prus' => $this->input->post('copyright_prus'),
		    'batas_lv' => $this->input->post('batas_lv'),
            );
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->update('t_general', $update_general);
    }

    function M_Email()
    {
    	parent::Model();
    	$this->load->library('email') ;
    }

    function M_verifyEmailAddress($email)
    {
    	$sql = "UPDATE t_users SET verify_code='' WHERE email=? " ;
    	$this->db->query($sql,array($email));
    	return $this->db->affected_rows()
;
    }


    function M_SendVerificationEmail($email,$verificationText,$user_id,$username) //Send
    {  /* Huskyin.ocm: Verification Email
    	Source: https://code.tutsplus.com/tutorials/how-to-implement-email-verification-for-new-members--net-3824
    	*/
    	$config = array(
    				'protocol' => 'smtp' ,
    				'smtp_host' => 'smtp.C2MM.com',
    				'smtp_port' => 465,
    				'smtp_user' => 'admin@C2MM.com',
    				'smtp_pass' => '@782AhmadYani',
    				'mailtype' =>'html',
    				'charset' => 'iso-8859-1',
    				'wordwrap' => TRUE );

    	$this->load->library('email',$config);
    	$this->email->set_newline("\r\n");
    	$this->email->to('email');
    	$this->email->subject("C2MM - Email Verifiction");
    	$this->email->message("
			Dear, ".$username." (User ID:".$user_id. "\n 
			Harap verifikasi dengan meng-klik tautan berikut atau copy-paste 
			ke alamat browser Anda:\n http://www.C2MM.com/verrify/".$verificationText."\n Terima Kasih. \n C2MM 
    		");
    	$this->email->send();



    }


    // Visitors .....
     function Mgetvisitors($location)
    {
        // daily visit
        $sql = "SELECT ip FROM t_visitors WHERE date=CURDATE() " ;
        $q = $this->db->query($sql) ;
        $daily_visit = $q->num_rows() ;

        // daily unique
        $sql1 = "SELECT DISTINCT ip FROM t_visitors WHERE date=CURDATE()  " ;
        $q1 = $this->db->query($sql1) ;
        $daily_unique = $q1->num_rows() ;

        // total visit
        $sql2 = "SELECT ip FROM t_visitors" ;
        $q2 = $this->db->query($sql2) ;
        $total_visit = $q2->num_rows() ;

        // total unique
        $sql3 = "SELECT DISTINCT ip FROM t_visitors " ;
        $q3 = $this->db->query($sql3) ;
        $total_unique = $q3->num_rows() ;

        //start
        $sql4 = "SELECT MIN(date) AS dat FROM t_visitors LIMIT 1" ;
        $q4 = $this->db->query($sql4) ;
       $start = $q4->row_array()['dat'] ;
       $date=date_create($start) ;
       $start = date_format($date,'Y-M-d');

        //total days
        $sql5 = "SELECT DISTINCT date FROM t_visitors " ;
        $q5 = $this->db->query($sql5) ;
        $total_days = $q5->num_rows() ;

        
        $avg_visit = ceil($total_visit / $total_days) ;
        $avg_unique = ceil($total_unique / $total_days) ;

        /* huskyin.com - Mencari MAX COUNT dari Pengunjung I.P
        Sumur: - https://www.exchangecore.com/blog/mysql-sql-retrieve-most-recent-or-largest-record-group/
        		- http://www.w3resource.com/sql/aggregate-functions/max-count.php
        		- http://stackoverflow.com/questions/16441032/how-to-find-the-maximum-count-using-mysql (FAVORIT)
        */
        $sql6 = "SELECT ip AS ip, COUNT(*) as most FROM t_visitors GROUP BY ip ORDER BY most DESC LIMIT 1 " ;
        $q6 = $this->db->query($sql6);
        $most_total = $q6->row_array()['ip'];


      $sql7 = "SELECT ip AS ip, COUNT(*) as most FROM t_visitors WHERE date=CURDATE() GROUP BY ip ORDER BY most DESC LIMIT 1 " ;
      	 $q7 = $this->db->query($sql7);
        $most_daily = $q7->row_array()['ip'];

        return array(
                        'daily_visit' => $daily_visit,
                        'daily_unique' => $daily_unique,
                        'total_visit' => $total_visit,
                        'total_unique' => $total_unique,
                        'start' => $start,
                        'total_days' => $total_days,
                        'avg_visit' => $avg_visit,
                        'avg_unique' => $avg_unique,
                         'most_daily' => $most_daily,
                         'most_total' => $most_total
                        );
    }




    function MgetRegister()
    {
    	/* Huskyin.com ,mencari query berdasarkan hari
		sumur: http://stackoverflow.com/questions/5293189/select-records-from-today-this-week-this-month-php-mysql
    	*/
    	$sql = "SELECT COUNT(user_id) AS total FROM t_users  " ;
    	$q = $this->db->query($sql);
    	$tot = $q->row_array();
    	$total = $tot['total'];

    	$sql1 = "SELECT COUNT(user_id) AS daily FROM t_users WHERE register_date LIKE ? " ;
    	$q = $this->db->query($sql1,array(date('Y-m-d'.'%')));
    	$tot = $q->row_array();
    	$daily = $tot['daily'];

    		$sql2 = "SELECT COUNT(user_id) AS total FROM t_paket  " ;
    	$q2 = $this->db->query($sql2);
    	$tot = $q2->row_array();
    	$merchant = $tot['total'];

    	return array('total' => $total , 'daily' => $daily, 'merchant' => $merchant);
    }


    



	
}