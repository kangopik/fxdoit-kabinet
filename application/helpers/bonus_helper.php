<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  function BONUSFLY($user_id,$enter_board)
  {
      $board = $enter_board ;
      $ci =& get_instance() ;

      $setbonus = 'bonus_flyboard_'.$board;
      $setreentry = 'reentry_flyboard_'.$board;

      $bonus= XDB(1,'GET','t_setting',array('setting' => $setbonus))['value'];
    
      $reentry= XDB(1,'GET','t_setting',array('setting' => $setreentry))['value'];

      $re_price = XDB(1,'GET','t_setting',array('setting' => 'harga_paket_reentry'))['value'];
 
      $bonus = $bonus - ($reentry*$re_price);
       $re = 'reward_'.$board;
      XDB(1,'ADD','t_users_bonus',array('user_id'=>$user_id),array('bonus_fly', $bonus));
      $checkid = XDB(1,'GET','t_users_downline',array('user_id' => $user_id));
      if ($checkid['qualified'] == 1){
      
        XDB(1,'UPDATE','t_users_bonus',array('user_id'=>$user_id),array($re =>'OK'));  
        XDB(1,'ADD','t_users_bonus',array('user_id'=>$user_id),array('akumulasi_bonus', $bonus));
        // nyatakan ada Bonus
        XDB(1,'UPDATE','t_users_bonus',array('user_id'=>$user_id),array('status_transfer' =>1));
      }
      else{
    
        XDB(1,'UPDATE','t_users_bonus',array('user_id'=>$user_id),array($re =>'HOLD'));
      }
     
   
      

  }

  function BONUSSPONSOR($sponsor_id)
  {
     $user_id = $sponsor_id;
     $ci =& get_instance() ;
     $bonus= XDB(1,'GET','t_setting',array('setting' => 'bonus_sponsor'))['value'];
     /*

       $ini = XDB(1,'GET','t_users_bonus',array('user_id'=> $user_id))['bonus_sponsor'];
     $bonus = $bonus + $ini ;
     XDB(1,'UPDATE','t_users_bonus',array('user_id'=>$user_id),
          array('bonus_sponsor' => $bonus));
          */
    XDB(1,'ADD','t_users_bonus',array('user_id'=>$user_id),array('bonus_sponsor', $bonus));
    //$check=XDB(1,'GET','t_users_bonus',array('user_id'=>$user_id));
    XDB(1,'ADD','t_users_bonus',array('user_id'=>$user_id),array('akumulasi_bonus',$bonus));
    XDB(1,'UPDATE','t_users_bonus',array('user_id'=>$user_id),array('status_transfer' =>1));
     
  }


  function TRANSFERQUEUE($kondisi,$minimal,$user_id=NULL)
  {  // dilakukan Manual

    if ($user_id != NULL)
      $check = XDB(1,'GETALL','t_users_bonus',array('user_id' => $user_id))['RESULT'];
    else
    {
        if ($kondisi == 1)
           $check = XDB(1,'GETALL','t_users_bonus',array('akumulasi_bonus >=' => $minimal,'no_rek !='=> ''))['RESULT'];
         else
            $check = XDB(1,'GETALL','t_users_bonus',array('akumulasi_bonus >=' => $minimal))['RESULT'];
    }

   
    $check_pot = XDB(1,'GET','t_setting',array('setting'=>'potongan_bonus'))['value'];
    $check_pot = $check_pot/100 ;

    $s = 0 ;
    foreach ($check as $r)
    {
      $akumulasi = $r->akumulasi_bonus ;
      XDB(1,'ADD','t_users_bonus',array('user_id'=>$r->user_id),array('transfer_queue', $akumulasi));
       $queue = $akumulasi;
      $potongan = $check_pot*$queue;
      $net = $queue - $potongan;
      XDB(1,'ADD','t_users_bonus',array('user_id'=>$r->user_id),array('net_transfer', $net));
      XDB(1,'ADD','t_users_bonus',array('user_id'=>$r->user_id),array('potongan_bonus', $potongan));
    
      XDB(1,'UPDATE','t_users_bonus',array('user_id'=>$r->user_id),
          array('akumulasi_bonus'=>0,'bonus_sponsor'=>0));
       // Jika sudah ter-kualifikasi, Bonus Fly harus di-Nol kan juga
      $ch = XDB(1,'GET','t_users_downline',array('user_id'=>$r->user_id))['qualified'] ;
      if ($ch == 1)
      {
        XDB(1,'UPDATE','t_users_bonus',array('user_id'=>$user_id),array('bonus_fly' =>0));
      }
      
      $s++ ;
      
    }
    return $s;
  }

/*

  function NETBONUS($user_id=NULL)
  {
    if ($user_id == NULL)
    $check = XDB(1,'GETALL','t_users_bonus',array('transfer_queue !=' => 0))['RESULT'];
    else
      $check = XDB(1,'GETALL','t_users_bonus',array('user_id' => $user_id))['RESULT'];

    $check_pot = XDB(1,'GET','t_setting',array('setting'=>'potongan_bonus'))['value'];
    $check_pot = $check_pot/100 ;
    $s = 0 ;
    foreach ($check as $r)
    {
      $queue = $r->transfer_queue;
      $potongan = $check_pot*$queue;
      $net = $queue - $potongan;
      XDB(1,'ADD','t_users_bonus',array('user_id'=>$r->user_id),array('net_transfer', $net));
      XDB(1,'ADD','t_users_bonus',array('user_id'=>$r->user_id),array('potongan_bonus', $potongan));
       XDB(1,'UPDATE','t_users_bonus',array('user_id'=>$r->user_id),
          array('transfer_queue'=>0));
       $s++ ;
    }
    return $s;
  }
*/

  function TRANSFERBONUS($user_id=NULL,$operator_id=NULL)
  {
    $ci =& get_instance();

    date_default_timezone_set('Asia/Jakarta');  
          $date = date('Y-m-d') ;

    if ($operator_id == NULL)
      $operator_id = $ci->session->userdata('user_id');
    
    if ($user_id == NULL)
    $check = XDB(1,'GETALL','t_users_bonus',array('net_transfer !=' => 0))['RESULT'];
    else
      $check = XDB(1,'GETALL','t_users_bonus',array('user_id' => $user_id))['RESULT'];

    $potongan = XDB(1,'GET','t_setting',array('setting'=>'potongan_bonus'))['value'];
    $s = 0 ;
    foreach ($check as $r)
    {
      $net_transfer = $r->net_transfer;
      XDB(1,'ADD','t_users_bonus',array('user_id'=>$r->user_id),array('all_history_transfer',$net_transfer));
      XDB(1,'ADD','t_users_bonus',array('user_id'=>$r->user_id),
                        array('all_history_potongan',$r->potongan_bonus));
      // Nol kan semua!
      XDB(1,'UPDATE','t_users_bonus',array('user_id'=>$r->user_id),
          array('transfer_queue'=>0,'net_transfer'=>0,'potongan_bonus'=>0,'status_transfer' =>2,'operator'=>$operator_id,'last_transfer_date'=>$date));

      // Nyatakan Tidak ada lagi Bonus
      XDB(1,'UPDATE','t_users_bonus',array('user_id'=>$user_id),array('status_transfer' =>2));

       $s++ ;
    }
    return $s;
  }








