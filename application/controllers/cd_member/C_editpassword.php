<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_editpassword extends CI_Controller{
	public function __construct() {
		parent::__construct();
	
		if ( IS_MAINTENANCE() == 1 )
			redirect('maintenance');	
	
		if  ($this->session->userdata('userlevel') != 'member')
		{
			if  ($this->session->userdata('userlevel') != 'proadmin')
				redirect('') ;
		}
		else
		{
			if (!match_ip())
			{
				redirect('');
			}		
		}		
		
		$this->load->helper('text');
		$this->load->model('M_users');
		$this->load->model('M_membership');
		$this->load->model('M_pin');
		$this->load->model('M_pkt');
		$this->load->model('M_general');
	}
	
	public function index()
	{
		$user_id = $this->session->userdata('user_id');  $data['user_id'] = $user_id;
		$data['title'] = 'Fxdoit Edit Password';
		$data['nama_lengkap'] = VERBOSE(XDB(1,'GET','t_users',array('user_id'=>$user_id))['nama']);	
		 
		$this->load->view('vd_'.$this->session->userdata('userlevel').'/v_edit_password',$data);
	}
	
	function edpassword()
	{
		$dataform = $this->input->post() ;
		// saya ambil method ini dari existing edit password yang ada di source ini
		// karena table t_pin tidak ada di saya maka saya skip bagian ini
		//$checkpin = $this->M_pin->checkpin_user_id($dataform['pin'],$this->session->userdata('user_id')) ;
		//if ($checkpin == 'PIN COCOK')
		//{
			$process = $this->M_users->M_editpassword($dataform) ;
			if ($process == 'SUCCESS')
				$ctrl_data['message'] = 'Ganti Password Sukses' ;
			else
				$ctrl_data['message'] = 'Ganti Password Gagal! '.$process ;
		//}
		//else
			//$ctrl_data['message'] = 'Ganti Password Gagal! '. $checkpin ;
	
		$this->session->set_flashdata("notif",
				"<div class=\"alert bg-success alert-styled-left\">
						<span class=\"text-semibold\" style=\"color:#FFFFFF\">".$ctrl_data['message']."</span>
					</div>");
		redirect("cd_member/C_editpassword");
	}
	
}
