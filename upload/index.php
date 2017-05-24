<?php 
/*
Fungsi index ini bertujuan supaya orang TIDAK BISA MEM-PARSING langsung
dan mengakses Folder 'Assets' via url browser


*/




function url_search(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }

    if ($_SERVER['HTTP_HOST'] != 'localhost')
    	 return $protocol . "://" . $_SERVER['HTTP_HOST'].'panaloka.com';
    else
    	return $protocol . "://" . $_SERVER['HTTP_HOST'].'/panaloka.com';

    
}


$url = url_search() ;

function redirect($url, $permanent = false) {
	if($permanent) {
		header('HTTP/1.1 301 Moved Permanently');
	}
	header('Location: '.$url);
	exit();
}

redirect($url) ;


if ( ! defined('BASEPATH')) exit('No direct script access allowed');



?>