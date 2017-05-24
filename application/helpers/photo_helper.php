<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function PHOTO($type,$user_id=NULL)
   {
        $ci =& get_instance() ;
        //$type = 'pasfoto' ;
        if ($user_id == NULL)
        $user_id = $ci->session->userdata('user_id') ;

        $id = $user_id ;
        $ci->load->model('M_users') ;

         $table ='t_users';
                   $slug = 'users_images';
        
         if ($type == 'pasfoto') 
         { 
                   $table ='t_users';
                   $slug = 'users_images';
                   $where_array = array('user_id' => $user_id) ;
         }
         else if ($type == 'fotomerchant_1') 
         { 
                   $table ='t_merchant';
                   $slug = 'merchant';
                   $where_array = array('merchant_id' => $id) ;
         }
         else if ($type == 'fotomerchant_2') 
         { 
                   $table ='t_merchant';
                   $slug = 'merchant';
                   $where_array = array('merchant_id' => $id) ;
         }
          else if ($type == 'fotomerchant_3') 
         { 
                   $table ='t_merchant';
                   $slug = 'merchant';
                   $where_array = array('merchant_id' => $id) ;
         }
          else if ($type == 'fotomerchant_4') 
         { 
                   $table ='t_merchant';
                   $slug = 'merchant';
                   $where_array = array('merchant_id' => $id) ;
         }

         else{
                    $slug = 'foto_setting';
                    $table ='t_frontend';
                    $where_array = array('user_id' => $user_id) ;
        }


         //ditambahkan untuk mencegah ID kecil
         $user_id = strtoupper($user_id);

        $foto_lama = XDB(1,'GET',$table,$where_array)[$type] ;
        $foto_lama = $foto_lama ;
        if ($foto_lama == '')
         return base_url().'upload/images/users_images/no_image.jpg' ;
          //  return base_url().'upload/images/no_image.jpg' ;

        $fotobaru =  $type.'-'.$id;
        /*
        if ( strpos($foto_lama,'.jpg'))
          $thephoto =  base_url().'upload/images/'.$slug.'/'.$foto_lama.'.jpg?'.time() ;
        if ( strpos($foto_lama,'.gif'))
          $thephoto =  base_url().'upload/images/'.$slug.'/'.$foto_lama.'.gif?'.time() ;
        if ( strpos($foto_lama,'.png'))
          $thephoto = base_url().'upload/images/'.$slug.'/'.$foto_lama.'.png?'.time() ;

        if ( strpos($foto_lama,'.JPG'))
          $thephoto =  base_url().'upload/images/'.$slug.'/'.$foto_lama.'.JPG?'.time() ;
        if ( strpos($foto_lama,'.GIF'))
          $thephoto =  base_url().'upload/images/'.$slug.'/'.$foto_lama.'.GIF?'.time() ;
        if ( strpos($foto_lama,'.PNG'))
          $thephoto = base_url().'upload/images/'.$slug.'/'.$foto_lama.'.PNG?'.time() ;
       */

        return base_url().'upload/images/'.$slug.'/'.$foto_lama.'?'.time() ;
          
   }
