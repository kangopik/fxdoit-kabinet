<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_manager extends CI_Model {

 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function MTableOperation($operation,$table,$dataform,$where_array,$rank) 
    {
        /* Reference:
        http://localhost/Codeigniter-3.0.6/user_guide/database/query_builder.html */
        if (CHECKRANKPERMISSION($table,$rank))
        {
            if ($operation == 'GET')
                    {
                        $this->db->where($where_array) ;
                        return $this->db->get($table)->row_array() ;
                    }
            if ($operation == 'GETDISCTINCT')
                    {   
                      
       $sql = "SELECT DISTINCT * FROM $table WHERE ? LIKE ? GROUP BY ?  ";
       $q = $this->db->query($sql,array($where_array[0],$where_array[1],$where_array[2]));
       $q = $q->result();
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

    function CreateId($provinsi)
    {
        $tanggal = date('Ymd');
          $stringbill = $provinsi.$tanggal ;

          $sql = "SELECT MAX(RIGHT(user_id,4)) as id_max FROM t_users WHERE user_id LIKE ? " ;
          $query = $this->db->query($sql,array($stringbill.'%')) ;
          if ($query->num_rows() > 0)
          {
            foreach($query->result() AS $k)
            {
                $tmp = ((int)$k->id_max) + 1;
                $kd = sprintf("%04s",$tmp) ;
            }
          }
          else
          {
              
               $kd = "0001" ;
          }

          $bill = $stringbill.$kd ;
          
          return $bill ;

    }

    function CreateSubcategory()
    {

        
    }



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


        return array(
                        'daily_visit' => $daily_visit,
                        'daily_unique' => $daily_unique,
                        'total_visit' => $total_visit,
                        'total_unique' => $total_unique,
                        'start' => $start,
                        'total_days' => $total_days,
                        'avg_visit' => $avg_visit,
                        'avg_unique' => $avg_unique 
                        );
    }







}
