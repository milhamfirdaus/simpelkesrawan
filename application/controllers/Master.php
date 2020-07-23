<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('M_Kucing');
        $this->load->model('M_Hewan');
        $this->load->model('M_Spesies');
        $this->load->model('M_Kecamatan');
        $this->load->model('M_Desa');
        $this->load->model('M_User');
        
        $this->load->library(array('upload','form_validation'));
        if(!$this->session->userdata('sess_admin_') AND !$this->session->userdata('sess_member_')){
            redirect('auth');
        }

    }
	public function index(){
		
        $this->load->view('admin/dashboard');
	}
	################### Master HPR #####################
	public function hpr(){
	    $data['page'] = 'Hewan Penular Rabies (HPR)';
	    $data['data_kecamatan'] = $this->M_Kecamatan->getAllKecamatan();
        $data['data_member'] = $this->M_User->getAllMember();
	    $data['data_desa'] = $this->M_Desa->getAllDesa();
	    $data['data_spesies'] = $this->M_Spesies->getAllSpesies();

        if($this->session->userdata('sess_admin_')){
            $this->load->view('admin/dtHewan',$data);
        }
        else if($this->session->userdata('sess_member_')){
            $this->load->view('member/view_hpr_member',$data);
        }
	}

	public function getHewan(){
        $this->M_Hewan->getHewan();
    }

	public function gDataTableMember()
	{
        $this->M_Hewan->gDataTableMember();
    }

    public function insertHewan()
    {
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('hewanNama','', 'required',array('required'=>'Nama Hewan Tidak Boleh Kosong'));
        $this->form_validation->set_rules('lat','', 'required',array('required'=>'Tentukan Lokasi lebih Dulu'));
        $this->form_validation->set_rules('lng','', 'required',array('required'=>'Tentukan Lokasi lebih Dulu'));
        
        if ($this->form_validation->run() == false) :
        $json = array(
            'hewanNama'=> form_error('hewanNama', '', '')
        );
        echo json_encode($json);
        else :

        if($this->input->post('pemilik')==""){
            $idmember="0";
        }else{
            $idmember =$this->input->post('pemilik');
        }

        $data = array(
            'hewanNama'=> $this->input->post('hewanNama'),
            'hewanJenisKelamin'=> $this->input->post('hewanJK'),
            'spesiesID'=> $this->input->post('hewanSpesies'),
            'desaID'=> $this->input->post('hewanDesa'),
            'hewanLat'=> $this->input->post('lat'),
            'hewanLng'=> $this->input->post('lng'),
            'hewanTanggalInsert'=> date('Y-m-d H:i:s'),
            'memberID'=> @$this->input->post('pemilik'),
            'publish'=> "1",
        );

        if($this->session->has_userdata('sess_member_')){
            $idmember = $this->session->sess_member_->memberID;
            $data['memberID'] = $idmember;
            $data['publish'] = "0";
        }
        /* Upload file gambar */
        $config['upload_path'] = './assets/img/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        
        $this->upload->initialize($config);
        if(!empty($_FILES['filefoto']['name']))
        {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
               
                $data['hewanGambar'] = $gbr['file_name']; //Mengambil file name dari gambar yang diupload

                $random = rand(10,999)+$idmember;
                $create = "H".$random."P".$idmember."R";
                $data['uniqueID'] = $create;
                if($this->M_Hewan->insert($data)){
                    echo DATA_BERHASIL_DISIMPAN;
                }else{
                    echo DATA_GAGAL_DISIMPAN;
                }
            }else{
                echo "Gambar Gagal Upload. Gambar harus bertipe gif|jpg|png|jpeg|bmp";
            }
            
        }else{
            echo "Gagal, gambar belum di pilih";
        }
        
    
        endif;
    }
    public function updateHewan()
	{
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('hewanNama','', 'required',array('required'=>'Nama Hewan Tidak Boleh Kosong'));
	    
	    if ($this->form_validation->run() == false) :
	    $json = array(
	        'hewanNama'=> form_error('hewanNama', '', ''),
	    );
	    echo json_encode($json);
	    else :
            
	    $data = array(
            'hewanNama'=> $this->input->post('hewanNama'),
            'hewanJenisKelamin'=> $this->input->post('hewanJK'),
            'spesiesID'=> $this->input->post('hewanSpesies'),
            'desaID'=> $this->input->post('hewanDesa'),
            'hewanKeterangan'=> $this->input->post('hewanKeterangan'),
            'hewanLat'=> $this->input->post('lat'),
            'hewanLng'=> $this->input->post('lng'),
            'hewanTanggalUpdate'=> date('Y-m-d H:i:s'),
            'memberID'=> @$this->input->post('pemilik'),
            'publish'=> "1",
	    );

        if($this->session->has_userdata('sess_member_')){
           if($this->input->post('publish') == "0" OR $this->input->post('publish') == ""){
                $data['memberID'] = $this->session->sess_member_->memberID;
                unset($data['publish']);
            }
            else if($this->input->post('publish') == "2"){
                $data['memberID'] = $this->session->sess_member_->memberID;
                $data['publish'] = "0";
            }
        }

	    $config['upload_path'] = './assets/img/'; //path folder
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
	    
	    $this->upload->initialize($config);
	    if(!empty($_FILES['filefoto']['name']))
	    {
	        unlink(realpath('./').'/assets/img/'.$this->input->post('old_foto'));
	        if ($this->upload->do_upload('filefoto'))
	        {
	            $gbr = $this->upload->data();
	            $data['hewanGambar'] = $gbr['file_name']; //Mengambil file name dari gambar yang diupload
	            $id = $this->input->post('hewanID');
	            if($this->M_Hewan->update($id,$data)){
	                echo DATA_BERHASIL_DISIMPAN;
	            }else{
	                echo DATA_GAGAL_DISIMPAN;
	            }
	        }else{
	            echo "Gambar Gagal Upload. Gambar harus bertipe gif|jpg|png|jpeg|bmp";
	        }
	        
	    }else{
	        $data['hewanGambar'] = $this->input->post('old_foto');
	        $id = $this->input->post('hewanID');
	        if($this->M_Hewan->update($id,$data)){
	            echo DATA_BERHASIL_DISIMPAN;
	        }else{
	            echo DATA_GAGAL_DISIMPAN;
	        }
	    }
	    
	    endif;
	}
    public function deleteHewan(){
	    $data = array(
        'hewanID'      =>   $this->input->post('id'),
	    );
	    
	    unlink(realpath('./').'/assets/img/'.$this->input->post('gambar'));
        if($this->M_Hewan->delete($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
	}
    public function getHewanID()
    {
        $id = $this->input->post('hewanID');
        echo json_encode($this->M_Hewan->getID($id));
    }

    public function preview($id){
        $data['title'] = 1;
        $data['dataHewan'] = $this->M_Hewan->getID($id);
        $data['page'] = 'Hewan';
        $this->load->view('member/preview_hewan',$data);
    }
    ################### /Master Kucing #####################
    
    ################### /Master Spesies #####################
    public function spesies()
    {
        if(!$this->session->userdata('sess_admin_')){
            redirect('auth');
        }
        $data['page'] = 'Spesies';
        $this->load->view('admin/dtSpesies',$data);
    }
    public function gDataTableSpesies()
	{
        $this->M_Spesies->gDataTable();
    }
    public function insertSpesies()
    {
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('spesiesNama', 
        '', 'required',array('required'=>'Nama Spesies Tidak Boleh Kosong'));
        
        if ($this->form_validation->run() == false) :
        $json = array(
            'spesiesNama'=> form_error('spesiesNama', '', ''),
        );
        echo json_encode($json);
        else :
        $data = array(
            'spesiesNama'=> $this->input->post('spesiesNama'),
            'spesiesKeterangan'=> $this->input->post('spesiesKeterangan'),
        );
        if($this->M_Spesies->insert($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
        endif;
    }
    public function updateSpesies()
	{
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('spesiesNama',
	        '', 'required',array('required'=>'Nama Spesies Tidak Boleh Kosong'));
	    
	    if ($this->form_validation->run() == false) :
	    $json = array(
	        'spesiesNama'=> form_error('spesiesNama', '', ''),
	    );
	    echo json_encode($json);
	    else :
	    $data = array(
	        'spesiesNama'=> $this->input->post('spesiesNama'),
	        'spesiesKeterangan'=> $this->input->post('spesiesKeterangan'),
	    );
	    $id = $this->input->post('spesiesID');
	    if($this->M_Spesies->update($id,$data)){
	        echo DATA_BERHASIL_DISIMPAN;
	    }else{
	        echo DATA_GAGAL_DISIMPAN;
	    }
	    endif;
	}
	public function deleteSpesies(){
	    $data = array(
        'spesiesID'      =>   $this->input->post('spesiesID'),
	    );
        if($this->M_Spesies->delete($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
	}
	public function getIDSpesies()
    {
        $id = $this->input->post('spesiesID');
        echo json_encode($this->M_Spesies->getID($id));
    }
    ################### /Master Spesies #####################
    
    ################### Master Kecamatan #####################
    public function kecamatan()
    {
        if(!$this->session->userdata('sess_admin_')){
            redirect('auth');
        }
        
        $data['page'] = 'Kecamatan';
        $this->load->view('admin/dtKecamatan',$data);
    }
    public function gDataTableKecamatan()
    {
        $this->M_Kecamatan->gDataTable();
    }
    public function insertKecamatan()
    {
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kecamatanNama',
            '', 'required',array('required'=>'Nama Kecamatan Tidak Boleh Kosong'));
        
        if ($this->form_validation->run() == false) :
        $json = array(
            'kecamatanNama'=> form_error('kecamatanNama', '', ''),
        );
        echo json_encode($json);
        else :
        $data = array(
            'kecamatanNama'=> $this->input->post('kecamatanNama'),
        );
        if($this->M_Kecamatan->insert($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
        endif;
    }
    public function updateKecamatan()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kecamatanNama',
            '', 'required',array('required'=>'Nama Kecamatan Tidak Boleh Kosong'));
        
        if ($this->form_validation->run() == false) :
        $json = array(
            'kecamatanNama'=> form_error('kecamatanNama', '', ''),
        );
        echo json_encode($json);
        else :
        $data = array(
            'kecamatanNama'=> $this->input->post('kecamatanNama'),
        );
        $id = $this->input->post('kecamatanID');
        if($this->M_Kecamatan->update($id,$data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
        endif;
    }
    public function deleteKecamatan(){
        $data = array(
            'kecamatanID'      =>   $this->input->post('kecamatanID'),
        );
        if($this->M_Kecamatan->delete($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
    }
    public function getIDKecamatan()
    {
        $id = $this->input->post('kecamatanID');
        echo json_encode($this->M_Kecamatan->getID($id));
    }
    
    ################### Master /Kecamatan ####################


    public function member(){
        if(!$this->session->userdata('sess_admin_')){
            redirect('auth');
        }
        $data['page'] = 'Member Simple Kesrawan';
        $data['data_kecamatan'] = $this->M_Kecamatan->getAllKecamatan();
        $data['data_desa'] = $this->M_Desa->getAllDesa();
        $this->load->view('admin/dtMember',$data);
    }

    public function dataMember(){
        
        $this->M_User->getMember();
    }

    public function insertMember(){
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('memberNama','','trim|required',array('required' => 'Nama Lengkap Tidak Boleh Kosong !'));
        $this->form_validation->set_rules('memberEmail','','trim|required|valid_email|is_unique[tb_member.memberEmail]',array('required' => 'Email Tidak Boleh Kosong !','valid_email'=>'Email tidak valid','is_unique'=>'Email ini sudah terdaftar, gunakan Email yang lain '));
        $this->form_validation->set_rules('memberUsername','','trim|required|is_unique[tb_member.memberUsername]',array('required' => 'Username Tidak Boleh Kosong !','is_unique'=>'Username sudah digunakan, silahkan gunakan username yang lain'));
        $this->form_validation->set_rules('memberPassword','','trim|required',array('required' => 'Password Tidak Boleh Kosong !'));

        if ($this->form_validation->run() == false) :
        $json = array(
                'memberNamaLengkap' => form_error('memberNama','',''),
                'memberEmail' => form_error('memberEmail','',''),
                'memberUsername' => form_error('memberUsername','',''),
                'memberPassword' => form_error('memberPassword','',''),
        );
        echo json_encode($json);
        else :
        $data = array(
            'memberNIK'=> $this->input->post('memberNIK'),
            'memberNamaLengkap'=> $this->input->post('memberNama'),
            'memberJK'=> $this->input->post('memberJK'),
            'memberTTL'=> $this->input->post('memberTTL'),
            'memberAlamat'=> $this->input->post('memberAlamat'),
            'desaID'=> $this->input->post('memberDesa'),
            'memberHandphone'=> $this->input->post('memberHandphone'),
            'memberEmail'=> $this->input->post('memberEmail'),
            'memberUsername'=> $this->input->post('memberUsername'),
            'memberPassword'=> sha1(sha1($this->input->post('memberPassword'))),
            'verified'=> "1",
        );
        if($this->M_User->insert($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
        endif;
    }

    public function updateMember(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('memberNIK', 
        '', 'required',array('required'=>'NIK Tidak Boleh Kosong'));
        $this->form_validation->set_rules('memberNama', 
        '', 'required',array('required'=>'Nama Member Tidak Boleh Kosong'));
        
        if ($this->form_validation->run() == false) :
        $json = array(
            'memberNIK'=> form_error('memberNIK', '', ''),
        );
        echo json_encode($json);
        else :
        $data = array(
            'memberNIK'=> $this->input->post('memberNIK'),
            'memberNamaLengkap'=> $this->input->post('memberNama'),
            'memberJK'=> $this->input->post('memberJK'),
            'memberTTL'=> $this->input->post('memberTTL'),
            'memberAlamat'=> $this->input->post('memberAlamat'),
            'desaID'=> $this->input->post('memberDesa'),
            'memberHandphone'=> $this->input->post('memberHandphone'),
            'memberEmail'=> $this->input->post('memberEmail'),
            'memberPassword'=> sha1(sha1($this->input->post('memberPassword'))),
        );

        if($this->input->post('memberPassword') == ""){
            unset($data['memberPassword']);
        }
        else if($this->input->post('memberEmail') == ""){
            unset($data['memberEmail']);
        }
        else if($this->input->post('memberDesa') == ""){
            unset($data['desaID']);
        }

        $id = $this->input->post('memberID');
        if($this->M_User->update($id,$data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
        endif;
    }

    public function deleteMember(){
        $data = array(
        'memberID'      =>   $this->input->post('memberID'),
        );
        if($this->M_User->delete($data)){
            echo DATA_BERHASIL_DISIMPAN;
        }else{
            echo DATA_GAGAL_DISIMPAN;
        }
    }

    public function getIDMember(){
        $id = $this->input->post('memberID');
        echo json_encode($this->M_User->getID($id));
    }
    
}
