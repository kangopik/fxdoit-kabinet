<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  function COMPETITION($no_board)
  {

      $ci =& get_instance();
      $table = 't_board_'.$no_board ;
      $limit = XDB(1,'GET','t_setting',array('setting'=>'competition_limit'))['value'] ;
      // Pindahkan semua user_id yang total downline nya di bawah limit
     // http://stackoverflow.com/questions/7482443/how-to-copy-data-from-one-table-to-another-new-table-in-mysql
      
      $sql = "INSERT INTO t_competition_looser (user_id,date,paid,total_downline)
               SELECT user_id,date,paid,total_downline FROM $table 
               WHERE total_downline < ? ORDER BY total_downline DESC ";
      $ci->db->query($sql,$limit);


       $sql = "INSERT INTO t_competition_winner (user_id,date,paid,total_downline)
               SELECT user_id,date,paid,total_downline FROM $table 
               WHERE total_downline >= ? ";
      $ci->db->query($sql,$limit);

      $sql1 = "TRUNCATE TABLE  $table" ;
      $ci->db->query($sql1,$limit);

      
      //masukkan lagi
       $sql2 = "INSERT INTO $table (user_id,date,paid,total_downline)
               SELECT user_id,date,paid,total_downline FROM t_competition_winner ";
      $ci->db->query($sql2);

      //masukkan lagi
       $sql2 = "INSERT INTO $table (user_id,date,paid,total_downline)
               SELECT user_id,date,paid,total_downline FROM t_competition_looser
               ORDER BY total_downline DESC , date ASC ";
      $ci->db->query($sql2);
    
      $sql1 = "TRUNCATE TABLE t_competition_winner " ;
      $ci->db->query($sql1,$limit);

      $sql1 = "TRUNCATE TABLE t_competition_looser " ;
      $ci->db->query($sql1,$limit);



  }


