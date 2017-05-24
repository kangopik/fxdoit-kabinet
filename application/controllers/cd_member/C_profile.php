<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_profile extends CI_Controller{
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
		$data['title'] = 'Fxdoit Edit Profile';
		$data['nama_lengkap'] = VERBOSE(XDB(1,'GET','t_users',array('user_id'=>$user_id))['nama']);
		$getdataprofile = XDB(1,'GET','t_users_profile',array('user_id'=>$user_id));
		$data['sex'] = $getdataprofile['sex'] ;
		$data['address'] = $getdataprofile['address'] ;
		$data['postcode'] = $getdataprofile['postcode'] ;
		$data['city'] = $getdataprofile['city'] ;
		$data['province'] = $getdataprofile['province'] ;
		$data['country'] = $getdataprofile['country'] ;
		$data['type_id'] = $getdataprofile['type_id'] ;
		$data['no_id'] = $getdataprofile['no_id'] ;
		$data['photo'] = $getdataprofile['photo'] ;
		$data['profesi'] = $getdataprofile['profesi'] ;
		$getdatauser = XDB(1,'GET','t_users',array('user_id'=>$user_id));
		$data['username'] = $getdatauser['username'] ;
		$data['email'] = $getdatauser['email'] ;
		$data['hp'] = $getdatauser['hp'] ;
		$this->load->view('vd_'.$this->session->userdata('userlevel').'/v_profile',$data);
	}
	
	function saveprofile()
	{		
		$idtag = $this->session->userdata('user_id');
		date_default_timezone_set('Asia/Jakarta');
		$dataUser = array(
					'user_id'		=> $this->session->userdata('user_id'),
					'email'      	=> $this->input->post('email'),
					'username' 		=> $this->input->post('username'),
					'hp'      		=> $this->input->post('hp')      
		); 		
		
		if ( $_SERVER['HTTP_HOST'] != 'localhost')
			$this->imagepath = 'upload/images/users_images/' ;
		else
			$this->imagepath = 'upload\\images\\users_images\\' ;
		
		$config_upload['upload_path'] = $this->imagepath  ;
		$config_upload['allowed_types'] = 'gif|jpg|png|jpeg' ;
		$config_upload['max_size'] = 990000 ;
		
		$this->load->library('upload',$config_upload) ;
		
		if($this->upload->do_upload("profilepic"))
		{			
			$data_upload_files = $this->upload->data();
			$image = $data_upload_files['full_path'];

			$dataprofile = array(
					'user_id'		=> $this->session->userdata('user_id'),
					'sex'      		=> $this->input->post('sex'),
					'address'      	=> $this->input->post('address'),
					'postcode'     	=> $this->input->post('postcode'),
					'profesi'     	=> $this->input->post('profesi'),
					'type_id'      	=> $this->input->post('type_id'),
					'no_id'      	=> $this->input->post('no_id'),
					'city'      	=> $this->input->post('city'),
					'province'  	=> $this->input->post('province'),
					'country'  		=> $this->input->post('country'),
					'photo'			=> $image,
			
			);
			
			$processUser = $this->M_users->M_editusers($dataUser) ;
			$processProfile = $this->M_users->M_editprofile($dataprofile) ;
			if ($processUser == 'SUCCESS' && $processProfile == 'SUCCESS' )
				$ctrl_data['message'] = 'Edit Profile Sukses' ;
			else
				$ctrl_data['message'] = 'Edit Profile Gagal ' ; 			
		}else{
			$ctrl_data['message'] = 'Edit Profile Gagal ' ;
		}
		
		 $this->session->set_flashdata("notif",
				"<div class=\"alert bg-success alert-styled-left\">
						<span class=\"text-semibold\" style=\"color:#FFFFFF\">".$ctrl_data['message']."</span>
					</div>");
		 redirect("cd_member/C_profile");
	
	
	}
}