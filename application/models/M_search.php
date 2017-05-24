<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_search extends CI_Model {
   

   public function MSearchEngine($page,$kota,$kategori,$order_by,$kata) 
   	{
   		/* huskyin.com - Algoritma Search Engine
   		Sumur : http://stackoverflow.com/questions/6259647/mysql-match-against-order-by-relevance-and-column
   		*/
   		if ($kota == 'ALL')
   		$kota = 'ko_'.'%' ;
   		else 
   			$kota = 'ko'.$kota ;

   		if ($kategori == 'ALL')
   		$kategori = 'ka_'.'%' ;
   		else 
   			$kategori = 'ka'.$kota ;

   		if ($order_by == 'minimal_pkt')
   			$order_by = $order_by*(-1) ;

   		// mulai quary di sini ...

   		if ($kata == '')
   		{
   			$sql = "SELECT * FROM $table WHERE kota LIKE ? AND kategori LIKE ? ORDER BY $order_by DESC LIMIT $page,10 " ;
   			$q = $this->db->query($sql,array($kota,$kategori)) ;
   		
   		}
   		else
   		{
   			$sql = " SELECT t_paket.* ,
					 MATCH(nama_merchant,profil_pkt) AGAINST ($kata) AS relevance,
					 MATCH(nama_merchant) AGAINST ($kata) AS title
					FROM $table 
					WHERE MATCH(nama_merchant,profil_pkt) AGAINST ($kata)
					AND kota LIKE ? AND kategori LIKE ? 
					ORDER BY title DESC , relevance DESC LIMIT  $page,10
   			";
   			$q = $this->db->query($sql,array($kota,$kategori)) ;
   		}

   		return $q->result() ;
   	}



 }