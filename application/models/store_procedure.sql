-- 'TambahJaringan'
======================================================================================================
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

END
==================================================================================================


-- BonusDealer

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

END

=================================================================================================

-- BonusSponsorHarian

BEGIN

UPDATE t_users_bonus SET t_users_bonus.bonus_sponsor_last = t_users_bonus.bonus_sponsor_last + t_users_bonus.bonus_sponsor ;

UPDATE t_users_bonus SET t_users_bonus.bonus_sponsor = 0;

END
============================================================================================

-- ResetAll


BEGIN 
	TRUNCATE TABLE t_users ;
    TRUNCATE TABLE t_users_bonus ;
    TRUNCATE TABLE t_pin ;
    TRUNCATE TABLE t_users_downline ;
    TRUNCATE TABLE t_users_profile ;
    
  

END

==============================================================================================

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
Remember this For CALL Stored Procedure:
http://stackoverflow.com/questions/1346209/unknown-column-in-field-list-error-on-mysql-update-query/1346298#1346298
*/


/*===================== Untuk BOX RO ================ */
/*
DROP PROCEDURE IF EXISTS `Potong10` ;
DELIMITER $$
  CREATE PROCEDURE Potong10(IN IDINPUT VARCHAR(25)   )
    
BEGIN 
  DECLARE total INT(5) ;
  
 INSERT INTO t_boxro_1 (t_boxro_1.user_id,t_boxro_1.paid) VALUES (IDINPUT,0);
  
 SELECT COUNT(*) as total FROM t_boxro_1 WHERE t_boxro_1.paid='0' ;
 IF total >= 10 THEN
  UPDATE t_boxro_1 SET t_boxro_1.paid = '1' WHERE t_boxro_1.paid='0' ;
    DELETE FROM t_boxro_1 LIMIT 1 ;
 END IF ;
 
END $$


*/


/* Mencari urutan nomor baris

SELECT id, nrow
FROM (SELECT *, @rownum:=@rownum + 1 AS nrow FROM t_users, (SELECT @rownum:=0) r ORDER BY id ) d
WHERE d.user_id='PM101100004' ;

*/