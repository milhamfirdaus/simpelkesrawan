<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model(array('M_Post','M_Hewan','M_User'));

        if(!$this->session->userdata('sess_admin_')){
            redirect('Auth/index');
        }
    }

	public function hewan(){
	    $data['title'] = 1;
	    $data['page'] = 'Verifikasi Hewan';
		$this->load->view('admin/verifikasi_hewan',$data);
	}

	public function vDataTableHewan(){
		
		$this->M_Hewan->vDataTable();
    }

    public function publish_hewan(){

	    $data = array(
	        'publish'=> "1",
	    );

	    $id = $this->input->post('hewanID');
	    if($this->M_Hewan->update($id,$data)){
	        echo DATA_BERHASIL_DISIMPAN;
	    }else{
	        echo DATA_GAGAL_DISIMPAN;
	    }

	}
	
	public function tolak_hewan(){

	    $data = array(
	        'publish'=> "2",
	    );
	    
	    $id = $this->input->post('hewanID');
	    if($this->M_Hewan->update($id,$data)){
	        echo DATA_BERHASIL_DISIMPAN;
	    }else{
	        echo DATA_GAGAL_DISIMPAN;
	    }
	}

	public function post(){
	    $data['title'] = 1;
	    $data['page'] = 'Post';
		$this->load->view('admin/verifikasi_post',$data);
	}

	public function vDataTablePost(){
        
        $this->M_Post->vDataTable();
    }

    public function publish_post(){

	    $data = array(
	        'publish'=> "1",
	    );
	    $id = $this->input->post('postID');
	    if($this->M_Post->update($id,$data)){
	        echo DATA_BERHASIL_DISIMPAN;
	    }else{
	        echo DATA_GAGAL_DISIMPAN;
	    }

	}
	
	public function tolak_post(){

	    $data = array(
	        'publish'=> "2",
	    );
	    $id = $this->input->post('postID');
	    if($this->M_Post->update($id,$data)){
	        echo DATA_BERHASIL_DISIMPAN;
	    }else{
	        echo DATA_GAGAL_DISIMPAN;
	    }
	}

	public function member(){
	    $data['title'] = 1;
	    $data['page'] = 'Post';
		$this->load->view('admin/verifikasi_member',$data);
	}

	public function vDataMember(){
        
        $this->M_User->vMember();
    }

    public function verifikasi_member(){
	    $data = array(
	        'verified'=> "1",
	    );
	    $id = $this->input->post('memberID');
	    if($this->M_User->update($id,$data)){
	        echo DATA_BERHASIL_DISIMPAN;
	    }else{
	        echo DATA_GAGAL_DISIMPAN;
	    }
	}
	
	public function tolak_member(){
	    $data = array(
	        'publish'=> "2",
	    );
	    $id = $this->input->post('memberID');
	    if($this->M_User->update($id,$data)){
	        echo DATA_BERHASIL_DISIMPAN;
	    }else{
	        echo DATA_GAGAL_DISIMPAN;
	    }
	}


////////////////////////////////////////////////////////////////////////

	public function preview($id){
		$data['title'] = 1;
		$data['dataHewan'] = $this->M_Hewan->getID($id);
    	$data['page'] = 'Hewan';
		$this->load->view('admin/previewHewan',$data);
	}

	public function previewMember($id){
		$data['title'] = 1;
		$data['dataMember'] = $this->M_User->getID($id);
    	$data['page'] = 'Member';
		$this->load->view('admin/previewMember',$data);

	}







}
