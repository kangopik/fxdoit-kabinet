<?php 





    function TOTALMEMBER($condition=NULL)
    {
       $ci =& get_instance() ;      
       if ($condition == NULL) 
       $sql = "SELECT * FROM t_users" ;
       else
         $sql = "SELECT * FROM t_users WHERE $condition" ;

       $q = $ci->db->query($sql);
       return $q->num_rows();
    }



    function TOTALBILL($condition=NULL)
    {
       $ci =& get_instance() ;      
       if ($condition == NULL) 
       $sql = "SELECT * FROM t_payment WHERE status=1 AND user_id=? " ;
       else
         $sql = "SELECT * FROM t_payment WHERE status=1 AND user_id=? AND $condition" ;

       $q = $ci->db->query($sql,$ci->session->userdata('user_id'));
       return $q->num_rows();
    }

    function MEMBERPAYMENT($condition=NULL)
    {
       $ci =& get_instance() ;      
       if ($condition == NULL) 
       $sql = "SELECT * FROM t_payment WHERE status=2 " ;
       else
         $sql = "SELECT * FROM t_payment WHERE status=2 AND $condition" ;

       $q = $ci->db->query($sql);
       if ($q->num_rows() > 0)
       return $q->num_rows();
      else
        return '' ;
    }


    function TOTALTICKETS($condition=NULL)
    {
       $ci =& get_instance() ;      
       if ($condition == NULL) 
       $sql = "SELECT * FROM t_chat WHERE readed=0 AND receiver_id=? " ;
       else
         $sql = "SELECT * FROM t_chat WHERE readed=0 AND receiver_id=? AND $condition" ;

       $q = $ci->db->query($sql,$ci->session->userdata('user_id'));
       return $q->num_rows();
    }






?>