<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Model M_pkt , segala hal yang berhubungan dengan transaksi, termasuk pembuatan paket, validasi paket,
   perhitungan dan pembagian bonus untuk member. - dibuat oleh Wahid dan Rian
*/

class M_pkt extends CI_Model 
{
	function M_check_pkt_by_id($user_id)
	{
		$sql = "SELECT * FROM t_paket WHERE user_id=? ";
		$query = $this->db->query($sql,array($user_id)) ;
		$result = $query->row_array() ;
		return $result ;
	}

	public function insert($data)
	{
	$this->db->insert('t_paket',$data);
	}
	function insert_valtrade($data)
	{
	$this->db->insert('t_valtrade',$data);
	}
    function lihat_valtrade()
    {
        $query=$this->db->get('t_valtrade');
        $data=$query->result();
        return $data;
    }
    function lihat_pkt()
    {
        $query=$this->db->get('t_paket');
        $data=$query->result();
        return $data;
    }

     function lihat_pkt_by_id($user_id)
    {
         $this->db->where('user_id',$user_id);
        $query=$this->db->get('t_paket');
        $data=$query->result();
        return $data;
    }

    function MCreateAngkaUnik($price)
    {
      $angkaunik = rand(100,999);
      $priceresult = $price + $angkaunik ;
      // check apakah priceresult sudah ada
      $sql = "SELECT * FROM t_payment WHERE nominal_transfer=? ";
      $q = $this->db->query($sql,$priceresult);
      if ($q->num_rows() != 0) // Ada
        $this->MCreateAngkaUnik($price) ;
      else
        return $priceresult ;
    }


    function MCreateBilling($product_id)
    {
      $user_id = $this->session->userdata('user_id') ;
      $sql = "SELECT * FROM t_product WHERE product=? ";
      $q = $this->db->query($sql,$product_id);
      $price = $q->row_array()['price'] ;
      $priceresult = $this->MCreateAngkaUnik($price);

      // Jika sudah ada transaksi yang belum diselesaikan status = 'BILL' maka jangan diizinkan
      
      // Jika user pada hari itu sudah ada transaksi untuk produk yg sama maka ditolak
      $sql = "SELECT * FROM t_payment WHERE product_id=? AND user_id=? AND status =? ";
      $q = $this->db->query($sql,array($product_id,$user_id,'BILL'));
    
      if($q->num_rows() != 0 )
      {
        return FALSE ;
      }
      else // transaksi disimpan
      {
          $data['status'] = 'BILL' ;
          $data['user_id'] =$user_id ;
          $data['product_id'] = $product_id ;
          $data['nominal_transfer'] = $priceresult ;
          $data['date'] = date('Y-m-d H:i:s');
          $this->db->insert('t_payment',$data) ;
           return TRUE ;
           
      }
     
    }



    function Mgobump($merchant_id,$time,$sum,$user_id)
    {
        if ($sum < 1)
        { // reset lagi ke 3
            $sql = "UPDATE t_merchant SET bump=3 WHERE merchant_id=? ";
            $this->db->query($sql,$merchant_id);
        }
        

        // cek apakah deposit cukup
        $sql = "SELECT * FROM t_users_wallet WHERE user_id=? ";
        $q =  $this->db->query($sql,$user_id);
        $q = $q->row_array()['deposit'];

        if ($q > 500 )
        {
             date_default_timezone_set('Asia/Jakarta');  
            $time = date('Y-m-d H:i:s');
            $sql1 = "UPDATE t_users_wallet SET deposit = deposit-500 WHERE user_id=? ";
            $sql2 = "UPDATE t_merchant SET bump=bump-1 WHERE merchant_id=? ";
            $sql3 = "UPDATE t_merchant SET time='$time' WHERE merchant_id=? ";
            $this->db->query($sql1,$user_id);
            $this->db->query($sql2,$merchant_id);
            $this->db->query($sql3,$merchant_id);
            $s = 'SUCCESS';
            $message = 'Bump SUCCESS!!' ;
        }
        else
        {
            $s = 'FAILED';
            $message = 'Sorry your deposit if EMPTY!' ;
        }
         
        return array('s' => $s , 'message' =>$message) ;
    }
	


	function edit_pkt($where,$table)
	{      
        return $this->db->get_where($table,$where);
    }

    
    function update_pkt($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
	}


    function update_operator($where,$dataform,$no_operator)
    {
        if ($no_operator == 1)
        {
            $update['operator1'] = $dataform['operator1'];
            if ($dataform['password_opr1'] != '')
                $update['password_opr1'] = password_hash($dataform['password_opr1'],PASSWORD_DEFAULT);
        }
        
        else
       {
            $update['operator2'] = $dataform['operator2'];
            if ($dataform['password_opr2'] != '')
                $update['password_opr2'] = password_hash($dataform['password_opr2'],PASSWORD_DEFAULT);
       }

        $this->db->where($where);
        $this->db->update('t_paket',$update) ;
        return array('s' => 'DATA OPERATOR '.$no_operator.'  TER-UPDATE') ;

    }


    function check_operator_user($user_id,$operator)
    {
        $no_operator = '' ;
        $datamerchant = $this->M_check_pkt_by_id($user_id) ;
        if ($operator != $datamerchant['operator1'])
        {
             if($operator != $datamerchant['operator2'])
                $s = 'ERROR! USER OPERATOR TIDAK DITEMUKAN' ;
            else
            {
                $s = 'SUCCESS' ;
                $no_operator = 2 ;
            }
        }
        else
           {
                $s = 'SUCCESS' ;
                $no_operator = 1 ;
           }

           return array('s' => $s , 'no_operator' => $no_operator) ;

    }


    function update_operator_user($user_id,$operator,$no_operator)
    {
      
            $this->db->where(array('user_id' => $user_id));
              if ($no_operator == 1)
                        $this->db->update('t_paket',array('operator1' => $operator));
              else
                        $this->db->update('t_paket',array('operator2' => $operator));
        return 'Operator '.$no_operator.' ter-set' ;
   
    }



    function update_operator_password($user_id,$no_operator,$password_opr_new)
    {
         
            $password = password_hash($password_opr_new,PASSWORD_DEFAULT);
                        $this->db->where(array('user_id' => $user_id));
           if ($no_operator == 1)
                        $this->db->update('t_paket',array('password_opr1' => $password ));
           else
                        $this->db->update('t_paket',array('password_opr2' => $password));
            if ($password_opr_new != 'C2MM')
               $password_opr_new = '*******'      ;
                        return 'PASSWORD Ter-RESET ke "'.$password_opr_new.'" ' ;
    }



    function check_operator_password($user_id,$password_opr,$no_operator)
    {
        $datamerchant = $this->M_check_pkt_by_id($user_id) ;
        if ($no_operator == 1)
             $verify = (password_verify($password_opr,$datamerchant['password_opr1']));
        else
            $verify = (password_verify($password_opr,$datamerchant['password_opr2']));
        if (!$verify)
             $s = 'ERROR! Password operator salah!' ;
        else
        $s = 'SUCCESS' ;          
        return array('s' => $s) ;
    }





	function hapus_pkt($id) 
	{
		$this->db->where('id',$id);
		$this->db->delete('t_paket');
	}
/* Fungsi ini sudah ada di M_PIN checkpin($datapin)
	function checkpin_valtrade($datapin) 
    {
    	// di database PIN harus ADA dan statusnya 0 
        $sql = "select * from t_pin where pin=? and status=?";   

        $condition = array($datapin,'0')  ;
        $hasil = $this->db->query($sql,$condition);  
        return $hasil->num_rows();
    }
*/

    /* Fungsi ini TURUT menentukan apakah sebuah transaksi Dapat Tervalidasi ,
    	Jika Saldo Deposit < 0 , transaksi validasi akan GAGAL, kecuali merchant memiliki kontrak Exclusive =1
		Dengan kontrak Exclusive, Saldo deposit boleh Negatif, dan bisa ditagihkan ke Merchant kemudian
    	Syarat memiliki kontrak Exclusive adalah Merchant tersebut TIDAK BOLEH bekerja sama dengan perusahaan
    	lain yang sejenis dengan PASTI, semisal Groupon, Disdus, dsb... 

    */
   // User : Kusewain.com
   function MCreateMerchant($provinsi)
   {
          $stringbill = $provinsi ;

          $sql = "SELECT MAX(RIGHT(merchant_id,6)) as id_max FROM t_merchant WHERE merchant_id LIKE ? " ;
          $query = $this->db->query($sql,array($stringbill.'%')) ;
          if ($query->num_rows() > 0)
          {
            foreach($query->result() AS $k)
            {
                $tmp = ((int)$k->id_max) + 1;
                $kd = sprintf("%06s",$tmp) ;
            }
          }
          else
          {
              
               $kd = "000001" ;
          }

          $bill = $stringbill.$kd ;
          
          return $bill ;
   }     

   function M_KurangiDepositMerchant($packet_id , $TotalNominalBonus,$nilai_transaksi) 
   {
        $this->table = 't_paket' ; // Data harus double
        /*
        Kolom : ID, User_id , exclusive, deposit ;
 
        */
        $status = 'PLUS' ;

        $sql = " SELECT * from $this->table WHERE user_id=?  " ;
        $query = $this->db->query($sql,array($packet_id)) ;
        $result = $query->row_array() ;



        if (($result['deposit'] - $TotalNominalBonus - cost_pin()) < 0 )
        {
            if($result['exclusive'] != 1)
                $status = 'MINUS' ;
        }

        
        if($status == 'PLUS')
        {
        	// kurangi deposit merchant
    	   $sql2 = " UPDATE $this->table SET `deposit` = `deposit` - ? WHERE user_id=? " ;
				$query = $this->db->query($sql2,array(($TotalNominalBonus + cost_pin()),$packet_id)) ;
        }

        return $status ;
   }    








   function M_TambahDepositMerchant($user_id,$topup)
   {
   		$this->table = 't_paket' ;
   		


    	$sql2 = " UPDATE $this->table SET `deposit` = `deposit` +? WHERE user_id=? " ;
				$query = $this->db->query($sql2,array($topup,$user_id)) ;
				if ($query)
					$status = 'SUCCESS' ;

    	return array('s' => $status) ;

   }







}