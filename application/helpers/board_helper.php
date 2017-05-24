<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 function CHECKINPUT($no_board)
    {
       $ci =& get_instance();
       $table = 't_board_'.$no_board ;
       $total = XDB(1,'GETALL',$table,array('paid' => $no_board))['TOTAL'] ;
       $check = XDB(1,'GETALL',$table,array('paid' => $no_board))['RESULT'] ;
       $tot = 0;
       foreach($check as $row)
       { // selama dia masih membiayai sponsor, Tidak boleh dihitung!
         $chek_paid = XDB(1,'GET','t_users_downline',array('user_id'=>$row->user_id))['paid_sponsor'];
         if ($chek_paid == '')
          $tot++ ;
       }


       switch ($no_board)
       {
          case 0: $limit = 5 ; break;
          case 1: $limit = 5 ; break;
          case 2: $limit = 10 ; break;
          case 3: $limit = 10 ; break;
          case 4: $limit = 10 ; break;
          case 5: $limit = 10 ; break;
          default: $limit = -1 ;
       }
       if ($tot < $limit)
          $check = FALSE ;
        else
           $check = TRUE ;

        if ($check)
        { // Ubah semua paid yg pas
          $chek = XDB(1,'GETALL',$table,array('paid'=>$no_board))['RESULT'];
          $j = 0; $user_paid = 'User_id: ';
          foreach ($chek as $row)
          { 
            if ($j < $limit)
            {
                 $user_c = XDB(1,'GET','t_users_downline',array('user_id'=>$row->user_id));
                 $user_check = $user_c['paid_sponsor'];
                 // Jika MASIH membiayai sponsor, dia TIDAK BOLEH menyundul atasnya
                if ($user_check == '')
                 {
                    $ubah = XDB(1,'UPDATE',$table,array('user_id'=>$row->user_id),
                          array('paid'=>$no_board+1   ));
                     $user_paid = $user_paid.$row->user_id.'(paid:'.$row->paid.'), '; 
                    $j++ ;
                 }
                

            }// if j!= $limit
          
          }
           $dataform = array('type'=>2,'event'=>'FLY BOARD:'.$no_board.'. Paid by '.$j.' members' ,'downline' => $user_paid) ;
           $ci->db->insert('t_log_fly',$dataform);
           return TRUE; 

           
        }
        else
          return FALSE ;
    }

    function PAIDSELECT($user_id)// cari siapa saja downline yg mem-biayai sponsor
    {
         $ci =& get_instance();
         $check = XDB(1,'GETALL','t_users_downline',array('paid_sponsor'=>$user_id))['RESULT'];
         $total = XDB(1,'GETALL','t_users_downline',array('paid_sponsor'=>$user_id))['TOTAL'];
         if ($total != 0)
         {
            $user = array(); $i=0 ;
           foreach ($check as $row)
           {
              $user[$i] = $row->user_id;
              $i++ ;
           }

         }
         else
          $user = '';

         return $user ;
    }

    function DIRECTFLY($user_id)
    {  // jika langsung BERHASIL mensponsori 5 sponsor maka langsung qualified
        $ci =& get_instance();
        $check = XDB(1,'GETALL','t_users_downline',array('paid_sponsor'=>$user_id))['TOTAL'] ;
        $ci->load->helper('board');
        if ($check < SYARAT_QUALIFIED() )
          return FALSE ;
        else
        {
          XDB(1,'UPDATE','t_users_downline',array('user_id'=>$user_id),array('qualified'=>1));
          
          $check = XDB(1,'GET','t_users_downline',array('user_id'=>$user_id));
          if ( $check['board'] == 0 )
          {
            // User_id itu sendiri paid nya harus jadi 1
            XDB(1,'UPDATE','t_board_0',array('user_id'=>$user_id),array('paid'=>1));

            // lalu terbang ke board 1
            FLYBOARD(0,$user_id) ;

            // dan sukses-kan semua anak downline yang membiayainya
            $id_select = PAIDSELECT($user_id) ; $j=0 ; $user_paid ='';
            foreach ($id_select as $user)
            {
               // cari di manapun si user berada (kemungkinan besar masih di Board 0)
               XDB(1,'UPDATE','t_board_0',array('user_id'=>$user),array('paid'=>1));
               $user_paid = $user_paid.','.$user;
               $j++;
            }
            XDB(1,'UPDATE','t_users_downline',array('user_id'=>$user_id),array('board'=>1));
             // buat berita acara
           $username = XDB(1,'GET','t_users',array('user_id'=>$user_id))['username'];
           $dataform = array('type'=>2,'event'=>'DIRECT FLY:'. $username.' Qualified by '.$j.' members' ,'downline' =>   $user_paid) ;
           $ci->db->insert('t_log_fly',$dataform);
          }

         // semua downline yg membiayai, DIBEBASTUGASKAN (paid =1)
          CLEAR_PAIDSPONSOR($user_id) ;
          return TRUE ;
        }

    }

    function CLEAR_PAIDSPONSOR($user_id)
    { // SELAMA sponsornya belum qualied, ini masih berlaku, tapi di-Clear setiap awal minggu
         $ci =& get_instance();
      $qualified = XDB(1,'GET','t_users_downline',array('user_id'=>$user_id))['qualified'];
      if ($qualified == 0)
      { // Clear-kan semua paid sponsor
         XDB(1,'UPDATE','t_users_downline',array('paid_sponsor'=>$user_id),array('paid_sponsor'=>''));
      }
    }


    function FLYBOARD($from_board,$user_id=NULL)
    {
       $ci =& get_instance();
       $no_board = $from_board ;
        date_default_timezone_set('Asia/Jakarta');  
          $date = date('Y-m-d H:i:s') ;
        // memindahkan ID teratas ke Board baru 
       $table = 't_board_'.$no_board ; //board skr: 1
      if ($user_id == NULL){
        $sql = "SELECT * FROM $table ORDER BY id LIMIT 1 ";
        $q = $ci->db->query($sql) ;
      }
      else{
        $sql = "SELECT * FROM $table WHERE user_id= ? ORDER BY id  LIMIT 1 ";
        $q = $ci->db->query($sql,$user_id) ;
      }

      
      $user_id = $q->row_array()['user_id'] ;
      $paid = $q->row_array()['paid'] ; //paid skr: 2

      // Delete di Board semula
       $sql = "DELETE FROM $table WHERE user_id = ? ORDER BY id  LIMIT 1" ;
       $ci->db->query($sql,$user_id) ;

      // Dan masukkan ke Board yang Baru 
       $no_board += 1;
       $getdown = XDB(1,'GET','t_users_downline',array('user_id'=>$user_id))['total_downline'];
       $dataform = array('user_id' => $user_id, 
                          'paid' => $paid, 
                          'date' => $date,
                          'total_downline'=>$getdown );
       $table_next = 't_board_'.$no_board ;
       $ci->db->insert($table_next,$dataform) ; // board skr: 2
      
       CHECKFIRSTMEMBER($user_id,$no_board);
        // Dirapihkan
          $sql = "ALTER TABLE $table ORDER BY id ASC ";
        $ci->db->query($sql);
        // Terakhir, baru bagi2 bonus
        $ci->load->helper('bonus');
        BONUSFLY($user_id,$no_board);
        

       // Update informasi Boardnya di t_users_downline
        XDB(1,'UPDATE','t_users_downline',array('user_id'=>$user_id),array('board'=>$no_board)) ;
          // buat berita acara
           $username = XDB(1,'GET','t_users',array('user_id'=>$user_id))['username'];
           $dataform = array('type'=>1, 'event'=>'MEMBER FLY:'. $username.' to Board '.$no_board) ;
           $ci->db->insert('t_log_fly',$dataform);

       //recursive function
       $c = CHECKINPUT($no_board); // board skr : 2, klo TRUE, paid jd 3
       if ($c)
         FLYBOARD($no_board) ;

       return $no_board ;
    }


    function CHECKFIRSTMEMBER($user_id,$no_board)
    {
      $ci =& get_instance();
      $table = 't_board_'.$no_board ;
      $total = XDB(1,'GETALL',$table,array('id !=' => 0))['TOTAL'] ;
      if ($total == 1)
      {
        XDB(1,'ADD',$table,array('user_id' =>$user_id),array('paid',1)); 
        return TRUE ;
      }
      return FALSE;
    }


    function SYARAT_QUALIFIED()
    {
      $qu = 5;
      return $qu ;
    }



