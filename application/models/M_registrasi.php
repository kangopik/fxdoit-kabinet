<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
M_registrasi , untuk pendaftaran member baru
Jangan Lupa : ada 4 pangkat:  Agen(1), Reseller(3), Distributor(7) , Dealer(15)

*/

Class M_registrasi extends CI_Model
{
	
	function MDaftar($data,$list_id)
	{
	
	  $id= $list_id[0] ; // ini kemudian berubah2
	  $nama = $data['nama'];
	  $password = $data['password'] ;
	  $level = $data['level'] ;
	  $stockis	= $data['stockis'];
	  $email = $data['email'];
	  $username = $data['username'] ;
	  $pangkat = $data['pangkat'] ;
	  $sponsor = $data['sponsor_id'] ;
	  $pin = $data['pin'] ;
	  $upline = $data['upline_id'] ;
	  $posisi = $data['posisi'] ;
	  if ($data['pangkat'] != 1)
	  {
	  	$downline_kiri = $list_id[1] ; $downline_kanan = $list_id[2] ;
	  }
	  else{
	  	 $downline_kiri = '' ; $downline_kanan = '' ;
	  }

	  if ($data['pangkat'] == 1 )
	  {
	  	 $total_kiri = 0 ; $total_kanan = 0 ;
	  }
	  elseif($data['pangkat'] == 3 )
	  {
	  	 $total_kiri = 1 ; $total_kanan = 1 ;
	  }
	  elseif($data['pangkat'] == 7 )
	  {
	  	 $total_kiri = 3 ; $total_kanan = 3 ;
	  }
	  elseif($data['pangkat'] == 15 )
	  {
	  	 $total_kiri = 7 ; $total_kanan = 7 ;
	  }


	  // Pertama , daftarkan dulu ID induknya (level 1)
	 $this->MDaftarAgen($nama,$level,$password,$stockis,$email,$pangkat,$pin,$username,$id,$sponsor,$upline,$posisi,$downline_kiri,$downline_kanan,$total_kiri,$total_kanan) ;
		
		$sponsor = $list_id[0] ;
		$level = 'member' ;
	  // Kedua, untuk pangkat > 1 , daftarkan tiap titik 
		if ($data['pangkat'] == 3 ){
		 $this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_1',$list_id[1],$sponsor,$list_id[0],'kiri','','',0,0) ;		
		 $this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_2',$list_id[2],$sponsor,$list_id[0],'kanan','','',0,0) ;
		}

	  if ($data['pangkat'] == 7 ){
	  	// level 2
		$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_1',$list_id[1],$sponsor,$list_id[0],'kiri',$list_id[3],$list_id[4],1,1);	
		$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_2',$list_id[2],$sponsor,$list_id[0],'kanan',$list_id[5],$list_id[6],1,1);

		// level 3
		$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_3',$list_id[3],$sponsor,$list_id[1],'kiri','','',0,0);	
		$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_4',$list_id[4],$sponsor,$list_id[1],'kanan','','',0,0);
		$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_5',$list_id[5],$sponsor,$list_id[2],'kiri','','',0,0);	
		$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_6',$list_id[6],$sponsor,$list_id[2],'kanan','','',0,0);

	  }
	  if ($data['pangkat'] == 15){
	  	// level 2
		$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_1',$list_id[1],$sponsor,$list_id[0],'kiri',$list_id[3],$list_id[4],3,3);	
		$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_2',$list_id[2],$sponsor,$list_id[0],'kanan',$list_id[5],$list_id[6],3,3);

	// level 3 A & B
	$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_3',$list_id[3],$sponsor,$list_id[1],'kiri',$list_id[7],$list_id[8],1,1);	
	$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_4',$list_id[4],$sponsor,$list_id[1],'kanan',$list_id[9],$list_id[10],1,1);
	$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_5',$list_id[5],$sponsor,$list_id[2],'kiri',$list_id[11],$list_id[12],1,1);	
	$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_6',$list_id[6],$sponsor,$list_id[2],'kanan',$list_id[13],$list_id[14],1,1);

	// level 4 dari 3A (upline $list_id[1])
	$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_7',$list_id[7],$sponsor,$list_id[3],'kiri','','',0,0);	
	$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_8',$list_id[8],$sponsor,$list_id[3],'kanan','','',0,0);
	$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_9',$list_id[9],$sponsor,$list_id[4],'kiri','','',0,0);	
	$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_10',$list_id[10],$sponsor,$list_id[4],'kanan','','',0,0);

	// level 4 dari 3B (upline $list_id[2])
	$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_11',$list_id[11],$sponsor,$list_id[5],'kiri','','',0,0);	
	$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_12',$list_id[12],$sponsor,$list_id[5],'kanan','','',0,0);
	$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_13',$list_id[13],$sponsor,$list_id[6],'kiri','','',0,0);	
	$this->MDaftarAgen($nama,$level,$password,$stockis,$email,1,$pin,$username.'_14',$list_id[14],$sponsor,$list_id[6],'kanan','','',0,0);
			
	  }
		// Ketiga, Tambah jaringan buat Upline-nya , hingga ke 'PROADMIN'
		    $this->MTambahJaringan($list_id[0],$posisi,$data['pangkat']) ;
		    return TRUE ;
	}

	function MDaftarAgen($nama,$level,$password,$stockis,$email,$pangkat,$pin,$username,$id,$sponsor,$upline,$posisi,$downline_kiri,$downline_kanan,$total_kiri,$total_kanan)
	{
		$dataform['nama'] = $nama;
		$dataform['level'] = $level;
		$dataform['password'] = $password;
		$dataform['stockis'] = $stockis;
		$dataform['email'] = $email;
		$dataform['pangkat'] = $pangkat ;
	    $dataform['pin'] = $pin ;
		$dataform['username'] = $username ;
		$dataprofile['user_id'] = $formbonus['user_id'] = $dataform['user_id'] = $id ;
		$dataform['sponsor_id'] =$sponsor ;
		$dataform['upline_id'] = $upline;
		$dataform['posisi'] = $posisi;
		$dataform['downline_kiri'] = $downline_kiri ;
		$dataform['downline_kanan'] = $downline_kanan ;
		$dataform['total_kiri'] = $total_kiri ;
		$dataform['total_kanan'] = $total_kanan ;
		$dataform['tgl_registrasi'] = date('Y-m-d H:i:s');


		$this->db->insert('t_users_profile',$dataprofile);
		$this->db->insert('t_users',$dataform);
		$this->db->insert('t_users_bonus',$formbonus) ;
	
	}


	function MCheckUpline($upline_id,$posisi)
	{
		$downline = 'downline_'.$posisi ;
        $sql = "SELECT $downline FROM t_users WHERE user_id=?" ;
        $q = $this->db->query($sql,$upline_id);
        $q = $q->row_array();
           if ($q[$downline] == '') // sudah terisi
           		return TRUE ;
           else 
           	    return FALSE ;
          
	} 

/*
-- Algortima Procedure Tambah Jaringan
-- nice info rom here: https://www.techonthenet.com/mariadb/loops/while.php


=============================================

-- Algortima Procedure Tambah Jaringan
-- nice info rom here: https://www.techonthenet.com/mariadb/loops/while.php

DROP PROCEDURE IF EXISTS `TambahJaringan` ;
DELIMITER $$
	CREATE PROCEDURE TambahJaringan(IN IDINPUT VARCHAR(25) , IN TAMBAH INT(5)  )

BEGIN 
	DECLARE upline VARCHAR(25) ;
    DECLARE ID VARCHAR(25) ;
	DECLARE posisi VARCHAR(11) ;
    
   SET ID = IDINPUT;
			
  label1: WHILE ID != 'PROADMIN' DO
  	SET upline = (SELECT t_users.upline_id FROM t_users WHERE t_users.user_id = ID ) ;
    SET posisi = (SELECT t_users.posisi FROM t_users WHERE t_users.user_id= ID ) ;
    
    	IF posisi = 'kiri' THEN
    		UPDATE t_users SET t_users.total_kiri = total_kiri + TAMBAH WHERE t_users.user_id = upline ;
    	ELSE
    		UPDATE t_users SET t_users.total_kanan = total_kanan + TAMBAH WHERE t_users.user_id = upline ;
    	END IF;
    
    SET ID = upline ;
   
   END WHILE label1;

END $$


===================================

DROP PROCEDURE IF EXISTS `BonusDealer` ;
DELIMITER $$
	CREATE PROCEDURE BonusDealer(IN IDINPUT VARCHAR(25) , IN BONUS DECIMAL(12)  )

BEGIN 
	DECLARE sponsor VARCHAR(25) ;
    DECLARE ID VARCHAR(25) ;
  	DECLARE PANGKAT TINYINT(4);
    
   SET ID = IDINPUT;
   SET PANGKAT = 1 ;
			
  label1: WHILE PANGKAT != 15 DO
  	SET sponsor = (SELECT t_users.sponsor_id FROM t_users WHERE t_users.user_id = ID ) ;
    SET PANGKAT = (SELECT t_users.pangkat FROM t_users WHERE t_users.user_id = sponsor ) ;
    
    	IF PANGKAT = 15 THEN
    UPDATE t_users_bonus SET t_users_bonus.bonus_sponsor = bonus_sponsor + BONUS WHERE t_users_bonus.user_id = sponsor ;    	
    	END IF;
    
    SET ID = sponsor ;
   
   END WHILE label1;

END $$

====================================================================================


DROP PROCEDURE IF EXISTS `TestUbah` ;
DELIMITER $$
	CREATE PROCEDURE TestUbah(IN TAMBAH INT(5), IN ID VARCHAR(15))

BEGIN 
	DECLARE upline VARCHAR(25) ;
    DECLARE penambahan INT(5) ;
	DECLARE posisi VARCHAR(11) ;
			
    
    UPDATE t_users SET t_users.nama = 'Rian Genius' WHERE t_users.user_id = ID ;
    	


END $$




*/



/*
	Mysql Store Procedure
	Trigger :
	1 - Hitung Jumlah member simpan di tabel tertentu (sehingga server gak perlu bolak-balik ngitung ), di- trigger
	    ketika ada member masuk

	Procedure:
	1 - TambahJaringan sampai ke Proadmin
	2 - Bonus selisih, sampai ke Dealer Terdekat
*/

/*
SET @p0='15'; SET @p1='PM101100009'; CALL `TambahJaringan`(@p0, @p1);
*/

/*
=============================================

-- Algortima Procedure Tambah Jaringan
-- nice info rom here: https://www.techonthenet.com/mariadb/loops/while.php

DROP PROCEDURE IF EXISTS `TambahJaringan` ;
DELIMITER $$
	CREATE PROCEDURE TambahJaringan(IN TAMBAH INT(5), IN IDINPUT VARCHAR(15))

BEGIN 
	DECLARE upline VARCHAR(25) ;
    DECLARE ID VARCHAR(25) ;
    DECLARE penambahan INT(5) ;
	DECLARE posisi VARCHAR(11) ;
    
   SET ID = IDINPUT;
			
  label1: WHILE ID != 'PROADMIN' DO
  	SET upline = (SELECT t_users.upline_id FROM t_users WHERE t_users.user_id = ID ) ;
    SET posisi = (SELECT t_users.posisi FROM t_users WHERE t_users.user_id= ID ) ;
    
    	IF posisi = 'kiri' THEN
    		UPDATE t_users SET t_users.total_kiri = total_kiri + TAMBAH WHERE t_users.user_id = upline ;
    	ELSE
    		UPDATE t_users SET t_users.total_kanan = total_kanan + TAMBAH WHERE t_users.user_id = upline ;
    	END IF;
    
    SET ID = upline ;
   
   END WHILE label1;

END $$


===================================


*/

/*
-- Truncate ALL
-- Algortima Procedure Tambah Jaringan
-- nice info rom here: https://www.techonthenet.com/mariadb/loops/while.php

DROP PROCEDURE IF EXISTS `ResetAll` ;
DELIMITER $$
	CREATE PROCEDURE ResetAll(IN TABLENAME varchar(15))

BEGIN 
	TRUNCATE TABLE TABLENAME ;
  

END $$


*/

/* Function DaftarID
DROP FUNCTION IF EXISTS `DaftarID` ;
DELIMITER $$
	CREATE FUNCTION DaftarID ( ID varchar(15), UPLINE varchar(15), POSISI varchar(15))
    RETURNS INT

BEGIN 
	DECLARE downline varchar(15);
    DECLARE hasil INT(2);
    
    IF POSISI = 'kanan' THEN
     SET downline = (SELECT downline_kanan FROM t_users WHERE user_id= UPLINE) ;
     	IF downline = '' THEN
            SET hasil = 1; 
            UPDATE t_users SET downline_kanan = ID  WHERE user_id = UPLINE ;
        ELSE
        	SET hasil = 0;
        END IF;
        
    ELSE
      SET downline = (SELECT downline_kiri FROM t_users WHERE user_id= UPLINE) ;
     	IF downline = '' THEN
            SET hasil = 1; 
             UPDATE t_users SET downline_kiri = ID  WHERE user_id = UPLINE ;
        ELSE
        	SET hasil = 0;
        END IF;
     END IF;
     
    RETURN hasil ;	
  

END $$




*/


/*
huskyin.com - Stored Procedure
Sumur yg udah jalan:
https://www.techonthenet.com/mariadb/loops/if_then.php
http://stackoverflow.com/questions/21004896/mysql-declaration-phpmyadmin

DROP PROCEDURE IF EXISTS `my_proc`;
DELIMITER $$
CREATE PROCEDURE my_proc()
BEGIN
  DECLARE shopdomain VARCHAR(30);
  SET shopdomain = 'newdomain.com';
  UPDATE trans SET tval = REPLACE(name,'olddomain.de', shopdomain ) WHERE name LIKE 'olddomain.de';
  UPDATE settings SET tval=REPLACE(name,'olddomain.de', shopdomain ) WHERE name LIKE 'olddomain.de';
  -- jalan 100%, perhatikan DELIMITERNYA!!
END$$

DELIMITER ;
*/

/*
-- Algoritma Stored Procedure Bonus selisih
-- nice info rom here: https://www.techonthenet.com/mariadb/loops/while.php

DROP PROCEDURE IF EXISTS `BonusSelisih` ;
DELIMITER $$
	CREATE PROCEDURE BonusSelisih(IN ID varchar(15), IN BONUS DECIMAL(8) )

BEGIN 
	DECLARE sponsor varchar(15) ;
    DECLARE pangkat INT(5) ;
	DECLARE posisi varchar(11) ;
			
  label1: WHILE pangkat != 15 DO
  	SET sponsor = (SELECT sponsor FROM t_users WHERE user_id = ID ) ;
    SET pangkat = (SELECT pangkat FROM t_users WHERE user_id = sponsor ) ;
    
    	IF pangkat = 15 THEN
    		UPDATE t_bonus_selisih SET bonus_selisih = bonus_selisih + BONUS WHERE user_id = sponsor ;
            SET BONUS  = 0 ;
    	END IF;
    
    SET ID = sponsor ;
   
   END WHILE label1;

END $$
*/


	// Nantinya fungsi ini akan digantikan oleh MySQL Stored Procedure, dikerjakan di server biar cepet!!
/*
	function MTambahJaringan($user_id,$posisi,$pangkat)
	{
		if ($user_id != 'PROADMIN')
		{
			$downline = $downline.'_'.$posisi ;
			$sql = "UPDATE  t_users SET $downline = $downline + ? WHERE user_id=? ";
		    $q = $this->db->query($sql, array($pangkat,$user_id));

		    // cari uplinenya
		    $sql1 = "SELECT upline,posisi FROM t_users WHERE user_id =? ";
		    $q1 = $this->db->query($sql1, array($user_id));
		    $q1 = $q1->row_array();
		    $user_id = $q1['upline'];
		    $posisi = $q1['posisi']; 
		    $status ='FAILED!' ;
		    // cari lagi, runut sampai ke PROADMIN
		    $this->MTambahJaringan($user_id,$posisi,$pangkat) ;
		}
		else{
			$downline = $downline.'_'.$posisi ;
			$sql = "UPDATE  t_users SET $downline = $downline + ? WHERE user_id=? ";
		    $q = $this->db->query($sql, array($pangkat,$user_id));
		    // Gak perlu lagi dicari siapa uplinenya, karena PROADMIN paling ujung!!
		    	$status = 'SUCCESS' ;
		}

		return $status ;
	}
*/


/*
-- Algortima Procedure Tambah Jaringan
-- nice info rom here: https://www.techonthenet.com/mariadb/loops/while.php

DROP PROCEDURE IF EXISTS `AntrianBonus` ;
DELIMITER $$
	CREATE PROCEDURE AntrianBonus (IN BATAS FLOAT(12,2) , IN KONDISI BOOLEAN  )

BEGIN 
	
  
  
  UPDATE t_users_bonus SET t_users_bonus.transfer_queue = t_users_bonus.transfer_queue + 
  			( t_users_bonus.bonus_sponsor + t_users_bonus.bonus_sponsor_last + t_users_bonus.bonus_generasi - t_users_bonus.payment)
  			WHERE ( t_users_bonus.bonus_sponsor + t_users_bonus.bonus_sponsor_last + t_users_bonus.bonus_generasi - t_users_bonus.payment) > BATAS ;
  
  UPDATE t_users_bonus SET t_users_bonus.bonus_sponsor = 0 , t_users_bonus.bonus_sponsor_last =  0 ,
  		 t_users_bonus.payment =  0 
 		WHERE ( t_users_bonus.bonus_sponsor + t_users_bonus.bonus_sponsor_last + t_users_bonus.bonus_generasi - t_users_bonus.payment) > BATAS ;
   

END $$

*/

/* ===================================================
-- Algortima Procedure Tambah Jaringan
-- nice info rom here: https://www.techonthenet.com/mariadb/loops/while.php

DROP PROCEDURE IF EXISTS `AntrianBonusFilter` ;
DELIMITER $$
	CREATE PROCEDURE AntrianBonusFilter (IN BATAS FLOAT(12,2)   )

BEGIN 
	
  
  
  UPDATE t_users_bonus SET t_users_bonus.transfer_queue = t_users_bonus.transfer_queue + 
  			( t_users_bonus.bonus_sponsor + t_users_bonus.bonus_sponsor_last + t_users_bonus.bonus_generasi - t_users_bonus.payment)
  			WHERE ( t_users_bonus.bonus_sponsor + t_users_bonus.bonus_sponsor_last + t_users_bonus.bonus_generasi - t_users_bonus.payment) > BATAS
            	AND t_users_bonus.no_rek != '' AND t_users_bonus.bank != '' ;
  
  UPDATE t_users_bonus SET t_users_bonus.bonus_sponsor = 0 , t_users_bonus.bonus_sponsor_last =  0 ,
  		 t_users_bonus.payment =  0 
 		WHERE ( t_users_bonus.bonus_sponsor + t_users_bonus.bonus_sponsor_last + t_users_bonus.bonus_generasi - t_users_bonus.payment) > BATAS
        	AND t_users_bonus.no_rek != '' AND t_users_bonus.bank != '' ;
   

END $$



*/









	/*
Remember this For CALL Stored Procedure:
http://stackoverflow.com/questions/1346209/unknown-column-in-field-list-error-on-mysql-update-query/1346298#1346298
*/


	function MTambahJaringan($user_id,$posisi,$pangkat) 
	{
		
		$sql = "CALL TambahJaringan('$user_id','$pangkat') " ;
		$this->db->query($sql) ;

	}


}
?>