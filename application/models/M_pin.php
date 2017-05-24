<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pin extends CI_Model 
{



function __construct() {
            parent::__construct();
            $this->load->database();
        }


        public function insert($data)
	{
	$this->db->insert('t_pin',$data);
	}


	function checkpin($datapin,$pangkat=NULL) 
    {
    	// di database PIN harus ADA dan TERVALIDASI ( 'status' = 1)
        $s = 'Belum di test';
        $sql = "SELECT * FROM t_pin WHERE pin=? ";   

        $query = $this->db->query($sql,array($datapin));  
        $result = $query->row_array();
       
        if ($query->num_rows() == 1)
        {
        	$status_pin = $result['status'] ;
        	if ($status_pin == 1)
        	{
                if(!is_null($pangkat))
                {
                    if ($pangkat == $result['pangkat'])
                    {
                        $s = 'SUCCESS' ;
                        $stockis = $result['stockis']; 
                    }
                    else
                        $s = 'PANGKAT TIDAK SESUAI!' ;

                }
                else
                    $s = 'SUCCESS' ;
        		
        	}
        	if ($status_pin == 0)
        	{
        		$s = 'PIN BELUM TERVALIDASI!';
                $stockis = $result['stockis']; 
        	}
        	if ($status_pin == 2)
        	{
        		$s = 'PIN SUDAH DIGUNAKAN!' ;
                $stockis = $result['stockis']; 
        	}

                    return array(       's' => $s , 
                      'stockis' => $result['stockis'],
                      'jumlah_pin' => $query->num_rows(),
                       'nominal' => $result['nominal'],
                       'user_id' => $result['user_id'],
                       'code'   => $result['code'] );

            
      	
        }



        else
        {
           return array( 's' => 'PIN TIDAK DITEMUKAN',
                          'stockis' => 'Stockis Tidak Ada' ,
                          'nominal' => '',
                          'user_id' => '',
                          'code' => '' );
        }

                  return array( 's' => $s , 
                    'jumlah_pin' => $query->num_rows() ,
                      'stockis' => $result['stockis'],
                       'nominal' => $result['nominal'],
                       'user_id' => $result['user_id'],
                       'code'   => $result['code'] );


       
    }



     function checkpin_user_id($pin,$user_id)
    {
        
        if ($user_id != '') // mencheck PIN dengan menggunakan USer_ID
        {
            $sql = "SELECT * FROM t_pin WHERE user_id=? ";
            $query = $this->db->query($sql,array($user_id)) ;
            $result = $query->row_array();
            if ($query->num_rows() != 0)
            {
                if ($result['status'] == 2 )
                 {
                    if ($result['pin'] == $pin )
                    {
                        $s = 'PIN COCOK' ;
                    }
                    else $s = 'PIN TIDAK COCOK' ;

                 }
                 else $s = 'PIN BELUM DIDAFTARKAN';

            }
            else $s = 'PIN ERROR' ;



        }
        else // Mencheck PIN yg User ID nya belum diketahui / belum didaftarkan
        {
            $sql = "SELECT * FROM t_pin WHERE pin=? ";
            $query = $this->db->query($sql,array($pin)) ;
            $result = $query->row_array();
            if ($query->num_rows() == 1)
             {
                if ($result['status'] == 0 )
                 $s = 'PIN BELUM TERVALIDASI' ;
                elseif ($result['status'] == 1 )
                  $s = 'PIN SUDAH TERVALIDASI, SIAP DIDAFTARKAN' ;  
                elseif ($result['status'] == 2 )
                  $s = 'PIN SUDAH DIDAFTARKAN MENJADI ID TERTENTU' ;    
             }
             else
                $s = 'PIN ERROR';
                

        }
            
        
        return $s ;
    }









    // Set Pin yang sudah terpakai
    function pinterpakai($datapin,$user_id)
    {
        $sql = "UPDATE `t_pin` SET `user_id` = ?, `status` = '2', `tgl_expired` = '3016-01-01' WHERE `t_pin`.`pin`=?";
        $query = $this->db->query($sql,array($user_id,$datapin)) ;

    }


    function pintervalidasi($datapin)
    {
    	$sql = "SELECT * FROM `t_pin` WHERE pin=? AND status=0 " ;
    	$query = $this->db->query($sql,array($datapin)) ;
    	$result = $query->num_rows();
    	if ($result == 1)
    	{
            $data = array('status' => 1, 'user_id' => 'Belum Digunakan');
    		$this->db->where(array('pin'=>$datapin) );
           $this->db->update('t_pin',$data);
    		$s = 'SUCCESS'  ;

    	}
    	else
		{
			$s = '<b>PIN ERROR, SUDAH DIDAFTARKAN ATAU KADALUARSA</b>' ;

		}
    	
        return array('s' => $s) ;
    }


    function hapus_pin_kadaluarsa()
    {
        $this->table = 't_pin' ;
        // lihat ke databasenya
        $sql = "DELETE FROM `t_pin` WHERE `tgl_expired` < now()" ;
        $query= $this->db->query($sql) ;
    }


    function lihatpin()
        {
        $where_array = array('stockis' => 101);
        $this->db->where($where_array) ;
        $query=$this->db->get('t_pin');
        $data=$query->result();
        return $data;
        }

     function lihatpinro()
        {
            $where_array = array('stockis' => 888) ;
            $this->db->where($where_array) ;
            $query=$this->db->get('t_pin');
            $data=$query->result();
             return $data;
        }


	/* huskyin.com Fungsi Model membuat PIN - dibuat oleh Rian */ 
	function pinmaker($kodestockis,$nominal,$id_pemesan,$pangkat)
	{
		$this->table = 't_pin';

		
			$hasilpin = $this->generatepin() ;
			$tanggal_generate = date("Y-m-d") ;
			$tanggal_expired  = date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day"));



			// convert integer to string for save memory
			$string_hasilpin = strval($hasilpin);
            if ($kodestockis == '888'){
                $string_hasilpin[0] = 'R' ;
                $string_hasilpin[1] = 'O' ;
            }

			$sql = "INSERT INTO $this->table (`pin`,`pangkat`,`tgl_generate`, `tgl_expired`,`stockis`,`user_id`,`nominal`,`status`) VALUES (?,?,?,?,?,?,?,?)" ;
		    $this->db->query ($sql,array($string_hasilpin,$pangkat,$tanggal_generate,$tanggal_expired,$kodestockis,'Belum Digunakan',$nominal,0)) ;
		    $insert_pin = $this->db->insert_id();
		
		return array('s' => 'SUCCESS', 
			 		 'pin_tercipta' => $string_hasilpin ) ;
			 		 			 		 
	}

	/* huskyin.com Fungsi Model membuat PIN - dibuat oleh Rian */ 
	 function randStrGen($len)
	{
		$result = "";
    	$chars = "0123456789";
   		 $charArray = str_split($chars);
    	for($i = 0; $i < $len; $i++)
    {
		$randItem = array_rand($charArray);
   		$result .= "".$charArray[$randItem];
    }
    	return $result;
	}

	/* huskyin.com Fungsi Model membuat PIN - dibuat oleh Rian */ 
	 function generatepin()
	{
			
		$this->table = 't_pin';
	
		$totaldigit = 10 ;
		$make_pin = $this->randStrGen($totaldigit);

		$string_make_pin = strval($make_pin);
	
		// dicocokkan dengan yg ada di database
		$sql = "SELECT pin  FROM  $this->table WHERE pin=? " ;
		$result = $this->db->query($sql,$string_make_pin) ;
		$rows = $result->num_rows();
		if ($rows != 0)
		{ // Pin sudah pernah terbentuk, ulangi proses.. 
			$this->generatepin() ;
		}		
		else
		{
			return $make_pin ;
		}    
	}


    function MAmbilPinBaru($stockis)
    {
        $sql = "SELECT pin FROM t_pin WHERE status != ? AND stockis=?" ;
        $q = $this->db->query($sql,array(2,$stockis)) ;
        if ($q->num_rows() == 0){
            $s = 'FAILED' ; $pin = 'XX' ;
        }
        else 
        {
            $s = 'SUCCESS' ;
            $pin = $q->row_array()['pin'] ;
            $sql = "UPDATE `t_pin` SET  `status` = '2', `tgl_expired` = '3016-01-01' WHERE pin=?";
            $query = $this->db->query($sql,array( $pin)) ;

        }
        return array('s' => $s , 'pin' => $pin) ;
    } 





























}