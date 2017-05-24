<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_XDB extends CI_Model 
{

    function Model_XDB($rank,$operation,$table,$where_array=NULL,$dataform=NULL,$order_by=NULL)
    {
        
        /* Reference:
        http://localhost/Codeigniter-3.0.6/user_guide/database/query_builder.html */
        if (CHECKRANKPERMISSION($table,$rank))
        {       
            if ($operation == 'GET')
                    {
                        $this->db->where($where_array) ;
                        $r = $this->db->get($table) ;
                        $r->row_array()['TOTAL'] = $r->num_rows();
                        $q = $r->row_array() ;

                        return $q ;
                    }
            if ($operation == 'GETDISTINCT')
                    {   
                      $sql = "SELECT DISTINCT $where_array[0] FROM $table WHERE $where_array[1] LIKE ? GROUP BY $where_array[3]  ";
                     
                        if ($order_by != NULL)
                      $sql = $sql." ORDER BY $order_by" ;     
                      $q = $this->db->query($sql,array($where_array[2]));
                      $r['RESULT'] = $q->result() ;
                      $r['TOTAL'] = $q->num_rows() ;
                      return $r ;    
                    }
            if ($operation == 'GETALL')
                    {
                        if ($where_array != NULL)
                          $this->db->where($where_array) ;
                        if ($order_by != NULL)
                            $this->db->order_by($order_by);
                        $q = $this->db->get($table);
                        $r['RESULT'] = $q->result() ;
                        $r['TOTAL'] = $q->num_rows() ;
                        return $r ;
                    }
            if ($operation == 'UPDATE')
                    {
                        $this->db->where($where_array);
                        $this->db->set($dataform);
                        $this->db->update($table);
                    }  
            if ($operation == 'ADD')
                    {
                        $where = array_keys($where_array)[0];
                        $field = $dataform[0];
                        $add_by = $dataform[1];
                        $sql = "UPDATE $table SET $field = $field+? WHERE $where = ?";
                        $this->db->query($sql,array($add_by, $where_array[$where])) ;
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
}

?>