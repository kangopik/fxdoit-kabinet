<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
M_downline.php
Class ini untuk menghitung downline dan bonus member.
Bonus dimatikan apabila kondisi member == 'pasif'

*/

Class M_membership extends CI_Model
 {

	/*
	Fungsi2 Utama : 
	Catatan: yang dimaksud downline di sini adalah: jaringan level 1 langsung
	
		CONSTANT : 
		- $batas_level ;
		- $batas_transfer ;
		- $jatah_proadmin
		- $bonustransaksi


	(A) Pendaftaran jaringan dan input member (buat seluruh jaringannya)
			M_registrasi (fungsi induk) --> Dikerjakan oleh Wahid di Users.php
			M_A_input member --> mendapatkan ID untuk member yang baru registrasi
			M_A1_getuserdata
			M_A2_carisponsornya
			M_A3_inputjaringan (bagi para upline)
			M_A4_listdownline
			M_A5_inputlistdownline


	(B) Transaksi dan Pembagian Bonusnya
			M_valtrade (fungsi induk)
			M_B1_inputjatahadmin
			M_B2_inputbonustransaksi
			M_B3_inputbonusgenerasi
			M_B4_checkuseraktif
			M_B5_tambahmasaaktif


	(C) Pohon Jaringan
			M_C1_listdownline
			M_C2_jumlahjaringan

	(D) Cron Jobs
		Setiap hari Senin jam 4 pagi, server dimatikan satu jam dan lakukan perhitungan bonus
		Sebenarnya tidak perlu dilakukan cron jobs, karena semua bonus sudah OTOMATIS dihitung sejak input

		Bonus hanya ditransfer jika sudah memenuhi kuota limit transfer pda hari Senin jam 4 pagi


	*/


	function M_A_inputmember($stockis)
	{
		$this->table = 't_users' ;
		$sql = "SELECT `user_id` FROM $this->table WHERE stockis=?" ;
		$query = $this->db->query($sql,array($stockis));
		if ($query->num_rows() == 0) // ID belum ada
		{
			$reg_id = '100001' ;
			$user_id = prefix_member().$stockis.$reg_id ;
			$s = 'SUCCESS' ;
		}
		else
		{

				$sql = "SELECT MAX(id) FROM $this->table WHERE stockis=?" ;
				$query = $this->db->query($sql,array($stockis));
	
				$result = $query->row_array();
				$id = $result ;

				$sql = "SELECT `user_id` FROM $this->table WHERE id=?" ;
				$query = $this->db->query($sql,array($id));
				$result = $query->row_array();
				$result = $result['user_id'] ; 

				// reg_id -> PA101100001 , ambil 5 digit dari belakang, lalu ubah jadi integer
				$reg_id = substr($result,-6); 
				$reg_id = (int)$reg_id ;
				$stockis = (int)$stockis ;
				$reg_id = $reg_id + 1 ;

				if ($reg_id < 999999)
				{
					$user_id = prefix_member().$stockis.$reg_id ;
					$s = 'SUCCESS' ;
					unset($reg_id) ; // memory cleaner
				}
				
				else
				{
					$user_id = '' ;
					$s = 'INPUT MEMBER GAGAL!' ;
				}

		}

    	return array('s' => $s , 'user_id' => $user_id) ;
	}




	function M_A1_getuserdata($id)
	{
		$result = '' ;
		$this->table = 't_users' ;
		// Mencari seluruh data user dari ID tertentu
		$sql = "SELECT * FROM $this->table WHERE `user_id`=? " ;
		$query = $this->db->query($sql,array($id)) ;
	  		
	  		if ($query->num_rows() == 1)
	  		{
	  			$status = 'ADA' ;
	  			$result = $query->row_array() ;
	  		}
	  		else
	  			$status = 'TIDAK ADA' ;


	  	return array('s' => $status , 'result'=>$result) ;
	}

	function M_A2_getsponsor($id)
	{
		$this->table = 't_users' ;

		if ($id != 'proadmin')
	  {
	  		// Query database untuk mencari sponsornya
	  		$sql = "SELECT * FROM $this->table WHERE user_id=? " ;
	  		$query = $this->db->query($sql,array($id)) ;
	  		$result = $query->num_rows() ;
	  		if ($result == 1)
	  		{
	  			$result = $query->row_array();
	  			$id = $result['sponsor_id'] ;
	  		}

			// inisiasi
	  	
	  }			
		return array('s' => 'SUCCESS', 'id' => $id) ;

	}


	function M_A3_inputjaringan($id) // ID yg diinput adalah upline dari yg mendaftar
	{
		$this->table = 't_users_downline' ;
		
			// Masukkan lagi ke database
			$sql = "UPDATE $this->table SET `total_downline` = `total_downline`+1 WHERE user_id=?  " ;
			$this->db->query($sql,array($id));

			$sql2 = "SELECT  `total_downline` , `user_id` FROM  $this->table WHERE user_id=? " ;
			$q = $this->db->query($sql2,array($id));
			$result = $q->row_array()['total_downline'] ;
			$s = 'SUCCESS' ;
		

			return array('s' => 'SUCCESS', 'jumlah_downline' => $result) ;
	}


	


	function M_A4_listdownline($id) 
	{
		$this->table = 't_users_downline' ;	
		// ambil dari database
		$sql = "SELECT * FROM $this->table WHERE user_id=? "; 
		$query = $this->db->query($sql,array($id));
		$stringdata = $query->row_array();
		$stringdataasli = $stringdata['list_downline'];
		$total_jaringan	= $stringdata['total_downline'];
		$stringdata = str_replace("LIST:","",$stringdata['list_downline']) ;
		
		

		$data_downline = explode("-", $stringdata );  
		$i = count($data_downline)  ;
	
		return array('i' => $i,'data_downline' => $data_downline, 'stringdata' => $stringdata,
		 'list_downline' => $stringdataasli, 'total_jaringan' => $total_jaringan ) ;
		
	}

	

	function M_A5_inputlistdownline($id,$id_downline)
	{
		
		$this->table = 't_users_downline' ;
		// Menginputkan ID ke dalam list downline milik sponsor nya (hanya untuk level 1)
		$list = $this->M_A4_listdownline($id) ;
		$result_list = $list['list_downline'] ;
		$sum_list = $list['i'] ;

			if ($result_list)
			{	
				
				if (strpos($result_list, 'LIST:') !== false) 
				{
				 	// list downline masih kosong ,karena masih ada kata 'LIST:-nya' ....
				 	$tambahan_id = $id_downline ;
				 	//Fungsi lebih praktis dengan CONCAT
					$sql = "UPDATE `t_users_downline` SET `list_downline` = ? WHERE user_id=?" ;
					$this->db->query($sql,array($tambahan_id, $id));
				}
				else
				{
					$tambahan_id = "-".$id_downline ;	
					//Fungsi lebih praktis dengan CONCAT
					$sql = "UPDATE `t_users_downline` SET `list_downline` = CONCAT(list_downline,?) WHERE user_id=?" ;
					$this->db->query($sql,array($tambahan_id, $id));
				}

					

					$sql1 = "UPDATE `t_users_downline` SET `downline` = `downline`+1 WHERE user_id=?" ;
					$this->db->query($sql1,array($id));
					$s = 'SUCCESS' ;

			//	}

    				
			}
			else 
			{
				$s = 'GAGAL DITAMBAHKAN, LIST AWAL '.$result_list ;

			}	


			return array('s' => $s, 'list_id'=>$list['stringdata'] ) ;

	}

	

/*
=============== FUNGSI - FUNGSI UNTUK BAGI-BAGI BONUS ============================
*/

	function M_Check_Bonus_by_Id($user_id)
	{
		$sql = "SELECT * FROM t_users_bonus WHERE user_id=? LIMIT 1 " ; 
			$query = $this->db->query($sql, array($user_id)) ;
			$result = $query->row_array();
			if ($query->num_rows() != 1)
				return array ('s' => FALSE , 'message' => 'Username salah atau TIDAK ditemukan!'); 
			else
			{
					
				// Seluruh data dari tabel t_users_bonus dipindahkan ke sini
						return array(
					's' => TRUE ,
        		    'status'     			 => $result['status'],
        		    'bonus_generasi'         => $result['bonus_generasi'],
        		    'cashback' 				 => $result['cashback'],
        		    'payment' 				 => $result['payment'],	
        			'bonus_minggu_ini' 		 => $result['bonus_generasi']+$result['cashback']-$result['payment'],
        			'total_bonus_ditransfer' =>  $result['total_bonus_ditransfer'],
        			'tgl_ditransfer' 		 => $result['tgl_ditransfer'],
        			'operator' 			  	 => $result['operator'],
        			'transaksi_minggu_ini'   => $result['transaksi_minggu_ini'],
        			'total_transaksi'		 => $result['total_transaksi'],
        			'deadline_tutup_poin' 	 => $result['deadline_tutup_poin'],
        			'bank'				  	 => $result['bank'],
        			'no_rek'  				 => $result['no_rek'],
        			'nama_rek' 				 => $result['nama_rek']) ;
				  
        	}
	}

	function M_bonus_to_deposit($user_id,$bonus)
	{
		$sql = "UPDATE t_users_bonus SET `payment` = `payment`+? WHERE user_id=?   " ;
		$query = $this->db->query($sql,array($bonus,$user_id)) ;
		$sql1 = "UPDATE t_paket SET `deposit` = `deposit`+? WHERE user_id=?   " ;
		$query1 = $this->db->query($sql1,array($bonus,$user_id)) ;

		return TRUE ;
	}


	function M_B1_BonusTransaksiProadmin($user_id,$TotalNominalBonus,$prosentase_proadmin) //proadmin 15%
	{
		$this->table = 't_users_bonus' ;
		$tambahan_bonus = ($prosentase_proadmin / 100 )*$TotalNominalBonus ;
		$tambahan_bonus = $tambahan_bonus + cost_pin() ;
		$sql = "UPDATE $this->table SET `bonus_generasi` = `bonus_generasi` + ? WHERE user_id=?  " ;
		$query = $this->db->query($sql,array($tambahan_bonus,'proadmin'));
				if($query)
		return array('s' => 'SUCCESS') ;

	}




	function M_B2_BonusGenerasi($user_id,$TotalNominalBonus,$prosentase_upline) // upline dapat 5%  di C2MM
	{
		
		$checkaktif = $this->M_B4_CheckUserAktif($user_id);
		$tambahan_bonus = ($prosentase_upline / 100 )*$TotalNominalBonus ;
		if ($checkaktif) // jika status pasif , bonus diberikan ke proadmin
		{
			$sql = "UPDATE t_users_bonus SET `bonus_generasi` = `bonus_generasi` + ? WHERE user_id=?  " ;
				$query = $this->db->query($sql,array($tambahan_bonus,$user_id));
				if($query)
				return array('s' => 'SUCCESS' , 'nominal_bonus' => $tambahan_bonus) ;
		}
		else
		{		/* Sistem Pass-Up berlaku */
				/*
				$sql = "UPDATE t_users_bonus SET `cashback` = `cashback` + ? WHERE user_id=? " ;
				$query = $this->db->query($sql,array($tambahan_bonus,'proadmin'));	
				if($query) */
				return array('s' => 'PASIF', 'nominal_bonus' => $tambahan_bonus) ;		
		}



	}


	function M_B3_BonusTransaksiMember($user_id,$TotalNominalBonus,$prosentase_member,$merchant_id)
	{  // member dapat 65% di C2MM
		$typedisc = 'cashback' ;
		$tambahan_bonus = ($prosentase_member / 100 )*$TotalNominalBonus ;
		$sql = "UPDATE t_users_bonus SET `cashback` = `cashback` + ? WHERE user_id=? " ;

		if ($typedisc == 'cashback')
			$query = $this->db->query($sql,array($tambahan_bonus,$user_id));
		elseif($typedisc == 'discount')
			$query = $this->db->query($sql,array($tambahan_bonus,$merchant_id));	

		if($query)
		return array('s' => 'SUCCESS', 'nominal_bonus' => $tambahan_bonus) ;				

	}


	function M_B3_FeeMarketing ($merchant_id,$TotalNominalBonus,$fee_marketing)
	{
		
		// cari siapa spnsornya merchant
		$get_sponsor = $this->M_membership->M_A2_getsponsor($merchant_id) ; // siapa sponsornya merchant.
		$user_id = $get_sponsor['id'] ;
		$tambahan_bonus = ($fee_marketing / 100 )*$TotalNominalBonus ;
		$checkaktif = $this->M_B4_CheckUserAktif($user_id);
		if ($checkaktif)
		{
			$sql = "UPDATE t_users_bonus SET `bonus_generasi` = `bonus_generasi` + ? WHERE user_id=? " ;
			$query = $this->db->query($sql,array($tambahan_bonus,$user_id));	
		}
		else
		{
			  $sql = "UPDATE t_users_bonus SET `cashback` = `cashback` + ? WHERE user_id=? " ;
				$query = $this->db->query($sql,array($tambahan_bonus,'proadmin'));	
		}
		

		if($query)
		return array('s' => 'SUCCESS', 'nominal_bonus' => $tambahan_bonus) ;	
	} 





	   //start BagiBagiBonus
    public function M_BagiBagiBonus($user_id,$TotalNominalBonus,$merchant_id)
    {
       
        $prosentase_member = 60 ; //Nantinya ini juga dijadikan config di library
        $prosentase_proadmin = 20 ; // Nantinya ini juga dijadikan config di library 
        $fee_marketing = 2.50 ; // Nantinya ini juga dijadikan config di library 
        $prosentase_upline = (100 - ($prosentase_proadmin + $prosentase_member + $fee_marketing) ) / batas_lv() ;
        $message = 'FAILED' ; 

 //Sampe di sini.... #checkpoint
                     
        $progess = $this->M_B3_BonusTransaksiMember($user_id,$TotalNominalBonus,$prosentase_member,$merchant_id); 
        if ($progess['s'] == 'SUCCESS')  //
        $nominal_member = $progess['nominal_bonus'] ;
        $progess = $this->M_B1_BonusTransaksiProadmin($user_id,$TotalNominalBonus,$prosentase_proadmin) ;
         $progess = $this->M_B3_FeeMarketing($merchant_id,$TotalNominalBonus,$fee_marketing);
        if ($progess['s'] == 'SUCCESS') 
        {
            for ($i = 1; $i < (batas_lv()+1) ; $i++)
            {
                $get_sponsor = $this->M_membership->M_A2_getsponsor($user_id) ; // upline 1, 2, dst ...
                $user_id = $get_sponsor['id'] ;
                if ($user_id != 'proadmin')
                {
                	$progress= $this->M_membership->M_B2_BonusGenerasi($user_id,$TotalNominalBonus,$prosentase_upline) ;
                	if ($progess['s'] == 'SUCCESS') 
               		 {
                   		$message = 'SUCCESS' ;
                		$nominal_sponsor = $progress['nominal_bonus'] ;
                	 }
                    else
                       //$message = 'FAILED - Bonus Generasi Gagal dibagikan!' ; 
                       $i-- ; // Mundur satu level karena PASS-UP

                }
                elseif ($user_id == 'proadmin')
                {
                	$tambahan_bonus = ($prosentase_upline / 100 )*$TotalNominalBonus ;	
					$sql = "UPDATE t_users_bonus SET `bonus_generasi` = `bonus_generasi` + ? WHERE user_id=?  " ;
						$query = $this->db->query($sql,array($tambahan_bonus,$user_id));
					if($query)
						{ 
							$message = 'SUCCESS' ; $nominal_sponsor = $tambahan_bonus ;
						}
                }
                
            }
        }


       return array('s' => $message, 'nominal_member' => $nominal_member , 'nominal_sponsor' => $nominal_sponsor) ;

    }
    // end BagiBagiBonus












	/*	Fungsi ini mengecheck apakah user dalam kondisi aktif atau pasif
		Jika date(hari ini) > deadline_tutup_poin , then user dalam keadaan pasif 
	*/
	function M_B4_CheckUserAktif($user_id)
	{
		$this->table = 't_users_bonus' ;

		// lihat ke databasenya
		$sql = "SELECT * FROM $this->table WHERE user_id=? " ;
		$query = $this->db->query($sql, array($user_id)) ;
		$result = $query->row_array() ;
	
		$tgl_deadline = $result['deadline_tutup_poin']; 
		if ( $result['status'] != 2)
			return $checkaktif = FALSE ;
		else // Bila aktif TETAPI deadline tutup poin lewat, PASIFKAN!!
		{
			if ( date('Y-m-d') > $tgl_deadline) 
			{
				//Set ke pasif, soalnya sudah lewat 
				$sql = " UPDATE $this->table SET `status` = 1 WHERE user_id=? " ;
				$query = $this->db->query($sql,array($user_id)) ;
				return $checkaktif = FALSE ;
			}
			else
				return $checkaktif = TRUE ;


		}
	}



	function M_B5_TambahMasaAktif($user_id)
	{	
		$this->table = 't_users_bonus' ;

		$sql = " UPDATE $this->table SET `status` = 2 WHERE user_id=? " ;
				$query = $this->db->query($sql,array($user_id)) ;

		// Deadline berikut adalah hari ini ditambah 30 hari ;
		$tanggal_expired  = date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 30 day"));		

		$sql1 = " UPDATE $this->table SET `deadline_tutup_poin`= ? WHERE user_id=?" ;
		$query = $this->db->query($sql1,array($tanggal_expired,$user_id)) ;


	}

	// Fungsi ini untuk meng-clear kan lagi Total Bonus minggu ini milik member, setelah ditransfer ke rek.
	function M_B6_ClearTotalBonus($user_id,$operator)
	{
		$sql = "UPDATE t_users_bonus SET `total_bonus_ditransfer` = `total_bonus_ditransfer`+
				`bonus_generasi` + `cashback` + `bonus_RO` - `payment`
				, `bonus_generasi`= 0 , `cashback`=0 , `bonus_RO`=0 , `payment`=0 , `tgl_ditransfer`= now() ,`operator`=?
				WHERE user_id=? ";
			$query= $this->db->query($sql,array($operator,$user_id)) ;

	}

	function M_B7_lihatpayment()
	{
		$query=$this->db->get('t_users_bonus');
		$data=$query->result();
		return $data;
	}


	function M_B7_Payment($user_id,$merchant_id,$nominal_transaksi) 
	{
		$this->table = 't_users_bonus' ;
		$sql = " UPDATE $this->table SET `payment`= `payment` + ? WHERE user_id=?" ;
		$sql1 = " UPDATE $this->table SET `cashback`= `cashback` + ? WHERE user_id=?" ;
		$query = $this->db->query($sql,array($nominal_transaksi,$user_id)) ;
		$query1 = $this->db->query($sql1,array($nominal_transaksi,$merchant_id)) ;
	}


	function M_CheckUsersProfile($user_id)
	{
		$this->table = 't_users_profile' ;
		$sql = "SELECT * FROM $this->table WHERE user_id=?" ;
		$query = $this->db->query($sql,array($user_id)) ;
		$result=$query->row_array() ;
		return $result ;
	}



/* untuk C2MM =========================================================================================================*/

	function CariDownline($user_id,$posisi)
	{
		$downline = 'downline_'.$posisi ;

		$sql = "SELECT $downline FROM t_users  WHERE user_id = ? ";
		 $q = $this->db->query($sql,array($user_id));
		 $result = $q->row_array();
		 if ($result[$downline] != '')
		 	$id = $result[$downline] ;
		 else 
		 	$id = '' ;

		return $id ;
	}

	/* untuk C2MM
	*/
	function MPohonJaringan($id_induk) 
	{
		$id1 = $id2 = $id3 = $id4 = $id5 =$id6 = '' ;

		$id1 = $this->CariDownline($id_induk,'kiri');
		$id2 = $this->CariDownline($id_induk,'kanan');

		if ($id1 != '')
		{
			$id3 = $this->CariDownline($id1,'kiri');
				if ($id3 == '')
					$id3 = 'DAFTAR-'.$id1.'-'.'kiri' ;
			$id4 = $this->CariDownline($id1,'kanan');
				if ($id4 == '')
					$id4 = 'DAFTAR-'.$id1.'-'.'kanan' ;
		}
		else
		{
			$id1 = 'DAFTAR-'.$id_induk.'-'.'kiri' ;   ; $id3 = '' ; $id4 = '' ;
		}

		if ($id2 != '')
		{
			$id5 = $this->CariDownline($id2,'kiri');
				if ($id5 == '')
					$id5 = 'DAFTAR-'.$id2.'-'.'kiri' ;
			$id6 = $this->CariDownline($id2,'kanan');
				if ($id6 == '')
					$id6 = 'DAFTAR-'.$id2.'-'.'kanan' ;
		}
		else
		{
			$id2 = 'DAFTAR-'.$id_induk.'-'.'kanan'  ; $id5 = '' ; $id6 = '' ;
		}
		
		return array('id_induk' => $id_induk,
					  'id1' => $id1,
					  'id2' => $id2,
					  'id3' => $id3,
					  'id4' => $id4,
					  'id5' => $id5,
					  'id6' => $id6
			        ) ;

	}


	function MBonusSponsor($user_id,$pangkat,$sponsor_id)
	{
		// Cari Pangkat Sponsor langsung nya
		$sql = "SELECT pangkat FROM t_users WHERE user_id=?" ;
		$q = $this->db->query($sql,$sponsor_id) ;
		$pangkat_sponsor = $q->row_array()['pangkat'] ;

		$BonusSponsor= BONUSSPONSOR($pangkat,$pangkat_sponsor) ;
		$sql1 = "UPDATE t_users_bonus SET bonus_sponsor= bonus_sponsor + ? WHERE user_id=?" ;
		$this->db->query($sql1,array($BonusSponsor['bonus_sponsor'],$sponsor_id)) ;
		// jatah buat dealer di atasnya 
		$BonusDealer = $BonusSponsor['bonus_dealer'] ;
		if ($BonusDealer != 0) // Artinya Dealer harus dikasih
		{
			$user_id = $sponsor_id ; // cari lagi jaringan ke atas ;
			$sql = "CALL BonusDealer('$user_id','$BonusDealer')" ;
			$this->db->query($sql) ;

		}

	}


	function MDashboardPanel( $user_id)
	{

		$sql = "SELECT * FROM t_users_profile WHERE user_id=?";
		$check = $this->db->query($sql,$user_id) ;
		$check = $check->row_array();


		$sql = "SELECT * FROM t_users_bonus WHERE user_id =?" ;
		$a = $this->db->query($sql,$user_id) ;
		$a = $a->row_array();

		if ( ($a['no_rek'] != '') && ($a['nama_rek'] != '' )  )
			$status_rekening = TRUE ;
		else
			$status_rekening = FALSE ;

		$sql1 = "SELECT * FROM t_users WHERE user_id=?" ;
		$b = $this->db->query($sql1,$user_id) ;
		$b = $b->row_array();

		$sql2 = "SELECT COUNT(*) FROM t_users WHERE sponsor_id=?" ;
		$c = $this->db->query($sql2,$user_id) ;
		$c = $c->row_array();

		return array(
            'status_profil' => $status_profil, 
            'status_rekening' => $status_rekening,
            'total_message'     => $check['total_message'] ,  
            'total_bonus'       => $a['bonus_sponsor']+$a['bonus_sponsor_last']-$a['payment'],
            'total_sponsoring' => $c['total_sponsoring'],
            'total_kiri'       => $b['total_kiri'],
            'total_kanan'       => $b['total_kanan'],

        );
	}

	function Penalti_RO()
	{
		$sql = "SELECT * from t_setting WHERE setting=? "; 
		$check_RO = $this->db->query($sql,'check_RO');
		$check_RO = $check_RO->row_array() ;
		
		if ($check_RO['last_change'] != date('Y-m-d') )
		{
			$sql = "CALL PenaltiRO()" ; // Turunkan pangkat yang tidak Tutup Poin selama sebulan
			$this->db->query($sql) ;

			$where_array = array('setting' => 'check_RO');
		    $row_array = array('value' => 'yes','last_change'=> date('Y-m-d') ) ;
		    $this->db->where($where_array);
		    $this->db->update('t_setting',$row_array) ;

		}
	}



	function MRO_BOX($user_id,$pin)
	{
		/*
		$batas = 10 ;
		$bonus10 = 100000;
		$bonus100 = 1000000;
		$bonus1000 = 10000000; */

		$sql = "SELECT * FROM t_setting WHERE setting like ?  " ;
		$Bonus = $this->db->query($sql,'bonusRO%') ;
		$Bonus = $Bonus->result();

		foreach ($Bonus as $set )
		{
			switch ($set->setting) {
				case 'bonusROBatas' : $batas = $set->value ; break ;
				case 'bonusRO10' : $bonus10 = $set->value ; break ;
				case 'bonusRO100' : $bonus100 = $set->value ; break ;
				case 'bonusRO1000' : $bonus1000 = $set->value ; break ;
				default: 'No choice' ;
			}
			
		}



		$this->Penalti_RO() ;
		

		$sql = "CALL Potong0('$user_id', '$batas', '$bonus10', '$bonus100','$bonus1000' )" ;
		$this->db->query($sql) ;

		$deadline  = date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 30 day"));
		
		$where_array = array('user_id' => $user_id);
		$row_array = array('deadline_tutup_poin' => $deadline) ;
		$this->db->where($where_array);
		$this->db->update('t_users_bonus',$row_array);
		

		$where_array = array('pin' => $pin) ;
        $row_array = array('user_id' => $user_id, 'status'=>1, 'code' => 2);
        $this->db->where($where_array) ;
        $this->db->update('t_pin',$row_array);


	}










	



	











}
?>